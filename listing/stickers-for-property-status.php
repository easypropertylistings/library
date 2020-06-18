<?php
/**
 * Add custom sticker for property status.
 *
 */

/**
 * Add a sticker for for sale / for rent.
 */
function my_epl_property_stickers() {

	global $property;

	if ( 'property' === $property->post_type || 'land' === $property->post_type || 'rural' === $property->post_type || 'business' === $property->post_type ) {
		$price_sticker = '';
		if ( 'current' === $property->get_property_meta( 'property_status' ) ) {
			$price_sticker .= '<span class="status-sticker for-sale">For Sale</span>';
		}
		if ( 'yes' === $property->get_property_meta( 'property_under_offer' ) && 'sold' !== $property->get_property_meta( 'property_status' ) ) {
			$price_sticker  = '';
		}
	}

	if ( 'rental' === $property->post_type ) {
		$price_sticker = '';
		if ( 'current' === $property->get_property_meta( 'property_status' ) ) {
			$price_sticker .= '<span class="status-sticker for-rent">For Rent</span>';
		}
	}

	echo $price_sticker;

}
add_action( 'epl_property_stickers', 'my_epl_property_stickers' );