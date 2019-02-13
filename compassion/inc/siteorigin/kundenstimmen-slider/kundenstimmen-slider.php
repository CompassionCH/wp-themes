<?php

/*
Widget Name: Kundenstimmen Slider
Description: Dieser Slider gibt Kundenstimmen mit Bildern aus
Author: Yanik Peiffer
*/


class Kundenstimmen_Slider extends SiteOrigin_Widget {

  function __construct() {
      //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

      //Call the parent constructor with the required arguments.
      parent::__construct(
          // The unique id for your widget.
          'kundenstimmen-slider',

          // The name of the widget for display purposes.
          __('Kundenstimmen Slider', 'kundenstimmen-slider'),

          // The $widget_options array, which is passed through to WP_Widget.
          // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
          array(
              'description' => __('Dieser Slider gibt Kundenstimmen mit Bildern aus.', 'kundenstimmen-slider'),
          ),

          //The $control_options array, which is passed through to WP_Widget
          array(
          ),

          //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
          array(
            'slides' => array(
              'type' => 'repeater',
              'label' => __('Slides', 'kundenstimmen-slider'),
              'fields' => array(
                'image' => array(
                  'type' => 'media',
                  'label' => __('Bild', 'kundenstimmen-slider')
                ),
                'content' => array(
                  'type' => 'tinymce',
                  'label' => __('Content', 'kundenstimmen-slider')
                ),
                'person' => array(
                  'type' => 'text',
                  'label' => __('Quelle', 'kundenstimmen-slider')
                )
              )
            )
          ),

          //The $base_folder path string.
          plugin_dir_path(__FILE__)
      );
  }

    function get_template_name($instance) {
        return 'kundenstimmen-slider-template';
    }

    function get_style_name($instance) {
        return 'kundenstimmen-slider-style';
    }
}

siteorigin_widget_register('kundenstimmen-slider', __FILE__, 'Kundenstimmen_Slider');

 ?>
