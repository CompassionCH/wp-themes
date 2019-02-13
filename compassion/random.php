<?php

/*
* Template Name: random-child
*/

get_header(); ?>

<?php
  $args = array(
    'post_type'=>'child', 
    'orderby'=>'rand', 
    'posts_per_page'=>'1'
  );

  $testimonials=new WP_Query($args);

  while ($testimonials->have_posts()) : $testimonials->the_post(); ?>
  
  	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

	<?php	get_template_part( 'template-parts/content', ('child-random') );?>
		
		</article>


<?php	endwhile; ?>

<?php get_footer(); ?>
