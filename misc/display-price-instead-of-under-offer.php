<?php
/**
 * Display the price instead of Under Offer
 *
 */

function my_epl_get_price_under_offer_custom( $price ) {
	global $property;
	if ( 'yes' == $property->get_property_meta('property_under_offer') && 'sold' != $property->get_property_meta('property_status') ) { // Under Offer

		if ( '' != $property->get_property_price_display() && 'yes' == $property->get_property_meta('property_price_display') ) {
			$price = '<span class="page-price">'. $property->get_property_price_display() . '</span>';

		}
	}
	return $price;
}
add_filter( 'epl_get_price' , 'my_epl_get_price_under_offer_custom' );