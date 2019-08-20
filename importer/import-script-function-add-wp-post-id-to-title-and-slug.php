<?php
/*
 * Add the WordPress post ID the post title and slug
 *
 * Usage: Add function to site, will alter all EPL imports.
 */
function epl_all_import_post_saved_post_id($id) {

	$the_post = get_post($id);

	if( ! in_array( $the_post->post_type, epl_get_core_post_types(), true ) ) {
		return;
	}

	if( ! epl_ends_with( $the_post->post_name, $id ) ) {

		$my_post = array(
			'ID'           	=> $id,
			'post_title'   	=> $id . ' - ' . $the_post->post_title,
			'post_name'   	=> sanitize_key( $id ) . '-' . $the_post->post_name
		);

		wp_update_post( $my_post );
	}
}
add_action('pmxi_saved_post', 'epl_all_import_post_saved_post_id', 10, 1);