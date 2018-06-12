<?php
/**
 * Add the building area to display beside icons
 *
 */

function my_building_size_to_icons() {

	global $property;


	$building_unit = $property->get_property_meta('property_building_area_unit');
	if ( $building_unit == 'squareMeter' ) {
		$building_unit = __('m&#178;' , 'easy-property-listings' );
	} else {
		// translation for building area unit
		$building_unit = __($building_unit , 'easy-property-listings' );
	}
	$building_unit = apply_filters( 'epl_property_building_area_unit_label' , $building_unit );
	if(intval($property->get_property_meta('property_building_area')) != 0 ) {

		$label = 'Building';

		$return = '
		<div class="epl-icon-svg-container epl-icon-container-building">'.$label.' ' . $property->get_property_meta('property_building_area') .' '.$building_unit. '</div>';

		echo $return;
	}

}
add_action( 'epl_property_icons' , 'my_building_size_to_icons' );