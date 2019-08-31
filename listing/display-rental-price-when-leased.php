<?php
/**
 * Filter to display the rental price when a listing is leased.
 *
 */

// Display the rental price even if listing is leased.
function rec_display_let_price( $price ) {

	global $property;

	$prop_rent       = $property->get_property_rent();
	$prop_rent_view  = $property->get_property_meta( 'property_rent_view' );

	if ( 'rental' === $property->post_type ) {

		if ( ! empty( $prop_rent ) && 'yes' === $property->get_property_meta( 'property_rent_display' ) && 'leased' === $property->get_property_meta( 'property_status' ) ) {

			$epl_property_price_rent_separator = apply_filters( 'epl_property_price_rent_separator', '/' );
			$price  = '<span class="page-price-rent">';
			$price .= '<span class="page-price" style="margin-right:0;">' . $property->get_property_rent() . '</span>';
			if ( empty( $prop_rent_view ) ) {
				$price .= '<span class="rent-period">' . $epl_property_price_rent_separator . '' . ucfirst( $property->get_property_meta( 'property_rent_period' ) ) . '</span>';
			}
			$price    .= '</span>';
			$prop_bond = $property->get_property_bond();
			if ( ! empty( $prop_bond ) && in_array( $property->get_epl_settings( 'display_bond' ), array( 1, 'yes' ) ) ) { // phpcs:ignore
				$price .= '<span class="bond">' . $property->get_property_bond() . '</span>';
			}


			return '<span class="page-price sold-status">' . $property->label_leased . '</span>' . $price;
		}
		return $price;

	}
	return $price;

}
add_filter( 'epl_get_price' , 'rec_display_let_price' );