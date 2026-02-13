<?php
/**
 * Create a custom building icon
 *
 */

/**
 * Add new_building to Icons using epl_get_property_icons filter.
 *
 * @param array $icons
 * @return array
 */
function my_epl_property_icons_add_building( $icons ) {

	// Prevent duplicates
	if ( ! in_array( 'new_building', $icons, true ) ) {
		$icons[] = 'new_building';
	}

	return $icons;
}
add_filter( 'epl_get_property_icons', 'my_epl_property_icons_add_building' );

/**
 * Register new_building icon type hook to the dynamic epl_get_property_icon_NEW_HOOK_NAME_EG_new_building
 *
 * @param string $returntype Icon type.
 *
 * @return void  Echo the icon.
 */
function my_get_property_new_building( $returntype = 'i' ) {
	
	global $property;
	
	if ( empty( $returntype ) ) {
		$returntype = 'i';
	}
	
	$building_area = $property->get_property_meta( 'property_building_area' );


	if( 0 !== intval( $building_area ) ) {
		
		// Decimal.
		if ( fmod( floatval( $building_area ), 1 ) !== 0.00 ) {
			$building_area_format = apply_filters( 'epl_property_building_area_format_decimal', number_format_i18n( $building_area, 2 ) );
		} else {
			// No decimal.
			$building_area_format = apply_filters( 'epl_property_building_area_format', number_format_i18n( $building_area ) );
		}

		$property_building_area_unit = $property->get_property_meta( 'property_building_area_unit' );

		if ( $property_building_area_unit == 'squareMeter' ) {
			$property_building_area_unit = __('sqm' , 'epl');
		}

		$building['l'] = '<li class="building-size">'. __('building is', 'epl').' ' . $building_area_format .' '.$property_building_area_unit.'</li>';
		$building['i'] = '<span title="'.__('building', 'epl').'" class="icon building"><span class="icon-value">' . $building_area_format .' '.$property_building_area_unit.'</span></span>';
		
		echo wp_kses_post( $building[$returntype] );
	}

}
add_action( 'epl_get_property_icon_new_building' , 'my_get_property_new_building' );
