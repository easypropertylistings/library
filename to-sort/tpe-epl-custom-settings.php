<?php
/*
 * Plugin Name: Easy Property Listings - Custom Settings
 * Plugin URL: https://easypropertylistings.com.au/
 * Description: Adds custom settings to Easy Property Listings
 * Version: 1.0.0
 * Author: Merv Barrett
 * Author URI: http://www.realestateconnected.com.au/
 */
// Add your functions to this plugin. Install and activate it on your website.



/****EPL******/
function epl_exchange_tpl_email_html() {
    $html = '<i class="fa fa-envelope" aria-hidden="true"></i>';
    return $html.__('Email me');
}
add_filter( 'epl_author_icon_email', 'epl_exchange_tpl_email_html');

function epl_exchange_tpl_search_widget_option_label_location() {
    $label = 'suburbs';
    return $label;
}
add_filter( 'epl_search_widget_option_label_location' , 'epl_exchange_tpl_search_widget_option_label_location' );

function epl_exchange_tpl_search_widget_option_label_price_from() {
    $label = 'min price';
    return $label;
}
add_filter( 'epl_search_widget_option_label_price_from' , 'epl_exchange_tpl_search_widget_option_label_price_from' );

function epl_exchange_tpl_search_widget_option_label_price_to() {
    $label = 'max price';
    return $label;
}
add_filter( 'epl_search_widget_option_label_price_to' , 'epl_exchange_tpl_search_widget_option_label_price_to' );

function epl_exchange_tpl_search_widget_option_label_bedrooms_min() {
    $label = 'min bedrooms';
    return $label;
}
add_filter( 'epl_search_widget_option_label_bedrooms_min' , 'epl_exchange_tpl_search_widget_option_label_bedrooms_min' );

function epl_exchange_tpl_search_widget_option_label_bedrooms_max() {
    $label = 'max bedrooms';
    return $label;
}
add_filter( 'epl_search_widget_option_label_bedrooms_max' , 'epl_exchange_tpl_search_widget_option_label_bedrooms_max' );

function epl_exchange_tpl_search_widget_option_label_bathrooms() {
    $label = 'bathrooms';
    return $label;
}
add_filter( 'epl_search_widget_option_label_bathrooms' , 'epl_exchange_tpl_search_widget_option_label_bathrooms' );

function epl_exchange_tpl_search_widget_option_label_carport() {
    $label = 'car spaces';
    return $label;
}
add_filter( 'epl_search_widget_option_label_carport' , 'epl_exchange_tpl_search_widget_option_label_carport' );

//Reorder Fields in Search Widget
function epl_exchange_tpl_reorder_search_widget_fields_frontend( $fields ) {
        foreach ($fields as &$field) {
            if ($field['key'] == 'search_price') {
                $field['order'] = 205;
            }
        }
        return $fields;
    }
add_filter( 'epl_search_widget_fields_frontend' , 'epl_exchange_tpl_reorder_search_widget_fields_frontend' );

function epl_exchange_tpl_inspection_format($inspection_date) {

    $formatted_date = '';
    $inspection_date = explode(' ',$inspection_date);

    $day       = isset($inspection_date[0]) ? $inspection_date[0] : '';
    $day       = str_replace(',','',$day);

    $date      = isset($inspection_date[1]) ? $inspection_date[1] : '';
    $remove    = array('st','nd','rd','th');
    $date      = str_replace($remove,'',$date);

    $month     =  isset($inspection_date[2]) ? $inspection_date[2]  : '';

    $time_start = isset($inspection_date[3]) ? $inspection_date[3] : '';
    $time_start .= ' '.$inspection_date[4];

    $time_end = isset($inspection_date[6]) ? $inspection_date[6] : '';
    $time_end .= ' '.$inspection_date[7];

    return "<th class='opentimes_date' colspan='6'><span>{$day} {$date} {$month}<span></th><tr class='opentimes_time'><td class='time_cell'><a class='epl_inspection_calendar' href='http://dev.realestateconnected.com.au/epl/extension-templates?epl_cal_dl=1&cal=ical&dt=MDUtTm92LTIwMTYgMDI6MDVQTSB0byAwNTowMFBN&propid=1104'><i class='fa fa-calendar' aria-hidden='true'></i></a> {$time_start} - {$time_end} </td>";
}
//add_filter('epl_inspection_format','epl_exchange_tpl_inspection_format',999);

