<?php
/* Smarty version 3.1.29, created on 2017-12-28 15:21:59
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/contact.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a450c17030ff2_77750595',
  'file_dependency' => 
  array (
    'a4e643f78d48a063e37962c0d638f35d78b2b0cd' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/NeWorld/contact.tpl',
      1 => 1512474173,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a450c17030ff2_77750595 ($_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['sent']->value) {?>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['contactsent'],'textcenter'=>true), 0, true);
?>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['errormessage']->value) {?>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'errorshtml'=>$_smarty_tpl->tpl_vars['errormessage']->value), 0, true);
?>

<?php }?>

<?php if (!$_smarty_tpl->tpl_vars['sent']->value) {?>
<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
	    <form method="post" action="contact.php" class="form" role="form">
	        <input type="hidden" name="action" value="send" />
        	<div class="row">
	            <div class="form-group col-md-6">
	                <label for="inputName" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsclientname'];?>
</label>
	                <input type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" class="form-control" id="inputName" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsclientname'];?>
" />
	            </div>
	            
	            <div class="form-group col-md-6">
	                <label for="inputEmail" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsclientemail'];?>
</label>
	                <input type="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" class="form-control" id="inputEmail" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsclientemail'];?>
" />
	            </div>
        	</div>
			
            <div class="form-group">
                <label for="inputSubject" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketsubject'];?>
</label>
                <input type="subject" name="subject" value="<?php echo $_smarty_tpl->tpl_vars['subject']->value;?>
" class="form-control" id="inputSubject" />
            </div>
            <div class="form-group">
                <label for="inputMessage" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['contactmessage'];?>
</label>
                <textarea name="message" rows="7" class="form-control" id="inputMessage"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</textarea>
            </div>
            
            <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/captcha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>


            <div class="form-group">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" style="min-width: 100px;"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['contactsend'];?>
</button>
                </div>
            </div>
	    </form>
	</div>
</div>
<?php }
}
}
