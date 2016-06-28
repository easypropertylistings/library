<?php
/**
 * Register custom widget styles in iThemes Builder
 *
 *
 * @see http://codex.easypropertylistings.com.au/category/41-ithemes-builder
 */

if ( ! function_exists( 'rec_register_widget_styles' ) ) {
    function custom_register_widget_styles() {
        builder_register_widget_style( 'Orange', 'orange-widget' );
        builder_register_widget_style( 'Blue', 'blue-widget' );
	builder_register_widget_style( 'Landing White', 'landing-white-widget' );
        // Keep adding new Widget Styles as needed for your application
    }
    add_action( 'it_libraries_loaded', 'rec_register_widget_styles' );
}