<?php
/**
 * Delete attached images of a specified post type
 *
 * @link: https://toolset.com/forums/topic/proper-post-attachment-management-via-cred/
 */
function delete_post_children($post_id) {
	global $wpdb;

	if ( get_post_type( $post_id ) == 'property' ) { // Adjust for each post type.
		$ids = $wpdb->get_col("SELECT ID FROM {$wpdb->posts} WHERE post_parent = $post_id AND post_type = 'attachment'");
		foreach ( $ids as $id ) {
			wp_delete_attachment( $id, true );
		}
		if( has_post_thumbnail( $post_id ) ) {
			$tn_id = get_post_thumbnail_id( $post_id );
			wp_delete_attachment( $tn_id, true );
		}
	}
}
add_action('before_delete_post', 'delete_post_children');
