<?php

/*
Widget Name: Child-pool
Description: This widget allow to display the childpool on the page builder
Author: Olivier Requet
*/

class childpool extends SiteOrigin_Widget {
    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'child-pool',

            // The name of the widget for display purposes.
            __('childpool', 'childpool'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('display the child pool on a widget', 'childpool'),
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            array(
            ),



            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance) {
        return 'child-pool-template';
    }

    function get_style_name($instance) {
        return 'child-pool-style';
    }
}

siteorigin_widget_register('child-pool', __FILE__, 'childpool');

?>
