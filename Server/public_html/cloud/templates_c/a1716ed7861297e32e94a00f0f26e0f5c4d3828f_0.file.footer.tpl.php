<?php
/* Smarty version 3.1.29, created on 2017-12-05 14:03:22
  from "/home/admin/web/ddweb.com.cn/public_html/cloud/templates/nrghost/footer.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a26a72ab4fe33_37202028',
  'file_dependency' => 
  array (
    'a1716ed7861297e32e94a00f0f26e0f5c4d3828f' => 
    array (
      0 => '/home/admin/web/ddweb.com.cn/public_html/cloud/templates/nrghost/footer.tpl',
      1 => 1512482591,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a26a72ab4fe33_37202028 ($_smarty_tpl) {
?>

        </div><!-- /.main-content -->
        <?php if (!$_smarty_tpl->tpl_vars['inShoppingCart']->value && $_smarty_tpl->tpl_vars['secondarySidebar']->value->hasChildren()) {?>
            <div class="col-md-3 pull-md-left sidebar">
                <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('sidebar'=>$_smarty_tpl->tpl_vars['secondarySidebar']->value), 0, true);
?>

            </div>
        <?php }?>
    </div>
    <div class="clearfix"></div>
</section>


   <!-- FOOTER -->
    <footer class="footer">
        <div class="container ">
            <div class="row">
                <div class="footer-entry col-md-3">
                    <h3 class="title">NRGHost</h3>
                    <div class="text">Duis posuere blandit orci sed tincidunt. Curabitur porttitor nisi ac nunc ornare, in fringilla nisl blandit. Duis posuere blandit orci sed tincidunt. Curabitur porttitor nisi ac nunc ornare, in fringilla nisl blandit. Praesent nisl sapien, semper quis convallis et, tempus vitae dolor.</div>
                </div>
                <div class="footer-entry col-md-2 col-sm-3 col-xs-6">
                    <h3 class="title">NRGHost</h3>
                    <ul>
                        <li><a href="hosting.html">Web Hosting</a></li>
                        <li><a href="hosting.html">Reseller Hosting</a></li>
                        <li><a href="host-vps.html">VPS Hosting</a></li>
                        <li><a href="host-dedicated.html">Dedicated Hosting</a></li>
                        <li><a href="hosting.html">Application Hosting</a></li>
                        <li><a href="hosting.html">Windows Hosting</a></li>
                    </ul>
                </div>
                <div class="footer-entry col-md-2 col-sm-3 col-xs-6">
                    <h3 class="title">Company</h3>
                    <ul>
                        <li><a href="host-about.html">About NRGHost</a></li>
                        <li><a href="host-testimonials.html">Awards &amp; Reviews</a></li>
                        <li><a href="host-about.html">Press &amp; Media</a></li>
                        <li><a href="blog.html">Company Blog</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                        <li><a href="host-about.html">Careers</a></li>
                    </ul>
                </div>
                <div class="footer-entry col-md-5 col-sm-6 col-xs-12">
                    <h3 class="title">Newsletter Subscribe</h3>
                    <div class="text">Curabitur porttitor nisi ac nunc ornare, in fringilla nisl blandit. Sed quam metus, faucibus et pulvinar ut, volutpat ut orci. Integer sollicitudin cursus massa, non laoreet risus pretium eget.</div>
                    <div class="subscription-form">
                        <form>
                            <input type="email" required value="" placeholder="Your Email..."/>
                            <input type="submit" value="" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="row nopadding social-icons-wrapper">
                <div class="col-xs-3 nopadding">
                    <a class="social-icon" href="https://www.facebook.com/" target="_blank" style="background-color: #3b5998;">
                        <img src="templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/nrghosts/img/icon-17.png" alt="" />
                    </a>
                </div>
                <div class="col-xs-3 nopadding">
                    <a class="social-icon" href="https://plus.google.com" target="_blank" style="background-color: #e02f2f;">
                        <img src="templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/nrghosts/img/icon-18.png" alt="" />
                    </a>
                </div>
                <div class="col-xs-3 nopadding">
                    <a class="social-icon" href="https://twitter.com/" target="_blank" style="background-color: #55acee;">
                        <img src="templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/nrghosts/img/icon-19.png" alt="" />
                    </a>
                </div>
                <div class="col-xs-3 nopadding">
                    <a class="social-icon" href="https://www.linkedin.com/" target="_blank" style="background-color: #007bb5;">
                        <img src="templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/nrghosts/img/icon-20.png" alt="" />
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <ul class="footer-menu">
                        <li><a class="active" href="index.html">Home</a></li>
                        <li><a href="hosting.html">Hosting</a></li>
                        <li><a href="host-domains.html">Domains</a></li>
                        <li><a href="host-about.html">Pages</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="copyright">&copy; <?php echo $_smarty_tpl->tpl_vars['date_year']->value;?>
 All rights reserved. <?php echo $_smarty_tpl->tpl_vars['comapnyname']->value;?>
</div>
                </div>
            </div>
        </div>
        <div class="footer-line">
            <div class="container">
                <div class="row">
                    <div class="footer-line-entry col-md-3 col-sm-6 col-xs-12">
                        <img src="templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/nrghosts/img/icon-22.png" alt=""/>
                        <div class="content">
                            <div class="cell-view">24/7 Custtomer Support</div>
                        </div>
                    </div>
                    <div class="footer-line-entry col-md-3 col-sm-6 col-xs-12">
                        <img src="templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/nrghosts/img/icon-23.png" alt=""/>
                        <div class="content">
                            <div class="cell-view"><a href="mailto:support@nrghost.com">support@nrghost.com</a></div>
                        </div>
                    </div>
                    <div class="footer-line-entry col-md-3 col-sm-6 col-xs-12">
                        <img src="templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/nrghosts/img/icon-24.png" alt=""/>
                        <div class="content">
                            <div class="cell-view"><a href="tel:+48 555 8753 005">+48 555 8753 005</a></div>
                        </div>
                    </div>
                    <div class="footer-line-entry col-md-3 col-sm-6 col-xs-12">
                        <img src="templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/nrghosts/img/icon-25.png" alt=""/>
                        <div class="content">
                            <div class="cell-view"><a href="#">Live Chat</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/jquery-ui.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
    var csrfToken = '<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
';
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/js/whmcs.js"><?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->tpl_vars['footeroutput']->value;?>


    <?php echo '<script'; ?>
 src="templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/nrghosts/js/idangerous.swiper.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/nrghosts/js/global.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/nrghosts/js/wow.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        var wow = new WOW(
            {
                boxClass:     'wow',      // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset:       100,          // distance to the element when triggering the animation (default is 0)
                mobile:       true,       // trigger animations on mobile devices (default is true)
                live:         true,       // act on asynchronously loaded content (default is true)
                callback:     function(box) {
                  // the callback is fired every time an animation is started
                  // the argument that is passed in is the DOM node being animated
                }
            }
        );
        wow.init();
    <?php echo '</script'; ?>
>

    <?php echo $_smarty_tpl->tpl_vars['footeroutput']->value;?>


</body>
</html>
<?php }
}
