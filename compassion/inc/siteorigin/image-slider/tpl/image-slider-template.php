<?php

$classes = array( $instance['style'] );

?>

<div class="slick-slider slick-carousel <?php echo implode(' ', $classes) ?>" data-slickSlides="1" data-slickScroll="1" data-slickArrows="true" data-slickDots="true">

  <?php
    $slides = $instance['slides'];

    foreach($slides as $slide) :
  ?>

  <div class="slide">
    <div class="slide-image position-<?php echo $slide['position'] ?>" style="background-image: url(<?php echo wp_get_attachment_url($slide['image']) ?>);"></div>
    <div class="slide-content-wrapper">
      <div class="slide-content">
        <?php
          echo do_shortcode($slide['content']);
        ?>
      </div>
    </div>
  </div>

  <?php endforeach; ?>

</div>
