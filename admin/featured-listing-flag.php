<?php
/**
 * Add a Featured label in the dashboard to listings
 *
 */

function my_admin_featured_listings_flag() {

	$featured = get_property_meta('property_featured');

	if ($featured != 'yes' ) {

		$featured_label = 'Featured';
		echo '<div><span class="featured-flag" style="background: orange; padding: 0.1em 0.5em; border-radius: 3px; color: #fff;">' . $featured_label . '</span></div>';
	}

}

// Adjust the location of where you want to place the label
// Available hooks: https://github.com/easypropertylistings/Easy-Property-Listings/blob/master/lib/post-types/post-type-property.php
add_action( 'epl_manage_listing_column_listing_before' , 'my_admin_featured_listings_flag' ); // Hooked to Listing Details Column

