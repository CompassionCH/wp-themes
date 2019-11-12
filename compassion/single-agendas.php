<?php get_header();

global $post;

?>

<?php while ( have_posts() ) : the_post(); ?>

	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

		<?php get_template_part( 'template-parts/content', 'agendas'); ?>

	</article>

	<?php
	global $post;
	if( $post->post_type == 'agendas' ) : 
	
	?>

	<div class="section background-beige-gradient background-beige section-read-more">
		<div class="related row section_row">

			<?php
				$custom_taxterms = wp_get_object_terms( $post->ID, 'categorie-cat', array('fields' => 'ids') );
				$posts_per_page = 4;
				$title = __('Das könnte dich auch interessieren', 'compassion');

				$args = array(
					'post_type'				=>	$post->post_type,
					'posts_per_page' 	=> $posts_per_page,
					'orderby'					=>	'rand',
					'post__not_in' => array( $post->ID ),
					 'tax_query' => array(
					 array(
					 'taxonomy' => 'categorie-cat',
					 'field' => 'id',
					 'terms' => $custom_taxterms
    )
),
				);

				$query = new WP_Query($args);
		?>
		
	<?php if ($query->post_count > 0) { ?>
		<h3 class="text-uppercase text-center"><?php echo $title; ?></h3> 
	<?php } while( $query->have_posts() ) : $query->the_post(); ?>
				<div data-equalizer data-equalize-on="medium">
				<?php get_template_part( 'template-parts/content', 'agendas-teaser' ); ?>
			</div>
			<?php endwhile; ?>
			

		</div>

	</div>
	<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
