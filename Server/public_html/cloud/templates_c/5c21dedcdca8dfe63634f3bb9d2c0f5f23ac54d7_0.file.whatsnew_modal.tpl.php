<?php
/* Smarty version 3.1.29, created on 2017-12-05 07:31:19
  from "/home/admin/web/cloud.ddweb.com.cn/public_html/admin/templates/whatsnew_modal.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a264b47c54911_46216627',
  'file_dependency' => 
  array (
    '5c21dedcdca8dfe63634f3bb9d2c0f5f23ac54d7' => 
    array (
      0 => '/home/admin/web/cloud.ddweb.com.cn/public_html/admin/templates/whatsnew_modal.tpl',
      1 => 1510648882,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a264b47c54911_46216627 ($_smarty_tpl) {
echo '<script'; ?>
>
    $(document).ready(function () {
        $('.feature-highlights-carousel').owlCarousel({
            items: 1,
            loop: true,
            center: true,
            mouseDrag: true,
            touchDrag: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true
        });

        setTimeout(function() { $('.feature-highlights-carousel .feature').removeClass('hidden'); }, 500);

        var dismissedForAdmin = parseInt('<?php echo $_smarty_tpl->tpl_vars['dismissedForAdmin']->value;?>
');

        if (dismissedForAdmin) {
            $('#cbFeatureHighlightsDismissForVersion').attr('checked', true);
        }
    });
<?php echo '</script'; ?>
>

<div class="feature-highlights-content">
    <div class="feature-highlights-carousel owl-carousel owl-theme">
        <?php
$_from = $_smarty_tpl->tpl_vars['features']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_feature_0_saved_item = isset($_smarty_tpl->tpl_vars['feature']) ? $_smarty_tpl->tpl_vars['feature'] : false;
$__foreach_feature_0_saved_key = isset($_smarty_tpl->tpl_vars['featureId']) ? $_smarty_tpl->tpl_vars['featureId'] : false;
$_smarty_tpl->tpl_vars['feature'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['featureId'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['feature']->iteration=0;
$_smarty_tpl->tpl_vars['feature']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['featureId']->value => $_smarty_tpl->tpl_vars['feature']->value) {
$_smarty_tpl->tpl_vars['feature']->_loop = true;
$_smarty_tpl->tpl_vars['feature']->iteration++;
$__foreach_feature_0_saved_local_item = $_smarty_tpl->tpl_vars['feature'];
?>
            <div class="feature<?php if ($_smarty_tpl->tpl_vars['featureId']->value > 0) {?> hidden<?php }?>" id="featureHighlight<?php echo $_smarty_tpl->tpl_vars['featureId']->value;?>
">
                <div class="icon-image">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['feature']->value->getIcon();?>
">
                </div>
                <h1<?php if ($_smarty_tpl->tpl_vars['feature']->value->hasHeadlineImage()) {?> class="with-headline"<?php }?>><?php echo $_smarty_tpl->tpl_vars['feature']->value->getTitle();?>
</h1>
                <?php if ($_smarty_tpl->tpl_vars['feature']->value->hasHeadlineImage()) {?>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['feature']->value->getHeadlineImage();?>
" class="headline-image">
                <?php }?>
                <h2><?php echo $_smarty_tpl->tpl_vars['feature']->value->getSubtitle();?>
</h2>
                <div class="feature-text">
                    <?php echo $_smarty_tpl->tpl_vars['feature']->value->getDescription();?>

                </div>
                <div class="action-btns">
                    <div class="row">
                        <?php if ($_smarty_tpl->tpl_vars['feature']->value->hasBtn1Link()) {?>
                            <div class="col-sm-6<?php if (!$_smarty_tpl->tpl_vars['feature']->value->hasBtn2Link()) {?> col-sm-offset-3<?php }?>">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['feature']->value->getBtn1Link();?>
" class="btn btn-block btn-action-1" target="_blank" data-link="1" data-link-title="<?php echo $_smarty_tpl->tpl_vars['feature']->iteration;?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['feature']->value->getBtn1Label();?>

                                </a>
                            </div>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['feature']->value->hasBtn2Link()) {?>
                            <div class="col-sm-6">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['feature']->value->getBtn2Link();?>
" class="btn btn-block btn-action-2" target="_blank" data-link="2" data-link-title="<?php echo $_smarty_tpl->tpl_vars['feature']->iteration;?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['feature']->value->getBtn2Label();?>

                                </a>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        <?php
$_smarty_tpl->tpl_vars['feature'] = $__foreach_feature_0_saved_local_item;
}
if ($__foreach_feature_0_saved_item) {
$_smarty_tpl->tpl_vars['feature'] = $__foreach_feature_0_saved_item;
}
if ($__foreach_feature_0_saved_key) {
$_smarty_tpl->tpl_vars['featureId'] = $__foreach_feature_0_saved_key;
}
?>
    </div>
</div>

<label class="checkbox-inline dismiss">
    <input type="checkbox" id="cbFeatureHighlightsDismissForVersion">
    Don't show this again until next update
</label>
<?php }
}
