<?php
/* Smarty version 3.1.29, created on 2017-12-28 15:26:40
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/orderforms/NeWorld/viewcart.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a450d30ec0604_51361844',
  'file_dependency' => 
  array (
    '859009f7c992737b99e73d565146043e116ffaa7' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/orderforms/NeWorld/viewcart.tpl',
      1 => 1512474175,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:orderforms/".((string)$_smarty_tpl->tpl_vars[\'carttpl\']->value)."/checkout.tpl' => 1,
    'file:orderforms/".((string)$_smarty_tpl->tpl_vars[\'carttpl\']->value)."/common.tpl' => 1,
    'file:orderforms/".((string)$_smarty_tpl->tpl_vars[\'carttpl\']->value)."/order-top.tpl' => 1,
  ),
),false)) {
function content_5a450d30ec0604_51361844 ($_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['checkout']->value) {?>

    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:orderforms/".((string)$_smarty_tpl->tpl_vars['carttpl']->value)."/checkout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>


<?php } else { ?>

    <?php echo '<script'; ?>
>
        // Define state tab index value
        var statesTab = 10;
        var stateNotRequired = true;
    <?php echo '</script'; ?>
>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:orderforms/".((string)$_smarty_tpl->tpl_vars['carttpl']->value)."/common.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/StatesDropdown.js"><?php echo '</script'; ?>
>
    
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:orderforms/".((string)$_smarty_tpl->tpl_vars['carttpl']->value)."/order-top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>


	<section class="order-home space2x">
		<div class="container">

		    <div id="order-standard_cart">
		
		        <div class="row">
		            <div class="col-md-8">
			            <div class="header-lined">
					        <h1><?php echo $_smarty_tpl->tpl_vars['LANG']->value['cartreviewcheckout'];?>
</h1>
					    </div>
		
		                <?php if ($_smarty_tpl->tpl_vars['promoerrormessage']->value) {?>
		                    <div class="alert alert-warning text-center" role="alert">
		                        <?php echo $_smarty_tpl->tpl_vars['promoerrormessage']->value;?>

		                    </div>
		                <?php } elseif ($_smarty_tpl->tpl_vars['errormessage']->value) {?>
		                    <div class="alert alert-danger" role="alert">
		                        <p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['correctErrors'];?>
:</p>
		                        <ul>
		                            <?php echo $_smarty_tpl->tpl_vars['errormessage']->value;?>

		                        </ul>
		                    </div>
		                <?php } elseif ($_smarty_tpl->tpl_vars['promotioncode']->value && $_smarty_tpl->tpl_vars['rawdiscount']->value == "0.00") {?>
		                    <div class="alert alert-info text-center" role="alert">
		                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['promoappliedbutnodiscount'];?>

		                    </div>
		                <?php } elseif ($_smarty_tpl->tpl_vars['promoaddedsuccess']->value) {?>
		                    <div class="alert alert-success text-center" role="alert">
		                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['promotionAccepted'];?>

		                    </div>
		                <?php }?>
		
		                <?php if ($_smarty_tpl->tpl_vars['bundlewarnings']->value) {?>
		                    <div class="alert alert-warning" role="alert">
		                        <strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['bundlereqsnotmet'];?>
</strong><br />
		                        <ul>
		                            <?php
$_from = $_smarty_tpl->tpl_vars['bundlewarnings']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_warning_0_saved_item = isset($_smarty_tpl->tpl_vars['warning']) ? $_smarty_tpl->tpl_vars['warning'] : false;
$_smarty_tpl->tpl_vars['warning'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['warning']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['warning']->value) {
$_smarty_tpl->tpl_vars['warning']->_loop = true;
$__foreach_warning_0_saved_local_item = $_smarty_tpl->tpl_vars['warning'];
?>
		                                <li><?php echo $_smarty_tpl->tpl_vars['warning']->value;?>
</li>
		                            <?php
$_smarty_tpl->tpl_vars['warning'] = $__foreach_warning_0_saved_local_item;
}
if ($__foreach_warning_0_saved_item) {
$_smarty_tpl->tpl_vars['warning'] = $__foreach_warning_0_saved_item;
}
?>
		                        </ul>
		                    </div>
		                <?php }?>
		
		                <form method="post" action="cart.php?a=view">
							<div class="check-main" style="margin-bottom: 20px;">
			                    <div class="view-cart-items-header">
			                        <div class="row">
			                            <div class="<?php if ($_smarty_tpl->tpl_vars['showqtyoptions']->value) {?>col-sm-5<?php } else { ?>col-sm-7<?php }?> col-xs-7">
			                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['productOptions'];?>

			                            </div>
			                            <?php if ($_smarty_tpl->tpl_vars['showqtyoptions']->value) {?>
			                                <div class="col-sm-2 hidden-xs text-center">
			                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['qty'];?>

			                                </div>
			                            <?php }?>
			                            <div class="col-sm-4 col-xs-5 text-right">
			                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['priceCycle'];?>

			                            </div>
			                        </div>
			                    </div>
			                    <div class="view-cart-items">
			
			                        <?php
$_from = $_smarty_tpl->tpl_vars['products']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_product_1_saved_item = isset($_smarty_tpl->tpl_vars['product']) ? $_smarty_tpl->tpl_vars['product'] : false;
$__foreach_product_1_saved_key = isset($_smarty_tpl->tpl_vars['num']) ? $_smarty_tpl->tpl_vars['num'] : false;
$_smarty_tpl->tpl_vars['product'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['num'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['product']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
$__foreach_product_1_saved_local_item = $_smarty_tpl->tpl_vars['product'];
?>
			                            <div class="item">
			                                <div class="row">
			                                    <div class="<?php if ($_smarty_tpl->tpl_vars['showqtyoptions']->value) {?>col-sm-5<?php } else { ?>col-sm-7<?php }?>">
			                                        <span class="item-title">
			                                            <?php echo $_smarty_tpl->tpl_vars['product']->value['productinfo']['name'];?>

			                                            <a href="<?php echo $_SERVER['PHP_SELF'];?>
?a=confproduct&i=<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
" class="btn btn-link btn-xs">
			                                                <i class="fa fa-pencil"></i>
			                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['edit'];?>

			                                            </a>
			                                            <span class="visible-xs-inline">
			                                                <button type="button" class="btn btn-link btn-xs btn-remove-from-cart" onclick="removeItem('p','<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
')">
			                                                    <i class="fa fa-times"></i>
			                                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['remove'];?>

			                                                </button>
			                                            </span>
			                                        </span>
			                                        <span class="item-group">
			                                            <?php echo $_smarty_tpl->tpl_vars['product']->value['productinfo']['groupname'];?>

			                                        </span>
			                                        <?php if ($_smarty_tpl->tpl_vars['product']->value['domain']) {?>
			                                            <span class="item-domain">
			                                                <?php echo $_smarty_tpl->tpl_vars['product']->value['domain'];?>

			                                            </span>
			                                        <?php }?>
			                                        <?php if ($_smarty_tpl->tpl_vars['product']->value['configoptions']) {?>
			                                            <small>
			                                            <?php
$_from = $_smarty_tpl->tpl_vars['product']->value['configoptions'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_configoption_2_saved_item = isset($_smarty_tpl->tpl_vars['configoption']) ? $_smarty_tpl->tpl_vars['configoption'] : false;
$__foreach_configoption_2_saved_key = isset($_smarty_tpl->tpl_vars['confnum']) ? $_smarty_tpl->tpl_vars['confnum'] : false;
$_smarty_tpl->tpl_vars['configoption'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['confnum'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['configoption']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['confnum']->value => $_smarty_tpl->tpl_vars['configoption']->value) {
$_smarty_tpl->tpl_vars['configoption']->_loop = true;
$__foreach_configoption_2_saved_local_item = $_smarty_tpl->tpl_vars['configoption'];
?>
			                                                &nbsp;&raquo; <?php echo $_smarty_tpl->tpl_vars['configoption']->value['name'];?>
: <?php if ($_smarty_tpl->tpl_vars['configoption']->value['type'] == 1 || $_smarty_tpl->tpl_vars['configoption']->value['type'] == 2) {
echo $_smarty_tpl->tpl_vars['configoption']->value['option'];
} elseif ($_smarty_tpl->tpl_vars['configoption']->value['type'] == 3) {
if ($_smarty_tpl->tpl_vars['configoption']->value['qty']) {
echo $_smarty_tpl->tpl_vars['configoption']->value['option'];
} else {
echo $_smarty_tpl->tpl_vars['LANG']->value['no'];
}
} elseif ($_smarty_tpl->tpl_vars['configoption']->value['type'] == 4) {
echo $_smarty_tpl->tpl_vars['configoption']->value['qty'];?>
 x <?php echo $_smarty_tpl->tpl_vars['configoption']->value['option'];
}?><br />
			                                            <?php
$_smarty_tpl->tpl_vars['configoption'] = $__foreach_configoption_2_saved_local_item;
}
if ($__foreach_configoption_2_saved_item) {
$_smarty_tpl->tpl_vars['configoption'] = $__foreach_configoption_2_saved_item;
}
if ($__foreach_configoption_2_saved_key) {
$_smarty_tpl->tpl_vars['confnum'] = $__foreach_configoption_2_saved_key;
}
?>
			                                            </small>
			                                        <?php }?>
			                                    </div>
			                                    <?php if ($_smarty_tpl->tpl_vars['showqtyoptions']->value) {?>
			                                        <div class="col-sm-2 item-qty">
			                                            <?php if ($_smarty_tpl->tpl_vars['product']->value['allowqty']) {?>
			                                                <input type="number" name="qty[<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['qty'];?>
" class="form-control text-center" />
			                                                <button type="submit" class="btn btn-xs">
			                                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['update'];?>

			                                                </button>
			                                            <?php }?>
			                                        </div>
			                                    <?php }?>
			                                    <div class="col-sm-4 item-price">
			                                        <span><?php echo $_smarty_tpl->tpl_vars['product']->value['pricing']['totalTodayExcludingTaxSetup'];?>
</span>
			                                        <span class="cycle"><?php echo $_smarty_tpl->tpl_vars['product']->value['billingcyclefriendly'];?>
</span>
			                                        <?php if ($_smarty_tpl->tpl_vars['product']->value['pricing']['productonlysetup']) {?>
			                                            <?php echo $_smarty_tpl->tpl_vars['product']->value['pricing']['productonlysetup'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordersetupfee'];?>

			                                        <?php }?>
			                                        <?php if ($_smarty_tpl->tpl_vars['product']->value['proratadate']) {?><br />(<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderprorata'];?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value['proratadate'];?>
)<?php }?>
			                                    </div>
			                                    <div class="col-sm-1 hidden-xs">
			                                        <button type="button" class="btn btn-link btn-xs btn-remove-from-cart" onclick="removeItem('p','<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
')">
			                                            <i class="fa fa-times"></i>
			                                        </button>
			                                    </div>
			                                </div>
			                            </div>
			                            <?php
$_from = $_smarty_tpl->tpl_vars['product']->value['addons'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_addon_3_saved_item = isset($_smarty_tpl->tpl_vars['addon']) ? $_smarty_tpl->tpl_vars['addon'] : false;
$__foreach_addon_3_saved_key = isset($_smarty_tpl->tpl_vars['addonnum']) ? $_smarty_tpl->tpl_vars['addonnum'] : false;
$_smarty_tpl->tpl_vars['addon'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['addonnum'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['addon']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['addonnum']->value => $_smarty_tpl->tpl_vars['addon']->value) {
$_smarty_tpl->tpl_vars['addon']->_loop = true;
$__foreach_addon_3_saved_local_item = $_smarty_tpl->tpl_vars['addon'];
?>
			                                <div class="item">
			                                    <div class="row">
			                                        <div class="col-sm-7">
			                                            <span class="item-title">
			                                                <?php echo $_smarty_tpl->tpl_vars['addon']->value['name'];?>

			                                            </span>
			                                            <span class="item-group">
			                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderaddon'];?>

			                                            </span>
			                                            <?php if ($_smarty_tpl->tpl_vars['addon']->value['setup']) {?>
			                                                <span class="item-setup">
			                                                    <?php echo $_smarty_tpl->tpl_vars['addon']->value['setup'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordersetupfee'];?>

			                                                </span>
			                                            <?php }?>
			                                        </div>
			                                        <div class="col-sm-4 item-price">
			                                            <span><?php echo $_smarty_tpl->tpl_vars['addon']->value['totaltoday'];?>
</span>
			                                            <span class="cycle"><?php echo $_smarty_tpl->tpl_vars['addon']->value['billingcyclefriendly'];?>
</span>
			                                        </div>
			                                    </div>
			                                </div>
			                            <?php
$_smarty_tpl->tpl_vars['addon'] = $__foreach_addon_3_saved_local_item;
}
if ($__foreach_addon_3_saved_item) {
$_smarty_tpl->tpl_vars['addon'] = $__foreach_addon_3_saved_item;
}
if ($__foreach_addon_3_saved_key) {
$_smarty_tpl->tpl_vars['addonnum'] = $__foreach_addon_3_saved_key;
}
?>
			                        <?php
$_smarty_tpl->tpl_vars['product'] = $__foreach_product_1_saved_local_item;
}
if ($__foreach_product_1_saved_item) {
$_smarty_tpl->tpl_vars['product'] = $__foreach_product_1_saved_item;
}
if ($__foreach_product_1_saved_key) {
$_smarty_tpl->tpl_vars['num'] = $__foreach_product_1_saved_key;
}
?>
			
			                        <?php
$_from = $_smarty_tpl->tpl_vars['addons']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_addon_4_saved_item = isset($_smarty_tpl->tpl_vars['addon']) ? $_smarty_tpl->tpl_vars['addon'] : false;
$__foreach_addon_4_saved_key = isset($_smarty_tpl->tpl_vars['num']) ? $_smarty_tpl->tpl_vars['num'] : false;
$_smarty_tpl->tpl_vars['addon'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['num'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['addon']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['addon']->value) {
$_smarty_tpl->tpl_vars['addon']->_loop = true;
$__foreach_addon_4_saved_local_item = $_smarty_tpl->tpl_vars['addon'];
?>
			                            <div class="item">
			                                <div class="row">
			                                    <div class="col-sm-7">
			                                        <span class="item-title">
			                                            <?php echo $_smarty_tpl->tpl_vars['addon']->value['name'];?>

			                                            <span class="visible-xs-inline">
			                                                <button type="button" class="btn btn-link btn-xs btn-remove-from-cart" onclick="removeItem('a','<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
')">
			                                                    <i class="fa fa-times"></i>
			                                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['remove'];?>

			                                                </button>
			                                            </span>
			                                        </span>
			                                        <span class="item-group">
			                                            <?php echo $_smarty_tpl->tpl_vars['addon']->value['productname'];?>

			                                        </span>
			                                        <?php if ($_smarty_tpl->tpl_vars['addon']->value['domainname']) {?>
			                                            <span class="item-domain">
			                                                <?php echo $_smarty_tpl->tpl_vars['addon']->value['domainname'];?>

			                                            </span>
			                                        <?php }?>
			                                        <?php if ($_smarty_tpl->tpl_vars['addon']->value['setup']) {?>
			                                            <span class="item-setup">
			                                                <?php echo $_smarty_tpl->tpl_vars['addon']->value['setup'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordersetupfee'];?>

			                                            </span>
			                                        <?php }?>
			                                    </div>
			                                    <div class="col-sm-4 item-price">
			                                        <span><?php echo $_smarty_tpl->tpl_vars['addon']->value['pricingtext'];?>
</span>
			                                        <span class="cycle"><?php echo $_smarty_tpl->tpl_vars['addon']->value['billingcyclefriendly'];?>
</span>
			                                    </div>
			                                    <div class="col-sm-1 hidden-xs">
			                                        <button type="button" class="btn btn-link btn-xs btn-remove-from-cart" onclick="removeItem('a','<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
')">
			                                            <i class="fa fa-times"></i>
			                                        </button>
			                                    </div>
			                                </div>
			                            </div>
			                        <?php
$_smarty_tpl->tpl_vars['addon'] = $__foreach_addon_4_saved_local_item;
}
if ($__foreach_addon_4_saved_item) {
$_smarty_tpl->tpl_vars['addon'] = $__foreach_addon_4_saved_item;
}
if ($__foreach_addon_4_saved_key) {
$_smarty_tpl->tpl_vars['num'] = $__foreach_addon_4_saved_key;
}
?>
			
			                        <?php
$_from = $_smarty_tpl->tpl_vars['domains']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_domain_5_saved_item = isset($_smarty_tpl->tpl_vars['domain']) ? $_smarty_tpl->tpl_vars['domain'] : false;
$__foreach_domain_5_saved_key = isset($_smarty_tpl->tpl_vars['num']) ? $_smarty_tpl->tpl_vars['num'] : false;
$_smarty_tpl->tpl_vars['domain'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['num'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['domain']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['domain']->value) {
$_smarty_tpl->tpl_vars['domain']->_loop = true;
$__foreach_domain_5_saved_local_item = $_smarty_tpl->tpl_vars['domain'];
?>
			                            <div class="item">
			                                <div class="row">
			                                    <div class="col-sm-7">
			                                        <span class="item-title">
			                                            <?php if ($_smarty_tpl->tpl_vars['domain']->value['type'] == "register") {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderdomainregistration'];
} else {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderdomaintransfer'];
}?>
			                                            <a href="<?php echo $_SERVER['PHP_SELF'];?>
?a=confdomains" class="btn btn-link btn-xs">
			                                                <i class="fa fa-pencil"></i>
			                                                Edit
			                                            </a>
			                                            <span class="visible-xs-inline">
			                                                <button type="button" class="btn btn-link btn-xs btn-remove-from-cart" onclick="removeItem('d','<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
')">
			                                                    <i class="fa fa-times"></i>
			                                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['remove'];?>

			                                                </button>
			                                            </span>
			                                        </span>
			                                        <?php if ($_smarty_tpl->tpl_vars['domain']->value['domain']) {?>
			                                            <span class="item-domain">
			                                                <?php echo $_smarty_tpl->tpl_vars['domain']->value['domain'];?>

			                                            </span>
			                                        <?php }?>
			                                        <?php if ($_smarty_tpl->tpl_vars['domain']->value['dnsmanagement']) {?>&nbsp;&raquo; <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domaindnsmanagement'];?>
<br /><?php }?>
			                                        <?php if ($_smarty_tpl->tpl_vars['domain']->value['emailforwarding']) {?>&nbsp;&raquo; <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainemailforwarding'];?>
<br /><?php }?>
			                                        <?php if ($_smarty_tpl->tpl_vars['domain']->value['idprotection']) {?>&nbsp;&raquo; <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainidprotection'];?>
<br /><?php }?>
			                                    </div>
			                                    <div class="col-sm-4 item-price">
			                                        <span><?php echo $_smarty_tpl->tpl_vars['domain']->value['price'];?>
</span>
			                                        <span class="cycle"><?php echo $_smarty_tpl->tpl_vars['domain']->value['regperiod'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderyears'];?>
</span>
			                                    </div>
			                                    <div class="col-sm-1 hidden-xs">
			                                        <button type="button" class="btn btn-link btn-xs btn-remove-from-cart" onclick="removeItem('d','<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
')">
			                                            <i class="fa fa-times"></i>
			                                        </button>
			                                    </div>
			                                </div>
			                            </div>
			                        <?php
$_smarty_tpl->tpl_vars['domain'] = $__foreach_domain_5_saved_local_item;
}
if ($__foreach_domain_5_saved_item) {
$_smarty_tpl->tpl_vars['domain'] = $__foreach_domain_5_saved_item;
}
if ($__foreach_domain_5_saved_key) {
$_smarty_tpl->tpl_vars['num'] = $__foreach_domain_5_saved_key;
}
?>
			
			                        <?php
$_from = $_smarty_tpl->tpl_vars['renewals']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_domain_6_saved_item = isset($_smarty_tpl->tpl_vars['domain']) ? $_smarty_tpl->tpl_vars['domain'] : false;
$__foreach_domain_6_saved_key = isset($_smarty_tpl->tpl_vars['num']) ? $_smarty_tpl->tpl_vars['num'] : false;
$_smarty_tpl->tpl_vars['domain'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['num'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['domain']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['domain']->value) {
$_smarty_tpl->tpl_vars['domain']->_loop = true;
$__foreach_domain_6_saved_local_item = $_smarty_tpl->tpl_vars['domain'];
?>
			                            <div class="item">
			                                <div class="row">
			                                    <div class="col-sm-7">
			                                        <span class="item-title">
			                                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainrenewal'];?>

			                                        </span>
			                                        <span class="item-domain">
			                                            <?php echo $_smarty_tpl->tpl_vars['domain']->value['domain'];?>

			                                        </span>
			                                        <?php if ($_smarty_tpl->tpl_vars['domain']->value['dnsmanagement']) {?>&nbsp;&raquo; <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domaindnsmanagement'];?>
<br /><?php }?>
			                                        <?php if ($_smarty_tpl->tpl_vars['domain']->value['emailforwarding']) {?>&nbsp;&raquo; <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainemailforwarding'];?>
<br /><?php }?>
			                                        <?php if ($_smarty_tpl->tpl_vars['domain']->value['idprotection']) {?>&nbsp;&raquo; <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainidprotection'];?>
<br /><?php }?>
			                                    </div>
			                                    <div class="col-sm-4 item-price">
			                                        <span><?php echo $_smarty_tpl->tpl_vars['domain']->value['price'];?>
</span>
			                                        <span class="cycle"><?php echo $_smarty_tpl->tpl_vars['domain']->value['regperiod'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderyears'];?>
</span>
			                                    </div>
			                                    <div class="col-sm-1">
			                                        <button type="button" class="btn btn-link btn-xs btn-remove-from-cart" onclick="removeItem('r','<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
')">
			                                            <i class="fa fa-times"></i>
			                                            <span class="visible-xs"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['remove'];?>
</span>
			                                        </button>
			                                    </div>
			                                </div>
			                            </div>
			                        <?php
$_smarty_tpl->tpl_vars['domain'] = $__foreach_domain_6_saved_local_item;
}
if ($__foreach_domain_6_saved_item) {
$_smarty_tpl->tpl_vars['domain'] = $__foreach_domain_6_saved_item;
}
if ($__foreach_domain_6_saved_key) {
$_smarty_tpl->tpl_vars['num'] = $__foreach_domain_6_saved_key;
}
?>
			
			                        <?php if ($_smarty_tpl->tpl_vars['cartitems']->value == 0) {?>
			                            <div class="view-cart-empty">
			                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['cartempty'];?>

			                            </div>
			                        <?php }?>
			
			                    </div>
							</div>
		
		                    <?php if ($_smarty_tpl->tpl_vars['cartitems']->value > 0) {?>
		                        <div class="empty-cart">
		                            <button type="button" class="btn btn-link btn-xs" id="btnEmptyCart">
		                                <i class="fa fa-trash"></i>
		                                <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['emptycart'];?>
</span>
		                            </button>
		                        </div>
		                    <?php }?>
		
		                </form>
		
		                <?php
$_from = $_smarty_tpl->tpl_vars['gatewaysoutput']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_gatewayoutput_7_saved_item = isset($_smarty_tpl->tpl_vars['gatewayoutput']) ? $_smarty_tpl->tpl_vars['gatewayoutput'] : false;
$_smarty_tpl->tpl_vars['gatewayoutput'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['gatewayoutput']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['gatewayoutput']->value) {
$_smarty_tpl->tpl_vars['gatewayoutput']->_loop = true;
$__foreach_gatewayoutput_7_saved_local_item = $_smarty_tpl->tpl_vars['gatewayoutput'];
?>
		                    <div class="view-cart-gateway-checkout">
		                        <?php echo $_smarty_tpl->tpl_vars['gatewayoutput']->value;?>

		                    </div>
		                <?php
$_smarty_tpl->tpl_vars['gatewayoutput'] = $__foreach_gatewayoutput_7_saved_local_item;
}
if ($__foreach_gatewayoutput_7_saved_item) {
$_smarty_tpl->tpl_vars['gatewayoutput'] = $__foreach_gatewayoutput_7_saved_item;
}
?>
		
		                <div class="view-cart-tabs">
		                    <ul class="nav nav-tabs" role="tablist">
		                        <li role="presentation" class="active"><a href="#applyPromo" aria-controls="applyPromo" role="tab" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['applyPromoCode'];?>
</a></li>
		                        <?php if ($_smarty_tpl->tpl_vars['taxenabled']->value && !$_smarty_tpl->tpl_vars['loggedin']->value) {?>
		                            <li role="presentation"><a href="#calcTaxes" aria-controls="calcTaxes" role="tab" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['estimateTaxes'];?>
</a></li>
		                        <?php }?>
		                    </ul>
		                    <div class="tab-content">
		                        <div role="tabpanel" class="tab-pane active promo" id="applyPromo">
		                            <?php if ($_smarty_tpl->tpl_vars['promotioncode']->value) {?>
		                                <div class="view-cart-promotion-code">
		                                    <?php echo $_smarty_tpl->tpl_vars['promotioncode']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['promotiondescription']->value;?>

		                                </div>
		                                <div class="text-center">
		                                    <a href="<?php echo $_SERVER['PHP_SELF'];?>
?a=removepromo" class="btn btn-default btn-sm">
		                                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['removePromotionCode'];?>

		                                    </a>
		                                </div>
		                            <?php } else { ?>
		                                <form method="post" action="cart.php?a=view">
		                                    <div class="form-group prepend-icon ">
		                                        <label for="cardno" class="field-icon">
		                                            <i class="fa fa-ticket"></i>
		                                        </label>
		                                        <input type="text" name="promocode" id="inputPromotionCode" class="field" placeholder="<?php echo WHMCS\Smarty::langFunction(array('key'=>"orderPromoCodePlaceholder"),$_smarty_tpl);?>
" required="required">
		                                    </div>
		                                    <button type="submit" name="validatepromo" class="btn btn-block" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpromovalidatebutton'];?>
">
		                                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpromovalidatebutton'];?>

		                                    </button>
		                                </form>
		                            <?php }?>
		                        </div>
		                        <div role="tabpanel" class="tab-pane" id="calcTaxes">
		
		                            <form method="post" action="cart.php?a=setstateandcountry">
		                                <div class="form-horizontal">
		                                    <div class="form-group">
		                                        <label for="inputState" class="col-sm-4 control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['state'];?>
</label>
		                                        <div class="col-sm-7">
		                                            <input type="text" name="state" id="inputState" value="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['state'];?>
" class="form-control"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> disabled="disabled"<?php }?> />
		                                        </div>
		                                    </div>
		                                    <div class="form-group">
		                                        <label for="inputCountry" class="col-sm-4 control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['country'];?>
</label>
		                                        <div class="col-sm-7">
		                                            <select name="country" id="inputCountry" class="form-control">
		                                                <?php
$_from = $_smarty_tpl->tpl_vars['countries']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_countrylabel_8_saved_item = isset($_smarty_tpl->tpl_vars['countrylabel']) ? $_smarty_tpl->tpl_vars['countrylabel'] : false;
$__foreach_countrylabel_8_saved_key = isset($_smarty_tpl->tpl_vars['countrycode']) ? $_smarty_tpl->tpl_vars['countrycode'] : false;
$_smarty_tpl->tpl_vars['countrylabel'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['countrycode'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['countrylabel']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['countrycode']->value => $_smarty_tpl->tpl_vars['countrylabel']->value) {
$_smarty_tpl->tpl_vars['countrylabel']->_loop = true;
$__foreach_countrylabel_8_saved_local_item = $_smarty_tpl->tpl_vars['countrylabel'];
?>
		                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['countrycode']->value;?>
"<?php if ((!$_smarty_tpl->tpl_vars['country']->value && $_smarty_tpl->tpl_vars['countrycode']->value == $_smarty_tpl->tpl_vars['defaultcountry']->value) || $_smarty_tpl->tpl_vars['countrycode']->value == $_smarty_tpl->tpl_vars['country']->value) {?> selected<?php }?>>
		                                                        <?php echo $_smarty_tpl->tpl_vars['countrylabel']->value;?>

		                                                    </option>
		                                                <?php
$_smarty_tpl->tpl_vars['countrylabel'] = $__foreach_countrylabel_8_saved_local_item;
}
if ($__foreach_countrylabel_8_saved_item) {
$_smarty_tpl->tpl_vars['countrylabel'] = $__foreach_countrylabel_8_saved_item;
}
if ($__foreach_countrylabel_8_saved_key) {
$_smarty_tpl->tpl_vars['countrycode'] = $__foreach_countrylabel_8_saved_key;
}
?>
		                                            </select>
		                                        </div>
		                                    </div>
		                                    <div class="form-group text-center">
		                                        <button type="submit" class="btn">
		                                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['updateTotals'];?>

		                                        </button>
		                                    </div>
		                                </div>
		                            </form>
		
		                        </div>
		                    </div>
		                </div>
		
		            </div>
		            
		            <div class="col-md-4">
		
		                <div class="order-summary check-side">
			                <div class="header-lined">
								<h1><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordersummary'];?>
</h1>
			                </div>
		                    <div class="summary-container">
		
		                        <div class="subtotal">
		                            <span class="pull-left"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordersubtotal'];?>
</span>
		                            <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['subtotal']->value;?>
</span>
		                        </div>
		                        
		                        <?php if ($_smarty_tpl->tpl_vars['promotioncode']->value || $_smarty_tpl->tpl_vars['taxrate']->value || $_smarty_tpl->tpl_vars['taxrate2']->value) {?>
		                            <div class="bordered-totals">
		                                <?php if ($_smarty_tpl->tpl_vars['promotioncode']->value) {?>
		                                    <div class="clearfix">
		                                        <span class="pull-left"><?php echo $_smarty_tpl->tpl_vars['promotiondescription']->value;?>
</span>
		                                        <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['discount']->value;?>
</span>
		                                    </div>
		                                <?php }?>
		                                <?php if ($_smarty_tpl->tpl_vars['taxrate']->value) {?>
		                                    <div class="clearfix">
		                                        <span class="pull-left"><?php echo $_smarty_tpl->tpl_vars['taxname']->value;?>
 @ <?php echo $_smarty_tpl->tpl_vars['taxrate']->value;?>
%</span>
		                                        <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['taxtotal']->value;?>
</span>
		                                    </div>
		                                <?php }?>
		                                <?php if ($_smarty_tpl->tpl_vars['taxrate2']->value) {?>
		                                    <div class="clearfix">
		                                        <span class="pull-left"><?php echo $_smarty_tpl->tpl_vars['taxname2']->value;?>
 @ <?php echo $_smarty_tpl->tpl_vars['taxrate2']->value;?>
%</span>
		                                        <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['taxtotal2']->value;?>
</span>
		                                    </div>
		                                <?php }?>
		                            </div>
		                        <?php }?>
		                        <?php if ($_smarty_tpl->tpl_vars['totalrecurringmonthly']->value || $_smarty_tpl->tpl_vars['totalrecurringquarterly']->value || $_smarty_tpl->tpl_vars['totalrecurringsemiannually']->value || $_smarty_tpl->tpl_vars['totalrecurringannually']->value || $_smarty_tpl->tpl_vars['totalrecurringbiennially']->value || $_smarty_tpl->tpl_vars['totalrecurringtriennially']->value) {?>
		                            <div class="recurring-totals clearfix">
		                                <span class="pull-left"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['totals'];?>
</span>
		                                <span class="pull-right recurring-charges">
		    <?php if ($_smarty_tpl->tpl_vars['totalrecurringmonthly']->value) {
echo $_smarty_tpl->tpl_vars['totalrecurringmonthly']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermmonthly'];?>
<br /><?php }?>
		    <?php if ($_smarty_tpl->tpl_vars['totalrecurringquarterly']->value) {
echo $_smarty_tpl->tpl_vars['totalrecurringquarterly']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermquarterly'];?>
<br /><?php }?>
		    <?php if ($_smarty_tpl->tpl_vars['totalrecurringsemiannually']->value) {
echo $_smarty_tpl->tpl_vars['totalrecurringsemiannually']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermsemiannually'];?>
<br /><?php }?>
		    <?php if ($_smarty_tpl->tpl_vars['totalrecurringannually']->value) {
echo $_smarty_tpl->tpl_vars['totalrecurringannually']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermannually'];?>
<br /><?php }?>
		    <?php if ($_smarty_tpl->tpl_vars['totalrecurringbiennially']->value) {
echo $_smarty_tpl->tpl_vars['totalrecurringbiennially']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermbiennially'];?>
<br /><?php }?>
		    <?php if ($_smarty_tpl->tpl_vars['totalrecurringtriennially']->value) {
echo $_smarty_tpl->tpl_vars['totalrecurringtriennially']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermtriennially'];?>
<br /><?php }?>
		                                </span>
		                            </div>
		                        <?php }?>
		
		                        <div class="total">
		                            <strong><?php echo $_smarty_tpl->tpl_vars['total']->value;?>
</strong>
		                        </div>
		
		                    </div>
		                </div>
		            </div>
		            <div class="col-sm-12">
				        <div class="text-right check-btm">
					        <a href="javascript:;" onclick="javascript:history.go(-1);" class="btn btn-default btn-check pull-left">
						        <i class="fa fa-angle-double-left" aria-hidden="true"></i> 返回
						    </a>
				            <p class="tos">
				                <a href="cart.php" class="btn btn-link btn-continue-shopping" id="continueShopping"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['continueShopping'];?>
</a>
				            </p>
				            			
				            <a href="cart.php?a=checkout" class="btn btn-success btn-check<?php if ($_smarty_tpl->tpl_vars['cartitems']->value == 0) {?> disabled<?php }?>" id="checkout">
				                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['checkout'];?>

				                &nbsp;<i class="fa fa-arrow-circle-right"></i>
				            </a>
				        </div>
					</div>
		        </div>
		
		        <form method="post" action="cart.php">
		            <input type="hidden" name="a" value="remove" />
		            <input type="hidden" name="r" value="" id="inputRemoveItemType" />
		            <input type="hidden" name="i" value="" id="inputRemoveItemRef" />
		            <div class="modal fade modal-remove-item" id="modalRemoveItem" tabindex="-1" role="dialog">
		                <div class="modal-dialog" role="document">
		                    <div class="modal-content">
		                        <div class="modal-header">
		                            <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['close'];?>
">
		                                <span aria-hidden="true">&times;</span>
		                            </button>
		                            <h4 class="modal-title">
		                                <i class="fa fa-times fa-3x"></i>
		                                <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['removeItem'];?>
</span>
		                            </h4>
		                        </div>
		                        <div class="modal-body">
		                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['cartremoveitemconfirm'];?>

		                        </div>
		                        <div class="modal-footer">
		                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['no'];?>
</button>
		                            <button type="submit" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['yes'];?>
</button>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </form>
		
		        <form method="post" action="cart.php">
		            <input type="hidden" name="a" value="empty" />
		            <div class="modal fade modal-remove-item" id="modalEmptyCart" tabindex="-1" role="dialog">
		                <div class="modal-dialog" role="document">
		                    <div class="modal-content">
		                        <div class="modal-header">
		                            <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['close'];?>
">
		                                <span aria-hidden="true">&times;</span>
		                            </button>
		                            <h4 class="modal-title">
		                                <i class="fa fa-trash fa-3x"></i>
		                                <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['emptycart'];?>
</span>
		                            </h4>
		                        </div>
		                        <div class="modal-body">
		                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['cartemptyconfirm'];?>

		                        </div>
		                        <div class="modal-footer">
		                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['no'];?>
</button>
		                            <button type="submit" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['yes'];?>
</button>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </form>
    		</div>
		</div>
	</section>
<?php }
}
}
