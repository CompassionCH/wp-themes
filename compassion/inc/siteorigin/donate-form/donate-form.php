<?php

/*
Widget Name: Spenden-Formular
Description: Gibt ein kleines Spendenformular aus und leitet zur Spendenseite weiter
Author: Yanik Peiffer
*/


class Donate_Form extends SiteOrigin_Widget {

  function __construct() {
      //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

      //Call the parent constructor with the required arguments.
      parent::__construct(
          // The unique id for your widget.
          'donate-form',

          // The name of the widget for display purposes.
          __('Spenden-Formular', 'donate-form'),

          // The $widget_options array, which is passed through to WP_Widget.
          // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
          array(
              'description' => __('Gibt ein kleines Spendenformular aus und leitet zur Spendenseite weiter.', 'donate-form'),
          ),

          //The $control_options array, which is passed through to WP_Widget
          array(
          ),

          //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
          array(
            'title' => array(
              'type' => 'text',
              'label' => __('Button-Text', 'donate-form')
            ),
            'href' => array(
              'type' => 'text',
              'label' => __('Verlinkung', 'donate-form')
            ),
            'center' => array(
              'type' => 'checkbox',
              'label' => __('Zentrieren', 'donate-form')
            ),
            'size' => array(
              'type' => 'select',
              'label' => __('Größe', 'donate-form'),
              'options' => array(
                'button-small' => __('Klein', 'donate-form'),
                'button-medium' => __('Mittel', 'donate-form'),
                'button-large' => __('Groß', 'donate-form')
              )
            ),
            'color' => array(
              'type' => 'select',
              'label' => __('Farbe', 'donate-form'),
              'options' => array(
                'button-beige' => __('Beige', 'donate-form'),
                'button-blue' => __('Blau', 'donate-form'),
              )
            )
          ),

          //The $base_folder path string.
          plugin_dir_path(__FILE__)
      );
  }

    function get_template_name($instance) {
        return 'donate-form-template';
    }

    function get_style_name($instance) {
        return 'donate-form-style';
    }
}

siteorigin_widget_register('donate-form', __FILE__, 'Donate_Form');

 ?>
