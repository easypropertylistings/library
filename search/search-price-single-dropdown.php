<?php
/**
 * Example filter which can convert property price to a single dropdown
 */
function mb_epl_add_single_price_search_dropdown_field($fields) {
	foreach($fields as $field_key   =>  &$field) {
		if( in_array($field['meta_key'], array('property_price_from','property_price_to') ) ) {
			unset($fields[$field_key]);
		}
	}
	$fields[] =array(
		'key'           => 'search_price',
		//'multiple'    => true,
		'meta_key'      => 'property_price',
		'label'         => __('Price','epl'),
		'type'          => 'select',
		'option_filter' => 'price',
		'options'       => array(
			'0-200000'        => '$0 - $200,000',
			'200000-300000'   => '$200,000 - $300,000',
			'300000-400000'   => '$300,000 - $400,000',
			'400000-1000000'  => '$400,000 - $1,000,000',
			'1000000-9999999' => '$1,000,000+',
		),
		'option_type' => 'range', // provide range of option instead of option array
		'query'       => array(
			'query'   => 'meta',
			'compare' => 'BETWEEN',
			'type'    => 'numeric'
		),
		'class'  => 'epl-search-row-full',
		'order'  => 140,
		'exclude' => ['rental'],
		// If you use this function and modify for rentals, ensure you include the following.
		//'exclude'             => ["property","land","commercial","commercial_land","rural","business"],
	);
	return $fields;
 }
 add_filter( 'epl_search_widget_fields_frontend', 'mb_epl_add_single_price_search_dropdown_field', 99 );
