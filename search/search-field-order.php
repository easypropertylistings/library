<?php
/**
 * Alter the order of the search fields
 * Default order is stored in https://github.com/easypropertylistings/Easy-Property-Listings/blob/master/lib/widgets/widget-functions.php
 *
 */

function my_epl_search_widget_fields_frontend( $fields ) {
	foreach( $fields as &$field ) {
		if( $field['key'] == 'search_land_area' ) {
			$field['order'] = '1';
		}

		if( $field['key'] == 'search_price' ) {
			$field['order'] = '1';
		}

		// Repeat the above if and alter the name
	}
	return $fields;
}
add_filter( 'epl_search_widget_fields_frontend', 'my_epl_search_widget_fields_frontend' , 90 );