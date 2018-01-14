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
if( !function_exists('RegSaveNameservers') )
{
    require(ROOTDIR . "/includes/registrarfunctions.php");
}
if( $domainid )
{
    $where = array( 'id' => $domainid );
}
else
{
    $where = array( 'domain' => $domain );
}
$result = select_query('tbldomains', 'id,domain,registrar,registrationperiod', $where);
$data = mysql_fetch_array($result);
$domainid = $data[0];
if( !$domainid )
{
    $apiresults = array( 'result' => 'error', 'message' => "Domain ID Not Found" );
    return false;
}
if( !($ns1 && $ns2) )
{
    $apiresults = array( 'result' => 'error', 'message' => "ns1 and ns2 required" );
    return false;
}
$domain = $data['domain'];
$registrar = $data['registrar'];
$regperiod = $data['registrationperiod'];
$domainparts = explode(".", $domain, 2);
$params = array(  );
$params['domainid'] = $domainid;
$params['sld'] = $domainparts[0];
$params['tld'] = $domainparts[1];
$params['regperiod'] = $regperiod;
$params['registrar'] = $registrar;
$params['ns1'] = $ns1;
$params['ns2'] = $ns2;
$params['ns3'] = $ns3;
$params['ns4'] = $ns4;
$params['ns5'] = $ns5;
$values = RegSaveNameservers($params);
if( $values['error'] )
{
    $apiresults = array( 'result' => 'error', 'message' => "Registrar Error Message", 'error' => $values['error'] );
    return false;
}
if( !$values )
{
    $values = array(  );
}
$apiresults = array_merge(array( 'result' => 'success' ), $values);