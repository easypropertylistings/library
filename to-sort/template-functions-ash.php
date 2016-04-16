<?php
/**
 * Custom Functions, Filters and Hooks
 *
 *
 */
/************************************
 * Functions
 ***********************************/
 // Widget Considering this Property
function rec_enquiry_form_callback() { ?>
	<div class="widget-sub-title-wrapper rec-enquiry-form">
		<h5 class="tab-title">Make an Enquiry</h5>
		<?php echo do_shortcode('[gravityform id="8" title="false" description="false" tabindex="66"]'); ?>
	</div>
<?
}
add_action( 'rec_enquiry_form' , 'rec_enquiry_form_callback' );
// Listing unlimited
function rec_epl_lu_single_download( ) {

	global $post, $epl_settings;
	$unique_id = get_post_meta( $post->ID , 'property_unique_id', true);
	$tab_title = isset($epl_settings['epl_lu_group_title']) ? __($epl_settings['epl_lu_group_title'],'epl') : __('Extra Info','epl');
	$query = new WP_Query( array (
		'post_type'	=>	'listing_unlimited',
		'meta_query'	=>	array(
				array(
				'key' => 'property_unique_id',
				'value' => $unique_id,
				'compare' => '=='
				)
			)
		)
	);

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();

			$link = get_post_meta( $post->ID , 'listing_unlimited_pdf' , true ); ?>

			<div style="xxxdisplay:none" class="rec-panel-section-32 xxxfancybox-hidden">
				<div id="xxxfancyboxID-section-32">
					<?php echo do_shortcode('[gravityform id="21" title="false" description="false" tabindex="33"]'); ?>
				</div>
			</div>
			<!--<h5 class="widget-sub-title download"><a href="#fancyboxID-section-32" class="rec-panel-section-32-popout-fancybox fancybox"><i class="fa fa-file-pdf-o"></i> Download Section 32</a></h5>-->

			<?php
		}
	}
	wp_reset_postdata();
}
add_action('epl_property_tab_section_after', 'epl_lu_single_action');
// Widget Considering this Property
function rec_download_callback() { ?>
	<div class="widget-sub-title-wrapper rec-offer-download">
		<?php rec_epl_lu_single_download() ?>
	</div>
<?
}
add_action( 'rec_download' , 'rec_download_callback' );
// Widget Considering this Property
function rec_considering_this_property_callback() {
	$post_type = get_post_type();
	if ( $post_type != 'rental' ) { ?>
		<div class="widget-sub-title-wrapper rec-offer-form">
			<h5 class="widget-sub-title">Considering This Property?</h5>

			<?php do_action('rec_download'); ?>
			<?php echo do_shortcode('[gravityform id="7" title="false" description="false" tabindex="76"]'); ?>
		</div>
<?
	}
}
add_action( 'rec_considering_this_property' , 'rec_considering_this_property_callback' , 10 );
// Widget Considering this Rental
remove_action('epl_buttons_single_property', 'epl_button_1form');
add_action('rec_epl_button_1form', 'epl_button_1form');
function rec_considering_this_rental_callback() {
	$post_type = get_post_type();
	if ( $post_type == 'rental' ) { ?>
		<div class="widget-sub-title-wrapper rec-offer-form">
			<h5 class="widget-sub-title">Considering This Rental?</h5>

			<h5 class="rec-1form-label tab-title">Apply</h5>
			<?php do_action( 'rec_epl_button_1form' ); ?>

		</div>
<?
	}
}
add_action( 'rec_considering_this_property' , 'rec_considering_this_rental_callback' , 10 );

/************************************
 * Filters
 ***********************************/
