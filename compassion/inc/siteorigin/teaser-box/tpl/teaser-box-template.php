<div class="teaser-box">
  <div class="image position-<?php echo $instance['image-position']; ?>" style="background-image: url(<?php echo wp_get_attachment_url($instance['image']); ?>);"></div>
  <h4 class="svg-divider"><?php echo $instance['title'] ?></h4>
  <?php echo do_shortcode($instance['content']); ?>
</div>
