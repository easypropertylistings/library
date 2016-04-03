<?php


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
				<a href="<?php echo $link; ?>" class="fancybox image epl-button epl-floor-plan">ICON</a>
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









