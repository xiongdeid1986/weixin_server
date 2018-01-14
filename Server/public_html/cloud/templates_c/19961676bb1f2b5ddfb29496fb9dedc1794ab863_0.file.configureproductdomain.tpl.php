<?php
/* Smarty version 3.1.29, created on 2017-12-28 15:33:21
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/orderforms/NeWorld/configureproductdomain.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a450ec1c14496_04969844',
  'file_dependency' => 
  array (
    '19961676bb1f2b5ddfb29496fb9dedc1794ab863' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/orderforms/NeWorld/configureproductdomain.tpl',
      1 => 1512474175,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:orderforms/".((string)$_smarty_tpl->tpl_vars[\'carttpl\']->value)."/common.tpl' => 1,
    'file:orderforms/standard_cart/sidebar-categories-collapsed.tpl' => 1,
  ),
),false)) {
function content_5a450ec1c14496_04969844 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:orderforms/".((string)$_smarty_tpl->tpl_vars['carttpl']->value)."/common.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

	
<section class="order-home space2x">
	<div class="container">
				
		<div id="order-standard_cart">
		
		    <div class="row">
		
		        <div class="col-md-12">
		
		            <div class="header-lined">
		                <h1><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domaincheckerchoosedomain'];?>
</h1>
		            </div>
		
		        </div>
		
		        <div class="col-md-12">
		
		            <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:orderforms/standard_cart/sidebar-categories-collapsed.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		
		            <form id="frmProductDomain" onsubmit="checkdomain();return false">
		
		                <div class="domain-selection-options">
		                    <?php if ($_smarty_tpl->tpl_vars['incartdomains']->value) {?>
		                        <div class="option">
		                            <label>
		                                <input type="radio" name="domainoption" value="incart" id="selincart" /><?php echo $_smarty_tpl->tpl_vars['LANG']->value['cartproductdomainuseincart'];?>

		                            </label>
		                            <div class="domain-input-group clearfix" id="domainincart">
		                                <div class="row">
		                                    <div class="col-sm-8 col-sm-offset-1 col-md-6 col-md-offset-2">
		                                        <div class="domains-row">
		                                            <select id="incartsld" name="incartdomain" class="form-control">
		                                                <?php
$_from = $_smarty_tpl->tpl_vars['incartdomains']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_incartdomain_0_saved_item = isset($_smarty_tpl->tpl_vars['incartdomain']) ? $_smarty_tpl->tpl_vars['incartdomain'] : false;
$__foreach_incartdomain_0_saved_key = isset($_smarty_tpl->tpl_vars['num']) ? $_smarty_tpl->tpl_vars['num'] : false;
$_smarty_tpl->tpl_vars['incartdomain'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['num'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['incartdomain']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['incartdomain']->value) {
$_smarty_tpl->tpl_vars['incartdomain']->_loop = true;
$__foreach_incartdomain_0_saved_local_item = $_smarty_tpl->tpl_vars['incartdomain'];
?>
		                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['incartdomain']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['incartdomain']->value;?>
</option>
		                                                <?php
$_smarty_tpl->tpl_vars['incartdomain'] = $__foreach_incartdomain_0_saved_local_item;
}
if ($__foreach_incartdomain_0_saved_item) {
$_smarty_tpl->tpl_vars['incartdomain'] = $__foreach_incartdomain_0_saved_item;
}
if ($__foreach_incartdomain_0_saved_key) {
$_smarty_tpl->tpl_vars['num'] = $__foreach_incartdomain_0_saved_key;
}
?>
		                                            </select>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-2">
		                                        <button type="submit" class="btn btn-primary btn-block">
		                                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['use'];?>

		                                        </button>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    <?php }?>
		                    <?php if ($_smarty_tpl->tpl_vars['registerdomainenabled']->value) {?>
		                        <div class="option">
		                            <label>
		                                <input type="radio" name="domainoption" value="register" id="selregister" /><?php echo WHMCS\Smarty::sprintf2Modifier($_smarty_tpl->tpl_vars['LANG']->value['cartregisterdomainchoice'],$_smarty_tpl->tpl_vars['companyname']->value);?>

		                            </label>
		                            <div class="domain-input-group clearfix" id="domainregister">
		                                <div class="row">
		                                    <div class="col-sm-8 col-sm-offset-1">
		                                        <div class="row domains-row">
		                                            <div class="col-xs-9">
		                                                <div class="input-group">
		                                                    <span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['www'];?>
</span>
		                                                    <input type="text" id="registersld" value="<?php echo $_smarty_tpl->tpl_vars['sld']->value;?>
" class="form-control" autocapitalize="none" />
		                                                </div>
		                                            </div>
		                                            <div class="col-xs-3">
		                                                <select id="registertld" class="form-control">
		                                                    <?php
$_from = $_smarty_tpl->tpl_vars['registertlds']->value;
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
"<?php if ($_smarty_tpl->tpl_vars['listtld']->value == $_smarty_tpl->tpl_vars['tld']->value) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['listtld']->value;?>
</option>
		                                                    <?php
$_smarty_tpl->tpl_vars['listtld'] = $__foreach_listtld_1_saved_local_item;
}
if ($__foreach_listtld_1_saved_item) {
$_smarty_tpl->tpl_vars['listtld'] = $__foreach_listtld_1_saved_item;
}
?>
		                                                </select>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-2">
		                                        <button type="submit" class="btn btn-primary btn-block">
		                                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['check'];?>

		                                        </button>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    <?php }?>
		                    <?php if ($_smarty_tpl->tpl_vars['transferdomainenabled']->value) {?>
		                        <div class="option">
		                            <label>
		                                <input type="radio" name="domainoption" value="transfer" id="seltransfer" /><?php echo WHMCS\Smarty::sprintf2Modifier($_smarty_tpl->tpl_vars['LANG']->value['carttransferdomainchoice'],$_smarty_tpl->tpl_vars['companyname']->value);?>

		                            </label>
		                            <div class="domain-input-group clearfix" id="domaintransfer">
		                                <div class="row">
		                                    <div class="col-sm-8 col-sm-offset-1">
		                                        <div class="row domains-row">
		                                            <div class="col-xs-9">
		                                                <div class="input-group">
		                                                    <span class="input-group-addon">www.</span>
		                                                    <input type="text" id="transfersld" value="<?php echo $_smarty_tpl->tpl_vars['sld']->value;?>
" class="form-control" autocapitalize="none" />
		                                                </div>
		                                            </div>
		                                            <div class="col-xs-3">
		                                                <select id="transfertld" class="form-control">
		                                                    <?php
$_from = $_smarty_tpl->tpl_vars['transfertlds']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_listtld_2_saved_item = isset($_smarty_tpl->tpl_vars['listtld']) ? $_smarty_tpl->tpl_vars['listtld'] : false;
$_smarty_tpl->tpl_vars['listtld'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['listtld']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['listtld']->value) {
$_smarty_tpl->tpl_vars['listtld']->_loop = true;
$__foreach_listtld_2_saved_local_item = $_smarty_tpl->tpl_vars['listtld'];
?>
		                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['listtld']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['listtld']->value == $_smarty_tpl->tpl_vars['tld']->value) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['listtld']->value;?>
</option>
		                                                    <?php
$_smarty_tpl->tpl_vars['listtld'] = $__foreach_listtld_2_saved_local_item;
}
if ($__foreach_listtld_2_saved_item) {
$_smarty_tpl->tpl_vars['listtld'] = $__foreach_listtld_2_saved_item;
}
?>
		                                                </select>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-2">
		                                        <button type="submit" class="btn btn-primary btn-block">
		                                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['transfer'];?>

		                                        </button>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    <?php }?>
		                    <?php if ($_smarty_tpl->tpl_vars['owndomainenabled']->value) {?>
		                        <div class="option">
		                            <label>
		                                <input type="radio" name="domainoption" value="owndomain" id="selowndomain" /><?php echo WHMCS\Smarty::sprintf2Modifier($_smarty_tpl->tpl_vars['LANG']->value['cartexistingdomainchoice'],$_smarty_tpl->tpl_vars['companyname']->value);?>

		                            </label>
		                            <div class="domain-input-group clearfix" id="domainowndomain">
		                                <div class="row">
		                                    <div class="col-sm-9">
		                                        <div class="row domains-row">
		                                            <div class="col-xs-2 text-right">
		                                                <p class="form-control-static">www.</p>
		                                            </div>
		                                            <div class="col-xs-7">
		                                                <input type="text" id="owndomainsld" value="<?php echo $_smarty_tpl->tpl_vars['sld']->value;?>
" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['yourdomainplaceholder'];?>
" class="form-control" autocapitalize="none" />
		                                            </div>
		                                            <div class="col-xs-3">
		                                                <input type="text" id="owndomaintld" value="<?php echo substr($_smarty_tpl->tpl_vars['tld']->value,1);?>
" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['yourtldplaceholder'];?>
" class="form-control" autocapitalize="none" />
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-2">
		                                        <button type="submit" class="btn btn-primary btn-block" id="useOwnDomain">
		                                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['use'];?>

		                                        </button>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    <?php }?>
		                    <?php if ($_smarty_tpl->tpl_vars['subdomains']->value) {?>
		                        <div class="option">
		                            <label>
		                                <input type="radio" name="domainoption" value="subdomain" id="selsubdomain" /><?php echo WHMCS\Smarty::sprintf2Modifier($_smarty_tpl->tpl_vars['LANG']->value['cartsubdomainchoice'],$_smarty_tpl->tpl_vars['companyname']->value);?>

		                            </label>
		                            <div class="domain-input-group clearfix" id="domainsubdomain">
		                                <div class="row">
		                                    <div class="col-sm-9">
		                                        <div class="row domains-row">
		                                            <div class="col-xs-2 text-right">
		                                                <p class="form-control-static">http://</p>
		                                            </div>
		                                            <div class="col-xs-5">
		                                                <input type="text" id="subdomainsld" value="<?php echo $_smarty_tpl->tpl_vars['sld']->value;?>
" placeholder="yourname" class="form-control" autocapitalize="none" />
		                                            </div>
		                                            <div class="col-xs-5">
		                                                <select id="subdomaintld" class="form-control">
		                                                    <?php
$_from = $_smarty_tpl->tpl_vars['subdomains']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_subdomain_3_saved_item = isset($_smarty_tpl->tpl_vars['subdomain']) ? $_smarty_tpl->tpl_vars['subdomain'] : false;
$__foreach_subdomain_3_saved_key = isset($_smarty_tpl->tpl_vars['subid']) ? $_smarty_tpl->tpl_vars['subid'] : false;
$_smarty_tpl->tpl_vars['subdomain'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['subid'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['subdomain']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['subid']->value => $_smarty_tpl->tpl_vars['subdomain']->value) {
$_smarty_tpl->tpl_vars['subdomain']->_loop = true;
$__foreach_subdomain_3_saved_local_item = $_smarty_tpl->tpl_vars['subdomain'];
?>
		                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['subid']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['subdomain']->value;?>
</option>
		                                                    <?php
$_smarty_tpl->tpl_vars['subdomain'] = $__foreach_subdomain_3_saved_local_item;
}
if ($__foreach_subdomain_3_saved_item) {
$_smarty_tpl->tpl_vars['subdomain'] = $__foreach_subdomain_3_saved_item;
}
if ($__foreach_subdomain_3_saved_key) {
$_smarty_tpl->tpl_vars['subid'] = $__foreach_subdomain_3_saved_key;
}
?>
		                                                </select>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-2">
		                                        <button type="submit" class="btn btn-primary btn-block">
		                                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['check'];?>

		                                        </button>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    <?php }?>
		                </div>
		
		                <?php if ($_smarty_tpl->tpl_vars['freedomaintlds']->value) {?>
		                    <p>* <em><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderfreedomainregistration'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderfreedomainappliesto'];?>
: <?php echo $_smarty_tpl->tpl_vars['freedomaintlds']->value;?>
</em></p>
		                <?php }?>
		
		            </form>
		
		            <div class="clearfix"></div>
		
		            <div class="domain-loading-spinner" id="domainLoadingSpinner">
		                <i class="fa fa-3x fa-spinner fa-spin"></i>
		            </div>
		
		            <form method="post" action="cart.php?a=add&pid=<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
&domainselect=1" id="frmProductDomainSelections">
		                <div class="domain-search-results" id="domainSearchResults"></div>
		            </form>
		
		        </div>
		    </div>
		</div>
	</div>
</section>
<?php }
}
