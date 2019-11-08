<?php
/**
 * Search Results - Display featured listings first
 *
 */

// Featured first
function my_epl_listing_default_featured_sort( $query ) {
	// Do nothing if in dashboard or not an archive page
	if ( is_admin() || ! $query->is_main_query() )
		return;
	// Do nothing if Easy Property Listings is not active
	if ( ! function_exists( 'epl_all_post_types' ) )
		return;
	// Do nothing if using sorting
	if( isset ( $_GET['sortby'] ) )
		return;
	// Sort EPL listings by price on archive page
	if ( epl_is_search() ) {

		$meta_query = ( array ) $query->get( 'meta_query' );
		$meta_query['property_featured'] = array(
			'relation' => 'OR',
			array(
				'key'     => 'property_featured',
				'compare' => 'NOT EXISTS',
			),
			array(
				'relation' => 'OR',
				array(
					'key'   => 'property_featured',
					'value' => 'yes',
				),
				array(
					'key'     => 'property_featured',
					'value'   => 'yes',
					'compare' => '!=',
				),
			)
		);

	$query->set( 'meta_query', $meta_query );
    	$query->set( 'orderby', 'property_featured' );
    	$query->set( 'order', 'DESC' );
		return;
	}
}
add_action( 'pre_get_posts', 'my_epl_listing_default_featured_sort' , 20  );


// Add word "featured" to title for testing
function my_featured_listing_tag_test() {
	global $property;
	$featured = $property->get_property_meta( 'property_featured' );
	if( 'on' === $featured || 'yes' === $featured || 1 === (int) $featured) {
		 echo 'Featured Listing';
	}
}
add_action( 'epl_property_before_content', 'my_featured_listing_tag_test' );