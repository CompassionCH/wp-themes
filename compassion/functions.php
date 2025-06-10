<?php

/* PHP USE SESSION https://silvermapleweb.com/using-the-php-session-in-wordpress/ */
add_action('init', 'myStartSession', 1);
add_action('wp_logout', 'myEndSession');
add_action('wp_login', 'myEndSession');

function myStartSession() {
    if(!session_id()) {
        session_start();
    }
    if(isset($_GET['utm_source']) AND $_GET['utm_source']!='') {
        $_SESSION['utm_source'] = $_GET['utm_source'];
    }
    if(isset($_GET['utm_campaign']) AND $_GET['utm_campaign']!='') {
        $_SESSION['utm_campaign'] = $_GET['utm_campaign'];
    }
    if(isset($_GET['utm_medium']) AND $_GET['utm_medium']!='') {
        $_SESSION['utm_medium'] = $_GET['utm_medium'];
    }
    if (isset($_GET['participantId'], $_GET['participantName'], $_GET['eventId'])) {
        $_SESSION['consumer_source'] = 'msk_'.$_GET['eventId'];
        $_SESSION['consumer_source_text'] = 'msk_'.$_GET['participantId'];
        $_SESSION['msk_participant_name'] = $_GET['participantName'];
        $_SESSION['msk_name'] = $_GET['eventName'];
    }
}

// Add query vars for utm tracking and form autofill
function add_query_vars( $vars ){
    $vars[] = "utm_source";
    $vars[] = "utm_medium";
    $vars[] = "utm_campaign";

    $vars[] = "email";
    $vars[] = "cname";
    $vars[] = "pname";
    $vars[] = "firstname";
    $vars[] = "pstreet";
    $vars[] = "pzip";
    $vars[] = "pcity";
    $vars[] = "pcountry";
    $vars[] = "sponsor_ref";
    $vars[] = "child_ref";
    $vars[] = "fund_code";
    $vars[] = "fund_amount";
    return $vars;
}
add_filter( 'query_vars', 'add_query_vars' );

// Extract query_vars if present and put them in session so that it's carried over the session
function put_data_in_session() {
    $query_vars = array("utm_source", "utm_campaign", "utm_medium", "email", "cname", "pname", "firstname", "pstreet", "pzip", "pcity", "pcountry", "sponsor_ref", "child_ref", "fund_code", "fund_amount");
    foreach ($query_vars as $query_var) {
        $value = get_query_var($query_var);
        if (!empty($value))
            $_SESSION[$query_var] = $value;
    }
}
add_action( 'template_redirect', 'put_data_in_session' );

//  let wordpress create page-titles
add_theme_support( 'title-tag' );

//	enable custom navigation
add_theme_support( 'menus' );

//  enable post-thumbnails
add_theme_support( 'post-thumbnails' );

//  Switch default core markup for search form, comment form, and comments
//  to output valid HTML5.
add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
) );

/* make post and page list sortable by modification date */

// Add the custom column to the post type
add_filter( 'manage_pages_columns', 'itsg_add_custom_column' );
add_filter( 'manage_posts_columns', 'itsg_add_custom_column' );
function itsg_add_custom_column( $columns ) {
    $columns['modified'] = 'Dernière modification';

    return $columns;
}

// Add the data to the custom column
add_action( 'manage_pages_custom_column' , 'itsg_add_custom_column_data', 10, 2 );
add_action( 'manage_posts_custom_column' , 'itsg_add_custom_column_data', 10, 2 );
function itsg_add_custom_column_data( $column, $post_id ) {
    switch ( $column ) {
        case 'modified' :
            $date_format = 'd/m/Y';
            $post = get_post( $post_id );
            echo get_the_modified_date( $date_format, $post ); // the data that is displayed in the column
            break;
    }
}

