<?php

/*
Widget Name: Icon Slider
Description: Slider mit Compassion-Icons und Text
Author: Yanik Peiffer
*/


class Icon_Slider extends SiteOrigin_Widget {

  function __construct() {
      //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

      //Call the parent constructor with the required arguments.
      parent::__construct(
          // The unique id for your widget.
          'icon-slider',

          // The name of the widget for display purposes.
          __('Icon Slider', 'icon-slider'),

          // The $widget_options array, which is passed through to WP_Widget.
          // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
          array(
              'description' => __('Slider mit Compassion-Icons und Text.', 'icon-slider'),
          ),

          //The $control_options array, which is passed through to WP_Widget
          array(
          ),

          //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
          array(
            'slides' => array(
              'type' => 'repeater',
              'label' => __('Slides', 'icon-slider'),
              'fields' => array(
                'icon' => array(
                  'type' => 'select',
                  'label' => __('Icon', 'icon-slider'),
                  'options' => compassion_icons()
                ),
                'title' => array(
                  'type' => 'text',
                  'label' => __('Titel', 'icon-slider')
                ),
                'content' => array(
                  'type' => 'tinymce',
                  'label' => __('Content', 'icon-slider')
                ),
              )
            )
          ),

          //The $base_folder path string.
          plugin_dir_path(__FILE__)
      );
  }

    function get_template_name($instance) {
        return 'icon-slider-template';
    }

    function get_style_name($instance) {
        return 'icon-slider-style';
    }
}

siteorigin_widget_register('icon-slider', __FILE__, 'Icon_Slider');

 ?>
