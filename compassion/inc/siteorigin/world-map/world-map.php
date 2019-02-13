<?php

/*
Widget Name: Weltkarte
Description: Erstellt eine interaktive Weltkarte
Author: Yanik Peiffer
*/


class World_Map extends SiteOrigin_Widget
{

    function __construct()
    {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'world-map',

            // The name of the widget for display purposes.
            __('Weltkarte', 'world-map'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Erstellt eine interaktive Weltkarte.', 'world-map'),
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'map_type' => array(
                    'type' => 'select',
                    'label' => __('Typ', 'compassion'),
                    'options' => array(
                        'zentren' => __('Zentren', 'compassion'),
                        'projekte' => __('Projektländer', 'compassion'),
                        'partner' => __('Partnerländer', 'compassion'),
                        'partner_projekte_combi' => __('Partner- und Projektländer', 'compassion'),
                    )
                )
            ),

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance)
    {
        return 'world-map-template';
    }

    function get_style_name($instance)
    {
        return 'world-map-style';
    }

    function initialize()
    {
        $this->register_frontend_scripts(
            array(
                array('google-maps', '//maps.googleapis.com/maps/api/js', array(), '1.0'),
                array('google-infobox', get_template_directory_uri() . '/assets/js/infobox.js', array(), '1.0')
            )
        );
    }

}

siteorigin_widget_register('world-map', __FILE__, 'World_Map');

?>