function rec_epl_search_widget_label_location() {
	$label = 'Suburbs';
	return $label;
}
add_filter( 'epl_search_widget_option_label_location' , 'rec_epl_search_widget_label_location' , 1 );
function rec_epl_search_widget_label_category() {
	$label = 'Property';
	return $label;
}
add_filter( 'epl_search_widget_option_label_category' , 'rec_epl_search_widget_label_category' );
function rec_epl_search_widget_label_price_from() {
	$label = 'Price From';
	return $label;
}
add_filter( 'epl_search_widget_option_label_price_from' , 'rec_epl_search_widget_label_price_from' );
function rec_epl_search_widget_label_price_to() {
	$label = 'Price To';
	return $label;
}
add_filter( 'epl_search_widget_option_label_price_to' , 'rec_epl_search_widget_label_price_to' );
function rec_epl_search_widget_label_bedrooms_min() {
	$label = 'Beds';
	return $label;
}
add_filter( 'epl_search_widget_option_label_bedrooms_min' , 'rec_epl_search_widget_label_bedrooms_min' );
function rec_epl_search_widget_label_bedrooms_max() {
	$label = 'Beds Max';
	return $label;
}
add_filter( 'epl_search_widget_option_label_bedrooms_max' , 'rec_epl_search_widget_label_bedrooms_max' );
function rec_epl_search_widget_label_bathrooms() {
	$label = 'Baths';
	return $label;
}
add_filter( 'epl_search_widget_option_label_bathrooms' , 'rec_epl_search_widget_label_bathrooms' );
function rec_epl_search_widget_label_parking() {
	$label = 'Parking';
	return $label;
}
add_filter( 'epl_search_widget_option_label_carport' , 'rec_epl_search_widget_label_parking' );

function rec_epl_epl_property_video_width_callback() {
	$width = '850';
	return $width;
}
add_filter( 'epl_property_video_width' , 'rec_epl_epl_property_video_width_callback' );
function rec_epl_features_taxonomy_link_filter_callback() {
	return false;
}
add_filter( 'epl_features_taxonomy_link_filter' , 'rec_epl_features_taxonomy_link_filter_callback' );
function rec_epl_author_mobile_html_callback( $html = '') {
	$html = '<i class="fa fa-mobile"></i> ' . $html;
	return $html;
}
add_filter( 'epl_author_mobile_html' , 'rec_epl_author_mobile_html_callback' );
function rec_epl_author_icon_email_callback( $html = '') {
	$html = '<span class="epl-author-email"><i class="fa fa-envelope"></i> ' . $html . '</span>';
	return $html;
}
add_filter( 'epl_author_icon_email' , 'rec_epl_author_icon_email_callback' , 1 );


function rec_epl_author_facebook_html_callback( $html = '') {
	global $epl_author;

	if ( $html != '' ) {

		$html = '
		<a class="rec-author-icon rec-author-facebook fa fa-facebook"
			href="http://facebook.com/' . $epl_author->facebook . '" title="'.__('Follow', 'epl').' '.$epl_author->name.' '.__('on Facebook', 'epl').'">'.
			apply_filters( 'epl_author_icon_facebook' , __(' ', 'epl')).
		'</a>';
		return $html;
	}
}
add_filter( 'epl_author_facebook_html' , 'rec_epl_author_facebook_html_callback' , 1 );

function rec_epl_author_linkedin_html_callback( $html = '') {
	global $epl_author;

	if ( $html != '' ) {

		$html = '
		<a class="rec-author-icon rec-author-linkedin fa fa-linkedin"
			href="http://au.linkedin.com/in/' . $epl_author->linkedin . '" title="'.__('Follow', 'epl').' '.$epl_author->name.' '.__('on linkedin', 'epl').'">'.
			apply_filters( 'epl_author_icon_facebook' , __(' ', 'epl')).
		'</a>';
		return $html;
	}
}
add_filter( 'epl_author_linkedin_html' , 'rec_epl_author_linkedin_html_callback' , 1 );

