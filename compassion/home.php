<?php
global $wp_query;

get_header(); ?>

<div class="section background-blue section_abgerissen_unten remove_margin_bottom section_full_width has_breadcrumb">

	<div class="row section_breadcrumb">
		<?php echo compassion_breadcrumb(); ?>
	</div>

  <div class="row section_row">
    <div class="large-12 column text-center">

			<h2><?php _e('Willkommen bei unseren News', 'compassion'); ?></h2>

    </div>
  </div>
</div>

<!--
<div class="section archive-section">
  <div class="row section_row">
    <div class="large-12 column">
      <form action="<?php echo get_permalink( get_option( 'page_for_posts' ) ) ?>" method="GET" class="submit-on-select posts-filter">

        <div class="filter">
          <label>
            <?php _e('Wählen Sie eine Kategorie', 'compassion'); ?>
          </label>
					<div class="select-wrapper">
            <select name="category" class="input-field">
              <option value=""><?php _e('Alle Kategorien', 'compassion'); ?></option>
              <?php
                $terms = get_terms( array(
                    'taxonomy' => 'category',
                    'hide_empty' => false,
                ) );
                foreach($terms as $term) {
                  ?>
                  <option <?php echo (isset($_GET['category']) && $_GET['category'] == $term->slug) ? 'selected' : ''; ?> value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                  <?php
                }
              ?>
            </select>
          </div>
					<div class="select-wrapper">
            <select name="tag" class="input-field">
              <option value=""><?php _e('Alle Tags', 'compassion'); ?></option>
              <?php
                $terms = get_terms( array(
                    'taxonomy' => 'post_tag',
                    'hide_empty' => false,
                ) );
                foreach($terms as $term) {
									var_dump($term);
                  ?>
                  <option <?php echo (isset($_GET['tag']) && $_GET['tag'] == $term->slug) ? 'selected' : ''; ?> value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
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
-->

<div class="section background-beige-gradient background-beige">

  <div class="row section_row posts-container" data-equalizer data-equalize-on="large" id="test-eq">

<?php

if( isset($_GET['category']) && $_GET['category'] != '' ) {
	query_posts( array ( 'category_name' => $_GET['category'] ) );
}

if( isset($_GET['tag']) && $_GET['tag'] != '' ) {
	query_posts( array ( 'tag' => $_GET['tag'] ) );
}

query_posts('cat=-90');

if ( have_posts() ) :

	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', get_post_type().'-teaser' );

	endwhile;

else :

	get_template_part( 'template-parts/content', 'none' );

endif;
?>

	</div>

	<div class="row section_row">

		<?php if( intval($wp_query->found_posts) > intval(get_option('posts_per_page')) ) : ?>

			<?php
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			?>

			<div class="button-center-wrapper">

				<a href="#" class="button button-beige button-center button-medium button-load-more" data-paged="<?php echo $paged+1; ?>" data-maxPages="<?php echo $wp_query->max_num_pages; ?>" data-query="<?php echo htmlspecialchars(json_encode($wp_query->query)); ?>"><?php _e('Mehr Einträge anzeigen', 'compassion'); ?></a>

			</div>

		<?php endif; ?>

	</div>

</div>

<?php get_footer(); ?>
