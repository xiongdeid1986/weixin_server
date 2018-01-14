<?php
/* Smarty version 3.1.29, created on 2017-12-05 11:43:05
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/NeWorld/NeWorld-footer.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a268649b1e8e9_29678037',
  'file_dependency' => 
  array (
    'b2dd0890033cc87f640eebe5746c37d9167c216c' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/NeWorld/NeWorld-footer.tpl',
      1 => 1512474175,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a268649b1e8e9_29678037 ($_smarty_tpl) {
?>

<?php if ($_smarty_tpl->tpl_vars['templatefile']->value == 'homepage' || $_smarty_tpl->tpl_vars['filename']->value == 'contact' && !$_smarty_tpl->tpl_vars['loggedin']->value || $_smarty_tpl->tpl_vars['templatefile']->value == 'vps' || $_smarty_tpl->tpl_vars['templatefile']->value == 'pricing' || $_smarty_tpl->tpl_vars['templatefile']->value == 'features' || $_smarty_tpl->tpl_vars['filename']->value == "cart") {?>
	<footer class="space2x">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-3">
					<a class="navbar-brand" href="#"><?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
</a>
					<p>&copy; <?php echo $_smarty_tpl->tpl_vars['date_year']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
. <?php echo $_smarty_tpl->tpl_vars['LANG']->value['allrightsreserved'];?>
</p>
				</div>
				<div class="col-xs-4 col-sm-2">
					<h4 class="title-head"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['footabout'];?>
</h4>
					<ul class="list-unstyled">
						<li><a href="#">Company</a></li>
						<li><a href="#">Blog</a></li>
						<li><a href="#">Affileates</a></li>
						<li><a href="#">Press</a></li>
						<li><a href="#">Terms</a></li>
					</ul>
				</div>
				<div class="col-xs-4 col-sm-2">
					<h4 class="title-head"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['footproduct'];?>
</h4>
					<ul class="list-unstyled">
						<li><a href="#">Features</a></li>
						<li><a href="#">How it Works</a></li>
						<li><a href="#">Pricing</a></li>
						<li><a href="#">Learn</a></li>
						<li><a href="#">Privavy</a></li>
					</ul>
				</div>
				<div class="col-xs-4 col-sm-2">
					<h4 class="title-head"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['footsupport'];?>
</h4>
					<ul class="list-unstyled">
						<li><a href="#">Documintation</a></li>
						<li><a href="#">Delevopers API</a></li>
						<li><a href="#">Learn</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="#">Status</a></li>
					</ul>
				</div>
				<div class="col-sm-2 hidden-xs hidden-sm">
					<h4 class="title-head"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['footconnect'];?>
</h4>
					<ul class="list-unstyled">
						<li><a href="#">Facebook</a></li>
						<li><a href="#">Twitter</a></li>
					</ul>
				</div>
				<div class="col-sm-2 hidden-xs hidden-sm">
					<?php if ($_smarty_tpl->tpl_vars['languagechangeenabled']->value && count($_smarty_tpl->tpl_vars['locales']->value) > 1) {?>
			            <a href="javascript:;" id="languageChooser" class="language" data-toggle="popover"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['chooselanguage'];?>
 <span class="caret"></span></a>
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
				</div>
			</div>
		</div>
	</footer>
<?php }
}
}
