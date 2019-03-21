<?php
/*
 * Force empty display price to be yes
 *
 * Usage: [epl_reaxml_display_price({price[1]/@display})]
 */

function epl_reaxml_display_price ( $price ) {

	if ( $price == '' ) {
		return 'yes';
	} else {
		return $price;
	}
}