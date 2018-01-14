<?php
/* Smarty version 3.1.29, created on 2017-12-05 14:54:54
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/orderforms/NeWorld/order-top.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a26b33e062187_27736230',
  'file_dependency' => 
  array (
    'bf46cd7994607dbc97cbddcc0b2cb3ec4ac40f59' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/orderforms/NeWorld/order-top.tpl',
      1 => 1512474175,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a26b33e062187_27736230 ($_smarty_tpl) {
?>

	<section class="order-top">
		<div class="container">
			<ul class="row">
				<li class="col-xs-6 col-sm-3 <?php if ($_smarty_tpl->tpl_vars['filename']->value == "cart" && $_GET['a'] == '') {?>active<?php }?>">
					<a href="./cart.php">
						<img src="./templates/orderforms/<?php echo $_smarty_tpl->tpl_vars['carttpl']->value;?>
/img/review.svg" class="theme-gray size-md">
						<?php echo $_smarty_tpl->tpl_vars['LANG']->value['chooseproduct'];?>

			        </a>
				</li>
				<li class="col-xs-6 col-sm-3 <?php if ($_smarty_tpl->tpl_vars['filename']->value == "cart" && $_GET['a'] == "view") {?>active<?php }?>">
					<a href="./cart.php?a=view">
						<img src="./templates/orderforms/<?php echo $_smarty_tpl->tpl_vars['carttpl']->value;?>
/img/choose.svg" class="theme-gray size-md">
				        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['cartreviewcheckout'];?>

				    </a>
				</li>
				<li class="col-xs-6 col-sm-3 <?php if ($_smarty_tpl->tpl_vars['filename']->value == "cart" && $_GET['a'] == "checkout") {?>active<?php }?>">
					<a href="./cart.php?a=checkout">
						<img src="./templates/orderforms/<?php echo $_smarty_tpl->tpl_vars['carttpl']->value;?>
/img/checkout.svg" class="theme-gray size-md">
						<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['checkout'];?>

					</a>
				</li>
				<li class="col-xs-6 col-sm-3 <?php if ($_smarty_tpl->tpl_vars['filename']->value == "cart" && $_GET['a'] == "complete") {?>active<?php }?>">
					<a href="./cart.php?a=checkout">
						<img src="./templates/orderforms/<?php echo $_smarty_tpl->tpl_vars['carttpl']->value;?>
/img/confirm.svg" class="theme-gray size-md">
						<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderconfirmation'];?>

					</a>
				</li>
			</ul>
		</div>
	</section><?php }
}