function epl_exchange_tpl_fa() {
	wp_enqueue_style( 'exchange-font-awesome-min', get_stylesheet_directory_uri() . '/css/font-awesome.min.css' );
    wp_enqueue_style( 'exchange-font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.css' );
}
add_action( 'wp_enqueue_scripts', 'epl_exchange_tpl_fa' );

function epl_exchange_tpl_link_box () {

    if ( is_epl_post_single() && is_epl_rental_post()){
        $html = '<div class="epl-exchange-link-box">
                <a href="' . get_bloginfo( 'url' ) . '/rental/">
                    <i class="fa fa-caret-right"></i> Sales Stocklist
                </a>
                <a href="' . get_bloginfo( 'url' ) . '/for-rent/home-open/">
                    <i class="fa fa-caret-right"></i> Home Opens
                </a>
                <a href="' . get_bloginfo( 'url' ) . '/leased-listings/">
                    <i class="fa fa-caret-right"></i> Leased Listings
                </a>
            </div>';

    } else {
    $html = '<div class="epl-exchange-link-box">
                <a href="' . get_bloginfo( 'url' ) . '/property/">
                    <i class="fa fa-caret-right"></i> Sales Stocklist
                </a>
                <a href="' . get_bloginfo( 'url' ) . '/for-sale/home-open/">
                    <i class="fa fa-caret-right"></i> Home Opens
                </a>
                <a href="' . get_bloginfo( 'url' ) . '/recent-sales/">
                    <i class="fa fa-caret-right"></i> Recent Sales
                </a>
            </div>';
    }

    echo $html;

}
add_action( 'epl_single_extensions','epl_exchange_tpl_link_box', 8 );

function epl_exchange_tpl_lp_location_profiles_tab_left() {
    $arg_list = get_defined_vars();
	include( EPL_LP_PATH_TEMPLATES . 'location-profiles-template-meta.php' ); ?>
			<div class="epl-location-profiles-box">
				<?php global $location_profile_meta;
                    echo '<h3 class="epl-tab-title-disabled"><a href="' . get_the_permalink() . '">' . __( 'About ', 'epl-lp' ) . get_the_title() . '</a></h3>';
                echo '<div class="epl-location-profiles-excerpt">'. epl_get_the_excerpt() . '</div>'; ?>
			</div>
		</div>
<?php
}

function epl_exchange_tpl_lp_single_action() {


    if ( taxonomy_exists('location') && is_single() ) {
			global $post;
			$terms = '';

			$terms = get_the_terms( $post->ID, 'location' );
			if ($terms != '') {
				foreach($terms as $term) {
					$term->slug;
				}
			$query = new WP_Query( array (
				'post_type'		=>	'location_profile',
				'location'		=>	$term->slug,
				'posts_per_page'=>	'1'
			) );

			if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();

						epl_exchange_tpl_lp_location_profiles_tab_left();
					}
				}

			}

			wp_reset_postdata();

		}

}
//add_action('epl_single_extensions', 'epl_exchange_tpl_lp_single_action');

function epl_exchange_tpl_remove_lp_single_action(){
    remove_action( 'epl_single_extensions', 'epl_lp_single_action' );
}
add_action( 'wp', 'epl_exchange_tpl_remove_lp_single_action' );

