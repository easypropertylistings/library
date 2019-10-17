<?php
/**
 * Customise the default land search to a single number field in the search widget/shortcode.
 * The search will return land size from 0 to the number entered.
 *
 */
function my_epl_add_single_land_search_number_field($fields) {
	foreach($fields as $field_key   =>  &$field) {
	        if( in_array($field['meta_key'], array('property_land_area_min','property_land_area_max','property_land_area_unit') ) ) {
			unset($fields[$field_key]);
	        }
	}
	$fields[] =array(
		'key'			=> 'search_land_area',
		//'multiple'		=> true,
		'meta_key'		=> 'property_land_area',
		'label'			=> __('Less than entered size','epl'),
		'type'			=> 'number',
		'option_filter'		=> 'property_land_area',
		'option_type'   	=> 'range', // provide range of option instead of option array
		'query'			=> array(
						'query'		=>	'meta',
						'compare'	=>	'<',
						'type'		=>	'numeric'
		),
		'class'			=> 'epl-search-row-full',
		'order'			=> 140
	);
	return $fields;
}
add_filter('epl_search_widget_fields_frontend','my_epl_add_single_land_search_number_field');

/* Alter the default Any dropdown when using the combined land size */
function my_custom_any_label_land_area_number() {
	$label = 'All';
	return $label;
}
add_filter( 'epl_search_widget_option_label_property_land_area' , 'my_custom_any_label_land_area_number' );