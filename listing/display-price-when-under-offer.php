<?php
/**
 * Filter to display the price when a listing is under offer
 *
 */

function my_epl_return_price_with_under_offer( $price ) {

	global $property;

	if ( 'yes' == $property->get_property_meta('property_under_offer') && 'sold' != $property->get_property_meta('property_status') ) {
		$price = $property->get_property_price_display();
		$price = '<span class="page-price under-offer-status">'.$property->label_under_offer .  ' ' . $price .    '</span>';
	}
	return $price;
}
add_filter( 'epl_get_price' , 'my_epl_return_price_with_under_offer' );