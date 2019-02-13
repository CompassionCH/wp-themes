<?php

  $locations = new WP_Query( array(
    'post_type'   =>  array( 'location' ),
    'posts_per_page'  =>  '-1',
    'tax_query' => array(
  		array(
  			'taxonomy' => 'location-category',
  			'field'    => 'name',
  			'terms'    => __('Zentren', 'compassion'),
  		),
  	),
  ) );

?>

<div class="world-map">

  <div class="interactive-map">
    <div class="image"></div>
    <div class="map-markers">
      <?php while( $locations->have_posts() ) : $locations->the_post(); ?>

        <div class="marker" style="left: <?php echo get_post_meta( get_the_id(), '_cmb_latitude', true ); ?>; top: <?php echo get_post_meta( get_the_id(), '_cmb_longitude', true ); ?>;">
          <div class="infobox">
            <h5 class="title svg-divider"><?php the_title(); ?></h5>
            <a href="#<?php echo sanitize_title( get_the_title() ); ?>"><?php echo get_post_meta( get_the_id(), '_cmb_link_text', true ); ?></a>
          </div>
        </div>

      <?php endwhile; ?>
    </div>
  </div>

  <div class="accordion-wrapper">
    <ul class="accordion" data-accordion data-allow-all-closed="true">
      <?php while( $locations->have_posts() ) : $locations->the_post(); ?>

        <li class="accordion-item" data-accordion-item>
          <a href="#" class="accordion-title"><?php the_title(); ?></a>
          <div class="accordion-content" data-tab-content id="<?php echo sanitize_title( get_the_title() ); ?>">
            <a href="#" class="close"></a>
            <?php the_content(); ?>
          </div>
        </li>

      <?php endwhile; ?>

    </ul>
  </div>

</div>

<?php wp_reset_postdata(); ?>
