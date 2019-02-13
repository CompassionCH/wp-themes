<?php

/*
Widget Name: Image Slider
Description: Einfacher Slider mit Bildern und Text
Author: Yanik Peiffer
*/


class Image_Slider extends SiteOrigin_Widget {

  function __construct() {
      //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

      //Call the parent constructor with the required arguments.
      parent::__construct(
          // The unique id for your widget.
          'image-slider',

          // The name of the widget for display purposes.
          __('Image Slider', 'image-slider'),

          // The $widget_options array, which is passed through to WP_Widget.
          // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
          array(
              'description' => __('Einfacher Slider mit Bildern und Text.', 'image-slider'),
          ),

          //The $control_options array, which is passed through to WP_Widget
          array(
          ),

          //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
          array(
            'style' => array(
              'type' => 'select',
              'label' => __('Style', 'image-slider'),
              'options' => array(
                  '' => __('Standard', 'image-slider'),
                  'slick-style-head' => __( 'Head-Slider', 'image-slider' ),
                  'slick-style-underline' => __( 'Unterstrichen', 'image-slider' ),
              )
            ),
            'dots' => array(
              'type' => 'checkbox',
              'label' => __('Dots anzeigen', 'image-slider')
            ),
            'slides' => array(
              'type' => 'repeater',
              'label' => __('Slides', 'image-slider'),
              'fields' => array(
                'image' => array(
                  'type' => 'media',
                  'label' => __('Bild', 'image-slider')
                ),
                  'position' => array(
                      'type' => 'select',
                      'label' => __('Bild-Position', 'image-slider'),
                      'default' => 'center',
                      'options' => array(
                          'top' => __( 'Oben', 'image-slider' ),
                          'center' => __( 'Mitte', 'image-slider' ),
                          'bottom' => __( 'Unten', 'image-slider' ),
                      )
                  ),
                'content' => array(
                  'type' => 'tinymce',
                  'label' => __('Content', 'image-slider')
                ),
              )
            )
          ),

          //The $base_folder path string.
          plugin_dir_path(__FILE__)
      );
  }

    function get_template_name($instance) {
        return 'image-slider-template';
    }

    function get_style_name($instance) {
        return 'image-slider-style';
    }
}

siteorigin_widget_register('image-slider', __FILE__, 'Image_Slider');

 ?>
