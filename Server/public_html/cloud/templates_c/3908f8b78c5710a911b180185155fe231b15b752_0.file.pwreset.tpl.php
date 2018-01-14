<?php
/* Smarty version 3.1.29, created on 2017-12-28 15:26:38
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/pwreset.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a450d2e30e3b7_20710468',
  'file_dependency' => 
  array (
    '3908f8b78c5710a911b180185155fe231b15b752' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/pwreset.tpl',
      1 => 1512474174,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a450d2e30e3b7_20710468 ($_smarty_tpl) {
?>
<section class="loginform">
	<div class="row">
		<div class="logincontainer">
			<a class="navbar-brand" href="./index.php" title="<?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
</a>
			<div class="login-content">
	
			    <?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>
			        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['noPasswordResetWhenLoggedIn'],'textcenter'=>true), 0, true);
?>

			    <?php } else { ?>
			        <?php if ($_smarty_tpl->tpl_vars['success']->value) {?>
			
			            <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['pwresetvalidationsent'],'textcenter'=>true), 0, true);
?>

						<div class="form-group" style="padding-bottom: 30px;">
			            	<p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwresetvalidationcheckemail'];?>
</p>
						</div>
			
			        <?php } else { ?>
			
			            <?php if ($_smarty_tpl->tpl_vars['errormessage']->value) {?>
			                <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['errormessage']->value,'textcenter'=>true), 0, true);
?>

			            <?php }?>
			
			            <?php if ($_smarty_tpl->tpl_vars['securityquestion']->value) {?>
			
			                <div class="form-group">
				                <p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwresetsecurityquestionrequired'];?>
</p>
			                </div>
			
			                <form method="post" action="pwreset.php"  class="form-stacked">
			                    <input type="hidden" name="action" value="reset" />
			                    <input type="hidden" name="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" />
			
			                    <div class="form-group">
			                        <label for="inputAnswer"><?php echo $_smarty_tpl->tpl_vars['securityquestion']->value;?>
</label>
			                        <input type="text" name="answer" class="form-control" id="inputAnswer" autofocus>
			                    </div>
			
			                    <div class="form-group" style="padding-bottom: 30px;">
			                        <button type="submit" class="btn btn-success btn-block"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwresetsubmit'];?>
</button>
			                    </div>
			
			                </form>
			
			            <?php } else { ?>
			
			                <form method="post" action="./pwreset.php" role="form">
			                    <input type="hidden" name="action" value="reset" />
								
			                    <div class="alert alert-warning">
									<p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwresetemailneeded'];?>
</p>
			                    </div>
			
			                    <div class="form-group">
			                        <label for="inputEmail"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginemail'];?>
</label>
			                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['enteremail'];?>
" autofocus>
			                    </div>
			
			                    <div class="form-group" style="padding-bottom: 30px;">
			                        <button type="submit" class="btn btn-success btn-block"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwresetsubmit'];?>
</button>
			                    </div>
			
			                </form>
			
			            <?php }?>
			
			        <?php }?>
			    <?php }?>
			</div>
		    <div class="nav">
				<p class="back"><a href="#" onClick="javascript :history.go(-1);"><i class="fa fa-angle-double-left" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['goback'];?>
</a></p>
		    </div>
		</div>
<?php }
}
