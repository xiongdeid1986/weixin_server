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
if( $action == 'edit' )
{
    $reqperm = "Edit Transaction";
}
else
{
    $reqperm = "List Transactions";
}
$aInt = new WHMCS_Admin($reqperm);
$aInt->title = $aInt->lang('transactions', 'title');
$aInt->sidebar = 'billing';
$aInt->icon = 'transactions';
$aInt->requiredFiles(array( 'gatewayfunctions', 'invoicefunctions' ));
$jquerycode = '';
if( $action == 'add' )
{
    check_token("WHMCS.admin.default");
    checkPermission("Add Transaction");
    if( $client )
    {
        $currency = 0;
    }
    $cleanedInvoiceIDs = array(  );
    $userInputInvoiceIDs = trim($whmcs->get_req_var('invoiceids'));
    if( $userInputInvoiceIDs )
    {
        $userInputInvoiceIDs = explode(',', $userInputInvoiceIDs);
        foreach( $userInputInvoiceIDs as $tmpInvID )
        {
            $tmpInvID = trim($tmpInvID);
            if( is_numeric($tmpInvID) )
            {
                $cleanedInvoiceIDs[] = (int) $tmpInvID;
            }
        }
    }
    if( count($cleanedInvoiceIDs) <= 1 )
    {
        $invoiceid = count($cleanedInvoiceIDs) ? $cleanedInvoiceIDs[0] : '';
        if( $transid && !isUniqueTransactionID($transid, $paymentmethod) )
        {
            WHMCS_Cookie::set('DuplicateTransaction', array( 'invoiceid' => $invoiceid, 'transid' => $transid, 'amountin' => $amountin, 'fees' => $fees, 'paymentmethod' => $paymentmethod, 'date' => $date, 'amountout' => $amountout, 'description' => $description, 'addcredit' => $addcredit, 'userid' => $client, 'currency' => $currency ));
            redir(array( 'duplicate' => true, 'tab' => 1 ));
        }
        addTransaction($client, $currency, $description, $amountin, $fees, $amountout, $paymentmethod, $transid, $invoiceid, $date);
        if( $client && $addcredit && (!is_int($invoiceid) || $invoiceid == 0) )
        {
            if( $transid )
            {
                $description .= " (" . $aInt->lang('transactions', 'transid') . ": " . $transid . ")";
            }
            insert_query('tblcredit', array( 'clientid' => $client, 'date' => toMySQLDate($date), 'description' => $description, 'amount' => $amountin ));
            update_query('tblclients', array( 'credit' => "+=" . $amountin ), array( 'id' => (int) $client ));
        }
        if( is_int($invoiceid) )
        {
            $totalPaid = get_query_val('tblaccounts', "SUM(amountin)-SUM(amountout)", array( 'invoiceid' => $invoiceid ));
            $invoiceData = get_query_vals('tblinvoices', "status, total", array( 'id' => $invoiceid ));
            $balance = $invoiceData['total'] - $totalPaid;
            if( $balance <= 0 && $invoiceData['status'] == 'Unpaid' )
            {
                processPaidInvoice($invoiceid, '', $date);
            }
        }
    }
    else
    {
        if( 1 < count($cleanedInvoiceIDs) )
        {
            $query = select_query('tblinvoices', "SUM(total)", array( 'id' => array( 'sqltype' => 'IN', 'values' => $cleanedInvoiceIDs ) ));
            $data = mysql_fetch_assoc($query);
            $invoicestotal = $data[0];
            $totalleft = $amountin;
            $fees = round($fees / count($invoices), 2);
            foreach( $cleanedInvoiceIDs as $invoiceid )
            {
                if( 0 < $totalleft )
                {
                    $result = select_query('tblinvoices', 'total', array( 'id' => $invoiceid ));
                    $data = mysql_fetch_array($result);
                    $invoicetotal = $data[0];
                    $result2 = select_query('tblaccounts', "SUM(amountin)", array( 'invoiceid' => $invoiceid ));
                    $data = mysql_fetch_array($result2);
                    $totalin = $data[0];
                    $paymentdue = $invoicetotal - $totalin;
                    if( $paymentdue < $totalleft )
                    {
                        addInvoicePayment($invoiceid, $transid, $paymentdue, $fees, $paymentmethod, '', $date);
                        $totalleft -= $paymentdue;
                    }
                    else
                    {
                        addInvoicePayment($invoiceid, $transid, $totalleft, $fees, $paymentmethod, '', $date);
                        $totalleft = 0;
                    }
                }
            }
            if( $totalleft )
            {
                addInvoicePayment($invoiceid, $transid, $totalleft, $fees, $paymentmethod, '', $date);
            }
        }
    }
    redir("added=true");
}
if( $action == 'save' )
{
    check_token("WHMCS.admin.default");
    checkPermission("Edit Transaction");
    if( $client )
    {
        $currency = 0;
    }
    $date = toMySQLDate($date);
    update_query('tblaccounts', array( 'userid' => $client, 'currency' => $currency, 'date' => $date, 'description' => $description, 'amountin' => $amountin, 'fees' => $fees, 'amountout' => $amountout, 'gateway' => $paymentmethod, 'transid' => $transid, 'invoiceid' => $invoiceid ), array( 'id' => $id ));
    logActivity("Modified Transaction - Transaction ID: " . $id);
    redir("saved=true");
}
if( $action == 'delete' )
{
    check_token("WHMCS.admin.default");
    checkPermission("Delete Transaction");
    delete_query('tblaccounts', array( 'id' => $id ));
    logActivity("Deleted Transaction - Transaction ID: " . $id);
    redir("deleted=true");
}
ob_start();
if( !$action )
{
    if( $added )
    {
        infoBox($aInt->lang('transactions', 'transactionadded'), $aInt->lang('transactions', 'transactionaddedinfo'));
    }
    if( $saved )
    {
        infoBox($aInt->lang('transactions', 'transactionupdated'), $aInt->lang('transactions', 'transactionupdatedinfo'));
    }
    if( $deleted )
    {
        infoBox($aInt->lang('transactions', 'transactiondeleted'), $aInt->lang('transactions', 'transactiondeletedinfo'));
    }
    if( $duplicate )
    {
        infobox($aInt->lang('transactions', 'duplicate'), $aInt->lang('transactions', 'requireUniqueTransaction'), 'error');
        $repopulateData = WHMCS_Cookie::get('DuplicateTransaction', true);
        $invoiceid = $repopulateData['invoiceid'] ? WHMCS_Input_Sanitize::makesafeforoutput($repopulateData['invoiceid']) : '';
        $transid = WHMCS_Input_Sanitize::makesafeforoutput($repopulateData['transid']);
        $amountin = $repopulateData['amountin'] ? WHMCS_Input_Sanitize::makesafeforoutput($repopulateData['amountin']) : "0.00";
        $fees = $repopulateData['fees'] ? WHMCS_Input_Sanitize::makesafeforoutput($repopulateData['fees']) : "0.00";
        $paymentmethod = WHMCS_Input_Sanitize::makesafeforoutput($repopulateData['paymentmethod']);
        $date2 = WHMCS_Input_Sanitize::makesafeforoutput($repopulateData['date']);
        $amountout = $repopulateData['amountout'] ? WHMCS_Input_Sanitize::makesafeforoutput($repopulateData['amountout']) : "0.00";
        $description = WHMCS_Input_Sanitize::makesafeforoutput($repopulateData['description']);
        $addcredit = $repopulateData['addcredit'] ? " CHECKED" : '';
        $userid = $repopulateData['userid'] ? WHMCS_Input_Sanitize::makesafeforoutput($repopulateData['userid']) : '';
        $currency = $repopulateData['currency'] ? WHMCS_Input_Sanitize::makesafeforoutput($repopulateData['currency']) : '';
        WHMCS_Cookie::delete('DuplicateTransaction');
    }
    echo $infobox;
    $aInt->deleteJSConfirm('doDelete', 'transactions', 'deletesure', "?action=delete&id=");
    echo $aInt->Tabs(array( $aInt->lang('global', 'searchfilter'), $aInt->lang('transactions', 'add') ), true);
    if( !count($_REQUEST) )
    {
        $_REQUEST['within'] = 'month';
        $within = $_REQUEST['within'];
    }
    $jquerycode .= "\n\$( \"select[name='within']\" ).change(function() {\n    if (\$( this ).val() != 'Custom Date Range') {\n        \$( \"input[name='startdate']\" ).val('');\n        \$( \"input[name='enddate']\" ).val('');\n    }\n});\n\n\$( \"input[name='startdate']\" ).keyup(function() {\n    \$( \"select[name='within']\" ).val('Custom Date Range');\n});\n\n\$( \"input[name='enddate']\" ).keyup(function() {\n    \$( \"select[name='within']\" ).val('Custom Date Range');\n});\n\n\$( \"input[name='startdate']\" ).change(function() {\n    \$( \"select[name='within']\" ).val('Custom Date Range');\n});\n\n\$( \"input[name='enddate']\" ).change(function() {\n    \$( \"select[name='within']\" ).val('Custom Date Range');\n});";
    echo "\n<div id=\"tab0box\" class=\"tabbox\">\n  <div id=\"tab_content\">\n\n<form method=\"post\" action=\"transactions.php\"><input type=\"hidden\" name=\"filter\" value=\"true\">\n\n<table class=\"form\" width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\">\n<tr><td width=\"15%\" class=\"fieldlabel\">";
    echo $aInt->lang('transactions', 'show');
    echo "</td><td class=\"fieldarea\"><select name=\"show\">\n<option value=\"\">";
    echo $aInt->lang('transactions', 'allactivity');
    echo "</option>\n<option value=\"received\"";
    if( $_REQUEST['show'] == 'received' )
    {
        echo " SELECTED";
    }
    echo ">";
    echo $aInt->lang('transactions', 'preceived');
    echo "</option>\n<option value=\"sent\"";
    if( $_REQUEST['show'] == 'sent' )
    {
        echo " SELECTED";
    }
    echo ">";
    echo $aInt->lang('transactions', 'psent');
    echo "</option>\n</select></td><td width=\"15%\" class=\"fieldlabel\">";
    echo $aInt->lang('transactions', 'within');
    echo "</td><td class=\"fieldarea\"><select name=\"within\"><option value=\"\">";
    echo $aInt->lang('transactions', 'nolimit');
    echo "</option><option value=\"week\"";
    if( $within == 'week' )
    {
        echo " SELECTED";
    }
    echo ">";
    echo $aInt->lang('transactions', 'pastweek');
    echo "</option><option value=\"month\"";
    if( $within == 'month' )
    {
        echo " SELECTED";
    }
    echo ">";
    echo $aInt->lang('transactions', 'pastmonth');
    echo "</option><option value=\"year\"";
    if( $within == 'year' )
    {
        echo " SELECTED";
    }
    echo ">";
    echo $aInt->lang('transactions', 'pastyear');
    echo "</option><option";
    if( $startdate )
    {
        echo " SELECTED";
    }
    echo ">Custom Date Range</option></select></td></tr>\n<tr><td class=\"fieldlabel\" width=\"15%\">";
    echo $aInt->lang('fields', 'description');
    echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"filterdescription\" size=\"50\" value=\"";
    echo $filterdescription;
    echo "\"></td><td class=\"fieldlabel\">";
    echo $aInt->lang('fields', 'startdate');
    echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"startdate\" size=\"20\" value=\"";
    echo $startdate;
    echo "\" class=\"datepick\"></td></tr>\n<tr><td class=\"fieldlabel\">";
    echo $aInt->lang('fields', 'transid');
    echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"filtertransid\" size=\"30\" value=\"";
    echo $filtertransid;
    echo "\"></td><td class=\"fieldlabel\">";
    echo $aInt->lang('transactions', 'todate');
    echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"enddate\" size=\"20\" value=\"";
    echo $enddate;
    echo "\" class=\"datepick\"></td></tr>\n<tr><td class=\"fieldlabel\">";
    echo $aInt->lang('fields', 'paymentmethod');
    echo "</td><td class=\"fieldarea\">";
    echo paymentMethodsSelection($aInt->lang('global', 'any'));
    echo "</td><td class=\"fieldlabel\">";
    echo $aInt->lang('fields', 'amount');
    echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"amount\" size=\"15\" value=\"";
    echo $amount;
    echo "\"></td></tr>\n</table>\n\n<img src=\"images/spacer.gif\" height=\"10\" width=\"1\"><br>\n<div align=\"center\"><input type=\"submit\" value=\"";
    echo $aInt->lang('global', 'searchfilter');
    echo "\" class=\"button\"></div>\n\n</form>\n\n  </div>\n</div>\n<div id=\"tab1box\" class=\"tabbox\">\n  <div id=\"tab_content\">\n\n";
    $date2 = getTodaysDate();
    echo "<form method=\"post\" action=\"";
    echo $whmcs->getPhpSelf();
    echo "?action=add\" name=\"calendarfrm\">\n\n<table class=\"form\" width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\">\n<tr><td width=\"15%\" class=\"fieldlabel\">";
    echo $aInt->lang('fields', 'date');
    echo "</td><td class=\"fieldarea\"><input type=\"text\" size=\"20\" name=\"date\" value=\"";
    echo $date2;
    echo "\" class=\"datepick\"></td><td width=\"15%\" class=\"fieldlabel\">";
    echo $aInt->lang('currencies', 'currency');
    echo "</td><td class=\"fieldarea\"><select name=\"currency\">";
    $result = select_query('tblcurrencies', '', '', 'code', 'ASC');
    while( $data = mysql_fetch_array($result) )
    {
        echo "<option value=\"" . $data['id'] . "\"";
        if( !$currency && $data['default'] || $currency && $currency == $data['id'] )
        {
            echo " selected";
        }
        echo ">" . $data['code'] . "</option>";
    }
    echo "</select> (";
    echo $aInt->lang('transactions', 'nonclientonly');
    echo ")</td></tr>\n<tr>\n    <td width=\"15%\" class=\"fieldlabel\">";
    echo $aInt->lang('transactions', 'relclient');
    echo "</td>\n    <td class=\"fieldarea\">";
    echo $aInt->clientsDropDown($userid, '', 'client', true);
    echo "</td>\n    <td class=\"fieldlabel\">";
    echo $aInt->lang('transactions', 'amountin');
    echo "</td>\n    <td class=\"fieldarea\"><input type=\"text\" name=\"amountin\" size=10 value=\"";
    echo $amountin;
    echo "\"></td>\n</tr>\n<tr>\n    <td class=\"fieldlabel\">";
    echo $aInt->lang('fields', 'description');
    echo "</td>\n    <td class=\"fieldarea\"><input type=\"text\" name=\"description\" size=50 value=\"";
    echo $description;
    echo "\"></td>\n    <td class=\"fieldlabel\">";
    echo $aInt->lang('transactions', 'fees');
    echo "</td>\n    <td class=\"fieldarea\"><input type=\"text\" name=\"fees\" size=10 value=\"";
    echo $fees;
    echo "\"></td>\n</tr>\n<tr>\n    <td class=\"fieldlabel\">";
    echo $aInt->lang('fields', 'transid');
    echo "</td>\n    <td class=\"fieldarea\"><input type=\"text\" name=\"transid\" size=30 value=\"";
    echo $transid;
    echo "\"></td>\n    <td class=\"fieldlabel\">";
    echo $aInt->lang('transactions', 'amountout');
    echo "</td>\n    <td class=\"fieldarea\"><input type=\"text\" name=\"amountout\" size=10 value=\"";
    echo $amountout;
    echo "\"></td>\n</tr>\n<tr>\n    <td class=\"fieldlabel\">";
    echo $aInt->lang('transactions', 'invoiceids');
    echo "</td>\n    <td class=\"fieldarea\">\n        <input type=\"text\" name=\"invoiceids\" size=20 value=\"";
    echo $invoiceid;
    echo "\">\n        ";
    echo $aInt->lang('transactions', 'commaseparated');
    echo "    </td>\n    <td class=\"fieldlabel\">";
    echo $aInt->lang('fields', 'credit');
    echo "</td>\n    <td class=\"fieldarea\">\n        <input type=\"checkbox\" name=\"addcredit\"";
    echo $addcredit;
    echo ">\n        ";
    echo $aInt->lang('invoices', 'refundtypecredit');
    echo "    </td>\n</tr>\n<tr>\n    <td class=\"fieldlabel\">";
    echo $aInt->lang('fields', 'paymentmethod');
    echo "</td>\n    <td class=\"fieldarea\">";
    echo paymentMethodsSelection($aInt->lang('global', 'none'));
    echo "</td>\n    <td class=\"fieldlabel\"></td><td class=\"fieldarea\"></td>\n</tr>\n</table>\n\n<img src=\"images/spacer.gif\" height=\"10\" width=\"1\"><br>\n<DIV ALIGN=\"center\"><input type=\"submit\" value=\"";
    echo $aInt->lang('transactions', 'add');
    echo "\" class=\"button\"></DIV>\n</form>\n\n  </div>\n</div>\n\n<br />\n\n";
    $aInt->sortableTableInit('date', 'DESC');
    $query = '';
    $where = array(  );
    if( $show == 'received' )
    {
        $where[] = "tblaccounts.amountin>0";
    }
    else
    {
        if( $show == 'sent' )
        {
            $where[] = "tblaccounts.amountout>0";
        }
    }
    if( $amount )
    {
        $where[] = "(tblaccounts.amountin='" . db_escape_string($amount) . "' OR tblaccounts.amountout='" . db_escape_string($amount) . "')";
    }
    if( $startdate )
    {
        $where[] = "tblaccounts.date>='" . toMySQLDate($startdate) . " 00:00:00'";
    }
    if( $enddate )
    {
        $where[] = "tblaccounts.date<='" . toMySQLDate($enddate) . " 23:59:59'";
    }
    if( !$startdate && !$enddate )
    {
        if( $within == 'week' )
        {
            $lastweek = date('Ymd', mktime(0, 0, 0, date('m'), date('d') - 7, date('Y')));
            $where[] = "tblaccounts.date>=" . $lastweek;
        }
        else
        {
            if( $within == 'month' )
            {
                $lastmonth = date('Ymd', mktime(0, 0, 0, date('m') - 1, date('d'), date('Y')));
                $where[] = "tblaccounts.date>=" . $lastmonth;
            }
            else
            {
                if( $within == 'year' )
                {
                    $lastyear = date('Ymd', mktime(0, 0, 0, date('m'), date('d'), date('Y') - 1));
                    $where[] = "tblaccounts.date>=" . $lastyear;
                }
            }
        }
    }
    if( $filtertransid )
    {
        $where[] = "tblaccounts.transid='" . db_escape_string($filtertransid) . "'";
    }
    if( $paymentmethod )
    {
        $where[] = "tblaccounts.gateway='" . db_escape_string($paymentmethod) . "'";
    }
    if( $filterdescription )
    {
        $where[] = "tblaccounts.description LIKE '%" . db_escape_string($filterdescription) . "%'";
    }
    if( count($where) )
    {
        $query .= " WHERE " . implode(" AND ", $where);
    }
    $totals = array(  );
    $fullquery = "SELECT tblclients.currency,SUM(amountin),SUM(fees),SUM(amountout),SUM(amountin-fees-amountout) FROM tblaccounts,tblclients " . ($query ? $query . " AND" : 'WHERE') . " tblclients.id=tblaccounts.userid GROUP BY tblclients.currency";
    $result = full_query($fullquery);
    while( $data = mysql_fetch_array($result) )
    {
        $currency = $data['currency'];
        $totalin = $data[1];
        $totalfees = $data[2];
        $totalout = $data[3];
        $total = $data[4];
        $totals[$currency] = array( 'in' => $totalin, 'fees' => $totalfees, 'out' => $totalout, 'total' => $total );
    }
    $fullquery = "SELECT currency,SUM(amountin),SUM(fees),SUM(amountout),SUM(amountin-fees-amountout) FROM tblaccounts " . ($query ? $query . " AND" : 'WHERE') . " userid=0 GROUP BY currency";
    $result = full_query($fullquery);
    while( $data = mysql_fetch_array($result) )
    {
        $currency = $data['currency'];
        $totalin = $data[1];
        $totalfees = $data[2];
        $totalout = $data[3];
        $total = $data[4];
        $totals[$currency]['in'] += $totalin;
        $totals[$currency]['fees'] += $totalfees;
        $totals[$currency]['out'] += $totalout;
        $totals[$currency]['total'] += $total;
    }
    $gatewaysarray = getGatewaysArray();
    $query .= " ORDER BY tblaccounts.date DESC,tblaccounts.id DESC";
    $result = full_query("SELECT COUNT(*) FROM tblaccounts" . $query);
    $data = mysql_fetch_array($result);
    $numrows = $data[0];
    $query = "SELECT tblaccounts.*,tblclients.firstname,tblclients.lastname,tblclients.companyname,tblclients.groupid,tblclients.currency AS currencyid FROM tblaccounts LEFT JOIN tblclients ON tblclients.id=tblaccounts.userid" . $query . " LIMIT " . (int) ($page * $limit) . ',' . (int) $limit;
    $result = full_query($query);
    while( $data = mysql_fetch_array($result) )
    {
        $id = $data['id'];
        $userid = $data['userid'];
        $currency = $data['currency'];
        $date = $data['date'];
        $date = fromMySQLDate($date);
        $description = $data['description'];
        $amountin = $data['amountin'];
        $fees = $data['fees'];
        $amountout = $data['amountout'];
        $gateway = $data['gateway'];
        $transid = $data['transid'];
        $invoiceid = $data['invoiceid'];
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $companyname = $data['companyname'];
        $groupid = $data['groupid'];
        $currencyid = $data['currencyid'];
        $clientlink = $userid ? $aInt->outputClientLink($userid, $firstname, $lastname, $companyname, $groupid) : '-';
        $currency = $userid ? getCurrency('', $currencyid) : getCurrency('', $currency);
        $amountin = formatCurrency($amountin);
        $fees = formatCurrency($fees);
        $amountout = formatCurrency($amountout);
        if( $invoiceid != '0' )
        {
            $description .= " (<a href=\"invoices.php?action=edit&id=" . $invoiceid . "\">#" . $invoiceid . "</a>)";
        }
        if( $transid != '' )
        {
            $description .= "<br>Trans ID: " . $transid;
        }
        $gateway = $gatewaysarray[$gateway];
        $tabledata[] = array( $clientlink, $date, $gateway, $description, $amountin, $fees, $amountout, "<a href=\"?action=edit&id=" . $id . "\"><img src=\"images/edit.gif\" width=\"16\" height=\"16\" border=\"0\" alt=\"" . $aInt->lang('global', 'edit') . "\"></a>", "<a href=\"#\" onClick=\"doDelete('" . $id . "');return false\"><img src=\"images/delete.gif\" width=\"16\" height=\"16\" border=\"0\" alt=\"" . $aInt->lang('global', 'delete') . "\"></a>" );
    }
    echo $aInt->sortableTable(array( $aInt->lang('fields', 'clientname'), $aInt->lang('fields', 'date'), $aInt->lang('fields', 'paymentmethod'), $aInt->lang('fields', 'description'), $aInt->lang('transactions', 'amountin'), $aInt->lang('transactions', 'fees'), $aInt->lang('transactions', 'amountout'), '', '' ), $tabledata, $tableformurl, $tableformbuttons);
    if( checkPermission("View Income Totals", true) )
    {
        echo "\n<table cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"#cccccc\" width=\"600\" align=\"center\">\n<tr bgcolor=\"#f4f4f4\" style=\"text-align:center;font-weight:bold;\"><td></td><td>";
        echo $aInt->lang('transactions', 'totalincome');
        echo "</td><td>";
        echo $aInt->lang('transactions', 'totalfees');
        echo "</td><td>";
        echo $aInt->lang('transactions', 'totalexpenditure');
        echo "</td><td>";
        echo $aInt->lang('transactions', 'totalbalance');
        echo "</td></tr>\n";
        foreach( $totals as $currency => $values )
        {
            $currency = getCurrency('', $currency);
            echo "<tr bgcolor=\"#ffffff\" style=\"text-align:center;\"><td bgcolor=\"#f4f4f4\"><b>" . $currency['code'] . "</b></td><td>" . formatCurrency($values['in']) . "</td><td>" . formatCurrency($values['fees']) . "</td><td>" . formatCurrency($values['out']) . "</td><td bgcolor=\"#f4f4f4\"><b>" . formatCurrency($values['total']) . "</b></td></tr>";
        }
        if( !count($totals) )
        {
            echo "<tr bgcolor=\"#ffffff\" style=\"text-align:center;\"><td colspan=\"5\">" . $aInt->lang('transactions', 'nototals') . "</td></tr>";
        }
        echo "</table>\n\n";
    }
}
else
{
    if( $action == 'edit' )
    {
        $result = select_query('tblaccounts', '', array( 'id' => $id ));
        $data = mysql_fetch_array($result);
        $id = $data['id'];
        $userid = $data['userid'];
        $date = $data['date'];
        $date = fromMySQLDate($date);
        $description = $data['description'];
        $amountin = $data['amountin'];
        $fees = $data['fees'];
        $amountout = $data['amountout'];
        $paymentmethod = $data['gateway'];
        $transid = $data['transid'];
        $invoiceid = $data['invoiceid'];
        if( !$id )
        {
            $aInt->gracefulExit($aInt->lang('transactions', 'notfound'));
        }
        echo "\n<h2>";
        echo $aInt->lang('transactions', 'edit');
        echo "</h2>\n\n<form method=\"post\" action=\"";
        echo $whmcs->getPhpSelf();
        echo "?action=save&id=";
        echo $id;
        echo "\" name=\"calendarfrm\">\n\n<table class=\"form\" width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\">\n<tr><td width=\"15%\" class=\"fieldlabel\">";
        echo $aInt->lang('transactions', 'relclient');
        echo "</td><td class=\"fieldarea\">";
        echo $aInt->clientsDropDown($userid, '', 'client', true);
        echo "</td><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'transid');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"transid\" size=20 value=\"";
        echo $transid;
        echo "\"></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'date');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" size=\"12\" name=\"date\" value=\"";
        echo $date;
        echo "\" class=\"datepick\"></td><td class=\"fieldlabel\">";
        echo $aInt->lang('transactions', 'amountin');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"amountin\" size=10 value=\"";
        echo $amountin;
        echo "\"></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'paymentmethod');
        echo "</td><td class=\"fieldarea\">";
        echo paymentMethodsSelection($aInt->lang('global', 'none'));
        echo "</td><td class=\"fieldlabel\">";
        echo $aInt->lang('transactions', 'fees');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"fees\" size=10 value=\"";
        echo $fees;
        echo "\"></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'description');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"description\" size=40 value=\"";
        echo $description;
        echo "\"></td><td class=\"fieldlabel\">";
        echo $aInt->lang('transactions', 'amountout');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"amountout\" size=10 value=\"";
        echo $amountout;
        echo "\"></td></tr>\n<tr><td class=\"fieldlabel\">";
        echo $aInt->lang('fields', 'invoiceid');
        echo "</td><td class=\"fieldarea\"><input type=\"text\" name=\"invoiceid\" size=8 value=\"";
        echo $invoiceid;
        echo "\"></td><td class=\"fieldlabel\"><br></td><td class=\"fieldarea\"></td></tr>\n</table>\n\n<p align=\"center\"><input type=\"submit\" value=\"";
        echo $aInt->lang('global', 'savechanges');
        echo "\" class=\"button\" /></p>\n\n</form>\n\n";
    }
}
$content = ob_get_contents();
ob_end_clean();
$aInt->content = $content;
$aInt->jquerycode = $jquerycode;
$aInt->jscode = $jscode;
$aInt->display();