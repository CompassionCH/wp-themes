<?php

/*
Widget Name: Facts-Grid
Description:
Author: Yanik Peiffer
*/


class Facts_Grid extends SiteOrigin_Widget {

  function __construct() {
      //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
      $form_options = array();
      for($i = 1; $i <= 5; $i++) {
        $form_options['box'.$i] = array(
          'type' => 'section',
          'label' => __('Box '.$i, 'compassion'),
          'hide' => true,
          'fields' => array(
            'image' => array(
              'type' => 'media',
              'label' => __('Bild', 'compassion')
            ),
            'pattern' => array(
              'type' => 'checkbox',
              'label' => __('Blaues Muster als Hintergrund verwenden', 'compassion')
            ),
            'number' => array(
              'type' => 'text',
              'label' => __('Zahl', 'compassion')
            ),
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
            'text_before' => array(
              'type' => 'text',
              'label' => __('Text vor der Zahl', 'compassion')
            ),
            'text_after' => array(
              'type' => 'tinymce',
              'label' => __('Text nach der Zahl', 'compassion')
            )
          )
        );
      }
      $form_options['box5']['fields']['textalign'] = array(
        'type' => 'checkbox',
        'label' => __('Inhalt linksbündig anordnen.', 'compassion'),

      );

      //Call the parent constructor with the required arguments.
      parent::__construct(
          // The unique id for your widget.
          'facts-grid',

          // The name of the widget for display purposes.
          __('Facts-Grid', 'page-footer-widget'),

          // The $widget_options array, which is passed through to WP_Widget.
          // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
          array(),

          //The $control_options array, which is passed through to WP_Widget
          array(),

          //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
          $form_options,

          //The $base_folder path string.
          plugin_dir_path(__FILE__)
      );
  }

  function get_template_name($instance) {
      return 'facts-grid-template';
  }

  function get_style_name($instance) {
      return 'facts-grid-style';
  }
}

siteorigin_widget_register('facts-grid', __FILE__, 'Facts_Grid');

 ?>
