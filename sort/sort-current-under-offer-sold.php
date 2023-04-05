<?php

/**
 * Best is to use the instance_id function above as this will sort all listings by this order.
 *
 * Usage: [listing instance_id="sort_current_under_offer_sold"]
 *
 * - Current (published date first)
 * - Current
 * - Current
 * - Current ( Under Offer ) (published date first)
 * - Current ( Under Offer )
 * - Current ( Under Offer )
 * - Sold (published date first)
 * - Sold
 * - Sold
 * - Sold
 *
 * @param array $query The query.
 */
function my_epl_alter_orderby( $query ) {

	if ( $query->get( 'is_epl_shortcode' ) && 'sort_current_under_offer_sold' === $query->get( 'instance_id' ) )  {

		$meta_query = $query->get( 'meta_query' );
		$meta_query['property_status_clause'] = array(
			'key'     => 'property_status',
			'value'   => '',
			'compare' => '!='
		);
		$query->set( 'meta_query', $meta_query);
		$query->set( 'meta_key', 'property_under_offer');
		$query->set( 'orderby', 
			array( 
				'property_status_clause' => 'ASC',
				'property_under_offer'   => 'ASC',
				'date'                   => 'DESC' // Sort by published date.
			) 
		);
	}
}
add_action( 'pre_get_posts', 'my_epl_alter_orderby', 99 );

/**
 * Display Published Date: Good for testing.
 *
 */
function my_epl_display_published_date() {
	global $property;

	$date = $property->post->post_date;

	if ( $date ) {
		?>
		<div class="published-date">
			<span><?php echo esc_html( $date); ?></span>
		</div>
		<?php
	}
}
add_action( 'epl_property_price', 'my_epl_display_published_date' );




/**
 * Sort search results property archive page.
 *
 * Best is to use the instance_id with a shortcode and the function above as this will sort all listings by this order.
 *
 * - Current
 * - Current ( Under Offer )
 * - Sold
 *
 * @param  [type] $query The query.
 */
function my_epl_alter_orderby( $query ) {

	if( ! $query->is_main_query() && in_array('property', (array) $query->get('post_type') ) ) {

		$meta_query = $query->get( 'meta_query' );
		$meta_query['property_status_clause'] = array(
			'key'     => 'property_status',
			'value'   => '',
			'compare' => '!='
		);
		$query->set( 'meta_query', $meta_query);
		$query->set( 'meta_key', 'property_under_offer');
		$query->set( 'orderby', array( 'property_status_clause' => 'ASC', 'property_under_offer' => 'ASC' ) );

	}
}
add_action( 'pre_get_posts', 'my_epl_alter_orderby', 99 );

