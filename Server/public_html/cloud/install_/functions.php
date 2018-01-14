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
function installerAutoloader($className) {
	$className     = preg_replace('/[^0-9a-z_]/i', '', $className);
	$namespacePath = dirname(__FILE__) . '/../includes/classes/' . str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
	if(file_exists($namespacePath)) {
		include_once($namespacePath);
	}
}
/**
 * Individual files that need include for compat libraries.
 *
 * Use only for files that _require_ inclusion, otherwise add the lib to
 * the compat_library_autoload()
 *
 * This function has no meaning if properly using Composer to manage dependencies
 */
function installer_include_compat_libraries() {
	$baseDir = ROOTDIR . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'classes';
	$libs    = array(
		'Crypt/Random.php' => $baseDir . DIRECTORY_SEPARATOR . 'phpseclib' . DIRECTORY_SEPARATOR . 'phpseclib' . DIRECTORY_SEPARATOR . 'phpseclib' . DIRECTORY_SEPARATOR . 'Crypt' . DIRECTORY_SEPARATOR . 'Random.php',
		'password-compat' => $baseDir . DIRECTORY_SEPARATOR . 'ircmaxell' . DIRECTORY_SEPARATOR . 'password-compat' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'password.php'
	);
	if(((file_exists($libs['Crypt/Random.php']) && !defined('CRYPT_RANDOM_IS_WINDOWS')) && !function_exists('crypt_random_string'))) {
		include_once($libs['Crypt/Random.php']);
	}
	if((version_compare(PHP_VERSION, '5.3.7', '>=') && file_exists($libs['password-compat']))) {
		include_once($libs['password-compat']);
	}
	spl_autoload_register('installer_compat_library_autoload');
}
/**
 * Autoloader for complex compat libraries
 *
 * This function has no meaning if properly using Composer to manage
 * dependencies
 *
 * @param $className
 */
