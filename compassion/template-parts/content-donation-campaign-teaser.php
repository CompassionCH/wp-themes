<?php

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'thumbnail_size' );

?>

<article class="column large-6 blog-teaser spendenaktion-teaser" data-equalizer-watch>
  <a href="<?php the_permalink(); ?>">
    <div class="content-wrapper">

      <div class="thumbnail" style="background-image: url(<?php echo $thumb[0]; ?>);">
        <div class="date-wrapper">
          <div class="date">
            <?php the_time('d.m.Y'); ?>
          </div>
        </div>
      </div>

      <h5 class="title"><?php the_title(); ?></h5>

      <div class="content">
        <?php the_excerpt(); ?>
      </div>

    </div>
  </a>

</article>
