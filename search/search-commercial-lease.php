<?php
/**
 * Add a commercial type select box
 *
 */

function my_epl_commercial_search_widget_fields_frontend_checkbox ($fields) {

	foreach ($fields as &$field) {
		if($field['key']		==	'search_com_listing_type') {
			$field = array(
				'key'			=>	'search_com_listing_type',
				'meta_key'		=>	'property_com_listing_type',
				'label'			=>	__('Commercial Type','easy-property-listings'),
				'option_filter'	=>	'property_com_listing_type',
				'options'			=>	array('sale'	=>	__('Sale','easy-property-listings'),'lease'	=>	__('Lease','easy-property-listings') ),
				'type'			=>	'checkbox_multiple',
				'query'			=>	array('query'	=>	'meta','compare'	=>	'IN' ),
				'class'			=>	'epl-search-row-full',
				'order'			=>	15
			);
			break;

		}
	}

    return $fields;
}
add_filter('epl_listing_search_commercial_widget_fields_frontend','my_epl_commercial_search_widget_fields_frontend_checkbox');