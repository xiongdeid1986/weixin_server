<?php
/* Smarty version 3.1.29, created on 2017-12-24 12:51:22
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/nrghost/knowledgebase.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a3fa2ca03a621_20801226',
  'file_dependency' => 
  array (
    'cb326b25c86fe118d69be0bfaaee872ad55cc17f' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/nrghost/knowledgebase.tpl',
      1 => 1512482591,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a3fa2ca03a621_20801226 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once '/home/admin/web/ddweb.com.cn/public_html/cloud/vendor/smarty/smarty/libs/plugins/modifier.truncate.php';
?>
<form role="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/knowledgebase.php?action=search">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['kbsearchexplain'];?>
" />
        <span class="input-group-btn">
            <input type="submit" class="btn btn-primary btn-input-padded-responsive" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['search'];?>
" />
        </span>
    </div>
</form>

<h2><?php echo $_smarty_tpl->tpl_vars['LANG']->value['knowledgebasecategories'];?>
</h2>

<?php if ($_smarty_tpl->tpl_vars['kbcats']->value) {?>
    <div class="row kbcategories">
        <?php
$_from = $_smarty_tpl->tpl_vars['kbcats']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_kbcat_0_saved_item = isset($_smarty_tpl->tpl_vars['kbcat']) ? $_smarty_tpl->tpl_vars['kbcat'] : false;
$_smarty_tpl->tpl_vars['kbcat'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['kbcat']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['kbcat']->value) {
$_smarty_tpl->tpl_vars['kbcat']->_loop = true;
$__foreach_kbcat_0_saved_local_item = $_smarty_tpl->tpl_vars['kbcat'];
?>
            <div class="col-sm-4">
                <a href="<?php if ($_smarty_tpl->tpl_vars['seofriendlyurls']->value) {
echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/knowledgebase/<?php echo $_smarty_tpl->tpl_vars['kbcat']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['kbcat']->value['urlfriendlyname'];
} else { ?>knowledgebase.php?action=displaycat&amp;catid=<?php echo $_smarty_tpl->tpl_vars['kbcat']->value['id'];
}?>">
                    <span class="glyphicon glyphicon-folder-close"></span> <?php echo $_smarty_tpl->tpl_vars['kbcat']->value['name'];?>
 <span class="badge badge-info"><?php echo $_smarty_tpl->tpl_vars['kbcat']->value['numarticles'];?>
</span>
                </a>
                <p><?php echo $_smarty_tpl->tpl_vars['kbcat']->value['description'];?>
</p>
            </div>
        <?php
$_smarty_tpl->tpl_vars['kbcat'] = $__foreach_kbcat_0_saved_local_item;
}
if ($__foreach_kbcat_0_saved_item) {
$_smarty_tpl->tpl_vars['kbcat'] = $__foreach_kbcat_0_saved_item;
}
?>
    </div>
<?php } else { ?>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['knowledgebasenoarticles'],'textcenter'=>true), 0, true);
?>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['kbmostviews']->value) {?>

    <h2><?php echo $_smarty_tpl->tpl_vars['LANG']->value['knowledgebasepopular'];?>
</h2>

    <div class="kbarticles">
        <?php
$_from = $_smarty_tpl->tpl_vars['kbmostviews']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_kbarticle_1_saved_item = isset($_smarty_tpl->tpl_vars['kbarticle']) ? $_smarty_tpl->tpl_vars['kbarticle'] : false;
$_smarty_tpl->tpl_vars['kbarticle'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['kbarticle']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['kbarticle']->value) {
$_smarty_tpl->tpl_vars['kbarticle']->_loop = true;
$__foreach_kbarticle_1_saved_local_item = $_smarty_tpl->tpl_vars['kbarticle'];
?>
            <a href="<?php if ($_smarty_tpl->tpl_vars['seofriendlyurls']->value) {
echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/knowledgebase/<?php echo $_smarty_tpl->tpl_vars['kbarticle']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['kbarticle']->value['urlfriendlytitle'];?>
.html<?php } else { ?>knowledgebase.php?action=displayarticle&amp;id=<?php echo $_smarty_tpl->tpl_vars['kbarticle']->value['id'];
}?>">
                <span class="glyphicon glyphicon-file"></span>&nbsp;<?php echo $_smarty_tpl->tpl_vars['kbarticle']->value['title'];?>

            </a>
            <p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['kbarticle']->value['article'],100,"...");?>
</p>
        <?php
$_smarty_tpl->tpl_vars['kbarticle'] = $__foreach_kbarticle_1_saved_local_item;
}
if ($__foreach_kbarticle_1_saved_item) {
$_smarty_tpl->tpl_vars['kbarticle'] = $__foreach_kbarticle_1_saved_item;
}
?>
    </div>

<?php }
}
}
