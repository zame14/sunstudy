<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 designnetwork-wrapper">
                <h3>Sun Study is a division of Design Network Architecture Ltd</h3>
                <a href="https://www.designnetwork.co.nz" class="design-network" target="_blank"><img src="<?=get_stylesheet_directory_uri()?>/images/dn-logo.png" alt="Design Network Architecture Ltd" /></a>
            </div>
            <div class="col-12 col-sm-6 contact-details-wrapper align-self-center">
                <ul>
                    <li><address><span class="fa fa-map-marker"></span><?=get_option('address')?></address></li>
                    <li><a href="mailto:<?=get_option('email')?>"><span class="fa fa-envelope"></span><?=get_option('email')?></a></li>
                    <li><a href="tel:<?=formatPhoneNumber(get_option('phone'))?>"><span class="fa fa-phone-square"></span><?=get_option('phone')?></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section id="copyright">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                &copy; Copyright <?=date('Y')?> <?=get_bloginfo('name')?> <i>-</i> <span>Website by <a href="https://www.azwebsolutions.co.nz/" target="_blank">A-Z Web Solutions Ltd</a></span>
            </div>
        </div>
    </div>
</section>
<?php wp_footer(); ?>
</body>
</html>