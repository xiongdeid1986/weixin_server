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
function cloudmin_ConfigOptions()
{
    global $packageconfigoption;
    $imagesresult = '';
    if( $packageconfigoption[6] )
    {
        $result = select_query('tblservers', '', array( 'type' => 'cloudmin', 'active' => '1' ));
        $data = mysql_fetch_array($result);
        $params['serverip'] = $data['ipaddress'];
        $params['serverhostname'] = $data['hostname'];
        $params['serverusername'] = $data['username'];
        $params['serverpassword'] = decrypt($data['password']);
        $params['serveraccesshash'] = $data['accesshash'];
        $params['serversecure'] = $data['secure'];
        if( $params['serverusername'] )
        {
            $postfields = array(  );
            $postfields['program'] = 'list-images';
            $imagesresult = cloudmin_req($params, $postfields);
        }
    }
    $configarray = array( 'Type' => array( 'Type' => 'dropdown', 'Options' => 'xen,openvz,vservers,zones,real' ), "Xen Host" => array( 'Type' => 'text', 'Size' => '30', 'Description' => "(Optional)" ), "Setup Type" => array( 'Type' => 'dropdown', 'Options' => 'system,owner' ), "Plan Name" => array( 'Type' => 'text', 'Size' => '20', 'Description' => '' ) );
    if( is_array($imagesresult) )
    {
        $configarray['Image'] = array( 'Type' => 'dropdown', 'Options' => implode(',', $imagesresult) );
    }
    else
    {
        $configarray['Image'] = array( 'Type' => 'text', 'Size' => '30' );
    }
    $configarray["Get From Server"] = array( 'Type' => 'yesno', 'Description' => "Tick this box to load Image options from default server" );
    return $configarray;
}
function cloudmin_CreateAccount($params)
{
    if( $params['configoption3'] == 'owner' )
    {
        $postfields = array(  );
        $postfields['program'] = 'create-owner';
        $postfields['name'] = $params['customfields']['Username'];
        $postfields['email'] = $params['clientsdetails']['email'];
        $postfields['pass'] = $params['password'];
        $postfields['plan'] = $params['configoption4'];
        $result = cloudmin_req($params, $postfields);
    }
    else
    {
        $postfields = array(  );
        $postfields['program'] = 'create-system';
        $postfields['type'] = $params['configoption1'];
        if( $params['configoption2'] )
        {
            $postfields['xen-host'] = $params['configoption2'];
        }
        $postfields['host'] = $params['customfields']['Hostname'];
        $postfields['ssh-pass'] = $params['password'];
        $postfields['image'] = $params['configoption5'];
        $postfields['desc'] = "WHMCS Service ID " . $params['serviceid'];
        $result = cloudmin_req($params, $postfields);
    }
    return $result;
}
function cloudmin_SuspendAccount($params)
{
    if( $params['configoption3'] == 'owner' )
    {
        $postfields = array(  );
        $postfields['program'] = 'modify-owner';
        $postfields['name'] = $params['customfields']['Username'];
        $postfields['lock'] = '1';
        $result = cloudmin_req($params, $postfields);
    }
    else
    {
        $postfields = array(  );
        $postfields['program'] = 'pause-system';
        $postfields['host'] = $params['domain'];
        $result = cloudmin_req($params, $postfields);
    }
    return $result;
}
function cloudmin_UnsuspendAccount($params)
{
    if( $params['configoption3'] == 'owner' )
    {
        $postfields = array(  );
        $postfields['program'] = 'modify-owner';
        $postfields['name'] = $params['customfields']['Username'];
        $postfields['lock'] = '0';
        $result = cloudmin_req($params, $postfields);
    }
    else
    {
        $postfields = array(  );
        $postfields['program'] = 'unpause-system';
        $postfields['host'] = $params['domain'];
        $result = cloudmin_req($params, $postfields);
    }
    return $result;
}
function cloudmin_TerminateAccount($params)
{
    if( $params['configoption3'] == 'owner' )
    {
        $postfields = array(  );
        $postfields['program'] = 'delete-owner';
        $postfields['name'] = $params['customfields']['Username'];
        $result = cloudmin_req($params, $postfields);
    }
    else
    {
        $postfields = array(  );
        $postfields['program'] = 'delete-system';
        $postfields['host'] = $params['domain'];
        $result = cloudmin_req($params, $postfields);
    }
    return $result;
}
function cloudmin_AdminCustomButtonArray()
{
    $buttonarray = array( 'Reboot' => 'reboot', 'Startup' => 'startup', 'Shutdown' => 'shutdown' );
    return $buttonarray;
}
function cloudmin_ClientAreaCustomButtonArray()
{
    $buttonarray = array( 'Reboot' => 'reboot', 'Startup' => 'startup', 'Shutdown' => 'shutdown' );
    return $buttonarray;
}
function cloudmin_reboot($params)
{
    $postfields = array(  );
    $postfields['program'] = 'reboot-system';
    $postfields['host'] = $params['domain'];
    $result = cloudmin_req($params, $postfields);
    return $result;
}
function cloudmin_startup($params)
{
    $postfields = array(  );
    $postfields['program'] = 'startup-system';
    $postfields['host'] = $params['domain'];
    $result = cloudmin_req($params, $postfields);
    return $result;
}
function cloudmin_shutdown($params)
{
    $postfields = array(  );
    $postfields['program'] = 'shutdown-system';
    $postfields['host'] = $params['domain'];
    $result = cloudmin_req($params, $postfields);
    return $result;
}
function cloudmin_req($params, $postfields)
{
    $domain = $params['serverhostname'] ? $params['serverhostname'] : $params['serverip'];
    $http = $params['serversecure'] ? 'https' : 'http';
    $url = $http . "://" . $domain . "/server-manager/remote.cgi?" . $fieldstring;
    $fieldstring = '';
    foreach( $postfields as $k => $v )
    {
        $fieldstring .= $k . "=" . urlencode($v) . "&";
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldstring);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERPWD, $params['serverusername'] . ":" . $params['serverpassword']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 300);
    $data = curl_exec($ch);
    if( curl_errno($ch) )
    {
        $data = "Curl Error: " . curl_errno($ch) . " - " . curl_error($ch);
    }
    curl_close($ch);
    logModuleCall('cloudmin', $postfields['program'], $postfields, $data);
    if( strpos($data, 'Unauthorized') == true )
    {
        return "Server Login Invalid";
    }
    $exitstatuspos = strpos($data, "Exit status:");
    $exitstatus = trim(substr($data, $exitstatuspos + 12));
    if( $exitstatus == '0' )
    {
        $result = 'success';
        if( $postfields['program'] == 'create-system' )
        {
            $pos1 = 0;
            $matchstring = "Creation of Xen system ";
            $pos1 = strpos($data, $matchstring);
            if( !$pos1 )
            {
                $matchstring = "Creation of OpenVZ system ";
                $pos1 = strpos($data, $matchstring);
            }
            $pos2 = strpos($data, " is complete");
            $hostname = substr($data, $pos1 + strlen($matchstring), $pos2 - $pos1 - strlen($matchstring));
            if( $hostname )
            {
                update_query('tblhosting', array( 'domain' => $hostname ), array( 'id' => $params['serviceid'] ));
            }
        }
        else
        {
            if( $postfields['program'] == 'list-images' )
            {
                $array = explode("------------------------------ ------------------------------------------------\n", $data);
                $array = $array[1];
                $array = explode("\n", $array);
                $result = array(  );
                foreach( $array as $line )
                {
                    if( !$line )
                    {
                        break;
                    }
                    $line = explode("    ", $line, 2);
                    $result[] = trim($line[0]);
                }
            }
        }
    }
    else
    {
        $dataarray = explode("\n", $data);
        $result = $dataarray[0];
    }
    return $result;
}