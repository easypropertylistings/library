<?php

/**
 * Sort a specific shortcode by instance_id. 
 *
 * Sorting by Current, Under Offer, Sold order. It's best to aadd the post type when using this sort.
 *
 * E.g: [listing post_type=property instance_id="sort_order"]
 *
 * @requires EPL 3.3+
 */
function my_epl_sort_current_under_offer_sold( $query ) {

	if ( $query->get( 'is_epl_shortcode' ) && 'sort_order' === $query->get( 'instance_id' ) ) { // Adjust sort_sold to be whatever you require.

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
add_action( 'pre_get_posts', 'my_epl_sort_current_under_offer_sold' , 20  );

/**
 * Best is to use the instance_id function above as this will sort all listings by this order.
 *
 * - Current
 * - Current ( Under Offer )
 * - Sold
 *
 * @param  [type] $query The query.
 */
function my_epl_alter_orderby( $query ) {

	if( !$query->is_main_query() && in_array('property', (array) $query->get('post_type') ) ) {

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

