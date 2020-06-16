<?php
/**
 * Implement a versioned custom stylesheet
 */

// Enqueuing and Using Custom Javascript/Jquery
function my_epl_versioned_stylesheet() {

	$version = '';
	if ( file_exists( get_stylesheet_directory() . '/easypropertylistings/style-versioned.css' ) ) {

		$version = filemtime( get_stylesheet_directory() . '/easypropertylistings/style-versioned.css');
		wp_enqueue_style( 'epl-versioned-style', get_stylesheet_directory_uri() . '/easypropertylistings/style-versioned.css', false, $version );
	}

}
add_action( 'wp_enqueue_scripts', 'iacbr_custom_scripts' );