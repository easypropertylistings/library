<?php
/**
 * Replace all the front end icons with text results
 *
 */


// Only apply the following functions to the front end
if ( is_admin() )
	return;

// Bedrooms
function my_epl_custom_bed_icons_text( ) {

	global $property;

	if( $property->get_property_meta('property_bedrooms' , false ) == '' )
		return;

	$bed = '<div class="my-custom-icon-text">' . $property->get_property_meta('property_bedrooms') . ' Bed' . '</div>';

	return $bed;
}
add_filter( 'epl_get_property_bed' , 'my_epl_custom_bed_icons_text' , 1);

// Bathrooms
function my_epl_custom_bath_icons_text() {

	global $property;

	if( $property->get_property_meta('property_bathrooms' , false ) == '' )
		return;

	$bath = '<div class="my-custom-icon-text">' . $property->get_property_meta('property_bathrooms') . ' Bathrooms' . '</div>';

	return $bath;
}
add_filter( 'epl_get_property_bath' , 'my_epl_custom_bath_icons_text' , 1);

// Air Conditioning
function my_epl_custom_air_icons_text() {

	global $property;

	$property_air_conditioning = $property->get_property_meta('property_air_conditioning');
	if( isset($property_air_conditioning) && ($property_air_conditioning == 1 || $property_air_conditioning == 'yes') ) {
		$air = '<div class="my-custom-icon-text">Air Conditioning</div>';

		return $air;
	}
}
add_filter( 'epl_get_property_air_conditioning' , 'my_epl_custom_air_icons_text' , 1);

// Pool
function my_epl_custom_pool_icons_text() {

	global $property;

	$property_pool = $property->get_property_meta('property_pool');
	if( isset($property_pool) && ($property_pool == 1 || $property_pool == 'yes') ) {
		$pool = '<div class="my-custom-icon-text">Pool</div>';
		return $pool;
	}
}
add_filter( 'epl_get_property_pool' , 'my_epl_custom_pool_icons_text' , 1);

// Parking
function my_epl_custom_parking_icons_text() {

	global $property;

	if( $property->get_property_meta('property_garage') == '' && $property->get_property_meta('property_carport') == '' )
			return;

	$property_garage 	= intval($property->get_property_meta('property_garage'));
	$property_carport 	= intval($property->get_property_meta('property_carport'));
	$property_parking 	= $property_carport + $property_garage;

	if ( $property_parking == 0)
		return;

	$parking = '<div class="my-custom-icon-text">' . $property_parking . ' Parking Spaces' . '</div>';
	return $parking;

}
add_filter( 'epl_get_property_parking' , 'my_epl_custom_parking_icons_text' , 1);
