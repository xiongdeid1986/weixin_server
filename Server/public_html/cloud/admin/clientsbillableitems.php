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
if( !$action )
{
    $reqperm = "View Billable Items";
}
else
{
    $reqperm = "Manage Billable Items";
}
$aInt = new WHMCS_Admin($reqperm);
$aInt->inClientsProfile = true;
$aInt->requiredFiles(array( 'invoicefunctions', 'processinvoices', 'gatewayfunctions', 'clientfunctions' ));
if( $action == 'getproddesc' )
{
    check_token("WHMCS.admin.default");
    $result = select_query('tblproducts', 'name,description', array( 'id' => $id ));
    $data = mysql_fetch_array($result);
    echo $data[0];
    if( $data[1] )
    {
        echo " - " . $data[1];
    }
    exit();
}
if( $action == 'getprodprice' )
{
    check_token("WHMCS.admin.default");
    if( !$currency )
    {
        $currency = getCurrency();
        $currency = $currency['id'];
    }
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
$aInt->valUserID($userid);
getUsersLang($userid);
$aInt->assertClientBoundary($userid);
if( $action == 'addtime' )
{
    check_token("WHMCS.admin.default");
    for( $i = 0; $i <= 9; $i++ )
    {
        if( $description[$i] )
        {
            if( $description[$i] )
            {
                $desc = $description[$i];
            }
            $amount = $rate[$i];
            if( $hours[$i] != 0 )
            {
                $desc .= " - " . $hours[$i] . " " . $_LANG['billableitemshours'] . " @ " . $rate[$i] . '/' . $_LANG['billableitemshour'];
                $amount = $amount * $hours[$i];
            }
            insert_query('tblbillableitems', array( 'userid' => $userid, 'description' => $desc, 'hours' => $hours[$i], 'amount' => $amount, 'recur' => 0, 'recurcycle' => 0, 'recurfor' => 0, 'invoiceaction' => 0, 'duedate' => "now()" ));
        }
    }
    redir("userid=" . $userid);
}
if( $action == 'save' )
{
    check_token("WHMCS.admin.default");
    $duedate = toMySQLDate($duedate);
    if( $id )
    {
        if( $hours != 0 )
        {
            if( strpos($description, " " . $_LANG['billableitemshours'] . " @ ") )
            {
                $description = substr($description, 0, strrpos($description, " - ")) . " - " . $hours . " " . $_LANG['billableitemshours'] . " @ " . $amount . '/' . $_LANG['billableitemshour'];
            }
            $amount = $amount * $hours;
        }
        update_query('tblbillableitems', array( 'description' => $description, 'hours' => $hours, 'amount' => $amount, 'recur' => $recur, 'recurcycle' => $recurcycle, 'recurfor' => $recurfor, 'invoiceaction' => $invoiceaction, 'duedate' => $duedate, 'invoicecount' => $invoicecount ), array( 'id' => $id ));
    }
    else
    {
        if( $hours != 0 )
        {
            $description .= " - " . $hours . " " . $_LANG['billableitemshours'] . " @ " . $amount . '/' . $_LANG['billableitemshour'];
            $amount = $amount * $hours;
        }
        $id = insert_query('tblbillableitems', array( 'userid' => $userid, 'description' => $description, 'hours' => $hours, 'amount' => $amount, 'recur' => $recur, 'recurcycle' => $recurcycle, 'recurfor' => $recurfor, 'invoiceaction' => $invoiceaction, 'duedate' => $duedate ));
    }
    redir("userid=" . $userid);
}
if( $action == 'delete' )
{
    check_token("WHMCS.admin.default");
    delete_query('tblbillableitems', array( 'id' => $id ));
    redir("userid=" . $userid);
}
$currency = getCurrency($userid);
ob_start();
if( !$action )
{
    if( $invoice && is_array($bitem) )
    {
        check_token("WHMCS.admin.default");
        checkPermission("Manage Billable Items");
        foreach( $bitem as $id => $v )
        {
            update_query('tblbillableitems', array( 'invoiceaction' => '1', 'duedate' => "now()" ), array( 'id' => $id ));
        }
        $invoiceid = createInvoices($userid);
        infoBox($aInt->lang('invoices', 'gencomplete'), $aInt->lang('billableitems', 'itemsinvoiced') . " <a href=\"invoices.php?action=edit&id=" . $invoiceid . "\" target=\"_blank\">" . $aInt->lang('fields', 'invoicenum') . $invoiceid . "</a>");
        echo $infobox;
    }
    if( $delete && is_array($bitem) )
    {
        check_token("WHMCS.admin.default");
        checkPermission("Manage Billable Items");
        foreach( $bitem as $id => $v )
        {
            delete_query('tblbillableitems', array( 'id' => $id ));
        }
        infoBox($aInt->lang('billableitems', 'itemsdeleted'), $aInt->lang('billableitems', 'itemsdeleteddesc'));
        echo $infobox;
    }
    $aInt->deleteJSConfirm('doDelete', 'billableitems', 'itemsdeletequestion', "clientsbillableitems.php?userid=" . $userid . "&action=delete&id=");
    $result = select_query('tblbillableitems', "COUNT(id),SUM(amount)", array( 'userid' => $userid, 'invoicecount' => '0' ));
    $data = mysql_fetch_array($result);
    $unbilledcount = $data[0];
    $unbilledamount = formatCurrency($data[1]);
    echo "<div align=\"right\"><input type=\"button\" value=\"" . $aInt->lang('billableitems', 'additem') . "\" class=\"button\" onClick=\"window.location='clientsbillableitems.php?userid=" . $userid . "&action=manage'\"> <input type=\"button\" value=\"" . $aInt->lang('billableitems', 'addtimebilling') . "\" class=\"button\" onClick=\"window.location='clientsbillableitems.php?userid=" . $userid . "&action=timebilling'\"></div><h2>" . $aInt->lang('billableitems', 'uninvoiced') . " - <span class=\"textred\">" . $unbilledamount . "</span> (" . $unbilledcount . ")</h2>";
    $aInt->sortableTableInit('nopagination');
    $result = select_query('tblbillableitems', "COUNT(*)", array( 'userid' => $userid, 'invoicecount' => '0' ));
    $data = mysql_fetch_array($result);
    $numrows = $data[0];
    $tabledata = '';
    $result = select_query('tblbillableitems', '', array( 'userid' => $userid, 'invoicecount' => '0' ), $orderby, $order, $page * $limit . ',' . $limit);
    while( $data = mysql_fetch_array($result) )
    {
        $id = $data['id'];
        $label = $data['label'];
        $description = $data['description'];
        $hours = $data['hours'];
        $amount = $data['amount'];
        $invoiceaction = $data['invoiceaction'];
        $invoicecount = $data['invoicecount'];
        $amount = formatCurrency($amount);
        if( $invoiceaction == '0' )
        {
            $invoiceaction = $aInt->lang('billableitems', 'dontinvoice');
        }
        else
        {
            if( $invoiceaction == '1' )
            {
                $invoiceaction = $aInt->lang('billableitems', 'nextcronrun');
            }
            else
            {
                if( $invoiceaction == '2' )
                {
                    $invoiceaction = $aInt->lang('billableitems', 'nextinvoice');
                }
                else
                {
                    if( $invoiceaction == '3' )
                    {
                        $invoiceaction = $aInt->lang('billableitems', 'invoiceduedate');
                    }
                    else
                    {
                        if( $invoiceaction == '4' )
                        {
                            $invoiceaction = $aInt->lang('billableitems', 'recurringcycle');
                        }
                    }
                }
            }
        }
        $managelink = "<a href=\"clientsbillableitems.php?userid=" . $userid . "&action=manage&id=" . $id . "\">";
        $tabledata[] = array( "<input type=\"checkbox\" name=\"bitem[" . $id . "]\" class=\"checkall\" />", $managelink . $id . "</a>", $managelink . $description . "</a>", $hours, $amount, $invoiceaction, $managelink . "<img src=\"images/edit.gif\" width=\"16\" height=\"16\" border=\"0\" alt=\"" . $aInt->lang('global', 'edit') . "\"></a>", "<a href=\"#\" onClick=\"doDelete('" . $id . "');return false\"><img src=\"images/delete.gif\" width=\"16\" height=\"16\" border=\"0\" alt=\"" . $aInt->lang('global', 'delete') . "\"></a>" );
    }
    $tableformurl = $_SERVER['PHP_SELF'] . "?userid=" . $userid;
    $tableformbuttons = "<input type=\"submit\" name=\"invoice\" value=\"" . $aInt->lang('billableitems', 'invoiceselected') . "\" onclick=\"return confirm('" . $aInt->lang('billableitems', 'invoiceselectedconfirm', '1') . "')\" /> <input type=\"submit\" name=\"delete\" value=\"" . $aInt->lang('global', 'delete') . "\" class=\"btn-danger\" onclick=\"return confirm('" . $aInt->lang('global', 'deleteconfirm', '1') . "')\" />";
    echo $aInt->sortableTable(array( 'checkall', array( 'id', $aInt->lang('fields', 'id') ), array( 'description', $aInt->lang('fields', 'description') ), array( 'hours', $aInt->lang('fields', 'hours') ), array( 'amount', $aInt->lang('fields', 'amount') ), array( 'invoiceaction', $aInt->lang('billableitems', 'invoiceaction') ), '', '' ), $tabledata, $tableformurl, $tableformbuttons);
    echo "<h2>" . $aInt->lang('billableitems', 'invoiced') . "</h2>";
    $aInt->sortableTableInit('id', 'DESC');
    $result = select_query('tblbillableitems', "COUNT(*)", array( 'userid' => $userid, 'invoicecount' => array( 'sqltype' => ">", 'value' => '0' ) ));
    $data = mysql_fetch_array($result);
    $numrows = $data[0];
    $tabledata = '';
    $result = select_query('tblbillableitems', '', array( 'userid' => $userid, 'invoicecount' => array( 'sqltype' => ">", 'value' => '0' ) ), $orderby, $order, $page * $limit . ',' . $limit);
    while( $data = mysql_fetch_array($result) )
    {
        $id = $data['id'];
        $label = $data['label'];
        $description = $data['description'];
        $hours = $data['hours'];
        $amount = $data['amount'];
        $invoiceaction = $data['invoiceaction'];
        $invoicecount = $data['invoicecount'];
        $amount = formatCurrency($amount);
        if( $invoiceaction == '0' )
        {
            $invoiceaction = $aInt->lang('billableitems', 'dontinvoice');
        }
        else
        {
            if( $invoiceaction == '1' )
            {
                $invoiceaction = $aInt->lang('billableitems', 'nextcronrun');
            }
            else
            {
                if( $invoiceaction == '2' )
                {
                    $invoiceaction = $aInt->lang('billableitems', 'nextinvoice');
                }
                else
                {
                    if( $invoiceaction == '3' )
                    {
                        $invoiceaction = $aInt->lang('billableitems', 'invoiceduedate');
                    }
                    else
                    {
                        if( $invoiceaction == '4' )
                        {
                            $invoiceaction = $aInt->lang('billableitems', 'recurringcycle');
                        }
                    }
                }
            }
        }
        $managelink = "<a href=\"clientsbillableitems.php?userid=" . $userid . "&action=manage&id=" . $id . "\">";
        $invoicesnumbers = '';
        $result2 = select_query('tblinvoiceitems', "*", array( 'type' => 'Item', 'relid' => $id ), 'invoiceid', 'ASC');
        while( $data = mysql_fetch_array($result2) )
        {
            $invoicesnumbers .= "<a href=\"invoices.php?action=edit&id=" . $data['invoiceid'] . "\">" . $data['invoiceid'] . "</a>, ";
        }
        $tabledata[] = array( $managelink . $id . "</a>", $managelink . $description . "</a>", $hours, $amount, $invoicesnumbers, $managelink . "<img src=\"images/edit.gif\" width=\"16\" height=\"16\" border=\"0\" alt=\"" . $aInt->lang('global', 'edit') . "\"></a>", "<a href=\"#\" onClick=\"doDelete('" . $id . "');return false\"><img src=\"images/delete.gif\" width=\"16\" height=\"16\" border=\"0\" alt=\"" . $aInt->lang('global', 'delete') . "\"></a>" );
    }
    $tableformbuttons = '';
    echo $aInt->sortableTable(array( array( 'id', $aInt->lang('fields', 'id') ), array( 'description', $aInt->lang('fields', 'description') ), array( 'hours', $aInt->lang('fields', 'hours') ), array( 'amount', $aInt->lang('fields', 'amount') ), $aInt->lang('billableitems', 'invoicenumbers'), '', '' ), $tabledata, $tableformurl, $tableformbuttons);
}
else
{
    if( $action == 'manage' )
    {
        $jquery = '';
        if( $id )
        {
            $pagetitle = $aInt->lang('billableitems', 'edititem');
            $result = select_query('tblbillableitems', '', array( 'id' => $id ));
            $data = mysql_fetch_array($result);
            $id = $data['id'];
            $description = $data['description'];
            $hours = $data['hours'];
            $amount = $data['amount'];
            if( $hours != 0 )
            {
                $amount = format_as_currency($amount / $hours);
            }
            $recur = $data['recur'];
            $recurcycle = $data['recurcycle'];
            $recurfor = $data['recurfor'];
            $invoiceaction = $data['invoiceaction'];
            $invoicecount = $data['invoicecount'];
            $duedate = fromMySQLDate($data['duedate']);
        }
        else
        {
            $pagetitle = $aInt->lang('billableitems', 'additem');
            $invoiceaction = 0;
            $recur = 0;
            $duedate = getTodaysDate();
            $hours = '0';
            $amount = "0.00";
            $invoicecount = 0;
        }
        echo "<h2>" . $pagetitle . "</h2>";
        $jquerycode = "\$(\".itemselect\").change(function () {\n    var itemid = \$(this).val();\n    \$.post(\"clientsbillableitems.php\", { action: \"getproddesc\", id: itemid, token: \"" . generate_token('plain') . "\" },\n    function(data){\n        \$(\"#desc\").val(data);\n    });\n    \$.post(\"clientsbillableitems.php\", { action: \"getprodprice\", id: itemid, currency: \"" . (int) $currency['id'] . "\", token: \"" . generate_token('plain') . "\" },\n    function(data){\n        \$(\"#rate\").val(data);\n    });\n});";
        echo "\n<form method=\"post\" action=\"";
        echo $_SERVER['PHP_SELF'];
        echo "?action=save&userid=";
        echo $userid;
        echo "&id=";
        echo $id;
        echo "\">\n<table class=\"form\" width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\">\n";
        if( !$id )
        {
            echo "<tr><td width=\"20%\" class=\"fieldlabel\">";
            echo $aInt->lang('fields', 'product');
            echo "</td><td class=\"fieldarea\"><select name=\"pid[]\" class=\"itemselect\" id=\"i'.\$i.'\">";
            echo $aInt->productDropDown(0, true);
            echo "</select></td></tr>";
        }
        echo "<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'description');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"description\" value=\"";
        echo $description;
        echo "\" size=\"75\" id=\"desc\" /></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('billableitems', 'hoursqty');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"hours\" value=\"";
        echo $hours;
        echo "\" size=\"8\" /> ";
        echo $aInt->lang('billableitems', 'hours');
        echo "</td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'amount');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"amount\" value=\"";
        echo $amount;
        echo "\" size=\"15\" id=\"rate\" /></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('billableitems', 'invoiceaction');
        echo "</td><td class=\"fieldarea\">\n<input type=\"radio\" name=\"invoiceaction\" value=\"0\" id=\"invac0\"";
        if( $invoiceaction == '0' )
        {
            echo " checked";
        }
        echo " /> ";
        echo $aInt->lang('billableitems', 'dontinvoicefornow');
        echo "<br />\n<input type=\"radio\" name=\"invoiceaction\" value=\"1\" id=\"invac1\"";
        if( $invoiceaction == '1' )
        {
            echo " checked";
        }
        echo " /> ";
        echo $aInt->lang('billableitems', 'invoicenextcronrun');
        echo "<br />\n<input type=\"radio\" name=\"invoiceaction\" value=\"2\" id=\"invac2\"";
        if( $invoiceaction == '2' )
        {
            echo " checked";
        }
        echo " /> ";
        echo $aInt->lang('billableitems', 'addnextinvoice');
        echo "<br />\n<input type=\"radio\" name=\"invoiceaction\" value=\"3\" id=\"invac3\"";
        if( $invoiceaction == '3' )
        {
            echo " checked";
        }
        echo " /> ";
        echo $aInt->lang('billableitems', 'invoicenormalduedate');
        echo "<br />\n<input type=\"radio\" name=\"invoiceaction\" value=\"4\" id=\"invac4\"";
        if( $invoiceaction == '4' )
        {
            echo " checked";
        }
        echo " /> ";
        echo $aInt->lang('billableitems', 'recurevery');
        echo " <input type=\"text\" name=\"recur\" value=\"";
        echo $recur;
        echo "\" size=\"5\"> <select name=\"recurcycle\">\n<option value=\"\">";
        echo $aInt->lang('billableitems', 'never');
        echo "</option>\n<option value=\"Days\"";
        if( $recurcycle == 'Days' )
        {
            echo " selected";
        }
        echo ">";
        echo $aInt->lang('billableitems', 'days');
        echo "</option>\n<option value=\"Weeks\"";
        if( $recurcycle == 'Weeks' )
        {
            echo " selected";
        }
        echo ">";
        echo $aInt->lang('billableitems', 'weeks');
        echo "</option>\n<option value=\"Months\"";
        if( $recurcycle == 'Months' )
        {
            echo " selected";
        }
        echo ">";
        echo $aInt->lang('billableitems', 'months');
        echo "</option>\n<option value=\"Years\"";
        if( $recurcycle == 'Years' )
        {
            echo " selected";
        }
        echo ">";
        echo $aInt->lang('billableitems', 'years');
        echo "</option>\n</select> ";
        echo $aInt->lang('global', 'for');
        echo " <input type=\"text\" name=\"recurfor\" value=\"";
        echo $recurfor;
        echo "\" size=\"5\"> Times<br />\n</td></tr>\n<tr id=\"duedaterow\"><td class=\"fieldlabel\">";
        echo $aInt->lang('billableitems', 'nextduedate');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"duedate\" value=\"";
        echo $duedate;
        echo "\" class=\"datepick\" /></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('billableitems', 'invoicecount');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"invoicecount\" value=\"";
        echo $invoicecount;
        echo "\" size=\"10\" /></td></tr>\n</table>\n\n";
        if( $id )
        {
            $currency = getCurrency($userid);
            $gatewaysarray = getGatewaysArray();
            $aInt->sortableTableInit('nopagination');
            $result = select_query('tblinvoiceitems', "tblinvoices.*", array( 'type' => 'Item', 'relid' => $id ), 'invoiceid', 'ASC', '', "tblinvoices ON tblinvoices.id=tblinvoiceitems.invoiceid");
            while( $data = mysql_fetch_array($result) )
            {
                $invoiceid = $data['id'];
                $date = $data['date'];
                $duedate = $data['duedate'];
                $total = $data['total'];
                $paymentmethod = $data['paymentmethod'];
                $status = $data['status'];
                $date = fromMySQLDate($date);
                $duedate = fromMySQLDate($duedate);
                $total = formatCurrency($total);
                $paymentmethod = $gatewaysarray[$paymentmethod];
                $status = getInvoiceStatusColour($status);
                $invoicelink = "<a href=\"invoices.php?action=edit&id=" . $invoiceid . "\">";
                $tabledata[] = array( $invoicelink . $invoiceid . "</a>", $date, $duedate, $total, $paymentmethod, $status, $invoicelink . "<img src=\"images/edit.gif\" width=\"16\" height=\"16\" border=\"0\" alt=\"" . $aInt->lang('global', 'edit') . "\"></a>" );
            }
            echo "<h2>" . $aInt->lang('billableitems', 'relatedinvoices') . "</h2>" . $aInt->sortableTable(array( $aInt->lang('fields', 'invoicenum'), $aInt->lang('fields', 'invoicedate'), $aInt->lang('fields', 'duedate'), $aInt->lang('fields', 'total'), $aInt->lang('fields', 'paymentmethod'), $aInt->lang('fields', 'status'), '' ), $tabledata);
        }
        echo "\n<p align=\"center\"><input type=\"submit\" value=\"";
        echo $aInt->lang('global', 'savechanges');
        echo "\" class=\"button\" /></p>\n</form>\n\n";
    }
    else
    {
        if( $action == 'timebilling' )
        {
            $jquerycode = "\$(\".itemselect\").change(function () {\n    var rowid = \$(this).attr(\"id\");\n    var itemid = \$(this).val();\n    \$.post(\"clientsbillableitems.php\", { action: \"getproddesc\", id: itemid, token: \"" . generate_token('plain') . "\" },\n    function(data){\n        \$(\"#desc_\"+rowid).val(data);\n    });\n    \$.post(\"clientsbillableitems.php\", { action: \"getprodprice\", id: itemid, currency: \"" . (int) $currency['id'] . "\", token: \"" . generate_token('plain') . "\" },\n    function(data){\n        \$(\"#rate_\"+rowid).val(data);\n    });\n});";
            $options = '';
            $products = new WHMCS_Product_Products();
            $productsList = $products->getProducts();
            foreach( $productsList as $data )
            {
                $pid = $data['id'];
                $pname = $data['name'];
                $ptype = $data['groupname'];
                $options .= "<option value=\"" . $pid . "\"";
                if( $package == $pid )
                {
                    $options .= " selected";
                }
                $options .= ">" . $ptype . " - " . $pname . "</option>";
            }
            echo "<h2>" . $aInt->lang('billableitems', 'addtimebilling') . "</h2>\n<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "?action=addtime&userid=" . $userid . "\">";
            $aInt->sortableTableInit('nopagination');
            $tabledata = array(  );
            for( $i = 1; $i <= 10; $i++ )
            {
                $tabledata[] = array( "<select name=\"pid[]\" class=\"itemselect\" id=\"i" . $i . "\" style=\"width:280px;\"><option value=\"\">" . $aInt->lang('global', 'none') . "</option>" . $options . "</select>", "<input type=\"text\" name=\"description[]\" size=\"75\" id=\"desc_i" . $i . "\" />", "<input type=\"text\" name=\"hours[]\" size=\"10\" value=\"0\" />", "<input type=\"text\" name=\"rate[]\" size=\"10\" value=\"0.00\" id=\"rate_i" . $i . "\" />" );
            }
            echo $aInt->sortableTable(array( $aInt->lang('fields', 'item'), $aInt->lang('fields', 'description'), $aInt->lang('fields', 'hours'), $aInt->lang('fields', 'rate') ), $tabledata);
            echo "<p align=\"center\"><input type=\"submit\" value=\"" . $aInt->lang('billableitems', 'addentries') . "\" /></p>\n</form>";
        }
    }
}
$content = ob_get_contents();
ob_end_clean();
$aInt->content = $content;
$aInt->jquerycode = $jquerycode;
$aInt->jscode = $jscode;
$aInt->display();