function installer_compat_library_autoload($className) {
	$baseDir            = ROOTDIR . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'classes';
	$phpseclibBase      = $baseDir . DIRECTORY_SEPARATOR . 'phpseclib' . DIRECTORY_SEPARATOR . 'phpseclib' . DIRECTORY_SEPARATOR . 'phpseclib';
	$classMap           = array(
		'Crypt' => $phpseclibBase,
		'File' => $phpseclibBase,
		'Math' => $phpseclibBase,
		'Net' => $phpseclibBase,
		'System' => $phpseclibBase
	);
	$className          = ltrim($className, '\\');
	$fileName           = '';
	$underscorePosition = strpos($className, '_');
	if($underscorePosition !== false) {
		$categoryName = substr($className, 0, $underscorePosition);
		if(array_key_exists($categoryName, $classMap)) {
			$fileName = $classMap[$categoryName] . DIRECTORY_SEPARATOR;
		}
	}
	$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
	if(file_exists($fileName)) {
		include_once($fileName);
	}
}
function mysql_import_file($filename, $basedir = null) {
	if(!$basedir) {
		$basedir = dirname(__FILE__) . '/sql/';
	}
	$querycount  = 0;
	$queryerrors = '';
	if(file_exists($basedir . $filename)) {
		$lines = file($basedir . $filename);
		if(!$lines) {
			$errmsg = 'cannot open file ' . $filename;
			return false;
		}
		$scriptfile = false;
		foreach($lines as $line) {
			$line = trim($line);
			if(substr($line, 0, 2) != '--') {
				$scriptfile .= ' ' . $line;
			}
		}
		$queries = explode(';', $scriptfile);
		foreach($queries as $query) {
			$query = trim($query);
			$querycount++;
			if($query == '') {
				continue;
			}
			if(!mysql_query($query)) {
				$queryerrors .= 'Line ' . $querycount . ' - ' . mysql_error() . "<br>";
			}
		}
		if($queryerrors) {
			echo "<b>Errors Occurred</b><br><br>Please open a ticket with the debug information below for support<br><br>File: " . $filename . "<br>" . $queryerrors;
		}
		return true;
	}
	$errmsg = 'cannot open file ' . $filename;
	return false;
}
function v321Upgrade() {
	mysql_import_file('upgrade321.sql');
}
function v330Upgrade() {
	mysql_import_file('upgrade330.sql');
	include('../configuration.php');
	$query  = "SELECT id,AES_DECRYPT(cardnum,'" . $cc_encryption_hash . "') as cardnum,AES_DECRYPT(expdate,'" . $cc_encryption_hash . "') as expdate,AES_DECRYPT(issuenumber,'" . $cc_encryption_hash . "') as issuenumber,AES_DECRYPT(startdate,'" . $cc_encryption_hash . "') as startdate FROM tblclients";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$id           = $row['id'];
		$cardnum      = $row['cardnum'];
		$cardexp      = $row['expdate'];
		$cardissuenum = $row['issuenumber'];
		$cardstart    = $row['startdate'];
		$query2       = "UPDATE tblclients SET cardnum=AES_ENCRYPT('" . $cardnum . "','54X6zoYZZnS35o6m5gEwGmYC6" . $cc_encryption_hash . "'),expdate=AES_ENCRYPT('" . $cardexp . "','54X6zoYZZnS35o6m5gEwGmYC6" . $cc_encryption_hash . "'),startdate=AES_ENCRYPT('" . $cardstart . "','54X6zoYZZnS35o6m5gEwGmYC6" . $cc_encryption_hash . "'),issuenumber=AES_ENCRYPT('" . $cardissuenum . "','54X6zoYZZnS35o6m5gEwGmYC6" . $cc_encryption_hash . "') WHERE id='{$id}'";
		$result2      = mysql_query($query2);
	}
}
function v340Upgrade() {
	mysql_import_file('upgrade340.sql');
	$result = mysql_query("UPDATE tblhosting SET nextinvoicedate = nextduedate");
	$result = mysql_query("UPDATE tbldomains SET nextinvoicedate = nextduedate");
	$result = mysql_query("UPDATE tblhostingaddons SET nextinvoicedate = nextduedate");
}
function v341Upgrade() {
	mysql_import_file('upgrade341.sql');
}
function v350Upgrade() {
	$query  = "ALTER TABLE tblupgrades ADD `orderid` INT( 1 ) NOT NULL AFTER `id`";
	$result = mysql_query($query);
	$query  = "SELECT * FROM tblorders WHERE upgradeids!=''";
	$result = mysql_query($query);
	while($data = mysql_fetch_array($result)) {
		$orderid    = $data['id'];
		$upgradeids = $data['upgradeids'];
		$upgradeids = explode(',', $upgradeids);
		foreach($upgradeids as $upgradeid) {
			if($upgradeid) {
				$query2  = "UPDATE tblupgrades SET orderid='" . $orderid . "' WHERE id='" . $upgradeid . "'";
				$result2 = mysql_query($query2);
			}
		}
	}
	mysql_import_file('upgrade350.sql');
}
function v360Upgrade() {
	mysql_import_file('upgrade360.sql');
	$query         = "SELECT COUNT(*) FROM tblpaymentgateways WHERE gateway='paypal'";
	$result        = mysql_query($query);
	$data          = mysql_fetch_array($result);
	$paypalenabled = $data[0];
	if($paypalenabled) {
		$query  = "INSERT INTO `tblpaymentgateways` (`id`, `gateway`, `type`, `setting`, `value`, `name`, `size`, `notes`, `description`, `order`) VALUES('', 'paypal', 'yesno', 'forceonetime', '', 'Force One Time Payments', 0, '', 'Tick this box to never show the subscription payment button', 0)";
		$result = mysql_query($query);
	}
}
function v361Upgrade() {
	mysql_import_file('upgrade361.sql');
	include_once('../includes/functions.php');
	$query  = 'SELECT id,value FROM tblregistrars';
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$id      = $row['id'];
		$value   = $row['value'];
		$value   = encrypt($value);
		$query2  = "UPDATE tblregistrars SET value='" . $value . "' WHERE id='{$id}'";
		$result2 = mysql_query($query2);
	}
}
function v362Upgrade() {
	mysql_import_file('upgrade362.sql');
	mysql_query("ALTER TABLE `tblaffiliateswithdrawals` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT , CHANGE `affiliateid` `affiliateid` INT( 10 ) NOT NULL");
	mysql_query("CREATE INDEX affiliateid ON tblaffiliateswithdrawals (affiliateid)");
	$query  = "SELECT * FROM tbladmins";
	$result = mysql_query($query);
	while($data = mysql_fetch_array($result)) {
		$adminid         = $data['id'];
		$supportdepts    = $data['supportdepts'];
		$supportdepts    = explode(',', $supportdepts);
		$newsupportdepts = ',';
		foreach($supportdepts as $supportdept) {
			if($supportdept) {
				$newsupportdepts .= ltrim($supportdept, 0) . ',';
			}
		}
		$query2  = "UPDATE tbladmins SET supportdepts='" . $newsupportdepts . "' WHERE id='" . $adminid . "'";
		$result2 = mysql_query($query2);
	}
}
function v370UpgradeX($string) {
	$key    = "5a8ej8WndK\$3#9Ua425!hg741KknN";
	$result = '';
	$string = base64_decode($string);
	for($i = 0; $i < strlen($string); $i++) {
		$char    = substr($string, $i, 1);
		$keychar = substr($key, $i % strlen($key) - 1, 1);
		$char    = chr(ord($char) - ord($keychar));
		$result .= $char;
	}
	unset($key);
	return $result;
}
function v370Upgrade() {
	mysql_import_file('upgrade370.sql');
	include_once('../includes/functions.php');
	$query  = 'SELECT id,password FROM tblclients';
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$id      = $row[0];
		$value   = $row[1];
		$value   = v370upgradex($value);
		$value   = encrypt($value);
		$query2  = "UPDATE tblclients SET password='" . $value . "' WHERE id='{$id}'";
		$result2 = mysql_query($query2);
	}
	$query  = 'SELECT id,password FROM tblhosting';
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$id      = $row[0];
		$value   = $row[1];
		$value   = v370upgradex($value);
		$value   = encrypt($value);
		$query2  = "UPDATE tblhosting SET password='" . $value . "' WHERE id='{$id}'";
		$result2 = mysql_query($query2);
	}
	$query  = 'SELECT id,value FROM tblregistrars';
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$id      = $row[0];
		$value   = $row[1];
		$value   = v370upgradex($value);
		$value   = encrypt($value);
		$query2  = "UPDATE tblregistrars SET value='" . $value . "' WHERE id='{$id}'";
		$result2 = mysql_query($query2);
	}
	$query  = 'SELECT id,password FROM tblservers';
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$id      = $row[0];
		$value   = $row[1];
		$value   = v370upgradex($value);
		$value   = encrypt($value);
		$query2  = "UPDATE tblservers SET password='" . $value . "' WHERE id='{$id}'";
		$result2 = mysql_query($query2);
	}
	$general_email_merge_fields                        = array();
	$general_email_merge_fields['CustomerID']          = 'client_id';
	$general_email_merge_fields['CustomerName']        = 'client_name';
	$general_email_merge_fields['CustomerFirstName']   = 'client_first_name';
	$general_email_merge_fields['CustomerLastName']    = 'client_last_name';
	$general_email_merge_fields['CompanyName']         = 'client_company_name';
	$general_email_merge_fields['CustomerEmail']       = 'client_email';
	$general_email_merge_fields['Address1']            = 'client_address1';
	$general_email_merge_fields['Address2']            = 'client_address2';
	$general_email_merge_fields['City']                = 'client_city';
	$general_email_merge_fields['State']               = 'client_state';
	$general_email_merge_fields['Postcode']            = 'client_postcode';
	$general_email_merge_fields['Country']             = 'client_country';
	$general_email_merge_fields['PhoneNumber']         = 'client_phonenumber';
	$general_email_merge_fields['MAPassword']          = 'client_password';
	$general_email_merge_fields['CAPassword']          = 'client_password';
	$general_email_merge_fields['CreditBalance']       = 'client_credit';
	$general_email_merge_fields['CCType']              = 'client_cc_type';
	$general_email_merge_fields['CCLastFour']          = 'client_cc_number';
	$general_email_merge_fields['CCExpiryDate']        = 'client_cc_expiry';
	$general_email_merge_fields['SystemCompanyName']   = 'company_name';
	$general_email_merge_fields['ClientAreaLink']      = 'whmcs_url';
	$general_email_merge_fields['Signature']           = 'signature';
	$general_email_merge_fields['http://smartftp.com'] = 'http://www.filezilla-project.org/';
	$general_email_merge_fields['smart ftp']           = 'FileZilla';
	$email_merge_fields                                = array();
	$email_merge_fields['InvoiceID']                   = 'invoice_id';
	$email_merge_fields['InvoiceNo']                   = 'invoice_num';
	$email_merge_fields['InvoiceNum']                  = 'invoice_num';
	$email_merge_fields['InvoiceDate']                 = 'invoice_date_created';
	$email_merge_fields['DueDate']                     = 'invoice_date_due';
	$email_merge_fields['DatePaid']                    = 'invoice_date_paid';
	$email_merge_fields['Description']                 = 'invoice_html_contents';
	$email_merge_fields['SubTotal']                    = 'invoice_subtotal';
	$email_merge_fields['Credit']                      = 'invoice_credit';
	$email_merge_fields['Tax']                         = 'invoice_tax';
	$email_merge_fields['TaxRate']                     = 'invoice_tax_rate';
	$email_merge_fields['Total']                       = 'invoice_total';
	$email_merge_fields['AmountDue']                   = 'invoice_total';
	$email_merge_fields['AmountPaid']                  = 'invoice_amount_paid';
	$email_merge_fields['Balance']                     = 'invoice_balance';
	$email_merge_fields['LastPaymentAmount']           = 'invoice_last_payment_amount';
	$email_merge_fields['Status']                      = 'invoice_status';
	$email_merge_fields['TransactionID']               = 'invoice_last_payment_transid';
	$email_merge_fields['PayButton']                   = 'invoice_payment_link';
	$email_merge_fields['PaymentMethod']               = 'invoice_payment_method';
	$email_merge_fields['InvoiceLink']                 = 'invoice_link';
	$email_merge_fields['PreviousBalance']             = 'invoice_previous_balance';
	$email_merge_fields['AllDueInvoices']              = 'invoice_all_due_total';
	$email_merge_fields['TotalBalanceDue']             = 'invoice_total_balance_due';
	$query                                             = "SELECT * FROM tblemailtemplates WHERE type='invoice'";
	$result                                            = mysql_query($query);
	while($data = mysql_fetch_array($result)) {
		$email_id      = $data['id'];
		$email_subject = $data['subject'];
		$email_message = $data['message'];
		foreach($email_merge_fields as $old_email_merge_fields => $new_email_merge_fields) {
			$email_subject = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_subject);
			$email_message = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_message);
		}
		foreach($general_email_merge_fields as $old_email_merge_fields => $new_email_merge_fields) {
			$email_subject = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_subject);
			$email_message = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_message);
		}
		$query   = "UPDATE tblemailtemplates SET subject='" . mysql_real_escape_string($email_subject) . "',message='" . mysql_real_escape_string($email_message) . "' WHERE id='" . $email_id . "'";
		$result2 = mysql_query($query);
	}
	$email_merge_fields                       = array();
	$email_merge_fields['OrderID']            = 'domain_order_id';
	$email_merge_fields['RegDate']            = 'domain_reg_date';
	$email_merge_fields['Status']             = 'domain_status';
	$email_merge_fields['Domain']             = 'domain_name';
	$email_merge_fields['Amount']             = 'domain_first_payment_amount';
	$email_merge_fields['FirstPaymentAmount'] = 'domain_first_payment_amount';
	$email_merge_fields['RecurringAmount']    = 'domain_recurring_amount';
	$email_merge_fields['Registrar']          = 'domain_registrar';
	$email_merge_fields['RegPeriod']          = 'domain_reg_period';
	$email_merge_fields['ExpiryDate']         = 'domain_expiry_date';
	$email_merge_fields['NextDueDate']        = 'domain_next_due_date';
	$email_merge_fields['DaysUntilExpiry']    = 'domain_days_until_expiry';
	$query                                    = "SELECT * FROM tblemailtemplates WHERE type='domain'";
	$result                                   = mysql_query($query);
	while($data = mysql_fetch_array($result)) {
		$email_id      = $data['id'];
		$email_subject = $data['subject'];
		$email_message = $data['message'];
		foreach($email_merge_fields as $old_email_merge_fields => $new_email_merge_fields) {
			$email_subject = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_subject);
			$email_message = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_message);
		}
		foreach($general_email_merge_fields as $old_email_merge_fields => $new_email_merge_fields) {
			$email_subject = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_subject);
			$email_message = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_message);
		}
		$query   = "UPDATE tblemailtemplates SET subject='" . mysql_real_escape_string($email_subject) . "',message='" . mysql_real_escape_string($email_message) . "' WHERE id='" . $email_id . "'";
		$result2 = mysql_query($query);
	}
	$email_merge_fields                  = array();
	$email_merge_fields['Name']          = 'client_name';
	$email_merge_fields['TicketID']      = 'ticket_id';
	$email_merge_fields['Department']    = 'ticket_department';
	$email_merge_fields['DateOpened']    = 'ticket_date_opened';
	$email_merge_fields['Subject']       = 'ticket_subject';
	$email_merge_fields['Message']       = 'ticket_message';
	$email_merge_fields['Status']        = 'ticket_status';
	$email_merge_fields['Priority']      = 'ticket_priority';
	$email_merge_fields['TicketURL']     = 'ticket_url';
	$email_merge_fields['TicketLink']    = 'ticket_link';
	$email_merge_fields['AutoCloseTime'] = 'ticket_auto_close_time';
	$query                               = "SELECT * FROM tblemailtemplates WHERE type='support'";
	$result                              = mysql_query($query);
	while($data = mysql_fetch_array($result)) {
		$email_id      = $data['id'];
		$email_subject = $data['subject'];
		$email_message = $data['message'];
		foreach($email_merge_fields as $old_email_merge_fields => $new_email_merge_fields) {
			$email_subject = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_subject);
			$email_message = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_message);
		}
		foreach($general_email_merge_fields as $old_email_merge_fields => $new_email_merge_fields) {
			$email_subject = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_subject);
			$email_message = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_message);
		}
		$query   = "UPDATE tblemailtemplates SET subject='" . mysql_real_escape_string($email_subject) . "',message='" . mysql_real_escape_string($email_message) . "' WHERE id='" . $email_id . "'";
		$result2 = mysql_query($query);
	}
	$email_merge_fields                         = array();
	$email_merge_fields['OrderID']              = 'service_order_id';
	$email_merge_fields['ProductID']            = 'service_id';
	$email_merge_fields['RegDate']              = 'service_reg_date';
	$email_merge_fields['Domain']               = 'service_domain';
	$email_merge_fields['domain']               = 'service_domain';
	$email_merge_fields['ServerName']           = 'service_server_name';
	$email_merge_fields['ServerIP']             = 'service_server_ip';
	$email_merge_fields['serverip']             = 'service_server_ip';
	$email_merge_fields['DedicatedIP']          = 'service_dedicated_ip';
	$email_merge_fields['AssignedIPs']          = 'service_assigned_ips';
	$email_merge_fields['Nameserver1']          = 'service_ns1';
	$email_merge_fields['Nameserver2']          = 'service_ns2';
	$email_merge_fields['Nameserver3']          = 'service_ns3';
	$email_merge_fields['Nameserver4']          = 'service_ns4';
	$email_merge_fields['Nameserver1IP']        = 'service_ns1_ip';
	$email_merge_fields['Nameserver2IP']        = 'service_ns2_ip';
	$email_merge_fields['Nameserver3IP']        = 'service_ns3_ip';
	$email_merge_fields['Nameserver4IP']        = 'service_ns4_ip';
	$email_merge_fields['Product']              = 'service_product_name';
	$email_merge_fields['Package']              = 'service_product_name';
	$email_merge_fields['ConfigOptions']        = 'service_config_options_html';
	$email_merge_fields['PaymentMethod']        = 'service_payment_method';
	$email_merge_fields['Amount']               = 'service_recurring_amount';
	$email_merge_fields['FirstPaymentAmount']   = 'service_first_payment_amount';
	$email_merge_fields['RecurringAmount']      = 'service_recurring_amount';
	$email_merge_fields['BillingCycle']         = 'service_billing_cycle';
	$email_merge_fields['NextDueDate']          = 'service_next_due_date';
	$email_merge_fields['Status']               = 'service_status';
	$email_merge_fields['Username']             = 'service_username';
	$email_merge_fields['Password']             = 'service_password';
	$email_merge_fields['CpanelUsername']       = 'service_username';
	$email_merge_fields['CpanelPassword']       = 'service_password';
	$email_merge_fields['RootUsername']         = 'service_username';
	$email_merge_fields['RootPassword']         = 'service_password';
	$email_merge_fields['OrderNumber']          = 'order_number';
	$email_merge_fields['OrderDetails']         = 'order_details';
	$email_merge_fields['SSLConfigurationLink'] = 'ssl_configuration_link';
	$query                                      = "SELECT * FROM tblemailtemplates WHERE type='product'";
	$result                                     = mysql_query($query);
	while($data = mysql_fetch_array($result)) {
		$email_id      = $data['id'];
		$email_subject = $data['subject'];
		$email_message = $data['message'];
		foreach($email_merge_fields as $old_email_merge_fields => $new_email_merge_fields) {
			$email_subject = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_subject);
			$email_message = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_message);
		}
		foreach($general_email_merge_fields as $old_email_merge_fields => $new_email_merge_fields) {
			$email_subject = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_subject);
			$email_message = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_message);
		}
		$query   = "UPDATE tblemailtemplates SET subject='" . mysql_real_escape_string($email_subject) . "',message='" . mysql_real_escape_string($email_message) . "' WHERE id='" . $email_id . "'";
		$result2 = mysql_query($query);
	}
	$email_merge_fields                    = array();
	$email_merge_fields['TotalVisitors']   = 'affiliate_total_visits';
	$email_merge_fields['CurrentBalance']  = 'affiliate_balance';
	$email_merge_fields['AmountWithdrawn'] = 'affiliate_withdrawn';
	$email_merge_fields['ReferralsTable']  = 'affiliate_referrals_table';
	$email_merge_fields['ReferralLink']    = 'affiliate_referral_url';
	$query                                 = "SELECT * FROM tblemailtemplates WHERE type='affiliate'";
	$result                                = mysql_query($query);
	while($data = mysql_fetch_array($result)) {
		$email_id      = $data['id'];
		$email_subject = $data['subject'];
		$email_message = $data['message'];
		foreach($email_merge_fields as $old_email_merge_fields => $new_email_merge_fields) {
			$email_subject = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_subject);
			$email_message = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_message);
		}
		foreach($general_email_merge_fields as $old_email_merge_fields => $new_email_merge_fields) {
			$email_subject = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_subject);
			$email_message = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_message);
		}
		$query   = "UPDATE tblemailtemplates SET subject='" . mysql_real_escape_string($email_subject) . "',message='" . mysql_real_escape_string($email_message) . "' WHERE id='" . $email_id . "'";
		$result2 = mysql_query($query);
	}
	$query  = "SELECT * FROM tblemailtemplates WHERE type='general'";
	$result = mysql_query($query);
	while($data = mysql_fetch_array($result)) {
		$email_id      = $data['id'];
		$email_subject = $data['subject'];
		$email_message = $data['message'];
		foreach($general_email_merge_fields as $old_email_merge_fields => $new_email_merge_fields) {
			$email_subject = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_subject);
			$email_message = str_replace("[" . $old_email_merge_fields . "]", "{\$" . $new_email_merge_fields . "}", $email_message);
		}
		$query   = "UPDATE tblemailtemplates SET subject='" . mysql_real_escape_string($email_subject) . "',message='" . mysql_real_escape_string($email_message) . "' WHERE id='" . $email_id . "'";
		$result2 = mysql_query($query);
	}
}
function v380Upgrade() {
	$query  = "ALTER TABLE `tblcustomfields` DROP `num` ;";
	$result = mysql_query($query);
	mysql_query("INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('EmailCSS', 'body,td { font-family: verdana; font-size: 11px; font-weight: normal; }
a { color: #0000ff; }')");
	mysql_import_file('upgrade380.sql');
	$query  = 'SELECT DISTINCT gid FROM tblproductconfigoptions';
	$result = mysql_query($query);
	while($data = mysql_fetch_array($result)) {
		$productconfigoptionspid = $data['gid'];
		$query                   = "INSERT INTO tblproductconfiggroups (id,name,description) VALUES ('" . $productconfigoptionspid . "','Default Options','For product ID " . $productconfigoptionspid . " - created by upgrade script')";
		$result2                 = mysql_query($query);
		$query                   = "INSERT INTO tblproductconfiglinks (gid,pid) VALUES ('" . $productconfigoptionspid . "','" . $productconfigoptionspid . "')";
		$result2                 = mysql_query($query);
	}
}
function v382Upgrade() {
	mysql_import_file('upgrade382.sql');
}
function V4generateClientPW($plain, $salt = '') {
	if(!$salt) {
		$seeds       = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ#!%()#!%()#!%()";
		$seeds_count = strlen($seeds) - 1;
		for($i = 0; $i < 5; $i++) {
			$salt .= $seeds[rand(0, $seeds_count)];
		}
	}
	$pw = md5($salt . html_entity_decode($plain)) . ':' . $salt;
	return $pw;
}
function v400Upgrade() {
	global $license;
	include_once('../includes/functions.php');
	if(empty($_REQUEST['nomd5']) || !$_REQUEST['nomd5']) {
		$query  = 'SELECT id, password FROM tblclients';
		$result = mysql_query($query);
		while($data = mysql_fetch_assoc($result)) {
			$password  = decrypt($data['password']);
			$password  = v4generateclientpw($password);
			$id        = $data['id'];
			$upd_query = "UPDATE tblclients SET password = '" . $password . "' WHERE id = " . $id . ';';
			mysql_query($upd_query);
		}
		$query = "INSERT into tblconfiguration VALUES ('NOMD5', '');";
		mysql_query($query);
	} else {
		$query = "INSERT into tblconfiguration VALUES ('NOMD5', 'on');";
		mysql_query($query);
	}
	mysql_import_file('upgrade400.sql');
	$query  = 'SELECT id, category FROM tblknowledgebase';
	$result = mysql_query($query);
	while($data = mysql_fetch_assoc($result)) {
		$id       = $data['id'];
		$category = $data['category'];
		$query    = "INSERT INTO tblknowledgebaselinks (categoryid,articleid) VALUES ('" . $category . "','{$id}')";
		mysql_query($query);
	}
	mysql_query("ALTER TABLE `tblknowledgebase` DROP `category`");
	$existingcurrency = array();
	$query            = "SELECT * FROM tblconfiguration WHERE setting LIKE 'Currency%'";
	$result           = mysql_query($query);
	while($data = mysql_fetch_assoc($result)) {
		$existingcurrency[$data['setting']] = $data['value'];
	}
	$query = 'TRUNCATE tblcurrencies';
	mysql_query($query);
	$query = "INSERT INTO `tblcurrencies` (`id`, `code`, `prefix`, `suffix`, `format`, `rate`, `default`) VALUES
(1, '" . $existingcurrency['Currency'] . "', '" . $existingcurrency['CurrencySymbol'] . "', ' " . $existingcurrency['Currency'] . "', 1, 1.00000, 1)";
	mysql_query($query);
	$query = "DELETE FROM tblconfiguration WHERE setting='Currency' OR setting='CurrencySymbol'";
	mysql_query($query);
	$query  = "SELECT * FROM tblproducts WHERE paytype!='free' ORDER BY id ASC";
	$result = mysql_query($query);
	while($data = mysql_fetch_assoc($result)) {
		$id         = $data['id'];
		$paytype    = $data['paytype'];
		$msetupfee  = $data['msetupfee'];
		$qsetupfee  = $data['qsetupfee'];
		$ssetupfee  = $data['ssetupfee'];
		$asetupfee  = $data['asetupfee'];
		$bsetupfee  = $data['bsetupfee'];
		$monthly    = $data['monthly'];
		$quarterly  = $data['quarterly'];
		$semiannual = $data['semiannual'];
		$annual     = $data['annual'];
		$biennial   = $data['biennial'];
		if($paytype == 'recurring') {
			if($monthly <= 0) {
				$monthly = '-1';
			}
			if($quarterly <= 0) {
				$quarterly = '-1';
			}
			if($semiannual <= 0) {
				$semiannual = '-1';
			}
			if($annual <= 0) {
				$annual = '-1';
			}
			if($biennial <= 0) {
				$biennial = '-1';
			}
		}
		$query = "INSERT INTO tblpricing (type,currency,relid,msetupfee,qsetupfee,ssetupfee,asetupfee,bsetupfee,monthly,quarterly,semiannually,annually,biennially) VALUES ('product','1','{$id}','" . $msetupfee . "','" . $qsetupfee . "','" . $ssetupfee . "','" . $asetupfee . "','" . $bsetupfee . "','" . $monthly . "','" . $quarterly . "','" . $semiannual . "','" . $annual . "','" . $biennial . "')";
		mysql_query($query);
	}
	$query  = "SELECT * FROM tblproductconfigoptionssub ORDER BY id ASC";
	$result = mysql_query($query);
	while($data = mysql_fetch_assoc($result)) {
		$id         = $data['id'];
		$setup      = $data['setup'];
		$monthly    = $data['monthly'];
		$quarterly  = $data['quarterly'];
		$semiannual = $data['semiannual'];
		$annual     = $data['annual'];
		$biennial   = $data['biennial'];
		$query      = "INSERT INTO tblpricing (type,currency,relid,msetupfee,qsetupfee,ssetupfee,asetupfee,bsetupfee,monthly,quarterly,semiannually,annually,biennially) VALUES ('configoptions','1','{$id}','" . $setup . "','" . $setup . "','" . $setup . "','" . $setup . "','" . $setup . "','" . $monthly . "','" . $quarterly . "','" . $semiannual . "','" . $annual . "','" . $biennial . "')";
		mysql_query($query);
	}
	$query  = "SELECT * FROM tbladdons ORDER BY id ASC";
	$result = mysql_query($query);
	while($data = mysql_fetch_assoc($result)) {
		$id        = $data['id'];
		$setupfee  = $data['setupfee'];
		$recurring = $data['recurring'];
		$query     = "INSERT INTO tblpricing (type,currency,relid,msetupfee,qsetupfee,ssetupfee,asetupfee,bsetupfee,monthly,quarterly,semiannually,annually,biennially) VALUES ('addon','1','{$id}','" . $setupfee . "','0','0','0','0','" . $recurring . "','0','0','0','0')";
		mysql_query($query);
	}
	$domainpricing = array();
	$query         = "SELECT * FROM tbldomainpricing ORDER BY id ASC";
	$result        = mysql_query($query);
	while($data = mysql_fetch_assoc($result)) {
		$extension = $data['extension'];
		$regperiod = $data['registrationperiod'];
		if($data['register'] != '0.00' && $data['transfer'] <= 0) {
			$data['transfer'] = '-1';
		}
		if($data['register'] != '0.00' && $data['renew'] <= 0) {
			$data['renew'] = '-1';
		}
		$domainpricing[$extension][$regperiod]['register'] = $data['register'];
		$domainpricing[$extension][$regperiod]['transfer'] = $data['transfer'];
		$domainpricing[$extension][$regperiod]['renew']    = $data['renew'];
	}
	$query  = 'SELECT DISTINCT extension FROM tbldomainpricing';
	$result = mysql_query($query);
	while($data = mysql_fetch_assoc($result)) {
		$extension = $data['extension'];
		$query     = "SELECT id FROM tbldomainpricing WHERE extension='" . $extension . "' ORDER BY registrationperiod ASC";
		$result2   = mysql_query($query);
		$data      = mysql_fetch_assoc($result2);
		$id        = $data['id'];
		$query     = "DELETE FROM tbldomainpricing WHERE extension='" . $extension . "' AND id!='{$id}'";
		mysql_query($query);
	}
	$query  = "SELECT * FROM tbldomainpricing ORDER BY id ASC";
	$result = mysql_query($query);
	while($data = mysql_fetch_assoc($result)) {
		$id         = $data['id'];
		$extension  = $data['extension'];
		$inserttype = 'register';
		$query      = "INSERT INTO tblpricing (type,currency,relid,msetupfee,qsetupfee,ssetupfee,asetupfee,bsetupfee,monthly,quarterly,semiannually,annually,biennially) VALUES ('domain" . $inserttype . "','1','{$id}','" . $domainpricing[$extension][1][$inserttype] . "','" . $domainpricing[$extension][2][$inserttype] . "','" . $domainpricing[$extension][3][$inserttype] . "','" . $domainpricing[$extension][4][$inserttype] . "','" . $domainpricing[$extension][5][$inserttype] . "','" . $domainpricing[$extension][6][$inserttype] . "','" . $domainpricing[$extension][7][$inserttype] . "','" . $domainpricing[$extension][8][$inserttype] . "','" . $domainpricing[$extension][9][$inserttype] . "','" . $domainpricing[$extension][10][$inserttype] . "')";
		mysql_query($query);
		$inserttype = 'transfer';
		$query      = "INSERT INTO tblpricing (type,currency,relid,msetupfee,qsetupfee,ssetupfee,asetupfee,bsetupfee,monthly,quarterly,semiannually,annually,biennially) VALUES ('domain" . $inserttype . "','1','{$id}','" . $domainpricing[$extension][1][$inserttype] . "','" . $domainpricing[$extension][2][$inserttype] . "','" . $domainpricing[$extension][3][$inserttype] . "','" . $domainpricing[$extension][4][$inserttype] . "','" . $domainpricing[$extension][5][$inserttype] . "','" . $domainpricing[$extension][6][$inserttype] . "','" . $domainpricing[$extension][7][$inserttype] . "','" . $domainpricing[$extension][8][$inserttype] . "','" . $domainpricing[$extension][9][$inserttype] . "','" . $domainpricing[$extension][10][$inserttype] . "')";
		mysql_query($query);
		$inserttype = 'renew';
		$query      = "INSERT INTO tblpricing (type,currency,relid,msetupfee,qsetupfee,ssetupfee,asetupfee,bsetupfee,monthly,quarterly,semiannually,annually,biennially) VALUES ('domain" . $inserttype . "','1','{$id}','" . $domainpricing[$extension][1][$inserttype] . "','" . $domainpricing[$extension][2][$inserttype] . "','" . $domainpricing[$extension][3][$inserttype] . "','" . $domainpricing[$extension][4][$inserttype] . "','" . $domainpricing[$extension][5][$inserttype] . "','" . $domainpricing[$extension][6][$inserttype] . "','" . $domainpricing[$extension][7][$inserttype] . "','" . $domainpricing[$extension][8][$inserttype] . "','" . $domainpricing[$extension][9][$inserttype] . "','" . $domainpricing[$extension][10][$inserttype] . "')";
		mysql_query($query);
	}
	mysql_query("ALTER TABLE `tblproducts` DROP `msetupfee`,DROP `qsetupfee`,DROP `ssetupfee`,DROP `asetupfee`,DROP `bsetupfee`,DROP `monthly`,DROP `quarterly`,DROP `semiannual`,DROP `annual`,DROP `biennial`");
	mysql_query("ALTER TABLE `tbldomainpricing`  DROP `registrationperiod`,  DROP `register`,  DROP `transfer`,  DROP `renew`");
	mysql_query("ALTER TABLE `tblproductconfigoptionssub` DROP `setup`,DROP `monthly`,DROP `quarterly`,DROP `semiannual`,DROP `annual`,DROP `biennial`");
	mysql_query("ALTER TABLE `tbladdons`  DROP `recurring`,  DROP `setupfee`");
	mysql_query("ALTER TABLE `mod_licensing` ADD `lastaccess` DATE NOT NULL");
	/*
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://www.whmcs.com/license/v4upgrade.php?licensekey=" . $license);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($ch);
	curl_close($ch);
	*/
}
function v410Upgrade() {
	mysql_import_file('upgrade410.sql');
	include('../configuration.php');
	$query  = "SELECT id,AES_DECRYPT(cardnum,'54X6zoYZZnS35o6m5gEwGmYC6" . $cc_encryption_hash . "') as cardnum,AES_DECRYPT(expdate,'54X6zoYZZnS35o6m5gEwGmYC6" . $cc_encryption_hash . "') as expdate,AES_DECRYPT(issuenumber,'54X6zoYZZnS35o6m5gEwGmYC6" . $cc_encryption_hash . "') as issuenumber,AES_DECRYPT(startdate,'54X6zoYZZnS35o6m5gEwGmYC6" . $cc_encryption_hash . "') as startdate FROM tblclients WHERE cardnum!=''";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$userid       = $row['id'];
		$cardnum      = $row['cardnum'];
		$cardexp      = $row['expdate'];
		$cardissuenum = $row['issuenumber'];
		$cardstart    = $row['startdate'];
		$cardlastfour = substr($cardnum, 0 - 4);
		$cchash       = md5($cc_encryption_hash . $userid);
		$query2       = "UPDATE tblclients SET cardlastfour='" . $cardlastfour . "',cardnum=AES_ENCRYPT('" . $cardnum . "','" . $cchash . "'),expdate=AES_ENCRYPT('" . $cardexp . "','" . $cchash . "'),startdate=AES_ENCRYPT('" . $cardstart . "','" . $cchash . "'),issuenumber=AES_ENCRYPT('" . $cardissuenum . "','" . $cchash . "') WHERE id='" . $userid . "'";
		$result2      = mysql_query($query2);
	}
}
function v420Upgrade() {
	mysql_import_file('upgrade420.sql');
}
function v421Upgrade() {
	mysql_import_file('upgrade421.sql');
}
function v430Upgrade() {
	mysql_import_file('upgrade430.sql');
	$query = "UPDATE tblconfiguration SET value='ssl' where setting = 'SMTPSSL' and value='on';";
	mysql_query($query);
}
function v431Upgrade() {
	$query = "UPDATE tblconfiguration SET value='cart' where setting = 'OrderFormTemplate' and value='singlepage';";
	mysql_query($query);
}
function v440Upgrade() {
	mysql_import_file('upgrade440.sql');
}
function v442Upgrade() {
	$query = "INSERT INTO tblconfiguration (setting,value) VALUES ('CCDoNotRemoveOnExpiry','')";
	mysql_query($query);
}
function v450Upgrade() {
	$query = "UPDATE tblemailtemplates SET name='Hosting Account Welcome Email' WHERE name='Hosting Account Welcome Email (cPanel)'";
	mysql_query($query);
	$query = "UPDATE tblemailtemplates SET custom='1' WHERE name='Hosting Account Welcome Email (DirectAdmin)'";
	mysql_query($query);
	$query = "UPDATE tblemailtemplates SET custom='1' WHERE name='Hosting Account Welcome Email (Plesk)'";
	mysql_query($query);
	mysql_import_file('upgrade450.sql');
}
function v452Upgrade() {
	mysql_query("ALTER TABLE `tblsslorders` CHANGE `status` `status` TEXT NOT NULL");
	mysql_query("UPDATE `tblsslorders` SET status='Awaiting Configuration' WHERE status='Incomplete'");
	mysql_query("ALTER TABLE `tblsslorders` ADD `configdata` TEXT NOT NULL AFTER `certtype`");
}
function v500Upgrade() {
	mysql_import_file('upgrade500.sql');
	mysql_query("INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES('EmailGlobalHeader', '&lt;p&gt;&lt;a href=&quot;{\$company_domain}&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;{\$company_logo_url}&quot; alt=&quot;{\$company_name}&quot; border=&quot;0&quot; /&gt;&lt;/a&gt;&lt;/p&gt;')");
	mysql_query("INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES('EmailGlobalFooter', '')");
}
function v501Upgrade() {
	mysql_import_file('upgrade501.sql');
	mysql_query("UPDATE tbladmins SET template='blend' WHERE template='simple'");
	mysql_query("ALTER TABLE `tblclients`  ADD `bankname` TEXT NOT NULL AFTER `issuenumber`,  ADD `banktype` TEXT NOT NULL AFTER `bankname`,  ADD `bankcode` BLOB NOT NULL AFTER `banktype`,  ADD `bankacct` BLOB NOT NULL AFTER `bankcode`");
}
function v502Upgrade() {
	mysql_import_file('upgrade502.sql');
}
function v503Upgrade() {
	mysql_query("UPDATE tblconfiguration SET value='' WHERE setting='License'");
	mysql_query("UPDATE tbladminroles SET widgets = CONCAT(widgets,',supporttickets_overview')");
}
function v510Upgrade() {
	mysql_import_file('upgrade510.sql');
	mysql_query("UPDATE tblpaymentgateways SET value='CC' WHERE gateway='worldpayfuturepay' AND setting='type'");
	$result       = mysql_query("SELECT id FROM tblcustomfields WHERE type='client' AND fieldname='FuturePay ID'");
	$data         = mysql_fetch_array($result);
	$futurepayfid = $data[0];
	if($futurepayfid) {
		$result = mysql_query("SELECT relid,value FROM tblcustomfieldsvalues WHERE fieldid=" . $futurepayfid);
		while($data = mysql_fetch_array($result)) {
			$userid = $data[0];
			$fpid   = $data[1];
			mysql_query("UPDATE tblclients SET gatewayid='" . $fpid . "' WHERE id=" . $userid . " AND gatewayid=''");
			mysql_query("DELETE FROM tblcustomfieldsvalues WHERE fieldid=" . $futurepayfid . " AND relid=" . $userid);
		}
		mysql_query("DELETE FROM tblcustomfields WHERE id=" . $futurepayfid);
	}
	mysql_query("ALTER TABLE  `tblcalendar` ADD  `start` INT( 10 ) NOT NULL AFTER  `desc` , ADD  `end` INT( 10 ) NOT NULL AFTER  `start`, ADD  `allday` INT( 1 ) NOT NULL AFTER  `end`, ADD  `recurid` INT( 10 ) NOT NULL AFTER  `adminid`");
	$result = mysql_query("SELECT * FROM tblcalendar");
	while($data = mysql_fetch_array($result)) {
		$id      = $data['id'];
		$day     = $data['day'];
		$month   = $data['month'];
		$year    = $data['year'];
		$startt1 = $data['startt1'];
		$startt2 = $data['startt2'];
		$endt1   = $data['endt1'];
		$endt2   = $data['endt2'];
		$start   = mktime($startt1, $startt2, 0, $month, $day, $year);
		$end     = $endt1 && $endt2 ? mktime($endt1, $endt2, 0, $month, $day, $year) : '0';
		mysql_query("UPDATE tblcalendar SET start='" . $start . "',end='" . $end . "' WHERE id=" . $id);
	}
	mysql_query("ALTER TABLE `tblcalendar` DROP `day`,DROP `month`,DROP `year`,DROP `startt1`,DROP `startt2`,DROP `endt1`,DROP `endt2`");
}
function v511Upgrade() {
	mysql_query("ALTER TABLE  `tblcalendar` ADD  `start` INT( 10 ) NOT NULL AFTER  `desc` , ADD  `end` INT( 10 ) NOT NULL AFTER  `start`, ADD  `allday` INT( 1 ) NOT NULL AFTER  `end`, ADD  `recurid` INT( 10 ) NOT NULL AFTER  `adminid`");
	$result = mysql_query("SELECT * FROM tblcalendar");
	while($data = mysql_fetch_array($result)) {
		$id      = $data['id'];
		$day     = $data['day'];
		$month   = $data['month'];
		$year    = $data['year'];
		$startt1 = $data['startt1'];
		$startt2 = $data['startt2'];
		$endt1   = $data['endt1'];
		$endt2   = $data['endt2'];
		$start   = mktime($startt1, $startt2, 0, $month, $day, $year);
		$end     = $endt1 && $endt2 ? mktime($endt1, $endt2, 0, $month, $day, $year) : '0';
		mysql_query("UPDATE tblcalendar SET start='" . $start . "',end='" . $end . "' WHERE id=" . $id);
	}
	mysql_query("ALTER TABLE `tblcalendar` DROP `day`,DROP `month`,DROP `year`,DROP `startt1`,DROP `startt2`,DROP `endt1`,DROP `endt2`");
	mysql_query("ALTER TABLE  `tblpromotions` ADD `lifetimepromo` INT(1) NOT NULL AFTER `uses`");
	mysql_query("ALTER TABLE  `tblquotes` ADD  `datesent` DATE NOT NULL , ADD  `dateaccepted` DATE NOT NULL");
	mysql_query("UPDATE tbladminroles SET widgets = CONCAT(widgets,',calendar')");
	mysql_query("UPDATE tbladmins SET  `homewidgets`='getting_started:true,orders_overview:true,supporttickets_overview:true,my_notes:true,client_activity:true,open_invoices:true,activity_log:true|income_overview:true,system_overview:true,whmcs_news:true,sysinfo:true,admin_activity:true,todo_list:true,network_status:true,income_forecast:true|' WHERE id=1");
}
function v512Upgrade() {
	mysql_import_file('upgrade512.sql');
	mysql_query("ALTER TABLE `tblnotes` CHANGE `important` `sticky` INT( 1 ) NOT NULL");
}
function v520Upgrade() {
	mysql_import_file('upgrade520.sql');
	include_once('../includes/functions.php');
	$newips = array();
	$query  = "SELECT value FROM tblconfiguration WHERE setting='APIAllowedIPs'";
	$result = mysql_query($query);
	$data   = mysql_fetch_array($result);
	$apiips = $data['value'];
	$apiips = explode("\n", $apiips);
	foreach($apiips as $ip) {
		$newips[] = array(
			'ip' => trim($ip),
			'note' => ''
		);
	}
	$query  = "UPDATE tblconfiguration SET value='" . mysql_real_escape_string(serialize($newips)) . "' WHERE setting='APIAllowedIPs'";
	$result = mysql_query($query);
	$query  = "SELECT value FROM tblconfiguration WHERE setting='SystemURL'";
	$result = mysql_query($query);
	$data   = mysql_fetch_array($result);
	$sysurl = $data['value'];
	if($sysurl == 'http://www.yourdomain.com/whmcs/') {
		$sysurl = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		$sysurl = str_replace("?step=5", '', $sysurl);
		$sysurl = str_replace('install/install.php', '', $sysurl);
		$sysurl = str_replace('install2/install.php', '', $sysurl);
		$query  = "UPDATE tblconfiguration SET value='" . mysql_real_escape_string($sysurl) . "' WHERE setting='SystemURL'";
		$result = mysql_query($query);
	}
	$query  = 'SELECT id,password FROM tblticketdepartments';
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$id      = $row['id'];
		$value   = encrypt($row['password']);
		$query2  = "UPDATE tblticketdepartments SET password='" . $value . "' WHERE id='{$id}'";
		$result2 = mysql_query($query2);
	}
	$query    = "SELECT value FROM tblconfiguration WHERE setting='FTPBackupPassword'";
	$result   = mysql_query($query);
	$data     = mysql_fetch_array($result);
	$ftppass  = encrypt($data['value']);
	$query    = "UPDATE tblconfiguration SET value='" . $ftppass . "' WHERE setting='FTPBackupPassword'";
	$result   = mysql_query($query);
	$query    = "SELECT value FROM tblconfiguration WHERE setting='SMTPPassword'";
	$result   = mysql_query($query);
	$data     = mysql_fetch_array($result);
	$smtppass = encrypt($data['value']);
	$query    = "UPDATE tblconfiguration SET value='" . $smtppass . "' WHERE setting='SMTPPassword'";
	$result   = mysql_query($query);
}
function v521Upgrade() {
	mysql_import_file('upgrade521.sql');
}
function v524Upgrade() {
	mysql_import_file('upgrade524.sql');
}
function v532Upgrade() {
	$query         = "SELECT message FROM tblemailtemplates WHERE type='domain' and name='Upcoming Domain Renewal Notice'";
	$result        = mysql_query($query);
	$data          = mysql_fetch_array($result);
	$currentMsgSum = md5($data['message']);
	$origMsgSum    = '7556f88474b1aca229b73b6683735625';
	if($currentMsgSum == $origMsgSum) {
		$message = "<p>Dear {\$client_name},</p>\n<p>{if \$days_until_expiry}The domain(s) listed below are due to expire within the next {\$days_until_expiry} days.{else}The domain(s) listed below are going to expire in {\$domain_days_until_expiry} days. Renew now before it''s too late...{/if}</p>\n<p>{if \$expiring_domains}{foreach from=\$expiring_domains item=domain}{\$domain.name} - {\$domain.nextduedate} <strong>({\$domain.days} Days)</strong><br />{/foreach}{elseif \$domains}{foreach from=\$domains item=domain}{\$domain.name} - {\$domain.nextduedate}<br />{/foreach}{else}{\$domain_name} - {\$domain_next_due_date} <strong>({\$domain_days_until_nextdue} Days)</strong>{/if}</p>\n<p>To ensure the domain does not expire, you should renew it now. You can do this from the domains management section of our client area here: {\$whmcs_link}</p>\n<p>Should you allow the domain to expire, you will be able to renew it for up to 30 days after the renewal date. During this time, the domain will not be accessible so any web site or email services associated with it will stop working.</p>\n<p>{\$signature}</p>\n";
		$query   = "UPDATE tblemailtemplates SET message='" . $message . "' WHERE type='domain' and name='Upcoming Domain Renewal Notice'";
		$result  = mysql_query($query);
	}
}
function v533Upgrade() {
	$query = "ALTER TABLE  `tblsslorders` ADD  `provisiondate` DATE NOT NULL AFTER  `configdata`";
	mysql_query($query);
	mysql_import_file('upgrade533.sql');
}
function v5310Upgrade() {
	$subject = "Transfer Completed for {\$domain_name}";
	$message = "&lt;p&gt;Dear {\$client_name},&lt;/p&gt;\n&lt;p&gt;We are pleased to confirm that your recent domain transfer has now been completed.&lt;/p&gt;\n&lt;p&gt;Order Date: {\$domain_reg_date}&lt;br /&gt;Domain: {\$domain_name}&lt;br /&gt;Status: {\$domain_status}&lt;/p&gt;\n&lt;p&gt;You may now login to your client area at {\$whmcs_link} to manage your domain.&lt;/p&gt;\n&lt;p&gt;{\$signature}&lt;/p&gt;";
	$query   = "INSERT INTO `tblemailtemplates`
(`id`, `type`, `name`, `subject`, `message`, `attachments`, `fromname`,
  `fromemail`, `disabled`, `custom`, `language`, `copyto`, `plaintext`) VALUES
('', 'domain', 'Domain Transfer Completed', '" . $subject . "', '" . $message . "', '', '', '', '', '', '', '', 0);";
	mysql_query($query);
}
function v5312Upgrade() {
	mysql_query('ALTER TABLE tblproducts DROP COLUMN upgradechargefullcycle');
	$subject = 'Closed Ticket Bounce Message';
	$message = "&lt;p&gt;{\$client_name},&lt;/p&gt;\n&lt;p&gt;Your email to our ticket system could not be accepted because the ticket being responded to has already been closed.&lt;/p&gt;\n&lt;p&gt;{if \$client_id}If you wish to reopen this ticket, you can do so from our client area:\n{\$ticket_link}{else}To open a new ticket, please visit:&lt;/p&gt;\n&lt;p&gt;&lt;a href=\"{\$whmcs_url}/submitticket.php\"&gt;{\$whmcs_url}/submitticket.php&lt;/a&gt;{/if}&lt;/p&gt;\n&lt;p&gt;This is an automated response from our support system.&lt;/p&gt;\n&lt;p&gt;{\$signature}&lt;/p&gt;";
	$query   = "INSERT INTO `tblemailtemplates`
(`id`, `type`, `name`, `subject`, `message`, `attachments`, `fromname`,
  `fromemail`, `disabled`, `custom`, `language`, `copyto`, `plaintext`) VALUES
('', 'support', 'Closed Ticket Bounce Message', '" . $subject . "', '" . $message . "', '', '', '', '', '', '', '', 0);";
	mysql_query($query);
	$query          = "SELECT count(*) FROM tblemailtemplates WHERE name=\"Expired Domain Notice\"";
	$result         = mysql_query($query);
	$data           = mysql_fetch_array($result);
	$templateExists = !empty($data[0]) ? true : false;
	if(!$templateExists) {
		$subject = 'Expired Domain Notice';
		$message = "&lt;p&gt;Dear {\$client_name},&lt;/p&gt;\n&lt;p&gt;The domain name listed below expired {\$domain_days_after_expiry} ago.&lt;/p&gt;\n&lt;p&gt;{\$domain_name}&lt;/p&gt;\n&lt;p&gt;To ensure the domain does become registered by someone else, you should renew it now. To renew the domain, please visit the following page and follow the steps shown: &lt;a title=&quot;{\$whmcs_url}/cart.php?gid=renewals&quot; href=&quot;{\$whmcs_url}/cart.php?gid=renewals&quot;&gt;{\$whmcs_url}/cart.php?gid=renewals&lt;/a&gt;&lt;/p&gt;\n&lt;p&gt;Due to the domain expiring, the domain will not be accessible so any web site or email services associated with it will stop working. You may be able to renew it for up to 30 days after the renewal date.&lt;/p&gt;\n&lt;p&gt;{\$signature}&lt;/p&gt;";
		$query   = "INSERT INTO `tblemailtemplates`
(`id`, `type`, `name`, `subject`, `message`, `attachments`, `fromname`,
  `fromemail`, `disabled`, `custom`, `language`, `copyto`, `plaintext`) VALUES
('', 'domain', 'Expired Domain Notice', '" . $subject . "', '" . $message . "', '', '', '', '', '', '', '', 0);";
		mysql_query($query);
	}
	$tableCreate = "CREATE TABLE IF NOT EXISTS `tbldomainreminders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `domain_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `recipients` text COLLATE utf8_general_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `days_before_expiry` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	mysql_query($tableCreate);
}
function v5313Upgrade() {
	$messageHash = '6dd1a70917ebbed0ed5681f1c9fe7e5a';
	$query       = "SELECT md5(`message`) as message FROM tblemailtemplates WHERE `name` = 'Expired Domain Notice' AND `language` = '';";
	$result      = mysql_query($query);
	$data        = mysql_fetch_assoc($result);
	if($data['message'] == $messageHash) {
		$message = "&lt;p&gt;Dear {\$client_name},&lt;/p&gt;\n&lt;p&gt;The domain name listed below expired {\$domain_days_after_expiry} days ago.&lt;/p&gt;\n&lt;p&gt;{\$domain_name}&lt;/p&gt;\n&lt;p&gt;To ensure that the domain isn&#39;t registered by someone else, you should renew it now. To renew the domain, please visit the following page and follow the steps shown: &lt;a title=&quot;{\$whmcs_url}/cart.php?gid=renewals&quot; href=&quot;{\$whmcs_url}/cart.php?gid=renewals&quot;&gt;{\$whmcs_url}/cart.php?gid=renewals&lt;/a&gt;&lt;/p&gt;\n&lt;p&gt;Due to the domain expiring, the domain will not be accessible so any web site or email services associated with it will stop working. You may be able to renew it for up to 30 days after the renewal date.&lt;/p&gt;\n&lt;p&gt;{\$signature}&lt;/p&gt;";
		$query   = "UPDATE tblemailtemplates SET message = '" . $message . "' WHERE `name` = 'Expired Domain Notice' AND language = '';";
		mysql_query($query);
	}
}