function rec_epl_author_twitter_html_callback( $html = '') {
	global $epl_author;

	if ( $html != '' ) {

		$html = '
		<a class="rec-author-icon rec-author-twitter fa fa-twitter"
			href="http://twitter.com/' . $epl_author->twitter . '" title="'.__('Follow', 'epl').' '.$epl_author->name.' '.__('on twitter', 'epl').'">'.
			apply_filters( 'epl_author_icon_facebook' , __(' ', 'epl')).
		'</a>';
		return $html;
	}
}
add_filter( 'epl_author_twitter_html' , 'rec_epl_author_twitter_html_callback' , 1 );

function rec_epl_property_address_seperator_callback() {
	$separator = '';
	return $separator;
}
add_filter('epl_property_address_seperator','rec_epl_property_address_seperator_callback');

function rec_epl_change_inspection_format($element) {
	$element = explode(' ',$element);
	$date_day_month	= '<span class="epl-month-day">' . date('l j F',strtotime($element[0])) . '</span>';
	$time		= '<span class="epl-time">' . strtolower($element[1]).' '.strtolower($element[2]).' '.strtolower($element[3]) . '</span>';

	$date		= $date_day_month . $time;

	return $date;
}
//add_filter('epl_inspection_format','rec_epl_change_inspection_format');
 /************************************
 * Actions
 ***********************************/
// Single Listing: Button Map
function rec_epl_address_bar_map_icon_callback() { ?>
	<span class="epl-map-button-wrapper map-view">
		<?php if ( is_single() ) { ?>
			<a class="epl-button epl-map-button" href="#epl-advanced-map-single">Map</a>
		<?php } else { ?>
			<a class="epl-button epl-map-button" href="<?php the_permalink() ?>#epl-advanced-map-single">Map</a>
		<?php } ?>
	</span>
<?php
}
add_action('epl_buttons_single_property','rec_epl_address_bar_map_icon_callback');
// Single Listing: Button Video
function rec_epl_address_bar_video_icon_callback() {
	global $property;

	$property_video_url	= $property->get_property_meta('property_video_url');

	if($property_video_url != '') { ?>
		<span class="epl-video-button-wrapper">
			<?php if ( is_single() ) { ?>
				<a class="epl-button epl-video-button" href="#rec-epl-video-container">Video</a>
			<?php } else { ?>
				<a class="epl-button epl-video-button" href="<?php the_permalink() ?>#rec-epl-video-container">Video</a>
			<?php } ?>
		</span>
	<?php }
}
add_action('epl_buttons_single_property','rec_epl_address_bar_video_icon_callback');
// Single Listing: Button Inspection
function rec_epl_address_bar_inspection_icon_callback() {
	global $property;
	$property_inspection_times = $property->get_property_inspection_times();
	if(trim($property_inspection_times) != '') { ?>
		<span class="epl-inspection-button-wrapper">
			<?php if ( is_single() ) { ?>
				<a class="epl-button epl-inspection-button" href="#epl_custom_inspection_times-2-background-wrapper">Inspection</a>
			<?php } else { ?>
				<a class="epl-button epl-inspection-button" href="<?php the_permalink() ?>#epl_custom_inspection_times-2-background-wrapper">Inspection</a>
			<?php } ?>
		</span>
	<?php }
}
add_action('epl_buttons_single_property','rec_epl_address_bar_inspection_icon_callback');
function rec_epl_inspection_time_widget_button_callback() {
	global $property;
	$property_inspection_times = $property->get_property_inspection_times();
	if(trim($property_inspection_times) != '') { ?>
		<!--<div class="epl-save-to-cal">Save to Calendar</div>-->
		<div id="rec-epl-inspection-container" class="epl-inspection-button-wrapper">
			<!--<span class="epl-button epl-inspection-button" href="#rec-epl-inspection-container">Inspection</span>-->
		</div>
		<div class="triangle-down"><div class="triangle"></div></div>
	<?php }
}
add_action('epl_property_inspection_times','rec_epl_inspection_time_widget_button_callback' , 99);
function rec_epl_switch_views () { ?>
	<div class="epl-switch-view epl-clearfix">
		<ul>
			<li title="<?php _e('Map','epl'); ?>" class="epl-current-view view-map" data-view="map">
			</li>
		</ul>
	</div> <?php
}
add_action('epl_add_custom_menus','rec_epl_switch_views',0);
function rec_epl_style_script() { ?>
	<style>
		.rec-epl-property-map {
			display:none;
		}
	</style>

	<script>
		jQuery(document).ready(function(){

			jQuery('.epl-switch-view ul li').click(function(){
				var view = jQuery(this).data('view');
				if(view == 'map') {
					jQuery('.rec-epl-property-grid').hide();
					jQuery('.rec-epl-property-map').show();
					comparablesmap 	= myGmap.gmap3('get');
					var center 	= comparablesmap.getCenter();
					google.maps.event.trigger(comparablesmap, 'resize');
					comparablesmap.setCenter(center );
					comparablesmap.setZoom(comparablesmap.getZoom());
					comparablesmap.panToBounds(comparablesmap.getBounds());
				} else {
					jQuery('.rec-epl-property-map').hide();
					jQuery('.rec-epl-property-grid').show();

				}
			});

		});
	</script>
<?php
}
add_action('wp_head','rec_epl_style_script');
function rec_archive_map_callback() {
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
			$post_type = $post->post_type;
		else if ($post->post_type == 'suburb')
			$post_type = $post->post_type;
		else
			$post_type = '';
		?>
		<?php echo do_shortcode("[advanced_map post_type=$post_type display=simple zoom=13 height=800]"); ?>




	</div>
<?php
}
add_action( 'rec_archive_map' , 'rec_archive_map_callback' );

