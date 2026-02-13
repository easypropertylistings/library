<?php
/**
 * Drop this into a small mu-plugin, Code Snippets, or your theme’s functions.php. 
 * Then visit /wp-admin/?run_directory_office_name=1 once while logged in as an admin.
 * library
 *
 * @author Merv Barrett
 */

add_action( 'admin_init', function () {

	if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( empty( $_GET['run_directory_office_name'] ) ) {
		return;
	}

	$args  = [
		'post_type'      => 'directory',
		'post_status'    => 'any',
		'posts_per_page' => -1,
		'fields'         => 'ids',
	];
	$ids = get_posts( $args );

	foreach ( $ids as $post_id ) {
		if ( '' === (string) get_post_meta( $post_id, 'property_staff_office_name', true ) ) {
			update_post_meta( $post_id, 'property_staff_office_name', 'The Property People' );
		}
	}

	wp_die( 'Done. Updated ' . count( $ids ) . ' directory posts.' );
} );
