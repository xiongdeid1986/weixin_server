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
class zipfile
{
    public $datasec = array(  );
    public $ctrl_dir = array(  );
    public $eof_ctrl_dir = "PK\x05\x06\0\0\0\0";
    public $old_offset = 0;
    public function add_dir($name)
    {
        $name = str_replace("\\", '/', $name);
        $fr = "PK\x03\x04";
        $fr .= "\n";
        $fr .= '';
        $fr .= '';
        $fr .= '';
        $fr .= pack('V', 0);
        $fr .= pack('V', 0);
        $fr .= pack('V', 0);
        $fr .= pack('v', strlen($name));
        $fr .= pack('v', 0);
        $fr .= $name;
        $fr .= pack('V', $crc);
        $fr .= pack('V', $c_len);
        $fr .= pack('V', $unc_len);
        $this->datasec[] = $fr;
        $new_offset = strlen(implode('', $this->datasec));
        $cdrec = "PK\x01\x02";
        $cdrec .= '';
        $cdrec .= "\n";
        $cdrec .= '';
        $cdrec .= '';
        $cdrec .= '';
        $cdrec .= pack('V', 0);
        $cdrec .= pack('V', 0);
        $cdrec .= pack('V', 0);
        $cdrec .= pack('v', strlen($name));
        $cdrec .= pack('v', 0);
        $cdrec .= pack('v', 0);
        $cdrec .= pack('v', 0);
        $cdrec .= pack('v', 0);
        $ext = '';
        $ext = "����";
        $cdrec .= pack('V', 16);
        $cdrec .= pack('V', $this->old_offset);
        $this->old_offset = $new_offset;
        $cdrec .= $name;
        $this->ctrl_dir[] = $cdrec;
    }
    public function add_file($data, $name)
    {
        $name = str_replace("\\", '/', $name);
        $fr = "PK\x03\x04";
        $fr .= "\x14";
        $fr .= '';
        $fr .= "\x08";
        $fr .= '';
        $unc_len = strlen($data);
        $crc = crc32($data);
        $zdata = gzcompress($data);
        $zdata = substr(substr($zdata, 0, strlen($zdata) - 4), 2);
        $c_len = strlen($zdata);
        $fr .= pack('V', $crc);
        $fr .= pack('V', $c_len);
        $fr .= pack('V', $unc_len);
        $fr .= pack('v', strlen($name));
        $fr .= pack('v', 0);
        $fr .= $name;
        $fr .= $zdata;
        $fr .= pack('V', $crc);
        $fr .= pack('V', $c_len);
        $fr .= pack('V', $unc_len);
        $this->datasec[] = $fr;
        $new_offset = strlen(implode('', $this->datasec));
        $cdrec = "PK\x01\x02";
        $cdrec .= '';
        $cdrec .= "\x14";
        $cdrec .= '';
        $cdrec .= "\x08";
        $cdrec .= '';
        $cdrec .= pack('V', $crc);
        $cdrec .= pack('V', $c_len);
        $cdrec .= pack('V', $unc_len);
        $cdrec .= pack('v', strlen($name));
        $cdrec .= pack('v', 0);
        $cdrec .= pack('v', 0);
        $cdrec .= pack('v', 0);
        $cdrec .= pack('v', 0);
        $cdrec .= pack('V', 32);
        $cdrec .= pack('V', $this->old_offset);
        $this->old_offset = $new_offset;
        $cdrec .= $name;
        $this->ctrl_dir[] = $cdrec;
    }
    public function file()
    {
        $data = implode('', $this->datasec);
        $ctrldir = implode('', $this->ctrl_dir);
        return $data . $ctrldir . $this->eof_ctrl_dir . pack('v', sizeof($this->ctrl_dir)) . pack('v', sizeof($this->ctrl_dir)) . pack('V', strlen($ctrldir)) . pack('V', strlen($data)) . '';
    }
}
function get_structure($db)
{
    @ini_set('memory_limit', '512M');
    @ini_set('max_execution_time', 0);
    @set_time_limit(0);
    $tables = full_query("SHOW TABLES FROM `" . $db . "`;");
    while( $td = mysql_fetch_array($tables) )
    {
        $table = $td[0];
        if( $table != 'modlivehelp_ip2country' )
        {
            $r = full_query("SHOW CREATE TABLE `" . $table . "`");
            if( $r )
            {
                $insert_sql = '';
                $d = mysql_fetch_array($r);
                $d[1] .= ';';
                $sql[] = str_replace("\r\n", '', $d[1]);
                $table_query = full_query("SELECT * FROM `" . $table . "`");
                $num_fields = mysql_num_fields($table_query);
                while( $fetch_row = mysql_fetch_array($table_query) )
                {
                    $insert_sql .= "INSERT INTO " . $table . " VALUES(";
                    for( $n = 1; $n <= $num_fields; $n++ )
                    {
                        $m = $n - 1;
                        $insert_sql .= "'" . mysql_real_escape_string($fetch_row[$m]) . "', ";
                    }
                    $insert_sql = substr($insert_sql, 0, 0 - 2);
                    $insert_sql .= ");\r\n";
                }
                $sql[] = $insert_sql . "\r\n";
            }
        }
    }
    return implode("\r\n", $sql);
}
function generateBackup()
{
    global $db_name;
    set_time_limit(0);
    $zipfile = new zipfile();
    $zipfile->add_dir('/');
    $zipfile->add_file($structure = get_structure($db_name), $db_name . ".sql");
    return $zipfile->file();
}