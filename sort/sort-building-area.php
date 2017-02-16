<?php
/**
 * Set the default sort to building area and add building sort options
 *
 */

// Sort Main Archive Page
function my_epl_listing_default_sort_building( $query ) {
	// Do nothing if in dashboard or not an archive page
	if ( is_admin() || ! $query->is_main_query() )
		return;

	// Do nothing if Easy Property Listings is not active
	if ( ! function_exists( 'epl_all_post_types' ) )
		return;

	// Sort EPL listings by price on archive page
	if ( is_post_type_archive( epl_all_post_types() == 'true' ) ) {

		// Set default sort to building area
		$query->set( 'meta_key', 'property_building_area' );
	    	$query->set( 'orderby', 'meta_value_num' );
	    	$query->set( 'order', 'DESC' );
		return;
	}
}
add_action( 'pre_get_posts', 'my_epl_listing_default_sort_building' , 1  );

// Add Building sort options to sorter
function my_epl_add_sorting_options_building_callback( $sorters ) {

	$sorters[] = array(
		'id'		=>	'building_asc',
		'label'		=>	__('Building : High','easy-property-listings' ),
		'type'		=>	'meta',
		'key'		=>	'property_building_area',
		'order'		=>	'DESC',
		'orderby'	=>	'meta_value_num',
	);
	$sorters[] = array(
		'id'		=>	'building_desc',
		'label'		=>	__('Building : Low','easy-property-listings' ),
		'type'		=>	'meta',
		'key'		=>	'property_building_area',
		'order'		=>	'ASC',
		'orderby'	=>	'meta_value_num',
	);

	return $sorters;
}
add_filter( 'epl_sorting_options' , 'my_epl_add_sorting_options_building_callback');

// Display the Building Size on the Loop Template
function my_output_building_size_callback() {
	global $property;

	$building_size = $property->get_property_building_area_value();

	echo '<ul>' . $building_size . '</ul>';
}
add_action( 'epl_the_excerpt' , 'my_output_building_size_callback' , 16 );

// Shortcode Sorting: Set all sorting options for shortcodes to default to building area
function my_epl_listing_default_sort_building_shortcode( $query ) {

	global $post;
	// Do nothing if in dashboard or not an archive page
	if ( is_admin() || $query->is_main_query() )
		return;

	// Do nothing if Easy Property Listings is not active
	if ( ! function_exists( 'epl_all_post_types' ) )
		return;

	if( 	(has_shortcode($post->post_content, 'listing') ||
			has_shortcode($post->post_content, 'listing_category') ||
			has_shortcode($post->post_content, 'listing_open') ||
			has_shortcode($post->post_content, 'listing_feature') ||
			has_shortcode($post->post_content, 'listing_location') ) && !isset($_GET['sortby'])
	){

		$post_type = $query->get('post_type');

		if( is_array($post_type) ){
			$diff = array_diff($post_type, epl_get_core_post_types());

			if( count($diff) == 0 ){
				$query->set( 'meta_key', 'property_building_area' );
				$query->set( 'orderby', 'meta_value_num' );
				$query->set( 'order', 'DESC' );
				return;
			}
		}
	}
}
add_action( 'pre_get_posts', 'my_epl_listing_default_sort_building_shortcode' , 99  );
