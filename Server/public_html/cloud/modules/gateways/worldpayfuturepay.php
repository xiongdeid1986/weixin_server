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
function worldpayfuturepay_config()
{
    $configarray = array( 'FriendlyName' => array( 'Type' => 'System', 'Value' => "WorldPay FuturePay" ), 'installationid' => array( 'FriendlyName' => "Installation ID", 'Type' => 'text', 'Size' => '20', 'Description' => "Installation ID for Signups" ), 'installationidcharges' => array( 'FriendlyName' => "Installation ID for Charges", 'Type' => 'text', 'Size' => '20', 'Description' => "(Optional)" ), 'authpw' => array( 'FriendlyName' => "Auth Password", 'Type' => 'text', 'Size' => '20', 'Description' => '' ), 'authmode' => array( 'FriendlyName' => "Auth Mode", 'Type' => 'yesno', 'Description' => "Tick to enable authorizations only" ), 'testmode' => array( 'FriendlyName' => "Test Mode", 'Type' => 'yesno' ) );
    return $configarray;
}
function worldpayfuturepay_nolocalcc()
{
}
function worldpayfuturepay_link($params)
{
    global $_LANG;
    $code = '';
    $futurepayid = get_query_val('tblclients', 'gatewayid', array( 'id' => $params['clientdetails']['userid'] ));
    if( !$futurepayid )
    {
        $query2 = "SELECT * FROM tblcustomfieldsvalues WHERE fieldid=(SELECT id FROM tblcustomfields WHERE type='client' AND fieldname='FuturePay ID') AND relid=" . (int) $params['clientdetails']['userid'];
        $result2 = full_query($query2);
        $data2 = mysql_fetch_array($result2);
        $value = $data2['value'];
        if( trim($value) )
        {
            $futurepayid = $value;
        }
    }
    $testmode = $params['testmode'] ? '100' : '';
    if( $_GET['fpcharge'] && $futurepayid )
    {
        unset($_GET['fpcharge']);
        if( $params['testmode'] )
        {
            $url = "https://secure-test.worldpay.com/wcc/iadmin";
        }
        else
        {
            $url = "https://secure.worldpay.com/wcc/iadmin";
        }
        $qrystring = "instId=" . $params['installationidcharges'];
        $qrystring .= "&authPW=" . $params['authpw'];
        $qrystring .= "&futurePayId=" . $futurepayid;
        $qrystring .= "&amount=" . $params['amount'];
        $qrystring .= "&op-paymentLFP=";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $qrystring);
        $gatewayresult = curl_exec($ch);
        curl_close($ch);
        if( substr($gatewayresult, 0, 1) == 'Y' )
        {
            $returndata = explode(',', $gatewayresult);
            addInvoicePayment($params['invoiceid'], $returndata[1], '', '', 'worldpayfuturepay');
            logTransaction("WorldPay FuturePay", $gatewayresult, 'Successful');
            redir("id=" . $params['invoiceid'], "viewinvoice.php");
        }
        else
        {
            logTransaction("WorldPay FuturePay", $gatewayresult, 'Error');
            if( $_LANG['worldpayfuturepaycapturefailed'] )
            {
                $code = $_LANG['worldpayfuturepaycapturefailed'] . "<br>";
            }
            else
            {
                $code = "Payment Attempt Failed. You can setup a new agreement using the button below.<br>";
            }
            $futurepayid = '';
        }
    }
    if( $futurepayid )
    {
        $code .= "We have your details on record and will charge your card on the invoice due date<br /><input type=\"button\" value=\"Click here to Pay Now\" onclick=\"window.location='" . $params['systemurl'] . "/viewinvoice.php?id=" . $params['invoiceid'] . "&fpcharge=true'\" />";
    }
    else
    {
        $code .= "\n<form action=\"https://secure.worldpay.com/wcc/purchase\" method=\"post\">\n<INPUT TYPE=\"hidden\" NAME=\"instId\" VALUE=\"" . $params['installationid'] . "\">\n<INPUT TYPE=\"hidden\" NAME=\"cartId\" VALUE=\"" . $params['invoiceid'] . "\">\n<INPUT TYPE=\"hidden\" NAME=\"desc\" VALUE=\"" . $params['description'] . "\">\n<INPUT TYPE=\"hidden\" NAME=\"currency\" VALUE=\"" . $params['currency'] . "\">\n<INPUT TYPE=\"hidden\" NAME=\"amount\" VALUE=\"" . $params['amount'] . "\">\n<INPUT TYPE=\"hidden\" NAME=\"TestMode\" VALUE=\"" . $testmode . "\">\n<INPUT TYPE=\"hidden\" NAME=\"futurePayType\" VALUE=\"limited\">\n<INPUT TYPE=\"hidden\" NAME=\"noOfPayments\" VALUE=\"0\">\n<INPUT TYPE=\"hidden\" NAME=\"amountLimit\" VALUE=\"0.00\">\n<INPUT TYPE=\"hidden\" NAME=\"option\" VALUE=\"0\">\n<input type=\"hidden\" name=\"name\" value=\"" . $params['clientdetails']['firstname'] . " " . $params['clientdetails']['lastname'] . "\">\n<input type=\"hidden\" name=\"email\" value=\"" . $params['clientdetails']['email'] . "\">\n<input type=\"hidden\" name=\"address\" value=\"" . $params['clientdetails']['address1'] . "\n" . $params['clientdetails']['city'] . "\n" . $params['clientdetails']['state'] . "\">\n<input type=\"hidden\" name=\"postcode\" value=\"" . $params['clientdetails']['postcode'] . "\">\n<input type=\"hidden\" name=\"country\" value=\"" . $params['clientdetails']['country'] . "\">\n<input type=\"hidden\" name=\"tel\" value=\"" . $params['clientdetails']['phonenumber'] . "\">\n<input type=\"hidden\" name=\"hideCurrency\" value=\"true\">\n<INPUT TYPE=\"hidden\" NAME=\"MC_callback\" VALUE=\"" . $params['systemurl'] . "/modules/gateways/callback/worldpayfuturepay.php\">\n<INPUT TYPE=\"hidden\" NAME=\"successURL\" VALUE=\"" . $params['systemurl'] . "/viewinvoice.php?id=" . $params['invoiceid'] . "&paymentsuccess=true\">\n<INPUT TYPE=\"hidden\" NAME=\"failureURL\" VALUE=\"" . $params['systemurl'] . "/viewinvoice.php?id=" . $params['invoiceid'] . "&paymentfailed=true\">";
        if( $params['authmode'] == 'on' )
        {
            $code .= "\n<input type=\"hidden\" name=\"authMode\" value=\"A\">";
        }
        $code .= "\n<input type=\"submit\" value=\"" . $params['langpaynow'] . "\">\n</FORM>\n        ";
    }
    return $code;
}
function worldpayfuturepay_capture($params)
{
    $installationid = $params['installationidcharges'];
    $authpw = $params['authpw'];
    $url = $params['testmode'] ? "https://secure-test.worldpay.com/wcc/iadmin" : "https://secure.worldpay.com/wcc/iadmin";
    $qrystring = "instId=" . $installationid;
    $qrystring .= "&authPW=" . $authpw;
    $qrystring .= "&futurePayId=" . $params['gatewayid'];
    $qrystring .= "&amount=" . $params['amount'];
    $qrystring .= "&op-paymentLFP=";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $qrystring);
    $gatewayresult = curl_exec($ch);
    curl_close($ch);
    $returndata = explode(',', $gatewayresult);
    $returndata[] = $invoiceid;
    if( substr($gatewayresult, 0, 1) == 'Y' )
    {
        $returndata = explode(',', $gatewayresult);
        return array( 'status' => 'success', 'transid' => $returndata[1], 'rawdata' => $returndata );
    }
    return array( 'status' => 'failed', 'rawdata' => $returndata );
}
function worldpayfuturepay_adminstatusmsg($vars)
{
    $futurepayid = get_query_val('tblclients', 'gatewayid', array( 'id' => $vars['userid'] ));
    if( $futurepayid )
    {
        return array( 'type' => 'info', 'title' => "FuturePay Agreement ID", 'msg' => "This customer has a WorldPay FuturePay Agreement setup for automated billing with ID " . $futurepayid );
    }
}