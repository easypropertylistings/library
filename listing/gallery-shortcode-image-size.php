<?php
/**
 * Resize the default [gallery] image sizes.
 *
 */

/**
 * Adjust the default gallery image size from thumbnail
 *
 * @param string $gallery_shortcode The shortcode.
 * @param string $d_gallery_n       Number of gallery images passed from EPL Settings > Gallery. 
 *
 * @return void  Shortcode.
 */
function my_resize_gallery_thumbs_epl_property_gallery_shortcode( $gallery_shortcode , $d_gallery_n ) {
	
	$image_size = 'medium'; // thumbnail, medium, epl-image-medium-crop, large, full
	
	$gallery_shortcode = '[gallery columns="'. $d_gallery_n . '" size="' . $image_size . '" link="file"]';
	return $gallery_shortcode;
}
add_filter( 'epl_property_gallery_shortcode' , 'my_resize_gallery_thumbs_epl_property_gallery_shortcode' , 10 , 2 );
