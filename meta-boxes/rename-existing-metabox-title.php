<?php
/**
 * How to rename metabox title
 */

function my_epl_change_land_details($group) {
	$group['label'] = __('Listing Details','my-theme');
	return $group;
}
// for business , commercial and land post types
add_filter('epl_meta_box_block_epl_features_section_id_single_column', 'my_epl_change_land_details');
// for rentals and property
add_filter('epl_meta_box_block_land_details', 'my_epl_change_land_details');