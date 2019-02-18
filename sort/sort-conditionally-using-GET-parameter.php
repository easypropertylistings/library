<?php
/**
 * How to add additional sorting options conditionally using $_GET URL parameter
 *
 */
function rec_sort_by_sold_date( $options ) {

	if( isset($_GET['property_status']) && $_GET['property_status'] == 'sold' && isset($_GET['post_type']) && $_GET['post_type'] == 'property' ){

		// sold only

		$options[] = array(
			'id'		=>	'sold_high',
			'label'		=>	__('Sold Price: High to Low','easy-property-listings' ),
			'type'		=>	'meta',
			//'key'		=>	is_epl_rental_post( $post_type ) ? 'property_rent':'property_sold_price',
			'key'		=>	'property_sold_price',
			'order'		=>	'DESC',
			'orderby'	=>	'meta_value_num',
		);

		$options[] = array(
			'id'		=>	'sold_low',
			'label'		=>	__('Sold Price: Low to High','easy-property-listings' ),
			//'key'		=>	is_epl_rental_post( $post_type ) ? 'property_rent':'property_sold_price',
			'key'		=>	'property_sold_price',
			'order'		=>	'ASC',
			'orderby'	=>	'meta_value_num',
		);

	}

	return $options;

}
add_filter('epl_sorting_options','rec_sort_by_sold_date');