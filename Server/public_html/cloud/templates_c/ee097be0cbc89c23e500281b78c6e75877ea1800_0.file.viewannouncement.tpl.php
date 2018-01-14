<?php
/* Smarty version 3.1.29, created on 2017-12-28 15:22:48
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/viewannouncement.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a450c48d110a3_19252250',
  'file_dependency' => 
  array (
    'ee097be0cbc89c23e500281b78c6e75877ea1800' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/viewannouncement.tpl',
      1 => 1512474174,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a450c48d110a3_19252250 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/admin/web/ddweb.com.cn/public_html/cloud/vendor/smarty/smarty/libs/plugins/modifier.date_format.php';
?>
<div class="container-hd">
	<?php echo $_smarty_tpl->tpl_vars['LANG']->value['homeannouncements'];?>

</div>
<div class="container-bd">
	<h2 class="text-center"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2>
	
<?php if ($_smarty_tpl->tpl_vars['twittertweet']->value) {?>
    <div class="pull-right">
        <a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical" data-via="<?php echo $_smarty_tpl->tpl_vars['twitterusername']->value;?>
">Tweet</a><?php echo '<script'; ?>
 type="text/javascript" src=".//platform.twitter.com/widgets.js"><?php echo '</script'; ?>
>
    </div>
<?php }?>

<?php echo $_smarty_tpl->tpl_vars['text']->value;?>


<p class="text-right">
	<strong style="display: block"><?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
</strong>
    <strong><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['timestamp']->value,"Y-m-d");?>
</strong>
</p>

<?php if ($_smarty_tpl->tpl_vars['googleplus1']->value) {?>
    <g:plusone annotation="inline"></g:plusone>
    <?php echo '<script'; ?>
 type="text/javascript">
    (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
    <?php echo '</script'; ?>
>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['facebookrecommend']->value) {?>
    
    <div id="fb-root">
    </div>
    <?php echo '<script'; ?>
>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));<?php echo '</script'; ?>
>
    
    <div class="fb-like" data-href="./<?php if ($_smarty_tpl->tpl_vars['seofriendlyurls']->value) {?>announcements/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['urlfriendlytitle']->value;?>
.html<?php } else { ?>announcements.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;
}?>" data-send="true" data-width="450" data-show-faces="true" data-action="recommend">
    </div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['facebookcomments']->value) {?>
    
    <div id="fb-root">
    </div>
    <?php echo '<script'; ?>
>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));<?php echo '</script'; ?>
>
    
    <fb:comments href="./<?php if ($_smarty_tpl->tpl_vars['seofriendlyurls']->value) {?>announcements/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['urlfriendlytitle']->value;?>
.html<?php } else { ?>announcements.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;
}?>" num_posts="5" width="500"></fb:comments>
<?php }?>
</div><?php }
}
