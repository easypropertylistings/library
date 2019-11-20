<?php
/**
 * Add a new field and seach by range
 *
 */

/**
 * Add select box field to the house features section
 * @uses EPL Filter epl_meta_groups_{group_id}
 */
function my_epl_add_cap_rate_field( $group ) {

	$group['fields'][] = array(
		'name'      => 'property_cap_rate',
		'label'     => __('Cap Rate Percent', 'easy-property-listings' ),
		'type'      => 'decimal',
		'maxlength' => '4',
	);
	return $group;
}
add_filter( 'epl_meta_groups_pricing', 'my_epl_add_cap_rate_field' );


/**
 * Add a checkbox option to the EPL - Listing Search Widget
 */
function my_cap_rate_search_widget_fields( $fields ) {

	$fields[] = array(
		'key'     => 'search_cap_rate',
		'label'   => __('Cap Rate','easy-property-listings'),
		'default' => 'off', // Set to on to automatic output in the shortcode and widget
		'type'    => 'checkbox',
	);
	return $fields;

}
add_filter('epl_search_widget_fields', 'my_cap_rate_search_widget_fields');
add_filter('epl_listing_search_commercial_widget_fields', 'my_cap_rate_search_widget_fields');

/**
 * Add the select field to the [listing_search] shorcode
 * Usage will be [listing_search post_type="commercial" search_cap_rate=on]
 *
 **/
function my_epl_add_cap_rate_options_search_field( $fields ) {

	$range = range( 1, 100, 1 );

 	// From Selector.
 	$fields[] = array(
 		'key'           => 'search_cap_rate',
 		'meta_key'      => 'property_cap_rate_min',
 		'label'         => __('Cap Rate From','easy-property-listings'),
 		'option_filter' => 'cap_rate_min',
 		'options'       => $range,
		'type'          => 'select',
 		//'exclude'     => array('land','commercial','commercial_land','business'),
		'query'         => array(
			'query'   => 'meta',
			'key'     => 'property_cap_rate',
			'type'    => 'numeric',
			'compare' => '>=',
		),
		'class'         => 'epl-search-row-half',
		'order'         => 136
 	);

 	// To Selector.
 	$fields[] = array(
 		'key'           => 'search_cap_rate',
 		'meta_key'      => 'property_cap_rate_max',
 		'label'         => __('Cap Rate To','easy-property-listings'),
 		'option_filter' => 'cap_rate_max',
 		'options'       => $range,
		'type'          => 'select',
 		//'exclude'     => array('land','commercial','commercial_land','business'),
		'query'         => array(
			'query'   => 'meta',
			'key'     => 'property_cap_rate',
			'type'    => 'numeric',
			'compare' => '<=',
		),
		'class'         => 'epl-search-row-half',
		'order'         => 137
 	);

 	return $fields;
}
add_filter( 'epl_search_widget_fields_frontend', 'my_epl_add_cap_rate_options_search_field' );
add_filter( 'epl_listing_search_commercial_widget_fields_frontend', 'my_epl_add_cap_rate_options_search_field' );
