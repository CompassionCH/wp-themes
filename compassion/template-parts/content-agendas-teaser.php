<?php

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'thumbnail_size' );

?>

<article class="column large-3 medium-6 blog-teaser" data-equalizer-watch>
    <div class="content-wrapper">
	<a href="<?php the_permalink(); ?>">
        <div class="thumbnail" style="background-image: url(<?php echo $thumb[0]; ?>);"></div>

        <h5 class="title"><?php the_title(); ?></h5>

        <?php if ( get_post_meta($post->ID, '_agenda_end_date', true) ) : ?>
        <h5 class="date">
            <?php _e('Vom', 'compassion'); ?>
            <?php
            $start_date = get_post_meta(get_the_id(), '_agenda_start_date', true);
            echo date_create($start_date)->format('d.m.Y');
            ?>
            <?php _e('bis', 'compassion'); ?>
            <?php
            $end_date = get_post_meta(get_the_id(), '_agenda_end_date', true);
            echo date_create($end_date)->format('d.m.Y');
            ?>
        </h5>
        <?php else: ?>
        <h5 class="date">
            <?php
            $start_date = get_post_meta(get_the_id(), '_agenda_start_date', true);
            echo date_create($start_date)->format('d.m.Y');
            ?>
        </h5>
        <?php endif ?>

        <div class="content">
        <?php the_excerpt(); ?>
        </div>
    </a>
    </div>
</article>
