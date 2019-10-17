<?php
/**
 * Customise the default building search to a single number field in the search widget/shortcode.
 * The search will return land size from 0 to the number entered.
 *
 */

function my_epl_add_single_building_search_number_field($fields) {
	foreach($fields as $field_key   =>  &$field) {
	        if( in_array($field['meta_key'], array('property_building_area_min','property_building_area_max','property_building_area_unit') ) ) {
			unset($fields[$field_key]);
	        }
	}
	$fields[] =array(
		'key'           => 'search_building_area',
		//'multiple'    => true,
		'meta_key'      => 'property_building_area',
		'label'         => __('Building less than entered size','epl'),
		'type'          => 'select',
		'option_filter' => 'property_building_area',
		'option_type'   => 'range', // provide range of option instead of option array
		'query'         => array(
					'query'   => 'meta',
					'compare' => 'BETWEEN',
					'type'    => 'numeric'
		),
		'class'         => 'epl-search-row-full',
		'order'         => 140
	);
	return $fields;
}
add_filter('epl_search_widget_fields_frontend','my_epl_add_single_building_search_number_field');

// Commercial Search Extension Filter
//add_filter('epl_listing_search_commercial_widget_fields_frontend','my_epl_add_single_building_search_dropdown_field');

/* Alter the default Any dropdown when using the combined building size */
function my_custom_any_label_building_area_number() {
	$label = 'All';
	return $label;
}
add_filter( 'epl_search_widget_option_label_property_building_area' , 'my_custom_any_label_building_area_number' );