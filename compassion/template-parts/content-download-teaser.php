<?php

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'thumbnail_size' );

?>

<article class="column medium-6 large-3 blog-teaser download-teaser" data-equalizer-watch>
  <div class="content-wrapper">

    <div class="thumbnail" style="background-image: url(<?php echo $thumb[0]; ?>);">
    </div>

    <h5 class="title"><?php the_title(); ?></h5>

    <div class="button-wrapper">
      <a target="_blank" href="<?php echo get_post_meta(get_the_id(), '_download_button_link', true); ?>" class="button button-small button-blue">
        <?php echo get_post_meta(get_the_id(), '_download_button_text', true); ?>
      </a>

      <?php if(get_post_meta(get_the_id(), '_download_order', true) != '') : ?>
        <form action="#" class="download-teaser-form">
          <div class="select-wrapper">
            <select name="qty" class="input-field" data-href="#download_<?php the_id(); ?>">
              <?php
                for($i = 0; $i <= 10; $i++) {
                  ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                  <?php
                }
              ?>
            </select>
          </div>
          <input type="submit" value="<?php _e('Bestellen', 'compassion'); ?>" class="button button-blue button-small" />
        </form>
      <?php endif; ?>
    </div>

    <div class="category">
      <?php
      $download_cats = get_the_terms(get_the_id(), 'download-cat');
      foreach($download_cats as $cat) {
        ?>
        <a href="?filter=<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></a>
        <?php
      }
      ?>
    </div>

  </div>

</article>
