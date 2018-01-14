<?php
/* Smarty version 3.1.29, created on 2017-12-05 14:55:10
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/nrghost/login.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a26b34eea6323_23338476',
  'file_dependency' => 
  array (
    'b3c9ce4f439c093470ee78a863a3794550daed10' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/nrghost/login.tpl',
      1 => 1512482591,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a26b34eea6323_23338476 ($_smarty_tpl) {
?>
<section>
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 margin-top margin-bottom">
                <div class="login-halfwidthcontaine halfwidthcontainer">

<?php if ($_smarty_tpl->tpl_vars['incorrect']->value) {?>

<div class="alert alert-warning" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
       <p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginincorrect'];?>
</p>
</div>

<?php }?>

<div class="form-block login-form-block ">
      <img class="img-circle form-icon" src="templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/nrghosts/img/icon-118.png" alt="">
      <div class="form-wrapper">
        <div class="block-header">
            <h2 class="title">Login Form</h2>
        </div>
        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['systemsslurl']->value;?>
dologin.php" class="form-stacked">
        <div class="logincontainer">
            <fieldset class="control-group">

                <div class="control-group field-entry">
                    <label class="control-label" for="username"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginemail'];?>
:</label>
                    <div class="controls">
                        <input class="input-xlarge" name="username" id="username" type="text" />
                    </div>
                </div>
                <div class="control-group field-entry">
                    <label class="control-label" for="password"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginpassword'];?>
:</label>
                    <div class="controls">
                        <input class="input-xlarge" name="password" id="password" type="password"/>
                    </div>
                </div>


                  <div class="rememberme checkbox-entry checkbox"><input type="checkbox" name="rememberme"<?php if ($_smarty_tpl->tpl_vars['rememberme']->value) {?> checked="checked"<?php }?> /> <label><?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginrememberme'];?>
</label></div>

                  <a class="simple-link" href="pwreset.php"><span class="glyphicon glyphicon-chevron-right"></span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginforgotteninstructions'];?>
</a>

                <div class="button">
                    <div class="loginbtn">Login<input id="login" type="submit" class="" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginbutton'];?>
" /></div>
                </div>
            </fieldset>
        </div>
      </form>
      </div>
 </div>
<?php echo '<script'; ?>
 type="text/javascript">
$("#username").focus();
<?php echo '</script'; ?>
>

</div>          </div>
        </div>
    </div>
</section>
<?php }
}
