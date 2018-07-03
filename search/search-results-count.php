<?php
/**
 * Search Results Quantity Display and hooked to epl_property_loop_start
 *
 */

function my_epl_search_results_count() {
	if ( epl_is_search() ) {
		global $wp_query;
	 	echo $wp_query->found_posts .' '. __('results found','easy-property-listings');
	}
}
add_action('epl_property_loop_start','my_epl_search_results_count');