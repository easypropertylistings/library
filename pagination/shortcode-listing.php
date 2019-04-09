<?php
/*
 * Shortcode Listing Template
 * @package     EPL
 * @subpackage  Templates/Content
 * @copyright   Copyright (c) 2015, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @var $attributes array 		Shortcode Attributes.
 * @var $query_open WP_Query 	Query object for listings.
 */

global $shortcode_query;
$shortcode_query = $query_open;
function rnz_shortcode_pagination() {
	global $shortcode_query;
	do_action( 'epl_pagination',array( 'query'	=> $shortcode_query ) );
}
add_action('epl_archive_utility_wrap_start','rnz_shortcode_pagination');

if ( $query_open->have_posts() ) {
	$attributes['class'] = isset( $attributes['class'] ) ? $attributes['class'] : 'epl-shortcode-listing';
	?>
	<div class="loop epl-shortcode">
		<div class="loop-content <?php echo $attributes['class']; ?> <?php echo epl_template_class( $attributes['template'], 'archive' ); ?>">
			<?php
			if ( $attributes['tools_top'] == 'on' ) {
				do_action( 'epl_property_loop_start' );
			}
			while ( $query_open->have_posts() ) {
				$query_open->the_post();
				$attributes['template'] = str_replace( '_', '-', $attributes['template'] );
				epl_property_blog( $attributes['template'] );
			}
			if ( $attributes['tools_bottom'] == 'on' ) {
				do_action( 'epl_property_loop_end' );
			}
			?>
		</div>
		<div class="loop-footer">
				<?php
					if ( $attributes['pagination'] == 'on' ) {
						do_action( 'epl_pagination',array( 'query'	=> $query_open ) );
					}
				?>
		</div>
	</div>
	<?php
	wp_reset_postdata();
} else {
	echo '<h3>' . __( 'Nothing found, please check back later.', 'easy-property-listings'  ) . '</h3>';
}
