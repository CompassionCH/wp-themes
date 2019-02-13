<?php

/*
Widget Name: Single Icon
Description: Icon
Author: Yanik Peiffer
*/


class Single_Icon extends SiteOrigin_Widget {

  function __construct() {
      //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

      //Call the parent constructor with the required arguments.
      parent::__construct(
          // The unique id for your widget.
          'single-icon',

          // The name of the widget for display purposes.
          __('Single Icon', 'single-icon'),

          // The $widget_options array, which is passed through to WP_Widget.
          // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
          array(
              'description' => __('Icon.', 'single-icon'),
          ),

          //The $control_options array, which is passed through to WP_Widget
          array(
          ),

          //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
          array(
            'icon' => array(
              'type' => 'select',
              'label' => __('Icon', 'single-icon'),
              'options' => array(
                  'child' => __( 'Kind', 'single-icon' ),
                  'hands' => __( 'Hände', 'single-icon' ),
                  'hat' => __( 'Hut', 'single-icon' ),
                  'pencil' => __( 'Stift', 'single-icon' ),
                  'person' => __( 'Person', 'single-icon' ),
                  'church' => __( 'Kirche', 'single-icon' ),
              )
            ),
            'size' => array(
              'type' => 'select',
              'label' => __('Größe', 'single-icon'),
              'options' => array(
                'default' => __('Standard', 'compassion'),
                'small' => __('Klein', 'compassion'),
              )
            )
          ),

          //The $base_folder path string.
          plugin_dir_path(__FILE__)
      );
  }

    function get_template_name($instance) {
        return 'single-icon-template';
    }

    function get_style_name($instance) {
        return 'single-icon-style';
    }
}

siteorigin_widget_register('single-icon', __FILE__, 'Single_Icon');

 ?>
