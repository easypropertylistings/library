<?php
/**
 * Create a custom land icon
 *
 */

/**
 * Add new_land to Icons using epl_get_property_icons filter.
 *
 * @return string $icons
 */
function my_epl_property_icons( $icons ) {
	$defaults = array( 'bed', 'bath', 'parking', 'ac', 'pool', 'new_land' );
	return $icons;
}

/**
 * Add this filter to apply this icon set using epl_get_property_icons filter.
 *
 * @return $string
 */
add_filter( 'epl_get_property_icons', 'my_epl_property_icons' );


/**
 * Register new_land icon type hook to the dynamic epl_get_property_icon_NEW_HOOK_NAME_EG_new_land
 *
 * @param string $returntype Icon type.
 *
 * @return void  Echo the icon.
 */
function my_get_property_new_land( $returntype = 'i' ) {
	
	if ( empty( $returntype ) ) {
		$returntype = 'i';
	}

	global $property;

	if( 0 !== intval( $property->get_property_meta( 'property_land_area') ) ) {

		$property_land_area_unit = $property->get_property_meta( 'property_land_area_unit' );

		if ( $property_land_area_unit == 'squareMeter' ) {
			$property_land_area_unit = __('sqm' , 'epl');
		}

		$land['l'] = '<li class="land-size">'. __('Land is', 'epl').' ' . $property->get_property_meta('property_land_area') .' '.$property_land_area_unit.'</li>';
		$land['i'] = '<span title="'.__('Land', 'epl').'" class="icon land"><span class="icon-value">' . $property->get_property_meta('property_land_area') .' '.$property_land_area_unit.'</span></span>';
		
		echo wp_kses_post( $land[$returntype] );
	}

}
add_action( 'epl_get_property_icon_new_land' , 'my_get_property_new_land' );
