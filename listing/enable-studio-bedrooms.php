<?php
/**
 * Filter to display the word studio when entered into the bedroom field on a listing
 *
 */

function my_epl_epl_meta_filter_bedrooms($value) {
	global $post;
	return get_post_meta($post->ID,'property_bedrooms',true);

}
add_filter('epl_meta_filter_property_bedrooms', 'my_epl_epl_meta_filter_bedrooms');