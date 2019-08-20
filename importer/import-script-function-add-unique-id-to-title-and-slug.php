<?php
/*
 * Add the property_unique_id to the post title and slug
 *
 * Usage: Add function to site, will alter all EPL imports.
 */
function epl_all_import_post_saved_property_unique_id($id) {

	$the_post = get_post($id);

	if( ! in_array( $the_post->post_type, epl_get_core_post_types(), true ) ) {
		return;
	}

	$u_id = get_post_meta($id, 'property_unique_id', true);

	if( ! empty( $u_id ) && ! epl_ends_with( $the_post->post_name, $u_id ) ) {

		$my_post = array(
			'ID'           	=> $id,
			'post_title'   	=> $u_id . ' - ' . $the_post->post_title,
			'post_name'   	=> sanitize_key( $u_id ) . '-' . $the_post->post_name
		);

		wp_update_post( $my_post );
	}

}
add_action('pmxi_saved_post', 'epl_all_import_post_saved_property_unique_id', 10, 1);