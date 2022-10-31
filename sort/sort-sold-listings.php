<?php
/**
 * Sorting sold listings by sold date on a specific page.
 *
 */

/**
 * Sort a specific shortcode by instance_id
 *
 * E.g: [listing status=sold instance_id="sort_sold"]
 *
 * @requires EPL 3.3+
 */
function my_epl_sort_recent_sales_home( $query ) {

	if( $query->get( 'is_epl_shortcode' ) && 'sort_sold' === $query->get( 'instance_id' ) ) {

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

/**
 * Sort Sold Listings by page-slug. Using instance_id function above is a better option when sorting.
 *
 */
function my_epl_sort_recent_sales( $query ) {
	// Do nothing if page is not recent sales page
	if ( is_admin() || $query->is_main_query() || is_search() || ! is_page('recent-sales') ) { // Adjust the page slug.
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


