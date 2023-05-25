<?php
/**
 * Using pre_get_posts to exclude a listing by the tax_feature item.
 *
 */

/**
  * Sort a specific epl shortcode by instance_id
  *
  * E.g: [listing status=sold instance_id="sort_sold"]
  *
  * @requires EPL 3.3+
  */
 function my_instance_id_epl_instance_id_vip_callback( $query ) {
	 
	 if ( is_admin() ) {
		 return;
	 }
 
	 // Do nothing if using sorting options.
	 if ( isset ( $_GET['sortby'] ) ) {
		 return;
	 }
 
	 if ( $query->get( 'is_epl_shortcode' ) && 'vip' !== $query->get( 'instance_id' ) || is_post_type_archive( epl_all_post_types() == 'true' ) ) {
 
		 $tax_query = array(
			 array(
				 'taxonomy' => 'tax_feature',
				 'field'    => 'slug',
				 'terms'    => ['toilet-facilities'],
				 'operator' => 'NOT IN',
			 ),
		 );
		 
		 $query->set( 'tax_query', $tax_query );
	 }
 }
 add_action( 'pre_get_posts', 'my_instance_id_epl_instance_id_vip_callback' , 20  );
