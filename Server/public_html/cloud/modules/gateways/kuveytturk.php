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
$GATEWAYMODULE['kuveytturkname'] = 'kuveytturk';
$GATEWAYMODULE['kuveytturkvisiblename'] = "Kuveytturk Bank";
$GATEWAYMODULE['kuveytturktype'] = 'CC';
function kuveytturk_activate()
{
    defineGatewayField('kuveytturk', 'text', 'merchantid', '', "Merchant ID", '20', '');
    defineGatewayField('kuveytturk', 'text', 'merchantpw', '', "Merchant Password", '20', '');
    defineGatewayField('kuveytturk', 'text', 'merchantnumber', '', "Merchant Number", '20', '');
    defineGatewayField('kuveytturk', 'text', 'isokod', '', "Isokod 949 YTL - 840 USD", '10', '');
}
function kuveytturk_capture($params)
{
    $gateway_url = "https://netpos.kuveytturk.com.tr/servlet/cc5ApiServer";
    $name = $params['merchantid'];
    $password = $params['merchantpw'];
    $clientid = $params['merchantnumber'];
    $isokod = $params['isokod'];
    $ip = GetHostByName($REMOTE_ADDR);
    $type = 'Auth';
    $email = $params['clientdetails']['email'];
    $oid = $params['invoiceid'];
    $ccno = $params['cardnum'];
    $ccay = substr($params['cardexp'], 0, 2);
    $ccyil = substr($params['cardexp'], 2, 2);
    $tutar = $params['amount'];
    $cv2 = $params['cccvv'];
    $fname = $params['clientdetails']['firstname'];
    $lname = $params['clientdetails']['lastname'];
    $firma = $params['clientdetails']['companyname'];
    $adres1 = $params['clientdetails']['address1'];
    $adres2 = $params['clientdetails']['address2'];
    $ilce = $params['clientdetails']['city'];
    $sehir = $params['clientdetails']['state'];
    $postkod = $params['clientdetails']['postcode'];
    $ulke = $params['clientdetails']['country'];
    $telno = $params['clientdetails']['phonenumber'];
    $request = "DATA=<?xml version=\"1.0\" encoding=\"ISO-8859-9\"?>\n<CC5Request>\n<Name>{NAME}</Name>\n<Password>{PASSWORD}</Password>\n<ClientId>{CLIENTID}</ClientId>\n<IPAddress>{IP}</IPAddress>\n<Email>{EMAIL}</Email>\n<Mode>P</Mode>\n<OrderId>{OID}</OrderId>\n<GroupId></GroupId>\n<TransId></TransId>\n<UserId></UserId>\n<Type>{TYPE}</Type>\n<Number>{CCNO}</Number>\n<Expires>{CCAY}/{CCYIL}</Expires>\n<Cvv2Val>{CV2}</Cvv2Val>\n<Total>{TUTAR}</Total>\n<Currency>949</Currency>\n<Taksit></Taksit>\n<BillTo>\n<Name></Name>\n<Street1></Street1>\n<Street2></Street2>\n<Street3></Street3>\n<City></City>\n<StateProv></StateProv>\n<PostalCode></PostalCode>\n<Country></Country>\n<Company></Company>\n<TelVoice></TelVoice>\n</BillTo>\n<ShipTo>\n<Name></Name>\n<Street1></Street1>\n<Street2></Street2>\n<Street3></Street3>\n<City></City>\n<StateProv></StateProv>\n<PostalCode></PostalCode>\n<Country></Country>\n</ShipTo>\n<Extra></Extra>\n</CC5Request>\n";
    $request = str_replace("{NAME}", $name, $request);
    $request = str_replace("{PASSWORD}", $password, $request);
    $request = str_replace("{CLIENTID}", $clientid, $request);
    $request = str_replace("{ISOKOD}", $isokod, $request);
    $request = str_replace("{TYPE}", $type, $request);
    $request = str_replace("{IP}", $ip, $request);
    $request = str_replace("{OID}", $oid, $request);
    $request = str_replace("{EMAIL}", $email, $request);
    $request = str_replace("{CCNO}", $ccno, $request);
    $request = str_replace("{CCAY}", $ccay, $request);
    $request = str_replace("{CCYIL}", $ccyil, $request);
    $request = str_replace("{CV2}", $cv2, $request);
    $request = str_replace("{TUTAR}", $tutar, $request);
    $request = str_replace("{FNAME}", $fname, $request);
    $request = str_replace("{LNAME}", $lname, $request);
    $request = str_replace("{ADRES1}", $adres1, $request);
    $request = str_replace("{ADRES2}", $adres2, $request);
    $request = str_replace("{ILCE}", $ilce, $request);
    $request = str_replace("{SEHIR}", $sehir, $request);
    $request = str_replace("{POSTKOD}", $postkod, $request);
    $request = str_replace("{ULKE}", $ulke, $request);
    $request = str_replace("{TELNO}", $telno, $request);
    $request = str_replace("{FIRMA}", $firma, $request);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $gateway_url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 90);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    $result = curl_exec($ch);
    if( curl_errno($ch) )
    {
        $error = curl_error($ch);
        logTransaction("Garanti Sanal Pos", "Error => " . $error, 'Error');
        sendMessage("Credit Card Payment Failed", $params['invoiceid']);
        $result = 'error';
        return $result;
    }
    curl_close($ch);
    $Response = '';
    $OrderId = '';
    $AuthCode = '';
    $ProcReturnCode = '';
    $ErrMsg = '';
    $HOSTMSG = '';
    $response_tag = 'Response';
    $posf = strpos($result, "<" . $response_tag . ">");
    $posl = strpos($result, "</" . $response_tag . ">");
    $posf = $posf + strlen($response_tag) + 2;
    $Response = substr($result, $posf, $posl - $posf);
    $response_tag = 'OrderId';
    $posf = strpos($result, "<" . $response_tag . ">");
    $posl = strpos($result, "</" . $response_tag . ">");
    $posf = $posf + strlen($response_tag) + 2;
    $OrderId = substr($result, $posf, $posl - $posf);
    $response_tag = 'AuthCode';
    $posf = strpos($result, "<" . $response_tag . ">");
    $posl = strpos($result, "</" . $response_tag . ">");
    $posf = $posf + strlen($response_tag) + 2;
    $AuthCode = substr($result, $posf, $posl - $posf);
    $response_tag = 'ProcReturnCode';
    $posf = strpos($result, "<" . $response_tag . ">");
    $posl = strpos($result, "</" . $response_tag . ">");
    $posf = $posf + strlen($response_tag) + 2;
    $ProcReturnCode = substr($result, $posf, $posl - $posf);
    $response_tag = 'ErrMsg';
    $posf = strpos($result, "<" . $response_tag . ">");
    $posl = strpos($result, "</" . $response_tag . ">");
    $posf = $posf + strlen($response_tag) + 2;
    $ErrMsg = substr($result, $posf, $posl - $posf);
    $debugdata = "Action => Auth\nClient => " . $params['clientdetails']['firstname'] . " " . $params['clientdetails']['lastname'] . "\nResponse => " . $Response . "\nOrderId => " . $OrderId . "\nAuthCode => " . $AuthCode . "\nProcReturnCode => " . $ProcReturnCode . "\nErrMsg => " . $ErrMsg;
    if( $Response === 'Approved' )
    {
        return array( 'status' => 'success', 'transid' => $transid, 'rawdata' => $debugdata );
    }
    return array( 'status' => 'declined', 'rawdata' => $debugdata );
}