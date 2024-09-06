<?php
/**
 * Add listing status classes to the body tag for listings.
 */

/**
 * Add Listing Status and Under Offer to Body Class
 *
 * Current:          epl-body-status-current
 * Under Offer:      epl-body-status-under-offer
 * Sold:             epl-body-status-sold
 * Leased:           epl-body-status-leased
 *
 * Commercial Sale:  epl-body-commercial-type-sale
 * Commercial Lease: epl-body-commercial-type-lease
 * Commercial Both:  epl-body-commercial-type-both
 *
 * @param      array $classes  The classes.
 *
 * @return     array
 *
 */
function my_epl_property_body_class_listing_status_callback( $classes ) {

	if ( is_epl_post() && is_single() ) {

		$property_status      = get_property_meta( 'property_status' );
		$property_under_offer = get_property_meta( 'property_under_offer' );
		$commercial_type      = get_property_meta( 'property_com_listing_type' );
		$class_prefix         = 'epl-body-status-';

		if ( ! empty( $property_status ) ) {
			$classes[] = $class_prefix . strtolower( $property_status );
		}
		if ( 'yes' === $property_under_offer && 'sold' !== $property_status ) {
			$classes[] = $class_prefix . 'under-offer';
		}
		if ( ! empty( $commercial_type ) ) {
			$class_prefix = 'epl-body-commercial-type-';
			$classes[]    = $class_prefix . strtolower( $commercial_type );
		}
	}

	return $classes;
}
add_filter( 'body_class', 'my_epl_property_body_class_listing_status_callback' );
