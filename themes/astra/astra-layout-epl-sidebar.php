<?php
/**
 * Astra Theme Sidebar control based on post type.
 */

// Astra
function my_epl_astra_layout_callback( $layout ) {

	if ( epl_is_search() || is_post_type_archive( 'property' ) ) {
		$layout = 'no-sidebar';
	}
	return $layout;
}
add_filter( 'astra_page_layout', 'my_epl_astra_layout_callback' );