// Make the custom column sortable
add_filter( 'manage_edit-page_sortable_columns', 'itsg_add_custom_column_make_sortable' );
add_filter( 'manage_edit-post_sortable_columns', 'itsg_add_custom_column_make_sortable' );
function itsg_add_custom_column_make_sortable( $columns ) {
    $columns['modified'] = 'modified';

    return $columns;
}

// Add custom column sort request to post list page
add_action( 'load-edit.php', 'itsg_add_custom_column_sort_request' );
function itsg_add_custom_column_sort_request() {
    add_filter( 'request', 'itsg_add_custom_column_do_sortable' );
}

// Handle the custom column sorting
function itsg_add_custom_column_do_sortable( $vars ) {
    // check if sorting has been applied
    if ( isset( $vars['orderby'] ) && 'modified' == $vars['orderby'] ) {

        // apply the sorting to the post list
        $vars = array_merge(
            $vars,
            array(
                'orderby' => 'ASC'
            )
        );
    }

    return $vars;
}
/* END make post and page list sortable by modification date */

//* Remove Contact Form 7 js file
/*
function rvam_deregister_cf7_scripts() {
	if ( is_page(1684) || is_page(13579) || is_page(9467) ) {
		wp_deregister_script( 'contact-form-7' );
    }
}
add_action( 'wp_print_scripts', 'rvam_deregister_cf7_scripts', 100 );
*/


function _remove_script_version( $src ){
    $parts = explode( '?ver', $src );
    return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );



