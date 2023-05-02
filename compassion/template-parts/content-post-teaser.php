<?php

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'thumbnail_size' );

?>

<article class="column large-4 medium-6 blog-teaser" data-equalizer-watch>
  <a href="<?php the_permalink(); ?>">
    <div class="content-wrapper">

      <div class="thumbnail" style="background-image: url(<?php echo $thumb[0]; ?>);">
      </div>

      <h5 class="title"><?php the_title(); ?></h5>
	  <?php	
		  if (in_category(icl_object_id(90, 'category', true))) {?>
			<p style="text-align: center"> <?php  the_date(); ?> </p>
		 <?php  }?>
      <div class="content">
        <?php the_excerpt(); ?>
      </div>


    </div>
  </a>

</article>
