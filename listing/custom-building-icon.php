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
	
	if ( empty( $returntype ) ) {
		$returntype = 'i';
	}

	global $property;

	if( 0 !== intval( $property->get_property_meta( 'property_building_area') ) ) {

		$property_building_area_unit = $property->get_property_meta( 'property_building_area_unit' );

		if ( $property_building_area_unit == 'squareMeter' ) {
			$property_building_area_unit = __('sqm' , 'epl');
		}

		$building['l'] = '<li class="building-size">'. __('building is', 'epl').' ' . $property->get_property_meta('property_building_area') .' '.$property_building_area_unit.'</li>';
		$building['i'] = '<span title="'.__('building', 'epl').'" class="icon building"><span class="icon-value">' . $property->get_property_meta('property_building_area') .' '.$property_building_area_unit.'</span></span>';
		
		echo wp_kses_post( $building[$returntype] );
	}

}
add_action( 'epl_get_property_icon_new_building' , 'my_get_property_new_building' );
