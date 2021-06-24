<?php
/**
 * Adding to array exmaples
 *
 *
 */

/**
 * Add a new item to an existing array.
 *
 * Using epl_widget_listing_property_status asn an example in
 * https://github.com/easypropertylistings/Easy-Property-Listings/blob/master/lib/widgets/class-epl-widget-recent-property.php
 *
 */
function my_add_to_array( $existing_array ) {

	$existing_array['coming_soon'] = 'Coming Soon'; // Will add this to the END of the items in the array.

	return $existing_array;

}

/**
 * Add a new item to the beginning of an existing array.
 *
 * Using epl_widget_listing_property_status asn an example in
 * https://github.com/easypropertylistings/Easy-Property-Listings/blob/master/lib/widgets/class-epl-widget-recent-property.php
 *
 */
function my_add_to_array( $existing_array ) {

	$new_fields = [
		'coming_soon' => 'Coming Soon'
	];

	$existing_array = array_merge( $new_fields, $existing_array );

	return $existing_array;

}
