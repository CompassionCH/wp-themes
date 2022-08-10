<?php
wp_reset_postdata();
wp_reset_query();

global $post;
?>
<footer class="section background-blue section_full_width">

<!--<footer class="section background-blue section_abgerissen_oben section_full_width">-->

    <div class="row expanded" data-equalizer data-equalize-on="medium">

        <div class="large-3 medium-3 column" data-equalizer-watch>
            <?php dynamic_sidebar('Footer Spalte 1'); ?>
        </div>

        <div class="large-3 medium-3 column" data-equalizer-watch>
            <?php dynamic_sidebar('Footer Spalte 2'); ?>
        </div>

        <div class="large-3 medium-3 column" data-equalizer-watch>
            <?php dynamic_sidebar('Footer Spalte 3'); ?>
            <div class="hope_part">
                <?php
                $imagepng = get_template_directory_uri()."/assets/img/compassion_cert.png";

                if(ICL_LANGUAGE_CODE=='fr') {?>
                    <a href="https://compassion.ch/compassion-obtient-une-certification-internationale-pour-la-protection-de-lenfance/"> <img src="<?php echo $imagepng?>"> </a>
                <?php }elseif(ICL_LANGUAGE_CODE=='de'){ ?>
                    <a href="https://compassion.ch/de/compassion-erhaelt-internationale-kinderschutz-zertifizierung/"> <img src="<?php echo $imagepng?>"> </a>
                <?php }elseif(ICL_LANGUAGE_CODE=='it'){ ?>
                    <a href="https://compassion.ch/it/compassion-ottiene-la-certificazione-internazionale-per-la-protezione-dei-bambini/"> <img src="<?php echo $imagepng?>"> </a>
                <?php } ?>

            </div>
        </div>

        <div class="large-3 medium-3 column footer-column-4" data-equalizer-watch>
            <div class="footer-contact">


                <h6 class="text-uppercase"><?php echo get_theme_mod("kontakt-name"); ?></h6>
                <p>
                    <?php echo get_theme_mod("kontakt-strasse"); ?><br />
                    <?php echo get_theme_mod("kontakt-plz"); ?> <?php echo get_theme_mod("kontakt-ort"); ?><br />
                    <?php _e('Tel.', 'compassion') ?>: <?php echo get_theme_mod("kontakt-tel"); ?><br />
                    <?php _e('E-mail', 'compassion'); ?>: <a href="mailto:<?php echo get_theme_mod("kontakt-email"); ?>"><?php echo get_theme_mod("kontakt-email"); ?></a><br />
                    <?php _e('IBAN', 'compassion'); ?> <?php echo get_theme_mod("bankverbindung-iban"); ?><br /><br />
                   
                    <?php if(ICL_LANGUAGE_CODE=='fr') { ?>
                		<?php _e('<a href="/donations/">Vos dons</a> à Compassion sont déductibles des impôts.', 'compassion'); ?>
					<?php }elseif(ICL_LANGUAGE_CODE=='de'){ ?>
					 	<?php _e('<a href="/de/spenden/">Deine Spende</a> an Compassion ist steuerabzugsberechtigt.', 'compassion'); ?>
					<?php }elseif(ICL_LANGUAGE_CODE=='it'){ ?>
                    	<?php _e('<a href="/it/donare/">Le tue donazioni</a> a Compassion sono deducibili dalle tasse.', 'compassion'); ?>
					<?php } ?>
                </p>
                <ul class="social-links">
                    <li><a target="_blank" href="<?php echo get_theme_mod("facebook"); ?>" class="facebook"></a></li>
                    <li><a target="_blank" href="https://www.instagram.com/compassionswiss" class="instagram"></a></li>
                    <li><a target="_blank" href="<?php echo get_theme_mod("youtube"); ?>" class="youtube"></a></li>
                    <li><a target="_blank" href="<?php echo get_theme_mod("vimeo"); ?>" class="vimeo"></a></li>
                    <li><a target="_blank" href="https://www.linkedin.com/company/compassion-schweiz-suisse-svizzera" class="linkedin"></a></li>
                </ul>
            </div>
            <!--						<div class="footer-bank">
							<h5 class="text-uppercase"><?php _e('Bankverbindung', 'compassion'); ?></h5>
							<p>
								<?php echo get_theme_mod("bankverbindung-bank"); ?><br />

								<?php _e('Kto', 'compassion'); ?> <?php echo get_theme_mod("bankverbindung-kto"); ?><br />
								<?php _e('BLZ', 'compassion'); ?> <?php echo get_theme_mod("bankverbindung-blz"); ?><br />

								<?php _e('IBAN', 'compassion'); ?> <?php echo get_theme_mod("bankverbindung-iban"); ?><br />
								<?php _e('BIC', 'compassion'); ?> <?php echo get_theme_mod("bankverbindung-bic"); ?>
 							</p>
						</div>


-->


        </div>

    </div>

    <div class="sub-footer row expanded">
        <div class="medium-12 column">
            <div class="medium-4 column">
                © <?php echo date('Y', strtotime('now')); ?> <?php _e('Compassion Schweiz', 'compassion'); ?>
            </div>
            <div class="medium-8 column">
                <?php wp_nav_menu(array('menu' => 'Sub-Footer Menu')); ?>
            </div>
        </div>
    </div>

</footer>

<a href="#" class="scroll-to-top"></a>
<!-- 			<a href="#" class="scroll-down"></a> -->

</div> <!-- .off-canvas-content -->
</div> <!-- .off-canvas-wrapper-inner -->

</div> <!-- .off-canvas-wrapper -->
<?php wp_footer(); ?>

</body>
</html>
