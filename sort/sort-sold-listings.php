<?php
/**
 * Sort Sold Listings by Page slug
 *
 */

function my_epl_sort_recent_sales( $query ) {

	// Do nothing if page is not recent sales page
	if ( is_admin() || $query->is_main_query() || is_search() || !is_page('recent-sales') ) // Adjust the page slug
		return;

	if( !in_array('property',(array) $query->query_vars['post_type']))
		return;

	// Do nothing if Easy Property Listings is not active
	if ( ! function_exists( 'epl_all_post_types' ) )
		return;

	$meta_query = array(

		'property_sold_date'	=>
			array(
				'key'		=> 'property_sold_date',
				'value'		=> '',
				'type'		=>	'DATE',
				'compare'	=> '!=',
			),
	);

	$query->set( 'posts_per_page' , 99 ); // Adjust the quantity
	$query->set('meta_query',$meta_query);
	$query->set( 'orderby',
		array(
			'property_sold_date' 	=> 'DESC'
		)
	);
}
add_action( 'pre_get_posts', 'my_epl_sort_recent_sales' , 1  );