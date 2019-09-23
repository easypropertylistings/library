<?php
/**
 * When using the Houzez theme and searching by property_status there is a conflict. This filter renales the epl search parameter from property_status to epl_property status.
 */

/**
 * Rename property_status seearch parameter to epl_property_status
 * @uses EPL Filter epl_search_get_data
 */
function my_theme_epl_search_get_data($fields) {
	foreach($fields as $key => &$val) {
		if( $key == 'epl_property_status' ){
			$fields['property_status'] = $val;
		}
	}
	return $fields;
}
add_filter('epl_search_get_data','my_theme_epl_search_get_data');