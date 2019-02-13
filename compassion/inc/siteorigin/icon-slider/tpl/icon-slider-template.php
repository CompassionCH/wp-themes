<div class="slick-carousel slick-icon-slider" data-slickSlides="3" data-slickScroll="1" data-slickArrows="true" data-slickDots="false" data-slickResponsive="true">

  <?php
    $slides = $instance['slides'];

    foreach($slides as $slide) :
  ?>

  <div class="slide">
    <div class="single-icon icon-default">
      <object type="image/svg+xml" data="<?php bloginfo('template_directory'); ?>/assets/img/<?php echo $slide['icon'] ?>.svg">
        <img src="<?php bloginfo('template_directory'); ?>/assets/img/<?php echo $slide['icon'] ?>.png" alt="No SVG support">
      </object>
    </div>

    <h4 class="svg-divider text-uppercase"><?php echo $slide['title'] ?></h4>
    <?php echo do_shortcode($slide['content']); ?>
  </div>

  <?php endforeach; ?>

</div>
