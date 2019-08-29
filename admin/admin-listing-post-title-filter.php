<?php
/**
 * Add a Featured label in the dashboard to listings
 *
 */

// Default title filter
function rec_admin_edit_post_change_title_in_list() {

	if ( is_epl_core_post() ) {
		add_filter( 'the_title', 'rec_admin_construct_new_title', 100, 2 );
	}

}
add_action( 'admin_head-edit.php', 'rec_admin_edit_post_change_title_in_list' );

// Create New title
function rec_admin_construct_new_title( $title, $id ) {
	global $property;

	$address = $property->get_formatted_property_address() . epl_get_the_address();
	return $address;
}