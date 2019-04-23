<?php
/*
 * With latest EPL version we can better target shortcode queries in pre_get_posts action.
 * all conditions can be used in conjuction with each other for better conditional targeting
 *
 * @requires 3.3
 *
 */
 function epl_target_shortcode_query($query) {

	if( $query->get('is_epl_shortcode') ) {
		// will return true for EPL shortcodes [listing], [listing_open] etc
	}

	if( $query->get('epl_shortcode_name') == 'listing' ) {
		// only target shortcode [listing] query
	}

	if( $query->get('instance_id') == '2' ) {
		// only target shortcode query with instance ID = 2
	}
}
add_action('pre_get_posts','epl_target_shortcode_query');