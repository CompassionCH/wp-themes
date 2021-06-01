<?php

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'thumbnail_size' );
//ModifJK
$thumb[0] = str_replace('z_0.6','z_0.8,q_70',(str_replace('w_320','w_400',str_replace('h_420','h_400',$thumb[0]))));
$child_meta = get_child_meta(get_the_id());
?>

<article class="column medium-6 large-4 blog-teaser child-teaser child" data-equalizer-watch>
  <div class="content-wrapper">

      <div class="thumb_cont">
 <a href="<?php the_permalink(); ?>">
    <div class="thumbnail" style="background-image: url(<?php echo str_replace('w_270,','w_480,',$thumb[0]); ?>); background-position:center center; ">
    </div>
 </a>
    </div>
      <!--
    <span class="child-waiting"><?php echo $child_meta['waiting_days']; ?></span>


    <div class="single-icon icon-small">
      <object type="image/svg+xml"
              data="<?php bloginfo('template_directory'); ?>/assets/img/person.svg">
        <img src="<?php bloginfo('template_directory'); ?>/assets/img/person.png"
             alt="No SVG support">
      </object>
    </div>
    -->

    <div class="content" style="padding:5px;">
      <a href="<?php the_permalink(); ?>">
        <h4 class="title svg-divider"><?php the_title(); ?></h4>

        <ul>
          <li><!-- <strong>--> <?php /*_e('Land', 'compassion'); */?><!-- </strong>--><?php echo $child_meta['age']; ?> <?php _e('Jahre', 'compassion'); ?> | <?php echo $child_meta['gender']; ?> | <?php echo $child_meta['country']; ?></li>
<!--            <li><strong>--><?php //('Alter', 'compassion');?><!--</strong>--><?php //echo $child_meta['age']; ?><!-- --><?php //_e('Jahre', 'compassion'); ?><!--</li>-->
<!--          <li><strong>--><?php //_e('Geschlecht', 'compassion'); ?><!--</strong>--><?php //echo $child_meta['gender']; ?><!--</li>-->
        </ul>

      <!--  <div class="hover-overlay">
          <h5 class="text-uppercase"><?php /*_e('Erfahre', 'compassion'); echo '<br />'; _e('mehr über', 'compassion'); */?><br /><?php /*the_title(); */?></h5>
        </div>-->
      </a>

    </div>


  </div>

</article>
