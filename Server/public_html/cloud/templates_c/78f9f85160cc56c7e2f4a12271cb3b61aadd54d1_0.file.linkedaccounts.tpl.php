<?php
/* Smarty version 3.1.29, created on 2017-12-05 08:10:47
  from "/home/admin/web/cloud.ddweb.com.cn/public_html/templates/six/includes/linkedaccounts.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a265487675399_89765939',
  'file_dependency' => 
  array (
    '78f9f85160cc56c7e2f4a12271cb3b61aadd54d1' => 
    array (
      0 => '/home/admin/web/cloud.ddweb.com.cn/public_html/templates/six/includes/linkedaccounts.tpl',
      1 => 1510648882,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a265487675399_89765939 ($_smarty_tpl) {
if (($_smarty_tpl->tpl_vars['linkableProviders']->value || $_smarty_tpl->tpl_vars['hasLinkedProvidersEnabled']->value) && $_smarty_tpl->tpl_vars['linkContext']->value == 'linktable') {?>
    <table id="tableLinkedAccounts" class="table display data-driven"
           data-ajax-url="<?php echo $_smarty_tpl->tpl_vars['linkedAccountsUrl']->value;?>
"
           data-on-draw-rebind-confirmation="true"
           data-lang-empty-table="<?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.noLinkedAccounts'),$_smarty_tpl);?>
"
    >
        <thead>
        <tr class="text-center">
            <th><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.provider'),$_smarty_tpl);?>
</th>
            <th><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.name'),$_smarty_tpl);?>
</th>
            <th><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.emailAddress'),$_smarty_tpl);?>
</th>
            <th><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.actions'),$_smarty_tpl);?>
</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="4" class="text-center"><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.noLinkedAccounts'),$_smarty_tpl);?>
</td>
        </tr>
        </tbody>
    </table>
<?php } elseif ($_smarty_tpl->tpl_vars['linkableProviders']->value) {?>

    <div id="providerLinkingMessages" class="hidden">
        <p class="providerLinkingMsg-preLink-init_failed">
            <span class="provider-name"></span> <?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.unavailable'),$_smarty_tpl);?>

        </p>
        <p class="providerLinkingMsg-preLink-connect_error">
            <strong><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.error'),$_smarty_tpl);?>
</strong> <?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.connectError'),$_smarty_tpl);?>

        </p>
        <p class="providerLinkingMsg-preLink-complete_sign_in">
            <?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.completeSignIn'),$_smarty_tpl);?>

        </p>
        <p class="providerLinkingMsg-preLink-2fa_needed">
            <?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.redirecting'),$_smarty_tpl);?>

        </p>
        <p class="providerLinkingMsg-preLink-linking_complete">
            <strong><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.success'),$_smarty_tpl);?>
</strong> <?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.accountNowLinked'),$_smarty_tpl);?>

        </p>
        <p class="providerLinkingMsg-preLink-login_to_link-signin-required">
            <strong><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.linkInitiated'),$_smarty_tpl);?>
</strong> <?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.oneTimeAuthRequired'),$_smarty_tpl);?>

        </p>
        <p class="providerLinkingMsg-preLink-login_to_link-registration-required">
            <strong><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.linkInitiated'),$_smarty_tpl);?>
</strong> <?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.completeRegistrationForm'),$_smarty_tpl);?>

        </p>
        <p class="providerLinkingMsg-preLink-checkout-new">
            <strong><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.linkInitiated'),$_smarty_tpl);?>
</strong> <?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.completeNewAccountForm'),$_smarty_tpl);?>

        </p>
        <p class="providerLinkingMsg-preLink-other_user_exists">
            <strong><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.error'),$_smarty_tpl);?>
</strong> <?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.linkedToAnotherClient'),$_smarty_tpl);?>

        </p>
        <p class="providerLinkingMsg-preLink-already_linked">
            <strong><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.error'),$_smarty_tpl);?>
</strong> <?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.alreadyLinkedToYou'),$_smarty_tpl);?>

        </p>
        <p class="providerLinkingMsg-preLink-default">
            <strong><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.error'),$_smarty_tpl);?>
</strong> <?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.connectError'),$_smarty_tpl);?>

        </p>
    </div>

    <?php if ($_smarty_tpl->tpl_vars['linkContext']->value == 'registration') {?>
        <div class="sub-heading">
            <span><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.titleSignUpVerb'),$_smarty_tpl);?>
</span>
        </div>
    <?php } elseif ($_smarty_tpl->tpl_vars['linkContext']->value == 'checkout-existing') {?>
        <div class="sub-heading-borderless">
            <span><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.titleOr'),$_smarty_tpl);?>
</span>
        </div>
        <p class="small text-center text-muted"><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.saveTimeByLinking'),$_smarty_tpl);?>
</p>
    <?php } elseif ($_smarty_tpl->tpl_vars['linkContext']->value == 'checkout-new') {?>
        <div class="sub-heading">
            <span><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.titleSignUpVerb'),$_smarty_tpl);?>
</span>
        </div>
        <p class="small text-center text-muted"><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.saveTimeByLinking'),$_smarty_tpl);?>
</p>
    <?php } elseif ($_smarty_tpl->tpl_vars['linkContext']->value == 'clientsecurity') {?>
        <p><?php echo WHMCS\Smarty::langFunction(array('key'=>'remoteAuthn.mayHaveMultipleLinks'),$_smarty_tpl);?>
</p>
    <?php }?>

    <div class="providerPreLinking" data-link-context="<?php echo $_smarty_tpl->tpl_vars['linkContext']->value;?>
"
         data-hide-on-prelink=<?php if (in_array($_smarty_tpl->tpl_vars['linkContext']->value,array('clientsecurity','login'))) {?>0<?php } else { ?>1<?php }?>
         data-disable-on-prelink=0>
        <div class="social-signin-btns">
            <?php
$_from = $_smarty_tpl->tpl_vars['linkableProviders']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_provider_0_saved_item = isset($_smarty_tpl->tpl_vars['provider']) ? $_smarty_tpl->tpl_vars['provider'] : false;
$_smarty_tpl->tpl_vars['provider'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['provider']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['provider']->value) {
$_smarty_tpl->tpl_vars['provider']->_loop = true;
$__foreach_provider_0_saved_local_item = $_smarty_tpl->tpl_vars['provider'];
?>
                <?php if (in_array($_smarty_tpl->tpl_vars['linkContext']->value,array('checkout-existing'))) {?>
                    <?php echo $_smarty_tpl->tpl_vars['provider']->value['login_button'];?>

                <?php } else { ?>
                    <?php echo $_smarty_tpl->tpl_vars['provider']->value['code'];?>

                <?php }?>
            <?php
$_smarty_tpl->tpl_vars['provider'] = $__foreach_provider_0_saved_local_item;
}
if ($__foreach_provider_0_saved_item) {
$_smarty_tpl->tpl_vars['provider'] = $__foreach_provider_0_saved_item;
}
?>
        </div>
    </div>

    <?php if (!isset($_smarty_tpl->tpl_vars['customFeedback']->value) || !$_smarty_tpl->tpl_vars['customFeedback']->value) {?>
        <div class="providerLinkingFeedback"></div>
    <?php }?>

<?php }
}
}
