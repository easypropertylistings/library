<?php
/**
 * Prevent updating custom field with WP All Import Pro
 *
 */

// Prevent updating custom field with WP All Import Pro
function dnh_epl_wpimport_pmxi_custom_field_to_delete($default, $pid, $post_type, $options, $cur_meta_key) {
	if($cur_meta_key == 'property_auction_place') {
		return false;
	}
	return true;
}
add_action('pmxi_custom_field_to_delete','dnh_epl_wpimport_pmxi_custom_field_to_delete',10,5);