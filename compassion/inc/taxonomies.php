<?php
/*
* Register custom taxonomy 'location-category'
*/
add_action( 'init', 'register_taxonomy_location_category', 1 );
function register_taxonomy_location_category() {
	register_taxonomy(
		'location-category',
		'location',
		array(
			'label' => __( 'Standort-Kategorie', 'compassion' ),
			'rewrite' => array( 'slug' => 'location-category' ),
			'query_var'         => true,
			'hierarchical' => true,
		)
	);


}

/*
* Register custom taxonomy 'location-group'
*/
add_action( 'init', 'register_taxonomy_location_group', 1 );
function register_taxonomy_location_group() {
	register_taxonomy(
		'location-group',
		'location',
		array(
			'label' => __( 'Standort-Gruppe', 'compassion' ),
			'rewrite' => array( 'slug' => 'location-group' ),
			'query_var'         => true,
			'hierarchical' => true,
		)
	);
}

/*
* Register custom taxonomy 'download-cat'
*/
add_action( 'init', 'register_taxonomy_download_cat', 1 );
function register_taxonomy_download_cat() {
	register_taxonomy(
		'download-cat',
		'download',
		array(
			'label' => __( 'Kategorien', 'compassion' ),
			'rewrite' => array( 'slug' => 'download-cat' ),
			'query_var'         => true,
			'hierarchical' => true,
		)
	);
}

/*
* Register custom taxonomy 'download-cat'
*/
add_action( 'init', 'register_taxonomy_agenda_cat', 1 );
function register_taxonomy_agenda_cat() {
	register_taxonomy(
		'categorie-cat',
		'agendas',
		array(
			'label' => __( 'categorie', 'compassion' ),
			'rewrite' => array( 'slug' => 'categorie-cat' ),
			'query_var'         => true,
			'hierarchical' => true,
		)
	);
}

?>
