<?php
/**
 * Replace all fields (ADVANCED usage) of the commercial listing type.
 *
 */

/**
 * Commercial Fields
 *
 */
function my_meta_group( $meta_fields ) {


	$opts_property_status              = epl_get_property_status_opts();
	$opts_property_authority           = epl_get_property_authority_opts();
	$opts_property_exclusivity         = epl_get_property_exclusivity_opts();
	$opts_property_com_authority       = epl_get_property_com_authority_opts();
	$opts_area_unit                    = epl_get_property_area_unit_opts();
	$opts_rent_period                  = epl_get_property_rent_period_opts();
	$opts_property_com_listing_type    = epl_get_property_com_listing_type_opts();
	$opts_property_com_tenancy         = epl_get_property_com_tenancy_opts();
	$opts_property_com_property_extent = epl_get_property_com_property_extent_opts();


	$sub_type_opts = [
		''                 => '-- Select --',
		'assisted_living'  => 'Assisted Living',
		'industrial_park'  => 'Industrial Park',
		'mobile_home_park' => 'Mobile Home Park',
		'multi_family'     => 'Multi Family',
	];


	$custom_field = array(
		'id'        => 'epl-property-listing-section-id', // Must use the same ID in order for it to be replaced.
		'label'     => __( 'Listing Details', 'easy-property-listings' ),
		'post_type' => array( 'commercial' ),  // Specify the post types that will be replaced.
		'context'   => 'normal',
		'priority'  => 'default',
		'groups'    => array(
			array(
				'id'      => 'property_heading',
				'columns' => '1',
				'label'   => '',
				'fields'  => array(
					array(
						'name'      => 'property_heading',
						'label'     => __( 'Custom Heading', 'easy-property-listings' ),
						'type'      => 'text',
						'maxlength' => '200',
						'class'     => 'epl-property-heading',
					),
				),
			),

			array(
				'id'      => 'display_details',
				'columns' => '2',
				'label'   => __( 'Display Details', 'easy-property-listings' ),
				'fields'  => array(


					array(
						'name'   => 'property_featured',
						'label'  => __( 'Featured Listing', 'easy-property-listings' ),
						'type'   => 'checkbox_single',
						'opts'   => array(
							'yes' => __( 'Yes', 'easy-property-listings' ),
						),
						'import' => 'preserve',
					),
				),
			),
		),
	);

	return $custom_field;

}





/**
 * Metaboxes filter
 *
 * Also allows use of importer add-on custom fields.
 *
 * @param array $meta_boxes Meta Boxes.
 *
 * @return mixed
 */
function my_commercial_metabox_filter( $meta_boxes ) {

	$commercial_metaboxes = my_new_meta_group( $meta_boxes );

	foreach ( $commercial_metaboxes as $key => $commercial_metabox ) {
		$meta_boxes[] = $commercial_metabox;
	}

	return $meta_boxes;

}
add_filter( 'epl_listing_meta_boxes', 'my_commercial_metabox_filter' );