// Floor Plan
remove_action('epl_buttons_single_property', 'epl_button_floor_plan');

function rec_epl_button_floor_plan() {
	$floor_plan		= get_post_meta( get_the_ID() , 'property_floorplan' , true );
	$floor_plan_2	= get_post_meta( get_the_ID() , 'property_floorplan_2' , true );

	$links = array();
	if(!empty($floor_plan)) {
		$links[] = $floor_plan;
	}
	if(!empty($floor_plan_2)) {
		$links[] = $floor_plan_2;
	}
	if ( !empty($links) ) {
		foreach ( $links as $k=>$link ) {
			if(!empty($link)) {
				$number_string = '';
				if($k > 0) {
					$number_string = ' ' . $k + 1;
				}
				?>
				<span class="epl-floor-plan-button-wrapper<?php echo $number_string; ?>">
				<a title="Floor Plan" href="<?php echo $link; ?>" class="fancybox image epl-button epl-floor-plan">ICON</a>
				</span>
				<?php
			}
		}
	}
}
add_action('epl_buttons_single_property', 'rec_epl_button_floor_plan');

function rec_epl_author_widget_before_title_callback() {

	global $epl_author;
?>
	<div class="soc-ic">
		<?php
			$social_icons = array('facebook','twitter','google','linkedin','skype');
			foreach($social_icons as $social_icon){
				echo call_user_func(array($epl_author,'get_'.$social_icon.'_html'));
			}
		?>
	</div>
<?php
}
add_action( 'epl_author_widget_before_title' , 'rec_epl_author_widget_before_title_callback' );

function rec_epl_display_author_social_icons_callback() {
	if ( is_singular() ) {
		$email = array('email');
		return $email;
	}
}
add_filter( 'epl_display_author_social_icons' , 'rec_epl_display_author_social_icons_callback' );


