<?php
/* Smarty version 3.1.29, created on 2017-12-05 09:52:32
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/six/includes/pageheader.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a266c60ea2f32_43684832',
  'file_dependency' => 
  array (
    'c975c1ba5f1740296d5b142ae644b560ddcc0395' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/six/includes/pageheader.tpl',
      1 => 1510648882,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a266c60ea2f32_43684832 ($_smarty_tpl) {
?>
<div class="header-lined">
    <h1><?php echo $_smarty_tpl->tpl_vars['title']->value;
if ($_smarty_tpl->tpl_vars['desc']->value) {?> <small><?php echo $_smarty_tpl->tpl_vars['desc']->value;?>
</small><?php }?></h1>
    <?php if ($_smarty_tpl->tpl_vars['showbreadcrumb']->value) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
</div>
<?php }
}
