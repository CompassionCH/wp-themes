<?php

/*
Widget Name: Button
Description: Erstellt einen Button mit beliebigen Text und Verlinkung
Author: Yanik Peiffer
*/


class Widget_Button extends SiteOrigin_Widget {

  function __construct() {
      //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

      //Call the parent constructor with the required arguments.
      parent::__construct(
          // The unique id for your widget.
          'widget-button',

          // The name of the widget for display purposes.
          __('Widget Button', 'page-footer-widget'),

          // The $widget_options array, which is passed through to WP_Widget.
          // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
          array(
              'description' => __('Erstellt einen Button mit beliebigen Text und Verlinkung.', 'page-footer-widget'),
          ),

          //The $control_options array, which is passed through to WP_Widget
          array(
          ),

          //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
          array(
            'title' => array(
              'type' => 'text',
              'label' => __('Button-Text', 'widget-button')
            ),
            'href' => array(
              'type' => 'text',
              'label' => __('Verlinkung', 'widget-button')
            ),
            'center' => array(
              'type' => 'checkbox',
              'label' => __('Zentrieren', 'widget-button')
            ),
            'size' => array(
              'type' => 'select',
              'label' => __('Größe', 'widget-button'),
              'options' => array(
                'button-small' => __('Klein', 'widget-button'),
                'button-medium' => __('Mittel', 'widget-button'),
                'button-large' => __('Groß', 'widget-button')
              )
            ),
            'color' => array(
              'type' => 'select',
              'label' => __('Farbe', 'widget-button'),
              'options' => array(
                'button-beige' => __('Beige', 'widget-button'),
                'button-blue' => __('Blau', 'widget-button'),
              )
            )
          ),

          //The $base_folder path string.
          plugin_dir_path(__FILE__)
      );
  }

    function get_template_name($instance) {
        return 'widget-button-template';
    }

    function get_style_name($instance) {
        return 'widget-button-style';
    }
}

siteorigin_widget_register('widget-button', __FILE__, 'Widget_Button');

 ?>
