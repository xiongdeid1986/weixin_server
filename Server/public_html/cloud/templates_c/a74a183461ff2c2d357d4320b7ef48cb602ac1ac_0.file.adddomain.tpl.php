<?php
/* Smarty version 3.1.29, created on 2017-12-05 14:49:42
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/orderforms/NeWorld/adddomain.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a26b2068e7292_04033863',
  'file_dependency' => 
  array (
    'a74a183461ff2c2d357d4320b7ef48cb602ac1ac' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/orderforms/NeWorld/adddomain.tpl',
      1 => 1512474175,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:orderforms/".((string)$_smarty_tpl->tpl_vars[\'carttpl\']->value)."/common.tpl' => 1,
    'file:orderforms/".((string)$_smarty_tpl->tpl_vars[\'carttpl\']->value)."/sidebar-categories-collapsed.tpl' => 1,
  ),
),false)) {
function content_5a26b2068e7292_04033863 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:orderforms/".((string)$_smarty_tpl->tpl_vars['carttpl']->value)."/common.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

	
<section class="order-home space2x">
	<div class="container">
		
		<div id="order-standard_cart">
		
		    <div class="row">
		
		        <div class="12">
		
		            <div class="header-lined">
		                <h1>
		                    <?php if ($_smarty_tpl->tpl_vars['domain']->value == "register") {?>
		                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['registerdomain'];?>

		                    <?php } elseif ($_smarty_tpl->tpl_vars['domain']->value == "transfer") {?>
		                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['transferdomain'];?>

		                    <?php }?>
		                </h1>
		            </div>
		
		        </div>
		
		        <div class="col-md-12">
		
		            <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:orderforms/".((string)$_smarty_tpl->tpl_vars['carttpl']->value)."/sidebar-categories-collapsed.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

		
		            <?php if ($_smarty_tpl->tpl_vars['domain']->value == 'register') {?>
		                <p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['findNewDomain'];?>
</p>
		            <?php } else { ?>
		                <p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['transferExistingDomain'];?>
</p>
		            <?php }?>
		
		            <form method="post" action="cart.php" id="frmDomainSearch">
		                <input type="hidden" name="a" value="domainoptions" />
		                <input type="hidden" name="checktype" value="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
" />
		                <input type="hidden" name="ajax" value="1" />
		
		                <div class="row domain-add-domain">
		                    <div class="col-sm-8 col-xs-12 col-sm-offset-1">
		                        <div class="row domains-row">
		                            <div class="col-xs-9">
		                                <div class="input-group">
		                                    <span class="input-group-addon"><?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.www'),$_smarty_tpl);?>
</span>
		                                    <input type="text" name="sld" value="<?php echo $_smarty_tpl->tpl_vars['sld']->value;?>
" id="inputDomain" class="form-control" autocapitalize="none" />
		                                </div>
		                            </div>
		                            <div class="col-xs-3">
		                                <select name="tld" class="form-control">
		                                    <?php if ($_smarty_tpl->tpl_vars['domain']->value == 'register') {?>
		                                        <?php
$_from = $_smarty_tpl->tpl_vars['registertlds']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_listtld_0_saved_item = isset($_smarty_tpl->tpl_vars['listtld']) ? $_smarty_tpl->tpl_vars['listtld'] : false;
$_smarty_tpl->tpl_vars['listtld'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['listtld']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['listtld']->value) {
$_smarty_tpl->tpl_vars['listtld']->_loop = true;
$__foreach_listtld_0_saved_local_item = $_smarty_tpl->tpl_vars['listtld'];
?>
		                                            <option value="<?php echo $_smarty_tpl->tpl_vars['listtld']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['listtld']->value == $_smarty_tpl->tpl_vars['tld']->value) {?> selected="selected"<?php }?>>
		                                                <?php echo $_smarty_tpl->tpl_vars['listtld']->value;?>

		                                            </option>
		                                        <?php
$_smarty_tpl->tpl_vars['listtld'] = $__foreach_listtld_0_saved_local_item;
}
if ($__foreach_listtld_0_saved_item) {
$_smarty_tpl->tpl_vars['listtld'] = $__foreach_listtld_0_saved_item;
}
?>
		                                    <?php } else { ?>
		                                        <?php
$_from = $_smarty_tpl->tpl_vars['transfertlds']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_listtld_1_saved_item = isset($_smarty_tpl->tpl_vars['listtld']) ? $_smarty_tpl->tpl_vars['listtld'] : false;
$_smarty_tpl->tpl_vars['listtld'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['listtld']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['listtld']->value) {
$_smarty_tpl->tpl_vars['listtld']->_loop = true;
$__foreach_listtld_1_saved_local_item = $_smarty_tpl->tpl_vars['listtld'];
?>
		                                            <option value="<?php echo $_smarty_tpl->tpl_vars['listtld']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['listtld']->value == $_smarty_tpl->tpl_vars['tld']->value) {?> selected="selected"<?php }?>>
		                                                <?php echo $_smarty_tpl->tpl_vars['listtld']->value;?>

		                                            </option>
		                                        <?php
$_smarty_tpl->tpl_vars['listtld'] = $__foreach_listtld_1_saved_local_item;
}
if ($__foreach_listtld_1_saved_item) {
$_smarty_tpl->tpl_vars['listtld'] = $__foreach_listtld_1_saved_item;
}
?>
		                                    <?php }?>
		                                </select>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="col-sm-2 col-xs-12">
		                        <button type="submit" class="btn btn-primary btn-block" id="btnCheckAvailability">
		                            <?php if ($_smarty_tpl->tpl_vars['domain']->value == "register") {?>
		                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['check'];?>

		                            <?php } else { ?>
		                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainstransfer'];?>

		                            <?php }?>
		                        </button>
		                    </div>
		                </div>
		
		            </form>
		
		            <div class="domain-loading-spinner" id="domainLoadingSpinner">
		                <i class="fa fa-3x fa-spinner fa-spin"></i>
		            </div>
		
		            <form method="post" action="cart.php?a=add&domain=<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
">
		                <div class="domain-search-results" id="domainSearchResults"></div>
		            </form>
		
		        </div>
		    </div>
		</div>
	</div>
</section>


<?php if ($_smarty_tpl->tpl_vars['availabilityresults']->value) {?>
    <?php echo '<script'; ?>
>
        jQuery(document).ready(function() {
            jQuery('#btnCheckAvailability').click();
        });
    <?php echo '</script'; ?>
>
<?php }
}
}
