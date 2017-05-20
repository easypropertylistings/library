<?php
/**
 * Adjust the default search results to sort by price meta_key ASC.
 *
 */

/**
 * Search Results Ordering
 */
function my_epl_search_results_default_sort( $query ) {
	// Do nothing if in dashboard or not an archive page

	// Do nothing if Easy Property Listings is not active
	if ( ! function_exists( 'epl_all_post_types' ) )
		return;

	// Sort EPL listings by price on archive page
	if ( epl_is_search() && ! $_GET['sortby']) {

		// If rental post type sory by property_rent meta key
		if ( is_post_type_archive( 'rental' ) ) {
			$query->set( 'meta_key', 'property_rent' );
		} else {
		// Default for other post types
			$query->set( 'meta_key', 'property_price' );
		}
	    	$query->set( 'orderby', 'meta_value_num' );
	    	$query->set( 'order', 'ASC' );
		return;
	}
}
add_action( 'pre_get_posts', 'my_epl_search_results_default_sort' , 20  );