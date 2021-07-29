<?php
/*
 * Plugin Name: Easy Property Listings - Divi Theme SVG icon fix
 * Plugin URL: https://easypropertylistings.com.au/
 * Description: Adds filters to Easy Property Listings
 * Version: 1.0.0
 * Author: Merv Barrett
 * Author URI: https://www.realestateconnected.com.au
 */

// Disable Defualt SVG loader.
remove_action( 'wp', 'epl_init_svgs' );

/**
 * Divi Missing Hooks for SVG Icons
 *
 * When using a custom header using Divi builder the body hooks are not loaded.
 * This mini plugin corrects the SVG loading using Divi hooks.
 *
 */
if ( function_exists( 'epl_load_svg_listing_icons_head' ) ) {
	add_action( 'et_before_main_content', 'epl_load_svg_listing_icons_head', 900 );
	add_action( 'et_before_main_content', 'epl_load_svg_social_icons_head', 900 );
}
