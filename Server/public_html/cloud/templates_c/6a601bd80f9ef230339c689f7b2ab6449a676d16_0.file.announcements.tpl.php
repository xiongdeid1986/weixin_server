<?php
/* Smarty version 3.1.29, created on 2017-12-28 15:26:34
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/announcements.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a450d2ab61391_21341377',
  'file_dependency' => 
  array (
    '6a601bd80f9ef230339c689f7b2ab6449a676d16' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/announcements.tpl',
      1 => 1512474173,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a450d2ab61391_21341377 ($_smarty_tpl) {
?>
<div class="container-hd">
	<?php echo $_smarty_tpl->tpl_vars['LANG']->value['announcementstitle'];?>

</div>
<?php if ($_smarty_tpl->tpl_vars['announcementsFbRecommend']->value) {?>
    <?php echo '<script'; ?>
>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/<?php echo $_smarty_tpl->tpl_vars['LANG']->value['locale'];?>
/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    <?php echo '</script'; ?>
>
<?php }
$_from = $_smarty_tpl->tpl_vars['announcements']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_announcement_0_saved_item = isset($_smarty_tpl->tpl_vars['announcement']) ? $_smarty_tpl->tpl_vars['announcement'] : false;
$_smarty_tpl->tpl_vars['announcement'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['announcement']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['announcement']->value) {
$_smarty_tpl->tpl_vars['announcement']->_loop = true;
$__foreach_announcement_0_saved_local_item = $_smarty_tpl->tpl_vars['announcement'];
?>

    <div class="announcement-single">

        <h2>
            <span>
                [<?php echo date("y-m-d",$_smarty_tpl->tpl_vars['announcement']->value['timestamp']);?>
]
            </span>
            <a href="<?php if ($_smarty_tpl->tpl_vars['seofriendlyurls']->value) {?>./announcements/<?php echo $_smarty_tpl->tpl_vars['announcement']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['announcement']->value['urlfriendlytitle'];?>
.html<?php } else {
echo $_SERVER['PHP_SELF'];?>
?id=<?php echo $_smarty_tpl->tpl_vars['announcement']->value['id'];
}?>"><?php echo $_smarty_tpl->tpl_vars['announcement']->value['title'];?>
</a>
        </h2>
        <p>
	        <?php if (strlen(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['announcement']->value['text'])) < 350) {?>
	        	<?php echo $_smarty_tpl->tpl_vars['announcement']->value['text'];?>

	        <?php } else { ?>
	        	<?php echo $_smarty_tpl->tpl_vars['announcement']->value['summary'];?>

			<?php }?>
		</p>
		<a href="<?php if ($_smarty_tpl->tpl_vars['seofriendlyurls']->value) {?>./announcements/<?php echo $_smarty_tpl->tpl_vars['announcement']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['announcement']->value['urlfriendlytitle'];?>
.html<?php } else {
echo $_SERVER['PHP_SELF'];?>
?id=<?php echo $_smarty_tpl->tpl_vars['announcement']->value['id'];
}?>" class="btn btn-sm"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['readmore'];?>
 &raquo;</a>

        <?php if ($_smarty_tpl->tpl_vars['announcementsFbRecommend']->value) {?>
            <div class="fb-like hidden-sm hidden-xs" data-layout="standard" data-href="./<?php if ($_smarty_tpl->tpl_vars['seofriendlyurls']->value) {?>announcements/<?php echo $_smarty_tpl->tpl_vars['announcement']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['announcement']->value['urlfriendlytitle'];?>
.html<?php } else { ?>announcements.php?id=<?php echo $_smarty_tpl->tpl_vars['announcement']->value['id'];
}?>" data-send="true" data-width="450" data-show-faces="true" data-action="recommend"></div>
            <div class="fb-like hidden-lg hidden-md" data-layout="button_count" data-href="./<?php if ($_smarty_tpl->tpl_vars['seofriendlyurls']->value) {?>announcements/<?php echo $_smarty_tpl->tpl_vars['announcement']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['announcement']->value['urlfriendlytitle'];?>
.html<?php } else { ?>announcements.php?id=<?php echo $_smarty_tpl->tpl_vars['announcement']->value['id'];
}?>" data-send="true" data-width="450" data-show-faces="true" data-action="recommend"></div>
        <?php }?>

    </div>

<?php
$_smarty_tpl->tpl_vars['announcement'] = $__foreach_announcement_0_saved_local_item;
}
if (!$_smarty_tpl->tpl_vars['announcement']->_loop) {
?>

    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>((string)$_smarty_tpl->tpl_vars['LANG']->value['noannouncements']),'textcenter'=>true), 0, true);
?>


<?php
}
if ($__foreach_announcement_0_saved_item) {
$_smarty_tpl->tpl_vars['announcement'] = $__foreach_announcement_0_saved_item;
}
?>

<?php if ($_smarty_tpl->tpl_vars['prevpage']->value || $_smarty_tpl->tpl_vars['nextpage']->value) {?>

    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
        <form class="form-inline" role="form">
            <div class="form-group">
                <div class="input-group">
                    <?php if ($_smarty_tpl->tpl_vars['prevpage']->value) {?>
                        <span class="input-group-btn">
                            <a href="announcements.php?page=<?php echo $_smarty_tpl->tpl_vars['prevpage']->value;
if ($_smarty_tpl->tpl_vars['view']->value) {?>&view=<?php echo $_smarty_tpl->tpl_vars['view']->value;
}?>" class="btn btn-default">&laquo; <?php echo $_smarty_tpl->tpl_vars['LANG']->value['previouspage'];?>
</a>
                        </span>
                    <?php }?>
                    <input class="form-control" style="text-align: center;" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['page'];?>
 <?php echo $_smarty_tpl->tpl_vars['pagenumber']->value;?>
" disabled="disabled">
                    <?php if ($_smarty_tpl->tpl_vars['nextpage']->value) {?>
                        <span class="input-group-btn">
                            <a href="announcements.php?page=<?php echo $_smarty_tpl->tpl_vars['nextpage']->value;
if ($_smarty_tpl->tpl_vars['view']->value) {?>&view=<?php echo $_smarty_tpl->tpl_vars['view']->value;
}?>" class="btn btn-default"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['nextpage'];?>
 &raquo;</a>
                        </span>
                    <?php }?>
                </div>
            </div>
        </form>
    </div>
<?php }
}
}
