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
define('ADMINAREA', true);
require("../init.php");
$aInt = new WHMCS_Admin("Configure Addon Modules");
$aInt->title = $aInt->lang('utilities', 'addonmodules');
$aInt->sidebar = 'config';
$aInt->icon = 'admins';
$aInt->helplink = "Addon Modules Management";
$aInt->requiredFiles(array( 'modulefunctions' ));
if( !isset($CONFIG['ActiveAddonModules']) )
{
    insert_query('tblconfiguration', array( 'setting' => 'ActiveAddonModules', 'value' => '' ));
}
if( !isset($CONFIG['AddonModulesPerms']) )
{
    insert_query('tblconfiguration', array( 'setting' => 'AddonModulesPerms', 'value' => '' ));
}
if( !isset($CONFIG['AddonModulesHooks']) )
{
    insert_query('tblconfiguration', array( 'setting' => 'AddonModulesHooks', 'value' => '' ));
}
$activemodules = explode(',', $CONFIG['ActiveAddonModules']);
$addon_modules = $addonmodulehooks = array(  );
if( is_dir(ROOTDIR . '/modules/addons/') )
{
    $dh = opendir(ROOTDIR . '/modules/addons/');
    while( false !== ($file = readdir($dh)) )
    {
        $modfilename = ROOTDIR . '/modules/addons/' . $file . '/' . $file . ".php";
        if( is_file($modfilename) )
        {
            require($modfilename);
            $configarray = call_user_func($file . '_config');
            $addon_modules[$file] = $configarray;
        }
    }
}
if( is_dir(ROOTDIR . '/modules/admin/') )
{
    $dh = opendir(ROOTDIR . '/modules/admin/');
    while( false !== ($file = readdir($dh)) )
    {
        if( is_file(ROOTDIR . '/modules/admin/' . $file . '/' . $file . ".php") && $file != "index.php" )
        {
            $friendlytitle = str_replace('_', " ", $file);
            $friendlytitle = titleCase($friendlytitle);
            $addon_modules[$file] = array( 'name' => $friendlytitle, 'version' => $aInt->lang('addonmodules', 'legacy'), 'author' => '-' );
        }
    }
    closedir($dh);
}
ksort($addon_modules);
$action = $whmcs->get_req_var('action');
if( $action == 'save' )
{
    check_token("WHMCS.admin.default");
    $exvars = array(  );
    $result = select_query('tbladdonmodules', '', '');
    while( $data = mysql_fetch_array($result) )
    {
        $exvars[$data['module']][$data['setting']] = $data['value'];
    }
    delete_query('tbladdonmodules', array( 'setting' => 'access' ));
    foreach( $access as $module => $roleids )
    {
        $allowedroleids = '';
        foreach( $roleids as $roleid => $v )
        {
            $allowedroleids[] = $roleid;
        }
        insert_query('tbladdonmodules', array( 'module' => $module, 'setting' => 'access', 'value' => implode(',', $allowedroleids) ));
    }
    foreach( $addon_modules as $module => $vals )
    {
        if( in_array($module, $activemodules) )
        {
            foreach( $vals['fields'] as $key => $values )
            {
                $valueToSave = '';
                if( isset($_POST['fields'][$module][$key]) )
                {
                    $valueToSave = trim(WHMCS_Input_Sanitize::decode($_POST['fields'][$module][$key]));
                }
                else
                {
                    if( $values['Type'] == 'yesno' )
                    {
                        $valueToSave = '';
                    }
                    else
                    {
                        if( isset($values['Default']) )
                        {
                            $valueToSave = $values['Default'];
                        }
                    }
                }
                if( $value['Type'] == 'yesno' )
                {
                    $valueToSave = !empty($valueToSave) && $valueToSave != 'off' && $valueToSave != 'disabled' ? 'on' : '';
                }
                if( isset($exvars[$module][$key]) )
                {
                    update_query('tbladdonmodules', array( 'value' => $valueToSave ), array( 'module' => $module, 'setting' => $key ));
                }
                else
                {
                    insert_query('tbladdonmodules', array( 'module' => $module, 'setting' => $key, 'value' => $valueToSave ));
                }
            }
        }
    }
    $module = '';
    foreach( $_POST as $k => $v )
    {
        if( substr($k, 0, 6) == 'msave_' )
        {
            $module = substr($k, 6);
        }
    }
    redir("savedref=true#" . $module);
}
if( $action == 'activate' )
{
    check_token("WHMCS.admin.default");
    if( !array_key_exists($module, $addon_modules) )
    {
        $aInt->gracefulExit("Invalid Module Name. Please Try Again.");
    }
    if( function_exists($module . '_activate') )
    {
        $response = call_user_func($module . '_activate');
    }
    WHMCS_Cookie::set('AddonModActivate', $response);
    if( !$response || is_array($response) && ($response['status'] == 'success' || $response['status'] == 'info') )
    {
        $activemodules[] = $module;
        sort($activemodules);
        update_query('tblconfiguration', array( 'value' => implode(',', $activemodules) ), array( 'setting' => 'ActiveAddonModules' ));
        if( $addon_modules[$module]['version'] != $aInt->lang('addonmodules', 'nooutput') )
        {
            insert_query('tbladdonmodules', array( 'module' => $module, 'setting' => 'version', 'value' => $addon_modules[$module]['version'] ));
        }
    }
    redir("activated=true");
}
if( $action == 'deactivate' )
{
    check_token("WHMCS.admin.default");
    if( !array_key_exists($module, $addon_modules) )
    {
        $aInt->gracefulExit("Invalid Module Name. Please Try Again.");
    }
    if( function_exists($module . '_deactivate') )
    {
        $response = call_user_func($module . '_deactivate');
    }
    WHMCS_Cookie::set('AddonModActivate', $response);
    if( !$response || is_array($response) && ($response['status'] == 'success' || $response['status'] == 'info') )
    {
        delete_query('tbladdonmodules', array( 'module' => $module ));
        foreach( $activemodules as $k => $mod )
        {
            if( $mod == $module )
            {
                unset($activemodules[$k]);
            }
        }
        sort($activemodules);
        update_query('tblconfiguration', array( 'value' => implode(',', $activemodules) ), array( 'setting' => 'ActiveAddonModules' ));
    }
    redir("deactivated=true");
}
ob_start();
if( $action == '' )
{
    if( $whmcs->get_req_var('saved') )
    {
        infoBox($aInt->lang('addonmodules', 'changesuccess'), $aInt->lang('addonmodules', 'changesuccessinfo'));
    }
    if( $whmcs->get_req_var('activated') )
    {
        $response = WHMCS_Cookie::get('AddonModActivate', 1);
        $desc = $status = '';
        if( is_array($response) )
        {
            if( $response['description'] )
            {
                $desc = $response['description'];
            }
            if( in_array($response['status'], array( 'info', 'success', 'error' )) )
            {
                $status = $response['status'];
            }
        }
        $title = $aInt->lang('addonmodules', 'moduleactivated');
        if( !$desc )
        {
            $desc = $aInt->lang('addonmodules', 'moduleactivatedinfo');
        }
        if( !$status )
        {
            $status = 'success';
        }
        infoBox($title, $desc, $status);
    }
    if( $whmcs->get_req_var('deactivated') )
    {
        $response = WHMCS_Cookie::get('AddonModActivate', 1);
        $desc = $status = '';
        if( is_array($response) )
        {
            if( $response['description'] )
            {
                $desc = $response['description'];
            }
            if( in_array($response['status'], array( 'info', 'success', 'error' )) )
            {
                $status = $response['status'];
            }
        }
        $title = $aInt->lang('addonmodules', 'moduledeactivated');
        if( !$status )
        {
            $status = 'success';
        }
        infoBox($title, $desc, $status);
    }
    echo $infobox;
    $aInt->deleteJSConfirm('deactivateMod', 'addonmodules', 'deactivatesure', $_SERVER['PHP_SELF'] . "?action=deactivate&module=");
    $jscode = "function showConfig(module) {\n    \$(\"#\"+module+\"config\").fadeToggle();\n}";
    echo "<p>" . $aInt->lang('addonmodules', 'description') . "</p>\n\n<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\">\n<input type=\"hidden\" name=\"action\" value=\"save\" />\n\n<div class=\"tablebg\">\n<table class=\"datatable\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">\n<tr><th>" . $aInt->lang('addonmodules', 'module') . "</th><th width=\"100\">" . $aInt->lang('global', 'version') . "</th><th width=\"100\">" . $aInt->lang('addonmodules', 'author') . "</th><th width=\"350\"></th></tr>\n";
    $modulevars = $addonmodulesperms = array(  );
    $result = select_query('tbladdonmodules', '', '');
    while( $data = mysql_fetch_array($result) )
    {
        $modulevars[$data['module']][$data['setting']] = $data['value'];
    }
    foreach( $addon_modules as $module => $vals )
    {
        $bgcolor = in_array($module, $activemodules) ? 'FDF4E8' : 'fff';
        echo "<tr><td style=\"background-color:#" . $bgcolor . ";text-align:left;\"><a name=\"act" . $module . "\"></a><a name=\"" . $module . "\"></a>";
        if( array_key_exists('logo', $vals) )
        {
            echo "<div style=\"float:left;padding:5px 15px;\"><img src=\"" . $vals['logo'] . "\" /></div><div style=\"float:left;\">";
        }
        echo "<b>&nbsp;&raquo; " . $vals['name'] . "</b>";
        if( array_key_exists('premium', $vals) )
        {
            echo " <span class=\"label closed\">Premium</span>";
        }
        if( $vals['description'] )
        {
            echo "<br />" . $vals['description'];
        }
        if( array_key_exists('logo', $vals) )
        {
            echo "</div>";
        }
        echo "</td><td style=\"background-color:#" . $bgcolor . ";text-align:center;\">" . $vals['version'] . "</td><td style=\"background-color:#" . $bgcolor . ";text-align:center;\">" . $vals['author'] . "</td><td style=\"background-color:#" . $bgcolor . ";text-align:center;\">";
        if( !in_array($module, $activemodules) )
        {
            echo "<input type=\"button\" value=\"" . $aInt->lang('addonmodules', 'activate') . "\" onclick=\"window.location='" . $_SERVER['PHP_SELF'] . "?action=activate&module=" . $module . generate_token('link') . "'\" class=\"btn-success\" /> ";
        }
        else
        {
            echo "<input type=\"button\" value=\"" . $aInt->lang('addonmodules', 'activate') . "\" disabled=\"disabled\" class=\"btn disabled\" /> ";
        }
        if( in_array($module, $activemodules) )
        {
            echo "<input type=\"button\" value=\"" . $aInt->lang('addonmodules', 'deactivate') . "\" onclick=\"deactivateMod('" . $module . "');return false\" class=\"btn-danger\" /> ";
        }
        else
        {
            echo "<input type=\"button\" value=\"" . $aInt->lang('addonmodules', 'deactivate') . "\" disabled=\"disabled\" class=\"btn disabled\" /> ";
        }
        echo "<input type=\"button\" value=\"" . $aInt->lang('addonmodules', 'config') . "\" class=\"btn" . (in_array($module, $activemodules) ? '' : " disabled") . "\" onclick=\"showConfig('" . $module . "')\" />";
        echo "</td></tr>";
        if( in_array($module, $activemodules) )
        {
            if( file_exists(ROOTDIR . '/modules/addons/' . $module . "/hooks.php") )
            {
                $addonmodulehooks[] = $module;
            }
            echo "<tr><td id=\"" . $module . "config\" colspan=\"4\" style=\"display:none;padding:15px;\">";
            if( $vals['version'] != $aInt->lang('addonmodules', 'legacy') && $modulevars[$module]['version'] != $vals['version'] )
            {
                if( function_exists($module . '_upgrade') )
                {
                    call_user_func($module . '_upgrade', $modulevars);
                }
                update_query('tbladdonmodules', array( 'value' => $vals['version'] ), array( 'module' => $module, 'setting' => 'version' ));
            }
            echo "<table class=\"form\" width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\">";
            foreach( $vals['fields'] as $key => $values )
            {
                $values['Name'] = "fields[" . $module . "][" . $key . "]";
                $values['Value'] = $modulevars[$module][$key];
                echo "<tr><td class=\"fieldlabel\">" . $values['FriendlyName'] . "</td><td class=\"fieldarea\">" . moduleConfigFieldOutput($values) . "</td></tr>";
            }
            echo "<tr><td width=\"20%\" class=\"fieldlabel\">" . $aInt->lang('addonmodules', 'accesscontrol') . "</td><td class=\"fieldarea\">" . $aInt->lang('addonmodules', 'rolechoose') . ":<br />";
            $allowedroles = explode(',', $modulevars[$module]['access']);
            $result = select_query('tbladminroles', '', '', 'name', 'ASC');
            while( $data = mysql_fetch_array($result) )
            {
                $checked = '';
                if( in_array($data['id'], $allowedroles) )
                {
                    $addonmodulesperms[$data['id']][$module] = $vals['name'];
                    $checked = " checked";
                }
                echo "<label><input type=\"checkbox\" name=\"access[" . $module . "][" . $data['id'] . "]\" value=\"1\"" . $checked . " /> " . $data['name'] . "</label> ";
            }
            echo "</td></tr>\n</table>\n<br />\n<div align=\"center\"><input type=\"submit\" name=\"msave_" . $module . "\" value=\"" . $aInt->lang('global', 'savechanges') . "\" class=\"btn primary\" /></div>\n</td></tr>";
        }
    }
    echo "\n</table>\n</div>\n\n</form>\n\n<script language=\"javascript\">\n\$(document).ready(function(){\n    var modpass = window.location.hash;\n    if (modpass) \$(modpass+\"config\").show();\n});\n</script>\n";
    update_query('tblconfiguration', array( 'value' => implode(',', $addonmodulehooks) ), array( 'setting' => 'AddonModulesHooks' ));
    update_query('tblconfiguration', array( 'value' => serialize($addonmodulesperms) ), array( 'setting' => 'AddonModulesPerms' ));
}
if( $whmcs->get_req_var('savedref') )
{
    redir("saved=true");
}
$content = ob_get_contents();
ob_end_clean();
$aInt->content = $content;
$aInt->jscode = $jscode;
$aInt->display();