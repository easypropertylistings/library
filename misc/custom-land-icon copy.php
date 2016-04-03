<?php
/**
 * Create a custom land icon
 *
 */

// Disable default icon output
remove_action('epl_property_icons','epl_property_icons');

// property land icon
function rec_get_property_land_value($returntype = 'i') {

	global $property;

	if(intval($property->get_property_meta('property_land_area')) != 0 ) {


		$property_land_area_unit = $property->get_property_meta('property_land_area_unit');

		if ( $property_land_area_unit == 'squareMeter' ) {
			$property_land_area_unit = __('sqm' , 'epl');
		}

		$land['l'] = '<li class="land-size">'. __('Land is', 'epl').' ' . $property->get_property_meta('property_land_area') .' '.$property_land_area_unit.'</li>';
		$land['i'] = '<span title="'.__('Land', 'epl').'" class="icon land"><span class="icon-value">' . $property->get_property_meta('property_land_area') .' '.$property_land_area_unit.'</span></span>';
		return $land[$returntype];
	}

}

// Custom epl_property_icons function including land icon
function rec_epl_property_icons() {
	global $property;
		echo $property->get_property_bed( ).
			$property->get_property_bath().
			$property->get_property_parking().
			$property->get_property_air_conditioning().
			$property->get_property_pool().

			rec_get_property_land_value();
}
add_action( 'epl_property_icons' , 'rec_epl_property_icons' );