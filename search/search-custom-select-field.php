<?php
/**
 * Add a select custom field to the edit listing and make that a search option in the [listing_search] shortcode and widget
 */

/**
 * The select field options.
 */
function my_open_closed_options() {
	
	$options = array(
		'open'   => __('Open', 'easy-property-listings' ),
		'closed' => __('Closed', 'easy-property-listings' ),
		'red'    => __('Red', 'easy-property-listings' ),
		'blue'   => __('Blue', 'easy-property-listings' ),
	);
	
	return $options;
}

/**
 * Add select box field to the house features section
 * @uses EPL Filter epl_meta_groups_{group_id}
 */
function my_epl_add_select_options_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_open_closed_example',
		'label'		=>	__('Open Closed Example', 'easy-property-listings' ),
		'type'		=>	'select',
		'opts'		=>	my_open_closed_options(),
		),
	);
	return $group;
}
add_filter('epl_meta_groups_house_features', 'my_epl_add_select_options_field');

/**
 * Add a checkbox option to the EPL - Listing Search Widget
 */
function my_open_closed_epl_search_widget_fields( $fields ) {
	$fields[] = array(

			'key'			=>	'search_open_closed',
			'label'			=>	__('Open Closed Example','easy-property-listings'),
			'default'		=>	'off', // Set to on to automatically output in the shortcode
			'type'			=>	'checkbox',
	);
	return $fields;
}
add_filter('epl_search_widget_fields', 'my_open_closed_epl_search_widget_fields');

/**
 * Add the select field to the [listing_search] shorcode
 * Usage will be [listing_search post_type="property" search_open_closed=on]
 *
 **/
function my_epl_add_select_options_search_field($fields) {
 	$fields[] =array(
 		'key'			=>	'search_open_closed',
 		'meta_key'		=>	'property_open_closed_example',
 		'label'			=>	__('Open Closed Example','easy-property-listings'),
 		'option_filter'		=>	'open_closed',

 		'options'		=>	my_open_closed_options(),
		'type'			=>	'select',
 		//'exclude'		=>	array('land','commercial','commercial_land','business'),
		'query'			=>	array(
							'query'		=>	'meta',
						),
		'class'			=>	'epl-search-row-full',
		'order'			=>	275
 	);
 	return $fields;
}
add_filter('epl_search_widget_fields_frontend','my_epl_add_select_options_search_field');

