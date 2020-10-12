<?php
/**
 * Insert Frontage to appear before land area
 */

/**
 * Add select box field to the land details
 * @uses EPL Filter epl_meta_groups_{group_id}
 */
function my_epl_add_frontage_field( $group ) {
	$new_fields = array(
		'property_frontage'  =>   array(
			'name'      => 'property_frontage',
			'label'     => __( 'Frontage', 'easy-property-listings' ),
			'type'      => 'decimal',
			'maxlength' => '50',
			'width'     => '2-3',
		),
		'property_frontage_unit'    =>   array(
			'name'  => 'property_frontage_unit',
			'label' => __( 'Frontage Unit', 'easy-property-listings' ),
			'type'  => 'select',
			'opts'  => array(
				'metre' => __( 'Metre', 'easy-property-listings' ),
			),
			'width' => '3',
		)
	);
	$group['fields'] = $new_fields + $group['fields'];

	return $group;
}
add_filter( 'epl_meta_groups_land_details', 'my_epl_add_frontage_field' );
