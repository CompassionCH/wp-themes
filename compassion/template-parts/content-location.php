<?php the_content();
?>
<div class="section background-beige no-padding-top">
    <div class="row text-center">
        <a href="<?php echo get_the_permalink(get_theme_mod("children-archive")); ?>?my_gender=&my_age_slot=0-50&my_country=<?php echo the_ID();?>" class="button button-blue button-medium"><?php _e('Werde Pate von einem Kind', 'compassion') ?> <?php echo get_post_meta(get_the_id(), '_cmb_country_child_title', true)?></a>
    </div>
</div>