<?php /* Smarty version 2.6.28, created on 2017-12-25 21:20:55
         compiled from D:%5Cwww_root%5Ccloud.ddweb.com.cn/templates/webhoster/logout.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['template'])."/pageheader.tpl", 'smarty_include_vars' => array('title' => $this->_tpl_vars['LANG']['logouttitle'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="alert alert-success">
        <p><?php echo $this->_tpl_vars['LANG']['logoutsuccessful']; ?>
</p>
</div>

 <p><a href="login.php" class="btn btn-xs btn-inverse"><?php echo $this->_tpl_vars['LANG']['logoutcontinuetext']; ?>
</a></p>