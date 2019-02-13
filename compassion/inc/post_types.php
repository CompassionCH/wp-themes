<?php

function child_post_type() {

	$labels = array(
		'name'                  => _x( 'Kind', 'Post Type General Name', 'compassion' ),
		'singular_name'         => _x( 'Kind', 'Post Type Singular Name', 'compassion' ),
		'menu_name'             => __( 'Kinder', 'compassion' ),
		'name_admin_bar'        => __( 'Kinder', 'compassion' ),
		'archives'              => __( 'Kinder', 'compassion' ),
		'parent_item_colon'     => __( 'Parent:', 'compassion' ),
		'all_items'             => __( 'Alle Kinder', 'compassion' ),
		'add_new_item'          => __( 'Neues Kind eintragen', 'compassion' ),
		'add_new'               => __( 'Neu', 'compassion' ),
		'new_item'              => __( 'Neues Kind', 'compassion' ),
		'edit_item'             => __( 'Kind bearbeiten', 'compassion' ),
		'update_item'           => __( 'Kind aktualisieren', 'compassion' ),
		'view_item'             => __( 'Kind ansehen', 'compassion' ),
		'search_items'          => __( 'Kind suchen', 'compassion' ),
		'not_found'             => __( 'Nicht gefunden', 'compassion' ),
		'not_found_in_trash'    => __( 'Nicht im Papierkorb gefunden', 'compassion' ),
		'featured_image'        => __( 'Featured Image', 'compassion' ),
		'set_featured_image'    => __( 'Set featured image', 'compassion' ),
		'remove_featured_image' => __( 'Remove featured image', 'compassion' ),
		'use_featured_image'    => __( 'Use as featured image', 'compassion' ),
		'insert_into_item'      => __( 'Insert into item', 'compassion' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'compassion' ),
		'items_list'            => __( 'Items list', 'compassion' ),
		'items_list_navigation' => __( 'Items list navigation', 'compassion' ),
		'filter_items_list'     => __( 'Filter items list', 'compassion' ),
	);
	$args = array(
		'label'                 => __( 'Kinder', 'compassion' ),
		'description'           => __( '', 'compassion' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', ),
		'taxonomies'            => array( 'category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'rewrite'            	=> array( 'slug' => 'children' ),
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'child', $args );

}
add_action( 'init', 'child_post_type', 0 );


add_filter( "views_edit-child", 'modified_views_so_15799171' );

function modified_views_so_15799171( $views )
{

	if( isset( $views['draft'] ) )
		$views['draft'] = str_replace( 'Entwürfe ', 'Patenschaftsabschluss ', $views['draft'] );

	return $views;
}

add_filter( "display_post_states", 'child_post_states', 10, 2 );

function child_post_states( $post_states, $post )
{

	if(get_post_type($post->ID) == 'child' && isset($post_states['draft']))
		$post_states['draft'] = __('Patenschaftsabschluss', 'compassion');


	return $post_states;
}

function location_post_type() {

	$labels = array(
		'name'                  => _x( 'Standorte', 'Post Type General Name', 'compassion' ),
		'singular_name'         => _x( 'Standort', 'Post Type Singular Name', 'compassion' ),
		'menu_name'             => __( 'Standorte', 'compassion' ),
		'name_admin_bar'        => __( 'Standorte', 'compassion' ),
		'archives'              => __( 'Standorte', 'compassion' ),
		'parent_item_colon'     => __( 'Parent:', 'compassion' ),
		'all_items'             => __( 'Alle Standorte', 'compassion' ),
		'add_new_item'          => __( 'Neuen Standort eintragen', 'compassion' ),
		'add_new'               => __( 'Neu', 'compassion' ),
		'new_item'              => __( 'Neuer Standort', 'compassion' ),
		'edit_item'             => __( 'Standort bearbeiten', 'compassion' ),
		'update_item'           => __( 'Standort aktualisieren', 'compassion' ),
		'view_item'             => __( 'Standort ansehen', 'compassion' ),
		'search_items'          => __( 'Standort suchen', 'compassion' ),
		'not_found'             => __( 'Nicht gefunden', 'compassion' ),
		'not_found_in_trash'    => __( 'Nicht im Papierkorb gefunden', 'compassion' ),
		'featured_image'        => __( 'Featured Image', 'compassion' ),
		'set_featured_image'    => __( 'Set featured image', 'compassion' ),
		'remove_featured_image' => __( 'Remove featured image', 'compassion' ),
		'use_featured_image'    => __( 'Use as featured image', 'compassion' ),
		'insert_into_item'      => __( 'Insert into item', 'compassion' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'compassion' ),
		'items_list'            => __( 'Items list', 'compassion' ),
		'items_list_navigation' => __( 'Items list navigation', 'compassion' ),
		'filter_items_list'     => __( 'Filter items list', 'compassion' ),
	);
	$args = array(
		'label'                 => __( 'Standorte', 'compassion' ),
		'description'           => __( '', 'compassion' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor','revisions' ),
		'taxonomies'            => array(  ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'location', $args );

}
add_action( 'init', 'location_post_type', 0 );

function spendenaktion_post_type() {

	$labels = array(
		'name'                  => _x( 'Spendenaktionen', 'Post Type General Name', 'compassion' ),
		'singular_name'         => _x( 'Spendenaktion', 'Post Type Singular Name', 'compassion' ),
		'menu_name'             => __( 'Spendenaktionen', 'compassion' ),
		'name_admin_bar'        => __( 'Spendenaktionen', 'compassion' ),
		'archives'              => __( 'Spendenaktionen', 'compassion' ),
		'parent_item_colon'     => __( 'Parent:', 'compassion' ),
		'all_items'             => __( 'Alle Spendenaktionen', 'compassion' ),
		'add_new_item'          => __( 'Neue Spendenaktion eintragen', 'compassion' ),
		'add_new'               => __( 'Neu', 'compassion' ),
		'new_item'              => __( 'Neue Spendenaktion', 'compassion' ),
		'edit_item'             => __( 'Spendenaktion bearbeiten', 'compassion' ),
		'update_item'           => __( 'Spendenaktion aktualisieren', 'compassion' ),
		'view_item'             => __( 'Spendenaktion ansehen', 'compassion' ),
		'search_items'          => __( 'Spendenaktion suchen', 'compassion' ),
		'not_found'             => __( 'Nicht gefunden', 'compassion' ),
		'not_found_in_trash'    => __( 'Nicht im Papierkorb gefunden', 'compassion' ),
	);
	$args = array(
		'label'                 => __( 'Spendenaktionen', 'compassion' ),
		'description'           => __( '', 'compassion' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array(  ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite'								=> array( 'slug' => 'spendenaktion' )
	);
	register_post_type( 'donation-campaign', $args );

}
add_action( 'init', 'spendenaktion_post_type', 0 );

function download_post_type() {

	$labels = array(
		'name'                  => _x( 'Downloads', 'Post Type General Name', 'compassion' ),
		'singular_name'         => _x( 'Download', 'Post Type Singular Name', 'compassion' ),
		'menu_name'             => __( 'Downloads', 'compassion' ),
		'name_admin_bar'        => __( 'Downloads', 'compassion' ),
		'archives'              => __( 'Downloads', 'compassion' ),
		'parent_item_colon'     => __( 'Parent:', 'compassion' ),
		'all_items'             => __( 'Alle Downloads', 'compassion' ),
		'add_new_item'          => __( 'Neuen Download eintragen', 'compassion' ),
		'add_new'               => __( 'Neu', 'compassion' ),
		'new_item'              => __( 'Neuen Download', 'compassion' ),
		'edit_item'             => __( 'Download bearbeiten', 'compassion' ),
		'update_item'           => __( 'Download aktualisieren', 'compassion' ),
		'view_item'             => __( 'Download ansehen', 'compassion' ),
		'search_items'          => __( 'Download suchen', 'compassion' ),
		'not_found'             => __( 'Nicht gefunden', 'compassion' ),
		'not_found_in_trash'    => __( 'Nicht im Papierkorb gefunden', 'compassion' ),
	);
	$args = array(
		'label'                 => __( 'Downloads', 'compassion' ),
		'description'           => __( '', 'compassion' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite'								=> array( 'slug' => 'downloads' )
	);
	register_post_type( 'download', $args );

}
add_action( 'init', 'download_post_type', 0 );

function agenda_post_type() {

	$labels = array(
		'name'                  => _x( 'Agendas', 'Post Type General Name', 'compassion' ),
		'singular_name'         => _x( 'Agenda', 'Post Type Singular Name', 'compassion' ),
		'menu_name'             => __( 'Agendas', 'compassion' ),
		'name_admin_bar'        => __( 'Agendas', 'compassion' ),
		'archives'              => __( 'Agendas', 'compassion' ),
		'parent_item_colon'     => __( 'Parent:', 'compassion' ),
		'all_items'             => __( 'Tous les agendas', 'compassion' ),
		'add_new_item'          => __( 'Ajouter une nouvelle date', 'compassion' ),
		'add_new'               => __( 'Nouveau', 'compassion' ),
		'new_item'              => __( 'Nouvelle date', 'compassion' ),
		'edit_item'             => __( 'Modifier la date', 'compassion' ),
		'update_item'           => __( 'Mettre à jour la date', 'compassion' ),
		'view_item'             => __( 'Voir la date', 'compassion' ),
		'search_items'          => __( 'Cherche une date', 'compassion' ),
		'not_found'             => __( 'Nicht gefunden', 'compassion' ),
		'not_found_in_trash'    => __( 'Nicht im Papierkorb gefunden', 'compassion' ),
	);
	$args = array(
		'label'                 => __( 'Agendas', 'compassion' ),
		'description'           => __( '', 'compassion' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail','excerpt' ),
		'taxonomies'            => array( ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'rewrite'								=> array( 'slug' => 'agenda' )
	);
	register_post_type( 'agendas', $args );
	
}
add_action( 'init', 'agenda_post_type', 0 );



?>
