<?php
/**
 * Sort location by a-z using instance_id option in shortcode.
 *
 * E.g: [listing instance_id="sort_location_alpha"]
 *
 * @requires EPL 3.3+
 */
function my_epl_instance_id_sort_location_alpha_callback( $query ) {

	// Do nothing if user selects a sorting options.
	if ( isset ( $_GET['sortby'] ) ) {
		return;
	}

	if ( $query->get( 'is_epl_shortcode' ) && 'sort_location_alpha' === $query->get( 'instance_id' ) ) {
		$query->set( 'meta_key', 'property_address_suburb' );
		$query->set( 'orderby', 'property_address_suburb' );
		$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'my_epl_instance_id_sort_location_alpha_callback' , 20  );
