<?php
/**
 * Customise the default building search to a double drop down for min/max in the search widget/shortcode
 *
 */

function my_epl_add_double_building_search_dropdown_field($fields) {
	foreach($fields as $field_key   =>  &$field) {
	        if( in_array($field['meta_key'], array('property_building_area_min','property_building_area_max','property_building_area_unit') ) ) {
			unset($fields[$field_key]);
	        }
	}

	$fields[] = array(
		'key'			=>	'search_building_area',
		'meta_key'		=>	'property_building_area_min',
		'label'			=>	__('Building Area Min', 'easy-property-listings'),
		'option_filter'		=>	'property_land_area',
		'options'		=>	array(
							'1000'		=>  '1,000',
							'2000'		=>  '2,000',
							'5000'		=>  '5,000',
							'10000'		=>  '10,000',
							'20000'		=>  '20,000',
							'50000'		=>  '50,000',
							'100000'	=>  'More than 100,000',
						),
		'type'			=>	'select',
		'query'			=>	array(
							'query'		=>	'meta',
							'key'		=>	'property_building_area',
							'type'		=>	'numeric',
							'compare'	=>	'>='
						),
		'class'			=>	'epl-search-row-half',
		'order'			=>	240
	);

	$fields[] = array(
		'key'			=>	'search_building_area',
		'meta_key'		=>	'property_building_area_max',
		'label'			=>	__('Building Area Max', 'easy-property-listings'),
		'option_filter'		=>	'property_land_area',
		'options'		=>	array(
							'1000'		=>  '1,000',
							'2000'		=>  '2,000',
							'5000'		=>  '5,000',
							'10000'		=>  '10,000',
							'20000'		=>  '20,000',
							'50000'		=>  '50,000',
							'100000'	=>  'More than 100,000',
						),
		'type'			=>	'select',
		'query'			=>	array(
							'query'		=>	'meta',
							'key'		=>	'property_building_area',
							'type'		=>	'numeric',
							'compare'	=>	'<='
						),
		'class'			=>	'epl-search-row-half',
		'order'			=>	250
	);


	return $fields;
}
add_filter('epl_search_widget_fields_frontend','my_epl_add_double_building_search_dropdown_field');

// Commercial Search Extension Filter
//add_filter('epl_listing_search_commercial_widget_fields_frontend','my_epl_add_double_building_search_dropdown_field');