<?php
/* Smarty version 3.1.29, created on 2017-12-25 10:32:19
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/includes/pageheader.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a40d3b3ea0f92_10474033',
  'file_dependency' => 
  array (
    '9095eeef790ba298bff23c7ef7b971693993a168' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/includes/pageheader.tpl',
      1 => 1512474174,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a40d3b3ea0f92_10474033 ($_smarty_tpl) {
?>
<section class="header-nav">
	<?php if ($_smarty_tpl->tpl_vars['formaction']->value == 'dologin.php' || $_smarty_tpl->tpl_vars['filename']->value == 'logout' || $_smarty_tpl->tpl_vars['filename']->value == 'pwreset') {?>class="login"<?php } elseif ($_smarty_tpl->tpl_vars['templatefile']->value == 'homepage' || $_smarty_tpl->tpl_vars['templatefile']->value == 'vps' || $_smarty_tpl->tpl_vars['templatefile']->value == 'pricing' || $_smarty_tpl->tpl_vars['templatefile']->value == 'features' || $_smarty_tpl->tpl_vars['filename']->value == 'contact' || $_smarty_tpl->tpl_vars['filename']->value == 'cart') {?>
	<div class="container">
	<?php }?>
	<div class="pull-left">
		<?php if ($_smarty_tpl->tpl_vars['showbreadcrumb']->value) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
	</div>
	<div class="pull-right hidden-xs hidden-sm" style="padding-top: 17px;">
		<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>
			<form role="form" method="post" action="clientarea.php?action=kbsearch">
			    <div class="home-kb-search">
			        <input type="text" name="search" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientHomeSearchKb'];?>
" />
			        <i class="fa fa-search"></i>
			    </div>
			</form>
	        <!-- Language -->
	        <?php if ($_smarty_tpl->tpl_vars['languagechangeenabled']->value && count($_smarty_tpl->tpl_vars['locales']->value) > 1) {?>
	            <a href="#" class="btn btn-success" data-toggle="popover" id="languageChooser"><i class="fa fa-language"></i></a>
	            <div id="languageChooserContent" class="hidden">
	                <ul>
	                    <?php
$_from = $_smarty_tpl->tpl_vars['locales']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_locale_0_saved_item = isset($_smarty_tpl->tpl_vars['locale']) ? $_smarty_tpl->tpl_vars['locale'] : false;
$_smarty_tpl->tpl_vars['locale'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['locale']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['locale']->value) {
$_smarty_tpl->tpl_vars['locale']->_loop = true;
$__foreach_locale_0_saved_local_item = $_smarty_tpl->tpl_vars['locale'];
?>
	                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['currentpagelinkback']->value;?>
language=<?php echo $_smarty_tpl->tpl_vars['locale']->value['language'];?>
"><?php echo $_smarty_tpl->tpl_vars['locale']->value['localisedName'];?>
</a></li>
	                    <?php
$_smarty_tpl->tpl_vars['locale'] = $__foreach_locale_0_saved_local_item;
}
if ($__foreach_locale_0_saved_item) {
$_smarty_tpl->tpl_vars['locale'] = $__foreach_locale_0_saved_item;
}
?>
	                </ul>
	            </div>
	        <?php }?>
        <?php }?>
        
		<a href="./cart.php?a=view" class="btn btn-primary"><i class="fa fa-shopping-cart"></i><span id="cartItemCount" class="badge badge-danger"><?php echo $_smarty_tpl->tpl_vars['cartitemcount']->value;?>
</span></a>
	</div>
	<?php if ($_smarty_tpl->tpl_vars['formaction']->value == 'dologin.php' || $_smarty_tpl->tpl_vars['filename']->value == 'logout' || $_smarty_tpl->tpl_vars['filename']->value == 'pwreset') {?>class="login"<?php } elseif ($_smarty_tpl->tpl_vars['templatefile']->value == 'homepage' || $_smarty_tpl->tpl_vars['templatefile']->value == 'vps' || $_smarty_tpl->tpl_vars['templatefile']->value == 'pricing' || $_smarty_tpl->tpl_vars['templatefile']->value == 'features' || $_smarty_tpl->tpl_vars['filename']->value == 'contact' || $_smarty_tpl->tpl_vars['filename']->value == 'cart') {?>
	</div>
	<?php }?>
</section><?php }
}
