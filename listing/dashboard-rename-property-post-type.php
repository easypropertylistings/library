<?php
/**
 * Filter to rename the Property post type name in the dashboard to Residential
 *
 */
function my_epl_property_labels( $labels  ){

	$labels = array(
		'name'			=>	__('Residential', 'easy-property-listings' ),
		'singular_name'		=>	__('Residential', 'easy-property-listings' ),
		'menu_name'		=>	__('Residential', 'easy-property-listings' ),
		'add_new'		=>	__('Add New', 'easy-property-listings' ),
		'add_new_item'		=>	__('Add New Listing', 'easy-property-listings' ),
		'edit_item'		=>	__('Edit Listing', 'easy-property-listings' ),
		'new_item'		=>	__('New Listing', 'easy-property-listings' ),
		'update_item'		=>	__('Update Listing', 'easy-property-listings' ),
		'all_items'		=>	__('All Listings', 'easy-property-listings' ),
		'view_item'		=>	__('View Listing', 'easy-property-listings' ),
		'search_items'		=>	__('Search Listing', 'easy-property-listings' ),
		'not_found'		=>	__('Listing Not Found', 'easy-property-listings' ),
		'not_found_in_trash'	=>	__('Listing Not Found in Trash', 'easy-property-listings' ),
		'parent_item_colon'	=>	__('Parent Listing:', 'easy-property-listings' )
	);

return $labels;
}
add_filter( 'epl_property_labels' , 'my_epl_property_labels' );