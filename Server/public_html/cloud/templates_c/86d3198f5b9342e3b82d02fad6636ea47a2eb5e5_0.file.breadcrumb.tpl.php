<?php
/* Smarty version 3.1.29, created on 2017-12-04 13:04:01
  from "/home/admin/web/cloud.ddweb.com.cn/public_html/templates/six/includes/breadcrumb.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a2547c125d968_77057649',
  'file_dependency' => 
  array (
    '86d3198f5b9342e3b82d02fad6636ea47a2eb5e5' => 
    array (
      0 => '/home/admin/web/cloud.ddweb.com.cn/public_html/templates/six/includes/breadcrumb.tpl',
      1 => 1510648882,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a2547c125d968_77057649 ($_smarty_tpl) {
?>
<ol class="breadcrumb">
    <?php
$_from = $_smarty_tpl->tpl_vars['breadcrumb']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_0_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$__foreach_item_0_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$__foreach_item_0_iteration=0;
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$__foreach_item_0_iteration++;
$_smarty_tpl->tpl_vars['item']->last = $__foreach_item_0_iteration == $__foreach_item_0_total;
$__foreach_item_0_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
        <li<?php if ($_smarty_tpl->tpl_vars['item']->last) {?> class="active"<?php }?>>
            <?php if (!$_smarty_tpl->tpl_vars['item']->last) {?><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
"><?php }?>
            <?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>

            <?php if (!$_smarty_tpl->tpl_vars['item']->last) {?></a><?php }?>
        </li>
    <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
?>
</ol>
<?php }
}
