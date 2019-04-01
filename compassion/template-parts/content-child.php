<?php

$child_id = get_the_id();
$country_id = get_post_meta($child_id, '_child_country', true);
$child_meta = get_child_meta($child_id);
$child_number = get_post_meta($child_id, '_child_number', true);
$child_reserved = get_post_meta($child_id, '_child_reserved', true) === 'true';
$my_current_lang = apply_filters('wpml_current_language', NULL);

$now = new DateTime();
$now = $now->format('Y-m-d');
$child_expiration = get_post_meta($child_id, '_child_reserved_expiration', true);
$child_expired = $now >= $child_expiration;

if ($child_expired) {
    echo _e('This child has expired', 'compassion');
    exit();
}

function get_buttons_infos()
{
    $base_link = get_the_permalink(get_theme_mod("pate-werden"));
    $child_id = get_the_id();

    return array(
        'lang' => apply_filters('wpml_current_language', NULL),
        'base_link' => $base_link,
        'child_id' => $child_id,
        'title' => get_the_title(),
        'link' => $base_link . '?childid=' . $child_id,
        'classes' => 'button button-large'
    );
}

function get_sponsor_buttons()
{
    $a = get_buttons_infos();
    $res = '<a href="' . $a['link'] . '" class="' . $a['classes'] . '">';
    /* translators: The placeholder references the child's name. */
    $res .= sprintf(__('Werden Sie %ss Pate', 'compassion'),$a['title']);
    $res .= '</a>';
    return $res;
}

function get_page_title($recommend_title = false)
{
    $title = '<h2>';
    if ($recommend_title) {
        /* translators: The placeholder references the child's name. */
        $title .= sprintf(_x('%s einem Freund oder einer Freundin empfehlen', 'title', 'compassion'),get_the_title());
    } else {
        /* translators: The placeholder references the child's name. */
        $title .= sprintf(_x('Werden Sie %ss Pate', 'title', 'compassion'),get_the_title());
    }
    $title .= '</h2>';
    return $title;
}

?>


<div class="section background-blue section_abgerissen_unten has_breadcrumb">

    <div class="row section_breadcrumb">
        <?php compassion_breadcrumb(false); ?>
    </div>

    <div class="row section_row contains-nav">

        <div class="large-10 large-centered column">

            <?php
            $next_post = get_next_post();
            $prev_post = get_previous_post();
            ?>

            <nav class="child-nav">
                <?php if ($prev_post) { ?>
                    <a href="<?php echo get_the_permalink($prev_post->ID); ?>" class="prev"></a>
                <?php } ?>
                <a href="<?php bloginfo('url'); ?>/kinderpatenschaften/finden-sie-ein-patenkind/" class="overview"></a>
                <?php if ($next_post) { ?>
                    <a href="<?php echo get_the_permalink($next_post->ID); ?>" class="next"></a>
                <?php } ?>
            </nav>
            <?= get_page_title(isset($_GET['recommend'])) ?>
        </div>

    </div>
</div>

