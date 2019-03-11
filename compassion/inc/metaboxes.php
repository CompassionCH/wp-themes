<?php

add_filter( 'cmb2_admin_init', 'page_settings' );
function page_settings( ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	$cmb = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Zusätzliche Angaben', 'compassion' ),
		'object_types'  => array( 'page' ),
	) );

	$cmb->add_field( array(
		'name'       => __( 'Header', 'compassion' ),
		'desc'       => __( 'Header soll über Inhalt schweben', 'compassion' ),
		'id'         => $prefix . 'header_over_content',
		'type'       => 'checkbox'
	) );

	$cmb->add_field( array(
		'name'       => __( 'Footer', 'compassion' ),
		'desc'       => __( 'Footer ohne abgerissenen Rand darstellen', 'compassion' ),
		'id'         => $prefix . 'footer_linear',
		'type'       => 'checkbox'
	) );

	$cmb->add_field( array(
		'name'       => __( 'Seite enthält keinen Inhalt', 'compassion' ),
		'desc'       => __( 'Wenn die Seite keinen eigenen Inhalt enthält, wird sie in der Breadcrumb nicht verlinkt.', 'compassion' ),
		'id'         => $prefix . 'no_content',
		'type'       => 'checkbox'
	) );
}

/* add custom fields to posts
 */
add_action( 'cmb2_admin_init', 'cmb2_posts_metaboxes' );
function cmb2_posts_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_posts_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'media_metabox',
		'title'         => __( 'Media Metabox', 'cmb2' ),
		'object_types'  => array( 'post', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	// Regular text field
	$cmb->add_field( array(
		'name'       => __( 'Ajouter le nom du média', 'cmb2' ),
		'desc'       => __( 'field description (optional)', 'cmb2' ),
		'id'         => $prefix . 'text',
		'type'       => 'text',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

}

