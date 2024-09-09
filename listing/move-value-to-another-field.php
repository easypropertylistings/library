<?php
/**
 * Move custom field value to alternate field
 */
function rec_check_and_move_matterport_url($post) {
 
	if ( ! is_epl_post() ) {
	return;
	}
	
	$video_url = get_post_meta($post->ID, 'property_video_url', true);
	
	if (strpos( $video_url, 'matterport' ) !== false) {
		update_post_meta($post->ID, 'property_external_link', $video_url);
		delete_post_meta($post->ID, 'property_video_url');
	}
}
add_action( 'the_post', 'rec_check_and_move_matterport_url' );
