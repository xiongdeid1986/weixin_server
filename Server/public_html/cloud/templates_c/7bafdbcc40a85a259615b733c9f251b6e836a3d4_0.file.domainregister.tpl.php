<?php
/* Smarty version 3.1.29, created on 2017-12-05 04:55:33
  from "/home/admin/web/cloud.ddweb.com.cn/public_html/templates/orderforms/standard_cart/domainregister.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a2626c5cf7447_57933738',
  'file_dependency' => 
  array (
    '7bafdbcc40a85a259615b733c9f251b6e836a3d4' => 
    array (
      0 => '/home/admin/web/cloud.ddweb.com.cn/public_html/templates/orderforms/standard_cart/domainregister.tpl',
      1 => 1510648882,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:orderforms/standard_cart/common.tpl' => 1,
    'file:orderforms/standard_cart/sidebar-categories.tpl' => 1,
    'file:orderforms/standard_cart/sidebar-categories-collapsed.tpl' => 1,
  ),
),false)) {
function content_5a2626c5cf7447_57933738 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:orderforms/standard_cart/common.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div id="order-standard_cart">

    <div class="row">

        <div class="pull-md-right col-md-9">

            <div class="header-lined">
                <h1>
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['registerdomain'];?>

                </h1>
            </div>

        </div>

        <div class="col-md-3 pull-md-left sidebar hidden-xs hidden-sm">

            <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:orderforms/standard_cart/sidebar-categories.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


        </div>

        <div class="col-md-9 pull-md-right">

            <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:orderforms/standard_cart/sidebar-categories-collapsed.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


            <p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['findNewDomain'];?>
</p>

            <div class="domain-checker-container">
                <div class="domain-checker-bg clearfix">
                    <form method="post" action="cart.php" id="frmDomainChecker">
                        <input type="hidden" name="a" value="checkDomain">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
                                <div class="input-group input-group-lg input-group-box">
                                    <input type="text" name="domain" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['findyourdomain'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['lookupTerm']->value;?>
" id="inputDomain" data-toggle="tooltip" data-placement="left" data-trigger="manual" title="<?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.domainOrKeyword'),$_smarty_tpl);?>
" />
                                    <span class="input-group-btn">
                                        <button type="submit" id="btnCheckAvailability" class="btn btn-primary domain-check-availability"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['search'];?>
</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <?php if ($_smarty_tpl->tpl_vars['captcha']->value) {?>
                            <div class="captcha-container" id="captchaContainer">
                                <?php if ($_smarty_tpl->tpl_vars['captcha']->value == "recaptcha") {?>
                                    <?php echo '<script'; ?>
 src="https://www.google.com/recaptcha/api.js" async defer><?php echo '</script'; ?>
>
                                    <div id="google-recaptcha" class="g-recaptcha center-block" data-sitekey="<?php echo $_smarty_tpl->tpl_vars['reCaptchaPublicKey']->value;?>
" data-toggle="tooltip" data-placement="left" data-trigger="manual" title="<?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.required'),$_smarty_tpl);?>
" ></div>
                                <?php } else { ?>
                                    <div class="default-captcha default-captcha-register-margin">
                                        <p><?php echo WHMCS\Smarty::langFunction(array('key'=>"cartSimpleCaptcha"),$_smarty_tpl);?>
</p>
                                        <div>
                                            <img id="inputCaptchaImage" src="includes/verifyimage.php" align="middle" />
                                            <input id="inputCaptcha" type="text" name="code" maxlength="5" class="form-control input-sm" data-toggle="tooltip" data-placement="right" data-trigger="manual" title="<?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.required'),$_smarty_tpl);?>
" />
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                        <?php }?>
                    </form>
                </div>
            </div>

            <div id="DomainSearchResults" class="hidden">

                <div id="searchDomainInfo" class="domain-checker-result-headline">
                    <p id="primaryLookupSearching" class="domain-lookup-loader domain-lookup-primary-loader domain-searching"><i class="fa fa-spinner fa-spin"></i> <?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.searching'),$_smarty_tpl);?>
...</p>
                    <div id="primaryLookupResult" class="domain-lookup-result hidden">
                        <p class="domain-invalid domain-checker-invalid"><?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.domainLetterOrNumber'),$_smarty_tpl);?>
<span class="domain-length-restrictions"><?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.domainLengthRequirements'),$_smarty_tpl);?>
</span></p>
                        <p class="domain-unavailable domain-checker-unavailable"><?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.domainIsUnavailable'),$_smarty_tpl);?>
</p>
                        <p class="domain-available domain-checker-available"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainavailable1'];?>
 <strong></strong> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainavailable2'];?>
</p>
                        <a class="domain-contact-support btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainContactUs'];?>
</a>
                        <p class="domain-price">
                            <span class="price"></span>
                            <button class="btn btn-primary btn-add-to-cart" data-whois="0" data-domain="">
                                <span class="to-add"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['addtocart'];?>
</span>
                                <span class="added"><i class="glyphicon glyphicon-shopping-cart"></i> <?php echo WHMCS\Smarty::langFunction(array('key'=>'checkout'),$_smarty_tpl);?>
</span>
                                <span class="unavailable"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domaincheckertaken'];?>
</span>
                            </button>
                        </p>
                    </div>
                </div>

                <?php if ($_smarty_tpl->tpl_vars['spotlightTlds']->value) {?>
                    <div id="spotlightTlds" class="spotlight-tlds clearfix">
                        <div class="spotlight-tlds-container">
                            <?php
$_from = $_smarty_tpl->tpl_vars['spotlightTlds']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_data_0_saved_item = isset($_smarty_tpl->tpl_vars['data']) ? $_smarty_tpl->tpl_vars['data'] : false;
$__foreach_data_0_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['data'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['data']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->_loop = true;
$__foreach_data_0_saved_local_item = $_smarty_tpl->tpl_vars['data'];
?>
                                <div class="spotlight-tld-container spotlight-tld-container-<?php echo count($_smarty_tpl->tpl_vars['spotlightTlds']->value);?>
">
                                    <div id="spotlight<?php echo $_smarty_tpl->tpl_vars['data']->value['tldNoDots'];?>
" class="spotlight-tld">
                                        <?php if ($_smarty_tpl->tpl_vars['data']->value['group']) {?>
                                            <div class="spotlight-tld-<?php echo $_smarty_tpl->tpl_vars['data']->value['group'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['groupDisplayName'];?>
</div>
                                        <?php }?>
                                        <?php echo $_smarty_tpl->tpl_vars['data']->value['tld'];?>

                                        <span class="domain-lookup-loader domain-lookup-spotlight-loader">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </span>
                                        <div class="domain-lookup-result">
                                            <button type="button" class="btn unavailable hidden" disabled="disabled">
                                                <?php echo WHMCS\Smarty::langFunction(array('key'=>'domainunavailable'),$_smarty_tpl);?>

                                            </button>
                                            <button type="button" class="btn invalid hidden" disabled="disabled">
                                                <?php echo WHMCS\Smarty::langFunction(array('key'=>'domainunavailable'),$_smarty_tpl);?>

                                            </button>
                                            <span class="available price hidden"><?php echo $_smarty_tpl->tpl_vars['data']->value['register'];?>
</span>
                                            <button type="button" class="btn hidden btn-add-to-cart" data-whois="0" data-domain="">
                                                <span class="to-add"><?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.add'),$_smarty_tpl);?>
</span>
                                                <span class="added"><i class="glyphicon glyphicon-shopping-cart"></i> <?php echo WHMCS\Smarty::langFunction(array('key'=>'checkout'),$_smarty_tpl);?>
</span>
                                                <span class="unavailable"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domaincheckertaken'];?>
</span>
                                            </button>
                                            <button type="button" class="btn btn-primary domain-contact-support hidden">
                                                <?php echo WHMCS\Smarty::langFunction(array('key'=>'domainChecker.contactSupport'),$_smarty_tpl);?>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php
$_smarty_tpl->tpl_vars['data'] = $__foreach_data_0_saved_local_item;
}
if ($__foreach_data_0_saved_item) {
$_smarty_tpl->tpl_vars['data'] = $__foreach_data_0_saved_item;
}
if ($__foreach_data_0_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_data_0_saved_key;
}
?>
                        </div>
                    </div>
                <?php }?>

                <div class="suggested-domains<?php if (!$_smarty_tpl->tpl_vars['showSuggestionsContainer']->value) {?> hidden<?php }?>">
                    <div class="panel-heading">
                        <?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.suggestedDomains'),$_smarty_tpl);?>

                    </div>
                    <div id="suggestionsLoader" class="panel-body domain-lookup-loader domain-lookup-suggestions-loader">
                        <i class="fa fa-spinner fa-spin"></i> <?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.generatingSuggestions'),$_smarty_tpl);?>

                    </div>
                    <ul id="domainSuggestions" class="domain-lookup-result list-group hidden">
                        <li class="domain-suggestion list-group-item hidden">
                            <span class="domain"></span><span class="extension"></span>
                            <span class="promo hidden">
                                <span class="sales-group-hot hidden"><?php echo WHMCS\Smarty::langFunction(array('key'=>'domainCheckerSalesGroup.hot'),$_smarty_tpl);?>
</span>
                                <span class="sales-group-new hidden"><?php echo WHMCS\Smarty::langFunction(array('key'=>'domainCheckerSalesGroup.new'),$_smarty_tpl);?>
</span>
                                <span class="sales-group-sale hidden"><?php echo WHMCS\Smarty::langFunction(array('key'=>'domainCheckerSalesGroup.sale'),$_smarty_tpl);?>
</span>
                            </span>
                            <div class="actions">
                                <span class="price"></span>
                                <button type="button" class="btn btn-add-to-cart" data-whois="1" data-domain="">
                                    <span class="to-add"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['addtocart'];?>
</span>
                                    <span class="added"><i class="glyphicon glyphicon-shopping-cart"></i> <?php echo WHMCS\Smarty::langFunction(array('key'=>'checkout'),$_smarty_tpl);?>
</span>
                                    <span class="unavailable"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domaincheckertaken'];?>
</span>
                                </button>
                                <button type="button" class="btn btn-primary domain-contact-support hidden">
                                    <?php echo WHMCS\Smarty::langFunction(array('key'=>'domainChecker.contactSupport'),$_smarty_tpl);?>

                                </button>
                            </div>
                        </li>
                    </ul>
                    <div class="panel-footer more-suggestions hidden text-center">
                        <a id="moreSuggestions" href="#" onclick="loadMoreSuggestions();return false;"><?php echo WHMCS\Smarty::langFunction(array('key'=>'domainsmoresuggestions'),$_smarty_tpl);?>
</a>
                        <span id="noMoreSuggestions" class="no-more small hidden"><?php echo WHMCS\Smarty::langFunction(array('key'=>'domaincheckernomoresuggestions'),$_smarty_tpl);?>
</span>
                    </div>
                    <div class="text-center text-muted domain-suggestions-warning">
                        <p><?php echo WHMCS\Smarty::langFunction(array('key'=>'domainssuggestionswarnings'),$_smarty_tpl);?>
</p>
                    </div>
                </div>

            </div>

            <div class="domain-pricing">

                <?php if ($_smarty_tpl->tpl_vars['featuredTlds']->value) {?>
                    <div class="featured-tlds-container">
                        <div class="row">
                            <?php
$_from = $_smarty_tpl->tpl_vars['featuredTlds']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_tldinfo_1_saved_item = isset($_smarty_tpl->tpl_vars['tldinfo']) ? $_smarty_tpl->tpl_vars['tldinfo'] : false;
$__foreach_tldinfo_1_saved_key = isset($_smarty_tpl->tpl_vars['num']) ? $_smarty_tpl->tpl_vars['num'] : false;
$_smarty_tpl->tpl_vars['tldinfo'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['num'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['tldinfo']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['tldinfo']->value) {
$_smarty_tpl->tpl_vars['tldinfo']->_loop = true;
$__foreach_tldinfo_1_saved_local_item = $_smarty_tpl->tpl_vars['tldinfo'];
?>
                                <?php if ($_smarty_tpl->tpl_vars['num']->value%3 == 0 && (count($_smarty_tpl->tpl_vars['featuredTlds']->value)-$_smarty_tpl->tpl_vars['num']->value < 3)) {?>
                                    <?php if (count($_smarty_tpl->tpl_vars['featuredTlds']->value)-$_smarty_tpl->tpl_vars['num']->value == 2) {?>
                                        <div class="col-sm-2"></div>
                                    <?php } else { ?>
                                        <div class="col-sm-4"></div>
                                    <?php }?>
                                <?php }?>
                                <div class="col-sm-4 col-xs-6">
                                    <div class="featured-tld">
                                        <div class="img-container">
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_IMG']->value;?>
/tld_logos/<?php echo $_smarty_tpl->tpl_vars['tldinfo']->value['tldNoDots'];?>
.png">
                                        </div>
                                        <div class="price <?php echo $_smarty_tpl->tpl_vars['tldinfo']->value['tldNoDots'];?>
">
                                            <?php if (is_object($_smarty_tpl->tpl_vars['tldinfo']->value['register'])) {?>
                                                <?php echo $_smarty_tpl->tpl_vars['tldinfo']->value['register']->toPrefixed();
if ($_smarty_tpl->tpl_vars['tldinfo']->value['period'] > 1) {
ob_start();
echo $_smarty_tpl->tpl_vars['tldinfo']->value['period'];
$_tmp1=ob_get_clean();
echo WHMCS\Smarty::langFunction(array('key'=>"orderForm.shortPerYears",'years'=>$_tmp1),$_smarty_tpl);
} else {
echo WHMCS\Smarty::langFunction(array('key'=>"orderForm.shortPerYear",'years'=>''),$_smarty_tpl);
}?>
                                            <?php } else { ?>
                                                N/A
                                            <?php }?></div>
                                    </div>
                                </div>
                            <?php
$_smarty_tpl->tpl_vars['tldinfo'] = $__foreach_tldinfo_1_saved_local_item;
}
if ($__foreach_tldinfo_1_saved_item) {
$_smarty_tpl->tpl_vars['tldinfo'] = $__foreach_tldinfo_1_saved_item;
}
if ($__foreach_tldinfo_1_saved_key) {
$_smarty_tpl->tpl_vars['num'] = $__foreach_tldinfo_1_saved_key;
}
?>
                        </div>
                    </div>
                <?php }?>

                <h4><?php echo WHMCS\Smarty::langFunction(array('key'=>'pricing.browseExtByCategory'),$_smarty_tpl);?>
</h4>

                <div class="tld-filters">
                    <?php
$_from = $_smarty_tpl->tpl_vars['categoriesWithCounts']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_count_2_saved_item = isset($_smarty_tpl->tpl_vars['count']) ? $_smarty_tpl->tpl_vars['count'] : false;
$__foreach_count_2_saved_key = isset($_smarty_tpl->tpl_vars['category']) ? $_smarty_tpl->tpl_vars['category'] : false;
$_smarty_tpl->tpl_vars['count'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['category'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['count']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value => $_smarty_tpl->tpl_vars['count']->value) {
$_smarty_tpl->tpl_vars['count']->_loop = true;
$__foreach_count_2_saved_local_item = $_smarty_tpl->tpl_vars['count'];
?>
                        <a href="#" data-category="<?php echo $_smarty_tpl->tpl_vars['category']->value;?>
" class="label label-default"><?php echo $_smarty_tpl->tpl_vars['category']->value;?>
 (<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
)</a>
                    <?php
$_smarty_tpl->tpl_vars['count'] = $__foreach_count_2_saved_local_item;
}
if ($__foreach_count_2_saved_item) {
$_smarty_tpl->tpl_vars['count'] = $__foreach_count_2_saved_item;
}
if ($__foreach_count_2_saved_key) {
$_smarty_tpl->tpl_vars['category'] = $__foreach_count_2_saved_key;
}
?>
                </div>

                <div class="row tld-pricing-header text-center">
                    <div class="col-sm-4 no-bg"><?php echo WHMCS\Smarty::langFunction(array('key'=>'orderdomain'),$_smarty_tpl);?>
</div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-xs-4"><?php echo WHMCS\Smarty::langFunction(array('key'=>'pricing.register'),$_smarty_tpl);?>
</div>
                            <div class="col-xs-4"><?php echo WHMCS\Smarty::langFunction(array('key'=>'pricing.transfer'),$_smarty_tpl);?>
</div>
                            <div class="col-xs-4"><?php echo WHMCS\Smarty::langFunction(array('key'=>'pricing.renewal'),$_smarty_tpl);?>
</div>
                        </div>
                    </div>
                </div>
                <?php
$_from = $_smarty_tpl->tpl_vars['pricing']->value['pricing'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_price_3_saved_item = isset($_smarty_tpl->tpl_vars['price']) ? $_smarty_tpl->tpl_vars['price'] : false;
$__foreach_price_3_saved_key = isset($_smarty_tpl->tpl_vars['tld']) ? $_smarty_tpl->tpl_vars['tld'] : false;
$_smarty_tpl->tpl_vars['price'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['tld'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['price']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['tld']->value => $_smarty_tpl->tpl_vars['price']->value) {
$_smarty_tpl->tpl_vars['price']->_loop = true;
$__foreach_price_3_saved_local_item = $_smarty_tpl->tpl_vars['price'];
?>
                    <div class="row tld-row" data-category="<?php
$_from = $_smarty_tpl->tpl_vars['price']->value['categories'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_category_4_saved_item = isset($_smarty_tpl->tpl_vars['category']) ? $_smarty_tpl->tpl_vars['category'] : false;
$_smarty_tpl->tpl_vars['category'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['category']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->_loop = true;
$__foreach_category_4_saved_local_item = $_smarty_tpl->tpl_vars['category'];
?>|<?php echo $_smarty_tpl->tpl_vars['category']->value;?>
|<?php
$_smarty_tpl->tpl_vars['category'] = $__foreach_category_4_saved_local_item;
}
if ($__foreach_category_4_saved_item) {
$_smarty_tpl->tpl_vars['category'] = $__foreach_category_4_saved_item;
}
?>">
                        <div class="col-sm-4 two-row-center">
                            <strong>.<?php echo $_smarty_tpl->tpl_vars['tld']->value;?>
</strong>
                            <?php if ($_smarty_tpl->tpl_vars['price']->value['group']) {?>
                                <span class="tld-sale-group tld-sale-group-<?php echo $_smarty_tpl->tpl_vars['price']->value['group'];?>
"><?php echo $_smarty_tpl->tpl_vars['price']->value['group'];?>
!</span>
                            <?php }?>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <?php if (current($_smarty_tpl->tpl_vars['price']->value['register']) >= 0) {?>
                                        <?php echo current($_smarty_tpl->tpl_vars['price']->value['register']);?>
<br>
                                        <small><?php echo key($_smarty_tpl->tpl_vars['price']->value['register']);?>
 <?php if (key($_smarty_tpl->tpl_vars['price']->value['register']) > 1) {
echo WHMCS\Smarty::langFunction(array('key'=>"orderForm.years"),$_smarty_tpl);
} else {
echo WHMCS\Smarty::langFunction(array('key'=>"orderForm.year"),$_smarty_tpl);
}?></small>
                                    <?php } else { ?>
                                        <small>N/A</small>
                                    <?php }?>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <?php if (current($_smarty_tpl->tpl_vars['price']->value['transfer']) > 0) {?>
                                        <?php echo current($_smarty_tpl->tpl_vars['price']->value['transfer']);?>
<br>
                                        <small><?php echo key($_smarty_tpl->tpl_vars['price']->value['transfer']);?>
 <?php if (key($_smarty_tpl->tpl_vars['price']->value['register']) > 1) {
echo WHMCS\Smarty::langFunction(array('key'=>"orderForm.years"),$_smarty_tpl);
} else {
echo WHMCS\Smarty::langFunction(array('key'=>"orderForm.year"),$_smarty_tpl);
}?></small>
                                    <?php } else { ?>
                                        <small>N/A</small>
                                    <?php }?>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <?php if (current($_smarty_tpl->tpl_vars['price']->value['renew']) > 0) {?>
                                        <?php echo current($_smarty_tpl->tpl_vars['price']->value['renew']);?>
<br>
                                        <small><?php echo key($_smarty_tpl->tpl_vars['price']->value['renew']);?>
 <?php if (key($_smarty_tpl->tpl_vars['price']->value['register']) > 1) {
echo WHMCS\Smarty::langFunction(array('key'=>"orderForm.years"),$_smarty_tpl);
} else {
echo WHMCS\Smarty::langFunction(array('key'=>"orderForm.year"),$_smarty_tpl);
}?></small>
                                    <?php } else { ?>
                                        <small>N/A</small>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
$_smarty_tpl->tpl_vars['price'] = $__foreach_price_3_saved_local_item;
}
if ($__foreach_price_3_saved_item) {
$_smarty_tpl->tpl_vars['price'] = $__foreach_price_3_saved_item;
}
if ($__foreach_price_3_saved_key) {
$_smarty_tpl->tpl_vars['tld'] = $__foreach_price_3_saved_key;
}
?>
                <div class="row tld-row no-tlds">
                    <div class="col-xs-12 text-center">
                        <br>
                        <?php echo WHMCS\Smarty::langFunction(array('key'=>'pricing.selectExtCategory'),$_smarty_tpl);?>

                        <br><br>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="<?php if ($_smarty_tpl->tpl_vars['domainTransferEnabled']->value) {?>col-md-6<?php } else { ?>col-md-8 col-md-offset-2<?php }?>">
                    <div class="domain-promo-box">

                        <div class="clearfix">
                            <i class="fa fa-server fa-4x"></i>
                            <h3><?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.addHosting'),$_smarty_tpl);?>
</h3>
                            <p class="font-bold text-warning"><?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.chooseFromRange'),$_smarty_tpl);?>
</p>
                        </div>

                        <p><?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.packagesForBudget'),$_smarty_tpl);?>
</p>

                        <a href="cart.php" class="btn btn-warning">
                            <?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.exploreNow'),$_smarty_tpl);?>

                        </a>
                    </div>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['domainTransferEnabled']->value) {?>
                    <div class="col-md-6">
                        <div class="domain-promo-box">

                            <div class="clearfix">
                                <i class="fa fa-globe fa-4x"></i>
                                <h3><?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.transferToUs'),$_smarty_tpl);?>
</h3>
                                <p class="font-bold text-primary"><?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.transferExtend'),$_smarty_tpl);?>
*</p>
                            </div>

                            <a href="cart.php?a=add&domain=transfer" class="btn btn-primary">
                                <?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.transferDomain'),$_smarty_tpl);?>

                            </a>

                            <p class="small">* <?php echo WHMCS\Smarty::langFunction(array('key'=>'orderForm.extendExclusions'),$_smarty_tpl);?>
</p>
                        </div>
                    </div>
                <?php }?>
            </div>

        </div>
    </div>
</div>

<?php echo '<script'; ?>
>
jQuery(document).ready(function() {
    jQuery('.tld-filters a:first-child').click();
<?php if ($_smarty_tpl->tpl_vars['lookupTerm']->value && !$_smarty_tpl->tpl_vars['captchaError']->value) {?>
    jQuery('#btnCheckAvailability').click();
<?php }?>
});
<?php echo '</script'; ?>
>
<?php }
}
