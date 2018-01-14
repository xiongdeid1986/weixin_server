<?php
/* Smarty version 3.1.29, created on 2017-12-25 10:21:48
  from "mailMessage:plaintext" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a40d13ca0b945_40972581',
  'file_dependency' => 
  array (
    'dac51ccee8dbecedf9afb805fb153d5c6bf41d7a' => 
    array (
      0 => 'mailMessage:plaintext',
      1 => 1514197308,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a40d13ca0b945_40972581 ($_smarty_tpl) {
$template = $_smarty_tpl;
?>Dear <?php echo $_smarty_tpl->tpl_vars['client_name']->value;?>
,

As you requested, your password for our client area has now been reset.  Your new login details are as follows:

<?php echo $_smarty_tpl->tpl_vars['whmcs_link']->value;?>

Email: <?php echo $_smarty_tpl->tpl_vars['client_email']->value;?>

Password: <?php echo $_smarty_tpl->tpl_vars['client_password']->value;?>


To change your password to something more memorable, after logging in go to My Details > Change Password.

<?php echo $_smarty_tpl->tpl_vars['signature']->value;
}
}
