<?php
/* Smarty version 3.1.29, created on 2017-12-25 10:32:19
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/NeWorld/whmcs-header.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a40d3b3e83f58_04256868',
  'file_dependency' => 
  array (
    '00894da509c5d4179d4b7f7354dba8d04ef3baff' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/NeWorld/whmcs-header.tpl',
      1 => 1512474175,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a40d3b3e83f58_04256868 ($_smarty_tpl) {
?>
<div class="view">
	<a class="left-menu-toggle">
		<span class="pane"></span>
		<span class="pane"></span>
		<span class="pane"></span>
	</a>
	<div class="left-menu">
		<header class="header">
			<a class="navbar-brand" href="./index.php" title="<?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
</a>
		</header>
		<div class="left-menu-wrap">
			<section class="menu">
				<ul>
			        <li class="item <?php if ($_smarty_tpl->tpl_vars['templatefile']->value == 'clientareahome') {?>active<?php }?>">
			        	<a href="clientarea.php"><i class="alico icon-menu"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareatitle'];?>
</a>
			        </li>
				    <?php if ($_smarty_tpl->tpl_vars['registerdomainenabled']->value || $_smarty_tpl->tpl_vars['transferdomainenabled']->value) {?>
			        <li class="item <?php if ($_smarty_tpl->tpl_vars['templatefile']->value == 'clientareadomains') {?> active<?php }?>">
			            <a href="javascript:;"><i class="alico icon-yuming"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navdomains'];?>
<span class="fa fa-caret-down"></span>
			        	</a>
			            <ul>
							<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>
			                <li><a href="clientarea.php?action=domains"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareanavdomains'];?>
</a></li>
			                <li><a href="cart.php?gid=renewals"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navrenewdomains'];?>
</a></li>
							<?php }?>
			                <?php if ($_smarty_tpl->tpl_vars['condlinks']->value['domainreg']) {?>
			                <li><a href="cart.php?a=add&domain=register"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navregisterdomain'];?>
</a></li>
			                <?php }?>
			                <?php if ($_smarty_tpl->tpl_vars['condlinks']->value['domaintrans']) {?>
			                <li><a href="cart.php?a=add&domain=transfer"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navtransferdomain'];?>
</a></li>
			                <?php }?>
			                <?php if ($_smarty_tpl->tpl_vars['enomnewtldsenabled']->value) {?>
			                <li><a href="<?php echo $_smarty_tpl->tpl_vars['enomnewtldslink']->value;?>
">Preregister New TLDs</a></li>
			                <?php }?>
			                <li><a href="domainchecker.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navwhoislookup'];?>
</a></li>
			            </ul>
			        </li>
			        <?php }?>
			        <li class="item <?php if ($_smarty_tpl->tpl_vars['templatefile']->value == 'clientareaproducts' || $_smarty_tpl->tpl_vars['templatefile']->value == 'clientareaproductdetails') {?> active<?php }?>">
			            <a href="javascript:;"><i class="alico icon-ecs"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navservices'];?>
<span class="fa fa-caret-down"></span></a>
			            <ul>
							<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>
			                <li><a href="clientarea.php?action=services"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareanavservices'];?>
</a></li>
			                <?php }?>
			                <li><a href="cart.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navservicesorder'];?>
</a></li>
			                <li><a href="cart.php?gid=addons"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaviewaddons'];?>
</a></li>
			            </ul>
			        </li>
					<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>
			        <li class="item <?php if ($_smarty_tpl->tpl_vars['templatefile']->value == 'clientareainvoices' || $_smarty_tpl->tpl_vars['templatefile']->value == 'clientareaquotes' || $_smarty_tpl->tpl_vars['templatefile']->value == 'clientareacreditcard' || $_smarty_tpl->tpl_vars['templatefile']->value == 'clientareaaddfunds' || $_smarty_tpl->tpl_vars['templatefile']->value == 'masspay') {?> active<?php }?>">
			            <a href="javascript:;"><i class="alico icon-expense"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navbilling'];?>
<span class="fa fa-caret-down"></span></a>
			            <ul>
			                <li><a href="clientarea.php?action=invoices"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['invoices'];?>
</a></li>
			                <li><a href="clientarea.php?action=quotes"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['quotestitle'];?>
</a></li>
			                <?php if ($_smarty_tpl->tpl_vars['condlinks']->value['addfunds']) {?>
			                <li><a href="clientarea.php?action=addfunds"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['addfunds'];?>
</a></li>
			                <?php }?>
			                <?php if ($_smarty_tpl->tpl_vars['condlinks']->value['masspay']) {?>
			                <li><a href="clientarea.php?action=masspay&all=true"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['masspaytitle'];?>
</a></li>
			                <?php }?>
			                <?php if ($_smarty_tpl->tpl_vars['condlinks']->value['updatecc']) {?>
			                <li><a href="clientarea.php?action=creditcard"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navmanagecc'];?>
</a></li>
			                <?php }?>
			            </ul>
			        </li>
			        <li class="item <?php if ($_smarty_tpl->tpl_vars['templatefile']->value == 'supportticketsubmit-stepone' || $_smarty_tpl->tpl_vars['templatefile']->value == 'supportticketsubmit-steptwo' || $_smarty_tpl->tpl_vars['templatefile']->value == 'supportticketsubmit-kbsuggestions' || $_smarty_tpl->tpl_vars['templatefile']->value == 'supportticketsubmit-customfields' || $_smarty_tpl->tpl_vars['templatefile']->value == 'supportticketslist' || $_smarty_tpl->tpl_vars['templatefile']->value == 'knowledgebase') {?> active<?php }?>">
			            <a href="javascript:;"><i class="alico icon-pen"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navsupport'];?>
<span class="fa fa-caret-down"></span></a>
			            <ul>
			        		<li><a href="submitticket.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navopenticket'];?>
</a></li>
			                <li><a href="supporttickets.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navtickets'];?>
</a></li>
			                <li><a href="knowledgebase.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['knowledgebasetitle'];?>
</a></li>
			            </ul>
			        </li>
			        <li class="item <?php if ($_smarty_tpl->tpl_vars['templatefile']->value == 'clientareadetails' || $_smarty_tpl->tpl_vars['templatefile']->value == 'clientareacontacts' || $_smarty_tpl->tpl_vars['templatefile']->value == 'clientareachangepw' || $_smarty_tpl->tpl_vars['templatefile']->value == 'clientareaemails') {?> active<?php }?>">
			            <a href="javascript:;"><i class="alico icon-account-2"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['account'];?>
<span class="fa fa-caret-down"></span>
				        </a>
			            <ul>
			                <li><a href="clientarea.php?action=details"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareanavdetails'];?>
</a></li>
			                <li><a href="clientarea.php?action=contacts"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareanavcontacts'];?>
</a></li>			                							<li><a href="clientarea.php?action=changepw"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareanavchangepw'];?>
</a></li>
							<li><a href="clientarea.php?action=emails"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navemailssent'];?>
</a></li>
			            </ul>
			        </li>
			        <?php }?>
			        <li class="item <?php if ($_smarty_tpl->tpl_vars['templatefile']->value == 'announcements') {?>active<?php }?>">
			        	<a href="announcements.php">
				        	<i class="fa fa-bell"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['announcementstitle'];?>

				        </a>
			        </li>
					<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>
			        <li class="item <?php if ($_smarty_tpl->tpl_vars['templatefile']->value == 'downloads') {?>active<?php }?>">
			        	<a href="downloads.php">
				        	<i class="fa fa-cloud-download"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadstitle'];?>

				        </a>
			        </li>
			        <?php if ($_smarty_tpl->tpl_vars['condlinks']->value['networkstatus']) {?>
			        <li class="item <?php if ($_smarty_tpl->tpl_vars['templatefile']->value == 'serverstatus') {?>active<?php }?>">
			        	<a href="serverstatus.php">
				        	<i class="fa fa-dot-circle-o"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['networkstatustitle'];?>

				        </a>
			        </li>
			        <?php }?>
			        <?php if ($_smarty_tpl->tpl_vars['condlinks']->value['affiliates']) {?>
			        <li class="item <?php if ($_smarty_tpl->tpl_vars['templatefile']->value == 'affiliates') {?>active<?php }?>">
			        	<a href="affiliates.php">
			        		<i class="fa fa-universal-access"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['affiliatestitle'];?>

			        	</a>
			        </li>
			        <?php }?>
			        <?php }?>
				</ul>
			</section>
		</div>
		<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>
		<section class="account account button-more button-more--noresponsive">
			<div class="center ng-binding">
				<div class="logout"><a href="logout.php" title="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['logouttitle'];?>
"><i class="md md-settings-power"></i></a>
				</div>
				<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['lastname'];
echo $_smarty_tpl->tpl_vars['clientsdetails']->value['firstname'];?>

				<span class="label"><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['companyname'];?>
</span>
			</div>
		</section>
		<?php }?>
	</div>
	<div class="right-content"><?php }
}
