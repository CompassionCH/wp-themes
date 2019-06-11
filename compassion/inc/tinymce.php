<?php

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {

    // Define the style_formats array
    $style_formats = array(
        // Each array child is a format with it's own settings
        array(
            'title' => 'Slider: Spruch',
            'selector' => 'p',
            'classes' => 'quote'
        ),
        array(
            'title' => 'Section: Subtitle',
            'selector' => 'p',
            'classes' => 'subtitle'
        ),
        array(
            'title' => 'Überschrift: Unterstrichen',
            'selector' => 'h1, h2, h3, h4, h5, h6',
            'classes' => 'svg-divider'
        ),
        array(
            'title' => 'Großbuchstaben',
            'selector' => 'h1, h2, h3, h4, h5, h6, p',
            'classes' => 'text-uppercase'
        ),
        array(
            'title' => 'Einleitung',
            'selector' => 'p',
            'classes' => 'text-intro'
        ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

// change color palette
function my_mce4_options($init) {
  $default_colours = '"000000", "Black",
                      "FFFFFF", "White"';

  $custom_colours =  '"215eac", "Compassion: Blau",
                      "88a3ca", "Compassion: Hell-Blau",
                      "333132", "Compassion: Dunkel-Grau"';

  // build colour grid default+custom colors
  $init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';

  // enable 6th row for custom colours in grid
  $init['textcolor_rows'] = 6;

  return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');

?>
