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
function trustcommerce_config()
{
    $configarray = array( 'FriendlyName' => array( 'Type' => 'System', 'Value' => 'TrustCommerce' ), 'username' => array( 'FriendlyName' => "Customer ID", 'Type' => 'text', 'Size' => '20', 'Description' => "Your customer ID number assigned to you by TrustCommerce" ), 'password' => array( 'FriendlyName' => "Password for Customer ID", 'Type' => 'text', 'Size' => '20', 'Description' => "The password for your custid as assigned by TrustCommerce" ), 'testmode' => array( 'FriendlyName' => "Test Mode", 'Type' => 'yesno', 'Description' => "When set, the transaction will be a test transaction only" ) );
    return $configarray;
}
function trustcommerce_capture($params)
{
    if( !extension_loaded('tclink') )
    {
        $extfname = "tclink.so";
        if( !dl($extfname) )
        {
            $msg = "Please check to make sure the module TCLink is properly built";
            return array( 'status' => 'error', 'rawdata' => array( 'error' => $msg ) );
        }
    }
    $tc_params = array( 'action' => 'sale' );
    $tc_params['custid'] = $params['username'];
    $tc_params['password'] = $params['password'];
    $tc_params['demo'] = $params['testmode'] ? 'y' : 'n';
    $tc_params['ticket'] = $params['invoiceid'];
    $tc_params['amount'] = $params['amount'] * 100;
    $tc_params['name'] = $params['clientdetails']['firstname'] . " " . $params['clientdetails']['lastname'];
    $tc_params['email'] = $params['clientdetails']['email'];
    $tc_params['address1'] = $params['clientdetails']['address1'];
    $tc_params['address2'] = $params['clientdetails']['address2'];
    $tc_params['city'] = $params['clientdetails']['city'];
    $tc_params['state'] = $params['clientdetails']['state'];
    $tc_params['zip'] = $params['clientdetails']['postcode'];
    $tc_params['country'] = $params['clientdetails']['country'];
    $tc_params['phone'] = $params['clientdetails']['phone'];
    $tc_params['cc'] = $params['cardnum'];
    $tc_params['exp'] = $params['cardexp'];
    $tc_params['avs'] = 'n';
    $tc_result = tclink_send($tc_params);
    if( $tc_result['status'] == 'approved' || $tc_result['status'] == 'accepted' )
    {
        $result = array( 'status' => 'success', 'transid' => $tc_result['transid'], 'rawdata' => $tc_result );
    }
    else
    {
        if( $tc_result['status'] == 'decline' || $tc_result['status'] == 'rejected' )
        {
            $result = array( 'status' => 'declined', 'rawdata' => $tc_result );
        }
        else
        {
            if( $tc_result['status'] == 'baddata' )
            {
                $result = array( 'status' => 'baddata', 'rawdata' => $tc_result );
            }
            else
            {
                $result = array( 'status' => 'error', 'rawdata' => $tc_result );
            }
        }
    }
    return $result;
}
function trustcommerce_refund($params)
{
    if( !extension_loaded('tclink') )
    {
        $extfname = "tclink.so";
        if( !dl($extfname) )
        {
            $msg = "Please check to make sure the module TCLink is properly built";
            return array( 'status' => 'error', 'rawdata' => array( 'error' => $msg ) );
        }
    }
    $tc_params = array( 'action' => 'credit' );
    $tc_params['custid'] = $params['username'];
    $tc_params['password'] = $params['password'];
    $tc_params['demo'] = $params['testmode'] ? 'y' : 'n';
    $tc_params['transid'] = $params['transid'];
    $tc_params['amount'] = $params['amount'] * 100;
    $tc_result = tclink_send($tc_params);
    if( $tc_result['status'] == 'approved' || $tc_result['status'] == 'accepted' )
    {
        $result = array( 'status' => 'success', 'transid' => $tc_result['transid'], 'rawdata' => $tc_result );
    }
    else
    {
        if( $tc_result['status'] == 'decline' || $tc_result['status'] == 'rejected' )
        {
            $result = array( 'status' => 'declined', 'rawdata' => $tc_result );
        }
        else
        {
            if( $tc_result['status'] == 'baddata' )
            {
                $result = array( 'status' => 'baddata', 'rawdata' => $tc_result );
            }
            else
            {
                $result = array( 'status' => 'error', 'rawdata' => $tc_result );
            }
        }
    }
    return $result;
}