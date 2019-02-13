<?php get_header();

global $post;

?>

<?php while ( have_posts() ) : the_post(); ?>

	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

		<?php get_template_part( 'template-parts/content', get_post_type() ); ?>

	</article>

	<?php
	global $post;
	if( $post->post_type == 'post' || $post->post_type == 'donation-campaign' ) : 
	
	 ?>

	<div class="section background-beige-gradient background-beige section-read-more">
		<div class="related row section_row">

			<?php
				
							$posts_per_page = 4;
				$title = __('Das könnte Sie auch interessieren', 'compassion');

				if( $post->post_type == 'donation-campaign' ) {
					$posts_per_page = 2;
					$title = __('Weitere Spendenaktionen', 'compassion');
				}
				
				$exclude = icl_object_id(get_cat_ID('press'),'category', true);
				
				if (in_category(icl_object_id(90, 'category', false))) {
					$args = array(
					'post_type'				=>	$post->post_type,
					'posts_per_page' 	=> $posts_per_page,
					'orderby'					=>	'DESC',
					'post__not_in' => array( $post->ID ),
					'category__in'  => array( $exclude )

				);
				
				} else {
			
					$args = array(
					'post_type'				=>	$post->post_type,
					'posts_per_page' 	=> $posts_per_page,
					'orderby'					=>	'DESC',
					'post__not_in' => array( $post->ID ),
					'category__not_in' => array( $exclude )
				);
				
				}
				$query = new WP_Query($args);
			?>

			<h3 class="text-uppercase text-center"><?php echo $title; ?></h3>

			<div data-equalizer data-equalize-on="medium">
				<?php while( $query->have_posts() ) : $query->the_post(); ?>

					<?php get_template_part( 'template-parts/content', $post->post_type.'-teaser' ); ?>

				<?php endwhile; ?>
			</div>

		</div>

	</div>

	<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
