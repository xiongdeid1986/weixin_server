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
$aInt = new WHMCS_Admin("Manage Quotes");
$aInt->title = $aInt->lang('quotes', 'title');
$aInt->sidebar = 'billing';
$aInt->icon = 'quotes';
$aInt->requiredFiles(array( 'clientfunctions', 'customfieldfunctions', 'invoicefunctions', 'quotefunctions', 'configoptionsfunctions', 'orderfunctions' ));
if( $action == 'getdesc' )
{
    check_token("WHMCS.admin.default");
    $result = select_query('tblproducts', '', array( 'id' => $id ));
    $data = mysql_fetch_array($result);
    $name = $data['name'];
    $description = $data['description'];
    echo $name . "\n" . $description;
    exit();
}
if( $action == 'getprice' )
{
    check_token("WHMCS.admin.default");
    $result = select_query('tblpricing', '', array( 'type' => 'product', 'currency' => $currency, 'relid' => $id ));
    $data = mysql_fetch_array($result);
    if( 0 < $data['monthly'] )
    {
        echo $data['monthly'];
    }
    else
    {
        if( 0 < $data['quarterly'] )
        {
            echo $data['quarterly'];
        }
        else
        {
            if( 0 < $data['semiannually'] )
            {
                echo $data['semiannually'];
            }
            else
            {
                if( 0 < $data['annually'] )
                {
                    echo $data['annually'];
                }
                else
                {
                    if( 0 < $data['biennially'] )
                    {
                        echo $data['biennially'];
                    }
                    else
                    {
                        if( 0 < $data['triennially'] )
                        {
                            echo $data['triennially'];
                        }
                        else
                        {
                            echo "0.00";
                        }
                    }
                }
            }
        }
    }
    exit();
}
if( $action == 'getproddetails' )
{
    check_token("WHMCS.admin.default");
    $currency = getCurrency('', $currency);
    $pricing = getPricingInfo($pid);
    if( !$billingcycle )
    {
        $billingcycle = $pricing['minprice']['cycle'];
    }
    echo "<input type=\"hidden\" name=\"billingcycle\" value=\"" . $billingcycle . "\" />";
    if( $pricing['type'] == 'recurring' )
    {
    }
    $configoptions = getCartConfigOptions($pid, '', $billingcycle);
    if( count($configoptions) )
    {
        echo "<p><b>Configurable Options</b></p>\n<table>";
        foreach( $configoptions as $configoption )
        {
            $optionid = $configoption['id'];
            $optionhidden = $configoption['hidden'];
            $optionname = $optionhidden ? $configoption['optionname'] . " <i>(" . $aInt->lang('global', 'hidden') . ")</i>" : $configoption['optionname'];
            $optiontype = $configoption['optiontype'];
            $selectedvalue = $configoption['selectedvalue'];
            $selectedqty = $configoption['selectedqty'];
            echo "<tr><td class=\"fieldlabel\">" . $optionname . "</td><td class=\"fieldarea\">";
            if( $optiontype == '1' )
            {
                echo "<select name=\"configoption[" . $optionid . "]" . "\">";
                foreach( $configoption['options'] as $option )
                {
                    echo "<option value=\"" . $option['id'] . "\"";
                    if( $option['hidden'] )
                    {
                        echo " style='color:#ccc;'";
                    }
                    if( $selectedvalue == $option['id'] )
                    {
                        echo " selected";
                    }
                    echo ">" . $option['name'] . "</option>";
                }
                echo "</select>";
            }
            else
            {
                if( $optiontype == '2' )
                {
                    foreach( $configoption['options'] as $option )
                    {
                        echo "<input type=\"radio\" name=\"configoption[" . $optionid . "]" . "\" value=\"" . $option['id'] . "\"";
                        if( $selectedvalue == $option['id'] )
                        {
                            echo " checked";
                        }
                        if( $option['hidden'] )
                        {
                            echo "> <span style='color:#ccc;'>" . $option['name'] . "</span><br />";
                        }
                        else
                        {
                            echo "> " . $option['name'] . "<br />";
                        }
                    }
                }
                else
                {
                    if( $optiontype == '3' )
                    {
                        echo "<input type=\"checkbox\" name=\"configoption[" . $optionid . "]" . "\" value=\"1\"";
                        if( $selectedqty )
                        {
                            echo " checked";
                        }
                        echo "> " . $configoption['options'][0]['name'];
                    }
                    else
                    {
                        if( $optiontype == '4' )
                        {
                            echo "<input type=\"text\" name=\"configoption[" . $optionid . "]" . "\" value=\"" . $selectedqty . "\" size=\"5\"> x " . $configoption['options'][0]['name'];
                        }
                    }
                }
            }
        }
        echo "</table>";
    }
    exit();
}
if( $action == 'loadprod' )
{
    $result = select_query('tblquotes', 'userid,currency', array( 'id' => $id ));
    $data = mysql_fetch_array($result);
    $userid = $data['userid'];
    $currencyid = $data['currency'];
    $currency = getCurrency($userid, $currencyid);
    $aInt->title = "Load Product";
    $aInt->content = "<script>\n\$(document).ready(function(){\n\$(\"#addproduct\").change(function () {\n    if (this.options[this.selectedIndex].value) {\n        \$(\"#add_desc\").val(this.options[this.selectedIndex].text);\n        \$.post(\"quotes.php\", { action: \"getproddetails\", currency: " . $currency['id'] . ", pid: this.options[this.selectedIndex].value, token: \"" . generate_token('plain') . "\" },\n        function(data){\n            \$(\"#configops\").html(data);\n        });\n    }\n});\n});\nfunction selectproduct() {\n    window.opener.location.href = \"quotes.php?action=addproduct&id=" . $id . "&\"+\$(\"#addfrm\").serialize();\n    window.close();\n}\n</script>\n<form id=\"addfrm\" onsubmit=\"selectproduct();return false\">\n" . generate_token('form') . "\n<p><b>Product/Service</b></p><p><select name=\"pid\" id=\"addproduct\" style=\"width:95%;\"><option>Choose a product...</option>";
    $products = new WHMCS_Product_Products();
    $productsList = $products->getProducts();
    foreach( $productsList as $data )
    {
        $productid = $data['id'];
        $groupname = $data['groupname'];
        $productname = $data['name'];
        $aInt->content .= "<option value=\"" . $productid . "\">" . $groupname . " - " . $productname . "</option>";
    }
    $aInt->content .= "</select></p>\n<div id=\"configops\"></div>\n<p align=\"center\"><input type=\"submit\" value=\"Select\" /></p>\n</form>";
    $aInt->displayPopUp();
    exit();
}
if( $action == 'addproduct' )
{
    check_token("WHMCS.admin.default");
    $result = select_query('tblquotes', 'userid,currency', array( 'id' => $id ));
    $data = mysql_fetch_array($result);
    $userid = $data['userid'];
    $currencyid = $data['currency'];
    $currency = getCurrency($userid, $currencyid);
    $result = select_query('tblproducts', "tblproducts.name,tblproducts.tax,tblproductgroups.name AS groupname", array( "tblproducts.id" => $pid ), '', '', '', "tblproductgroups ON tblproductgroups.id=tblproducts.gid");
    $data = mysql_fetch_array($result);
    $groupname = $data['groupname'];
    $prodname = $data['name'];
    $tax = $data['tax'];
    $desc = $groupname . " - " . $prodname;
    $pricing = getPricingInfo($pid);
    $billingcycle = $pricing['minprice']['cycle'];
    if( $billingcycle == 'onetime' )
    {
        $billingcycle = 'monthly';
    }
    $amount = $pricing['rawpricing'][$billingcycle];
    $configoptions = getCartConfigOptions($pid, $configoption, $billingcycle);
    foreach( $configoptions as $option )
    {
        $desc .= "\n" . $option['optionname'] . ": " . $option['selectedname'];
        $amount += $option['selectedsetup'] + $option['selectedrecurring'];
    }
    insert_query('tblquoteitems', array( 'quoteid' => $id, 'description' => $desc, 'quantity' => '1', 'unitprice' => $amount, 'discount' => '0', 'taxable' => $tax ));
    saveQuote($id, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', true);
    redir("action=manage&id=" . $id);
}
if( $action == 'save' )
{
    check_token("WHMCS.admin.default");
    $lineitems = array(  );
    if( $desc )
    {
        foreach( $desc as $lid => $description )
        {
            $lineitems[] = array( 'id' => $lid, 'desc' => $description, 'qty' => $qty[$lid], 'up' => $up[$lid], 'discount' => $discount[$lid], 'taxable' => $taxable[$lid] );
        }
    }
    if( $add_desc )
    {
        $lineitems[] = array( 'desc' => $add_desc, 'qty' => $add_qty, 'up' => $add_up, 'discount' => $add_discount, 'taxable' => $add_taxable );
    }
    $id = saveQuote($id, $subject, $stage, $datecreated, $validuntil, $clienttype, $userid, $firstname, $lastname, $companyname, $email, $address1, $address2, $city, $state, $postcode, $country, $phonenumber, $currency, $lineitems, $proposal, $customernotes, $adminnotes);
    logActivity("Modified Quote - Quote ID: " . $id, $userid);
    redir("action=manage&id=" . $id);
}
if( $action == 'duplicate' )
{
    check_token("WHMCS.admin.default");
    $addstr = '';
    $result = select_query('tblquotes', '', array( 'id' => $id ));
    $data = mysql_fetch_array($result);
    foreach( $data as $key => $value )
    {
        if( is_numeric($key) )
        {
            if( $key == '0' )
            {
                $value = '';
            }
            if( $key == '2' )
            {
                $value = 'Draft';
            }
            $addstr .= "'" . addslashes($value) . "',";
        }
    }
    $addstr = substr($addstr, 0, 0 - 1);
    $query = "INSERT INTO tblquotes VALUES (" . $addstr . ")";
    full_query($query);
    $newquoteid = mysql_insert_id();
    $result = select_query('tblquoteitems', '', array( 'quoteid' => $id ), 'id', 'ASC');
    while( $data = mysql_fetch_array($result) )
    {
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
                    $value = $newquoteid;
                }
                $addstr .= "'" . addslashes($value) . "',";
            }
        }
        $addstr = substr($addstr, 0, 0 - 1);
        $query = "INSERT INTO tblquoteitems VALUES (" . $addstr . ")";
        full_query($query);
    }
    redir("action=manage&id=" . $newquoteid . "&duplicated=true");
}
if( $action == 'delete' )
{
    check_token("WHMCS.admin.default");
    delete_query('tblquotes', array( 'id' => $id ));
    delete_query('tblquoteitems', array( 'quoteid' => $id ));
    redir();
}
if( $action == 'deleteline' )
{
    check_token("WHMCS.admin.default");
    delete_query('tblquoteitems', array( 'id' => $lid ));
    saveQuote($id, $subject, $stage, $datecreated, $validuntil, $clienttype, $userid, $firstname, $lastname, $companyname, $email, $address1, $address2, $city, $state, $postcode, $country, $phonenumber, $currency, $lineitems, $proposal, $customernotes, $adminnotes, true);
    redir("action=manage&id=" . $id);
}
if( $action == 'dlpdf' )
{
    $pdfdata = genQuotePDF($id);
    global $_LANG;
    header("Pragma: public");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0, private");
    header("Cache-Control: private", false);
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"" . $_LANG['quotefilename'] . $id . ".pdf\"");
    header("Content-Transfer-Encoding: binary");
    echo $pdfdata;
    exit();
}
if( $action == 'sendpdf' )
{
    check_token("WHMCS.admin.default");
    if( get_query_val('tblquotes', 'datesent', array( 'id' => $id )) == '0000-00-00' )
    {
        update_query('tblquotes', array( 'datesent' => "now()" ), array( 'id' => $id ));
    }
    sendQuotePDF($id);
    redir("action=manage&id=" . $id . "&sent=true");
}
if( $action == 'convert' )
{
    check_token("WHMCS.admin.default");
    $invoiceid = convertQuotetoInvoice($id, $invoicetype, $invoiceduedate, $depositpercent, $depositduedate, $finalduedate, $sendemail);
    redir("action=edit&id=" . $invoiceid, "invoices.php");
}
ob_start();
$aInt->deleteJSConfirm('doDelete', 'quotes', 'deletesure', "?action=delete&id=");
$aInt->deleteJSConfirm('doDeleteLine', 'invoices', 'deletelineitem', "?action=deleteline&id=" . $id . "&lid=");
if( !$action )
{
    echo $aInt->Tabs(array( $aInt->lang('global', 'searchfilter') ), true);
    echo "\n<div id=\"tab0box\" class=\"tabbox\">\n  <div id=\"tab_content\">\n\n<form action=\"";
    echo $whmcs->getPhpSelf();
    echo "\" method=\"get\"><input type=\"hidden\" name=\"filter\" value=\"true\">\n\n<table class=\"form\" width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\">\n<tr>\n    <td width=\"15%\" class=\"fieldlabel\">\n        ";
    echo $aInt->lang('emails', 'subject');
    echo "    </td>\n    <td class=\"fieldarea\">\n        <input type=\"text\" name=\"subject\" size=\"50\" value=\"";
    echo $subject;
    echo "\">\n    </td>\n    <td width=\"15%\" class=\"fieldlabel\">\n        ";
    if( $whmcs->get_config('DisableClientDropdown') )
    {
        echo $aInt->lang('fields', 'clientid');
    }
    else
    {
        echo $aInt->lang('fields', 'client');
    }
    echo "    </td>\n    <td class=\"fieldarea\">\n        ";
    echo $aInt->clientsDropDown($userid, '', 'userid', true);
    echo "    </td>\n</tr>\n<tr><td class=\"fieldlabel\">";
    echo $aInt->lang('quotes', 'stage');
    echo "</td><td class=\"fieldarea\"><select name=\"stage\">\n<option value=\"\">";
    echo $aInt->lang('global', 'any');
    echo "</option>\n<option";
    if( $stage == 'Draft' )
    {
        echo " selected";
    }
    echo ">";
    echo $aInt->lang('quotes', 'stagedraft');
    echo "</option>\n<option";
    if( $stage == 'Delivered' )
    {
        echo " selected";
    }
    echo ">";
    echo $aInt->lang('quotes', 'stagedelivered');
    echo "</option>\n<option";
    if( $stage == "On Hold" )
    {
        echo " selected";
    }
    echo ">";
    echo $aInt->lang('quotes', 'stageonhold');
    echo "</option>\n<option";
    if( $stage == 'Accepted' )
    {
        echo " selected";
    }
    echo ">";
    echo $aInt->lang('quotes', 'stageaccepted');
    echo "</option>\n<option";
    if( $stage == 'Lost' )
    {
        echo " selected";
    }
    echo ">";
    echo $aInt->lang('quotes', 'stagelost');
    echo "</option>\n<option";
    if( $stage == 'Dead' )
    {
        echo " selected";
    }
    echo ">";
    echo $aInt->lang('quotes', 'stagedead');
    echo "</option>\n</select></td><td class=\"fieldlabel\">";
    echo $aInt->lang('quotes', 'validityperiod');
    echo "</td><td class=\"fieldarea\"><select name=\"validity\"><option value=\"\">";
    echo $aInt->lang('global', 'any');
    echo "</option><option>";
    echo $aInt->lang('status', 'valid');
    echo "</option><option>";
    echo $aInt->lang('status', 'expired');
    echo "</option></select></td></tr>\n</table>\n\n<img src=\"images/spacer.gif\" height=\"10\" width=\"1\"><br>\n<DIV ALIGN=\"center\"><input type=\"submit\" value=\"Filter\" class=\"button\"></DIV>\n\n</form>\n\n  </div>\n</div>\n\n<br />\n\n";
    $aInt->sortableTableInit('lastmodified', 'DESC');
    $where = array(  );
    if( $stage )
    {
        $where['stage'] = $stage;
    }
    if( $validity == 'Valid' )
    {
        $where['validuntil'] = array( 'sqltype' => ">", 'value' => date('Ymd') );
    }
    if( $validity == 'Expired' )
    {
        $where['validuntil'] = array( 'sqltype' => "<=", 'value' => date('Ymd') );
    }
    if( $userid )
    {
        $where['userid'] = $userid;
    }
    if( $subject )
    {
        $where['subject'] = array( 'sqltype' => 'LIKE', 'value' => $subject );
    }
    $numresults = select_query('tblquotes', '', $where);
    $numrows = mysql_num_rows($numresults);
    $result = select_query('tblquotes', '', $where, $orderby, $order, $page * $limit . ',' . $limit);
    while( $data = mysql_fetch_array($result) )
    {
        $id = $data['id'];
        $subject = $data['subject'];
        $userid = $data['userid'];
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $companyname = $data['companyname'];
        $stage = $data['stage'];
        $total = $data['total'];
        $validuntil = $data['validuntil'];
        $lastmodified = $data['lastmodified'];
        $validuntil = fromMySQLDate($validuntil);
        $lastmodified = fromMySQLDate($lastmodified);
        if( $userid )
        {
            $clientlink = $aInt->outputClientLink($userid);
        }
        else
        {
            $clientlink = $firstname . " " . $lastname;
            if( $companyname )
            {
                $clientlink .= " (" . $companyname . ")";
            }
        }
        $tabledata[] = array( "<a href=\"quotes.php?action=manage&id=" . $id . "\">" . $id . "</a>", "<a href=\"quotes.php?action=manage&id=" . $id . "\">" . $subject . "</a>", $clientlink, $stage, $total, $validuntil, $lastmodified, "<a href=\"quotes.php?action=manage&id=" . $id . "\"><img src=\"images/edit.gif\" width=\"16\" height=\"16\" border=\"0\" alt=\"Edit\"></a>", "<a href=\"#\" onClick=\"doDelete('" . $id . "');return false\"><img src=\"images/delete.gif\" width=\"16\" height=\"16\" border=\"0\" alt=\"Delete\"></a>" );
    }
    echo $aInt->sortableTable(array( array( 'id', 'ID' ), array( 'subject', 'Subject' ), "Client Name", array( 'stage', 'Stage' ), array( 'total', 'Total' ), array( 'validuntil', "Valid Until" ), array( 'lastmodified', "Last Modified" ), '', '' ), $tabledata, $tableformurl, $tableformbuttons);
}
else
{
    if( $action == 'manage' )
    {
        if( $id )
        {
            $addons_html = run_hook('AdminAreaViewQuotePage', array( 'quoteid' => $id ));
            $result = select_query('tblquotes', '', array( 'id' => $id ));
            $data = mysql_fetch_array($result);
            $subject = $data['subject'];
            $stage = $data['stage'];
            $datecreated = fromMySQLDate($data['datecreated']);
            $datesent = $data['datesent'] != '0000-00-00' ? fromMySQLDate($data['datesent']) : '';
            $dateaccepted = $data['dateaccepted'] != '0000-00-00' ? fromMySQLDate($data['dateaccepted']) : '';
            $validuntil = fromMySQLDate($data['validuntil']);
            $userid = $data['userid'];
            $proposal = $data['proposal'];
            $customernotes = $data['customernotes'];
            $adminnotes = $data['adminnotes'];
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $companyname = $data['companyname'];
            $email = $data['email'];
            $address1 = $data['address1'];
            $address2 = $data['address2'];
            $city = $data['city'];
            $state = $data['state'];
            $postcode = $data['postcode'];
            $country = $data['country'];
            $phonenumber = $data['phonenumber'];
            $currencyid = $data['currency'];
            $currency = getCurrency($userid, $currencyid);
            $subtotal = $data['subtotal'];
            $tax1 = $data['tax1'];
            $tax2 = $data['tax2'];
            $total = $data['total'];
            if( !$userid )
            {
                $result = select_query('tblclients', "COUNT(*)", array( 'email' => $email ));
                $data = mysql_fetch_array($result);
                $emailexists = $data[0];
                if( $emailexists )
                {
                    infoBox($aInt->lang('quotes', 'emailexists'), $aInt->lang('quotes', 'emailexistsmsg'));
                }
            }
        }
        else
        {
            $datecreated = getTodaysDate();
            $validuntil = fromMySQLDate(date('Y-m-d', mktime(0, 0, 0, date('m') + 1, date('d'), date('Y'))));
            $clienttype = 'existing';
            $id = saveQuote('', '', '', $datecreated, $validuntil, $clienttype, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
        }
        if( $userid )
        {
            $clienttype = 'existing';
            $clientsdetails = getClientsDetails($userid);
            $fortax_state = $clientsdetails['state'];
            $fortax_country = $clientsdetails['country'];
        }
        else
        {
            $clienttype = 'new';
            $fortax_state = $state;
            $fortax_country = $country;
        }
        $taxlevel1 = getTaxRate(1, $fortax_state, $fortax_country);
        $taxlevel2 = getTaxRate(2, $fortax_state, $fortax_country);
        if( $duplicated )
        {
            infoBox($aInt->lang('quotes', 'quoteduplicated'), $aInt->lang('quotes', 'quoteduplicatedmsg') . $id);
        }
        if( $sent )
        {
            infoBox($aInt->lang('quotes', 'quotedelivered'), $aInt->lang('quotes', 'quotedeliveredmsg'));
        }
        echo $infobox;
        if( !$currency['id'] )
        {
            $currency['id'] = 1;
        }
        $jquerycode = "\$(\"#clienttypeexisting\").click(function () {\n    \$(\"#newclientform\").slideUp(\"slow\");\n});\n\$(\"#clienttypenew\").click(function () {\n    \$(\"#newclientform\").slideDown(\"slow\");\n});\n\$(\"#userdropdown\").change(function () {\n    \$(\"#clienttypeexisting\").click();\n});\n\$(\"#addproduct\").change(function () {\n    if (this.options[this.selectedIndex].value) {\n        \$.post(\"quotes.php\", { action: \"getdesc\", id: this.options[this.selectedIndex].value },\n        function(data){\n            \$(\"#add_desc\").val(data);\n        });\n        \$.post(\"quotes.php\", { action: \"getprice\", currency: " . $currency['id'] . ", id: this.options[this.selectedIndex].value },\n        function(data){\n            \$(\"#add_up\").val(data);\n        });\n    }\n});\n\$(\"textarea.expanding\").autogrow({\n    minHeight: 16,\n    lineHeight: 14\n});";
        $jscode .= "function selectSingle() {\n    \$(\"#singleoptions\").slideToggle();\n    \$(\"#depositoptions\").slideToggle();\n}\nfunction selectDeposit() {\n    \$(\"#singleoptions\").slideToggle();\n    \$(\"#depositoptions\").slideToggle();\n}";
        foreach( $addons_html as $addon_html )
        {
            echo "<div style=\"margin-bottom:15px;\">" . $addon_html . "</div>";
        }
        echo "\n<form method=\"post\" action=\"";
        echo $_SERVER['PHP_SELF'];
        echo "\" id=\"clientinfo\">\n<input type=\"hidden\" name=\"action\" value=\"save\" />\n";
        if( $id )
        {
            echo "<input type=\"hidden\" name=\"id\" value=\"";
            echo $id;
            echo "\" />";
        }
        echo "<h2>";
        echo $aInt->lang('quotes', 'generalinfo');
        echo "</h2>\n\n<table class=\"form\" width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\">\n<tr><td width=\"15%\" class=\"fieldlabel\">";
        echo $aInt->lang('quotes', 'subject');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"subject\" size=\"70\" value=\"";
        echo $subject;
        echo "\"></td><td width=\"15%\" class=\"fieldlabel\">";
        echo $aInt->lang('quotes', 'stage');
        echo "</td><td class=\"fieldarea\"><select name=\"stage\">\n<option";
        if( $stage == 'Draft' )
        {
            echo " selected";
        }
        echo ">";
        echo $aInt->lang('quotes', 'stagedraft');
        echo "</option>\n<option";
        if( $stage == 'Delivered' )
        {
            echo " selected";
        }
        echo ">";
        echo $aInt->lang('quotes', 'stagedelivered');
        echo "</option>\n<option";
        if( $stage == 'Accepted' )
        {
            echo " selected";
        }
        echo ">";
        echo $aInt->lang('quotes', 'stageaccepted');
        echo "</option>\n<option";
        if( $stage == 'Lost' )
        {
            echo " selected";
        }
        echo ">";
        echo $aInt->lang('quotes', 'stagelost');
        echo "</option>\n<option";
        if( $stage == 'Dead' )
        {
            echo " selected";
        }
        echo ">";
        echo $aInt->lang('quotes', 'stagedead');
        echo "</option>\n</select></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('quotes', 'datecreated');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"datecreated\" size=\"15\" value=\"";
        echo $datecreated;
        echo "\" class=\"datepick\"></td><td class=\"fieldlabel\">";
        echo $aInt->lang('quotes', 'validuntil');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"validuntil\" size=\"15\" value=\"";
        echo $validuntil;
        echo "\" class=\"datepick\"></td></tr>\n";
        if( $datesent || $dateaccepted )
        {
            echo "<tr>";
            if( $datesent )
            {
                echo "<td class=\"fieldlabel\">";
                echo $aInt->lang('quotes', 'datesent');
                echo "</td><td class=\"fieldarea\">";
                echo $datesent;
                echo "</td>";
            }
            if( $dateaccepted )
            {
                echo "<td class=\"fieldlabel\">";
                echo $aInt->lang('quotes', 'dateaccepted');
                echo "</td><td class=\"fieldarea\">";
                echo $dateaccepted;
                echo "</td>";
            }
            echo "</tr>\n";
        }
        echo "</table>\n\n<p align=\"center\"><input type=\"submit\" value=\"Save Changes\" class=\"btn-primary\" /> <input type=\"button\" value=\"Duplicate\" class=\"button\" onclick=\"window.location='quotes.php?action=duplicate&id=";
        echo $id . generate_token('link');
        echo "'\"";
        if( !$id )
        {
            echo " disabled=\"true\"";
        }
        echo " /> <input type=\"button\" value=\"Printable Version\" class=\"button\" onclick=\"window.open('../viewquote.php?id=";
        echo $id;
        echo "','windowfrm','menubar=yes,toolbar=yes,scrollbars=yes,resizable=yes,width=750,height=600')\" \"";
        if( !$id )
        {
            echo " disabled=\"true\"";
        }
        echo " /> <input type=\"button\" value=\"View PDF\" class=\"button\" onclick=\"window.open('../dl.php?type=q&id=";
        echo $id;
        echo "&viewpdf=1','pdfquote','')\" /> <input type=\"button\" value=\"Download PDF\" class=\"button\" onclick=\"window.location='";
        echo $_SERVER['PHP_SELF'];
        echo "?action=dlpdf&id=";
        echo $id;
        echo "';\"";
        if( !$id )
        {
            echo " disabled=\"true\"";
        }
        echo " /> <input type=\"button\" value=\"Email as PDF\" class=\"button\" onclick=\"window.location='quotes.php?action=sendpdf&id=";
        echo $id . generate_token('link');
        echo "';\"";
        if( !$id )
        {
            echo " disabled=\"true\"";
        }
        echo " /> <input type=\"button\" value=\"Convert to Invoice\" onClick=\"showDialog('quoteconvert')\"";
        if( !$id )
        {
            echo " disabled=\"true\"";
        }
        echo " /> <input type=\"button\" value=\"Delete\" class=\"btn warn\" onclick=\"doDelete('";
        echo $id;
        echo "');\"";
        if( !$id )
        {
            echo " disabled=\"true\"";
        }
        echo " /></p>\n\n<h2>";
        echo $aInt->lang('quotes', 'clientinfo');
        echo "</h2>\n\n<p><input type=\"radio\" name=\"clienttype\" value=\"existing\" id=\"clienttypeexisting\"";
        if( $clienttype == 'existing' )
        {
            echo " checked";
        }
        echo " /> <label for=\"clienttypeexisting\">";
        echo $aInt->lang('quotes', 'quoteexistingclient');
        echo ":</label> ";
        echo str_replace("<select", "<select id=\"userdropdown\"", $aInt->clientsDropDown($userid));
        echo " ";
        if( $clienttype == 'existing' )
        {
            echo " <a href=\"clientssummary.php?userid=" . $userid . "\" target=\"_blank\">View Client Profile</a>";
        }
        echo "<br /><input type=\"radio\" name=\"clienttype\" value=\"new\" id=\"clienttypenew\"";
        if( $clienttype == 'new' )
        {
            echo " checked";
        }
        echo " /> <label for=\"clienttypenew\">";
        echo $aInt->lang('quotes', 'quotenewclient');
        echo "</label></p>\n\n<div id=\"newclientform\"";
        if( $clienttype == 'existing' )
        {
            echo " style=\"display:none;\"";
        }
        echo ">\n<table class=\"form\" width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\">\n<tr><td width=\"15%\" class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'firstname');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"firstname\" size=\"30\" value=\"";
        echo $firstname;
        echo "\"></td><td width=\"15%\" class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'address1');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"address1\" size=\"30\" value=\"";
        echo $address1;
        echo "\"></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'lastname');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"lastname\" size=\"30\" value=\"";
        echo $lastname;
        echo "\"></td><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'address2');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"address2\" size=\"30\" value=\"";
        echo $address2;
        echo "\"></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'companyname');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"companyname\" size=\"30\" value=\"";
        echo $companyname;
        echo "\"></td><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'city');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"city\" size=\"30\" value=\"";
        echo $city;
        echo "\"></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'email');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"email\" size=\"30\" value=\"";
        echo $email;
        echo "\"></td><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'state');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"state\" size=\"30\" value=\"";
        echo $state;
        echo "\"></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'phonenumber');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"phonenumber\" size=\"30\" value=\"";
        echo $phonenumber;
        echo "\"></td><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'postcode');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"postcode\" size=\"30\" value=\"";
        echo $postcode;
        echo "\"></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('currencies', 'currency');
        echo "</td><td class=\"fieldarea\"><select name=\"currency\">";
        $result = select_query('tblcurrencies', "id,code,`default`", '', 'code', 'ASC');
        while( $data = mysql_fetch_array($result) )
        {
            echo "<option value=\"" . $data['id'] . "\"";
            if( $currencyid && $data['id'] == $currencyid || !$currencyid && $data['default'] )
            {
                echo " selected";
            }
            echo ">" . $data['code'] . "</option>";
        }
        echo "</select></td><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'country');
        echo "</td><td class=\"fieldarea\">";
        include("../includes/countries.php");
        echo getCountriesDropDown($country);
        echo "</td></tr>\n</table>\n</div>\n\n<h2>";
        echo $aInt->lang('quotes', 'lineitems');
        echo "</h2>\n\n<script type=\"text/javascript\" src=\"../includes/jscript/jqueryag.js\"></script>\n\n<table width=100% cellspacing=1 bgcolor=\"#cccccc\" align=center><tr bgcolor=\"#efefef\" style=\"text-align:center;font-weight:bold\"><td width=\"50\">";
        echo $aInt->lang('quotes', 'qty');
        echo "</td><td>";
        echo $aInt->lang('quotes', 'description');
        echo "</td><td width=90>";
        echo $aInt->lang('quotes', 'unitprice');
        echo "</td><td width=90>";
        echo $aInt->lang('quotes', 'discount');
        echo "</td><td width=90>";
        echo $aInt->lang('quotes', 'total');
        echo "</td><td width=50>";
        echo $aInt->lang('quotes', 'taxed');
        echo "</td><td width=20></td></tr>\n";
        if( $id )
        {
            $result = select_query('tblquoteitems', '', array( 'quoteid' => $id ), 'id', 'ASC');
            for( $i = 0; $data = mysql_fetch_array($result); $i++ )
            {
                $line_id = $data['id'];
                $line_desc = $data['description'];
                $line_qty = $data['quantity'];
                $line_unitprice = $data['unitprice'];
                $line_discount = $data['discount'];
                $line_taxable = $data['taxable'];
                $line_total = formatCurrency($line_qty * $line_unitprice * (1 - $line_discount / 100));
                echo "<tr bgcolor=#ffffff style=\"text-align:center;\"><td><input type=\"text\" name=\"qty[" . $line_id . "]" . "\" size=\"4\" value=\"" . $line_qty . "\"></td><td><textarea name=\"desc[" . $line_id . "]" . "\" class=\"expanding\" style=\"width:98%\">" . $line_desc . "</textarea></td><td><input type=\"text\" name=\"up[" . $line_id . "]" . "\" size=\"10\" value=\"" . $line_unitprice . "\"></td><td><input type=\"text\" name=\"discount[" . $line_id . "]" . "\" size=\"10\" value=\"" . $line_discount . "\"></td><td>" . $CONFIG['CurrencySymbol'] . $line_total . "</td><td><input type=\"checkbox\" name=\"taxable[" . $line_id . "]" . "\" value=\"1\"";
                if( $line_taxable )
                {
                    echo " checked";
                }
                echo "></td><td width=20 align=center><a href=\"#\" onClick=\"doDeleteLine('" . $line_id . "');return false\"><img src=\"images/delete.gif\" border=\"0\"></tr>";
            }
        }
        echo "<tr bgcolor=#ffffff style=\"text-align:center;\"><td><input type=\"text\" name=\"add_qty\" size=\"4\" value=\"1\"></td><td><textarea name=\"add_desc\" id=\"add_desc\" class=\"expanding\" style=\"width:98%\"></textarea></td><td><input type=\"text\" name=\"add_up\" id=\"add_up\" size=\"10\" value=\"0.00\"></td><td><input type=\"text\" name=\"add_discount\" size=\"10\" value=\"0.00\"></td><td></td><td><input type=\"checkbox\" name=\"add_taxable\" value=\"1\" /></td><td></td></tr>\n<tr bgcolor=\"#efefef\" style=\"text-align:center;font-weight:bold\"><td colspan=\"4\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td style=\"text-align:left;font-weight:normal;\"><a href=\"#\" onclick=\"";
        $aInt->popupWindow($_SERVER['PHP_SELF'] . "?action=loadprod&id=" . $id, 'clientinfo');
        echo "\"><img src=\"images/icons/add.png\" border=\"0\" align=\"absmiddle\" /> Add a Predefined Product</a></td><td align=\"right\">";
        echo $aInt->lang('quotes', 'subtotal');
        echo "&nbsp;</td></tr></table></td><td width=90>";
        echo formatCurrency($subtotal);
        echo "</td><td></td><td></td></tr>\n";
        if( $CONFIG['TaxEnabled'] == 'on' )
        {
            if( 0 < $taxlevel1['rate'] )
            {
                echo "<tr bgcolor=\"#efefef\" style=\"text-align:center;font-weight:bold\"><td colspan=\"4\" align=\"right\">";
                echo $taxlevel1['name'];
                echo " @ ";
                echo $taxlevel1['rate'];
                echo "%:&nbsp;</td><td width=90>";
                echo formatCurrency($tax1);
                echo "</td><td></td><td></td></tr>";
            }
            if( 0 < $taxlevel2['rate'] )
            {
                echo "<tr bgcolor=\"#efefef\" style=\"text-align:center;font-weight:bold\"><td colspan=\"4\" align=\"right\">";
                echo $taxlevel2['name'];
                echo " @ ";
                echo $taxlevel2['rate'];
                echo "%:&nbsp;</td><td width=90>";
                echo formatCurrency($tax2);
                echo "</td><td></td><td></td></tr>";
            }
        }
        echo "<tr bgcolor=\"#efefef\" style=\"text-align:center;font-weight:bold\"><td colspan=\"4\" align=\"right\">";
        echo $aInt->lang('quotes', 'totaldue');
        echo "&nbsp;</td><td width=90>";
        echo formatCurrency($total);
        echo "</td><td></td><td></td></tr>\n</table>\n\n<h2>";
        echo $aInt->lang('quotes', 'notes');
        echo "</h2>\n\n<table class=\"form\" width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\">\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('quotes', 'proposaltext');
        echo "<br />";
        echo $aInt->lang('quotes', 'proposaltextmsg');
        echo "</td><td class=\"fieldarea\"><textarea name=\"proposal\" rows=\"5\" style=\"width:98%\">";
        echo $proposal;
        echo "</textarea></td></tr>\n<tr><td width=\"15%\" class=\"fieldlabel\">";
        echo $aInt->lang('quotes', 'customernotes');
        echo "<br />";
        echo $aInt->lang('quotes', 'customernotesmsg');
        echo "</td><td class=\"fieldarea\"><textarea name=\"customernotes\" rows=\"5\" style=\"width:98%\">";
        echo $customernotes;
        echo "</textarea></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('quotes', 'adminonlynotes');
        echo "<br />";
        echo $aInt->lang('quotes', 'adminonlynotesmsg');
        echo "</td><td class=\"fieldarea\"><textarea name=\"adminnotes\" rows=\"5\" style=\"width:98%\">";
        echo $adminnotes;
        echo "</textarea></td></tr>\n</table>\n\n<p align=\"center\"><input type=\"submit\" value=\"Save Changes\" class=\"btn-primary\" /> <input type=\"button\" value=\"Duplicate\" class=\"button\" onclick=\"window.location='quotes.php?action=duplicate&id=";
        echo $id . generate_token('link');
        echo "'\"";
        if( !$id )
        {
            echo " disabled=\"true\"";
        }
        echo " /> <input type=\"button\" value=\"Printable Version\" class=\"button\" onclick=\"window.open('../viewquote.php?id=";
        echo $id;
        echo "','windowfrm','menubar=yes,toolbar=yes,scrollbars=yes,resizable=yes,width=750,height=600')\" \"";
        if( !$id )
        {
            echo " disabled=\"true\"";
        }
        echo " /> <input type=\"button\" value=\"View PDF\" class=\"button\" onclick=\"window.open('../dl.php?type=q&id=";
        echo $id;
        echo "&viewpdf=1','pdfquote','')\" /> <input type=\"button\" value=\"Download PDF\" class=\"button\" onclick=\"window.location='";
        echo $_SERVER['PHP_SELF'];
        echo "?action=dlpdf&id=";
        echo $id;
        echo "';\"";
        if( !$id )
        {
            echo " disabled=\"true\"";
        }
        echo " /> <input type=\"button\" value=\"Email as PDF\" class=\"button\" onclick=\"window.location='quotes.php?action=sendpdf&id=";
        echo $id . generate_token('link');
        echo "';\"";
        if( !$id )
        {
            echo " disabled=\"true\"";
        }
        echo " /> <input type=\"button\" value=\"Convert to Invoice\" onClick=\"showDialog('quoteconvert')\"";
        if( !$id )
        {
            echo " disabled=\"true\"";
        }
        echo " /> <input type=\"button\" value=\"Delete\" class=\"btn warn\" onclick=\"doDelete('";
        echo $id;
        echo "');\"";
        if( !$id )
        {
            echo " disabled=\"true\"";
        }
        echo " /></p>\n\n</form>\n\n";
        $content = "<form id=\"convertquotefrm\">\n" . generate_token('form') . "\n<label><input type=\"radio\" name=\"invoicetype\" value=\"single\" onclick=\"selectSingle()\" checked /> Generate a single invoice for the entire amount</label><br />\n<div id=\"singleoptions\" align=\"center\">\n<br />\nDue Date of Invoice: <input type=\"text\" name=\"invoiceduedate\" value=\"" . getTodaysDate() . "\" class=\"datepick\" />\n<br /><br />\n</div>\n<label><input type=\"radio\" name=\"invoicetype\" value=\"deposit\" onclick=\"selectDeposit()\" /> Split into 2 invoices - a deposit and final payment</label><br />\n<div id=\"depositoptions\" align=\"center\" style=\"display:none;\">\n<br />\nEnter Deposit Percentage: <input type=\"text\" name=\"depositpercent\" value=\"50\" size=\"5\" />%<br />\nDue Date of Deposit: <input type=\"text\" name=\"depositduedate\" value=\"" . getTodaysDate() . "\" class=\"datepick\" /><br />\nDue Date of Final Payment: <input type=\"text\" name=\"finalduedate\" value=\"" . fromMySQLDate(date('Y-m-d', mktime(0, 0, 0, date('m') + 1, date('d'), date('Y')))) . "\" class=\"datepick\" />\n</div>\n<br />\n<label><input type=\"checkbox\" name=\"sendemail\" checked /> Send Invoice Notification Email</label>\n</form>";
        echo $aInt->jqueryDialog('quoteconvert', "Convert to Invoice", $content, array( 'Submit' => "window.location='?action=convert&id=" . $id . "&'+\$('#convertquotefrm').serialize();" ), '', '500', '');
    }
}
$content = ob_get_contents();
ob_end_clean();
$aInt->content = $content;
$aInt->jquerycode = $jquerycode;
$aInt->jscode = $jscode;
$aInt->display();