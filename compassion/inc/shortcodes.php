<?php
function compassion_register_shortcode_button() {
    add_shortcode('button', 'compassion_buttons');
    if(function_exists('shortcode_ui_register_for_shortcode')) {
        $args = array(
            'label' => __('Insert button', 'compassion'),
            'listItemImage' => 'dashicons-marker',
            'inner_content' => array(
                'label' => __('Button text', 'compassion'),
                'description' => __('The text shown in the button.', 'compassion'),
            ),
            'attrs' => array(
                array(
                    'label' => __('Link', 'compassion'),
                    'attr' => 'href',
                    'description' => __('The URL to go to after clicking.', 'compassion'),
                    'type' => 'url',
                ),
                array(
                    'label' => __('Size', 'compassion'),
                    'attr' => 'size',
                    'description' => __('The size of the button.', 'compassion'),
                    'type' => 'select',
                    'options' => array(
                        array('value' => 'small', 'label' => __('Small', 'compassion')),
                        array('value' => 'medium', 'label' => __('Medium', 'compassion')),
                        array('value' => 'large', 'label' => __('Large', 'compassion')),
                    ),
                ),
                array(
                    'label' => __('Color', 'compassion'),
                    'attr' => 'color',
                    'description' => __('The color of the button.', 'compassion'),
                    'type' => 'select',
                    'options' => array(
                        array('value' => 'blue', 'label' => __('Blue', 'compassion')),
                        array('value' => 'beige', 'label' => __('Beige', 'compassion')),
                    ),
                ),
            ),
        );
        shortcode_ui_register_for_shortcode('button', $args);
    }
}

/**
 * Called by the "button" shortcode.
 */
function compassion_buttons($attrs, $content = null) {
    extract(shortcode_atts(array(
        'href' => '#',
        'size' => 'large',
        'color' => 'blue'
    ), $attrs));

    return '<a href="'.$href.'" class="button button-'.$color.' button-'.$size.'">'.$content.'</a>';
}
//[button href="link" size="large"]text[/button]

/*add shortcode who display variable from url get parameter */
if( ! function_exists('this_is_my_shortcode') ) {
    function this_is_my_shortcode( $atts, $content = null ) {
        // Attributes
        $atts = shortcode_atts( array(
            'short_prenom'    => isset($_GET['short_prenom']) ? sanitize_key($_GET['short_prenom']) : '',
        ), $atts, 'nom_contact' );

        // Variables to be use
        $value1 = $atts['short_prenom']; // the value from "thekey1" in the url

        if( ! empty( $value1 ) ){


        // Output: Always use return (never echo or print)
        return  '<h3>'. __('Bonjour ','compassion') . $value1 .'</h3>';}
    }
    add_shortcode("nom_contact", "this_is_my_shortcode");
}

/**
 * Function to register all the shortcode of the theme.
 */
function compassion_shortcode_init() {
  compassion_register_shortcode_button();
}
add_action('init', 'compassion_shortcode_init');
