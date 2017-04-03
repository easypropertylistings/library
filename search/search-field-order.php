<?php
/**
 * Alter the order of the search fields
 * Default order is stored in https://github.com/easypropertylistings/Easy-Property-Listings/blob/master/lib/widgets/widget-functions.php
 *
 */

function my_epl_custom_search_field_order($fields) {

	foreach($fields as &$field) {

		// change order of min bedrooms
		if( $field['meta_key'] == 'property_bedrooms_min'){
			$field['order'] = 1;
		}
		// change order of max bedrooms
		if( $field['meta_key'] == 'property_bedrooms_max'){
			$field['order'] = 2;
		}

		// change order of bathrooms
		if( $field['meta_key'] == 'property_bathrooms'){
			$field['order'] = 5;
		}
	}

	return $fields;
}
add_filter('epl_search_widget_fields_frontend','my_epl_custom_search_field_order');