function my_epl_listing_search_price_sale_range() {
    // Check to make sure Easy Property Listings is active
    // so that the epl_currency_formatted_amount function works
    if ( ! class_exists( 'Easy_Property_Listings' ) ) {
        return;
    }

    $prices_arr = array(
        100000    =>   epl_currency_formatted_amount(100000),
        150000    =>   epl_currency_formatted_amount(150000),
        250000    =>   epl_currency_formatted_amount(250000),
        300000    =>   epl_currency_formatted_amount(300000),
        350000    =>   epl_currency_formatted_amount(350000),
        400000    =>   epl_currency_formatted_amount(400000),
        450000    =>   epl_currency_formatted_amount(450000),
        500000    =>   epl_currency_formatted_amount(500000),
        550000    =>   epl_currency_formatted_amount(550000),
        600000    =>   epl_currency_formatted_amount(600000),
        650000    =>   epl_currency_formatted_amount(650000),
        700000    =>   epl_currency_formatted_amount(700000),
        750000    =>   epl_currency_formatted_amount(750000),
        800000    =>   epl_currency_formatted_amount(800000),
        850000    =>   epl_currency_formatted_amount(850000),
        900000    =>   epl_currency_formatted_amount(900000),
        950000    =>   epl_currency_formatted_amount(950000),
        1000000   =>   epl_currency_formatted_amount(1000000),
        1500000   =>   epl_currency_formatted_amount(1500000),
        10000000   =>   epl_currency_formatted_amount(10000000) . '+',

    );

    return $prices_arr;
}
add_filter( 'epl_listing_search_price_sale' , 'my_epl_listing_search_price_sale_range' );


function rec_epl_am_marker_icon() {

	$marker = get_stylesheet_directory_uri() . '/easypropertylistings/map/icon_property.png';
	return $marker;
}
add_filter( 'epl_am_marker_icon' , 'rec_epl_am_marker_icon' );

function rec_custom_range_bedrooms_min() {
    $range = array(
        '1'     =>   '1+',
        '2'     =>   '2+',
        '3'     =>   '3+',
        '4'     =>   '4+',
    );
    return $range;
}
add_filter( 'epl_listing_search_bed_select_min' , 'rec_custom_range_bedrooms_min' );

function rec_epl_populate_section_32_attachment($value) {

	$lu_pdf = '';

	if (function_exists('epl_lu_listing_unlimited_id') ) {
		$lu_post_id = epl_lu_listing_unlimited_id();

		$lu_pdf = get_post_meta( $lu_post_id , 'listing_unlimited_pdf' , true );

	}

	return $lu_pdf;
}
add_filter('gform_field_value_section_32', 'rec_epl_populate_section_32_attachment');


function rec_epl_populate_address($value) {

	$address = epl_property_get_the_full_address();

	return $address;
}
add_filter('gform_field_value_property_address', 'rec_epl_populate_address');

function rec_epl_populate_post_author_details($value) {
	global $post;

	$author_email 	= get_the_author_meta('user_email', $post->post_author);

	$author_vars = array(
		'name'	=>	'display_name',
		'phone'	=>	'mobile',
		'email'	=>	'user_email',
	);

	$string = '';
	if ( !empty($author_email) ) {
		foreach ( $author_vars as $type => $v ) {
			switch ( $type ) {
				case 'name';
				case 'phone';
					$prefix = '';
					$suffix = '%0A%0A';

					break;

				case 'email';
					$prefix = '<a href="mailto:' . $v . '">';
					$suffix = '</a>';

					break;
			}
			$string .= $prefix . get_the_author_meta( $v , $post->post_author) . $suffix;
		}
		return esc_attr ($string);
	}
	return;

}
//add_filter('gform_field_value_author_details', 'rec_epl_populate_post_author_details');

function rec_epl_populate_post_author_name($value) {
	global $post;
	$author_name = get_the_author_meta('display_name', $post->post_author);
	return $author_name;
}
add_filter('gform_field_value_author_name', 'rec_epl_populate_post_author_name');

function rec_epl_populate_post_author_phone($value) {
	global $post;
	$author_phone = get_the_author_meta('mobile', $post->post_author);
	return $author_phone;
}
add_filter('gform_field_value_author_phone', 'rec_epl_populate_post_author_phone');