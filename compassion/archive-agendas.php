<?php
	
/*
* Template Name: agenda - Archiv
*/	
	
	
global $wp_query;

get_header(); ?>

<div class="section background-blue section_abgerissen_unten remove_margin_bottom section_full_width has_breadcrumb">

	<div class="row section_breadcrumb">
<!-- 		<?php echo compassion_breadcrumb(); ?> -->
	</div>

	<div class="row section_row">
		<div class="large-12 column title_page text-center">
			<h2><?php _e('Agenda', 'compassion'); ?></h2>
		</div>
	</div>
</div>


<div class="section archive-section">
	<div class="row section_row">
		<div class="large-12 column">
			
			 <form action="<?php the_permalink(); ?>" method="GET" class="submit-on-select">

				<div class="filter">
					<label>
						<?php _e('Wähle eine Kategorie', 'compassion'); ?>
					</label>
					<div class="select-wrapper">
						<select name="filter" class="input-field">
							<option value=""><?php _e('Alle Kategorien', 'compassion'); ?></option>
							<?php
							$terms = get_terms( array(
								'taxonomy' => 'categorie-cat',
								'hide_empty' => false,
							) );

							$current_cat = get_query_var('cat');
							$current_cat_object = get_terms ($current_cat);

							foreach($terms as $term) {
								?>
							<option <?php echo ((isset($_GET['filter']) && $_GET['filter'] == $term->slug) || $term->slug == $current_cat_object->slug) ? 'selected' : ''; ?> value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option> 								<?php
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

  <div class="row section_row posts-container" data-equalizer data-equalize-by-row="true" data-equalize-on="large" id="test-eq">

    <?php
    $posts_per_page = 15;
	$mydate = get_post_meta( get_the_ID(), '_agenda_start_date', true );
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $args = array(
      'post_type'       =>  'agendas',
      'posts_per_page'  =>  $posts_per_page,
      'paged'           =>  $paged,
      'order'  			=> 'ASC',
      'orderby'         => 'meta_value',
      'meta_key'        => '_agenda_start_date',
      'meta_type'       => 'DATE',
    );

    if( isset($_GET['filter']) && $_GET['filter'] != '' ) {
      $args['categorie-cat'] = $_GET['filter'];
    }

    $query = compassion_query( $args );

    if( $query->have_posts() ) :
      while( $query->have_posts() ): $query->the_post();
     
          get_template_part( 'template-parts/content', 'agendas-teaser' );?>

      <?php endwhile; ?>
    <?php else : ?>
      <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>

  </div>
</div>

</div>


<?php get_footer(); ?>
