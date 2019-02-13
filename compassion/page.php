<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

		<?php get_template_part( 'template-parts/content', 'page' ); ?>

	</article>

<?php endwhile; ?>

<?php get_footer(); ?>
