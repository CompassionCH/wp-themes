<?php

/*
Widget Name: Teaser-Box
Description: Erstellt eine Box mit Bild, Titel und Text
Author: Yanik Peiffer
*/


class Teaser_Box extends SiteOrigin_Widget {

  function __construct() {
      //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

      //Call the parent constructor with the required arguments.
      parent::__construct(
          // The unique id for your widget.
          'teaser-box',

          // The name of the widget for display purposes.
          __('Teaser-Box', 'teaser-box'),

          // The $widget_options array, which is passed through to WP_Widget.
          // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
          array(
              'description' => __('Erstellt eine Box mit Bild, Titel und Text.', 'teaser-box'),
          ),

          //The $control_options array, which is passed through to WP_Widget
          array(
          ),

          //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
          array(
            'image' => array(
              'type' => 'media',
              'label' => __('Bild', 'teaser-box')
            ),
              'image-position' => array(
                  'type' => 'select',
                  'options' => array(
                      '' => __('Position wählen', 'teaser-box'),
                      'left' => __('Links', 'teaser-box'),
                      'center' => __('Mitte', 'teaser-box'),
                      'right' => __('Rechts', 'teaser-box'),
                  )
              ),
            'title' => array(
              'type' => 'text',
              'label' => __('Titel', 'teaser-box')
            ),
            'content' => array(
              'type' => 'tinymce',
              'label' => __('Inhalt', 'teaser-box')
            ),
          ),

          //The $base_folder path string.
          plugin_dir_path(__FILE__)
      );
  }

    function get_template_name($instance) {
        return 'teaser-box-template';
    }

    function get_style_name($instance) {
        return 'teaser-box-style';
    }
}

siteorigin_widget_register('teaser-box', __FILE__, 'Teaser_Box');

 ?>
