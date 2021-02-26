<?php

function rec_remove_default_video_callback() {

	remove_all_actions( 'epl_property_video' );
	add_action( 'epl_property_video', 'rec_epl_property_video_callback', 10, 1 );
}
add_action( 'wp', 'rec_remove_default_video_callback' );

function rec_epl_property_video_callback( $width = 600 ) {

	global $property;
	$video_width        = ! empty( $width ) ? $width : 600;
	$property_video_url = $property->get_property_meta( 'property_video_url' );
	echo epl_get_video_html( $property_video_url, $video_width ); //phpcs:ignore

}


function rec_epl_get_video_html( $property_video_url = '', $width = 600 ) {

	/** Remove related videos from youtube */
	if ( 'youtube' === epl_get_video_host( $property_video_url ) ) {

		$property_video_url = epl_convert_youtube_embed_url( $property_video_url );

		if ( strpos( $property_video_url, '?' ) > 0 ) {
			$property_video_url .= '&rel=0';
		} else {
			$property_video_url .= '?rel=0';
		}
	}
	$width = epl_get_option( 'epl_video_width', $width );
	if ( ! empty( $property_video_url ) ) {
		$video_html = '<div class="epl-video-container videoContainer">';

			if ( strpos($property_video_url, 'mp4') !== false ) {
			        $video_html .= do_shortcode( '[video src="'.$property_video_url.'" width="'.apply_filters( 'epl_property_video_width', $width ).'"]' );
		  	} else {
		  		$video_html .= wp_oembed_get(
					$property_video_url,
					array( 'width' => apply_filters( 'epl_property_video_width', $width ) )
				);
		  	}
			
		$video_html     .= '</div>';
		return $video_html;
	}
}
