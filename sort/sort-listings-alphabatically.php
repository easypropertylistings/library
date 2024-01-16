<?php
/**
 * Sort a specific epl shortcode by instance_id
 *
 * E.g: [listing status=sold instance_id="sort_alpha"]
 *
 * @requires EPL 3.3+
 */
function my_epl_instance_id_sort_alpha_callback( $query ) {

	// Do nothing if user selects a sorting options.
	if ( isset ( $_GET['sortby'] ) ) {
		return;
	}

	if ( $query->get( 'is_epl_shortcode' ) && 'sort_alpha' === $query->get( 'instance_id' ) ) {
		$query->set( 'orderby', 'post_title' );
		$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'my_epl_instance_id_sort_alpha_callback' , 20  );
