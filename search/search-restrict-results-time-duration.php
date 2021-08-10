<?php
/**
 * Restrict the search results by days back.
 *
 */
function my_epl_mod_date_custom_search_processing($meta_query) {

       $status = !empty( $_GET[ 'property_status' ] ) ? sanitize_text_field( $_GET[ 'property_status' ] ) : '';

	if( 'sold' !== $status ) {
		return $meta_query;
	}
		

	$days_back = 8 * 7; // week * days.

	$dates = [
		date ( 'Y-m-d', strtotime( '- '. $days_back. ' days' ) ),
		date ( 'Y-m-d' ),
	];

	$mod_date_query = array(
		array(
			'key'     => 'property_mod_date',
			'type'    => 'date',
			'value'   => $dates,
			'compare' => 'BETWEEN'
		)
	);

	$meta_query[] = $mod_date_query;
	return $meta_query;
}
add_filter( 'epl_preprocess_search_meta_query', 'my_epl_mod_date_custom_search_processing', 10, 2 );