<div class="section background-beige section_gradient_unten">

    <div class="row profile">
        <div class="large-4 column">

            <div class="image">
                <?php the_post_thumbnail(); ?>
            </div>
            <p><?= get_sponsor_buttons() ?></p>

            <?php
            if (!$child_reserved && method_exists('CompassionChildren', 'recommend_child_button')) {
                CompassionChildren::recommend_child_button(get_the_ID(), get_the_title());
            }
            ?>
        </div>

        <div class="large-8 column">
            <div class="meta">
                <span class="child-number"><?php echo $child_number; ?></span>
                <span class="waiting">
                <p><?php _e('Wartezeit in Tagen', 'compassion'); ?></p>
                <span class="child-waiting"><?php echo $child_meta['waiting_days']; ?></span>
            </span>
            </div>

            <h4 class="svg-divider"><?php the_title(); ?></h4>

            <p class="subtitle">
                <?php the_title();
                if ($my_current_lang == "fr") {
                    echo ($child_meta['gender'] == 'Fille' ? ' est née' : ' est né') . ' le ';
                } elseif ($my_current_lang == "it") {
                    echo ($child_meta['gender'] == 'Fille' ? ' è nata' : ' è nato') . ' il ';
                } else {
                    _e(' wurde am', 'compassion');
                };
                $birthday = $child_meta['birthday'];
                ?>
                <?= ($my_current_lang == 'de' ? date_i18n('j. F Y', $birthday) : date_i18n('j F Y', $birthday)) ?>
                <?= __('geboren und wohnt', 'compassion') . ' ' . get_post_meta($country_id, '_cmb_country_child_title', true) ?>.
            </p>

            <ul>
                <li>
                    <div class="single-icon icon-small">
                        <object type="image/svg+xml"
                                data="<?php bloginfo('template_directory'); ?>/assets/img/person.svg">
                            <img src="<?php bloginfo('template_directory'); ?>/assets/img/person.png"
                                 alt="No SVG support">
                        </object>
                    </div>
                    <span><strong><?php _e('Land', 'compassion'); ?>:</strong> <?= $child_meta['country'] ?></span>
                </li>
                <li>
                    <div class="single-icon icon-small">
                        <object type="image/svg+xml"
                                data="<?php bloginfo('template_directory'); ?>/assets/img/person.svg">
                            <img src="<?php bloginfo('template_directory'); ?>/assets/img/person.png"
                                 alt="No SVG support">
                        </object>
                    </div>
                    <span><strong><?php _e('Alter', 'compassion'); ?>:</strong> <?= $child_meta['age'] ?></span>
                </li>
                <li>
                    <div class="single-icon icon-small">
                        <object type="image/svg+xml"
                                data="<?php bloginfo('template_directory'); ?>/assets/img/person.svg">
                            <img src="<?php bloginfo('template_directory'); ?>/assets/img/person.png"
                                 alt="No SVG support">
                        </object>
                    </div>
                    <span><strong><?php _e('Geschlecht', 'compassion'); ?>:</strong> <?= $child_meta['gender'] ?></span>
                </li>
            </ul>

            <?php the_content(); ?>

        </div>
    </div>
</div>

<div class="slick-slider slick-carousel"
     data-slickSlides="1"
     data-slickScroll="1"
     data-slickArrows="true"
     data-slickDots="true">

    <div class="slide">
        <div class="slide-image"
             style="background-image: url(<?= get_post_meta($country_id, '_cmb_country_photo', true); ?>);">
        </div>
        <div class="slide-content-wrapper">
            <div class="slide-content">
            </div>
        </div>
    </div>

</div>

<div class="section background-beige section_gradient_oben section_gradient_unten">

    <div class="row about">
        <div class="large-6 column">
            <h4 class="text-uppercase"><?php _e('Das Kinderzentrum', 'compassion'); ?>
                <!-- <?php the_title(); ?>s <?php _e('Projekt', 'compassion'); ?> --></h4>
            <div class="content">
                <?php echo wpautop(get_post_meta($child_id, '_child_project', true)); ?>
            </div>
        </div>
        <div class="large-6 column">
            <h4 class="text-uppercase"><?php _e('Das Land', 'compassion'); ?>
                <!-- <?php the_title(); ?>s <?php _e('Land', 'compassion'); ?> --></h4>
            <?php echo wpautop(get_post_meta($country_id, '_cmb_country_info', true)); ?>
        </div>
    </div>
    <div class="text-center">
        <?= get_sponsor_buttons() ?>
    </div>
</div>

<div class="section section-map">
    <div id="child-map" data-icon="<?php echo get_bloginfo('template_directory') ?>/assets/img/marker.png"
         data-title="<?php echo get_the_title($country_id); ?>"
         data-lat="<?php echo get_post_meta($country_id, '_cmb_google_latitude', true); ?>"
         data-lng="<?php echo get_post_meta($country_id, '_cmb_google_longitude', true); ?>">
    </div>
</div>