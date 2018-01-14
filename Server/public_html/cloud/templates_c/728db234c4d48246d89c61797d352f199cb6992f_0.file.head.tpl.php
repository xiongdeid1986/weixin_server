<?php
/* Smarty version 3.1.29, created on 2017-12-05 11:43:05
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/includes/head.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a268649aa9169_81682688',
  'file_dependency' => 
  array (
    '728db234c4d48246d89c61797d352f199cb6992f' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/includes/head.tpl',
      1 => 1512474174,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a268649aa9169_81682688 ($_smarty_tpl) {
?>
<!-- Bootstrap -->
<link href="./templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/css/bootstrap.min.css" rel="stylesheet">

<!-- Styling -->
<link href="./templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/css/bootstrap-select.min.css" rel="stylesheet">
<link href="./templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/css/overrides.css" rel="stylesheet">
<link href="./templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/css/styles.css" rel="stylesheet">

<!-- jQuery -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/jquery.min.js"><?php echo '</script'; ?>
>

<!-- Custom Styling -->
<link rel="stylesheet" href="./templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/css/custom.css?v0.3.0">
<link rel="stylesheet" href="./templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/css/color.css?v0.3.0">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
<![endif]-->

<?php if (!empty($_smarty_tpl->tpl_vars['loadMarkdownEditor']->value)) {?>
    <!-- Markdown Editor -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_CSS']->value;?>
/bootstrap-markdown.min.css" rel="stylesheet" />
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/bootstrap-markdown.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/markdown.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/to-markdown.js"><?php echo '</script'; ?>
>
    <?php if (!empty($_smarty_tpl->tpl_vars['mdeLocale']->value)) {?>
        <?php echo $_smarty_tpl->tpl_vars['mdeLocale']->value;?>

    <?php }
}?>

<?php if ($_smarty_tpl->tpl_vars['templatefile']->value == "viewticket" && !$_smarty_tpl->tpl_vars['loggedin']->value) {?>
  <meta name="robots" content="noindex" />
<?php }
}
}
