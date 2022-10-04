<?php
/**
 * Create a custom land icon
 *
 */

/**
 * Loop Icons
 *
 * @return $string
 */
function my_epl_property_icons( $icons ) {
	$defaults = array( 'bed', 'bath', 'parking', 'ac', 'pool', 'new_land' );
	return $icons;
}

/**
 * Add this filter to apply this icon set.
 *
 * @return $string
 */
add_filter( 'epl_get_property_icons', 'my_epl_property_icons' );


// property land icon
function my_get_property_new_land( $returntype = 'i' ) {
	
	if ( empty( $returntype ) ) {
		$returntype = 'i';
	}

	global $property;

	if( intval($property->get_property_meta('property_land_area')) != 0 ) {


		$property_land_area_unit = $property->get_property_meta('property_land_area_unit');

		if ( $property_land_area_unit == 'squareMeter' ) {
			$property_land_area_unit = __('sqm' , 'epl');
		}

		$land['l'] = '<li class="land-size">'. __('Land is', 'epl').' ' . $property->get_property_meta('property_land_area') .' '.$property_land_area_unit.'</li>';
		$land['i'] = '<span title="'.__('Land', 'epl').'" class="icon land"><span class="icon-value">' . $property->get_property_meta('property_land_area') .' '.$property_land_area_unit.'</span></span>';
		
		echo wp_kses_post( $land[$returntype] );
	}

}
add_action( 'epl_get_property_icon_new_land' , 'my_get_property_new_land' );
