<?php
/**
 * Alter the order of the search fields
 *
 */

function my_epl_custom_search_field_order($fields) {

	foreach($fields as &$field) {

		// change order of bedrooms
		if( $field['key'] == 'property_bedrooms'){
			$field['order'] = 200;
		}

		// change order of bathrooms
		if( $field['key'] == 'property_bathrooms'){
			$field['order'] = 220;
		}
	}

	return $fields;
}
add_filter('epl_search_widget_fields_frontend','my_epl_custom_search_field_order');