<?php

/**
* regeneate coords by adding ?coord_debug to URL
*
**/
function rec_regenerate_coordinates() {

	if( ! isset( $_GET['coord_debug'] ) ) {
		return;
	}

	$posts = new WP_Query(
		array(
			'post_type'		=>	epl_get_core_post_types(),
			'post_status'	=>	'any',
			'posts_per_page' =>	-1,
			'meta_query'	=>	array(
				array(
					'key'		=>	'property_address_coordinates',
					'value'		=>	array(
						'',
						','
					),
					'compare'	=>	'IN'
				)
			)
		)
	);
	while( $posts->have_posts() ) {
		$posts->the_post();
		$coord = get_property_meta( 'property_address_coordinates' );
		
		$query_address = epl_property_get_the_full_address();
		$query_address = trim( $query_address );

		if( $query_address != ',' ) {
	
			$googleapiurl = "https://maps.google.com/maps/api/geocode/json?address=$query_address&sensor=false";
	        if( epl_get_option('epl_google_api_key') != '' ) {
	            $googleapiurl = $googleapiurl.'&key='.epl_get_option('epl_google_api_key');
	        }

	        $geo_response   = wp_remote_get( $googleapiurl );
	        $geocode        = $geo_response['body'];
	        $output         = json_decode($geocode);
	        /** if address is validated & google returned response **/
	        if( !empty($output->results) && $output->status == 'OK' ) {

	            $lat      = $output->results[0]->geometry->location->lat;
	            $long     = $output->results[0]->geometry->location->lng;
	            $coord    = $lat.','.$long;

	            update_post_meta( get_the_ID(), 'property_address_coordinates', $coord);
	             update_post_meta( get_the_ID(), 'property_address_display', 'yes');
	        }
        }
	}
}

add_action( 'wp', 'rec_regenerate_coordinates');
