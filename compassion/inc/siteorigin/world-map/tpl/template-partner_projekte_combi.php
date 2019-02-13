<?php

$locations = new WP_Query(array(
    'post_type' => array('location'),
    'posts_per_page' => '-1',
    'orderby' => 'name',
    'order' => 'ASC' ,
    'tax_query' => array(
        'relation' => 'OR',
        array(
            'taxonomy' => 'location-category',
            'field' => 'name',
            'terms' => __('Projektländer', 'compassion'),
            
        ),
        array(
            'taxonomy' => 'location-category',
            'field' => 'name',
            'terms' => __('Partnerländer', 'compassion'),
        ),
    ),
));

$locations_array = array();

while( $locations->have_posts() ) {
    $locations->the_post();

    $terms = wp_get_post_terms(get_the_id(), 'location-category');
    $url = get_post_meta(get_the_id(), '_cmb_country_url', true);

    $locations_array[$terms[0]->term_id][] = array(
        'latitude' => get_post_meta(get_the_id(), '_cmb_latitude', true),
        'longitude' => get_post_meta(get_the_id(), '_cmb_longitude', true),
        'title' =>  get_the_title(),
        'permalink' => ($url == '') ? get_the_permalink() : $url,
        'link-text' => get_post_meta(get_the_id(), '_cmb_link_text', true)
    );

}

?>

<div class="world-map">

    <div class="interactive-map">
        <div class="image"></div>
        <div class="map-markers">
            <?php while ($locations->have_posts()) : $locations->the_post(); ?>
                <?php
                    $terms = get_the_terms(get_the_id(), 'location-category');
                    $url = get_post_meta(get_the_id(), '_cmb_country_url', true);
                ?>
                <div class="marker <?php echo ($terms[0]->name == __('Partnerländer', 'compassion')) ? 'green' : '' ; ?>"
                     style="left: <?php echo get_post_meta(get_the_id(), '_cmb_latitude', true); ?>; top: <?php echo get_post_meta(get_the_id(), '_cmb_longitude', true); ?>;">
                    <div class="infobox">
                        <h5 class="title svg-divider"><?php the_title(); ?></h5>
                        <a target="_parent" href="<?php echo ($url == '') ? get_the_permalink() : $url; ?>"><?php _e('Erfahren Sie mehr', 'compassion')?></a>

                    </div>
                </div>

            <?php endwhile; ?>
        </div>
    </div>

    <div class="accordion-wrapper">
        <ul class="accordion" data-accordion data-allow-all-closed="true">
            <?php while ($locations->have_posts()) : $locations->the_post();
                $url = get_post_meta(get_the_id(), '_cmb_country_url', true);
                ?>

                <li class="accordion-item" data-accordion-item>
                    <a href="<?php echo ($url == '') ? get_the_permalink() : $url; ?>" class="accordion-title"><?php the_title(); ?></a>
                </li>

            <?php endwhile; ?>

        </ul>
    </div>

    <div class="items row">
        <?php
        foreach( $locations_array as $term_id => $group ) {
            $term = get_term_by('id', $term_id, 'location-category');
            ?>
            <div class="medium-12 column">
                <h5 class="medium-12 column cat-<?php echo sanitize_title($term->name) ?>">
	                <?php if($term->name == 'Projektländer'){
		                echo __('PROJEKTLÄNDER', 'compassion');
	                	}
						else{
		                echo __('PARTNERLÄNDER', 'compassion');
	                	}
					?> 
	                
                </h5>

                <?php foreach( $group as $location ) {
                    ?>
                    <a
                        class="item medium-3 column"
                        data-lat="<?php echo $location['latitude']; ?>"
                        data-lng="<?php echo $location['longitude']; ?>"
                        href="<?php echo $location['permalink']; ?>"
                        data-linktext="<?php echo $location['link-text']; ?>"
                    ><?php echo $location['title']; ?></a>
                    <?php
                } ?>

            </div>
            <?php

        }
        ?>
    </div>



</div>

<?php wp_reset_postdata(); ?>
