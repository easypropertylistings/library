<?php
/**
 * Sort Listings by Unique ID
 *
 */

// Sort Listing Archive pages and search results by unique ID
function my_epl_listing_sort_property_unique_id( $query ) {
	// Do nothing if in dashboard or not an archive page
	if ( is_admin() || ! $query->is_main_query() )
		return;

	// Do nothing if Easy Property Listings is not active
	if ( ! function_exists( 'epl_all_post_types' ) )
		return;

	// Sort EPL listings by price on archive page or search results
	if ( is_post_type_archive( epl_all_post_types() == 'true' ) || is_search() ) {

		$query->set( 'meta_key', 'property_unique_id' );
	    	$query->set( 'orderby', 'property_unique_id' );
	    	$query->set( 'order', 'DESC' );
		return;
	}
}
add_action( 'pre_get_posts', 'my_epl_listing_sort_property_unique_id' , 1  );


// Output Unique ID
function my_output_property_unique_id() {
	global $property;

	$id = $property->get_property_meta( 'property_unique_id' );

	echo '<h2>'. $id .'</h2>';
}
add_action( 'epl_property_price' , 'my_output_property_unique_id' );