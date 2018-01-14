<?php
/* Smarty version 3.1.29, created on 2017-12-05 14:55:14
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/nrghost/includes/captcha.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a26b352ee4cc3_20367293',
  'file_dependency' => 
  array (
    'c0e62a4266564750d2abce0c6082330a3d40a730' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/nrghost/includes/captcha.tpl',
      1 => 1512482592,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a26b352ee4cc3_20367293 ($_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['captcha']->value) {?>
    <?php if ($_smarty_tpl->tpl_vars['filename']->value == 'domainchecker' || $_smarty_tpl->tpl_vars['filename']->value == 'index') {?>
        <div class="row">
            <?php if ($_smarty_tpl->tpl_vars['filename']->value == 'index') {?>
                <div class="domainchecker-homepage-captcha">
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['captcha']->value == "recaptcha") {?>
                <?php echo '<script'; ?>
 src="https://www.google.com/recaptcha/api.js" async defer><?php echo '</script'; ?>
>
                <div id="google-recaptcha-domainchecker" class="g-recaptcha center-block" data-sitekey="<?php echo $_smarty_tpl->tpl_vars['reCaptchaPublicKey']->value;?>
"></div>
            <?php } else { ?>
                <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
                    <div id="default-captcha-domainchecker" class="<?php if ($_smarty_tpl->tpl_vars['filename']->value == 'domainchecker') {?>input-group input-group-box <?php }?>text-center">
                        <p><?php echo WHMCS\Smarty::langFunction(array('key'=>"captchaverify"),$_smarty_tpl);?>
</p>

                        <div class="col-xs-6 captchaimage">
                            <img id="inputCaptchaImage" src="includes/verifyimage.php" align="middle" />
                        </div>

                        <div class="col-xs-6">
                            <input id="inputCaptcha" type="text" name="code" maxlength="5" class="form-control" />
                        </div>
                    </div>
                </div>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['filename']->value == 'index') {?>
                </div>
            <?php }?>
        </div>
    <?php } else { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo WHMCS\Smarty::langFunction(array('key'=>"captchatitle"),$_smarty_tpl);?>
</h3>
            </div>
            <div class="panel-body">
                <p><?php echo WHMCS\Smarty::langFunction(array('key'=>"captchaverify"),$_smarty_tpl);?>
</p>
                <?php if ($_smarty_tpl->tpl_vars['captcha']->value == "recaptcha") {?>
                    <?php echo $_smarty_tpl->tpl_vars['recaptchahtml']->value;?>

                <?php } else { ?>
                    <div class="text-center">
                        <div class="col-md-5 col-sm-5 col-xs-5 captchaimage">
                            <img src="includes/verifyimage.php" align="middle" />
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-5">
                            <input id="inputCaptcha" type="text" name="code" maxlength="5" class="form-control" />
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    <?php }
}
}
}
