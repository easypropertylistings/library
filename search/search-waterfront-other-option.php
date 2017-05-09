<?php
/**
 * Add a waterfront custom field to the edit listing and make that a search option in the [listing_search] shortcode and widget
 *
 */

/**
 * Add waterfront field to the house features section
 * @uses EPL Filter epl_meta_groups_{group_id}
 */
function my_epl_add_waterfront_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_waterfront',
		'label'		=>	__('Waterfront', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
				'yes'	=>	__('Yes', 'easy-property-listings' ),
		),
	);
	return $group;
}
add_filter('epl_meta_groups_house_features', 'my_epl_add_waterfront_field');

/**
 * Add the waterfront option to the other search options in the search widget/shortcode
 *
 **/
function my_epl_add_waterfront_search_field($fields) {

 	$fields[] =array(
 		'key'			=>	'search_other',
 		'meta_key'		=>	'property_waterfront',
 		'label'			=>	__('Waterfront','easy-property-listings'),
 		'type'			=>	'checkbox',
 		//'exclude'		=>	array('land','commercial','commercial_land','business'),
		'query'			=>	array(
							'query'		=>	'meta',
							'compare'	=>	'IN',
							'value'		=>	array('yes','1')
						),
		'class'			=>	'epl-search-row-half',
		'wrap_start'		=>	'epl-search-row epl-search-other',
		'order'			=>	275
 	);
 	return $fields;
}
add_filter('epl_search_widget_fields_frontend','my_epl_add_waterfront_search_field');

/**
 * Remove security and air conditioning from additional search options in the search widget/shortcode
 *
 **/
function my_epl_remove_search_options( $fields ) {
	foreach($fields as $field_key   =>  &$field) {
		if( in_array($field['meta_key'],
			array(
				'property_security_system',
				'property_air_conditioning'
			) ) ) {
			unset($fields[$field_key]);
		}
	}
	return $fields;
}
add_filter('epl_search_widget_fields_frontend','my_epl_remove_search_options');