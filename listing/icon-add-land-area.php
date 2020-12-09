<?php
/**
 * Add land area to icons.
 *
 */

// Register additional icons.
function my_add_additional_icons( $icons ) {

	// Add Lot Size to the default icons array.
	$icons[] = 'lot_size';

	return $icons;

}
add_filter( 'epl_get_property_icons', 'my_add_additional_icons' );


// Add Land Size
function my_epl_get_property_icon_lot_size() {

	global $property;

	$return = $property->get_property_land_value( 'i' );

	echo $return;

}
add_action( 'epl_get_property_icon_lot_size', 'my_epl_get_property_icon_lot_size' );