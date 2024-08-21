<?php
/**
 * Register and create a dashboard widget displaying the registered image sizes.
 *
*/

/**
 * Re-sync property_price_global values
 *
 * Run the command from http://your_site.com.au/wp-admin/?do_global_sync=1
 *
 * @return void  description
 */
function sync_all_global_prices() {

	if ( ! isset( $_GET['do_global_sync'] ) ) {
		return;
	}

	$all_posts = get_posts( array(
		'post_type'      => ['rental', 'property', 'land', 'rural', 'commercial', 'business' ],
		'posts_per_page' => -1,
		'post_status'    => 'publish',
	) );

	foreach ( $all_posts as $post ) {

		$post_id = $post->ID;

		if ( 'rental' === $post->post_type ) {
			$price = get_post_meta( $post_id, 'property_rent', true );
			update_post_meta( $post_id, 'property_price_global', $price );

		} elseif ( 'commercial' === $post->post_type ) {

			$price = get_post_meta( $post_id, 'property_price', true );
			if ( empty( $price ) ) {
				$price = get_post_meta( $post_id, 'property_com_rent', true );
			}
			update_post_meta( $post_id, 'property_price_global', $price );

		} else {

			$price = get_post_meta( $post_id, 'property_price', true );
			update_post_meta( $post_id, 'property_price_global', $price );
		}

		epl_print_r( $post->ID );
	}

	die('all done');

}
add_action( 'admin_init', 'sync_all_global_prices' );