//  load scripts and styles
function enqueue_scripts() {
    wp_enqueue_script("jquery");
   // wp_enqueue_script( 'im_livechat', 'https://stage.compassion.ch/im_livechat/external_lib.js', array( 'jquery' ) );
    wp_enqueue_style( 'screen', get_template_directory_uri().'/assets/css/screen.css' , array(), null );
    wp_enqueue_script( 'foundation-js', '//cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/js/foundation.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'on-scroll-js', get_template_directory_uri() . '/assets/js/on-scroll.js', array('jquery', 'foundation-js'), '', true );
    wp_register_script( 'compassion-main-js', get_template_directory_uri() . '/assets/js/main-min.js', array( 'jquery', 'foundation-js' ), '', true );
    if (! is_front_page()) {

        wp_enqueue_script( 'jquery-ui-datepicker' );
        wp_enqueue_script( 'icheck-js', '//cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js', array( 'jquery' ) );
        wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?key=' . GMAP_API_KEY . '', array(), '', true);
        wp_enqueue_script('validation-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js', array('jquery'));
    }


    $main_js_data = array(
        'ajaxurl' => admin_url('admin-ajax.php')
    );
    wp_localize_script( 'compassion-main-js', 'main_js_data', $main_js_data );

    wp_enqueue_script( 'compassion-main-js' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

/*load some styles in footer */

function prefix_add_footer_styles() {
    wp_enqueue_style( 'slick', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css' , array(), null );
    wp_register_style( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css' );
    wp_enqueue_style( 'jquery-ui' );
 //  wp_enqueue_style( 'im_chat', 'https://stage.compassion.ch/im_livechat/external_lib.css' , array(), null );
    wp_enqueue_script( 'masonry-js', '//cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js', array('jquery') );
    wp_enqueue_script( 'slick-js', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery') );
    wp_enqueue_script( 'moment-js', '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js', array('jquery') );
    wp_enqueue_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' , array(), null );

};
add_action( 'get_footer', 'prefix_add_footer_styles' );


/* disable CF7 scripts on non form pages */


//reCaptcha V3 adjustments
add_action( 'wp_enqueue_scripts', 'gbol_remove_wpcf7_resources_if_no_contact_form', 1 );
function gbol_remove_wpcf7_resources_if_no_contact_form() {
    global $post, $gbol_css_dependencies, $abcf7;

    if ( isset( $post ) && is_singular() && has_shortcode( $post->post_content, 'contact-form-7' ) ) {
        return;
    }

    add_filter( 'wpcf7_load_js', '__return_false' );
    add_filter( 'wpcf7_load_css', '__return_false' );
    remove_action( 'wp_enqueue_scripts', 'wpcf7_recaptcha_enqueue_scripts', 20 );
}



function new_excerpt_more( $more ) {
    return '<span class="excerpt_more">...</span>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

function custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//	Post-Formats
add_theme_support( 'post-formats', array(
    'aside',
    'gallery',
    'quote',
    'status',
    'audio',
    'chat',
    'link',
    'image',
    'video',
) );



// cleanup
require_once 'inc/cleanup.php';

//	Elementor - Functions
require_once 'inc/elementor-functions.php';

//	SiteOrigin - Functions
require_once 'inc/siteorigin/functions.php';

// Metaboxes
require_once 'inc/metaboxes.php';

// TinyMCE
require_once 'inc/tinymce.php';

// Shortcodes
require_once 'inc/shortcodes.php';

// Widgets
require_once 'inc/widget.php';

// Customizer
require_once 'inc/customizer.php';

// Adds support for multiple languages
require_once(get_template_directory().'/assets/lang/translation.php');

/*
*	Add class to body
*/
add_filter('body_class', 'compassion_body_classes');
function compassion_body_classes($classes) {
    global $post;

    if( get_post_meta($post->ID, '_cmb_header_over_content', true) != '' || get_post_type($post->ID) == 'location' ) {
        $classes[] = 'header-absolute';
    }

    return $classes;
}


/*
* add class to random child template
*/

function prefix_conditional_body_class( $classes ) {
    if( is_page_template('random.php') )
        $classes[] = 'single-child' ;
    $classes[] = 'child-template-default' ;
    return $classes;
}
add_filter( 'body_class', 'prefix_conditional_body_class' );

/*
*  end add class to random child template
*/

function compassion_breadcrumb( $overview_button = false ) {
    // Settings
    $separator          = '<span class="triangle"></span>';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = __('Home', 'compassion');

    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = '';

    // Get the query & post information
    global $post,$wp_query;

    // Do not display on the homepage
    if ( !is_front_page() ) {

        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';

        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {

            echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . post_type_archive_title(null, false) . '</span></li>';

        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';

            }

            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . $custom_tax_name . '</span></li>';

        } else if ( is_single() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                if($post_type == 'location') {
                    $post_type_archive = get_the_permalink(get_theme_mod("location-archive"));
                }

                /*
                                if($post_type == 'agendas') {
                                    $post_type_archive = get_the_permalink(get_theme_mod("agendas-archive"));
                                }
                */

                if($post_type_object->name == 'child') {
                    echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . get_the_permalink(get_theme_mod("children-archive")) . '" title="' . $post_type_object->labels->name . '">' . __('Kinderpatenschaft', 'compassion') . '</a></li>';
                    echo '<li class="separator"> ' . $separator . ' </li>';
                    echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . get_the_permalink(get_theme_mod("children-archive")) . '" title="' . $post_type_object->labels->name . '">' . __('Pate werden', 'compassion') . '</a></li>';
                    echo '<li class="separator"> ' . $separator . ' </li>';
                } else {
                    echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                    echo '<li class="separator"> ' . $separator . ' </li>';
                }

            }

            // Get post category info
            $category = get_the_category();

            if(!empty($category)) {

                // Get last category post is in
                $category_param = array_values($category);
                $last_category = end($category_param);

                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }

            }

            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;

            }


            // Check if the post is in a category or not
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';

                // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {

                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';

            } else {

                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';

            }

        } else if ( is_category() ) {

            // Category page
            echo '<li class="item-current item-cat"><span class="bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';

        } else if ( is_page() ) {

            $parents = '';

            // Standard page
            if( $post->post_parent ){

                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    if(get_post_meta($ancestor, '_cmb_no_content', true) != '') {
                        // page has no content
                        $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><span class="not-active">' . get_the_title($ancestor) . '</span></li>';
                        $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                    } else {
                        $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                        $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                    }


                }

                // Display parent pages
                echo $parents;

                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></li>';

            } else {

                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</span></li>';

            }

        } else if ( is_tag() ) {

            // Tag page

            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;

            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><span class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</span></li>';

        } elseif ( is_day() ) {

            // Day archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';

            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><span class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</span></li>';

        } else if ( is_month() ) {

            // Month Archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><span class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</span></li>';

        } else if ( is_year() ) {

            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><span class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</span></li>';

        } else if ( is_author() ) {

            // Auhor archive

            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><span class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</span></li>';

        } else if ( get_query_var('paged') ) {

            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><span class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</span></li>';

        } else if ( is_search() ) {

            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><span class="bread-current bread-current-' . get_search_query() . '" title="'. __('Suchergebnisse für', 'compassion') .': ' . get_search_query() . '">'. __('Suchergebnisse für', 'compassion') .': ' . get_search_query() . '</span></li>';

        } elseif ( is_404() ) {

            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        } elseif ( is_home() ) {

            // 404 page
            echo '<li class="item-current"><span class="bread-current">' . __('News', 'compassion') . '</span></li>';
        }

        echo '</ul>';

        if( $overview_button != false ) {
            echo '<a href="'.$overview_button.'" class="back-to-overview"></a>';
        }

    }
}

function get_child_meta( $child_post_id ) {
    $post_thumbnail_id = get_post_thumbnail_id( $child_post_id );

    $birthday = get_post_meta( $child_post_id, '_child_birthday', true );
    $waiting_since = get_post_meta( $child_post_id, '_child_start_date', true );
    $photo = wp_get_attachment_image_src( $post_thumbnail_id );
    $gender = get_post_meta( $child_post_id, '_child_gender', true );

    if( $gender == 'boy' ) {
        $gender = __('Junge', 'compassion');
    } else {
        $gender = __('Mädchen', 'compassion');
    }

    return array(
        'name'				=>	get_post_meta( $child_post_id, '_child_name', true ),
        'short_desc'		=>	get_post_meta( $child_post_id, '_child_short_desc', true ),
        'country'			=>	get_the_title(get_post_meta( $child_post_id, '_child_country', true )),
        'birthday'			=>	get_post_meta( $child_post_id, '_child_birthday', true ),
        'description'		=>	get_post_meta( $child_post_id, '_child_description', true ),
        'photo'				=>	$photo[0],
        'age'				=>	floor((time() - $birthday) / 31556926),
        'waiting_days'	    =>	floor( (time() - $waiting_since) /(60*60*24)),
        'gender'			=>	$gender,
        'gender_type'		=>	get_post_meta( $child_post_id, '_child_gender', true ),
        'portrait'          =>  get_post_meta($child_post_id, '_child_portrait', true),
        'permalink'         =>  get_the_permalink($child_post_id),
        'number'            =>  get_post_meta($child_post_id, '_child_number', true)
    );
}

function compassion_query( $query_args ) {

    global $wp_query;

    $wp_query = new WP_Query( $query_args );

    return $wp_query;

}

global $loaded_children;

add_action( 'wp_ajax_compassion_ajax_query', 'compassion_ajax_query' );
add_action( 'wp_ajax_nopriv_compassion_ajax_query', 'compassion_ajax_query' );
function compassion_ajax_query( ) {
    $args = $_GET['query'];

    $args['paged'] = $_GET['paged'];

    echo '<div class="hidden hide">';
    var_dump($args);
    echo '</div>';

    $query = compassion_query($args);

    echo '<div class="hidden hide">';
    var_dump($query);
    echo '</div>';

    while( $query->have_posts() ) : $query->the_post();

        get_template_part( 'template-parts/content', get_post_type().'-teaser' );

    endwhile;

    die();

}

add_action( 'wpcf7_init', 'custom_add_shortcode_clock' );

function custom_add_shortcode_clock() {
    wpcf7_add_form_tag( 'downloads', 'downloads_shortcode_handler' );
}

function downloads_shortcode_handler( $tag ) {
    $tag = new WPCF7_FormTag( $tag );

    $input = '';

    $query = new WP_Query(array(
        'post_type'				=>	'download',
        'posts_per_page'	=>	'-1',
        'meta_field'			=>	'_download_order',
        'meta_value'			=>	'on'
    ));

    $input .= '<div class="download-items">';

    $j = 0;
    foreach( $query->posts as $post ) {

        $input .= '<div class="download-wrapper column medium-6">';
        $input .= '<h5>'.$post->post_title.'</h5>';
        $input .= '<input type="hidden" name="download['.$j.'][title]" value="'.$post->post_title.'" />';
        $input .= '<div class="select-wrapper"><select name="download['.$j.'][amount]" class="input-field" id="download_'.$post->ID.'">';

        for($i = 0; $i < 11; $i++) {
            $input .= '<option value="'.$i.'">'.$i.'</option>';
        }

        $input .= '</select></div>';
        $input .= '</div>';

        $j++;

    }

    $input .= '</div>';

    return $input;
}

add_filter( 'wpcf7_special_mail_tags', 'your_special_mail_tag', 10, 3 );

function your_special_mail_tag( $output, $name, $html ) {
//    echo '<pre>'.print_r($_POST['download'], true).'</pre>';
    if ( 'show-downloads' == $name ) {
        $downloads = $_POST['download'];
        $output = '';

        foreach($downloads as $download) {
            $output .= $download['title'] . ': ' . $download['amount'] . '<br />';
        }
    }


    return $output;
}

/**
 * remove line break from excerpt
 */
add_filter( 'get_the_excerpt', 'wpse162725_ltrim_excerpt' );

function wpse162725_ltrim_excerpt( $excerpt ) {
    return preg_replace("/&nbsp;/", "", $excerpt);;
}

/*filter archive page by date*/

add_action( 'pre_get_posts', 'my_change_sort_order');
function my_change_sort_order($query){
    if(is_archive()):
        //If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
        //Set the order ASC or DESC
        $query->set( 'order', 'DESC' );
        //Set the orderby
        $query->set( 'orderby', 'date' );
    endif;
};

/*add pdf filter media page */


function modify_post_mime_types( $post_mime_types ) {

    // select the mime type, here: 'application/pdf'
    // then we define an array with the label values

    $post_mime_types['application/pdf'] = array( __( 'PDFs' ), __( 'Manage PDFs' ), _n_noop( 'PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>' ) );

    // then we return the $post_mime_types variable
    return $post_mime_types;

}

// Add Filter Hook
add_filter( 'post_mime_types', 'modify_post_mime_types' );
/** remove total cache logs**/

// Disable W3TC footer comment for all users
add_filter( 'w3tc_can_print_comment', '__return_false', 10, 1 );

//translate date format

function translate_date_format($format) {
    if (function_exists('icl_translate'))
        $format = icl_translate('Formats', $format, $format);
    return $format;
}



add_filter('option_date_format', 'translate_date_format');


function myEndSession() {
    session_destroy ();
}
// disable langage selector on login screen
add_filter( 'login_display_language_dropdown', '__return_false' );


//add optin mailchimp in elementor forms
add_filter('pre_http_request', function ($preempt, $parsed_args, $url) {
    // Only run this code when an Elementor Pro form has been submitted
    if (!isset($_POST['action']) || $_POST['action'] != 'elementor_pro_forms_send_form') {
        return $preempt;
    }

    // Only run this when trying to contact the Mailchimp API
    if (strpos($url, 'api.mailchimp.com') !== false) {
        $form_fields = $_POST['form_fields'] ?? [];

        if (!is_array($form_fields) || empty($form_fields)) {
            return $preempt;
        }

        // Check if there is an opt-in field defined (hidden field)
        if (array_key_exists('newsletter_optin_field', $form_fields)) {
            $optin_field = $form_fields['newsletter_optin_field'];

            // Check if the user hasn't opted in (hasn't ticked the box)
            if (!array_key_exists($optin_field, $form_fields)) {
                // Short-circuit Mailchimp API call
                return [
                    'headers' => '',
                    'body' => '{"simulation":true}',
                    'response' => [
                        'code' => '200',
                        'message' => 'OK',
                    ],
                    'cookies' => '',
                    'filename' => '',
                ];
            }
        }
    }

    return $preempt;
}, 10, 3);

// Disable the pingback functionality, which is often used as a vector for DDoS attacks or spam.
add_filter('xmlrpc_methods', function($methods) {
  unset($methods['pingback.ping']);
  return $methods;
});

// Block user enumeration
if (!is_admin()) {
	// Check if the query string contains "author" with a number value
	if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) {
		// Terminate the script execution if the query string matches the pattern
		die();
	}

	// Add a filter to modify the redirect URL
	add_filter('redirect_canonical', 'shapeSpace_check_enum', 10, 2);
}

