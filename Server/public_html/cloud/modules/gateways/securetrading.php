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
function securetrading_config()
{
    $configarray = array( 'FriendlyName' => array( 'Type' => 'System', 'Value' => 'SecureTrading' ), 'username' => array( 'FriendlyName' => 'Username', 'Type' => 'text', 'Size' => '20' ), 'password' => array( 'FriendlyName' => 'Password', 'Type' => 'text', 'Size' => '20' ), 'siteref' => array( 'FriendlyName' => "Site Reference", 'Type' => 'text', 'Size' => '20' ) );
    return $configarray;
}
function securetrading_capture($params)
{
    $gatewayusername = $params['username'];
    $gatewaypassword = $params['password'];
    $gatewaysiteref = $params['siteref'];
    $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<requestblock version=\"3.67\">\n<alias>" . $gatewayusername . "</alias>\n<request type=\"AUTH\">\n<operation>\n<sitereference>" . $gatewaysiteref . "</sitereference>\n<accounttypedescription>ECOM</accounttypedescription>\n</operation>\n<merchant>\n<orderreference>" . $params['invoiceid'] . "</orderreference>\n</merchant>\n<customer>\n<delivery/>\n<name>" . $params['clientdetails']['firstname'] . " " . $params['clientdetails']['lastname'] . "</name>\n<email>" . $params['clientdetails']['email'] . "</email>\n<ip>" . $_SERVER['REMOTE_ADDR'] . "</ip>\n</customer>\n<billing>\n<amount currencycode=\"" . $params['currency'] . "\">" . $params['amount'] * 100 . "</amount>\n<premise>" . $params['clientdetails']['address1'] . "</premise>\n<street>" . $params['clientdetails']['address2'] . "</street>\n<town>" . $params['clientdetails']['city'] . "</town>\n<county>" . $params['clientdetails']['state'] . "</county>\n<country>" . $params['clientdetails']['country'] . "</country>\n<postcode>" . $params['clientdetails']['postcode'] . "</postcode>\n<email>" . $params['clientdetails']['email'] . "</email>\n<payment type=\"" . strtoupper($params['cardtype']) . "\">\n<expirydate>" . substr($params['cardexp'], 0, 2) . '/20' . substr($params['cardexp'], 2, 2) . "</expirydate>\n<pan>" . $params['cardnum'] . "</pan>\n<securitycode>" . $params['cccvv'] . "</securitycode>\n</payment>\n<name>\n<middle> </middle>\n<last>" . $params['clientdetails']['lastname'] . "</last>\n<first>" . $params['clientdetails']['firstname'] . "</first>\n</name>\n</billing>\n<settlement/>\n</request>\n</requestblock>";
    $authstr = "Basic " . base64_encode($gatewayusername . ":" . $gatewaypassword);
    $headers = array( "HTTP/1.1", "Host: webservices.securetrading.net", "Accept: text/xml", "Authorization: " . $authstr, "User-Agent: WHMCS Gateway Module", "Content-type: text/xml;charset=\"utf-8\"", "Content-length: " . strlen($xml), "Connection: close" );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://webservices.securetrading.net:443/xml/");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_USERPWD, $gatewayusername . ":" . $gatewaypassword);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $data = curl_exec($ch);
    curl_close($ch);
    $xmldata = XMLtoArray($data);
    if( $xmldata['RESPONSEBLOCK']['RESPONSE']['ERROR']['CODE'] == '0' )
    {
        $results['transid'] = $xmldata['RESPONSEBLOCK']['RESPONSE']['TRANSACTIONREFERENCE'];
        return array( 'status' => 'success', 'transid' => $results['transid'], 'rawdata' => $data );
    }
    if( $xmldata['RESPONSEBLOCK']['RESPONSE']['ERROR']['CODE'] == '99999' )
    {
        $results['status'] = 'error';
        return array( 'status' => 'error', 'rawdata' => $data );
    }
    return array( 'status' => 'declined', 'rawdata' => $data );
}
function securetrading_refund($params)
{
    $gatewayusername = $params['username'];
    $gatewaypassword = $params['password'];
    $gatewaysiteref = $params['siteref'];
    $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?><requestblock version=\"3.67\"><alias>" . $gatewayusername . "</alias><request type=\"REFUND\"> <merchant> <orderreference>" . $params['invoiceid'] . "</orderreference> </merchant> <operation> <sitereference>" . $gatewaysiteref . "</sitereference> <parenttransactionreference>" . $params['transid'] . "</parenttransactionreference> </operation> <billing> <amount currencycode=\"" . $params['currency'] . "\">" . $params['amount'] * 100 . "</amount> </billing> </request> </requestblock>";
    $authstr = "Basic " . base64_encode($gatewayusername . ":" . $gatewaypassword);
    $headers = array( "HTTP/1.1", "Host: webservices.securetrading.net", "Accept: text/xml", "Authorization: " . $authstr, "User-Agent: WHMCS Gateway Module", "Content-type: text/xml;charset=\"utf-8\"", "Content-length: " . strlen($xml), "Connection: close" );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://webservices.securetrading.net:443/xml/");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_USERPWD, $gatewayusername . ":" . $gatewaypassword);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $data = curl_exec($ch);
    curl_close($ch);
    $xmldata = XMLtoArray($data);
    if( $xmldata['RESPONSEBLOCK']['RESPONSE']['ERROR']['CODE'] == '0' )
    {
        $results['transid'] = $xmldata['RESPONSEBLOCK']['RESPONSE']['TRANSACTIONREFERENCE'];
        return array( 'status' => 'success', 'transid' => $results['transid'], 'rawdata' => $data );
    }
    if( $xmldata['RESPONSEBLOCK']['RESPONSE']['ERROR']['CODE'] == '99999' )
    {
        $results['status'] = 'error';
        return array( 'status' => 'error', 'rawdata' => $data );
    }
    return array( 'status' => 'declined', 'rawdata' => $data );
}