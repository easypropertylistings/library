<?php
/**
 * Add more external links, floor plans or mini web to listings and custom buttons.
 *
 */

/**
 * Alter the default Custom Buttons Listing Tab options.
 */
function new_epl_custom_buttons_get_listing_buttons( $defaults ) {

	$defaults = array(
		'property_floorplan'          => __( 'Floor Plan', 'epl-custom-buttons' ),
		'property_floorplan_2'        => __( 'Floor Plan 2', 'epl-custom-buttons' ),
		'property_com_mini_web'       => __( 'Mini Website', 'epl-custom-buttons' ),
		'property_com_mini_web_2'     => __( 'Mini Website 2', 'epl-custom-buttons' ),
		'property_com_mini_web_3'     => __( 'Mini Website 3', 'epl-custom-buttons' ),
		'property_external_link'      => __( 'External Link', 'epl-custom-buttons' ),
		'property_external_link_2'    => __( 'External Link 2', 'epl-custom-buttons' ),
		'property_external_link_3'    => __( 'External Link 3', 'epl-custom-buttons' ),
		'property_external_link_4'    => __( 'External Link 4', 'epl-custom-buttons' ),
		'property_external_link_5'    => __( 'External Link 5', 'epl-custom-buttons' ),
		'property_external_link_6'    => __( 'External Link 6', 'epl-custom-buttons' ),
		'property_energy_certificate' => __( 'Energy Certificate', 'epl-custom-buttons' ),
	);

	return $defaults;

}
add_filter( 'epl_custom_buttons_get_listing_buttons', 'new_epl_custom_buttons_get_listing_buttons', 20 );

/**
 * Add custom url fields in files and links section.
 * @uses EPL Filter epl_meta_groups_{group_id}
 */
function my_epl_add_pricing_fields($group) {
	$group['fields'][] = array(
		'name'		=>	'property_external_link_4',
		'label'		=>	__('EX 4 Custom Field', 'easy-property-listings' ),
		'type'		=>	'url',
	);
	$group['fields'][] = array(
		'name'		=>	'property_external_link_5',
		'label'		=>	__('EX 5 Custom Field', 'easy-property-listings' ),
		'type'		=>	'url',
	);
	$group['fields'][] = array(
		'name'		=>	'property_external_link_6',
		'label'		=>	__('EX 6 Custom Field', 'easy-property-listings' ),
		'type'		=>	'url',
	);
	return $group;
}
add_filter('epl_meta_groups_files_n_links', 'my_epl_add_pricing_fields');