// Check and modify redirect URL
function shapeSpace_check_enum($redirect, $request) {
	// Check if the requested URL contains "author" with a number value
	if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) {
		// Terminate the script execution if the requested URL matches the pattern
		die();
	} else {
		// Return the initial redirect URL if the requested URL doesn't match the pattern
		return $redirect;
	}
}

function custom_override_iframe_give_template_styles() {
    wp_enqueue_style('givewp-iframes-styles', get_template_directory_uri() . '/assets/css/givewp.css', 'give-classic-template'
    );
}
add_action('wp_print_styles', 'custom_override_iframe_give_template_styles', 10);


/**
 * AUTO-POPULATE DONATION CAUSE FROM URL STRING
 *
 * This snippet will auto-populate the Give form cause dropdown
 * from a defined parameter in your URL.
 * EXAMPLE: https://example.com/donations/give-form/?cause=education
 *
 * @param int $form_id The form ID this is being output to.
 * @param array $args An array of configurations for the form.
 */
add_action( 'give_post_form_output', 'give_populate_cause', 10, 2 );

function give_populate_cause($form_id, $args) {
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get cause param in the url
            var params = new URLSearchParams(window.location.search);
            var cause = params.get('cause');
			// If the param exist
            if (cause) {
                // Get the select list
                var selectElement = document.querySelector('.give-funds-select');
                if (selectElement) {
                    // Try to match the param text or id to the select list options
                    var matchingOption = Array.from(selectElement.options).find(function(option) {
                        return option.value === cause || option.dataset.description === cause;
                    });

                    // If an option change select list value
                    if (matchingOption) {
                        selectElement.value = matchingOption.value;
                        selectElement.dispatchEvent(new Event('change'));
                    }
                }
            }
        });
    </script>
    <?php
}


function add_custom_redirect_script() {
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function updateUrlParameter(url, param, paramValue) {
                var newUrl = new URL(url);
                newUrl.searchParams.set(param, paramValue);
                return newUrl.toString();
            }

            // Detect all button having ID that starts with "donationButton"
            var buttons = document.querySelectorAll('[id^="donationButton"]');

            buttons.forEach(function(button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault(); // avoid button's default behaviour

                    // Extract param name from button's ID
                    var cause = button.id.replace('donationButton', '').toLowerCase();

                    // Get current ULR
                    var currentUrl = window.location.href;

                    // Update URL (avoid double params)
                    var targetURL = updateUrlParameter(currentUrl, 'cause', cause)

					// Add anchor in the url if not there yet
					if (!targetURL.includes('#give')) {
                        targetURL += "#give";
                    }

                    // Redirection
                    window.location.href = targetURL;
                });
            });
        });
    </script>
    <?php
}
add_action('wp_footer', 'add_custom_redirect_script');