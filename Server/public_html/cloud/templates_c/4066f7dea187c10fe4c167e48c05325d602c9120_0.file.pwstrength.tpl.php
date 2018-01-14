<?php
/* Smarty version 3.1.29, created on 2017-12-25 10:32:46
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/includes/pwstrength.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a40d3ce26b590_52228115',
  'file_dependency' => 
  array (
    '4066f7dea187c10fe4c167e48c05325d602c9120' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/includes/pwstrength.tpl',
      1 => 1512474174,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:six/includes/alert.tpl' => 1,
  ),
),false)) {
function content_5a40d3ce26b590_52228115 ($_smarty_tpl) {
?>
<br />

<div class="progress" id="passwordStrengthBar">
    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
        <span class="sr-only">New Password Rating: 0%</span>
    </div>
</div>

<?php if (file_exists("templates/".((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl")) {?>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>((string)$_smarty_tpl->tpl_vars['LANG']->value['passwordtips'])), 0, true);
?>

<?php } elseif (file_exists("templates/six/includes/alert.tpl")) {?>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:six/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>((string)$_smarty_tpl->tpl_vars['LANG']->value['passwordtips'])), 0, false);
?>

<?php }?>

<?php echo '<script'; ?>
 type="text/javascript">
jQuery("#inputNewPassword1").keyup(function() {
    var $newPassword1 = jQuery("#newPassword1");
    var pw = jQuery("#inputNewPassword1").val();
    var pwlength=(pw.length);
    if(pwlength>5)pwlength=5;
    else if(pwlength>4)pwlength=4.5;
    else if(pwlength>2)pwlength=3.5;
    else if(pwlength>0)pwlength=2.5;
    var numnumeric=pw.replace(/[0-9]/g,"");
    var numeric=(pw.length-numnumeric.length);
    if(numeric>3)numeric=3;
    var symbols=pw.replace(/\W/g,"");
    var numsymbols=(pw.length-symbols.length);
    if(numsymbols>3)numsymbols=3;
    var numupper=pw.replace(/[A-Z]/g,"");
    var upper=(pw.length-numupper.length);
    if(upper>3)upper=3;
    var pwstrength=((pwlength*10)-20)+(numeric*10)+(numsymbols*15)+(upper*10);
    if (pwstrength < 0) pwstrength = 0;
    if (pwstrength > 100) pwstrength = 100;

    $newPassword1.removeClass('has-error has-warning has-success');
    jQuery("#inputNewPassword1").next('.form-control-feedback').removeClass('glyphicon-remove glyphicon-warning-sign glyphicon-ok');
    jQuery("#passwordStrengthBar .progress-bar").removeClass("progress-bar-danger progress-bar-warning progress-bar-success").css("width", pwstrength + "%").attr('aria-valuenow', pwstrength);
    jQuery("#passwordStrengthBar .progress-bar .sr-only").html('New Password Rating: ' + pwstrength + '%');
    if (pwstrength < 30) {
        $newPassword1.addClass('has-error');
        jQuery("#inputNewPassword1").next('.form-control-feedback').addClass('glyphicon-remove');
        jQuery("#passwordStrengthBar .progress-bar").addClass("progress-bar-danger");
    } else if (pwstrength < 75) {
        $newPassword1.addClass('has-warning');
        jQuery("#inputNewPassword1").next('.form-control-feedback').addClass('glyphicon-warning-sign');
        jQuery("#passwordStrengthBar .progress-bar").addClass("progress-bar-warning");
    } else {
        $newPassword1.addClass('has-success');
        jQuery("#inputNewPassword1").next('.form-control-feedback').addClass('glyphicon-ok');
        jQuery("#passwordStrengthBar .progress-bar").addClass("progress-bar-success");
    }
    validatePassword2();
});

function validatePassword2() {
    var password1 = jQuery("#inputNewPassword1").val();
    var password2 = jQuery("#inputNewPassword2").val();
    var $newPassword2 = jQuery("#newPassword2");

    if (password2 && password1 !== password2) {
        $newPassword2.removeClass('has-success')
            .addClass('has-error');
        jQuery("#inputNewPassword2").next('.form-control-feedback').removeClass('glyphicon-ok').addClass('glyphicon-remove');
        jQuery("#inputNewPassword2Msg").html('<p class="help-block"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['pwdoesnotmatch'], ENT_QUOTES, 'UTF-8', true);?>
</p>');
        <?php if (!isset($_smarty_tpl->tpl_vars['noDisable']->value)) {?>jQuery('input[type="submit"]').attr('disabled', 'disabled');<?php }?>
    } else {
        if (password2) {
            $newPassword2.removeClass('has-error')
                .addClass('has-success');
            jQuery("#inputNewPassword2").next('.form-control-feedback').removeClass('glyphicon-remove').addClass('glyphicon-ok');
            <?php if (!isset($_smarty_tpl->tpl_vars['noDisable']->value)) {?>jQuery('.form-group input[type="submit"]').removeAttr('disabled');<?php }?>
        } else {
            $newPassword2.removeClass('has-error has-success');
            jQuery("#inputNewPassword2").next('.form-control-feedback').removeClass('glyphicon-remove glyphicon-ok');
        }
        jQuery("#inputNewPassword2Msg").html('');
    }
}

jQuery(document).ready(function(){
    <?php if (!isset($_smarty_tpl->tpl_vars['noDisable']->value)) {?>jQuery('.using-password-strength input[type="submit"]').attr('disabled', 'disabled');<?php }?>
    jQuery("#inputNewPassword2").keyup(function() {
        validatePassword2();
    });
});

<?php echo '</script'; ?>
>
<?php }
}
