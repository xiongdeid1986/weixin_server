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
$aInt = new WHMCS_Admin("Configure Product Bundles");
$aInt->title = $aInt->lang('setup', 'bundles');
$aInt->sidebar = 'config';
$aInt->icon = 'bundles';
$aInt->helplink = $aInt->lang('setup', 'bundles');
$aInt->requiredFiles(array( 'configoptionsfunctions' ));
if( $saveorder )
{
    check_token("WHMCS.admin.default");
    $result = select_query('tblbundles', '', array( 'id' => $id ));
    $data = mysql_fetch_array($result);
    $id = $data['id'];
    $itemdata = $data['itemdata'];
    $itemdata = unserialize($itemdata);
    $newitemdata = array(  );
    foreach( $orderdata as $item )
    {
        $item = substr($item, 4);
        $newitemdata[] = $itemdata[$item];
    }
    update_query('tblbundles', array( 'itemdata' => serialize($newitemdata) ), array( 'id' => $id ));
    exit();
}
if( $action == 'getaddons' )
{
    check_token("WHMCS.admin.default");
    $result = select_query('tblbundles', '', array( 'id' => $bid ));
    $data = mysql_fetch_array($result);
    $id = $data['id'];
    $itemdata = $data['itemdata'];
    $itemdata = unserialize($itemdata);
    $vals = '';
    if( $i )
    {
        $i = (int) $i;
    }
    if( strlen($i) )
    {
        $vals = $itemdata[$i];
    }
    if( !$vals )
    {
        $vals = array(  );
    }
    $configoption = is_array($vals['configoption']) ? $vals['configoption'] : array(  );
    $addon = is_array($vals['addons']) ? $vals['addons'] : array(  );
    $currency = getCurrency();
    $configoptions = getCartConfigOptions($pid, $configoptions, '', '', true);
    if( count($configoptions) )
    {
        echo "<b>" . $aInt->lang('setup', 'configoptions') . "</b><br />\n<div style=\"background-color:#efefef;padding:5px;margin:2px;\">\n<table>";
        foreach( $configoptions as $vals )
        {
            $opid = $vals['id'];
            $optionname = $vals['optionname'];
            $optiontype = $vals['optiontype'];
            $options = $vals['options'];
            echo "<tr><td width=\"100\">" . $optionname . "</td><td><label><input type=\"checkbox\" name=\"coprestrict[]\" value=\"" . $opid . "\"";
            if( array_key_exists($opid, $configoption) )
            {
                echo " checked";
            }
            echo " />" . $aInt->lang('bundles', 'restrict') . "</label></td><td>";
            if( $optiontype == 1 || $optiontype == 2 )
            {
                echo "<select name=\"coopval[" . $opid . "]\">";
                foreach( $options as $svals )
                {
                    echo "<option value=\"" . $svals['id'] . "\"";
                    if( $svals['id'] == $configoption[$opid] )
                    {
                        echo " selected";
                    }
                    echo ">" . $svals['name'] . "</option>";
                }
                echo "</select>";
            }
            else
            {
                if( $optiontype == 3 )
                {
                    echo "<label><input type=\"checkbox\" name=\"coopval[" . $opid . "]\" value=\"1\"";
                    if( $configoption[$opid] )
                    {
                        echo " checked";
                    }
                    echo " />" . $aInt->lang('bundles', 'enabled') . "</label>";
                }
                else
                {
                    if( $optiontype == 4 )
                    {
                        echo $aInt->lang('fields', 'quantity') . ": <input type=\"text\" name=\"coopval[" . $opid . "]\" size=\"5\" value=\"" . $configoption[$opid] . "\" />";
                    }
                }
            }
            echo "</td></tr>";
        }
        echo "</table>\n</div><br />";
    }
    $addons = '';
    $result = select_query('tbladdons', '', '', "weight` ASC,`name", 'ASC');
    while( $data = mysql_fetch_array($result) )
    {
        $addonid = $data['id'];
        $packages = $data['packages'];
        $name = $data['name'];
        $description = $data['description'];
        $addon_packages = explode(',', $packages);
        if( in_array($pid, $addon_packages) )
        {
            $addons .= "<label><input type=\"checkbox\" name=\"addons[]\" value=\"" . $addonid . "\"" . (in_array($addonid, $addon) ? " checked" : '') . " /> " . $name . "</label><br />";
        }
    }
    if( $addons )
    {
        echo "<b>" . $aInt->lang('addons', 'title') . "</b><br />\n<div style=\"background-color:#efefef;padding:5px;margin:2px;\">\n" . $addons . "\n</div>";
    }
    exit();
}
if( $action == 'confproduct' )
{
    check_token("WHMCS.admin.default");
function BundleDomainsConfigOptions($vals, $suffix = '')
{
    global $aInt;
    $exts = array(  );
    $result = select_query('tbldomainpricing', 'extension', '', 'order', 'ASC');
    while( $data = mysql_fetch_array($result) )
    {
        $exts[] = $data['extension'];
    }
    if( !count($exts) )
    {
        return false;
    }
    echo "<b>" . $aInt->lang('bundles', 'qualifyingtlds') . "</b><br />\n<div style=\"background-color:#efefef;padding:5px;margin:2px;\">\n";
    foreach( $exts as $ext )
    {
        echo "<label><input type=\"checkbox\" name=\"tlds" . $suffix . "[]\" value=\"" . $ext . "\"";
        if( in_array($ext, $vals['tlds']) )
        {
            echo " checked";
        }
        echo " /> " . $ext . "</label>";
    }
    echo "\n</div>\n<br />\n<b>" . $aInt->lang('domains', 'regperiod') . "</b><br />\n<div style=\"background-color:#efefef;padding:5px;margin:2px;\">\n<select name=\"regperiod" . $suffix . "\"><option value=\"0\">" . $aInt->lang('bundles', 'norestriction') . "</option>\n";
    $regperiodss = '';
    for( $regperiod = 1; $regperiod <= 10; $regperiod++ )
    {
        echo "<option value=\"" . $regperiod . "\"";
        if( $vals['regperiod'] == $regperiod )
        {
            echo " selected";
        }
        echo ">" . $regperiod . " " . $aInt->lang('domains', 'year' . $regperiodss) . "</option>";
        $regperiodss = 's';
    }
    echo "\n</select>\n</div>\n<br />\n<b>" . $aInt->lang('fields', 'priceoverride') . "</b><br />\n<div style=\"background-color:#efefef;padding:5px;margin:2px;\">\n<label><input type=\"checkbox\" name=\"dompriceoverride" . $suffix . "\" value=\"1\"" . ($vals['dompriceoverride'] ? " checked" : '') . " />" . $aInt->lang('bundles', 'enableamount') . ":</label> <input type=\"text\" name=\"domprice" . $suffix . "\" size=\"10\" value=\"" . $vals['domprice'] . "\" />" . $aInt->lang('bundles', 'pricebeforeaddons') . "\n</div>\n<br />\n<b>" . $aInt->lang('domains', 'domainaddons') . "</b><br />\n<div style=\"background-color:#efefef;padding:5px;margin:2px;\">\n<label><input type=\"checkbox\" name=\"domaddons" . $suffix . "[]\" value=\"dnsmanagement\"" . (in_array('dnsmanagement', $vals['domaddons']) || in_array('dnsmanagement', $vals['addons']) ? " checked" : '') . " /> " . $aInt->lang('domains', 'dnsmanagement') . "</label><br />\n<label><input type=\"checkbox\" name=\"domaddons" . $suffix . "[]\" value=\"emailforwarding\"" . (in_array('emailforwarding', $vals['domaddons']) || in_array('emailforwarding', $vals['addons']) ? " checked" : '') . " /> " . $aInt->lang('domains', 'emailforwarding') . "</label><br />\n<label><input type=\"checkbox\" name=\"domaddons" . $suffix . "[]\" value=\"idprotection\"" . (in_array('idprotection', $vals['domaddons']) || in_array('idprotection', $vals['addons']) ? " checked" : '') . " /> " . $aInt->lang('domains', 'idprotection') . "</label>\n</div>";
}
    $result = select_query('tblbundles', '', array( 'id' => $id ));
    $data = mysql_fetch_array($result);
    $id = $data['id'];
    $itemdata = $data['itemdata'];
    $itemdata = unserialize($itemdata);
    $vals = '';
    if( $i )
    {
        $i = (int) $i;
    }
    if( strlen($i) )
    {
        $vals = $itemdata[$i];
    }
    if( !$vals )
    {
        $vals = array(  );
    }
    echo "<br />\n<script>\n\$(document).ready(function(){\n    loadaddons();\n});\nfunction loadaddons() {\n    \$.post(\"configbundles.php\", { action: \"getaddons\", pid: \$('#pid').val(), bid: \"" . $id . "\", i: \"" . $i . "\", token: \"" . generate_token('plain') . "\" },\n    function(data){\n        \$(\"#addonops\").html(data);\n    });\n}\n</script>\n<form method=\"post\" action=\"configbundles.php?action=saveitem&id=" . $id . "&i=" . $i . "\" id=\"conffrm\">\n" . generate_token('form') . "\n<div style=\"background-color:#efefef;padding:5px 5px 8px 5px;\">Type: <input type=\"radio\" name=\"type\" id=\"typeproduct\" value=\"product\" onclick=\"\$('#prodoptions').slideDown();\$('#domoptions').slideUp()\"";
    if( !$vals['type'] || $vals['type'] == 'product' )
    {
        echo " checked";
    }
    echo " /> <label for=\"typeproduct\">" . $aInt->lang('fields', 'product') . "</label> <input type=\"radio\" name=\"type\" id=\"typedomain\" value=\"domain\" onclick=\"\$('#prodoptions').slideUp();\$('#domoptions').slideDown()\"";
    if( $vals['type'] == 'domain' )
    {
        echo " checked";
    }
    echo " /> <label for=\"typedomain\">" . $aInt->lang('fields', 'domain') . "</label></div><br />\n<div id=\"prodoptions\"";
    if( $vals['type'] && $vals['type'] != 'product' )
    {
        echo " style=\"display:none;\"";
    }
    echo ">\n<b>" . $aInt->lang('fields', 'product') . "</b><br />\n<div style=\"background-color:#efefef;padding:5px;margin:2px;\">\n<select name=\"pid\" id=\"pid\" style=\"max-width:350px;\" onchange=\"loadaddons()\">";
    $result = select_query('tblproducts', "tblproducts.id,tblproducts.gid,tblproducts.name,tblproductgroups.name AS groupname", '', "tblproductgroups`.`order` ASC,`tblproducts`.`order` ASC,`name", 'ASC', '', "tblproductgroups ON tblproducts.gid=tblproductgroups.id");
    while( $data = mysql_fetch_array($result) )
    {
        $pid = $data['id'];
        $gid = $data['gid'];
        $name = $data['name'];
        $packtype = $data['groupname'];
        echo "<option value=\"" . $pid . "\"";
        if( $pid == $vals['pid'] )
        {
            echo " SELECTED";
        }
        echo ">" . $packtype . " - " . $name . "</option>";
    }
    echo "</select>\n</div>\n<br />\n<b>" . $aInt->lang('fields', 'billingcycle') . "</b><br />\n<div style=\"background-color:#efefef;padding:5px;margin:2px;\">\n";
    echo $aInt->cyclesDropDown($vals['billingcycle'], true);
    echo $aInt->lang('bundles', 'selectrequiresbc') . "\n</div>\n<br />\n<b>" . $aInt->lang('fields', 'priceoverride') . "</b><br />\n<div style=\"background-color:#efefef;padding:5px;margin:2px;\">\n<label><input type=\"checkbox\" name=\"priceoverride\" value=\"1\"" . ($vals['priceoverride'] ? " checked" : '') . " />" . $aInt->lang('bundles', 'enableamount') . ":</label> <input type=\"text\" name=\"price\" size=\"10\" value=\"" . $vals['price'] . "\" />" . $aInt->lang('bundles', 'pricebeforeoptionsaddons') . "\n</div>\n<br />\n<div id=\"addonops\">\n</div>\n<br />";
    BundleDomainsConfigOptions($vals);
    echo "</div>\n<div id=\"domoptions\"";
    if( $vals['type'] != 'domain' )
    {
        echo " style=\"display:none;\"";
    }
    echo ">";
    BundleDomainsConfigOptions($vals, '2');
    echo "\n</div>\n</div>\n</form>";
    exit();
}
if( $action == 'saveitem' )
{
    check_token("WHMCS.admin.default");
    $result = select_query('tblbundles', '', array( 'id' => $id ));
    $data = mysql_fetch_array($result);
    $id = $data['id'];
    $itemdata = $data['itemdata'];
    $itemdata = $itemdata ? unserialize($itemdata) : array(  );
    if( $type == 'product' )
    {
        foreach( $coopval as $cid => $opid )
        {
            if( !in_array($cid, $coprestrict) )
            {
                unset($coopval[$cid]);
            }
        }
        foreach( $coprestrict as $cid )
        {
            if( !array_key_exists($cid, $coopval) )
            {
                $coopval[$cid] = '';
            }
        }
        $vals = array( 'type' => 'product', 'pid' => $pid, 'billingcycle' => $billingcycle, 'priceoverride' => $priceoverride, 'price' => format_as_currency($price), 'configoption' => $coopval, 'addons' => $addons, 'tlds' => $tlds, 'regperiod' => $regperiod, 'dompriceoverride' => $dompriceoverride, 'domprice' => format_as_currency($domprice), 'domaddons' => $domaddons );
    }
    else
    {
        if( $type == 'domain' )
        {
            $vals = array( 'type' => 'domain', 'tlds' => $tlds2, 'regperiod' => $regperiod2, 'dompriceoverride' => $dompriceoverride2, 'domprice' => format_as_currency($domprice2), 'addons' => $domaddons2 );
        }
    }
    if( strlen($i) )
    {
        $itemdata[$i] = $vals;
    }
    else
    {
        $itemdata[] = $vals;
    }
    update_query('tblbundles', array( 'itemdata' => serialize($itemdata) ), array( 'id' => $id ));
    redir("action=manage&id=" . $id);
}
if( $action == 'deleteitem' )
{
    check_token("WHMCS.admin.default");
    $result = select_query('tblbundles', '', array( 'id' => $id ));
    $data = mysql_fetch_array($result);
    $id = $data['id'];
    $itemdata = $data['itemdata'];
    $itemdata = $itemdata ? unserialize($itemdata) : array(  );
    unset($itemdata[$i]);
    update_query('tblbundles', array( 'itemdata' => serialize($itemdata) ), array( 'id' => $id ));
    redir("action=manage&id=" . $id);
}
if( $action == 'duplicatenow' )
{
    check_token("WHMCS.admin.default");
    $result = select_query('tblbundles', '', array( 'id' => $existingbundle ));
    $data = mysql_fetch_array($result);
    $addstr = '';
    foreach( $data as $key => $value )
    {
        if( is_numeric($key) )
        {
            if( $key == '0' )
            {
                $value = '';
            }
            if( $key == '1' )
            {
                $value = $newbundlename;
            }
            $addstr .= "'" . db_escape_string($value) . "',";
        }
    }
    $addstr = substr($addstr, 0, 0 - 1);
    full_query("INSERT INTO tblbundles VALUES (" . $addstr . ")");
    $newbundleid = mysql_insert_id();
    redir("action=manage&id=" . $newbundleid);
}
if( $action == 'save' )
{
    check_token("WHMCS.admin.default");
    $validuntil = $noexpiry ? '0000-00-00' : toMySQLDate($validuntil);
    if( $id )
    {
        $result = select_query('tblbundles', 'itemdata', array( 'id' => $id ));
        $data = mysql_fetch_array($result);
        $itemdata = $data['itemdata'];
        $itemdata = unserialize($itemdata);
        foreach( $itemdata as $k => $v )
        {
            if( !count($v) )
            {
                unset($itemdata[$k]);
            }
        }
        $itemdata = array_values($itemdata);
        update_query('tblbundles', array( 'name' => $name, 'itemdata' => serialize($itemdata), 'validfrom' => toMySQLDate($validfrom), 'validuntil' => $validuntil, 'uses' => $uses, 'maxuses' => $maxuses, 'allowpromo' => $allowpromo ? '1' : '0', 'showgroup' => $showgroup ? '1' : '0', 'gid' => $gid, 'description' => WHMCS_Input_Sanitize::decode($description), 'displayprice' => $displayprice, 'sortorder' => $sortorder ), array( 'id' => $id ));
        redir("success=true");
    }
    else
    {
        $id = insert_query('tblbundles', array( 'name' => $name, 'validfrom' => toMySQLDate($validfrom), 'validuntil' => $validuntil, 'uses' => $uses, 'maxuses' => $maxuses, 'allowpromo' => $allowpromo ? '1' : '0', 'showgroup' => $showgroup ? '1' : '0', 'gid' => $gid, 'description' => WHMCS_Input_Sanitize::decode($description), 'displayprice' => $displayprice, 'sortorder' => $sortorder ));
        redir("action=manage&id=" . $id);
    }
}
if( $action == 'delete' )
{
    check_token("WHMCS.admin.default");
    delete_query('tblbundles', array( 'id' => $id ));
    redir("deleted=true");
}
ob_start();
if( !$action )
{
    if( $success )
    {
        infoBox($aInt->lang('global', 'changesuccess'), $aInt->lang('global', 'changesuccessdesc'));
    }
    if( $deleted )
    {
        infoBox($aInt->lang('global', 'changesuccess'), $aInt->lang('global', 'changesuccessdesc'));
    }
    echo $infobox;
    $aInt->deleteJSConfirm('doDelete', 'bundles', 'deletebundleconfirm', $_SERVER['PHP_SELF'] . "?action=delete&id=");
    $result = select_query('tblbundles', "COUNT(*)", '');
    $data = mysql_fetch_array($result);
    $num_rows2 = $data[0];
    echo "\n<p>";
    echo $aInt->lang('bundles', 'pagedesc');
    echo "</p>\n\n<p><strong>";
    echo $aInt->lang('addons', 'options');
    echo ":</strong> <a href=\"";
    echo $whmcs->getPhpSelf();
    echo "?action=manage\">";
    echo $aInt->lang('bundles', 'createnewbundle');
    echo "</a> | ";
    if( $num_rows2 == '0' )
    {
        echo "<font color=#cccccc>" . $aInt->lang('bundles', 'duplicatebundle') . "</font>";
    }
    else
    {
        echo "<a href=\"";
        echo $whmcs->getPhpSelf();
        echo "?action=duplicate\">";
        echo $aInt->lang('bundles', 'duplicatebundle');
        echo "</a>";
    }
    echo "\n\n </p>\n\n";
    $aInt->sortableTableInit('nopagination');
    $result = select_query('tblbundles', '', '', 'name', 'ASC');
    while( $data = mysql_fetch_array($result) )
    {
        $id = $data['id'];
        $name = $data['name'];
        $validfrom = $data['validfrom'];
        $validuntil = $data['validuntil'];
        $uses = $data['uses'];
        $maxuses = $data['maxuses'];
        $itemdata = $data['itemdata'];
        $status = '';
        $active = "<img src=\"images/icons/tick.png\" />";
        if( $validfrom != '0000-00-00' && date('Ymd') < str_replace('-', '', $validfrom) || $validuntil != '0000-00-00' && str_replace('-', '', $validuntil) < date('Ymd') )
        {
            $status = $aInt->lang('bundles', 'outsidevaliddates');
            $active = "<img src=\"images/icons/disabled.png\" />";
        }
        if( $maxuses && $maxuses <= $uses )
        {
            $status = $aInt->lang('bundles', 'exceededmaxuses');
            $active = "<img src=\"images/icons/disabled.png\" />";
        }
        $validfrom = fromMySQLDate($validfrom);
        $validuntil = fromMySQLDate($validuntil);
        $showorder = $showorder ? "<img src=\"images/icons/tick.png\" alt=\"Yes\" border=\"0\" />" : "&nbsp;";
        $tabledata[] = array( $name, $validfrom, $validuntil, $uses, $maxuses, $active . " " . $status, "<a href=\"?action=manage&id=" . $id . "\"><img src=\"images/edit.gif\" width=\"16\" height=\"16\" border=\"0\" alt=\"" . $aInt->lang('global', 'edit') . "\"></a>", "<a href=\"#\" onClick=\"doDelete('" . $id . "')\"><img src=\"images/delete.gif\" width=\"16\" height=\"16\" border=\"0\" alt=\"" . $aInt->lang('global', 'delete') . "\"></a>" );
    }
    echo $aInt->sortableTable(array( $aInt->lang('fields', 'name'), $aInt->lang('bundles', 'validfrom'), $aInt->lang('bundles', 'validuntil'), $aInt->lang('promos', 'uses'), $aInt->lang('promos', 'maxuses'), $aInt->lang('fields', 'status'), '', '' ), $tabledata);
}
else
{
    if( $action == 'duplicate' )
    {
        echo "\n<p><b>";
        echo $aInt->lang('bundles', 'duplicatebundles');
        echo "</b></p>\n\n<form method=\"post\" action=\"";
        echo $whmcs->getPhpSelf();
        echo "?action=duplicatenow\">\n<table class=\"form\" width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\">\n<tr><td width=150 class=\"fieldlabel\">";
        echo $aInt->lang('bundles', 'existingbundle');
        echo "</td><td class=\"fieldarea\"><select name=\"existingbundle\">";
        $query = "SELECT * FROM tblbundles ORDER BY `name` ASC";
        $result = full_query($query);
        while( $data = mysql_fetch_array($result) )
        {
            $pid = $data['id'];
            $name = $data['name'];
            echo "<option value=\"" . $pid . "\">" . $name;
        }
        echo "</select></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('bundles', 'newbundlename');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"newbundlename\" size=\"50\"></td></tr>\n</table>\n<P ALIGN=\"center\"><input type=\"submit\" value=\"";
        echo $aInt->lang('global', 'continue');
        echo " >>\" class=\"button\"></P>\n</form>\n\n";
    }
    else
    {
        if( $action == 'manage' )
        {
            if( $id )
            {
                $managetitle = $aInt->lang('bundles', 'editbundle');
                $result = select_query('tblbundles', '', array( 'id' => $id ));
                $data = mysql_fetch_array($result);
                $id = $data['id'];
                $name = $data['name'];
                $validfrom = $data['validfrom'];
                $validuntil = $data['validuntil'];
                $uses = $data['uses'];
                $maxuses = $data['maxuses'];
                $itemdata = $data['itemdata'];
                $allowpromo = $data['allowpromo'];
                $showgroup = $data['showgroup'];
                $gid = $data['gid'];
                $description = $data['description'];
                $displayprice = $data['displayprice'];
                $sortorder = $data['sortorder'];
                $itemdata = unserialize($itemdata);
                $validfrom = fromMySQLDate($validfrom);
                $validuntil = fromMySQLDate($validuntil);
                $validuntilblank = fromMySQLDate('0000-00-00');
            }
            else
            {
                $managetitle = $aInt->lang('bundles', 'createnewbundle');
                $itemdata = array(  );
                $validfrom = getTodaysDate();
                $validuntil = fromMySQLDate(date('Y-m-d', mktime(0, 0, 0, date('m') + 1, date('d'), date('Y'))));
                $uses = $maxuses = $sortorder = '0';
                $displayprice = "0.00";
                $showgroup = '';
            }
            echo "<p><b>" . $managetitle . "</b></p>";
            $url = $CONFIG['SystemSSLURL'] ? $CONFIG['SystemSSLURL'] : $CONFIG['SystemURL'];
            $currency = getCurrency();
            echo "\n<style>\n.bundleitem {\n    margin: 5px;\n    padding: 10px;\n    width: 75%;\n    background-color: #fff;\n    -moz-border-radius: 5px;\n    -webkit-border-radius: 5px;\n    -o-border-radius: 5px;\n    border-radius: 5px;\n}\n.bundleadd {\n    margin: 5px 20px;\n}\n</style>\n\n<form method=\"post\" action=\"";
            echo $whmcs->getPhpSelf();
            echo "?action=save&id=";
            echo $id;
            echo "\">\n\n<table class=\"form\" width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\">\n<tr><td class=\"fieldlabel\" width=\"200\">";
            echo $aInt->lang('fields', 'name');
            echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"name\" size=\"40\" value=\"";
            echo $name;
            echo "\" /></td></tr>\n<tr><td class=\"fieldlabel\">";
            echo $aInt->lang('bundles', 'validfrom');
            echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"validfrom\" class=\"datepick\" value=\"";
            echo $validfrom;
            echo "\" /></td></tr>\n<tr><td class=\"fieldlabel\">";
            echo $aInt->lang('bundles', 'validuntil');
            echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"validuntil\" class=\"datepick\" value=\"";
            echo $validuntil;
            echo "\" /> <label><input type=\"checkbox\" name=\"noexpiry\"";
            if( $validuntil == $validuntilblank )
            {
                echo " checked";
            }
            echo " />";
            echo $aInt->lang('bundles', 'noexpiry');
            echo "</label></td></tr>\n<tr><td class=\"fieldlabel\">";
            echo $aInt->lang('promos', 'uses');
            echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"uses\" size=\"5\" value=\"";
            echo $uses;
            echo "\" /></td></tr>\n<tr><td class=\"fieldlabel\">";
            echo $aInt->lang('promos', 'maxuses');
            echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"maxuses\" size=\"5\" value=\"";
            echo $maxuses;
            echo "\" /></td></tr>\n<tr><td class=\"fieldlabel\">";
            echo $aInt->lang('bundles', 'bundleitems');
            echo "</td><td class=\"fieldarea\">\n<div class=\"bundleitems\">\n";
            if( !$id )
            {
                echo $aInt->lang('bundles', 'savenamefirst');
            }
            else
            {
                foreach( $itemdata as $i => $data )
                {
                    if( $data['type'] == 'product' )
                    {
                        echo "<div class=\"bundleitem\" id=\"item" . $i . "\"><span id=\"numitem" . $i . "\">" . ($i + 1) . "</span>. <b>" . get_query_val('tblproducts', "CONCAT(tblproductgroups.name,' - ',tblproducts.name)", array( "tblproducts.id" => $data['pid'] ), '', '', '', "tblproductgroups ON tblproductgroups.id=tblproducts.gid") . "</b> - <a href=\"#\" onclick=\"manageitem('" . $id . "','" . $i . "');return false\"><img src=\"images/icons/config.png\" align=\"absmiddle\" />" . $aInt->lang('bundles', 'configure') . "</a> <a href=\"#\" onclick=\"deleteitem('" . $id . "','" . $i . "');return false\"><img src=\"images/icons/delete.png\" align=\"absmiddle\" />" . $aInt->lang('bundles', 'removeitem') . "</a><br />";
                        if( $data['billingcycle'] )
                        {
                            echo " &nbsp;&nbsp; - " . $aInt->lang('fields', 'billingcycle') . ": " . $data['billingcycle'] . "<br />";
                        }
                        if( $data['priceoverride'] )
                        {
                            echo " &nbsp;&nbsp; - " . $aInt->lang('fields', 'priceoverride') . ": " . formatCurrency($data['price']) . "<br />";
                        }
                        if( $data['configoption'] )
                        {
                            echo " &nbsp;&nbsp; - " . $aInt->lang('setup', 'configoptions') . ": ";
                            foreach( $data['configoption'] as $cid => $opid )
                            {
                                $cdata = get_query_vals('tblproductconfigoptions', "optionname,optiontype,(SELECT optionname FROM tblproductconfigoptionssub WHERE id='" . (int) $opid . "') AS subopname", array( 'id' => $cid ));
                                if( $cdata['optiontype'] == 1 || $cdata['optiontype'] == 2 )
                                {
                                    echo $cdata['optionname'] . " => " . $cdata['subopname'] . ", ";
                                }
                                else
                                {
                                    if( $cdata['optiontype'] == 3 )
                                    {
                                        echo $cdata['optionname'] . " => " . ($opid ? $aInt->lang('bundles', 'enabled') : $aInt->lang('bundles', 'disabled')) . ", ";
                                    }
                                    else
                                    {
                                        if( $cdata['optiontype'] == 4 )
                                        {
                                            echo $cdata['optionname'] . " => " . $opid . ", ";
                                        }
                                    }
                                }
                            }
                        }
                        if( $data['addons'] )
                        {
                            echo " &nbsp;&nbsp; - " . $aInt->lang('addons', 'title') . ": ";
                            $result = select_query('tbladdons', 'name', "id IN (" . db_build_in_array($data['addons']) . ")");
                            while( $data = mysql_fetch_array($result) )
                            {
                                echo $data[0] . ", ";
                            }
                            echo "<br />";
                        }
                        if( $data['tlds'] )
                        {
                            echo " &nbsp;&nbsp; - " . $aInt->lang('bundles', 'tldrestrictions') . ": " . implode(", ", $data['tlds']) . "<br />";
                        }
                        if( $data['regperiod'] )
                        {
                            echo " &nbsp;&nbsp; - " . $aInt->lang('domains', 'regperiod') . ": " . $data['regperiod'] . " " . $aInt->lang('domains', 'years') . "<br />";
                        }
                        if( $data['dompriceoverride'] )
                        {
                            echo " &nbsp;&nbsp; - " . $aInt->lang('bundles', 'domainpriceoverride') . ": " . formatCurrency($data['domprice']) . "<br />";
                        }
                        if( $data['addons'] )
                        {
                            echo " &nbsp;&nbsp; - " . $aInt->lang('addons', 'title') . ": ";
                            if( in_array('dnsmanagement', $data['addons']) )
                            {
                                echo $aInt->lang('domains', 'dnsmanagement') . ", ";
                            }
                            if( in_array('emailforwarding', $data['addons']) )
                            {
                                echo $aInt->lang('domains', 'emailforwarding') . ", ";
                            }
                            if( in_array('idprotection', $data['addons']) )
                            {
                                echo $aInt->lang('domains', 'idprotection') . ", ";
                            }
                            echo "<br />";
                        }
                        echo "</div>";
                    }
                    else
                    {
                        if( $data['type'] == 'domain' )
                        {
                            echo "<div class=\"bundleitem\" id=\"item" . $i . "\"><span id=\"numitem" . $i . "\">" . ($i + 1) . "</span>. <b>" . $aInt->lang('bundles', 'domainregtransfer') . "</b> - <a href=\"#\" onclick=\"manageitem('" . $id . "','" . $i . "');return false\"><img src=\"images/icons/config.png\" align=\"absmiddle\" />" . $aInt->lang('bundles', 'configure') . "</a> <a href=\"#\" onclick=\"deleteitem('" . $id . "','" . $i . "');return false\"><img src=\"images/icons/delete.png\" align=\"absmiddle\" />" . $aInt->lang('bundles', 'removeitem') . "</a><br />";
                            if( $data['tlds'] )
                            {
                                echo " &nbsp;&nbsp; - " . $aInt->lang('bundles', 'tldrestrictions') . ": " . implode(", ", $data['tlds']) . "<br />";
                            }
                            if( $data['regperiod'] )
                            {
                                echo " &nbsp;&nbsp; - " . $aInt->lang('domains', 'regperiod') . ": " . $data['regperiod'] . " Year(s)<br />";
                            }
                            if( $data['dompriceoverride'] )
                            {
                                echo " &nbsp;&nbsp; - " . $aInt->lang('fields', 'priceoverride') . ": " . formatCurrency($data['domprice']) . "<br />";
                            }
                            if( $data['addons'] )
                            {
                                echo " &nbsp;&nbsp; - " . $aInt->lang('addons', 'title') . ": ";
                                if( in_array('dnsmanagement', $data['addons']) )
                                {
                                    echo $aInt->lang('domains', 'dnsmanagement') . ", ";
                                }
                                if( in_array('emailforwarding', $data['addons']) )
                                {
                                    echo $aInt->lang('domains', 'emailforwarding') . ", ";
                                }
                                if( in_array('idprotection', $data['addons']) )
                                {
                                    echo $aInt->lang('domains', 'idprotection') . ", ";
                                }
                                echo "<br />";
                            }
                            echo "</div>";
                        }
                    }
                }
                echo "</div>\n<div class=\"bundleadd\"><a href=\"#\" onclick=\"manageitem('";
                echo $id;
                echo "','');return false\"><img src=\"images/icons/add.png\" align=\"absmiddle\" />";
                echo $aInt->lang('bundles', 'addanother');
                echo "</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo $aInt->lang('bundles', 'clickndragtoreorder');
                echo "</div>\n";
            }
            echo "</td></tr>\n<tr><td class=\"fieldlabel\">";
            echo $aInt->lang('bundles', 'allowpromotions');
            echo "</td><td class=\"fieldarea\"><label><input type=\"checkbox\" name=\"allowpromo\"";
            if( $allowpromo )
            {
                echo " checked";
            }
            echo " />";
            echo $aInt->lang('bundles', 'allowpromotionsdesc');
            echo "</label></td></tr>\n<tr><td class=\"fieldlabel\">";
            echo $aInt->lang('bundles', 'showinproductgroup');
            echo "</td><td class=\"fieldarea\"><label><input type=\"checkbox\" name=\"showgroup\" onclick=\"toggleProdFields()\"";
            if( $showgroup )
            {
                echo " checked";
            }
            echo " /> ";
            echo $aInt->lang('bundles', 'showinproductgroupdesc');
            echo "</label></td></tr>\n<tr class=\"prodfields\"";
            if( !$showgroup )
            {
                echo " style=\"display:none;\"";
            }
            echo "><td class=\"fieldlabel\">";
            echo $aInt->lang('products', 'productgroup');
            echo "</td><td class=\"fieldarea\"><select name=\"gid\"><option value=\"0\">";
            echo $aInt->lang('emailtpls', 'chooseone');
            echo "</option>";
            $result = select_query('tblproductgroups', '', '', 'order', 'ASC');
            while( $data = mysql_fetch_array($result) )
            {
                $select_gid = $data['id'];
                $select_name = $data['name'];
                echo "<option value=\"" . $select_gid . "\"";
                if( $select_gid == $gid )
                {
                    echo " selected";
                }
                echo ">" . $select_name . "</option>";
            }
            echo "</select></td></tr>\n<tr class=\"prodfields\"";
            if( !$showgroup )
            {
                echo " style=\"display:none;\"";
            }
            echo "><td class=\"fieldlabel\">";
            echo $aInt->lang('products', 'productdesc');
            echo "</td><td class=\"fieldarea\"><table cellsapcing=0 cellpadding=0><tr><td><textarea name=\"description\" cols=60 rows=5>";
            echo WHMCS_Input_Sanitize::encode($description);
            echo "</textarea></td><td>";
            echo $aInt->lang('products', 'htmlallowed');
            echo "<br>&lt;br /&gt; ";
            echo $aInt->lang('products', 'htmlnewline');
            echo "<br>&lt;strong&gt;";
            echo $aInt->lang('products', 'htmlbold');
            echo "&lt;/strong&gt; <b>";
            echo $aInt->lang('products', 'htmlbold');
            echo "</b><br>&lt;em&gt;";
            echo $aInt->lang('products', 'htmlitalics');
            echo "&lt;/em&gt; <i>";
            echo $aInt->lang('products', 'htmlitalics');
            echo "</i></td></tr></table></td></tr>\n<tr class=\"prodfields\"";
            if( !$showgroup )
            {
                echo " style=\"display:none;\"";
            }
            echo "><td class=\"fieldlabel\">";
            echo $aInt->lang('bundles', 'displayprice');
            echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"displayprice\" value=\"";
            echo $displayprice;
            echo "\" size=\"10\" /> ";
            echo $aInt->lang('bundles', 'displaypricedesc');
            echo "</td></tr>\n<tr class=\"prodfields\"";
            if( !$showgroup )
            {
                echo " style=\"display:none;\"";
            }
            echo "><td class=\"fieldlabel\">";
            echo $aInt->lang('products', 'sortorder');
            echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"sortorder\" value=\"";
            echo $sortorder;
            echo "\" size=\"5\" /> ";
            echo $aInt->lang('bundles', 'sortorderdesc');
            echo "</td></tr>\n";
            if( $id )
            {
                echo "<tr><td class=\"fieldlabel\">" . $aInt->lang('bundles', 'orderlink') . "</td><td class=\"fieldarea\"><input type=\"text\" name=\"orderlink\" size=\"100\" value=\"" . $url . "/cart.php?a=add&bid=" . $id . "\" /></td></tr>";
            }
            echo "</table>\n\n<p align=\"center\"><input type=\"submit\" value=\"";
            echo $aInt->lang('global', 'savechanges');
            echo "\" class=\"button\"></p>\n\n</form>\n\n";
            echo $aInt->jqueryDialog('prodconfig', $aInt->lang('bundles', 'configureproduct'), "<img src=\"images/loading.gif\" /> " . $aInt->lang('global', 'loading', 1), array( $aInt->lang('global', 'savechanges') => "\$('#conffrm').submit()", $aInt->lang('global', 'cancelchanges') => '' ), '400', '600', '');
            $jquerycode .= "\$( \".bundleitems\" ).sortable({\n    stop: function(event, ui) { saveBundleOrder() }\n});";
            $jscode .= "function manageitem(id,i) {\n    \$(\"#prodconfig\").html(\"<img src=\\\"images/loading.gif\\\" /> " . $aInt->lang('global', 'loading', 1) . "\");\n    \$(\"#prodconfig\").dialog(\"open\");\n    \$(\"#prodconfig\").load(\"configbundles.php?action=confproduct&id=\"+id+\"&i=\"+i+\"" . generate_token('link') . "\");\n}\nfunction deleteitem(id,i) {\n    if (confirm(\"" . $aInt->lang('bundles', 'removeitemconfirm') . "\")) {\n        window.location='" . $_SERVER['PHP_SELF'] . "?action=deleteitem&id='+id+'&i='+i+'" . generate_token('link') . "';\n    }\n}\nfunction saveBundleOrder() {\n    var order = \$(\".bundleitems\").sortable(\"toArray\");\n    for (var i = 0; i < order.length; i++) {\n        \$(\"#num\"+order[i]).html(i+1);\n    }\n    \$.post(\"configbundles.php\", { saveorder: \"1\", id: \"" . $id . "\", orderdata: order, token: \"" . generate_token('plain') . "\" });\n}\nfunction toggleProdFields() {\n    \$(\".prodfields\").fadeToggle();\n}\n";
        }
    }
}
$content = ob_get_contents();
ob_end_clean();
$aInt->content = $content;
$aInt->jquerycode = $jquerycode;
$aInt->jscode = $jscode;
$aInt->display();