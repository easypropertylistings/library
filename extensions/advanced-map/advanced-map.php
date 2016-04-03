<?php
/**
 * Advanced Map dynamic shortcode for archive page based on post type
 *
 */

function rec_epl_advanced_map_archive_map_callback() {
	global $post;
?>
	<div class="rec-epl-property-map">

	<?php
		if ( $post->post_type == 'property')
			$post_type = $post->post_type;
		else if ($post->post_type == 'rental')
			$post_type = $post->post_type;
		else if ($post->post_type == 'commercial')
			$post_type = $post->post_type;
		else if ($post->post_type == 'commercial_land')
			$post_type = $post->post_type;
		else if ($post->post_type == 'business')
			$post_type = $post->post_type;
		else if ($post->post_type == 'rural')
			$post_type = $post->post_type;
		else if ($post->post_type == 'land')
			echo do_shortcode('[advanced_map zoom=12 height="800"]');
		else if ($post->post_type == 'suburb')
			$post_type = $post->post_type;
		else
			$post_type = '';
		?>
		<?php echo do_shortcode("[advanced_map post_type=$post_type display=simple zoom=13 height=800]"); ?>
	</div>
<?php
}
add_action( 'rec_archive_map' , 'rec_epl_advanced_map_archive_map_callback' );

/**
 * Advanced Map custom marker icon
 *
 */
function rec_epl_am_marker_icon() {

	$marker = get_stylesheet_directory_uri() . '/easypropertylistings/map/icon_property.png';
	return $marker;
}
add_filter( 'epl_am_marker_icon' , 'rec_epl_am_marker_icon' );
