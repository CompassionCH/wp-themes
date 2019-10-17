<?php

/*
* Template Name: Kinder - Archiv
*/

get_header(); ?>

<?php the_content(); ?>


<!--
<script>
	
jQuery(document).ready(function($) {
	$('#submitorder').attr('disabled', 'disabled');

function updateFormEnabled() {
    if (verifyAdSettings()) {
        $('#submitorder').attr('disabled', '');
    } else {
        $('#submitorder').attr('disabled', 'disabled');
    }
}

function verifyAdSettings() {
    if ($('#gender').val() != '' ) {
        return true;
    } else {
        return false
    }
}

$('#gender').change(updateFormEnabled);
$('#country').change(updateFormEnabled);
});

</script>
-->


<?php
global $wpdb;
$countries = array();
//    $start = microtime();
//    echo '<br/>## start : '.$start.'##';
//    // Get countries in associative array (country id => country name)
//    $country_posts = $wpdb->get_results("SELECT id, post_title FROM compassion_posts WHERE post_type = 'location' ORDER BY post_title ASC ");
//    foreach ($country_posts as $row) {
//        $post_lang = $wpdb->get_var("SELECT language_code FROM compassion_icl_translations WHERE element_type = 'post_location' AND element_id = $row->id");
//        $children = $wpdb->get_results("SELECT DISTINCT meta_value FROM compassion_postmeta WHERE meta_key = '_child_country'", OBJECT_K);
//        $has_child = in_array($row->id, array_keys($children));
//        if ($post_lang == ICL_LANGUAGE_CODE and $has_child) {
////        if ($post_lang == ICL_LANGUAGE_CODE) {
////            $countries[$row->id] = $row->post_title;
//        }
//    }

//    echo '<hr style="clear:both;"/>';
//    echo '<hr style="clear:both;"/>';
//    echo '<hr style="clear:both;"/>';
//    print_r($countries);
//    $end = microtime();
//    echo '<br/>## end : '.$end.' duration : '.($end-$start).' ##';
//    
//    echo '<hr style="clear:both;"/>';
//    echo '<hr style="clear:both;"/>';

//    $start2 = microtime();
//    echo '<br/>## start2 : '.$start2.'##';
//    $country_posts2 = $wpdb->get_results("SELECT DISTINCT pm.meta_value FROM compassion_postmeta pm "
//            . " INNER JOIN compassion_posts p ON p.ID = pm.post_id    "
//            . " WHERE meta_key = '_child_country' "
//            . " AND p.post_type = 'location' ");
$country_posts2 = $wpdb->get_results("SELECT DISTINCT LEFT(pm.meta_value,2) as code "
    . " FROM compassion_postmeta pm "
    . " INNER JOIN compassion_posts p1 ON p1.ID = pm.post_id "
    . " WHERE pm.meta_key = '_child_number' "
    . " AND p1.post_status = 'publish' ");
foreach ($country_posts2 as $id => $c) {
//        echo $c->code;
    $countries_qry = $wpdb->get_results("SELECT pm.post_id, t.translation_id, t.language_code, p.post_title FROM $wpdb->postmeta pm "
        . "INNER JOIN compassion_icl_translations t ON t.element_id = pm.post_id "
        . "INNER JOIN compassion_posts p ON p.ID = pm.post_id "
        . "WHERE meta_value = '$c->code' AND meta_key = '_cmb_country_code'"
        . "AND element_type = 'post_location' "
        . "AND t.language_code = '" . ICL_LANGUAGE_CODE . "' ");
    foreach ($countries_qry AS $row) {
//            echo $row->post_id;
//            echo $row->post_title;
        $countries[$row->post_id] = $row->post_title;
    }
    asort($countries);
//        echo '<br/>';
}
//    $end2 = microtime();
//    echo '<br/>## end2 : '.$end2.' duration : '.($end2-$start2).' ##';


// Retrieve filter state
$gender = $_GET['my_gender'];
$country = $_GET['my_country'];
$age_slot = $_GET['my_age_slot'];
$empty_country = (!isset($country) || $country == '' || $country == 'false');
$empty_gender = (!isset($gender) || $gender == '' || $gender == 'false');
$empty_age_slot = (!isset($age_slot) || $age_slot == '' || $age_slot == 'false');

?>

