<?php
/* Smarty version 3.1.29, created on 2017-12-05 09:52:33
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/six/login.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a266c61d10289_39318029',
  'file_dependency' => 
  array (
    '6864548073fd677e2525c684d7c1b96890744944' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/six/login.tpl',
      1 => 1510648882,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a266c61d10289_39318029 ($_smarty_tpl) {
?>
<div class="logincontainer<?php if ($_smarty_tpl->tpl_vars['linkableProviders']->value) {?> with-social<?php }?>">

    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/pageheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>$_smarty_tpl->tpl_vars['LANG']->value['login'],'desc'=>((string)$_smarty_tpl->tpl_vars['LANG']->value['restrictedpage'])), 0, true);
?>


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

    <div class="providerLinkingFeedback"></div>

    <div class="row">
        <div class="col-sm-<?php if ($_smarty_tpl->tpl_vars['linkableProviders']->value) {?>7<?php } else { ?>12<?php }?>">

            <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['systemurl']->value;?>
dologin.php" class="login-form" role="form">
                <div class="form-group">
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

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="rememberme" /> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginrememberme'];?>

                    </label>
                </div>

                <div align="center">
                    <input id="login" type="submit" class="btn btn-primary" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginbutton'];?>
" /> <a href="pwreset.php" class="btn btn-default"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['forgotpw'];?>
</a>
                </div>
            </form>

        </div>
        <div class="col-sm-5<?php if (!$_smarty_tpl->tpl_vars['linkableProviders']->value) {?> hidden<?php }?>">
            <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/linkedaccounts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('linkContext'=>"login",'customFeedback'=>true), 0, true);
?>

        </div>
    </div>
</div>
<?php }
}
