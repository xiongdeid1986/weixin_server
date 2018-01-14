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
require("../../../init.php");
$whmcs->load_function('gateway');
$whmcs->load_function('invoice');
$GATEWAY = getGatewayVariables('worldpay');
if( !$GATEWAY['type'] )
{
    exit( "Module Not Activated" );
}
if( $GATEWAY['prpassword'] && $GATEWAY['prpassword'] != $_REQUEST['callbackPW'] )
{
    logTransaction($GATEWAY['name'], $_REQUEST, "Payment Response Password Mismatch");
    exit();
}
echo "<WPDISPLAY ITEM=\"banner\">";
if( $_POST['transStatus'] == 'Y' )
{
    $invoiceid = checkCbInvoiceID($_POST['cartId'], 'WorldPay');
    checkCbTransID($_POST['transId']);
    addInvoicePayment($invoiceid, $_POST['transId'], '', '', 'worldpay');
    logTransaction('WorldPay', $_POST, 'Successful');
    echo "<p align=\"center\"><a href=\"" . $CONFIG['SystemURL'] . "/viewinvoice.php?id=" . $invoiceid . "&paymentsuccess=true\">Click here to return to " . $CONFIG['CompanyName'] . "</a></p>";
    exit();
}
logTransaction('WorldPay', $_POST, 'Unsuccessful');
echo "<p align=\"center\"><a href=\"" . $CONFIG['SystemURL'] . "/viewinvoice.php?id=" . $invoiceid . "&paymentfailed=true\">Click here to return to " . $CONFIG['CompanyName'] . "</a></p>";