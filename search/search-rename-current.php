<?php
/**
 * Rename the property_status Current option
 */
function my_epl_get_unique_post_meta_values_current( $results, $key, $type ) {

	if ( isset( $results['current'] ) ) {
		$results['current'] = 'Leasing Now';
	}
	return $results;
}
add_filter( 'epl_get_unique_post_meta_values', 'my_epl_get_unique_post_meta_values_current', 10, 3 );
