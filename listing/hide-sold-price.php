<?php
/**
 * Filter to hide the sold price
 *
 */
function my_epl_hide_sold_price( $price ) {

	global $property;

	if ( 'sold' === $property->get_property_meta('property_status') ) {
		$price = '<span class="page-price sold-status">' . $property->label_sold . '</span>';
	}
	return $price;
}
add_filter( 'epl_get_price' , 'my_epl_hide_sold_price' );