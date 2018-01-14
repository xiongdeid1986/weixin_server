<?php
/* Smarty version 3.1.29, created on 2017-12-25 10:32:19
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/clientareahome.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a40d3b3f33233_41554305',
  'file_dependency' => 
  array (
    '885243a5848a87dbaf7c4197d63cfbd2a415827d' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/clientareahome.tpl',
      1 => 1512474173,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
  'tpl_function' => 
  array (
    'outputHomePanels' => 
    array (
      'called_functions' => 
      array (
      ),
      'compiled_filepath' => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates_c/885243a5848a87dbaf7c4197d63cfbd2a415827d_0.file.clientareahome.tpl.php',
      'uid' => '885243a5848a87dbaf7c4197d63cfbd2a415827d',
      'call_name' => 'smarty_template_function_outputHomePanels_8190796755a40d3b3ee8752_16854490',
    ),
  ),
),false)) {
function content_5a40d3b3f33233_41554305 ($_smarty_tpl) {
?>
<style>
#main-body {
	min-height: 180px;
	border-radius: 4px;
	border-color: #ECECEC;
    border-bottom: 1px solid #ECECEC;
}
.content2 {
    margin: 25px 27px 0;
}
.client-home-panels .panel-default {
	border-radius: 4px;
	box-shadow: none;
    border-bottom: 1px solid #E7E9ED;
}
.client-home-panels .panel > .panel-heading {
	background-image: none;
	background-color: #F9F9F9;
}
.client-home-panels .panel .panel-title {
	color: #333;
	font-size: 14px;
	line-height: 26px;
}
.client-home-panels .panel > .panel-footer {
	display: none;
}
.list-group {
	margin-bottom: 0;
}
@media (max-width: 991px) {
	#main-body {
		min-height: 360px;
	}
	.home-section-user {
    	height: 360px;
    }
	.home-section-user .user-part-tickets {
	    background-color: #F2F6FA;
	    margin: 0 -10px;
	    min-height: 179px;
	    padding: 30px 30px 0;
	    border-radius: 0 0 3px;
	}
}
@media(max-width:767px) {
	.home-section-user .user-part-tickets {
	    background-color: #F9FAFC;
	    margin: 0 -10px;
	    min-height: 179px;
	}
}
</style>

	<div class="home-section-user">
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="user-part-header">
					<a class="user-header ng-scope" href="clientarea.php?action=details">
						<img width="50" height="50" src=".//gravatar.neworld.org/avatar/<?php echo md5($_smarty_tpl->tpl_vars['clientsdetails']->value['email']);?>
?s=100&d=./templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/img/default_family.jpg" alt="" />
					</a>
					<div class="user-name">
						<?php if ($_smarty_tpl->tpl_vars['clientsdetails']->value['firstname'] != '' && $_smarty_tpl->tpl_vars['clientsdetails']->value['lastname'] != '' && $_smarty_tpl->tpl_vars['clientsdetails']->value['lastname'] != '姓' && $_smarty_tpl->tpl_vars['clientsdetails']->value['firstname'] != '名') {?>
						<span class="text-muted">Hi,</span> <a class="text-primary" href="clientarea.php?action=details"><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['lastname'];
echo $_smarty_tpl->tpl_vars['clientsdetails']->value['firstname'];?>
</a>
						<?php } else { ?>
						<a class="text-primary" href="clientarea.php?action=details"><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['email'];?>
</a>
						<?php }?>
					</div>
					<div class="user-bound ng-scope">
						
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="user-part-account ng-scope">
					<div class="user-body-title">
						<?php echo $_smarty_tpl->tpl_vars['LANG']->value['availcreditbal'];?>
<span class="home-colon">:</span>
					</div>
					<div class="user-body-main">
						<div class="user-balance">
							<span class="ng-binding mymoeny" data-money="<?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['creditbalance'];?>
">0</span><span class="user-balance-small ng-binding">.00</span><span class="user-small suffix">元</span>
						</div>
					</div>
					<div>
						<?php if ($_smarty_tpl->tpl_vars['condlinks']->value['addfunds']) {?>
						<a class="btn btn-sm btn-success margin-right-2 ng-binding" href="clientarea.php?action=addfunds"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['addfunds'];?>
</a>
					    <?php }?>
						<div class="inline-block">
							<a class="ng-binding hide" href="">费用中心</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="user-part-todo ng-scope">
					<div class="user-body-title">
						<?php echo $_smarty_tpl->tpl_vars['LANG']->value['navinvoices'];?>
<span class="home-colon">:</span>
					</div>
					<div class="user-body-main">
						<div class="user-renew">
							<span class="ng-binding"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['numunpaidinvoices'];?>
</span>
							<a class="user-small" href="clientarea.php?action=masspay&all=true">续费待办</a>
						</div>
					</div>
					<div>
						<div class="user-opt inline-block">
							<a href="clientarea.php?action=services"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navservices'];?>
</a>
							<span class="margin-left-1 ng-binding"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['productsnumactive'];?>
</span>
							<?php if ($_smarty_tpl->tpl_vars['registerdomainenabled']->value || $_smarty_tpl->tpl_vars['transferdomainenabled']->value) {?>
							<span class="user-opt-gap"></span>
							<a href="clientarea.php?action=domains"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navdomains'];?>
</a>
							<span class="margin-left-1 ng-binding"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['numactivedomains'];?>
</span>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="user-part-tickets ng-scope">
					<div class="user-body-title">
						<?php echo $_smarty_tpl->tpl_vars['LANG']->value['navtickets'];?>
<span class="home-colon">:</span>
					</div>
					<div class="user-body-main">
						<div class="user-renew">
							<span class="ng-binding"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['numactivetickets'];?>
</span>
							<a class="user-small" href="supporttickets.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navtickets'];?>
</a>
						</div>
					</div>
					<div>
						<div class="user-opt inline-block">
							<?php if ($_smarty_tpl->tpl_vars['condlinks']->value['affiliates']) {?>
							<a href="affiliates.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['affiliatestitle'];?>
</a>
							<span class="user-opt-gap hidden-xs"></span>
							<?php }?>
							<a href="clientarea.php?action=quotes" class="hidden-xs"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['quotes'];?>
</a>
							<span class="margin-left-1 ng-binding hidden-xs"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['numquotes'];?>
</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="content2">

<?php
$_from = $_smarty_tpl->tpl_vars['addons_html']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_addon_html_0_saved_item = isset($_smarty_tpl->tpl_vars['addon_html']) ? $_smarty_tpl->tpl_vars['addon_html'] : false;
$_smarty_tpl->tpl_vars['addon_html'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['addon_html']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['addon_html']->value) {
$_smarty_tpl->tpl_vars['addon_html']->_loop = true;
$__foreach_addon_html_0_saved_local_item = $_smarty_tpl->tpl_vars['addon_html'];
?>
    <div>
        <?php echo $_smarty_tpl->tpl_vars['addon_html']->value;?>

    </div>
<?php
$_smarty_tpl->tpl_vars['addon_html'] = $__foreach_addon_html_0_saved_local_item;
}
if ($__foreach_addon_html_0_saved_item) {
$_smarty_tpl->tpl_vars['addon_html'] = $__foreach_addon_html_0_saved_item;
}
?>

<div class="client-home-panels">
    <div class="row">
        <div class="col-sm-6">

            

            <?php
$_from = $_smarty_tpl->tpl_vars['panels']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_2_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['item']->iteration=0;
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$_smarty_tpl->tpl_vars['item']->iteration++;
$__foreach_item_2_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
                <?php if ((1 & $_smarty_tpl->tpl_vars['item']->iteration)) {?>
                    <?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'outputHomePanels', array(), true);?>

                <?php }?>
            <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved_local_item;
}
if ($__foreach_item_2_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved_item;
}
?>

        </div>
        <div class="col-sm-6">

            <?php
$_from = $_smarty_tpl->tpl_vars['panels']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_3_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['item']->iteration=0;
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$_smarty_tpl->tpl_vars['item']->iteration++;
$__foreach_item_3_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
                <?php if (!(1 & $_smarty_tpl->tpl_vars['item']->iteration)) {?>
                    <?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'outputHomePanels', array(), true);?>

                <?php }?>
            <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_3_saved_local_item;
}
if ($__foreach_item_3_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_3_saved_item;
}
?>

        </div>
    </div>
</div>
<?php }
/* smarty_template_function_outputHomePanels_8190796755a40d3b3ee8752_16854490 */
if (!function_exists('smarty_template_function_outputHomePanels_8190796755a40d3b3ee8752_16854490')) {
function smarty_template_function_outputHomePanels_8190796755a40d3b3ee8752_16854490($_smarty_tpl,$params) {
$saved_tpl_vars = $_smarty_tpl->tpl_vars;
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value);
}?>
                <div menuItemName="<?php echo $_smarty_tpl->tpl_vars['item']->value->getName();?>
