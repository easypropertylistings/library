<?php
/**
 * Add new listing icons
 *
 * @requires 3.2.3
 */

function my_epl_get_property_icons($icons) {


	$icon =  array('bath','bed'); // // show only bath and bed and in same order

	$icon =  array('bed'); // // show only bed

	$icon =  array('bed','energy'); // custom icon energy
	return $icon;
}
add_filter('epl_get_property_icons','my_epl_get_property_icons');

/**
 * callback for energy icon
 * @return [type] [description]
 */
function epl_get_property_icon_energy() {
	global $property;
	echo $property->get_property_energy_rating();
}

add_action('epl_get_property_icon_energy','epl_get_property_icon_energy');