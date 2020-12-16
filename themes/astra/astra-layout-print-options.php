<?php
/**
 * Astra Theme: Display page options, handy to determine sidebar loading.
 */

// Display Page Options
function epl_astra_meta_box_options( $array ) {
	if ( function_exists( 'astra_page_layout' )) {
		$options = astra_page_layout();
		print_r($options);
	}
}
// Disable this one done.
add_action( 'wp', 'epl_astra_meta_box_options' );