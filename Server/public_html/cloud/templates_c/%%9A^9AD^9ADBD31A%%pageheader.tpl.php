<?php /* Smarty version 2.6.28, created on 2017-12-25 20:26:18
         compiled from webhoster/pageheader.tpl */ ?>

<div class="page-header title hidden-xs">
    <h1><?php echo $this->_tpl_vars['title']; ?>
 <span class="sub-title"><?php if ($this->_tpl_vars['desc']): ?><?php echo $this->_tpl_vars['desc']; ?>
<?php endif; ?></span></h1>
</div>

<div class="page-header title visible-xs">
    <h1><?php echo $this->_tpl_vars['title']; ?>
 <span class="sub-title"><?php if ($this->_tpl_vars['desc']): ?><br /><?php echo $this->_tpl_vars['desc']; ?>
<?php endif; ?></span></h1>
</div>