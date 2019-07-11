<?php
/**
 * Add search by post ID
 */


/**
 * Add a checkbox option to the EPL - Listing Search Widget
 */
function my_epl_search_widget_fields_post_id( $fields ) {
	$fields[] = array(

			'key'			=>	'search_post_id',
			'label'			=>	__('Search Post ID','easy-property-listings'),
			'default'		=>	'off', // Set to on to automatically output in the shortcode
			'type'			=>	'checkbox',
	);
	return $fields;
}
add_filter('epl_search_widget_fields', 'my_epl_search_widget_fields_post_id');

/**
 * Add the select field to the [listing_search] shorcode
 * Usage will be [listing_search post_type="property" search_open_closed=on]
 *
 **/
function my_epl_add_search_field_post_id($fields) {
 	$fields[] = array(
			'key'			=>	'search_id',
			'meta_key'		=>	'post_id',
			'label'			=>	__('Search by Property ID', 'easy-property-listings'),
			'placeholder'		=>	__('Search ID', 'easy-property-listings'),
			'type'			=>	'text',
			'class'			=>	'epl-search-row-full',
			'query'			=>	array('query'	=>	'meta' , 'key'	=>	'property_unique_id'),
			'order'			=>	25
		);
 	return $fields;
}
add_filter('epl_search_widget_fields_frontend','my_epl_add_select_options_search_field');
