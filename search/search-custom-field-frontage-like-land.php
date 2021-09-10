<?php
/**
 * Add a new field frontage with 3 values like the land and building fields.
 *
 */

/**
 * Frontage Custom Fields
 *
 * Add select box field to the land details section
 * @uses EPL Filter epl_meta_groups_{group_id}
 */
function my_epl_add_frontage_field( $group ) {
	$new_fields = array(
		'property_frontage'  =>   array(
			'name'      => 'property_frontage',
			'label'     => __( 'Frontage', 'easy-property-listings' ),
			'type'      => 'decimal',
			'maxlength' => '50',
			'width'     => '2-3',
		),
		'property_frontage_unit'    =>   array(
			'name'  => 'property_frontage_unit',
			'label' => __( 'Frontage Unit', 'easy-property-listings' ),
			'type'  => 'select',
			'opts'  => array(
				'meter' => __( 'Meter', 'easy-property-listings' ),
			),
			'width' => '3',
		)
	);
	$group['fields'] = $new_fields + $group['fields'];

	return $group;
}
add_filter( 'epl_meta_groups_land_details', 'my_epl_add_frontage_field' );

/**
 * Add a checkbox option to the EPL - Listing Search Widget
 */
function my_frontage_search_widget_fields( $fields ) {

	$fields[] = array(
		'key'     => 'search_frontage',
		'label'   => __('Frontage','easy-property-listings'),
		'default' => 'on', // Set to on to automatic output in the shortcode and widget
		'type'    => 'checkbox',
		'order'   => 205,
	);
	return $fields;

}
add_filter('epl_search_widget_fields', 'my_frontage_search_widget_fields');
add_filter('epl_listing_search_commercial_widget_fields', 'my_frontage_search_widget_fields');

/**
 * Add the select field to the [listing_search] shorcode
 * Usage will be [listing_search post_type="commercial" search_frontage=on]
 *
 **/
function my_epl_add_frontage_options_search_field( $fields ) {

	$new_field_1 = array(
		'key'         => 'search_frontage',
		'meta_key'    => 'property_frontage_min',
		'label'       => __( 'Frontage Min', 'easy-property-listings' ),
		'type'        => 'number',
		'query'       => array(
			'query'   => 'meta',
			'type'    => 'numeric',
			'compare' => '>=',
			'key'     => 'property_land_area',
		),
		'class'       => 'epl-search-row-third',
		'placeholder' => __( 'Min', 'easy-property-listings' ),
		'wrap_start'  => 'epl-search-row epl-search-land-area',
		'order'       => 137,
	);
	$new_field_2 = array(
		'key'         => 'search_frontage',
		'meta_key'    => 'property_frontage_max',
		'label'       => __( 'Frontage Max', 'easy-property-listings' ),
		'class'       => 'epl-search-row-third',
		'placeholder' => __( 'Max', 'easy-property-listings' ),
		'type'        => 'number',
		'query'       => array(
			'query'   => 'meta',
			'type'    => 'numeric',
			'compare' => '<=',
			'key'     => 'property_frontage',
		),
		'order'       => 138,
	);
	$new_field_3 = array(
		'key'           => 'search_frontage',
		'meta_key'      => 'property_frontage_unit',
		'label'         => __( 'Frontage Unit', 'easy-property-listings' ),
		'class'         => 'epl-search-row-third',
		'type'          => 'select',
		'option_filter' => 'frontage_area_unit',
		'options'       => array(
			'meter' => __( 'Meter', 'easy-property-listings' ),
		),
		'query'         => array( 'query' => 'meta' ),
		'wrap_end'      => true,
		'order'         => 139,

	);

	array_push( $fields, $new_field_1, $new_field_2, $new_field_3 );

	return $fields;
}
add_filter( 'epl_search_widget_fields_frontend', 'my_epl_add_frontage_options_search_field' );
add_filter( 'epl_listing_search_commercial_widget_fields_frontend', 'my_epl_add_frontage_options_search_field' );
