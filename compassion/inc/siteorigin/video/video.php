<?php

/*
Widget Name: Video
Description: Gibt ein Video als Dauerschleife aus
Author: Yanik Peiffer
*/


class Video extends SiteOrigin_Widget {

  function __construct() {
      //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

      //Call the parent constructor with the required arguments.
      parent::__construct(
          // The unique id for your widget.
          'video',

          // The name of the widget for display purposes.
          __('Video', 'video'),

          // The $widget_options array, which is passed through to WP_Widget.
          // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
          array(
              'description' => __('Gibt ein Video als Dauerschleife aus.', 'video'),
          ),

          //The $control_options array, which is passed through to WP_Widget
          array(
          ),

          //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
          array(
            'video-file' => array(
              'type' => 'media',
              'label' => __('Video-Datei', 'compassion'),
              'library' => 'video'
            ),
            'placeholder' => array(
              'type' => 'media',
              'label' => __('Placeholder', 'compassion')
            )
          ),

          //The $base_folder path string.
          plugin_dir_path(__FILE__)
      );
  }

    function get_template_name($instance) {
        return 'video-template';
    }

    function get_style_name($instance) {
        return 'video-style';
    }
}

siteorigin_widget_register('video', __FILE__, 'Video');

 ?>