//Social Share Shortcode
function epl_social_share() {

    $currenturl = get_permalink();

    $currenttitle = get_the_title();

    ob_start();
    echo '<span class="epl-social-share">
            <a class="epl-button epl-social-share-link epl-social-share-pin" href="http://pinterest.com/pin/create/button/?url='.$currenturl.'" target="_blank" title="'.__('Pinterest','epl').'">'.__('Pin','epl').'</a>
            <a class="epl-button epl-social-share-link epl-social-share-twt" href="https://twitter.com/share?url='.$currenturl.'" target="_blank" title="'.__('Twitter','epl').'">'.__('Tweet','epl').'</a>
            <a class="epl-button epl-social-share-link epl-social-share-fb" href="https://www.facebook.com/sharer/sharer.php?u='.$currenturl.'" target="_blank"  title="'.__('Facebook','epl').'">'.__('Facebook','epl').'</a>
        </span>';
    return ob_get_clean();
}
add_shortcode('epl_social_share','epl_social_share');

function add_epl_social_share_buttons() {
    echo do_shortcode('[epl_social_share]');
}
add_action('epl_buttons_single_property','add_epl_social_share_buttons', 11);




function tpe_disable_author_social () {

	return array('email');

}
add_action( 'epl_display_author_social_icons' , 'tpe_disable_author_social' );


// Check for page slug
function tpe_get_page_title_for_slug( $page_slug ) {

	$page_path = 'neighbourhood-guide/' . $page_slug;

	$page = get_page_by_path( $page_path , OBJECT );

	if ( isset( $page ) )
		return true;
	else
		return false;
}


// Get Suburb Profile
function tpe_suburb_profile_checker() {

	$post_type = get_post_type();

	if ( is_singular( array('property','land','rental') ) ) {

		$suburb_name	=  sanitize_title_with_dashes ( strtolower ( tpe_get_suburb_profile_name() ) );

		$result = tpe_get_page_title_for_slug( $suburb_name );

		return $result;

	} else {

		return false;
	}
}

// Get suburb profile name
function tpe_get_suburb_profile_name() {
	global $property;

	$suburb_name	=  $property->get_suburb_profile();
	return $suburb_name;
}

// Get Suburb Profile
function tpe_suburb_profile_widget_callback() {

	if ( tpe_suburb_profile_checker() == true ) {


		$field 		= 'slug';
		$value 		= sanitize_title_with_dashes ( strtolower ( tpe_get_suburb_profile_name() ) );;
		$taxonomy 	= 'location';
		$output 	= '';
		$filter 	= '';

		$location = get_term_by( $field, $value, $taxonomy );

	?>
		<div class="subusb-desc">
			<h3><a href="<?php echo tpe_get_suburb_profile_url(); ?>">ABOUT <?php echo strtoupper( tpe_get_suburb_profile_name() ); ?></a></h3>

			<div class="content">
				<?php //tpe_the_suburb_profile_excerpt(); ?>


					<?php echo wpautop( $location->description ); ?>

				<?php //echo term_description( $term_id, $taxonomy ) ?>

				<p style="margin-bottom:0"><a href="<?php echo tpe_get_suburb_profile_url(); ?>">See More</a></p>
		       </div>
		</div>


	<?php
	}
}
add_action( 'epl_single_extensions' , 'tpe_suburb_profile_widget_callback' );


// Get suburb profile URL
function tpe_get_suburb_profile_url() {

	$suburb_name	=  strtolower ( tpe_get_suburb_profile_name() );

	$suburb_name_dashed = sanitize_title_with_dashes ( $suburb_name );

	$neighbourhood_url = get_bloginfo( 'url' ) . '/neighbourhood-guide/' . $suburb_name_dashed;

	return $neighbourhood_url;

}


function tpe_the_suburb_profile_excerpt() {

	$suburb_name	=  sanitize_title_with_dashes ( strtolower ( tpe_get_suburb_profile_name() ) );

	$suburb_id 	= tpe_get_id_by_slug( $suburb_name );

	//echo $suburb_id;

	$post = get_post( $suburb_id );

	//print_r ($post);

	echo $post->post_excerpt;


}

function tpe_get_id_by_slug( $page_slug ) {

	$page_path = 'neighbourhood-guide/' . $page_slug;

	$page = get_page_by_path( $page_path  );

	if ( $page ) {
		return $page->ID;
	} else {
		return null;
	}
}


