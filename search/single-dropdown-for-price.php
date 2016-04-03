<?php
/**
 * Example filter which can convert property price to a single dropdown
 * this filter is for comercial property type specifically
 */

function mb_epl_add_single_price_search_dropdown_field($fields) {
	foreach($fields as $field_key   =>  &$field) {
	        if( in_array($field['meta_key'], array('property_price_from','property_price_to') ) ) {
			unset($fields[$field_key]);
	        }
	}
	$fields[] =array(
		'key'			=>	'search_price',
		//'multiple'		=>	true,
		'meta_key'		=>	'property_com_rent',
		'label'			=>	__('Price Per Month','epl'),
		'type'			=>	'select',
		'option_filter'		=>	'property_com_rent',
		'options'		=>	array(
							'0-2500'	=>  'Under $2,500',
							'2500-5000'	=>  '$2,500 to $5,000',
							'5000-7500'	=>  '$5,000 to $7,500',
							'7500-15000'	=>  '$7,500 to $15,000',
							'15000-100000'	=>  'Over $15,000',
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
add_filter('epl_search_widget_fields_frontend','mb_epl_add_single_price_search_dropdown_field');
