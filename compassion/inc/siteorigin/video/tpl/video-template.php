<div class="video-wrapper">
  <div class="mobile-placeholder" style="background-image: url(<?php echo wp_get_attachment_url($instance['placeholder']) ?>);"></div>
  <video class="video-file" loop poster="<?php echo wp_get_attachment_url($instance['placeholder']) ?>" autoplay="autoplay" src="<?php echo wp_get_attachment_url($instance['video-file']); ?>"></video>
</div>