// Footer Info
function tpe_listing_footer_callback() {

	if ( tpe_suburb_profile_checker() == true ) {


		?>
			<div class="movehere">

				<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('.theme-content > .widget.realty_widget_enquiries_form').appendTo('.movehere .movehere_wrap');
				});
				</script>

				<div class="movehere_wrap">
					<section id="realty_widget_enquiries_form" class="widget realty_widget_enquiries_form">
						<div class="thinking-suburb">
							<div class="thinking-suburb-wrap">
								<a href="<?php echo tpe_get_suburb_profile_url(); ?>">
									<span>THINKING OF LIVING IN <?php echo strtoupper( tpe_get_suburb_profile_name() ); ?>?</span>Checkout out our neighbourhood guide to find out if it's the right place for you.</a><span class="arrow_"><i class="fa fa-chevron-right"></i></span>

							</div>
						</div>

						<div class="enquiry-form">
							<div class="enquiry-form-wrap">
								<p class="title">enquiries</p>


								<div id="return">

									<?php
									$contact_shortcode = '[contact-form-7 id="7024" title="Listing Enquiry"]';

									echo do_shortcode( $contact_shortcode ); ?>

								</div>
								<div class="clear"></div>
							</div>
						</div>


					</section>
				</div>
			</div>
		<?php


	}


}
add_action( 'tpe_listing_footer' , 'tpe_listing_footer_callback' );

function tpe_author_fixed_number($html,$epl_author) {

    if(empty($epl_author)) {
        global $epl_author;
    }

    $permalink  = apply_filters('epl_author_profile_link', get_author_posts_url($epl_author->author_id) , $epl_author);
    $author_title   = apply_filters('epl_author_profile_title',get_the_author_meta( 'display_name',$epl_author->author_id ) ,$epl_author );
    ob_start(); ?>
    <div class="epl-author-contact-details author-contact-details">

		<h5 class="epl-author-title author-title">
			<a href="<?php echo $permalink ?>">
				<?php echo $author_title;  ?>
			</a>
		</h5>
		<div class="epl-author-position author-position">
			<span class="label-position"></span>
			<span class="position"><?php echo $epl_author->get_author_position() ?></span>
		</div>

		<div class="epl-author-contact author-contact">
            <span class="label-fixed-number"></span>
            <span class="fixed-number"><?php echo __('08 9388 3988','epl'); ?></span>
            <span class="label-mobile"></span>
            <span class="mobile"><?php echo $epl_author->get_author_mobile(); ?></span>
        </div>
	</div>
	<div class="epl-author-slogan author-slogan"><?php echo $epl_author->get_author_slogan() ?></div>
	<div class="epl-clearfix"></div>
	<div class="epl-author-social-buttons author-social-buttons">
		<?php
			$social_icons = apply_filters('epl_display_author_social_icons',array('email','facebook','twitter','google','linkedin','skype'));
			foreach($social_icons as $social_icon){
				echo call_user_func(array($epl_author,'get_'.$social_icon.'_html'));
			}
		?>
	</div>

 <?php
    return ob_get_clean();
}
add_filter('epl_author_tab_author_id_callback','tpe_author_fixed_number', 10, 2);




