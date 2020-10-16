<?php
/**
 * Force Grid Mode using the epl-listing-grid-view-forced post class.
 *
 */

/**
 * Add the forced class to archive listings to force grid mode
 *
 * @param string $classes Classes.
 * @param string $class Class name.
 * @param string $post_id Post ID.
 *
 * @return array
 * @since 1.0.0
 */
function my_epl_force_grid_mode_callback( $classes, $class, $post_id ) {

	if ( is_epl_post() && ! is_epl_post_single() ) {
		$classes[] = 'epl-listing-grid-view-forced'; // Add the forced class to listing cards.
	}

	// Return the array.
	return $classes;
}
add_filter( 'post_class', 'my_epl_force_grid_mode_callback', 10, 3 );

/**
 * Remove the Grid/List Switch Icons
 *
 * @since 1.0.0
 */
remove_action( 'epl_switch_views', 'epl_switch_views' );