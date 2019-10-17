<?php
/**
 * Customise the default building search to a single drop down in the search widget/shortcode
 *
 */

function my_epl_add_single_building_search_dropdown_field($fields) {
	foreach($fields as $field_key   =>  &$field) {
	        if( in_array($field['meta_key'], array('property_building_area_min','property_building_area_max','property_building_area_unit') ) ) {
			unset($fields[$field_key]);
	        }
	}
	$fields[] =array(
		'key'			=>	'search_building_area',
		//'multiple'		=>	true,
		'meta_key'		=>	'property_building_area',
		'label'			=>	__('Building Size (sqft)','epl'),
		'type'			=>	'select',
		'option_filter'		=>	'property_building_area',
		'options'		=>	array(
							'0-1000'		=>  'Less than 1,000',
							'1000-2000'		=>  '1,000 to 2,000',
							'2000-5000'		=>  '2,000 to 5,000',
							'5000-10000'		=>  '5,000 to 10,000',
							'10000-20000'		=>  '10,000 to 20,000',
							'20000-50000'		=>  '20,000 to 50,000',
							'50000-100000'		=>  '50,000 to 100,000',
							'100000-9900000'	=>  'More than 100,000',
		),
		'option_type'   =>  'range', // provide range of option instead of option array
		'query'			=>	array(
							'query'		=>	'meta',
							'compare'	=>	'BETWEEN',
							'type'		=>	'numeric'
		),
		'class'			=>	'epl-search-row-full',
		'order'			=>  140
	);
	return $fields;
}
add_filter('epl_search_widget_fields_frontend','my_epl_add_single_building_search_dropdown_field');

// Commercial Search Extension Filter
//add_filter('epl_listing_search_commercial_widget_fields_frontend','my_epl_add_single_building_search_dropdown_field');

/* Alter the default Any dropdown when using the combined building size */
function my_custom_any_label_building_area() {
	$label = 'All';
	return $label;
}
add_filter( 'epl_search_widget_option_label_property_building_area' , 'my_custom_any_label_building_area' );