// Price after under offer
function tpe_under_offer_price( $price ) {

	global $property;

	if ( 'property' == $property->post_type || 'land' == $property->post_type ) {

		if ( $property->get_property_meta('property_under_offer') == 'yes' && $property->get_property_meta('property_status') != 'sold') {


			if ( '' != $property->get_property_price_display() && 'yes' == $property->get_property_meta('property_price_display') ) {	// Property
				$price = ' <span class="page-price">'. $property->get_property_price_display() . '</span>';
			}
			elseif ( $property->get_property_meta('property_authority') == 'auction' && 'no' == $property->get_property_meta('property_price_display') ) {	// Auction
				$price = ' <span class="page-price auction">' . apply_filters('epl_get_property_auction_label', __( 'Auction' , 'easy-property-listings' ) ) . ' ' . $this->get_property_auction() . '</span>';
			}
			else {
				$price_plain_value_poa = __( 'POA' , 'easy-property-listings' );
				if(!empty($property->epl_settings) && isset($property->epl_settings['label_poa'])) {
					$price_plain_value_poa = $property->epl_settings['label_poa'];
				}
				$price = ' <span class="page-price">' . $price_plain_value_poa . '</span>';
			}

			return $price;
		} elseif ( $property->get_property_meta('property_status') == 'sold' && is_page('1743') ) {


			$price = '<div class="price-sold-wrapper">';


			$list_date	= $property->get_property_meta('property_list_date');
			$sold_price	= $property->get_property_meta('property_sold_price');
			$sold_date	= $property->get_property_meta('property_sold_date');

			//$list_date_calc = strtotime( $list_date );

			//$sold_date_calc = strtotime( $sold_date );
			//$sold_dom = $list_date_calc - $sold_date_calc;


			$format_sold_date = date("d/m/Y", strtotime( $sold_date ));


			$sold_display	= $property->get_property_meta('property_sold_price_display');


				if ( isset( $list_date ) ) {
					$price .= '<div class="price-sold-date">Date Sold : ' . $format_sold_date . '</div>';
				}

				//$price .= '<div class="price-sold-dom">Days on Market : ' . $sold_dom . ' days</div>';

				if ( isset( $sold_price ) &&  $sold_display == 'yes' ) {
					$price .= '<div class="price-sold-price">Sold Price : ' . epl_currency_formatted_amount( $sold_price ) . '</div>';
				}

			$price .= '</div>';

			return $price;


		} else {
			return $price;
		}
	}

	return $price;


}
add_filter( 'epl_get_price' , 'tpe_under_offer_price' );



function tpe_listing_page_search() { ?>

	 <div class="epl-exchange-search-container">
            <div class="epl-exchange-search">
                <?php echo do_shortcode('[listing_search post_type="property,rental" property_status="current" style="wide" search_house_category="off" search_car="on" search_other="off"]') ?>
            </div>
        </div>
<?php
}
//add_action( 'mk_page_before_content' ,'tpe_listing_page_search' );

function tpe_author_tab_image_size($default_image,$epl_author) {

    $size = get_avatar($epl_author->email , '300');

    return $size;
}
add_filter('epl_author_tab_image','tpe_author_tab_image_size',10,2);



// REmove brochure beds baths
remove_all_actions('epl_br_property_icons');

// Email Friend
function tpe_epl_custom_email_friend_button_callback() { ?>
    <div class="epl-button button-email-friend">
        <a class="" href="mailto:?subject=<?php the_title(); ?>&body=Hi, this email has been sent to by your friend from <?php the_permalink() ?>">Email a Friend</a>
    </div>
<?php
}
add_action('epl_buttons_single_property', 'tpe_epl_custom_email_friend_button_callback');


// Order Property
function tpe_epl_listing_sort_suburb( $query ) {
	// Do nothing if in dashboard or not an archive page
	if ( is_admin() || ! $query->is_main_query() || is_search() )
		return;

	// Do nothing if Easy Property Listings is not active
	if ( ! function_exists( 'epl_all_post_types' ) )
		return;

	if( !in_array('property',(array) $query->query_vars['post_type']))
		return;

	// The query to only show 'current' listings
	$meta_query = array(

		'property_status'	=>	array(
			'key'		=> 'property_status',
			'value'		=> 'current',
			'compare'	=> '==',
		),
		'property_price'	=>	array(
			'key'		=> 'property_price',
			'value'		=> '0',
			'type'		=>	'NUMERIC',
			'compare'	=> '>=',
		),
	);

	// Sort EPL listings by price on archive page
	if ( is_post_type_archive( epl_all_post_types() == 'true' ) ) {
		$query->set( 'post_type', array( 'property', 'land' ) );
		$query->set( 'meta_key', 'property_address_suburb' );
		$query->set( 'posts_per_page' , 99 ); // Adjust the quantity
		$query->set( 'meta_query',$meta_query);
		$query->set( 'orderby', array(
	                'meta_value' 		=> 'ASC',
	                'property_price' 	=> 'DESC'
		)
        );

		return;
	}
}
add_action( 'pre_get_posts', 'tpe_epl_listing_sort_suburb' , 1  );

