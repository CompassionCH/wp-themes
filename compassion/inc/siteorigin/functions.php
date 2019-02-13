<?php

  //register page builder folder
  function register_page_builder_folder($folders){
      $folders[] = get_template_directory() ."/inc/siteorigin/";
      return $folders;
  }
  add_filter('siteorigin_widgets_widget_folders', 'register_page_builder_folder');

  function custom_row_style_fields($fields) {

    unset($fields['background']);
    unset($fields['background_image_attachment']);
    unset($fields['background_display']);
    unset($fields['border_color']);

    //  custom row option: background
    $fields['section_background'] = array(
        'name'        => __('Hintergrund', 'compassion'),
        'type'        => 'select',
        'group'       => 'design',
        'description' => __('Wählen Sie einen Hintergrund für die Zeile aus', 'compassion'),
        'priority'    => 8,
        'options' => array(
  				'' => __('Standard', 'compassion'),
          'background-blue' => __('Blau', 'compassion'),
          'background-beige' => __('Beige', 'compassion'),
          'background-beige-gradient' => __('Beige Farbverlauf', 'compassion'),
          'background-image' => __('Bild', 'compassion')
  			),
    );

    $fields['section_background_image'] = array(
        'name'        => __('Hintergrundbild', 'compassion'),
        'type'        => 'text',
        'group'       => 'design',
        'description' => __('', 'compassion'),
    );

    //  custom row option: background
    $fields['section_full_width'] = array(
        'name'        => __('Ganze Breite', 'compassion'),
        'type'        => 'checkbox',
        'group'       => 'design',
        'description' => __('', 'compassion'),
    );

    $fields['section_abgerissen_oben'] = array(
        'name'        => __('Oben abgerissen', 'compassion'),
        'type'        => 'checkbox',
        'group'       => 'design',
        'description' => __('', 'compassion'),
    );

    $fields['section_abgerissen_unten'] = array(
        'name'        => __('Unten abgerissen', 'compassion'),
        'type'        => 'checkbox',
        'group'       => 'design',
        'description' => __('', 'compassion'),
    );

    $fields['section_gradient_oben'] = array(
        'name'        => __('Oben Farbverlauf', 'compassion'),
        'type'        => 'checkbox',
        'group'       => 'design',
        'description' => __('', 'compassion'),
    );

    $fields['section_gradient_unten'] = array(
        'name'        => __('Unten Farbverlauf', 'compassion'),
        'type'        => 'checkbox',
        'group'       => 'design',
        'description' => __('', 'compassion'),
    );

    $fields['anker_section_nr'] = array(
        'name'        => __('Anker-Section Nr.', 'compassion'),
        'type'        => 'text',
        'group'       => 'design',
        'description' => __('Die angegebene Nummer entscheidet welche Menüpunkt eines Submenüs aktiv wird.', 'compassion'),
        'default'     =>  '0'
    );

    $fields['breadcrumb'] = array(
        'name'        => __('Breadcrumb anzeigen', 'compassion'),
        'type'        => 'checkbox',
        'group'       => 'design',
    );

      $fields['remove_margin_bottom'] = array(
          'name'        => __('Abstand unten entfernen', 'compassion'),
          'type'        => 'checkbox',
          'group'       => 'design',
      );

      $fields['matchHeight'] = array(
          'name'        => __('Gleich große Boxen', 'compassion'),
          'type'        => 'checkbox',
          'group'       => 'design',
      );

    return $fields;
  }
  add_filter( 'siteorigin_panels_row_style_fields', 'custom_row_style_fields' );


  //  add DIV.row to siteorigin-rows
  function custom_panels_before_row( $str, $attributes, $args ) {

    $classes = array();
    $color = array();
    $data_attr = array();

    if( !empty( $attributes['style']['section_background'] ) ) {
        $classes[] = $attributes['style']['section_background'];
        $color[] = 'color_'.$attributes['style']['section_background'];

        if($attributes['style']['section_background'] == 'background-beige-gradient') {
          $classes[] = 'background-beige';
        }
    }

    if( !empty( $attributes['style']['section_style'] ) ) {
        $classes[] = $attributes['style']['section_style'];
    }
    if( !empty( $attributes['style']['section_abgerissen_unten'] ) ) {
        $classes[] = 'section_abgerissen_unten';
    }
    if( !empty( $attributes['style']['section_abgerissen_oben'] ) ) {
        $classes[] = 'section_abgerissen_oben';
    }
    if( !empty( $attributes['style']['remove_margin_bottom'] ) ) {
        $classes[] = 'remove_margin_bottom';
    }
    if( !empty( $attributes['style']['section_gradient_unten'] ) ) {
        $classes[] = 'section_gradient_unten';
    }
    if( !empty( $attributes['style']['section_gradient_oben'] ) ) {
        $classes[] = 'section_gradient_oben';
    }
    if( !empty( $attributes['style']['section_full_width'] ) &&
        $attributes['style']['section_full_width'] == true ) {
        $classes[] = 'section_full_width';
    }
    if( !empty( $attributes['style']['breadcrumb'] ) ) {
      $classes[] = 'has_breadcrumb';
    }
    if( !empty( $attributes['style']['matchHeight'] ) ) {
      $classes[] = 'matchHeight';
    }
    if( !empty( $attributes['style']['anker_section_nr'] ) &&
        $attributes['style']['anker_section_nr'] != '0' ) {

        $classes[] = 'anker_section';
        $data_attr[] = 'data-anker_nr="'.$attributes['style']['anker_section_nr'].'"';

    }

    if(!empty($classes)) {
      echo '<div class="section '.implode(" ", $classes).'" '.implode(" ", $data_attr).'>';
    }

    if( !empty( $attributes['style']['breadcrumb'] ) ) {
      echo '<div class="row section_breadcrumb">';
        compassion_breadcrumb();
      echo '</div>';
    }

    if( empty( $attributes['style']['section_full_width'] ) ||
        $attributes['style']['section_full_width'] == false ) {
          echo '<div class="row section_row">';
    }


  }
  add_filter('siteorigin_panels_before_row', 'custom_panels_before_row', 10, 3);

  function custom_panels_after_row( $str, $attributes, $args ) {

    if( !empty( $attributes['style']['section_background'] ) && $attributes['style']['section_background'] == 'background-image' ) {
        echo '<img class="background-image-element" src="'.$attributes['style']['section_background_image'].'">';
    }

    echo '</div>';

    if( !empty( $attributes['style']['section_background'] ) ||
        !empty( $attributes['style']['section_style'] )) {
        echo '</div>';
    }

  }
  add_filter('siteorigin_panels_after_row', 'custom_panels_after_row', 10, 3);


  function custom_panels_css_row_gutter($settings, $grid, $gi) {
    return '1.25rem';
  }
  add_filter('siteorigin_panels_css_row_gutter', 'custom_panels_css_row_gutter', 10, 3);

function compassion_icons() {
  return array(
      'child' => __( 'Kind', 'single-icon' ),
      'hands' => __( 'Hände', 'single-icon' ),
      'hat' => __( 'Hut', 'single-icon' ),
      'pencil' => __( 'Stift', 'single-icon' ),
      'person' => __( 'Person', 'single-icon' ),
      'church' => __( 'Kirche', 'single-icon' ),
      'blog' => __( 'Blog', 'single-icon' ),
      'home' => __( 'Home', 'single-icon' ),
  );
}

 ?>
