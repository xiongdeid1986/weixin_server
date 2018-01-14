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
$aInt = new WHMCS_Admin("View Ticket Mail Import Log");
$aInt->title = $aInt->lang('system', 'mailimportlog');
$aInt->sidebar = 'utilities';
$aInt->icon = 'logs';
$aInt->requiredFiles(array( 'ticketfunctions' ));
if( $display )
{
    $aInt->title = $aInt->lang('system', 'viewimportmessage');
    $result = select_query('tblticketmaillog', '', array( 'id' => $id ));
    $data = mysql_fetch_array($result);
    $id = $data['id'];
    $date = $data['date'];
    $to = $data['to'];
    $name = $data['name'];
    $email = $data['email'];
    $subject = $data['subject'];
    $message = $data['message'];
    $status = $plainstatus = $data['status'];
    if( $status == "Ticket Imported Successfully" )
    {
        $status = "<font color=#669900>" . $aInt->lang('system', 'ticketimportsuccess') . "</font>";
    }
    if( $status == "Ticket Reply Imported Successfully" )
    {
        $status = "<font color=#669900>" . $aInt->lang('system', 'ticketreplyimportsuccess') . "</font>";
    }
    if( $status == "Blocked Potential Email Loop" )
    {
        $status = $aInt->lang('system', 'ticketimportblockloop');
    }
    if( $status == "Department Not Found" )
    {
        $status = $aInt->lang('system', 'ticketimportdeptnotfound');
    }
    if( $status == "Ticket ID Not Found" )
    {
        $status = $aInt->lang('system', 'ticketimporttidnotfound');
    }
    if( $status == "Unregistered Email Address" )
    {
        $status = $aInt->lang('system', 'ticketimportunregistered');
    }
    if( $status == "Exceeded Limit of 10 Tickets within 15 Minutes" )
    {
        $status = $aInt->lang('system', 'ticketimportexceededlimit');
    }
    if( $status == "Blocked Ticket Opening from Unregistered User" )
    {
        $status = $aInt->lang('system', 'ticketimportunregisteredopen');
    }
    if( $status == "Only Replies Allowed by Email" )
    {
        $status = $aInt->lang('system', 'ticketimportrepliesonly');
    }
    if( $action == 'import' )
    {
        check_token("WHMCS.admin.default");
        $tid = $userid = $adminid = 0;
        $from = '';
        $result = select_query('tblclients', 'id', array( 'email' => $email ));
        $data = mysql_fetch_array($result);
        $userid = $data['id'];
        if( !$userid )
        {
            $from = array( 'name' => $name, 'email' => $email );
        }
        $pos = strpos($subject, "[Ticket ID: ");
        if( $pos === false )
        {
            $result = select_query('tblticketdepartments', 'id', array( 'email' => $email ));
            $data = mysql_fetch_array($result);
            $deptid = $data['id'];
            if( !$deptid )
            {
                $result = select_query('tblticketdepartments', 'id', '', 'order', 'ASC');
                $data = mysql_fetch_array($result);
                $deptid = $data['id'];
            }
            openNewTicket($userid, '', $deptid, $subject, $message, 'Medium', '', $from);
            $status = "Ticket Imported Successfully";
        }
        else
        {
            $tid = substr($subject, $pos + 12, 6);
            $result = select_query('tbltickets', '', array( 'tid' => $tid ));
            $data = mysql_fetch_array($result);
            $tid = $data['id'];
            $result = select_query('tbladmins', 'id', array( 'email' => $email ));
            $data = mysql_fetch_array($result);
            $adminid = $data['id'];
            if( $adminid )
            {
                $userid = 0;
                $from = '';
            }
            AddReply($tid, $userid, '', $message, $adminid, '', $from);
            $status = "Ticket Reply Imported Successfully";
        }
        update_query('tblticketmaillog', array( 'status' => $status ), array( 'id' => $id ));
        redir("display=true&id=" . $id);
    }
    $content = "<form method=\"post\" action=\"?display=true&id=" . $id . "\">\n<input type=\"hidden\" name=\"action\" value=\"import\" />\n<p><b>" . $aInt->lang('emails', 'to') . ":</b> " . $to . "<br>\n<b>" . $aInt->lang('emails', 'from') . ":</b> " . $name . " &laquo;" . $email . "&raquo;<br>\n<b>" . $aInt->lang('emails', 'subject') . ":</b> " . $subject . "<br>\n<b>" . $aInt->lang('fields', 'status') . ":</b> " . $status;
    if( $plainstatus != "Ticket Imported Successfully" && $plainstatus != "Ticket Reply Imported Successfully" )
    {
        $content .= " <input type=\"submit\" value=\"" . $aInt->lang('system', 'ignoreimport') . "\" />";
    }
    $content .= "</p>\n</form>\n<p>" . nl2br($message) . "</p>\n<p align=\"center\"><a href=\"#\" onClick=\"window.close();return false\">" . $aInt->lang('addons', 'closewindow') . "</a></p>";
    $aInt->content = $content;
    $aInt->displayPopUp();
    exit();
}
ob_start();
$aInt->sortableTableInit('date');
$numrows = get_query_val('tblticketmaillog', "COUNT(id)", '');
$result = select_query('tblticketmaillog', '', '', 'id', 'DESC', $page * $limit . ',' . $limit);
while( $data = mysql_fetch_array($result) )
{
    $id = $data['id'];
    $date = $data['date'];
    $to = $data['to'];
    $name = $data['name'];
    $email = $data['email'];
    $subject = $data['subject'];
    $status = $data['status'];
    if( $status == "Ticket Imported Successfully" )
    {
        $status = "<font color=#669900>" . $aInt->lang('system', 'ticketimportsuccess') . "</font>";
    }
    if( $status == "Ticket Reply Imported Successfully" )
    {
        $status = "<font color=#669900>" . $aInt->lang('system', 'ticketreplyimportsuccess') . "</font>";
    }
    if( $status == "Blocked Potential Email Loop" )
    {
        $status = $aInt->lang('system', 'ticketimportblockloop');
    }
    if( $status == "Department Not Found" )
    {
        $status = $aInt->lang('system', 'ticketimportdeptnotfound');
    }
    if( $status == "Ticket ID Not Found" )
    {
        $status = $aInt->lang('system', 'ticketimporttidnotfound');
    }
    if( $status == "Unregistered Email Address" )
    {
        $status = $aInt->lang('system', 'ticketimportunregistered');
    }
    if( $status == "Exceeded Limit of 10 Tickets within 15 Minutes" )
    {
        $status = $aInt->lang('system', 'ticketimportexceededlimit');
    }
    if( $status == "Blocked Ticket Opening from Unregistered User" )
    {
        $status = $aInt->lang('system', 'ticketimportunregisteredopen');
    }
    if( $status == "Only Replies Allowed by Email" )
    {
        $status = $aInt->lang('system', 'ticketimportrepliesonly');
    }
    $subject = 75 < strlen($subject) ? substr($subject, 0, 75) . "..." : $subject;
    $tabledata[] = array( fromMySQLDate($date, true), $to, "<a href=\"#\" onClick=\"window.open('" . $_SERVER['PHP_SELF'] . "?display=true&id=" . $id . "','','width=650,height=400,scrollbars=yes');return false\">" . $subject . "</a><br>" . $aInt->lang('emails', 'from') . ": " . $name . " &laquo;" . $email . "&raquo;", $status );
}
echo $aInt->sortableTable(array( $aInt->lang('fields', 'date'), $aInt->lang('emails', 'to'), $aInt->lang('emails', 'subject'), $aInt->lang('fields', 'status') ), $tabledata);
$content = ob_get_contents();
ob_end_clean();
$aInt->content = $content;
$aInt->display();