// Sort Sold Listings
function tpe_sort_recent_sales( $query ) {

	// Do nothing if page is not recent sales page
	if ( is_admin() || $query->is_main_query() || is_search() || !is_page('recent-sales') )
		return;

	if( !in_array('property',(array) $query->query_vars['post_type']))
		return;

	// Do nothing if Easy Property Listings is not active
	if ( ! function_exists( 'epl_all_post_types' ) )
		return;

	$meta_query = array(

		'property_sold_date'	=>	array(
			'key'		=> 'property_sold_date',
			'value'		=> '',
			'type'		=>	'DATE',
			'compare'	=> '!=',
		),
	);

	$query->set( 'posts_per_page' , 99 ); // Adjust the quantity
	$query->set('meta_query',$meta_query);
	$query->set( 'orderby',
				array(
	                'property_sold_date' 	=> 'DESC'
				)
    		);
}
add_action( 'pre_get_posts', 'tpe_sort_recent_sales' , 1  );

// Order Rentals
function tpe_epl_listing_sort_rental_suburb( $query ) {
	// Do nothing if in dashboard or not an archive page
	if ( is_admin() || ! $query->is_main_query() || is_search() )
		return;

	// Do nothing if Easy Property Listings is not active
	if ( ! function_exists( 'epl_all_post_types' ) )
		return;

	if( !in_array('rental',(array) $query->query_vars['post_type']))
		return;

	// The query to only show 'current' listings
	$meta_query = array(

		'property_status'	=>	array(
			'key'		=> 'property_status',
			'value'		=> 'current',
			'compare'	=> '==',
		),
		'property_price'	=>	array(
			'key'		=> 'property_rent',
			'value'		=> '0',
			'type'		=>	'NUMERIC',
			'compare'	=> '>',
		),
	);

	// Sort EPL listings by price on archive page
	if ( is_post_type_archive( epl_all_post_types() == 'true' ) ) {
		$query->set( 'meta_key', 'property_address_suburb' );
		$query->set( 'posts_per_page' , 99 ); // Adjust the quantity
		$query->set('meta_query',$meta_query);
		$query->set( 'orderby', array(
	                'meta_value' 		=> 'ASC',
	                'property_price' 	=> 'DESC'
		)
        );

		return;
	}
}
add_action( 'pre_get_posts', 'tpe_epl_listing_sort_rental_suburb' , 1  );


// Sort Rental Opens Listings
function tpe_sort_rental_opens( $query ) {

	// Do nothing if in dashboard or not an archive page
	if ( is_admin() || $query->is_main_query() || is_search()  || !is_page( 2483 ) )
		return;

	// Do nothing if Easy Property Listings is not active
	if ( ! function_exists( 'epl_all_post_types' ) )
		return;

	if( !in_array('rental',(array) $query->query_vars['post_type']))
		return;

	// The query to only show 'current' listings
	$meta_query = array(
		'property_status'	=>	array(
			'key'		=> 'property_status',
			'value'		=> 'current',
			'compare'	=> '==',
		),
		'suburb'	=>	array(
			'key'		=> 'property_address_suburb',
			'value'		=> '',
			'compare'	=> '!=',
		),
		'property_price'	=>	array(
			'key'		=> 'property_rent',
			'value'		=> '0',
			'type'		=>	'NUMERIC',
			'compare'	=> '>',
		),
	);

	// Sort EPL listings by price on archive page
	$query->set( 'posts_per_page' , 99 ); // Adjust the quantity
	$query->set('meta_query',$meta_query);
	$query->set( 'orderby', array(
                'suburb' 			=> 'ASC',
                'property_price' 	=> 'DESC'
	)
    );

}
add_action( 'pre_get_posts', 'tpe_sort_rental_opens' , 1  );

