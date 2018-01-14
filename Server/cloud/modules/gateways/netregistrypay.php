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
$GATEWAYMODULE = array( 'netregistrypayname' => 'netregistrypay', 'netregistrypayvisiblename' => "Netregistry Pay", 'netregistrypaytype' => 'CC' );
function netregistrypay_activate()
{
    defineGatewayField('netregistrypay', 'text', 'merchantid', '', "Merchant ID (MID) number", '20', '');
    defineGatewayField('netregistrypay', 'text', 'externalpassword', '', "External access password", '20', '');
}
function netregistrypay_capture($params)
{
    $gatewayusername = $params['merchantid'];
    $gatewaypassword = $params['externalpassword'];
    $invoiceid = $params['invoiceid'];
    $amount = $params['amount'];
    $currency = $params['currency'];
    $firstname = $params['clientdetails']['firstname'];
    $lastname = $params['clientdetails']['lastname'];
    $email = $params['clientdetails']['email'];
    $address1 = $params['clientdetails']['address1'];
    $address2 = $params['clientdetails']['address2'];
    $city = $params['clientdetails']['city'];
    $state = $params['clientdetails']['state'];
    $postcode = $params['clientdetails']['postcode'];
    $country = $params['clientdetails']['country'];
    $phone = $params['clientdetails']['phone'];
    $cardtype = $params['cardtype'];
    $cardnumber = $params['cardnum'];
    $cardexpiry = $params['cardexp'];
    $cardstart = $params['cardstart'];
    $cardissuenum = $params['cardissuenum'];
    $txnref = 'Unknown';
    $params = array( 'COMMAND' => 'purchase', 'LOGIN' => $gatewayusername . '/' . $gatewaypassword, 'AMOUNT' => number_format($amount, 2, ".", ''), 'CCNUM' => $cardnumber, 'CCEXP' => substr($cardexpiry, 0, 2) . '/' . substr($cardexpiry, 2, 3), 'COMMENT' => $firstname . $lastname . " WHMCS Invoice ID:" . $invoiceid );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://paygate.ssllock.net/external2.pl");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    if( isset($result) )
    {
        $exploded_result = explode("\n", $result);
        if( $exploded_result[0] == 'approved' )
        {
            $success = true;
            foreach( $exploded_result as $result )
            {
                if( strpos($result, 'txn_ref') !== false )
                {
                    $txnref = substr($result, strpos($result, "=") + 1, strlen($result));
                }
            }
        }
        else
        {
            if( $exploded_result[0] == 'declined' )
            {
                $declined = true;
            }
        }
    }
    if( isset($success) && $success )
    {
        return array( 'status' => 'success', 'transid' => $txnref, 'rawdata' => $result );
    }
    if( isset($declined) && $declined )
    {
        return array( 'status' => 'declined', 'rawdata' => $result );
    }
    return array( 'status' => 'error', 'rawdata' => $result );
}