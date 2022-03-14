<?php
/**
 * Remove the unit option from Building and Land search.
 *
 * Customise the default building search to a single number field in the search widget/shortcode.
 *
 */
function my_epl_remove_building_unit( $fields ) {
	foreach ( $fields as $field_key => &$field ) {
		if ( in_array( $field['meta_key'], array( 'property_land_area_unit', 'property_building_area_unit' ) ) ) {
			unset( $fields[$field_key] );
		}
		
		/**
		 * This is required when removing the unit as that has the closing div.
		 */
		if ( in_array( $field['meta_key'], array( 'property_land_area_max', 'property_building_area_max' ) ) ) {
			$field['wrap_end'] = true; 
		}
	}
	return $fields;
}
add_filter( 'epl_search_widget_fields_frontend', 'my_epl_remove_building_unit' );
add_filter( 'epl_listing_search_commercial_widget_fields_frontend', 'my_epl_remove_building_unit' ); // Commercial Search Extension Filter.
