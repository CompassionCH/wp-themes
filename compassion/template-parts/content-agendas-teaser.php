<?php

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'thumbnail_size' );

?>

<article class="column large-3 medium-6 blog-teaser" data-equalizer-watch>

    <div class="content-wrapper">
	<a href="<?php the_permalink(); ?>">
    <div class="thumbnail" style="background-image: url(<?php echo $thumb[0]; ?>);"></div>

      <h5 class="title"><?php the_title(); ?></h5>


  <?php if ( get_post_meta(get_the_id(), '_agenda_end_date', true) ) : ?>
      
      <h5 class="date"><?php _e('Vom', 'compassion'); ?> <?php $text = get_post_meta(get_the_id(), '_agenda_start_date', true);
	      echo date("d.m.Y", strtotime(str_replace('.', '-', $text)));?> <?php _e('bis', 'compassion'); ?> <?php  $text1 = get_post_meta(get_the_id(), '_agenda_end_date', true);
	      echo date("d.m.Y", strtotime(str_replace('.', '-', $text1)));
	      ?>
	      
	     </h5>
	    <?php else: ?>
	    
	     <h5 class="date"><?php $text3 = get_post_meta(get_the_id(), '_agenda_start_date', true);
	      echo date("d.m.Y", strtotime(str_replace('.', '-', $text3)));   ?>
	   
	  </h5>
	    <?php endif ?>





<!--

         <h5 class="date"><?php $text = get_post_meta(get_the_id(), '_agenda_start_date', true);
	      echo date("d.m.Y", strtotime(str_replace('.', '-', $text)));
	      ?></h5>
-->
      <div class="content">
      <?php the_excerpt(); ?>
      </div>
  </a>
    </div>


</article>
