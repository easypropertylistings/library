<?php

// Enqueuing and Using Custom Javascript/Jquery
function rec_ash_custom_scripts() {
	// Font Awesome
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'animatecss',  get_stylesheet_directory_uri() . '/css/animate.min.css' );


	// Ash Custom Theme Scripts
	$ash_url = get_stylesheet_directory_uri() . '/js/ashmarton.js';
    wp_enqueue_script( 'waypoint', get_stylesheet_directory_uri() . '/js/waypoint/lib/jquery.waypoints.min.js',  true );
	wp_enqueue_style( 'jscroller2', get_stylesheet_directory_uri() . '/css/jscroller2-1.1.css', array(), '1.0.0', true  );

	wp_enqueue_script( 'ash_jquery_additions', $ash_url, array('jquery'), false, true );
	wp_enqueue_script( 'jscroller2', get_stylesheet_directory_uri() . '/js/jscroller2-1.61.js', array(), '1.0.0', true );
	wp_enqueue_script( 'carouFredSel', get_stylesheet_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js',  true );
	wp_enqueue_script( 'mobile-events', get_stylesheet_directory_uri() . '/js/jquery.mobile-events.min.js',  true );

}
if ( !is_admin() ) {
	add_action( 'wp_enqueue_scripts', 'rec_ash_custom_scripts' );
}


// Gravity forms filter for enabling the hide label option
add_filter("gform_enable_field_label_visibility_settings", "__return_true");


function rec_epl_custom_listing_featured_slider() {

	$post_id = get_the_ID();

	if ( function_exists( 'soliloquy_dynamic' ) ) { soliloquy_dynamic( array( 'id' => $post_id ) ); }

}
add_action( 'rec_epl_property_featured_image' , 'rec_epl_custom_listing_featured_slider' );


/**
* Modify the Read More Link of archive pages which can be styled with
* CSS using the epl-more-link selector
*
* @since 1.0
**/
function rec_epl_property_new_excerpt_more( $more ) {
	global $post;
	$post_type = get_post_type();
	if ( $post_type == 'post' )
		return '<div class="rec-read-more-wrapper"><a href="'. get_permalink( $post->ID ) . '" class="rec-more-link">'.__('Read More', 'epl').'</a></div>';
}
add_filter('excerpt_more', 'rec_epl_property_new_excerpt_more');