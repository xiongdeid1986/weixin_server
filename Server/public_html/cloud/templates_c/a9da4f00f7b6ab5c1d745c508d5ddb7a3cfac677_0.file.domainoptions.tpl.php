<?php
/* Smarty version 3.1.29, created on 2017-12-05 14:49:44
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/orderforms/NeWorld/domainoptions.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a26b20887e987_42764096',
  'file_dependency' => 
  array (
    'a9da4f00f7b6ab5c1d745c508d5ddb7a3cfac677' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/orderforms/NeWorld/domainoptions.tpl',
      1 => 1512474175,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a26b20887e987_42764096 ($_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['invalid']->value) {?>
    <div class="domain-checker-result-headline domain-checker-unavailable">
        <?php if ($_smarty_tpl->tpl_vars['reason']->value) {?>
            <?php echo $_smarty_tpl->tpl_vars['reason']->value;?>

        <?php } else { ?>
            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['cartdomaininvalid'];?>

        <?php }?>
    </div>
<?php } elseif ($_smarty_tpl->tpl_vars['alreadyindb']->value) {?>
    <div class="domain-checker-result-headline domain-checker-unavailable">
        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['cartdomainexists'];?>

    </div>
<?php } else { ?>

    <?php if ($_smarty_tpl->tpl_vars['checktype']->value == "register" && $_smarty_tpl->tpl_vars['regenabled']->value) {?>

        <input type="hidden" name="domainoption" value="register" />

        <?php if ($_smarty_tpl->tpl_vars['status']->value == "available" || $_smarty_tpl->tpl_vars['status']->value == "error") {?>

            <div class="domain-checker-result-headline domain-checker-available">
                <?php echo WHMCS\Smarty::sprintf2Modifier($_smarty_tpl->tpl_vars['LANG']->value['cartcongratsdomainavailable'],$_smarty_tpl->tpl_vars['domain']->value);?>

            </div>

            <input type="hidden" name="domains[]" value="<?php echo $_smarty_tpl->tpl_vars['searchResults']->value['domainName'];?>
" />
            <input type="hidden" name="domainsregperiod[<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['searchResults']->value['shortestPeriod']['period'];?>
" />

            <div class="text-center">
                <?php if (count($_smarty_tpl->tpl_vars['searchResults']->value['pricing']) == 1) {?>
                    <p class="margin-bottom"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['domainAddedToCart'];?>
</p>
                    <button type="button" class="btn btn-default btn-lg margin-bottom">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        <?php echo $_smarty_tpl->tpl_vars['searchResults']->value['shortestPeriod']['register'];?>

                    </button>
                <?php } else { ?>
                    <p class="margin-bottom"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['registerLongerAndSave'];?>
</p>
                    <div class="btn-group btn-group-lg margin-bottom">
                        <button type="button" class="btn btn-default btn-sm">
                            <span name="<?php echo $_smarty_tpl->tpl_vars['searchResults']->value['domainName'];?>
-selected-price">
                                <b class="glyphicon glyphicon-shopping-cart"></b>
                                <?php echo $_smarty_tpl->tpl_vars['searchResults']->value['shortestPeriod']['period'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderyears'];?>
 @ <?php echo $_smarty_tpl->tpl_vars['searchResults']->value['shortestPeriod']['register'];?>

                            </span>
                        </button>
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle additional-options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <b class="caret"></b>
                            <span class="sr-only">
                                <?php echo WHMCS\Smarty::langFunction(array('key'=>"domainChecker.additionalPricingOptions",'domain'=>$_smarty_tpl->tpl_vars['searchResults']->value['domainName']),$_smarty_tpl);?>

                            </span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php
$_from = $_smarty_tpl->tpl_vars['searchResults']->value['pricing'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_price_0_saved_item = isset($_smarty_tpl->tpl_vars['price']) ? $_smarty_tpl->tpl_vars['price'] : false;
$__foreach_price_0_saved_key = isset($_smarty_tpl->tpl_vars['years']) ? $_smarty_tpl->tpl_vars['years'] : false;
$_smarty_tpl->tpl_vars['price'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['years'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['price']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['years']->value => $_smarty_tpl->tpl_vars['price']->value) {
$_smarty_tpl->tpl_vars['price']->_loop = true;
$__foreach_price_0_saved_local_item = $_smarty_tpl->tpl_vars['price'];
?>
                                <li>
                                    <a href="#" onclick="selectDomainPricing('<?php echo $_smarty_tpl->tpl_vars['searchResults']->value['domainName'];?>
', '<?php echo $_smarty_tpl->tpl_vars['price']->value['register'];?>
', <?php echo $_smarty_tpl->tpl_vars['years']->value;?>
, '<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderyears'];?>
');return false;">
                                        <b class="glyphicon glyphicon-shopping-cart"></b>
                                        <?php echo $_smarty_tpl->tpl_vars['years']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderyears'];?>
 @ <?php echo $_smarty_tpl->tpl_vars['price']->value['register'];?>

                                    </a>
                                </li>
                            <?php
$_smarty_tpl->tpl_vars['price'] = $__foreach_price_0_saved_local_item;
}
if ($__foreach_price_0_saved_item) {
$_smarty_tpl->tpl_vars['price'] = $__foreach_price_0_saved_item;
}
if ($__foreach_price_0_saved_key) {
$_smarty_tpl->tpl_vars['years'] = $__foreach_price_0_saved_key;
}
?>
                        </ul>
                    </div>
                <?php }?>
            </div>


            <?php if (isset($_smarty_tpl->tpl_vars['continueok'])) {$_smarty_tpl->tpl_vars['continueok'] = clone $_smarty_tpl->tpl_vars['continueok'];
$_smarty_tpl->tpl_vars['continueok']->value = true; $_smarty_tpl->tpl_vars['continueok']->nocache = null;
} else $_smarty_tpl->tpl_vars['continueok'] = new Smarty_Variable(true, null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, 'continueok', 0);?>

        <?php } elseif ($_smarty_tpl->tpl_vars['status']->value == "unavailable") {?>

            <div class="domain-checker-result-headline domain-checker-unavailable">
                <?php echo WHMCS\Smarty::sprintf2Modifier($_smarty_tpl->tpl_vars['LANG']->value['cartdomaintaken'],$_smarty_tpl->tpl_vars['domain']->value);?>

            </div>

        <?php }?>

    <?php } elseif ($_smarty_tpl->tpl_vars['checktype']->value == "transfer" && $_smarty_tpl->tpl_vars['transferenabled']->value) {?>

        <input type="hidden" name="domainoption" value="transfer" />

        <?php if ($_smarty_tpl->tpl_vars['status']->value == "available") {?>

            <div class="domain-checker-result-headline domain-checker-unavailable">
                <?php echo WHMCS\Smarty::sprintf2Modifier($_smarty_tpl->tpl_vars['LANG']->value['carttransfernotregistered'],$_smarty_tpl->tpl_vars['domain']->value);?>

            </div>
            <p class="text-center"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['tryRegisteringInstead'];?>
</p>

        <?php } elseif ($_smarty_tpl->tpl_vars['status']->value == "unavailable" || $_smarty_tpl->tpl_vars['status']->value == "error") {?>

            <div class="domain-checker-result-headline domain-checker-available">
                <?php echo WHMCS\Smarty::sprintf2Modifier($_smarty_tpl->tpl_vars['LANG']->value['carttransferpossible'],$_smarty_tpl->tpl_vars['domain']->value,$_smarty_tpl->tpl_vars['transferprice']->value);?>

            </div>

            <input type="hidden" name="domains[]" value="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
" />
            <input type="hidden" name="domainsregperiod[<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['transferterm']->value;?>
" />

            <?php if (isset($_smarty_tpl->tpl_vars['continueok'])) {$_smarty_tpl->tpl_vars['continueok'] = clone $_smarty_tpl->tpl_vars['continueok'];
$_smarty_tpl->tpl_vars['continueok']->value = true; $_smarty_tpl->tpl_vars['continueok']->nocache = null;
} else $_smarty_tpl->tpl_vars['continueok'] = new Smarty_Variable(true, null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, 'continueok', 0);?>

        <?php }?>

    <?php } elseif ($_smarty_tpl->tpl_vars['checktype']->value == "owndomain" || $_smarty_tpl->tpl_vars['checktype']->value == "subdomain") {?>

        <input type="hidden" name="domainoption" value="<?php echo $_smarty_tpl->tpl_vars['checktype']->value;?>
" />
        <input type="hidden" name="sld" value="<?php echo $_smarty_tpl->tpl_vars['sld']->value;?>
" />
        <input type="hidden" name="tld" value="<?php echo $_smarty_tpl->tpl_vars['tld']->value;?>
" />
        <?php echo '<script'; ?>
 language="javascript">
            domainGotoNextStep();
        <?php echo '</script'; ?>
>

    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['searchResults']->value['suggestions']) {?>

        <div class="sub-heading">
            <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['cartotherdomainsuggestions'];?>
</span>
        </div>

        <div class="row domain-suggestions">
            <?php
$_from = $_smarty_tpl->tpl_vars['searchResults']->value['suggestions'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_result_1_saved_item = isset($_smarty_tpl->tpl_vars['result']) ? $_smarty_tpl->tpl_vars['result'] : false;
$__foreach_result_1_saved_key = isset($_smarty_tpl->tpl_vars['num']) ? $_smarty_tpl->tpl_vars['num'] : false;
$_smarty_tpl->tpl_vars['result'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['num'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['result']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['result']->value) {
$_smarty_tpl->tpl_vars['result']->_loop = true;
$__foreach_result_1_saved_local_item = $_smarty_tpl->tpl_vars['result'];
?>
                <div class="col-sm-6 margin-bottom-5">
                    <input type="hidden" name="domainsregperiod[<?php echo $_smarty_tpl->tpl_vars['result']->value['domainName'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['shortestPeriod']['period'];?>
" />
                    <label>
                        <input type="checkbox" name="domains[]" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['domainName'];?>
" id="domainSuggestion<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
" class="suggested-domains" />
                        <?php echo $_smarty_tpl->tpl_vars['result']->value['domainName'];?>

                    </label>
                    <div class="pull-right">
                        <?php if (count($_smarty_tpl->tpl_vars['result']->value['pricing']) > 1) {?>
                            <div class="btn-group domain-suggestion-pricing">
                        <?php }?>
                        <button type="button" class="btn btn-default btn-sm" onclick="selectDomainPricing('<?php echo $_smarty_tpl->tpl_vars['result']->value['domainName'];?>
', '<?php echo $_smarty_tpl->tpl_vars['result']->value['shortestPeriod']['register'];?>
', <?php echo $_smarty_tpl->tpl_vars['result']->value['shortestPeriod']['period'];?>
, '<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderyears'];?>
', '<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
')">
                            <span name="<?php echo $_smarty_tpl->tpl_vars['result']->value['domainName'];?>
-selected-price">
                                <b class="glyphicon glyphicon-shopping-cart"></b>
                                <?php echo $_smarty_tpl->tpl_vars['result']->value['shortestPeriod']['period'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderyears'];?>
 @ <?php echo $_smarty_tpl->tpl_vars['result']->value['shortestPeriod']['register'];?>

                            </span>
                        </button>
                        <?php if (count($_smarty_tpl->tpl_vars['result']->value['pricing']) > 1) {?>
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle additional-options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <b class="caret"></b>
                                <span class="sr-only">
                                    <?php echo WHMCS\Smarty::langFunction(array('key'=>"domainChecker.additionalPricingOptions",'domain'=>$_smarty_tpl->tpl_vars['result']->value['domainName']),$_smarty_tpl);?>

                                </span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <?php
$_from = $_smarty_tpl->tpl_vars['result']->value['pricing'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_price_2_saved_item = isset($_smarty_tpl->tpl_vars['price']) ? $_smarty_tpl->tpl_vars['price'] : false;
$__foreach_price_2_saved_key = isset($_smarty_tpl->tpl_vars['years']) ? $_smarty_tpl->tpl_vars['years'] : false;
$_smarty_tpl->tpl_vars['price'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['years'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['price']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['years']->value => $_smarty_tpl->tpl_vars['price']->value) {
$_smarty_tpl->tpl_vars['price']->_loop = true;
$__foreach_price_2_saved_local_item = $_smarty_tpl->tpl_vars['price'];
?>
                                    <li>
                                        <a href="#" onclick="selectDomainPricing('<?php echo $_smarty_tpl->tpl_vars['result']->value['domainName'];?>
', '<?php echo $_smarty_tpl->tpl_vars['price']->value['register'];?>
', <?php echo $_smarty_tpl->tpl_vars['years']->value;?>
, '<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderyears'];?>
', '<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
');return false;">
                                            <b class="glyphicon glyphicon-shopping-cart"></b>
                                            <?php echo $_smarty_tpl->tpl_vars['years']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderyears'];?>
 @ <?php echo $_smarty_tpl->tpl_vars['price']->value['register'];?>

                                        </a>
                                    </li>
                                <?php
$_smarty_tpl->tpl_vars['price'] = $__foreach_price_2_saved_local_item;
}
if ($__foreach_price_2_saved_item) {
$_smarty_tpl->tpl_vars['price'] = $__foreach_price_2_saved_item;
}
if ($__foreach_price_2_saved_key) {
$_smarty_tpl->tpl_vars['years'] = $__foreach_price_2_saved_key;
}
?>
                            </ul>
                        </div>
                        <?php }?>
                    </div>
                </div>
            <?php
$_smarty_tpl->tpl_vars['result'] = $__foreach_result_1_saved_local_item;
}
if ($__foreach_result_1_saved_item) {
$_smarty_tpl->tpl_vars['result'] = $__foreach_result_1_saved_item;
}
if ($__foreach_result_1_saved_key) {
$_smarty_tpl->tpl_vars['num'] = $__foreach_result_1_saved_key;
}
?>
        </div>

        <?php if (isset($_smarty_tpl->tpl_vars['continueok'])) {$_smarty_tpl->tpl_vars['continueok'] = clone $_smarty_tpl->tpl_vars['continueok'];
$_smarty_tpl->tpl_vars['continueok']->value = true; $_smarty_tpl->tpl_vars['continueok']->nocache = null;
} else $_smarty_tpl->tpl_vars['continueok'] = new Smarty_Variable(true, null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, 'continueok', 0);?>

    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['continueok']->value) {?>
        <div class="alert alert-info info-text-sm">
            <i class="fa fa-info-circle"></i>
            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['domainAvailabilityCached'];?>

        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['continue'];?>

                &nbsp;<i class="fa fa-arrow-circle-right"></i>
            </button>
        </div>
    <?php }?>

<?php }?>

<?php echo '<script'; ?>
>
    jQuery('input.suggested-domains').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
        increaseArea: '20%'
    });
<?php echo '</script'; ?>
>
<?php }
}