// Sort Leased Listings
function tpe_sort_rental_leased( $query ) {

	// Do nothing if in dashboard or not an archive page
	if ( is_admin() || $query->is_main_query() || is_search()  || ! is_page( array(7999,8106) ) )
		return;



	// Do nothing if Easy Property Listings is not active
	if ( ! function_exists( 'epl_all_post_types' ) )
		return;

	if( !in_array('rental',(array) $query->query_vars['post_type']))
		return;

	// The query to only show 'current' listings
	$meta_query = array(
		'property_status'	=>	array(
			'key'		=> 'property_status',
			'value'		=> 'leased',
			'compare'	=> '==',
		),
		'suburb'	=>	array(
			'key'		=> 'property_address_suburb',
			'value'		=> '',
			'compare'	=> '!=',
		),
		'property_price'	=>	array(
			'key'		=> 'property_rent',
			'value'		=> '0',
			'type'		=>	'NUMERIC',
			'compare'	=> '>',
		),
	);

	// Sort EPL listings by price on archive page
	$query->set( 'posts_per_page' , 99 ); // Adjust the quantity
	$query->set('meta_query',$meta_query);
	$query->set( 'orderby', array(
                'suburb' 			=> 'ASC',
                'property_price' 	=> 'DESC'
	)
    );

}
add_action( 'pre_get_posts', 'tpe_sort_rental_leased' , 1  );


// Leased No Street Number
function tpe_get_formatted_property_address() {
	global $property;

	//$street =  $property->get_property_meta('property_address_lot_number').' ';

	//if($property->get_property_meta('property_address_sub_number') != '')
	//	$street .= $property->get_property_meta('property_address_sub_number').'/';

	//$street .= $this->get_property_meta('property_address_street_number').' ';
	$street .= $property->get_property_meta('property_address_street').' ';
	//$street .=$this->get_property_meta('property_address_suburb');
	return $street;
}

// Single Listing Leased Title
function tpe_epl_property_the_address_leased() {
	$epl_property_address_seperator	= apply_filters('epl_property_address_seperator',',');
	global $property,$epl_settings;
	?>
	<?php if ( $property->get_property_meta('property_address_display') == 'yes' ) { ?>
		<span class="item-street"><?php echo tpe_get_formatted_property_address(); ?></span>
	<?php } ?>
	<span class="entry-title-sub">
		<?php
			if( $property->get_property_meta('property_com_display_suburb') != 'no' || $property->get_property_meta('property_address_display') == 'yes' ) { ?>
				<span class="item-suburb"><?php echo $property->get_property_meta('property_address_suburb'); ?></span><?php
				if ( strlen( trim( $property->get_property_meta( 'property_address_suburb' ) ) ) ) {
					echo '<span class="item-seperator">' . $epl_property_address_seperator . '</span>';
				}
			}
		?>
		<?php
			if( $property->get_epl_settings('epl_enable_city_field') == 'yes' ) { ?>
				<span class="item-city"><?php echo $property->get_property_meta('property_address_city'); ?></span><?php
			}
		?>
		<span class="item-state"><?php echo $property->get_property_meta('property_address_state'); ?></span>
		<span class="item-pcode"><?php echo $property->get_property_meta('property_address_postal_code'); ?></span>
		<?php
			if( $property->get_epl_settings('epl_enable_country_field') == 'yes' ) { ?>
				<span class="item-country"><?php echo $property->get_property_meta('property_address_country'); ?></span><?php
			}
		?>
	</span><?php
}


// Remove default video output
remove_action('epl_property_content_after','epl_property_video_callback');

// Video Button
function tpe_epl_custom_video_button_callback() {


	global $property;

	$video_url	= $property->get_property_meta('property_video_url');

	if ( $video_url != '') { ?>

	<div class="epl-button button-video">
       		 <a class="fancybox-youtube" href="<?php echo $video_url; ?>">Video</a>
	</div>

	<?php }

}
add_action('epl_buttons_single_property', 'tpe_epl_custom_video_button_callback' , 5 );
