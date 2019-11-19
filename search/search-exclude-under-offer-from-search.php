<?php
/**
 * Search Results - exclude under offer
 *
 */
function my_epl_listing_exclude_under_offer( $query ) {

	// Do nothing if in dashboard or not an archive page
	if ( is_admin() || ! $query->is_main_query() )
		return;
	// Do nothing if Easy Property Listings is not active
	if ( ! function_exists( 'epl_all_post_types' ) )
		return;

	// exclude under offer listings in search results
	if ( epl_is_search() ) {
		$meta_query = ( array ) $query->get( 'meta_query' );
		$meta_query['property_under_offer'] = array(
			'key'     => 'property_under_offer',
			'value'   => 'yes',
			'compare' => '!='
		);
		$query->set( 'meta_query', $meta_query );
		return;
	}
}
add_action( 'pre_get_posts', 'my_epl_listing_exclude_under_offer' , 20  );
