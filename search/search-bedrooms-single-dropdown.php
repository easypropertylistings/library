<?php
/**
 * Customise the default bedroom search to a single drop down in the search widget/shortcode
 *
 */

function my_epl_add_single_bedrooms_search_dropdown_field($fields) {
	foreach($fields as $field_key   =>  &$field) {
	        if( in_array($field['meta_key'], array('property_bedrooms_min','property_bedrooms_max') ) ) {
			unset($fields[$field_key]);
	        }
	}
	$fields[] =array(
		'key'			=>	'search_bed',
		//'multiple'		=>	true,
		'meta_key'		=>	'property_bedrooms',
		'label'			=>	__('Bedrooms','epl'),
		'type'			=>	'select',
		'option_filter'		=>	'property_bedrooms',
		'options'		=>	array(
							'Studio'	=>	'Studio',
							'1'		=>  '1',
							'2'		=>  '2',
							'3'		=>  '3',
							'4'		=>  '4',
							'5'		=>  '5',
		),
		'option_type'   =>  'range', // provide range of option instead of option array
		'query'			=>	array(
							'query'		=>	'meta',
							'compare'	=>	'EQUALS',
							'type'		=>	'numeric'
		),
		'class'			=>	'epl-search-row-full',
		'order'			=>  160
	);
	return $fields;
}
add_filter('epl_search_widget_fields_frontend','my_epl_add_single_bedrooms_search_dropdown_field');