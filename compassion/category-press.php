<?php
global $wp_query;

get_header(); ?>

<div class="section background-blue section_abgerissen_unten remove_margin_bottom section_full_width has_breadcrumb">

	<div class="row section_breadcrumb">
		<?php echo compassion_breadcrumb(); ?>
	</div>

	<div class="row section_row">
		<div class="large-12 column">

			<h2 style="text-align: center"><?php _e('Medienpräsenz', 'compassion'); ?></h2>

		</div>
	</div>
</div>


<div class="section background-beige-gradient background-beige">

	<div class="row section_row posts-container" data-equalizer data-equalize-on="large" id="test-eq">

		<?php

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
