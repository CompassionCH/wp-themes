<?php
if ( file_exists( dirname( __FILE__ ) . '/metaboxes/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/metaboxes/init.php';
}

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

add_filter( 'cmb2_admin_init', 'download_settings' );
function download_settings( ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_download_';

	$cmb = new_cmb2_box( array(
		'id'            => $prefix . 'settings',
		'title'         => __( 'Zusätzliche Angaben', 'compassion' ),
		'object_types'  => array( 'download' ),
	) );

	$cmb->add_field( array(
		'name'       => __( 'Bestellen', 'compassion' ),
		'desc'       => __( 'Download für Bestellungen freigeben', 'compassion' ),
		'id'         => $prefix . 'order',
		'type'       => 'checkbox'
	) );

	$cmb->add_field( array(
		'name'       => __( 'Button-Text', 'compassion' ),
		'id'         => $prefix . 'button_text',
		'type'       => 'text'
	) );

	$cmb->add_field( array(
		'name'       => __( 'Button-Link', 'compassion' ),
		'id'         => $prefix . 'button_link',
		'type'       => 'text'
	) );
}

add_filter('cmb2_admin_init', 'child_settings');
function child_settings() {
	$prefix = '_child_';

	$countries = array(
		'' => __('Land wählen', 'compassion')
	);

	$country_query = new WP_Query(array('post_type' => 'location', 'posts_per_page' => '-1'));
	while($country_query->have_posts()) {
		$country_query->the_post();

		$countries[get_the_id()] = get_the_title();
	}

	$cmb = new_cmb2_box( array(
		'id'			=>	$prefix.'settings',
		'title'			=>	'Zur Person',
		'object_types'	=>	array('child')
	) );

	$cmb->add_field( array(
		'name'			=>	__('Name', 'compassion'),
		'type'			=>	'text',
		'id'			=>	$prefix . 'name'
	) );

	$cmb->add_field( array(
		'name'			=>	__('Kurzbeschreibung', 'compassion'),
		'type'			=>	'wysiwyg',
		'id'				=>	$prefix . 'short_desc'
	) );

	$cmb->add_field( array(
		'name'			=>	__('Geburtstag', 'compassion'),
		'type'			=>	'text_date_timestamp',
	'id'				=>	$prefix . 'birthday'
	) );

	$cmb->add_field( array(
		'name'			=>	__('Geschlecht', 'compassion'),
		'type'			=>	'select',
	'id'				=>	$prefix . 'gender',
		'options' 		=> array(
			'girl' 		=> __('Mädchen', 'compassion'),
			'boy' 		=> __('Junge', 'compassion'),
		)
	) );

	$cmb->add_field( array(
		'name'			=>	__('Startdatum', 'compassion'),
		'type'			=>	'text_date_timestamp',
		'id'			=>	$prefix . 'start_date'
	) );

	$cmb->add_field( array(
		'name'			=>	__('Beschreibung', 'compassion'),
		'type'			=>	'wysiwyg',
		'id'			=>	$prefix . 'description'
	) );

	$cmb->add_field( array(
		'name'			=>	__('Über das Projekt', 'compassion'),
		'type'			=>	'wysiwyg',
		'id'			=>	$prefix . 'project'
	) );

	$cmb->add_field( array(
		'name'			=>	__('Nummer', 'compassion'),
		'type'			=>	'text',
		'id'			=>	$prefix . 'number'
	) );

	$cmb->add_field( array(
		'name'			=>	__('Land', 'compassion'),
		'type'			=>	'select',
		'id'			=>	$prefix . 'country',
		'options' 		=> $countries
	) );

	$cmb->add_field( array(
		'name'			=>	__('Portrait', 'compassion'),
		'type'			=>	'file',
		'id'			=>	$prefix . 'portrait',
	) );
}


add_filter( 'cmb2_admin_init', 'location_settings' );
function location_settings( ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	$cmb = new_cmb2_box( array(
		'id'            => $prefix . 'location_metabox',
		'title'         => __( 'Zusätzliche Angaben', 'compassion' ),
		'object_types'  => array( 'location' ),
	) );

	$cmb->add_field( array(
		'name'       => __( 'Text der Verlinkung', 'compassion' ),
		'id'         => $prefix . 'link_text',
		'type'       => 'text'
	) );

	$cmb->add_field( array(
		'name'      => __( 'Pixel von oben', 'compassion' ),
		'id'        => $prefix . 'longitude',
		'desc'			=>	__('Bei Zentren handelt es sich um die Anzahl der Pixel von oben', 'compassion'),
		'type'      => 'text'
	) );

	$cmb->add_field( array(
		'name'       => __( 'Pixel von links', 'compassion' ),
		'id'         => $prefix . 'latitude',
		'desc'			=>	__('Bei Zentren handelt es sich um die Anzahl der Pixel von links', 'compassion'),
		'type'       => 'text'
	) );

	$cmb->add_field( array(
		'name'      => __( 'Längengrad', 'compassion' ),
		'id'        => $prefix . 'google_longitude',
		'type'      => 'text'
	) );

	$cmb->add_field( array(
		'name'       => __( 'Breitengrad', 'compassion' ),
		'id'         => $prefix . 'google_latitude',
		'type'       => 'text'
	) );

	$cmb->add_field( array(
		'name'       => __( 'Foto', 'compassion' ),
		'id'         => $prefix . 'country_photo',
		'type'       => 'file'
	) );

	$cmb->add_field( array(
		'name'      => __( 'Titel', 'compassion' ),
		'id'        => $prefix . 'country_child_title',
		'desc'		=> __('z.B. für Philippinen: in den Philippinen', 'compassion'),
		'type'      => 'text'
	) );

	$cmb->add_field( array(
		'name'      => __( 'Über das Land', 'compassion' ),
		'id'        => $prefix . 'country_info',
		'type'      => 'wysiwyg'
	) );

	$cmb->add_field( array(
		'name'      => __( 'Ländercode', 'compassion' ),
		'id'        => $prefix . 'country_code',
		'type'      => 'text'
	) );

	$cmb->add_field( array(
		'name'      => __( 'Externe URL', 'compassion' ),
		'id'        => $prefix . 'country_url',
		'type'      => 'text'
	) );

}

add_filter( 'cmb2_admin_init', 'agenda_settings' );
function agenda_settings( ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_agenda_';

	$cmb = new_cmb2_box( array(
		'id'            => $prefix . 'settings',
		'title'         => __( 'date', 'compassion' ),
		'object_types'  => array( 'agendas' ),
	) );
	$cmb->add_field( array(
		'name'      => __( 'Datum hinzufügen', 'compassion' ),
		'id'        => $prefix . 'date_agenda',
		'type'      => 'text_date',
	) );
	
	$cmb->add_field( array(
		'name'      => __( 'Enddatum', 'compassion' ),
		'id'        => $prefix . 'date_agenda_fin',
		'type'      => 'text_date',
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

