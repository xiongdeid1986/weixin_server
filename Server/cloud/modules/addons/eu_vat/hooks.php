<?php //00e57
// *************************************************************************
// *                                                                       *
// * WHMCS - The Complete Client Management, Billing & Support Solution    *
// * Copyright (c) WHMCS Ltd. All Rights Reserved,                         *
// * Version: 5.3.14 (5.3.14-release.1)                                    *
// * BuildId: 0866bd1.62                                                   *
// * Build Date: 28 May 2015                                               *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@whmcs.com                                                 *
// * Website: http://www.whmcs.com                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.  This software  or any other *
// * copies thereof may not be provided or otherwise made available to any *
// * other person.  No title to and  ownership of the  software is  hereby *
// * transferred.                                                          *
// *                                                                       *
// * You may not reverse  engineer, decompile, defeat  license  encryption *
// * mechanisms, or  disassemble this software product or software product *
// * license.  WHMCompleteSolution may terminate this license if you don't *
// * comply with any of the terms and conditions set forth in our end user *
// * license agreement (EULA).  In such event,  licensee  agrees to return *
// * licensor  or destroy  all copies of software  upon termination of the *
// * license.                                                              *
// *                                                                       *
// * Please see the EULA file for the full End User License Agreement.     *
// *                                                                       *
// *************************************************************************
if( !defined('WHMCS') )
{
    exit( "This file cannot be accessed directly" );
}
add_hook('ClientDetailsValidation', 0, 'eu_vat_hook_validate_number');
add_hook('ClientAdd', 0, 'eu_vat_hook_set_tax_exempt');
add_hook('ClientEdit', 0, 'eu_vat_hook_set_tax_exempt');
add_hook('InvoiceCreation', 0, 'eu_vat_hook_custom_invoice_number_format');
add_hook('AddInvoicePayment', 0, 'eu_vat_hook_set_invoice_date_on_payment');
add_hook('DailyCronJob', 0, 'eu_vat_hook_auto_reset_numbers');
function eu_vat_hook_validate_number($vars)
{
    if( !class_exists('SoapClient') )
    {
        return false;
    }
    $modulevars = array(  );
    $result = select_query('tbladdonmodules', '', array( 'module' => 'eu_vat' ));
    while( $data = mysql_fetch_array($result) )
    {
        $modulevars[$data['setting']] = $data['value'];
    }
    if( !$modulevars['enablevalidation'] )
    {
        return false;
    }
    $result = select_query('tblcustomfields', 'id', array( 'type' => 'client', 'fieldname' => $modulevars['vatcustomfield'] ));
    $data = mysql_fetch_array($result);
    $VAT_CUSTOM_FIELD_ID = $data['id'];
    $vatnumber = $_POST['customfield'][$VAT_CUSTOM_FIELD_ID];
    if( $vatnumber )
    {
        $vatnumber = strtoupper($vatnumber);
        $vatnumber = preg_replace("/[^A-Z0-9]/", '', $vatnumber);
        $vat_prefix = substr($vatnumber, 0, 2);
        $vat_num = substr($vatnumber, 2);
        $errorcheck = false;
        try
        {
            $taxCheck = new SoapClient("http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl");
            $taxValid = $taxCheck->checkVat(array( 'countryCode' => $vat_prefix, 'vatNumber' => $vat_num ));
        }
        catch( Exception $e )
        {
            $errorcheck = true;
        }
        if( $taxValid->valid != 1 || $errorcheck )
        {
            global $_LANG;
            if( !$_LANG['vatnumberinvalid'] )
            {
                $_LANG['vatnumberinvalid'] = "The supplied VAT Number is not valid";
            }
            return $_LANG['vatnumberinvalid'];
        }
    }
}
function eu_vat_hook_set_tax_exempt($vars)
{
    $modulevars = array(  );
    $result = select_query('tbladdonmodules', '', array( 'module' => 'eu_vat' ));
    while( $data = mysql_fetch_array($result) )
    {
        $modulevars[$data['setting']] = $data['value'];
    }
    if( !$modulevars['taxexempt'] )
    {
        return false;
    }
    $result = select_query('tblcustomfields', 'id', array( 'type' => 'client', 'fieldname' => $modulevars['vatcustomfield'] ));
    $data = mysql_fetch_array($result);
    $VAT_CUSTOM_FIELD_ID = $data['id'];
    $result = select_query('tblcustomfieldsvalues', 'value', array( 'fieldid' => $VAT_CUSTOM_FIELD_ID, 'relid' => $vars['userid'] ));
    $data = mysql_fetch_array($result);
    $VAT_CUSTOM_FIELD_VALUE = $data['value'];
    $european_union_countries = array( 'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GB', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PL', 'PT', 'RO', 'SE', 'SI', 'SK' );
    if( $VAT_CUSTOM_FIELD_VALUE )
    {
        if( in_array($vars['country'], $european_union_countries) )
        {
            if( $modulevars['notaxexempthome'] )
            {
                if( $vars['country'] != $modulevars['homecountry'] )
                {
                    update_query('tblclients', array( 'taxexempt' => 'on' ), array( 'id' => $vars['userid'] ));
                    return NULL;
                }
            }
            else
            {
                update_query('tblclients', array( 'taxexempt' => 'on' ), array( 'id' => $vars['userid'] ));
                return NULL;
            }
        }
    }
    else
    {
        update_query('tblclients', array( 'taxexempt' => '' ), array( 'id' => $vars['userid'] ));
    }
}
function eu_vat_hook_custom_invoice_number_increment($lastNumber)
{
    $newNumber = WHMCS_Invoices::padandincrement($lastNumber);
    update_query('tbladdonmodules', array( 'value' => $newNumber ), array( 'module' => 'eu_vat', 'setting' => 'custominvoicenumber' ));
    return $newNumber;
}
function eu_vat_hook_custom_invoice_number_format($vars)
{
    $modulevars = array(  );
    $result = select_query('tbladdonmodules', '', array( 'module' => 'eu_vat' ));
    while( $data = mysql_fetch_array($result) )
    {
        $modulevars[$data['setting']] = $data['value'];
    }
    if( !$modulevars['enablecustominvoicenum'] )
    {
        return false;
    }
    $custominvoicenumformat = $modulevars['custominvoicenumformat'];
    $custominvoicenumber = $modulevars['custominvoicenumber'];
    if( !$custominvoicenumber )
    {
        $custominvoicenumber = 1;
    }
    $custominvoicenumformat = str_replace("{YEAR}", date('Y'), $custominvoicenumformat);
    $custominvoicenumformat = str_replace("{MONTH}", date('m'), $custominvoicenumformat);
    $custominvoicenumformat = str_replace("{DAY}", date('d'), $custominvoicenumformat);
    $custominvoicenumformat = str_replace("{NUMBER}", $custominvoicenumber, $custominvoicenumformat);
    update_query('tblinvoices', array( 'invoicenum' => $custominvoicenumformat ), array( 'id' => $vars['invoiceid'] ));
    eu_vat_hook_custom_invoice_number_increment($custominvoicenumber);
}
function eu_vat_hook_set_invoice_date_on_payment($vars)
{
    $modulevars = array(  );
    $result = select_query('tbladdonmodules', '', array( 'module' => 'eu_vat' ));
    while( $data = mysql_fetch_array($result) )
    {
        $modulevars[$data['setting']] = $data['value'];
    }
    if( !$modulevars['enableinvoicedatepayment'] )
    {
        return false;
    }
    update_query('tblinvoices', array( 'date' => "now()" ), array( 'id' => $vars['invoiceid'] ));
}
function eu_vat_hook_auto_reset_numbers($vars)
{
    $monthlyresetdate = date('Y-m-d', mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
    $annualresetdate = date('Y-m-d', mktime(0, 0, 0, 1, 0, date('Y') + 1));
    if( date('Y-m-d') == $monthlyresetdate )
    {
        $modulevars = array(  );
        $result = select_query('tbladdonmodules', '', array( 'module' => 'eu_vat' ));
        while( $data = mysql_fetch_array($result) )
        {
            $modulevars[$data['setting']] = $data['value'];
        }
        if( $modulevars['custominvoicenumautoreset'] == 'monthly' )
        {
            update_query('tbladdonmodules', array( 'value' => '1' ), array( 'module' => 'eu_vat', 'setting' => 'custominvoicenumber' ));
        }
        if( $modulevars['sequentialpaidautoreset'] == 'monthly' )
        {
            update_query('tblconfiguration', array( 'value' => '1' ), array( 'setting' => 'SequentialInvoiceNumberValue' ));
        }
    }
    if( date('Y-m-d') == $annualresetdate )
    {
        $modulevars = array(  );
        $result = select_query('tbladdonmodules', '', array( 'module' => 'eu_vat' ));
        while( $data = mysql_fetch_array($result) )
        {
            $modulevars[$data['setting']] = $data['value'];
        }
        if( $modulevars['custominvoicenumautoreset'] == 'annually' )
        {
            update_query('tbladdonmodules', array( 'value' => '1' ), array( 'module' => 'eu_vat', 'setting' => 'custominvoicenumber' ));
        }
        if( $modulevars['sequentialpaidautoreset'] == 'annually' )
        {
            update_query('tblconfiguration', array( 'value' => '1' ), array( 'setting' => 'SequentialInvoiceNumberValue' ));
        }
    }
}