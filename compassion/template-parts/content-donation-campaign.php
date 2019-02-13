<div class="section background-blue section_abgerissen_unten has_breadcrumb">

  <div class="row section_breadcrumb">
    <?php compassion_breadcrumb(get_bloginfo('url').'/dabei-sein-mithelfen/spendenaktionen/'); ?>
  </div>

  <div class="row section_row">
    <div class="large-10 colum large-centered">
      <span class="date"><?php the_time('d.m.Y'); ?></span>
      <h2><?php the_title(); ?></h2>
    </div>

  </div>
</div>

<?php the_content(); ?>

<div class="article-footer">
  <div class="row">

    <div class="large-8 medium-8 medium-centered column">
      <div class="footer-content">
        <div class="large-6 medium-6 column">
          <h5><?php _e('Spendenkonto', 'compassion'); ?></h5>
          <?php echo get_theme_mod("bankverbindung-bank"); ?><br />
          <?php _e('Kto', 'compassion'); ?> <?php echo get_theme_mod("bankverbindung-kto"); ?><br />
          <?php _e('BLZ', 'compassion'); ?> <?php echo get_theme_mod("bankverbindung-blz"); ?><br />
          <?php _e('IBAN', 'compassion'); ?> <?php echo get_theme_mod("bankverbindung-iban"); ?><br />
          <?php _e('BIC', 'compassion'); ?> <?php echo get_theme_mod("bankverbindung-bic"); ?>
        </div>

        <div class="large-6 medium-6 column">
          <a href="#" class="button button-blue button-medium"><?php _e('Jetzt online spenden', 'compassion'); ?></a>

          <div class="social-links">
            <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>" target="_blank" class="button-social facebook">
            </a>

            <a href="https://twitter.com/share?url=<?php the_permalink() ?>&text=<?php echo urlencode(get_the_title()) ?>" target="_blank" class="button-social twitter">
            </a>

            <a href="mailto:?Subject=<?php the_title(); ?>&amp;Body=<?php the_permalink(); ?>" class="button-social email">
            </a>
          </div>

        </div>
      </div>
    </div>
    </div>
  </div>
</div>
