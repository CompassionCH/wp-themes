<?php

/*
Widget Name: FadeIn-Box
Description: Erstellt eine Box die erst beim scrollen sichtbar wird
Author: Yanik Peiffer
*/


class FadeIn_Box extends SiteOrigin_Widget {

  function __construct() {
      //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

      //Call the parent constructor with the required arguments.
      parent::__construct(
          // The unique id for your widget.
          'fadein-text',

          // The name of the widget for display purposes.
          __('FadeIn-Box', 'fadein-text'),

          // The $widget_options array, which is passed through to WP_Widget.
          // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
          array(
              'description' => __('Erstellt eine Box die erst beim scrollen sichtbar wird.', 'fadein-text'),
          ),

          //The $control_options array, which is passed through to WP_Widget
          array(
          ),

          //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
          array(
            'title' => array(
              'type' => 'tinymce',
              'label' => __('Titel', 'fadein-text')
            ),
            'content' => array(
              'type' => 'tinymce',
              'label' => __('Inhalt', 'fadein-text')
            ),
          ),

          //The $base_folder path string.
          plugin_dir_path(__FILE__)
      );
  }

    function get_template_name($instance) {
        return 'fadein-text-template';
    }

    function get_style_name($instance) {
        return 'fadein-text-style';
    }
}

siteorigin_widget_register('fadein-text', __FILE__, 'FadeIn_Box');

 ?>
