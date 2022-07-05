<?php
/**
 * Example filter which can convert property rent to a single dropdown
 */
function rec_epl_add_single_rent_search_dropdown_field( $fields ) {
	
	foreach( $fields as $field_key   =>  &$field) {
		if( in_array($field['meta_key'], array('property_rent_from','property_rent_to') ) ) {
			unset( $fields[$field_key] );
		}
	}
	
	$fields[] =array(
		'key'           => 'search_rent',
		//'multiple'    => true,
		'meta_key'      => 'property_rent',
		'label'         => __('Rent','epl'),
		'type'          => 'select',
		'option_filter' => 'rent',
		'options'       => array(
			'0-200'     => '$0 - $200',
			'200-300'   => '$200 - $300',
			'300-400'   => '$300 - $400',
			'400-1000'  => '$400 - $1,000',
			'1000-9999' => '$1,000+',
		),
		'option_type' => 'range', // provide range of option instead of option array
		'query'       => array(
			'query'   => 'meta',
			'compare' => 'BETWEEN',
			'type'    => 'numeric'
		),
		'class'   => 'epl-search-row-full',
		'order'   => 140,
		'exclude' => ["property","land","commercial","commercial_land","rural","business"] 
	);
	return $fields;
 }
 add_filter( 'epl_search_widget_fields_frontend', 'rec_epl_add_single_rent_search_dropdown_field', 99 );
