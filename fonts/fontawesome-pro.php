<?php
/**
 * Enqueue Fontawesome Pro Kit and add a filter for the crossorigin="anonymous"
 *
 */

/**
 * Enqueue Fontawesome Pro Kit
 *
 */
function my_enqueue_scripts() {

	$kit = '1234567';

	// Fontawesome Pro
	wp_enqueue_script( 'epl-fontawesome-pro', 'https://kit.fontawesome.com/' . $kit . '.js', null, '5.15.1', true );

}
add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts' );

/**
 * Filter for the crossorigin="anonymous"
 *
 * @param string $tag    The Script Tag.
 * @param string $handle The Script Name.
 * @param string $src    The Script URL.
 *
 */
function my_add_attribs_to_scripts( $tag, $handle, $src ) {
	$scripts = array(
		'epl-fontawesome-pro'
	);
	if ( in_array( $handle, $scripts ) ) {
		return '<script src="' . $src . '" crossorigin="anonymous" type="text/javascript"></script>' . "\n";
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'my_add_attribs_to_scripts', 10, 3 );