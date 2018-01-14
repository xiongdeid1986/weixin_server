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
require(dirname(__FILE__) . "/../../../init.php");
require(ROOTDIR . "/includes/registrarfunctions.php");
$cronreport = "Internet.bs Domain Sync Report<br>\n---------------------------------------------------<br>\n";
$params = getregistrarconfigoptions('internetbs');
$postfields = array(  );
$postfields['ApiKey'] = $params['Username'];
$postfields['Password'] = $params['Password'];
$postfields['ResponseFormat'] = 'TEXT';
$postfields['CompactList'] = 'no';
$testMode = trim(strtolower($params['TestMode'])) === 'on';
$SyncNextDueDate = trim(strtolower($params['SyncNextDueDate'])) === 'on';
if( $testMode )
{
    $url = "https://testapi.internet.bs/domain/list";
}
else
{
    $url = "https://api.internet.bs/domain/list";
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, "WHMCS Internet.bs Corp. Expiry Sync Robot");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
$data = curl_exec($ch);
$curl_err = false;
if( curl_error($ch) )
{
    $curl_err = "CURL Error: " . curl_errno($ch) . " - " . curl_error($ch);
    exit( "CURL Error: " . curl_errno($ch) . " - " . curl_error($ch) );
}
curl_close($ch);
if( $curl_err )
{
    $cronreport .= "Error connecting to API: " . $curl_err;
}
else
{
    $result = parseresult($data);
    if( !$result )
    {
        $cronreport .= "Error connecting to API:<br>" . nl2br($data) . "<br>";
    }
    else
    {
        $queryresult = select_query('tbldomains', 'domain', "registrar='internetbs' AND (status='Pending Transfer' OR status='Active')");
        while( $data = mysql_fetch_array($queryresult) )
        {
            $domainname = trim(strtolower($data['domain']));
            if( isset($result[$domainname]) )
            {
                $expirydate = date('Y-m-d', $result[$domainname]['expiry']);
                $status = $result[$domainname]['status'];
                if( $status == 'ok' )
                {
                    update_query('tbldomains', array( 'status' => 'Active' ), array( 'domain' => $domainname ));
                }
                if( $expirydate )
                {
                    update_query('tbldomains', array( 'expirydate' => $expirydate ), array( 'domain' => $domainname ));
                    if( $SyncNextDueDate )
                    {
                        update_query('tbldomains', array( 'nextduedate' => $expirydate ), array( 'domain' => $domainname ));
                    }
                    $cronreport .= "Updated " . $domainname . " expiry to " . frommysqldate($expirydate) . "<br>";
                }
            }
            else
            {
                $cronreport .= "ERROR: " . $domainname . " -  Domain does not appear in the account at Internet.bs.<br>";
            }
        }
    }
}
logactivity("Internet.bs Domain Sync Run");
sendadminnotification('system', "WHMCS Internet.bs Domain Syncronisation Report", $cronreport);
/**
 * gets expiration date from domain list command
 * @param string $data - command TEXT response
 * @return array - associative array having as key the domain name and as value the expiration date
 */
function parseResult($data)
{
    $result = array(  );
    $data = strtolower($data);
    $arr = explode("\n", $data);
    $totalDomains = 0;
    $assocArr = array(  );
    foreach( $arr as $str )
    {
        list($varName, $value) = explode("=", $str);
        $varName = trim($varName);
        $value = trim($value);
        if( $varName == 'domaincount' )
        {
            $totalDomains = intval($value);
        }
        $assocArr[$varName] = $value;
    }
    if( $assocArr['status'] != 'success' )
    {
        return false;
    }
    for( $i = 0; $i < $totalDomains; $i++ )
    {
        list($y, $m, $d) = explode('/', $assocArr['domain_' . $i . '_expiration']);
        $status = strtolower($assocArr['domain_' . $i . '_status']);
        $ddat = array( 'expiry' => mktime(0, 0, 0, $m, $d, $y), 'status' => $status );
        $result[strtolower($assocArr['domain_' . $i . '_name'])] = $ddat;
        if( isset($assocArr['domain_' . $i . '_punycode']) )
        {
            $result[strtolower($assocArr['domain_' . $i . '_punycode'])] = $ddat;
        }
    }
    return $result;
}