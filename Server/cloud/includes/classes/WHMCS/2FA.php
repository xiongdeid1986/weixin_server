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
/**
 * Two Factor Authentication Class
 *
 * @package    WHMCS
 * @author     WHMCS Limited <development@whmcs.com>
 * @copyright  Copyright (c) WHMCS Limited 2005-2014
 * @license    http://www.whmcs.com/license/ WHMCS Eula
 * @version    $Id$
 * @link       http://www.whmcs.com/
 */
class WHMCS_2FA
{
    protected $settings = array(  );
    protected $clientmodules = array(  );
    protected $adminmodules = array(  );
    protected $adminmodule = '';
    protected $adminsettings = array(  );
    protected $admininfo = array(  );
    protected $clientmodule = '';
    protected $clientsettings = array(  );
    protected $clientinfo = array(  );
    protected $adminid = '';
    protected $clientid = '';
    public function __construct()
    {
        $this->loadSettings();
    }
    protected function loadSettings()
    {
		
        global $whmcs;
		/*此代码用于解决thinkphp调用时, global $whcms被清除的问题,因此如果为空,则重新取值.*/
		if(empty($whmcs))$whmcs = WHMCS_Application::getinstance();
		$get_Config = $whmcs->get_config('2fasettings');
        $this->settings = unserialize($get_Config);
        if( !isset($this->settings['modules']) )
        {
            return false;
        }
        foreach( $this->settings['modules'] as $module => $data )
        {
            if( !empty($data['clientenabled']) )
            {
                $this->clientmodules[] = $module;
            }
            if( !empty($data['adminenabled']) )
            {
                $this->adminmodules[] = $module;
            }
        }
        return true;
    }
    public function isForced()
    {
        if( $this->clientid )
        {
            return $this->isForcedClients();
        }
        if( $this->adminid )
        {
            return $this->isForcedAdmins();
        }
        return false;
    }
    protected function isForcedClients()
    {
        return $this->settings['forceclient'];
    }
    protected function isForcedAdmins()
    {
        return $this->settings['forceadmin'];
    }
    public function isActiveClients()
    {
        return count($this->clientmodules) ? true : false;
    }
    public function isActiveAdmins()
    {
        return count($this->adminmodules) ? true : false;
    }
    public function setClientID($id)
    {
        $this->clientid = $id;
        $this->adminid = '';
        return $this->loadClientSettings();
    }
    public function setAdminID($id)
    {
        $this->clientid = '';
        $this->adminid = $id;
        return $this->loadAdminSettings();
    }
    protected function loadClientSettings()
    {
        $data = get_query_vals('tblclients', 'id,firstname,lastname,email,authmodule,authdata', array( 'id' => $this->clientid, 'status' => array( 'sqltype' => 'NEQ', 'value' => 'Closed' ) ));
        if( !$data['id'] )
        {
            return false;
        }
        $this->clientmodule = $data['authmodule'];
        $this->clientsettings = unserialize($data['authdata']);
        if( !is_array($this->clientsettings) )
        {
            $this->clientsettings = array(  );
        }
        unset($data['authmodule']);
        unset($data['authdata']);
        $data['username'] = $data['email'];
        $this->clientinfo = $data;
        return true;
    }
    protected function loadAdminSettings()
    {
        $data = get_query_vals('tbladmins', 'id,username,firstname,lastname,email,authmodule,authdata', array( 'id' => $this->adminid, 'disabled' => '0' ));
        if( !$data['id'] )
        {
            return false;
        }
        $this->adminmodule = $data['authmodule'];
        $this->adminsettings = unserialize($data['authdata']);
        if( !is_array($this->adminsettings) )
        {
            $this->adminsettings = array(  );
        }
        unset($data['authmodule']);
        unset($data['authdata']);
        $this->admininfo = $data;
        return true;
    }
    public function getAvailableModules()
    {
        if( $this->clientid )
        {
            return $this->getAvailableClientModules();
        }
        if( $this->adminid )
        {
            return $this->getAvailableAdminModules();
        }
        return false;
    }
    protected function getAvailableClientModules()
    {
        return $this->clientmodules;
    }
    protected function getAvailableAdminModules()
    {
        return $this->adminmodules;
    }
    public function isEnabled()
    {
        if( $this->clientid )
        {
            return $this->isEnabledClient();
        }
        if( $this->adminid )
        {
            return $this->isEnabledAdmin();
        }
        return false;
    }
    protected function isEnabledClient()
    {
        return $this->clientmodule ? true : false;
    }
    protected function isEnabledAdmin()
    {
        return $this->adminmodule ? true : false;
    }
    protected function getModule()
    {
        if( $this->clientid )
        {
            return $this->clientmodule;
        }
        if( $this->adminid )
        {
            return $this->adminmodule;
        }
        return false;
    }
    public function moduleCall($function, $module = '')
    {
        $mod = new WHMCS_Module('security');
        $module = $module ? $module : $this->getModule();
        $loaded = $mod->load($module);
        if( !$loaded )
        {
            return false;
        }
        $params = $this->buildParams($module);
        $result = $mod->call($function, $params);
        return $result;
    }
    protected function buildParams($module)
    {
        $params = array(  );
        $params['settings'] = $this->settings['modules'][$module];
        $params['user_info'] = $this->clientid ? $this->clientinfo : $this->admininfo;
        $params['user_settings'] = $this->clientid ? $this->clientsettings : $this->adminsettings;
        $params['post_vars'] = $_POST;
        return $params;
    }
    public function activateUser($module, $settings = array(  ))
    {
        global $whmcs;
        if( $this->clientid )
        {
            $backupCode = sha1($whmcs->get_hash() . $this->clientid . time());
            $backupCode = substr($backupCode, 0, 16);
            $settings['backupcode'] = sha1($backupCode);
            update_query('tblclients', array( 'authmodule' => $module, 'authdata' => serialize($settings) ), array( 'id' => $this->clientid ));
            return substr($backupCode, 0, 4) . " " . substr($backupCode, 4, 4) . " " . substr($backupCode, 8, 4) . " " . substr($backupCode, 12, 4);
        }
        if( $this->adminid )
        {
            $backupCode = sha1($whmcs->get_hash() . $this->adminid . time());
            $backupCode = substr($backupCode, 0, 16);
            $settings['backupcode'] = sha1($backupCode);
            update_query('tbladmins', array( 'authmodule' => $module, 'authdata' => serialize($settings) ), array( 'id' => $this->adminid ));
            return substr($backupCode, 0, 4) . " " . substr($backupCode, 4, 4) . " " . substr($backupCode, 8, 4) . " " . substr($backupCode, 12, 4);
        }
        return false;
    }
    public function disableUser()
    {
        if( $this->clientid )
        {
            update_query('tblclients', array( 'authmodule' => '', 'authdata' => '' ), array( 'id' => $this->clientid ));
            return true;
        }
        if( $this->adminid )
        {
            update_query('tbladmins', array( 'authmodule' => '', 'authdata' => '' ), array( 'id' => $this->adminid ));
            return true;
        }
        return false;
    }
    public function saveUserSettings($arr)
    {
        if( !is_array($arr) )
        {
            return false;
        }
        if( $this->clientid )
        {
            $this->clientsettings = array_merge($this->clientsettings, $arr);
            update_query('tblclients', array( 'authdata' => serialize($this->clientsettings) ), array( 'id' => $this->clientid ));
            return true;
        }
        if( $this->adminid )
        {
            $this->adminsettings = array_merge($this->adminsettings, $arr);
            update_query('tbladmins', array( 'authdata' => serialize($this->adminsettings) ), array( 'id' => $this->adminid ));
            return true;
        }
        return false;
    }
    public function getUserSetting($var)
    {
        if( $this->clientid )
        {
            return isset($this->clientsettings[$var]) ? $this->clientsettings[$var] : '';
        }
        if( $this->adminid )
        {
            return isset($this->adminsettings[$var]) ? $this->adminsettings[$var] : '';
        }
        return false;
    }
    public function verifyBackupCode($code)
    {
        $backupCode = $this->getUserSetting('backupcode');
        if( !$backupCode )
        {
            return false;
        }
        $code = preg_replace("/[^a-z0-9]/", '', strtolower($code));
        $code = sha1($code);
        return $backupCode == $code;
    }
    public function generateNewBackupCode()
    {
        global $whmcs;
        $uid = $this->clientid ? $this->clientid : $this->adminid;
        $backupCode = sha1($whmcs->get_hash() . $uid . time());
        $backupCode = substr($backupCode, 0, 16);
        $this->saveUserSettings(array( 'backupcode' => sha1($backupCode) ));
        return substr($backupCode, 0, 4) . " " . substr($backupCode, 4, 4) . " " . substr($backupCode, 8, 4) . " " . substr($backupCode, 12, 4);
    }
}