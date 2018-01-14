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
if(!defined('ROOTDIR')) {
	define('ROOTDIR', realpath(dirname(__FILE__) . '/../'));
}
if(!defined('INSTALLER_DIR')) {
	define('INSTALLER_DIR', dirname(__FILE__));
}
require(INSTALLER_DIR . '/functions.php');
spl_autoload_register('installerAutoloader');
installer_include_compat_libraries();
error_reporting(E_ERROR|E_WARNING|E_PARSE);
set_time_limit(0);
$whmcsinst = new WHMCS_Installer_Installer(new WHMCS_Version_SemanticVersion(WHMCS_Installer_Installer::DEFAULT_VERSION), new WHMCS_Version_SemanticVersion(WHMCS_Application::FILES_VERSION));
$whmcsinst->setInstallerDirectory(INSTALLER_DIR);
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
    <html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<title>WHMCS Install/Upgrade Process</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
<script type=\"text/javascript\" src=\"../includes/jscript/jquery.js\"></script>
<script>
function showloading() {
    \$(\"#submitbtn\").attr(\"disabled\",\"disabled\");
    \$(\".loading\").fadeIn();
}
</script>
<style>
body {
    background-color: #efefef;
    margin: 25px;
}
a {
    color: #0000ff;
}
body,td {
    font-family: Tahoma;
    font-size: 12px;
}
input {
    font-family: Tahoma;
    font-size: 16px;
    padding: 2px 10px;
}
h1 {
    font-size: 18px;
    font-family: Arial;
    color: #294A87;
    padding-bottom: 10px;
    border-bottom: 1px dashed #ccc;
    margin-bottom: 30px;
}
h2 {
    font-size: 16px;
    font-family: Arial;
    color: #000;
}
.wrapper {
    margin: 0 auto;
    background-color: #fff;
    width: 740px;
    padding: 10px 30px 30px 30px;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    -o-border-radius: 10px;
    border-radius: 10px;
}
.version {
    float: right;
    margin: 30px 10px;
    padding: 10px 20px;
    background-color: #294A87;
    color: #fff;
    font-family: Verdana;
    font-size: 40px;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    -o-border-radius: 10px;
    border-radius: 10px;
}
.errorbox {
    margin: 15px auto 0 auto;
    padding: 10px;
    width: 90%;
    border: 1px solid #A89824;
    font-size: 14px;
    background-color: #EEE7B0;
    text-align: left;
    color: #706518;
}
.loading {
    display: none;
    margin: 0 auto;
    padding: 20px;
    width: 400px;
    font-size: 18px;
    text-align: center;
}
</style>
</head>
<body>

<div class=\"wrapper\">

<div class=\"version\">V";
echo $whmcsinst->getLatestMajorMinorVersion();
echo "</div>

<div style=\"margin:30px;\"><img src=\"logo.png\" alt=\"WHMCS - The Complete Client Management, Billing & Support Solution\" border=\"0\" /></div>

<br />

";
$step   = isset($_REQUEST['step']) ? $_REQUEST['step'] : '';
$type   = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
$failed = false;
$error  = $firstname = $lastname = $username = $email = $password = $confirmpassword = '';
if($step == '5') {
	if(!$error && !trim($_REQUEST['firstname'])) {
		$error = 'You must enter a first name';
	}
	if(!$error && !trim($_REQUEST['email'])) {
		$error = 'You must enter an email address';
	}
	if(!$error && !trim($_REQUEST['username'])) {
		$error = 'You must enter a username';
	}
	if(!$error && !trim($_REQUEST['password'])) {
		$error = 'You must enter a password';
	}
	if(!$error && trim($_REQUEST['password']) != trim($_REQUEST['confirmpassword'])) {
		$error = 'The two passwords you entered did not match. Please try again';
	}
	if($error) {
		$step            = '4';
		$failed          = true;
		$firstname       = $_REQUEST['firstname'];
		$lastname        = $_REQUEST['lastname'];
		$username        = $_REQUEST['username'];
		$email           = $_REQUEST['email'];
		$password        = $_REQUEST['password'];
		$confirmpassword = $_REQUEST['confirmpassword'];
	}
}
if($step == '') {
	echo "
<h1>End User License Agreement</h1>
<p>Please review the license terms before installing/upgrading WHMCS.  By installing, copying, or otherwise using the software, you are agreeing to be bound by the terms of the EULA.</p>
<p align=\"center\"><textarea style=\"width:700px;font-family:Tahoma;font-size:10px;color:#666666\" rows=\"25\" readonly>
";
	if(file_exists('EULA.txt')) {
		include('EULA.txt');
		echo "</textarea></p>

<p align=center><input type=\"submit\" value=\"I AGREE\" class=\"button\" onClick=\"window.location='install.php?step=2'\"> <input type=\"button\" value=\"I DISAGREE\" class=\"button\" onClick=\"window.location='install.php'\">

";
	} else {
		echo "EULA.txt is missing from the install folder. Cannot continue.</textarea>";
		exit();
	}
} else {
	if($step == '2') {
		if($whmcsinst->isInstalled()) {
			echo "<h1>Upgrade to V" . $whmcsinst->getLatestVersion()->getCasual() . "</h1>";
			if($whmcsinst->isUpToDate()) {
				echo "<p style=\"font-size: 16px;\">You are already running the latest version of WHMCS and so cannot upgrade.</p>
";
			} else {
				if($whmcsinst->getInstalledVersionNumeric() < 320) {
					echo "<p style=\"font-size: 16px;\">The version of WHMCS you are running is too old to be upgraded automatically.</p>
<p style=\"font-size: 16px;\">You will need to purchase our professional upgrade service @ <a href=\"http://nullrefer.com/?https://www.whmcs.com/upgradeservice.php\">www.whmcs.com/upgradeservice.php</a> to have it manually updated.</p>
";
				} else {
					echo "<p align=\"center\" style=\"font-size:18px;\">Your Current Version is V";
					echo $whmcsinst->getVersion()->getCasual();
					echo "</p>
<div style=\"border: 1px dashed #cc0000; font-weight: bold;  background-color: #FBEEEB;  text-align: center; padding: 10px;  color: #cc0000;font-size:16px;\">Backup your database before continuing...</div>
<form method=\"post\" action=\"install.php\" onsubmit=\"showloading()\">
<input type=\"hidden\" name=\"step\" value=\"upgrade\" />
";
					if($whmcsinst->getInstalledVersionNumeric() < 400) {
						echo "<p align=\"center\"><input type=\"checkbox\" name=\"nomd5\" /> Do not use MD5 client password encryption</p>";
					}
					echo "<p align=\"center\"><label><input type=\"checkbox\" name=\"confirmbackup\" /> I confirm I have backed up my database</label></p>
<p align=\"center\"><input type=\"submit\" value=\"Perform Upgrade &raquo;\" class=\"button\" id=\"submitbtn\" /></p>
<div class=\"loading\">Updating Database... Please Wait...<br /><img src=\"../images/loading.gif\" /></div>
</form>
";
				}
			}
		} else {
			echo "
<h1>System Requirements Checks</h1>
<div style=\"font-size: 16px;\">
&raquo; PHP Version .......... ";
			if(0 <= version_compare(PHP_VERSION, '5.2.0')) {
				echo "<font color=#99cc00><B>Passed</B></font>";
			} else {
				echo "<font color=#cc0000><B>Failed</B></font><div class=\"errorbox\">Your PHP version needs to be upgraded to at least V5.2 for WHMCS.</div>";
				$error = '1';
			}
			echo "<br>
&raquo; MySQL .......... ";
			if(function_exists('mysql_connect')) {
				echo "<font color=#99cc00><B>Passed</B></font>";
			} else {
				echo "<font color=#cc0000><B>Failed</B></font><div class=\"errorbox\">MySQL support doesn't appear to be available in this PHP installation. You will need to install MySQL before you can continue.</div>";
				$error = '1';
			}
			echo "<br>
&raquo; CURL .......... ";
			if(function_exists('curl_init')) {
				echo "<font color=#99cc00><B>Passed</B></font>";
			} else {
				echo "<font color=#cc0000><B>Failed</B></font><div class=\"errorbox\">CURL is required in order for WHMCS to function so you will need to recompile PHP with the CURL libraries included before you can continue.</div>";
				$error = '1';
			}
			echo "<br>
&raquo; JSON .......... ";
			if(function_exists('json_encode')) {
				echo "<font color=#99cc00><B>Passed</B></font>";
			} else {
				echo "<font color=#cc0000><B>Failed</B></font><div class=\"errorbox\">JSON is required by WHMCS and was not found on your server. As of PHP 5.2.0, the JSON extension is bundled and compiled into PHP by default.</div>";
				$error = '1';
			}
			echo "<br>
&raquo; GD .......... ";
			if(function_exists('imagecreate')) {
				echo "<font color=#99cc00><B>Passed</B></font>";
			} else {
				echo "<font color=#cc0000><B>Warning</B></font><div class=\"errorbox\">GD Libraries for PHP are required for image processing within WHMCS. Proceeding without GD Libraries may not allow WHMCS to function properly.</div>";
			}
			echo "</div>
<br />
<h1>Permissions Checks</h1>
<div style=\"font-size: 16px;\">
&raquo; Configuration File .......... ";
			if(is_writable('../configuration.php')) {
				echo "<font color=#99cc00><B>Passed</B></font>";
			} else {
				echo "<font color=#cc0000><B>Failed</B></font>";
				if(!is_file('../configuration.php')) {
					echo "<div class=\"errorbox\">The file \"configuration.php\" cannot be found. Please create an empty file in the folder above the install directory with writeable permissions to continue.  For further help and advice, please see <a href=\"http://nullrefer.com/?http://docs.whmcs.com/Installing_WHMCS#Installing_WHMCS\">the WHMCS Installation Documentation</a>.</div>";
				} else {
					echo "<div class=\"errorbox\">\"/configuration.php\" requires writeable permissions in order to continue.  For further help and advice, please see <a href=\"http://nullrefer.com/?http://docs.whmcs.com/Installing_WHMCS#Installing_WHMCS\">the WHMCS Installation Documentation</a>.</div>";
				}
				$error = '1';
			}
			echo "<br>
&raquo; Attachments Folder .......... ";
			if(is_writable('../attachments/')) {
				echo "<font color=#99cc00><B>Passed</B></font>";
			} else {
				echo "<font color=#cc0000><B>Failed</B></font>";
				if(!is_dir('../attachments')) {
					echo "<div class=\"errorbox\">You must create a directory named \"attachments\" before you can continue.</div>";
				} else {
					echo "<div class=\"errorbox\">You must apply writeable permissions to the \"attachments\" directory before you can continue.  For further help and advice, please see <a href=\"http://nullrefer.com/?http://docs.whmcs.com/Installing_WHMCS#Installing_WHMCS\">the WHMCS Installation Documentation</a>.</div>";
				}
				$error = '1';
			}
			echo "<br>
&raquo; Downloads Folder .......... ";
			if(is_writable('../downloads/')) {
				echo "<font color=#99cc00><B>Passed</B></font>";
			} else {
				echo "<font color=#cc0000><B>Failed</B></font>";
				if(!is_dir('../downloads')) {
					echo "<div class=\"errorbox\">You must create a directory named \"downloads\" before you can continue.</div>";
				} else {
					echo "<div class=\"errorbox\">You must apply writeable permissions to the \"downloads\" directory before you can continue.  For further help and advice, please see <a href=\"http://nullrefer.com/?http://docs.whmcs.com/Installing_WHMCS#Installing_WHMCS\">the WHMCS Installation Documentation</a>.</div>";
				}
				$error = '1';
			}
			echo "<br>
&raquo; Templates Cache Folder .......... ";
			if(is_writable('../templates_c/')) {
				echo "<font color=#99cc00><B>Passed</B></font>";
			} else {
				echo "<font color=#cc0000><B>Failed</B></font>";
				if(!is_dir('../templates_c')) {
					echo "<div class=\"errorbox\">You must create a directory named \"templates_c\" before you can continue.</div>";
				} else {
					echo "<div class=\"errorbox\">You must apply writeable permissions to the \"templates_c\" directory before you can continue.  For further help and advice, please see <a href=\"http://nullrefer.com/?http://docs.whmcs.com/Installing_WHMCS#Installing_WHMCS\">the WHMCS Installation Documentation</a>.</div>";
				}
				$error = '1';
			}
			echo "</div>
<br />
";
			if($error == '1') {
				echo "<p align=\"center\" style=\"font-size:16px;color:#cc0000;\"><b>Pre-Installation Checks Failure</b><br />Please correct the problems listed above and then recheck the requirements to continue...</p>
<p align=\"center\"><input type=\"button\" value=\"Recheck Requirements\" onClick=\"location.reload(true);\"></p>
";
			} else {
				echo "<p align=\"center\" style=\"font-size:16px;color:#7BA400;\"><b>Pre-Installation Checks Success</b><br />Everything appears to be ok so please click continue below to begin the installation...</p>
<form method=\"post\" action=\"install.php?step=3\">
<p align=\"center\"><input type=\"submit\" value=\"Continue &raquo;\" class=\"button\" /></p>
</form>
";
			}
			echo "\n";
		}
	} else {
		if($step == '3') {
			echo "
<form method=\"post\" action=\"install.php?step=4\" onsubmit=\"showloading()\">
<h1>License Key</h1>
<p>You can find your license key in our client area <a href=\"http://nullrefer.com/?https://www.whmcs.com/members/clientarea.php\" target=\"_blank\">www.whmcs.com/members</a> or alternatively if you obtained a license via your host, they should have already provided a license key to you.</p>
<table>
<tr><td width=120>License Key</td><td><input type=\"text\" name=\"licensekey\" size=\"40\"></td></tr>
</table>
<br />
<h1>Database Connection Details</h1>
<p>You must now create a MySQL database for WHMCS to use inside your hosting control panel.  Once created, and a user assigned, enter the connection details below.</p>
<table>
<tr><td width=120>Database Host</td><td><input type=\"text\" name=\"dbhost\" size=\"20\" value=\"localhost\"></td></tr>
<tr><td>Database Username</td><td><input type=\"text\" name=\"dbusername\" size=\"20\" value=\"\"></td></tr>
<tr><td>Database Password</td><td><input type=\"password\" name=\"dbpassword\" size=\"20\" value=\"\"></td></tr>
<tr><td>Database Name</td><td><input type=\"text\" name=\"dbname\" size=\"20\" value=\"\"></td></tr>
</table>
<p align=\"center\"><input type=\"submit\" value=\"Continue &raquo;\" class=\"button\" id=\"submitbtn\" /></p>
<div class=\"loading\">Initialising Database... Please Wait...<br /><img src=\"../images/loading.gif\" /></div>
</form>

";
		} else {
			if($step == '4') {
				if(!$failed) {
					$licensekey = trim($_REQUEST['licensekey']);
					$dbhost     = trim($_REQUEST['dbhost']);
					$dbusername = trim($_REQUEST['dbusername']);
					$dbpassword = trim($_REQUEST['dbpassword']);
					$dbname     = trim($_REQUEST['dbname']);
					if(!$licensekey) {
						$licensekey = 'Owned-' . substr(md5(time()), 0, 20);
						/*
						echo "You did not enter your license key.  You must go back and correct this.";
						exit();
						*/
					}
					$length      = 64;
					$seeds       = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
					$str         = '';
					$seeds_count = strlen($seeds) - 1;
					for($i = 0; $i < $length; $i++) {
						$str .= $seeds[rand(0, $seeds_count)];
					}
					$output = "<?php
\$license = '" . $licensekey . "';
\$db_host = '" . $dbhost . "';
\$db_username = '" . $dbusername . "';
\$db_password = '" . $dbpassword . "';
\$db_name = '" . $dbname . "';
\$cc_encryption_hash = '" . $str . "';
\$templates_compiledir = 'templates_c/';
\$mysql_charset = 'utf8';
?>";
					$fp     = fopen('../configuration.php', 'w');
					if(fwrite($fp, $output) !== FALSE) {
						fclose($fp);
					} else {
						header("Content-Type: text/x-delimtext; name=\"configuration.php\"");
						header("Content-disposition: attachment; filename=configuration.php");
						echo $output;
					}
					include('../configuration.php');
					$link = mysql_connect($db_host, $db_username, $db_password);
					mysql_select_db($db_name) or exit("Could not connect to the database!<br /><br />Please check the database connection details you provided and ensure the mysql user has access to the given database name<br /><br /><a href=\"#\" onclick=\"history.go(-1)\">&laquo; Go back and try again</a><br /><br /><br />");
					mysql_query("SET NAMES 'utf8'");
					mysql_import_file('install.sql');
					mysql_import_file('emailtemplates.sql');
				} else {
					echo "<div class=\"errorbox\">" . $error . "</div>";
				}
				echo "
<h1>Setup Administrator Account</h1>
<form method=\"post\" action=\"install.php?step=5\" onsubmit=\"showloading()\">
<p>You now need to setup your administrator account.</p>
<table>
<tr><td width=120>First Name:</td><td><input type=\"text\" name=\"firstname\" size=\"30\" value=\"";
				echo $firstname;
				echo "\"></td></tr>
<tr><td>Last Name:</td><td><input type=\"text\" name=\"lastname\" size=\"30\" value=\"";
				echo $lastname;
				echo "\"></td></tr>
<tr><td>Email:</td><td><input type=\"text\" name=\"email\" size=\"50\" value=\"";
				echo $email;
				echo "\"></td></tr>
<tr><td>Username:</td><td><input type=\"text\" name=\"username\" size=\"20\" value=\"";
				echo $username;
				echo "\"></td></tr>
<tr><td>Password:</td><td><input type=\"password\" name=\"password\" size=\"20\" value=\"";
				echo $password;
				echo "\"></td></tr>
<tr><td>Confirm Password:</td><td><input type=\"password\" name=\"confirmpassword\" size=\"20\" value=\"";
				echo $confirmpassword;
				echo "\"></td></tr>
</table>
<p align=\"center\"><input type=\"submit\" value=\"Complete Setup &raquo;\" class=\"button\" id=\"submitbtn\" /></p>
<div class=\"loading\">Setting Up System for First Use... Please Wait...<br /><img src=\"../images/loading.gif\" /></div>
</form>

";
			} else {
				if($step == '5') {
					include('../configuration.php');
					$link = mysql_connect($db_host, $db_username, $db_password);
					mysql_select_db($db_name) or exit('Could not connect to the database - check the database connection details you entered and go back and correct them if necessary');
					mysql_query("SET NAMES 'utf8'");
					$password     = $_REQUEST['password'];
					$tempPassword = md5($password);
					$result       = mysql_query("INSERT INTO `tbladmins` ( `username` , `password`, `firstname` , `lastname` , `email` , `userlevel` , `signature` , `notes` , `supportdepts` ) VALUES ('" . $_REQUEST['username'] . "', '" . $tempPassword . "', '" . $_REQUEST['firstname'] . "', '" . $_REQUEST['lastname'] . "', '" . $_REQUEST['email'] . "', '3', '', 'Welcome to WHMCS!  Please ensure you have setup the cron job in cPanel to automate tasks', ',')");
					echo "<h1>Installation Complete</h1>";
					$whmcsinst->runUpgrades();
					$hasher          = new WHMCS_Security_Hash_Password();
					$passwordHash    = $hasher->hash($password);
					$apiPasswordHash = $hasher->hash(md5($password));
					$result          = mysql_query(sprintf("UPDATE `tbladmins` set `password`='%s', `passwordhash`='%s' where `username`='%s'", $apiPasswordHash, $passwordHash, $_REQUEST['username']));
					echo "
<p>Here's what you should do next:</p>

<p><b>1. Delete the Install Folder</b></p>
<p>You should now delete the <b><i>install</i></b> directory from your web server.</p>

<p><b>2. Secure the Writeable Directories</b></p>
<p>It is advisable to move the attachments, downloads & templates_c directories (which need to be writeable for WHMCS to function) outside of the publically accessible folder tree.  Instructions for how to do this can be found in our documentation @ <a href=\"http://nullrefer.com/?http://docs.whmcs.com/Further_Security_Steps\" target=\"_blank\">Further Security Steps</a></p>

<p><b>3. Setup the Daily Cron Job</b></p>
<p>You should setup a cron job in your control panel to run using the following command once per day:<br>
<div align=\"center\"><input type=\"text\" value=\"php -q ";
					$pos      = strrpos($_SERVER['SCRIPT_FILENAME'], '/');
					$filename = substr($_SERVER['SCRIPT_FILENAME'], 0, $pos);
					$pos      = strrpos($filename, '/');
					$filename = substr($filename, 0, $pos);
					echo $filename;
					echo "/admin/cron.php\" style=\"width:90%;\" readonly=\"true\"></div></p>

<p><b>4. Configure WHMCS</b></p>
<p>Now it's time to configure your WHMCS installation.<br /><br />We have lots of <b>helpful resources & guides</b> available to assist you in setting up & using your new WHMCS system in our comprehensive online documentation located @ <a href=\"http://nullrefer.com/?http://docs.whmcs.com/\" target=\"_blank\">docs.whmcs.com/</a> (you can access the docs at any time by going to Help > Documentation or using the handy Help shortcuts available from most setup pages within the admin area)</p>

<br />

<p align=\"center\" style=\"font-size:16px;\"><a href=\"../admin/\">Click here to go to the admin area now &raquo;</a></p>

<br />

<h2>Thank you for choosing WHMCS!</h2>

";
				} else {
					if($step == 'upgrade') {
						if(empty($_REQUEST['confirmbackup']) || !$_REQUEST['confirmbackup']) {
							echo "<h1>Did you backup?</h1><p>You must confirm you have backed up your database before upgrading. Please go back and try again.";
						} else {
							echo "<h1>Upgrade Complete</h1>";
							$whmcsinst->runUpgrades();
							echo "
<p>You should now delete the install folder from your web server.</p>

<p align=\"center\" style=\"font-size:16px;\"><a href=\"../";
							echo $whmcsinst->getAdminPath();
							echo "/\">Click here to go to the admin area now &raquo;</a></p>

<h2>Thank you for choosing WHMCS!</h2>

";
						}
					}
				}
			}
		}
	}
}
echo "
<br />
<br />
<br />

<div align=\"center\">Copyright &copy; WHMCS 2005-";
echo date('Y');
echo "</div>

</div>

</body>
</html>
";