" class="panel panel-default"<?php if ($_smarty_tpl->tpl_vars['item']->value->getAttribute('id')) {?> id="<?php echo $_smarty_tpl->tpl_vars['item']->value->getAttribute('id');?>
"<?php }?>>
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <?php if ($_smarty_tpl->tpl_vars['item']->value->getExtra('btn-link') && $_smarty_tpl->tpl_vars['item']->value->getExtra('btn-text')) {?>
                                <div class="pull-right">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->getExtra('btn-link');?>
" class="btn bg-color-<?php echo $_smarty_tpl->tpl_vars['item']->value->getExtra('color');?>
 btn-xs">
                                        <?php if ($_smarty_tpl->tpl_vars['item']->value->getExtra('btn-icon')) {?><i class="fa <?php echo $_smarty_tpl->tpl_vars['item']->value->getExtra('btn-icon');?>
"></i><?php }?>
                                        <?php echo $_smarty_tpl->tpl_vars['item']->value->getExtra('btn-text');?>

                                    </a>
                                </div>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['item']->value->hasIcon()) {?><i class="<?php echo $_smarty_tpl->tpl_vars['item']->value->getIcon();?>
"></i>&nbsp;<?php }?>
                            <?php echo $_smarty_tpl->tpl_vars['item']->value->getLabel();?>

                            <?php if ($_smarty_tpl->tpl_vars['item']->value->hasBadge()) {?>&nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['item']->value->getBadge();?>
</span><?php }?>
                        </h3>
                    </div>
                    <div class="panel-body">
                    <?php if ($_smarty_tpl->tpl_vars['item']->value->hasBodyHtml()) {?>
                        <?php echo $_smarty_tpl->tpl_vars['item']->value->getBodyHtml();?>

                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['item']->value->hasChildren()) {?>
                        <div class="list-group<?php if ($_smarty_tpl->tpl_vars['item']->value->getChildrenAttribute('class')) {?> <?php echo $_smarty_tpl->tpl_vars['item']->value->getChildrenAttribute('class');
}?>">
                            <?php
$_from = $_smarty_tpl->tpl_vars['item']->value->getChildren();
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_childItem_1_saved_item = isset($_smarty_tpl->tpl_vars['childItem']) ? $_smarty_tpl->tpl_vars['childItem'] : false;
$_smarty_tpl->tpl_vars['childItem'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['childItem']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['childItem']->value) {
$_smarty_tpl->tpl_vars['childItem']->_loop = true;
$__foreach_childItem_1_saved_local_item = $_smarty_tpl->tpl_vars['childItem'];
?>
                                <?php if ($_smarty_tpl->tpl_vars['childItem']->value->getUri()) {?>
                                    <a menuItemName="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getName();?>
" href="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getUri();?>
" class="list-group-item<?php if ($_smarty_tpl->tpl_vars['childItem']->value->getClass()) {?> <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getClass();
}
if ($_smarty_tpl->tpl_vars['childItem']->value->isCurrent()) {?> active<?php }?>"<?php if ($_smarty_tpl->tpl_vars['childItem']->value->getAttribute('dataToggleTab')) {?> data-toggle="tab"<?php }
if ($_smarty_tpl->tpl_vars['childItem']->value->getAttribute('target')) {?> target="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getAttribute('target');?>
"<?php }?> id="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getId();?>
">
                                        <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasIcon()) {?><i class="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getIcon();?>
"></i>&nbsp;<?php }?>
                                        <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getLabel();?>

                                        <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasBadge()) {?>&nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['childItem']->value->getBadge();?>
</span><?php }?>
                                    </a>
                                <?php } else { ?>
                                    <div menuItemName="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getName();?>
" class="list-group-item<?php if ($_smarty_tpl->tpl_vars['childItem']->value->getClass()) {?> <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getClass();
}?>" id="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getId();?>
">
                                        <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasIcon()) {?><i class="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getIcon();?>
"></i>&nbsp;<?php }?>
                                        <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getLabel();?>

                                        <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasBadge()) {?>&nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['childItem']->value->getBadge();?>
</span><?php }?>
                                    </div>
                                <?php }?>
                            <?php
$_smarty_tpl->tpl_vars['childItem'] = $__foreach_childItem_1_saved_local_item;
}
if ($__foreach_childItem_1_saved_item) {
$_smarty_tpl->tpl_vars['childItem'] = $__foreach_childItem_1_saved_item;
}
?>
                        </div>
                    <?php }?>
                    </div>
                    <div class="panel-footer">
                        <?php if ($_smarty_tpl->tpl_vars['item']->value->hasFooterHtml()) {?>
                            <?php echo $_smarty_tpl->tpl_vars['item']->value->getFooterHtml();?>

                        <?php }?>
                    </div>
                </div>
            <?php foreach (Smarty::$global_tpl_vars as $key => $value){
if (!isset($_smarty_tpl->tpl_vars[$key]) || $_smarty_tpl->tpl_vars[$key] === $value) $saved_tpl_vars[$key] = $value;
}
$_smarty_tpl->tpl_vars = $saved_tpl_vars;
}
}
/*/ smarty_template_function_outputHomePanels_8190796755a40d3b3ee8752_16854490 */
}