<div class="section background-beige-gradient background-beige">

    <div class="row section_row posts-container" data-equalizer data-equalize-on="large" id="test-eq">
        <div class="row">
            <div class="filter-box">

                <h4><?php _e('Suche einschränken', 'compassion'); ?></h4>
                <form method="get">
                    <div class="row blog-teaser">
                        <div class="small-6 large-4 column">
                            <select name="my_gender" id="gender" class="postform">
                                <option value="" <?php if ($empty_gender) {
                                    echo 'selected="selected"';
                                } ?> ><?php _e('Wähle ein Mädchen oder einen Jungen', 'compassion'); ?></option>
                                <option value="girl" <?php if ($gender == 'girl') {
                                    echo 'selected="selected"';
                                } ?> ><?php _e('Mädchen', 'compassion'); ?></option>
                                <option value="boy" <?php if ($gender == 'boy') {
                                    echo 'selected="selected"';
                                } ?> ><?php _e('Junge', 'compassion'); ?></option>
                            </select>
                        </div>
                        <div class="small-6 large-4 column">
                            <select name="my_age_slot" id="age_slot" class="postform">
                                <option value="0-50" <?php if ($empty_age_slot) {
                                    echo 'selected="selected"';
                                } ?> ><?php _e('Wähle eine Altersgruppe', 'compassion'); ?></option>
                                <option value="0-3" <?php if ($age_slot == '0-3') {
                                    echo 'selected="selected"';
                                } ?> ><?php _e('0-3 Jahre alt', 'compassion'); ?></option>
                                <option value="4-6" <?php if ($age_slot == '4-6') {
                                    echo 'selected="selected"';
                                } ?> ><?php _e('4-6 Jahre alt', 'compassion'); ?></option>
                                <option value="7-10" <?php if ($age_slot == '7-10') {
                                    echo 'selected="selected"';
                                } ?> ><?php _e('7-10 Jahre alt', 'compassion'); ?></option>
                                <option value="11-14" <?php if ($age_slot == '11-14') {
                                    echo 'selected="selected"';
                                } ?> ><?php _e('11-14 Jahre alt', 'compassion'); ?></option>
                                <option value="15-20" <?php if ($age_slot == '15-50') {
                                    echo 'selected="selected"';
                                } ?> ><?php _e('15 Jahre und älter', 'compassion'); ?></option>
                            </select>
                        </div>
                        <div class="small-12 large-4 column">
                            <select name="my_country" id="country" class="postform" onchange="this.form.submit()">
                                <option value="" <?php if ($empty_country) {
                                    echo 'selected="selected"';
                                } ?> ><?php _e('Wähle ein Land', 'compassion'); ?></option>
                                <?php foreach ($countries as $cid => $cname) { ?>
                                    <option value="<?php echo $cid ?>" <?php if ($country == $cid) {
                                        echo 'selected="selected"';
                                    } ?> ><?php echo $cname ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row button-filter">
                        <div class="small-12 columns">
                            <?php $link = apply_filters('wpml_object_id', '82770', 'page'); ?>

                            <a style="display: none;" class="button-medium button float-right trackclick"
                               href="<?php echo esc_url(get_permalink($link)); ?>?recommend"><?php _e('Ein Kind weiterempfehlen', 'compassion'); ?></a>
                            <a class="button-medium button float-right trackclick"
                               href="<?php echo esc_url(get_permalink($link)); ?>"><?php _e('Für mich auswählen', 'compassion'); ?></a>
                            <a class="button-medium button float-right"
                               href="<?php the_permalink(); ?>"><?php _e('Suche zurücksetzen', 'compassion'); ?></a>
                            <input class="button-medium button float-right" type="submit" name="submit" id="submitorder"
                                   value="<?php _e('Suchen', 'compassion'); ?>"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php

        $exclude_reserved_childs = array('key' => '_child_reserved', 'value' => 'false', 'compare' => 'LIKE');

        if ($empty_country && $empty_gender && $empty_age_slot) {

            $posts_per_page = 24;

            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $args = array(
                'post_type' => 'child',
                'posts_per_page' => $posts_per_page,
                'paged' => $paged,
                'post_status' => 'publish',
                'orderby' => 'meta_value_num title',
                'meta_key' => '_child_start_date',
                'order' => 'asc',
                'meta_query' => $exclude_reserved_childs
            );


        } else {

            $posts_per_page = 24;
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $age_ranges = explode('-', $age_slot);
//    print_r($age_ranges);
//    echo floor((time() - $birthday) / 31556926);
            $slot_start = time() - (365 * 24 * 60 * 60 * $age_ranges[0]);
            $slot_end = time() - (365 * 24 * 60 * 60 * $age_ranges[1]);

//    echo '# slot_start : '.$slot_start.'</br>';
//    echo '# slot_end : '.$slot_end.'<br/>';;

            $query = array(
                'relation' => 'OR',
                array('key' => '_child_gender', 'value' => $gender, 'compare' => 'LIKE'),
                array('key' => '_child_country', 'value' => $country, 'compare' => 'LIKE'),
                array('key' => '_child_birthday', 'value' => array($slot_end, $slot_start), 'compare' => 'BETWEEN', 'type' => 'numeric')
            );
            if (($gender != 'false' and $country != 'false') or
                ($gender != 'false' and $age_slot != 'false') or
                ($country != 'false' and $age_slot != 'false') or
                ($gender != 'false' and $country != 'false' and $age_slot != 'false'))
                $query['relation'] = 'AND';

            $args = array(
                'post_type' => array('child'),
                'posts_per_page' => $posts_per_page,
                'paged' => $paged,
                'post_status' => 'publish',
                'orderby' => 'meta_value_num title',
                'meta_key' => '_child_start_date',
                'meta_query' => array('relation' => 'AND', $query, $exclude_reserved_childs),
                'order' => 'asc'
            );

        };

        $query = compassion_query($args);


        if ($query->have_posts()) :
            while ($query->have_posts()): $query->the_post();
                ?>

                <?php get_template_part('template-parts/content', 'child-teaser'); ?>

            <?php endwhile; ?>
        <?php else : ?>
            <?php get_template_part('template-parts/content', 'none'); ?>
        <?php endif; ?>


    </div>

    <div class="row section_row">


        <!-- 	  	  <div class="navigation text-center"><p><?php posts_nav_link(' ', '', ''); ?></p></div> -->


        <?php if (intval($query->found_posts) > $posts_per_page) : ?>


            <div class="button-center-wrapper">

                <a href="#" class="button button-beige button-center button-medium button-load-more"
                   data-paged="<?php echo $paged + 1; ?>" data-maxPages="<?php echo $query->max_num_pages; ?>"
                   data-query="<?php echo htmlspecialchars(json_encode($args)); ?>"><?php _e('Mehr Kinder anzeigen', 'compassion'); ?></a>

            </div>

        <?php endif; ?>

    </div>

</div>

<div class="full reveal" id="download-order-modal" data-reveal>

    <div class="row">
        <div class="large-12 column">
            <?php echo do_shortcode(get_theme_mod("downloads-form")); ?>
        </div>
    </div>

    <button class="close-button close" data-close aria-label="Close reveal" type="button">
    </button>
</div>

<?php get_footer(); ?>
