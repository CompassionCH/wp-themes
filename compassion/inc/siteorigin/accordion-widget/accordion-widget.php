<?php

/*
Widget Name: Accordion Widget
Description: Dieses Widget stellt ein Accordion Element dar.
Author: Daniela Wibbeke
*/

class Accordion_Widget extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'accordion-widget',
			__('Akkordeon Element', 'siteorigin-widgets'),
			array(
				'description' => __('Dieses Widget stellt ein Akkordeon Element dar.', 'siteorigin-widgets'),
			),
			array(

			),
			array(
				'widget_title' => array(
					'type' => 'text',
					'label' => __('Widget Title', 'siteorigin-widgets'),
				),
			    'accordion_repeater' => array(
			        'type' => 'repeater',
			        'label' => __( 'Accordion Element' , 'siteorigin-widgets' ),
			        'item_name'  => __( 'Tab', 'siteorigin-widgets' ),
			        'item_label' => array(
			            'selector'     => "[id*='accordion_title']",
			            'update_event' => 'change',
			            'value_method' => 'val'
			        ),
			        'fields' => array(
								'accordion_title' => array(
										'type' => 'text',
										'label' => __( 'Titel des Accordion Tabs', 'siteorigin-widgets' )
								),
						    'accordion_text' => array(
						        'type' => 'tinymce',
						        'default_editor' => 'tmce',
						        'label' => __( 'Inhalt des Accordion Tabs', 'siteorigin-widgets' ),
						        'rows' => 20
						    ),
				            'accordion_checkbox' => array(
				                'type' => 'checkbox',
				                'label' => __( 'Accordion Tab soll geöffnet sein', 'siteorigin-widgets' ),
				                'default' => false,
				            )
				        )
			    )
			),
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'accordion-widget-template';
	}

	function get_style_name($instance) {
		return 'accordion-widget-style';
	}


}

siteorigin_widget_register('accordion-widget', __FILE__, 'Accordion_Widget');
