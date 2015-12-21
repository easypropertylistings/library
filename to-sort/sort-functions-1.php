<?php
/**
 * Custom Functions, Filters and Hooks
 *
 *
 */
/************************************
 * Functions
 ***********************************/






/************************************
 * Filters
 ***********************************/
function rec_epl_search_widget_label_location() {
	$label = 'Suburbs';
	return $label;
}
add_filter( 'epl_search_widget_option_label_location' , 'rec_epl_search_widget_label_location' , 1 );
function rec_epl_search_widget_label_category() {
	$label = 'Property Type';
	return $label;
}
add_filter( 'epl_search_widget_option_label_category' , 'rec_epl_search_widget_label_category' );
function rec_epl_search_widget_label_price_from() {
	$label = 'Price From:';
	return $label;
}
add_filter( 'epl_search_widget_option_label_price_from' , 'rec_epl_search_widget_label_price_from' );
function rec_epl_search_widget_label_price_to() {
	$label = 'Price To:';
	return $label;
}
add_filter( 'epl_search_widget_option_label_price_to' , 'rec_epl_search_widget_label_price_to' );
function rec_epl_search_widget_label_bedrooms_min() {
	$label = 'Bed:';
	return $label;
}
add_filter( 'epl_search_widget_option_label_bedrooms_min' , 'rec_epl_search_widget_label_bedrooms_min' );
function rec_epl_search_widget_label_bedrooms_max() {
	$label = 'Bed Max:';
	return $label;
}
add_filter( 'epl_search_widget_option_label_bedrooms_max' , 'rec_epl_search_widget_label_bedrooms_max' );
function rec_epl_search_widget_label_bathrooms() {
	$label = 'Bath:';
	return $label;
}
add_filter( 'epl_search_widget_option_label_bathrooms' , 'rec_epl_search_widget_label_bathrooms' );
function rec_epl_search_widget_label_parking() {
	$label = 'Parking';
	return $label;
}
add_filter( 'epl_search_widget_option_label_carport' , 'rec_epl_search_widget_label_parking' );


// Disable default icon output
remove_action('epl_property_icons','epl_property_icons');


// property land icon
function rec_get_property_land_value($returntype = 'i') {

	global $property;

	if(intval($property->get_property_meta('property_land_area')) != 0 ) {


		$property_land_area_unit = $property->get_property_meta('property_land_area_unit');

		if ( $property_land_area_unit == 'squareMeter' ) {
			$property_land_area_unit = __('sqm' , 'epl');
		}

		$land['l'] = '<li class="land-size">'. __('Land is', 'epl').' ' . $property->get_property_meta('property_land_area') .' '.$property_land_area_unit.'</li>';
		$land['i'] = '<span title="'.__('Land', 'epl').'" class="icon land"><span class="icon-value">' . $property->get_property_meta('property_land_area') .' '.$property_land_area_unit.'</span></span>';
		return $land[$returntype];
	}

}

function rec_epl_property_icons() {
	global $property;
	echo $property->get_property_bed( ).
		$property->get_property_bath().
		$property->get_property_parking().
		$property->get_property_air_conditioning().
		$property->get_property_pool().

		rec_get_property_land_value();
}
add_action( 'epl_property_icons' , 'rec_epl_property_icons' );

/*** Author Box ***/
remove_action( 'epl_single_author' ,'epl_property_author_box' );



function rec_author_box() {

	global $epl_author, $property;

	$permalink 	= apply_filters('epl_author_profile_link', get_author_posts_url($epl_author->author_id) , $epl_author);
	$property_inspection_times = $property->get_property_inspection_times();


?>
	<div class="rec-author-box-background-wrapper coulson-contact-info">
		<div class="rec-author-box">
			<div class="rec-author-box-rightinfo rightinfo">
				<?php if(trim($property_inspection_times) != '') { ?>
					<div class="rec-author-box-rightinfo-box">
						<div class="rec-author-box-wrapper wrapper-widget">
							<div class="icon">
								<i class="fa fa-clock-o fa-3x"></i>
							</div>

							<div class="right-text">
								<div class="entry-title-widget">
									Upcoming Open Inspection Times:
								</div>

								<div class="timing">
									<?php do_action('epl_property_inspection_times'); ?>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>

			<div class="rec-author-box-left leftinfo">
				<div class="rec-author-box-wrapper wrapper-widget">
					<div class="image">
						<div class="rec-author-image">
							<a href="<?php echo $permalink ?>">
								<?php do_action('epl_author_thumbnail',$epl_author); ?>
							</a>
						</div>
					</div>
					<div class="text-content">
						<div class="entry-title-widget">
							<?php echo $epl_author->get_author_name(); ?>
						</div>
						<div class="telephone">
							<i class="fa fa-phone"></i><?php echo $epl_author->get_author_mobile(); ?>
						</div>
						<div class="email">
							<i class="fa fa-envelope"></i>
							<?php echo $epl_author->get_email_html(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}
add_action( 'epl_single_after_author_box' , 'rec_author_box' );

function rec_back_to_buy() { ?>
	<div class="coulson-back-to-buy-wrapper">
		<a href="../"><button><i class="fa fa-chevron-left"></i>Back to buy</button></a>
	</div>
<?php
}
add_action( 'rec_back_to_buy' , 'rec_back_to_buy' );

function rec_back_to_blogs() { ?>
	<div class="coulson-back-to-buy-wrapper rec-back-to-blogs">
		<a href="<?php bloginfo( 'url' );?>/blog/"><button><i class="fa fa-chevron-left"></i>Back To All blogs</button></a>
	</div>
<?php
}
add_action( 'rec_back_to_blogs' , 'rec_back_to_blogs' );

// Excerpt in EPL
remove_filter('excerpt_more', 'epl_property_new_excerpt_more');

function rec_epl_property_new_excerpt_more( $more ) {
	global $post;
	return '...';
}
add_filter('excerpt_more', 'rec_epl_property_new_excerpt_more');


// Staff Directory Listings
function rec_epl_sd_single_staff_listings_callback() {
	global $epl_settings, $epl_author;

	$quantity 	= isset($epl_settings['epl_sd_single_listing_count']) ? $epl_settings['epl_sd_single_listing_count'] : '8';

	$owned_listings = epl_sd_recent_listings( $epl_author , $quantity  );

	$display = 'image';
	$image = 'thumbnail';
	$d_title = FALSE;
	$d_icons = FALSE;

	$name = $epl_author->get_author_name();

	if ( $name == 'Michael Coulson') {

	}

	// echo $owned_listings;

	$listing_style = isset($epl_settings['epl_sd_listing_template']) ? $epl_settings['epl_sd_listing_template'] : 'blog'; // default is card

	if($owned_listings) {

		echo '<div class="epl-sd-listings directory-section epl-clearfix">';


		echo "<div class='rec-internal-container-title rec-internal-white'><h4 class='loop-title'>For Sale with $name</h4></div>";

		global $post;

		foreach($owned_listings as $post) {
			setup_postdata($post);
			epl_property_blog($listing_style);
		}

		wp_reset_postdata();
		echo '</div>';
	}

}

add_action( 'rec_epl_sd_single_staff_listings' , 'rec_epl_sd_single_staff_listings_callback' );