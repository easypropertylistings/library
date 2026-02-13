<?php
/**
 * Create a custom land icon
 *
 */

/**
 * Add new_land to Icons using epl_get_property_icons filter.
 *
 * @param array $icons
 * @return array
 */
function my_epl_property_icons_add_land( $icons ) {

	// Prevent duplicates.
	if ( ! in_array( 'new_land', $icons, true ) ) {
		$icons[] = 'new_land';
	}

	return $icons;
}
add_filter( 'epl_get_property_icons', 'my_epl_property_icons_add_land' );


/**
 * Register new_land icon type hook to the dynamic epl_get_property_icon_NEW_HOOK_NAME_EG_new_land
 *
 * @param string $returntype Icon type.
 *
 * @return void  Echo the icon. 
*/
function my_get_property_new_land( $returntype = 'i' ) {
	
	global $property;

	if ( empty( $returntype ) ) {
		$returntype = 'i';
	}

	$property_land_area = $property->get_property_meta( 'property_land_area' );

	if ( 0 !== intval( $property_land_area ) ) {
		
		// Decimal.
		if ( fmod( floatval( $property_land_area ), 1 ) !== 0.00 ) {
			$property_land_area_format = apply_filters( 'epl_property_land_area_format_decimal', number_format_i18n( $property_land_area, 2 ) );
		} else {
			// No decimal.
			$property_land_area_format = apply_filters( 'epl_property_land_area_format', number_format_i18n( $property_land_area ) );
		}

		$property_land_area_unit = $property->get_property_meta( 'property_land_area_unit' );

		if ( $property_land_area_unit == 'squareMeter' ) {
			$property_land_area_unit = __('sqm' , 'epl');
		}

		$land['l'] = '<li class="land-size">'. __('Land is', 'epl').' ' . $property_land_area_format .' '.$property_land_area_unit.'</li>';
		$land['i'] = '<span title="'.__('Land', 'epl').'" class="icon land"><span class="icon-value">' . $property_land_area_format .' '.$property_land_area_unit.'</span></span>';
		
		echo wp_kses_post( $land[$returntype] );
	}

}
add_action( 'epl_get_property_icon_new_land' , 'my_get_property_new_land' );
