<?php
/**
 * When using the Houzez theme and searching by property_status there is a conflict. 
 * This filter renames the epl search parameter from property_status to epl_property status.
 */

/**
 * Rename property_status search parameter to epl_property_status
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

/**
 * JS to alter the property_status
 * @uses EPL Filter epl_search_get_data
 */
function theme_houzez_js_fix() {
	?>
        <script>
                jQuery( document ).ready( function($) {
                        if( $( '#property_status' ).length ) {
                                $( '#property_status' ).attr( 'name', 'epl_property_status');
                        }
                });
        </script>
	<?php
}
add_action( 'wp_footer', 'theme_houzez_js_fix');
