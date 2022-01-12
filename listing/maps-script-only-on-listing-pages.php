<?php
/**
 * Only load EPL google maps on single listing pages.
 *
 */
function my_epl_google_maps_script_only_on_single_listing() {
	if ( function_exists( 'is_epl_post_single' ) ) {
		if ( ! is_epl_post_single() ) {
			wp_dequeue_script( 'is_epl_post_single' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'my_epl_google_maps_script_only_on_single_listing', 20 )
