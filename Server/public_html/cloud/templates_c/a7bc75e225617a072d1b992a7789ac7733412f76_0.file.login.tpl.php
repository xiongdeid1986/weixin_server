<?php
/* Smarty version 3.1.29, created on 2017-12-25 10:32:38
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/login.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a40d3c6199895_45050193',
  'file_dependency' => 
  array (
    'a7bc75e225617a072d1b992a7789ac7733412f76' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/login.tpl',
      1 => 1512474173,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a40d3c6199895_45050193 ($_smarty_tpl) {
?>
<section class="loginform">
	<div class="row">
		<div class="logincontainer col-sm-12">
			
			<a class="navbar-brand" href="./index.php" title="<?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
</a>
			
			<div class="login-content">
			
			    <form method="post" action="./dologin.php" role="form">
				    
					<?php if ($_smarty_tpl->tpl_vars['incorrect']->value) {?>
				        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['loginincorrect'],'textcenter'=>true), 0, true);
?>

				    <?php } elseif ($_smarty_tpl->tpl_vars['verificationId']->value && empty($_smarty_tpl->tpl_vars['transientDataName']->value)) {?>
				        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['verificationKeyExpired'],'textcenter'=>true), 0, true);
?>

				    <?php } elseif ($_smarty_tpl->tpl_vars['ssoredirect']->value) {?>
				        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['sso']['redirectafterlogin'],'textcenter'=>true), 0, true);
?>

				    <?php }?>
			    
			        <div class="form-group form-group-top">
			            <label for="inputEmail"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaemail'];?>
</label>
			            <input type="email" name="username" class="form-control" id="inputEmail" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['enteremail'];?>
" autofocus>
			        </div>
			
			        <div class="form-group">
			            <label for="inputPassword"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapassword'];?>
</label>
			            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapassword'];?>
" autocomplete="off" >
			        </div>
			
			        <div class="form-group">
			            <label>
			                <input type="checkbox" name="rememberme" /> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginrememberme'];?>

			            </label>
			        </div>
			
			        <div class="form-group">
			            <input id="login" type="submit" class="btn btn-success btn-block" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginbutton'];?>
" />
			        </div>
			        
			        <div class="foot text-center">
				    	<a href="pwreset.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['forgotpw'];?>
</a>
			        </div>
			    </form>
			</div>
		    <div class="nav">
				<p class="back"><a href="javascript:;" onClick="javascript :history.go(-1);"><i class="fa fa-angle-double-left" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['goback'];?>
</a></p>
				<p class="register"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['noaccount'];?>
 <a href="register.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['register'];?>
</a></p>
		    </div>
		
		</div>
<?php }
}
