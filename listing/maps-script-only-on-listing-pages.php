<?php
/**
 * Only load EPL Google Maps API key on single listing pages.
 *
 */
function my_epl_google_maps_script_only_on_single_listing() {
	if ( function_exists( 'is_epl_post_single' ) ) {
		if ( is_epl_post_single() ) {
			wp_dequeue_script( 'google-map' ); 
			// Omit the -js that is displayed in the page source as that is auto-added by WordPress. 
			// E.g. Registered script name is google-map but the page source will display  id="google-map-js" 
		}
	}
}
add_action( 'wp_enqueue_scripts', 'my_epl_google_maps_script_only_on_single_listing', 20 );

/**
 * Remove EPL Google Maps API key entirely from frontend.
 *
 */
function my_epl_google_maps_script_remove() {
	
	wp_dequeue_script( 'google-map-v-3' );

}
add_action( 'wp_enqueue_scripts', 'my_epl_google_maps_script_remove', 20 );
