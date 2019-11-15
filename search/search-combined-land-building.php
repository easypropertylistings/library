<?php
/**
 * Add Total Area search option to widget and [listing_search search_land_building=on] shortcode option. Combines land and building area search into one field.
 *
 */

/**
 * Backend Field : Add Total area option to widget and as shortcode option search_land_building=on ( search land Area OR Building Area )
 *
 * @param array  $fields  The fields
 *
 * @return array
 */
function theme_epl_search_widget_fields( $fields ) {
	$fields[] = array(
		'key'     => 'search_land_building',
		'label'   => __( 'Total Area', 'easy-property-listings' ),
		'default' => 'off',
		'type'    => 'checkbox',
		'order'   => 200,
	);

	return $fields;
}
add_filter( 'epl_search_widget_fields', 'theme_epl_search_widget_fields' );

/**
 * Frontend Field : Total area Search ABOVE value
 *
 * @param array  $fields  The fields
 *
 * @return array
 */
function theme_epl_search_widget_fields_frontend( $fields ) {
	$fields[] = array(
		'key'           => 'search_land_building',
		'meta_key'      => 'property_land_building',
		'label'         => __( 'Total Area', 'easy-property-listings' ),
		'type'          => 'text',
		'class'         => 'epl-search-row-full',
		'query'         => array(
			'multiple'    => true,
			'query'       => 'meta',
			'relation'    => 'OR',
			'sub_queries' => array(
				array(
					'key'     => 'property_land_area',
					'type'    => 'numeric',
					'compare' => '>=',
				),
				array(
					'key'     => 'property_building_area',
					'type'    => 'numeric',
					'compare' => '>=',
				),
			),
		),
		'order'         => 200,
	);

	return $fields;
}
add_filter( 'epl_search_widget_fields_frontend', 'theme_epl_search_widget_fields_frontend' );