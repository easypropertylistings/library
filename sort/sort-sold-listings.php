<?php
/**
 * Sorting sold listings by sold date on a specific page.
 *
 */



/**
 * Sort Sold Listings by Page slug: See version 2 below.
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


/**
 * Sort Sold Listings: Version 2
 *
 */
function my_epl_sort_recent_sales( $query ) {
	// Do nothing if page is not recent sales page
	if ( is_admin() || $query->is_main_query() || is_search() || !is_page('recent-sales') ) { // Adjust the page slug.
		return;
	}

	if ( ! isset($query->query_vars['post_type']) || !in_array('property',(array) $query->query_vars['post_type'])) {
		return;
	}

	// Do nothing if Easy Property Listings is not active
	if ( ! function_exists( 'epl_all_post_types' ) ) {
		return;
	}
	
	// Do not sort if variables are present in the URL.
	if ( ! empty( $_GET['sortby'] ) ) {
		return;
	}

	$meta_query = $query->get('meta_query');

	$meta_query[] = array(
		'key'		=> 'property_sold_date',
		'type'		=> 'DATE',
		'compare'	=> 'EXISTS',
	);

	$query->set('meta_query',$meta_query);

	$query->set('meta_key', 'property_sold_date' );
	$query->set('orderby', array('meta_value' => 'DESC') );
}

add_action( 'pre_get_posts', 'my_epl_sort_recent_sales' , 20  );

/**
 * Display Sold Date: Good for testing.
 *
 */
function my_epl_display_sold_date() {
	global $property;

	$sold_date = $property->get_property_price_sold_date( '' );

	if ( $sold_date ) {
		?>
		<div class="sold-date">
			<span><?php echo esc_html( $sold_date); ?></span>
		</div>
		<?php
	}
}
add_action( 'epl_property_price', 'my_epl_display_sold_date' );

/*
 * Sort a specific epl shortcode by instance_id
 *
 * @requires EPL 3.3+
 */
function my_epl_sort_recent_sales_home( $query ) {

	if( $query->get('is_epl_shortcode') && $query->get('instance_id') == '2' ) {

		$meta_query = $query->get('meta_query');
		$meta_query[] = array(
			'key'		=> 'property_sold_date',
			'type'		=> 'DATE',
			'compare'	=> 'EXISTS',
		);

		$query->set('meta_query',$meta_query);

		$query->set('meta_key', 'property_sold_date' );
		$query->set('orderby', array('meta_value' => 'DESC') );

	}

}
add_action( 'pre_get_posts', 'my_epl_sort_recent_sales_home' , 20  );
