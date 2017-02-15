<?php
/**
 * Set the default sort to building area
 *
 */

function my_epl_listing_default_sort_building( $query ) {
	// Do nothing if in dashboard or not an archive page
	if ( is_admin() || ! $query->is_main_query() )
		return;

	// Do nothing if Easy Property Listings is not active
	if ( ! function_exists( 'epl_all_post_types' ) )
		return;

	// Sort EPL listings by price on archive page
	if ( is_post_type_archive( epl_all_post_types() == 'true' ) ) {

		// Default for other post types
		$query->set( 'meta_key', 'property_building_area' );
	    	$query->set( 'orderby', 'meta_value_num' );
	    	$query->set( 'order', 'DESC' );
		return;
	}
}
add_action( 'pre_get_posts', 'my_epl_listing_default_sort_building' , 1  );