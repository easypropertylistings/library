<?php
/**
 * SHORTCODE :: New Listings [listing_new]
 *
 * @package     EPL
 * @subpackage  Shortcode/ListingNew
 * @copyright   Copyright (c) 2014, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Listing New Shortcode
 *
 * This shortcode allows for you to specify the property type(s) using
 * [listing_new post_type="property,rental"] option. You can also
 * limit the number of entries that display. using  [listing_new limit="5"]
 *
 * @since 1.0
 */
function epl_shortcode_property_new_callback( $atts ) {
	$property_types = epl_get_active_post_types();
	if(!empty($property_types)) {
		 $property_types = array_keys($property_types);
	}

	extract( shortcode_atts( array(
		'post_type' 		=>	$property_types, //Post Type
		'limit'			=>	'-1', // Number of maximum posts to show
		'template'		=>	false, // Template. slim, table
		'location'		=>	'', // Location slug. Should be a name like sorrento
		'tools_top'		=>	'off', // Tools before the loop like Sorter and Grid on or off
		'tools_bottom'		=>	'off', // Tools after the loop like pagination on or off
		'sortby'		=>	'', // Options: price, date : Default date
		'sort_order'		=>	'DESC',
		'pagination'		=> 	'on'

	), $atts ) );

	if(is_string($post_type) && $post_type == 'rental') {
		$meta_key_price = 'property_rent';
	} else {
		$meta_key_price = 'property_price';
	}

	$sort_options = array(
		'price'			=>	$meta_key_price,
		'date'			=>	'post_date'
	);

	ob_start();
	if( !is_array($post_type) ) {
		$post_type 			= array_map('trim',explode(',',$post_type) );
	}

	global $epl_settings;
	$after = '- '.$epl_settings['sticker_new_range'].' days';

	$args = array(
		'post_type' 		=>	$post_type,
		'posts_per_page'	=>	$limit,
		'date_query' => array(
			array(
				'column'  => 'post_date',
        		'after'   => $after,
			),
		),
	);

	if(!empty($location) ) {
		if( !is_array( $location ) ) {
			$location = explode(",", $location);
			$location = array_map('trim', $location);

			$args['tax_query'][] = array(
				'taxonomy' => 'location',
				'field' => 'slug',
				'terms' => $location
			);
		}
	}

	if( $sortby != '' ) {

		if($sortby == 'price') {
			$args['orderby']	=	'meta_value_num';
			$args['meta_key']	=	$meta_key_price;
		} else {
			$args['orderby']	=	'post_date';
			$args['order']		=	'DESC';

		}
		$args['order']			=	$sort_order;
	}


	// add sortby arguments to query, if listings sorted by $_GET['sortby'];
	$args = epl_add_orderby_args($args);

	$query_open = new WP_Query( $args );
	if ( $query_open->have_posts() ) { ?>
		<div class="loop epl-shortcode">
			<div class="loop-content epl-shortcode-listing-location <?php echo epl_template_class( $template ); ?>">
				<?php
					if ( $tools_top == 'on' ) {
						do_action( 'epl_property_loop_start' );
					}
					while ( $query_open->have_posts() ) {
						$query_open->the_post();

						$template = str_replace('_','-',$template);
						epl_property_blog($template);
					}
					if ( $tools_bottom == 'on' ) {
						do_action( 'epl_property_loop_end' );
					}

				?>
			</div>
			<div class="loop-footer">
				<?php
					if( $pagination == 'on')
					do_action('epl_pagination',array('query'	=>	$query_open));
				?>
			</div>
		</div>
		<?php
	} else {
		echo '<h3 class="epl-shortcode-listing-new epl-alert">'.__('No recent listings, please check back later.', 'easy-property-listings' ).'</h3>';
	}
	wp_reset_postdata();
	return ob_get_clean();
}
add_shortcode( 'listing_new', 'epl_shortcode_property_new_callback' );
