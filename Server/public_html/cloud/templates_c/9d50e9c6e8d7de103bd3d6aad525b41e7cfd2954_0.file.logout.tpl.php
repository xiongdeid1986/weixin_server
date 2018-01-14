<?php
/* Smarty version 3.1.29, created on 2017-12-25 10:32:34
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/logout.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a40d3c2225af5_03382162',
  'file_dependency' => 
  array (
    '9d50e9c6e8d7de103bd3d6aad525b41e7cfd2954' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/logout.tpl',
      1 => 1512474173,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a40d3c2225af5_03382162 ($_smarty_tpl) {
?>
<section class="loginform">
	<div class="row">
		<div class="logincontainer col-sm-12">
			
			<a class="navbar-brand" href="./index.php" title="<?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
</a>
			
			<div class="login-content">

			    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['logoutsuccessful'],'textcenter'=>true), 0, true);
?>

			
			    <div class="foot text-center">
			        <a href="index.php" class="btn btn-default"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['logoutcontinuetext'];?>
</a>
			    </div>
			</div>
		</div>
	</div>
</div>
<?php }
}
