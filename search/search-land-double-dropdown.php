<?php
/**
 * Customise the default land search to a double drop down for min/max in the search widget/shortcode
 *
 */

function my_epl_add_double_land_search_dropdown_field($fields) {
	foreach($fields as $field_key   =>  &$field) {
	        if( in_array($field['meta_key'], array('property_land_area_min','property_land_area_max','property_land_area_unit') ) ) {
			unset($fields[$field_key]);
	        }
	}

	$fields[] = array(
		'key'			=>	'search_land_area',
		'meta_key'		=>	'property_land_area_min',
		'label'			=>	__('Land Area Min', 'easy-property-listings'),
		'option_filter'		=>	'property_land_area_min',
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
							'key'		=>	'property_land_area',
							'type'		=>	'numeric',
							'compare'	=>	'>='
						),
		'class'			=>	'epl-search-row-half',
		'order'			=>	210
	);

	$fields[] = array(
		'key'			=>	'search_land_area',
		'meta_key'		=>	'property_land_area_max',
		'label'			=>	__('Land Area Max', 'easy-property-listings'),
		'option_filter'		=>	'property_land_area_max',
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
							'key'		=>	'property_land_area',
							'type'		=>	'numeric',
							'compare'	=>	'<='
						),
		'class'			=>	'epl-search-row-half',
		'order'			=>	220
	);

	return $fields;
}
add_filter('epl_search_widget_fields_frontend','my_epl_add_double_land_search_dropdown_field');

// Commercial Search Extension Filter
//add_filter('epl_listing_search_commercial_widget_fields_frontend','my_epl_add_double_land_search_dropdown_field');


// Min Label Filter
function my_epl_search_widget_option_label_land_min() {
	$label = 'Land Min';
	return $label;
}
add_filter( 'epl_search_widget_option_label_property_land_area_min' , 'my_epl_search_widget_option_label_land_min' );

// Max Label Filter
function my_epl_search_widget_option_label_land_max() {
	$label = 'Land Max';
	return $label;
}
add_filter( 'epl_search_widget_option_label_property_land_area_max' , 'my_epl_search_widget_option_label_land_max' );
