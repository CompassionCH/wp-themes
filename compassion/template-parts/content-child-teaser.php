<!--



$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'thumbnail_size' );
//ModifJK
$thumb[0] = str_replace('z_0.6','z_0.8,q_70',(str_replace('w_320','w_400',str_replace('h_420','h_400',$thumb[0]))));

-->
<?php
$child_meta = get_child_meta(get_the_id());

?>

<article class="column medium-6 large-4 blog-teaser child-teaser child" data-equalizer-watch>
  <div class="content-wrapper">
      <div class="thumb_cont">
	  		<a href="<?php the_permalink(); ?>">
	  		<?php if ($child_meta['gender_type'] == 'girl'): ?>	
  			<img src="<?php bloginfo('template_directory'); ?>/assets/img/avatar_g.png"
   			<?php else: ?>
           <img src="<?php bloginfo('template_directory'); ?>/assets/img/avatar_b.png"
                <?php endif;?>
   			</a>
      </div>
    <div class="content" style="padding:5px;">
      <a href="<?php the_permalink(); ?>">
        <h4 class="title svg-divider"><?php the_title();?></h4>

        <ul>
          <li><?= $child_meta['age']; ?> <?php _e('Jahre', 'compassion'); ?> | <?= $child_meta['gender']; ?> | <?= $child_meta['country']; ?></li>
        </ul>

      </a>
      <a class="button" href="<?php the_permalink(); ?>"><?php _e('Infos', 'compassion'); ?></a>

    </div>


 </div>

</article>
