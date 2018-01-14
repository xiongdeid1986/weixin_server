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
function maxmind_MetaData()
{
    return array( 'DisplayName' => 'MaxMind', 'APIVersion' => "1.1" );
}
function maxmind_getConfigArray()
{
    $configarray = array( 'Enable' => array( 'Type' => 'yesno', 'Description' => "Tick to enable MaxMind Fraud Checking for Orders" ), "MaxMind License Key" => array( 'Type' => 'text', 'Size' => '30', 'Description' => "Don't have an account? <a href=\"http://nullrefer.com/?http://go.whmcs.com/78/maxmind\" target=\"_blank\">Click here to signup &raquo;</a>" ), "Service Type" => array( 'Type' => 'dropdown', 'Options' => implode(',', array( 'Standard', 'Premium' )), 'Description' => "Select the MaxMind service type you wish to use; Select Standard if you are unsure" ), "Reject Free Email Service" => array( 'Type' => 'yesno', 'Description' => "Block orders from free email addresses such as Hotmail & Yahoo!" ), "Reject Country Mismatch" => array( 'Type' => 'yesno', 'Description' => "Block orders where order address is different from IP Location" ), "Reject Anonymous Proxy" => array( 'Type' => 'yesno', 'Description' => "Block orders where the user is ordering through a Proxy" ), "Reject High Risk Country" => array( 'Type' => 'yesno', 'Description' => "Block orders from high risk countries" ), "MaxMind Fraud Risk Score" => array( 'Type' => 'text', 'Size' => '2', 'Description' => "Higher than this value and the order will be blocked" ), "Use New Risk Score" => array( 'Type' => 'yesno', 'Description' => "Tick to use new riskScore which ranges from 0 to 100" ), "Do Not Include City" => array( 'Type' => 'yesno', 'Description' => "Tick to not send the City of the client with a Fraud check" ) );
    return $configarray;
}
function maxmind_doFraudCheck($params, $checkonly = false)
{
    global $_LANG;
    global $cc_encryption_hash;
    $phonecc = $params['clientsdetails']['countrycode'];
    $phonenumber = $params['clientsdetails']['phonenumber'];
    if( $phonecc == '44' && substr($phonenumber, 0, 1) == '0' )
    {
        $phonenumber = substr($phonenumber, 1);
    }
    $phonecclen = strlen($phonecc);
    if( substr($phonenumber, 0, $phonecclen) == $phonecc )
    {
        $phonenumber = "+" . $phonenumber;
    }
    else
    {
        $phonenumber = "+" . $phonecc . $phonenumber;
    }
    $emaildomain = explode("@", $params['clientsdetails']['email'], 2);
    $emaildomain = $emaildomain[1];
    $cchash = md5($cc_encryption_hash . $params['clientsdetails']['userid']);
    $cardnum = get_query_val('tblclients', "AES_DECRYPT(cardnum,'" . $cchash . "') as cardnum", array( 'id' => $params['clientsdetails']['userid'] ));
    $url = "https://minfraud3.maxmind.com/app/ccv2r";
    $postfields = array(  );
    $postfields['license_key'] = $params["MaxMind License Key"];
    $postfields['requested_type'] = isset($params["Service Type"]) && $params["Service Type"] == 'Premium' ? 'premium' : 'standard';
    $postfields['i'] = $params['ip'];
    $postfields['EmailMD5'] = md5($params['clientsdetails']['email']);
    $postfields['PasswordMD5'] = md5($params['clientsdetails']['password']);
    $postfields['region'] = $params['clientsdetails']['state'];
    $postfields['postal'] = $params['clientsdetails']['postcode'];
    $postfields['country'] = $params['clientsdetails']['country'];
    $postfields['domain'] = $emaildomain;
    $postfields['custPhone'] = $phonenumber;
    if( $cardnum )
    {
        $postfields['bin'] = substr($cardnum, 0, 6);
    }
    $postfields['shipAddr'] = $params['clientsdetails']['address1'];
    $postfields['shipRegion'] = $params['clientsdetails']['state'];
    $postfields['shipPostal'] = $params['clientsdetails']['postcode'];
    $postfields['shipCountry'] = $params['clientsdetails']['country'];
    $postfields['txnID'] = $_SESSION['orderdetails']['OrderID'];
    $postfields['sessionID'] = session_id();
    $postfields['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $postfields['accept_language'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    if( empty($params["Do Not Include City"]) )
    {
        $postfields['city'] = $params['clientsdetails']['city'];
        $postfields['shipCity'] = $params['clientsdetails']['city'];
    }
    if( $_SERVER['HTTP_X_FORWARDED_FOR'] )
    {
        $postfields['forwardedIP'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    $content = curlCall($url, $postfields);
    if( substr($content, 0, 10) == "CURL Error" )
    {
        $results['err'] = $content;
    }
    else
    {
        if( !$content )
        {
            $results['err'] = "No Response Received";
        }
        else
        {
            $results = array(  );
            $keyvaluepairs = explode(';', $content);
            foreach( $keyvaluepairs as $v )
            {
                $v = explode("=", $v);
                $results[$v[0]] = $v[1];
            }
        }
    }
    logModuleCall('MaxMind', 'FraudCheck', $postfields, $content, $results, array( $params["MaxMind License Key"] ));
    if( $checkonly )
    {
        return $results;
    }
    if( !empty($params["Do Not Include City"]) && in_array($results['err'], array( 'CITY_REQUIRED', 'CITY_NOT_FOUND' )) )
    {
        unset($results['err']);
    }
    if( !empty($results['err']) )
    {
        $results['error']['title'] = $_LANG['maxmind_title'] . " " . $_LANG['maxmind_error'];
        switch( $results['err'] )
        {
            case 'INVALID_LICENSE_KEY':
            case 'IP_REQUIRED':
                break;
            case 'MAX_REQUESTS_REACHED':
                break;
            case 'LICENSE_REQUIRED':
                break;
            case 'INVALID_EMAIL_MD5':
                $results['error']['description'] = $_LANG['maxmind_checkconfiguration'];
                break;
            case 'COUNTRY_NOT_FOUND':
                break;
            case 'CITY_NOT_FOUND':
                break;
            case 'CITY_REQUIRED':
                break;
            case 'POSTAL_CODE_NOT_FOUND':
                break;
            case 'POSTAL_CODE_REQUIRED':
                $results['error']['description'] = $_LANG['maxmind_addressinvalid'];
                break;
            case 'IP_NOT_FOUND':
                $results['error']['description'] = $_LANG['maxmind_invalidip'];
                break;
            default:
                $results['error']['description'] = $_LANG['maxmind_checkconfiguration'];
                break;
        }
    }
    else
    {
        if( $params["Reject Free Email Service"] == 'on' && $results['freeMail'] == 'Yes' )
        {
            $results['error']['title'] = $_LANG['maxmind_title'] . " " . $_LANG['maxmind_error'];
            $results['error']['description'] = $_LANG['maxmind_rejectemail'];
        }
        if( $params["Reject Country Mismatch"] == 'on' && $results['countryMatch'] == 'No' )
        {
            $results['error']['title'] = $_LANG['maxmind_title'] . " " . $_LANG['maxmind_error'];
            $results['error']['description'] = $_LANG['maxmind_countrymismatch'];
        }
        if( $params["Reject Anonymous Proxy"] == 'on' && $results['anonymousProxy'] == 'Yes' )
        {
            $results['error']['title'] = $_LANG['maxmind_title'] . " " . $_LANG['maxmind_error'];
            $results['error']['description'] = $_LANG['maxmind_anonproxy'];
        }
        if( $params["Reject High Risk Country"] == 'on' && $results['highRiskCountry'] == 'Yes' )
        {
            $results['error']['title'] = $_LANG['maxmind_title'] . " " . $_LANG['maxmind_error'];
            $results['error']['description'] = $_LANG['maxmind_highriskcountry'];
        }
        $score = $params["Use New Risk Score"] ? $results['riskScore'] : $results['score'];
        if( $params["MaxMind Fraud Risk Score"] != '' && $params["MaxMind Fraud Risk Score"] < $score )
        {
            $results['error']['title'] = $_LANG['maxmind_title'] . " " . $_LANG['maxmind_error'];
            $results['error']['description'] = $_LANG['maxmind_highfraudriskscore'];
        }
    }
    return $results;
}
function maxmind_processResultsForDisplay($params)
{
    $results = explode("\n", $params['data']);
    $descarray = array(  );
    $descarray['distance'] = "Distance from IP address to Address";
    $descarray['countryMatch'] = "If Country of IP address matches Address";
    $descarray['countryCode'] = "Country Code of the IP address";
    $descarray['freeMail'] = "Whether e-mail is from free e-mail provider";
    $descarray['anonymousProxy'] = "Whether IP address is Anonymous Proxy";
    $descarray['score'] = "Old Fraud Risk Score";
    $descarray['proxyScore'] = "Likelihood of IP Address being an Open Proxy";
    $descarray['riskScore'] = "New Risk Score Rating";
    $descarray['ip_city'] = "Estimated City of the IP address";
    $descarray['ip_region'] = "Estimated State/Region of the IP address";
    $descarray['ip_latitude'] = "Estimated Latitude of the IP address";
    $descarray['ip_longitude'] = "Estimated Longitude of the IP address";
    $descarray['ip_isp'] = "ISP of the IP address";
    $descarray['ip_org'] = "Organization of the IP address";
    $descarray['custPhoneInBillingLoc'] = "Customer Phone in Billing Location";
    $descarray['highRiskCountry'] = "IP address or billing address in high risk country";
    $descarray['cityPostalMatch'] = "Whether billing city and state match zipcode";
    $descarray['carderEmail'] = "Whether e-mail is in database of high risk e-mails";
    $descarray['maxmindID'] = "MaxMind ID";
    $descarray['err'] = "MaxMind Error";
    $descarray['explanation'] = 'Explanation';
    $values = array(  );
    foreach( $results as $value )
    {
        $result = explode(" => ", $value, 2);
        $result[1] = str_replace(array( "http://www.maxmind.com/app/ccv2r_signup", "https://www.maxmind.com/app/ccv2r_signup" ), array( "http://www.maxmind.com/app/ccfd_promo?promo=WHMCS4562", "https://www.maxmind.com/app/ccfd_promo?promo=WHMCS4562" ), $result[1]);
        $values[$result[0]] = $result[1];
    }
    $resultarray = array(  );
    foreach( $descarray as $k => $v )
    {
        if( $k == 'riskScore' && $values[$k] )
        {
            $values[$k] .= "%";
        }
        $resultarray[$v] = $values[$k];
    }
    if( $values['curl_error'] )
    {
        $resultarray = array( "Connection Error" => $values['curl_error'] );
    }
    return $resultarray;
}