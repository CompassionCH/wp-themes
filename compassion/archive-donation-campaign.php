<?php

/*
* Template Name: Spendenaktionen - Archiv
*/

get_header(); ?>

<?php the_content(); ?>

<div class="section background-beige-gradient background-beige archive-section">

  <div class="row section_row posts-container" data-equalizer data-equalize-on="large" id="test-eq">

    <?php
    $posts_per_page = 6;

    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $args = array(
      'post_type'       =>  'donation-campaign',
      'posts_per_page'  =>  $posts_per_page,
      'orderby'         =>  'date',
      'paged'           =>  $paged
    );

    $query = compassion_query( $args );

    while( $query->have_posts() ): $query->the_post();
    ?>

    <?php get_template_part( 'template-parts/content', 'donation-campaign-teaser' ); ?>

    <?php endwhile; ?>

  </div>

  <div class="row section_row">

    <?php if( intval($query->found_posts) > $posts_per_page ) : ?>

      <div class="button-center-wrapper">

        <a href="#" class="button button-beige button-center button-medium button-load-more" data-paged="<?php echo $paged+1; ?>" data-maxPages="<?php echo $query->max_num_pages; ?>" data-query="<?php echo htmlspecialchars(json_encode($args)); ?>"><?php _e('Mehr Aktionen anzeigen', 'compassion'); ?></a>

      </div>

    <?php endif; ?>

  </div>

</div>

<?php get_footer(); ?>
