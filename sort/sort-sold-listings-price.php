<?php
/**
 * Sorting sold listings by sold price on a specific page.
 *
 */

/**
  * Sort a specific shortcode by instance_id
  *
  * E.g: [listing status=sold instance_id="sort_sold"]
  *
  * @requires EPL 3.3+
  */
function my_epl_sort_sold_price( $query ) {

	if ( $query->get( 'is_epl_shortcode' ) && 'sort_sold' === $query->get( 'instance_id' ) ) { // Adjust sort_sold to be whatever you require,
	
		$meta_query = $query->get( 'meta_query' );
		$meta_query[] = array(
			'key'     => 'property_sold_price',
			'type'    => 'DECIMAL',
			'compare' => 'EXISTS',
		);
		
		$query->set('meta_query', $meta_query );
		$query->set('meta_key', 'property_sold_price' );
		$query->set('orderby', array( 'meta_value_num' => 'DESC' ) );
		
	}

}
add_action( 'pre_get_posts', 'my_epl_sort_sold_price' , 20  );
