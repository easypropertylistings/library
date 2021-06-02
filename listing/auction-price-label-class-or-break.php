<?php
/**
 * Change the Auction label in the price with a line break or pass a label class.
 *
 */

/**
 * Add a class and/or line break to the label auction.
 *
 */
function my_epl_get_property_auction_label( $label ) {
	return '<span class="auction-lable">Auction</span> <br>';
}
add_filter( 'epl_get_property_auction_label', 'my_epl_get_property_auction_label' );