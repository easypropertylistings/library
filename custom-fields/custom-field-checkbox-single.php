<?php
/**
 * Add a new custom field section with a custom field. Also skip updating this record on import.
 */

/**
 * Add custom field section with checkbox single type field
 * @uses EPL Filter epl_listing_meta_boxes
 */
function mmh_add_meta_box_epl_listings_advanced_callback( $meta_fields ) {
	$custom_field = array(
		'id'		=>	'epl_property_rental_publishing',
		'label'		=>	__('Rental MMH Publishing', 'epl'), // Box header
		'post_type'	=>	array('property', 'rural', 'rental', 'land', 'commercial', 'commercial_land', 'business'), // Which listing types these will be attached to
		'context'	=>	'normal',
		'priority'	=>	'high',
		'groups'	=>	array(
			array(
				'id'		=>	'property_custom_data_section_1',
				'columns'	=>	'1', // One or two columns
				'label'		=>	'',
				'fields'	=>	array(
					array(
						'name'  =>	'property_mmh_publishing',
						'label' =>	__('MMH Publish', 'epl'),
						'type'  =>	'checkbox_single',
						'opts'  =>	array(
							'yes' => __('Yes', 'epl'),
						),
						'help' => 'Check this box if you want the property to show on the live website',
						'import' => 'preserve',
					),

				)
			)
		)
	);
	$meta_fields[] = $custom_field;
	return $meta_fields;
}
add_filter( 'epl_listing_meta_boxes' , 'mmh_add_meta_box_epl_listings_advanced_callback' );