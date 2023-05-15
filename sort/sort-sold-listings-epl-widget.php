<?php
/**
 * Sort EPL Listing Widget listings by sold date.
 * 
 * Had a (Kerris) project where we used epl listing widgets in Elementor which made the widget unique ID not work correctly.
 * Solution was to only sort the widgets by sold listings.
 *
 */

/**
 * Determine Widget ID. this was not returning the widget ID in Elementor.
 */
function my_epl_wet_widget_instance_id( $query ) {

	if ( $query->get( 'is_epl_recent_property_widget' )  ) { 
		var_dump( $query->get('epl_widget_instance') );
	}

}
add_action( 'pre_get_posts', 'my_epl_wet_widget_instance_id' , 20  );


function my_epl_sort_recent_sales_home_widgets( $query ) {

	if ( $query->get( 'is_epl_recent_property_widget' ) ) { 

		$meta_query = $query->get( 'meta_query' );
		
		foreach( $meta_query as $single ) {
			
			//epl_print_r ($single);
		
			$value = (array) $single['value'];
			if( 'property_status' == $single[ 'key' ] && in_array( 'sold', $value )  )  {
				
				//echo 'sold';
			
			
				$meta_query[] = array(
					'key'     => 'property_sold_date',
					'type'    => 'DATE',
					'compare' => 'EXISTS',
				);
		
				$query->set('meta_query', $meta_query );
				$query->set('meta_key', 'property_sold_date' );
				$query->set('orderby', array( 'meta_value' => 'DESC' ) );
				break;
		
			}
		}

	}

}
add_action( 'pre_get_posts', 'my_epl_sort_recent_sales_home_widgets' , 20  );
