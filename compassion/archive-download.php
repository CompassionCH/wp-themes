<?php

/*
* Template Name: Download - Archiv
*/

get_header(); ?>

<?php the_content(); ?>

<div class="section archive-section">
  <div class="row section_row">
    <div class="large-12 column">
      <form action="<?php the_permalink(); ?>" method="GET" class="submit-on-select">

        <div class="filter">
          <label>
            <?php _e('Wählen Sie eine Kategorie', 'compassion'); ?>
          </label>
          <div class="select-wrapper">
            <select name="filter" class="input-field">
              <option value=""><?php _e('Alle', 'compassion'); ?></option>
              <?php
                $terms = get_terms( array(
                    'taxonomy' => 'download-cat',
                    'hide_empty' => false,
                ) );
                foreach($terms as $term) {
                  ?>
                  <option <?php echo (isset($_GET['filter']) && $_GET['filter'] == $term->slug) ? 'selected' : ''; ?> value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                  <?php
                }
              ?>
            </select>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<div class="section background-beige-gradient background-beige">

  <div class="row section_row posts-container" data-equalizer data-equalize-on="large" id="test-eq">

    <?php
    $posts_per_page = 12;

    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $args = array(
      'post_type'       =>  'download',
      'posts_per_page'  =>  $posts_per_page,
      'orderby'         =>  'date',
      'paged'           =>  $paged
    );

    if( isset($_GET['filter']) && $_GET['filter'] != '' ) {
      $args['download-cat'] = $_GET['filter'];
    }

    $query = compassion_query( $args );

    if( $query->have_posts() ) :
      while( $query->have_posts() ): $query->the_post();
      ?>

      <?php get_template_part( 'template-parts/content', 'download-teaser' ); ?>

      <?php endwhile; ?>
    <?php else : ?>
      <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>

  </div>

  <div class="row section_row">

    <?php if( intval($query->found_posts) > $posts_per_page ) : ?>

      <div class="button-center-wrapper">

        <a href="#" class="button button-beige button-center button-medium button-load-more" data-paged="<?php echo $paged+1; ?>" data-maxPages="<?php echo $query->max_num_pages; ?>" data-query="<?php echo htmlspecialchars(json_encode($args)); ?>"><?php _e('Mehr Downloads anzeigen', 'compassion'); ?></a>

      </div>

    <?php endif; ?>

  </div>
  
	<div class="full reveal" id="download-order-modal" data-reveal>
	
		  <div class="row">
		    <div class="large-12 column">
		      <?php
			      $my_current_lang = apply_filters( 'wpml_current_language', NULL );
			      
			      if ( $my_current_lang == "fr" ) {	      
			      		echo do_shortcode( '[contact-form-7 id="17496" title="Download-Bestellformular_fr"]' ); }
			      elseif ( $my_current_lang == "de" ){
				       echo do_shortcode( '[contact-form-7 id="333" title="Download-Bestellformular"]' ); }
				  elseif ( $my_current_lang == "it" ){
				  	 	echo do_shortcode( '[contact-form-7 id="17500" title="Download-Bestellformular_it"]' ); }
				  ?>
		    </div>
		  </div>
	
	  			<button class="close-button close" data-close aria-label="Close reveal" type="button"></button>
	</div>


</div>


<?php get_footer(); ?>
