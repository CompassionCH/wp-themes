<div class="slick-carousel slick-kundenstimmen" data-slickSlides="1" data-slickScroll="1" data-slickArrows="true" data-slickDots="true">

  <?php
    $slides = $instance['slides'];

    foreach($slides as $slide) :
  ?>

  <div class="slide">
    <div class="row">
      <div class="slide-content-wrapper">
        <div class="slide-image" style="background-image: url(<?php echo wp_get_attachment_url($slide['image']) ?>);"></div>
        <div class="slide-content">
          <?php
            echo do_shortcode($slide['content']);
          ?>
          <span class="person"><?php echo $slide['person']; ?></span>
        </div>
      </div>
    </div>
  </div>

  <?php endforeach; ?>

</div>
