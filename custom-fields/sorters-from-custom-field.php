<?php
/*
 * Plugin Name: Easy Property Listings - Custom Settings
 * Plugin URL: https://easypropertylistings.com.au/
 * Description: Adds filters to Easy Property Listings
 * Version: 1.0.0
 * Author: Merv Barrett
 * Author URI: http://www.realestateconnected.com.au
 */


/**
 * Add custom sleeps number field in house_features section
 * @uses EPL Filter epl_meta_groups_{group_id}
 */
function my_epl_add_sleeps_to_house_features_fields($group) {
	$group['fields'][] = array(
		'name'		=>	'property_sleeps',
		'label'		=>	__('Sleeps', 'easy-property-listings' ),
		'type'		=>	'number',
		'maxlength'	=>	'4'
	);
	return $group;
}
add_filter('epl_meta_groups_house_features', 'my_epl_add_sleeps_to_house_features_fields');



/**
 * Output Sleeps on Template
 * @uses EPL Filter epl_meta_groups_{group_id}
 */
function my_epl_output_sleeps_value() {

	global $property;

	$sleeps = get_property_meta( 'property_sleeps' );

	// Do not display if sleeps is empty
	if ( $sleeps != '' ) { ?>

		<div class="my-custom-sleeps-class">
			<span>This property sleeps: <?php echo $sleeps; ?></span>
		</div>

	<?php
	}

}
// Output Sleeps to the property icons template hook
add_action('epl_property_icons', 'my_epl_output_sleeps_value');



// Add custom sleeps field to sorter options
function my_epl_sleeps_custom_sorters($sorters) {

	$sorters[] = array(
			'id'	=>	'sleeps_high',
			'label'	=>	__('Sleeps: High to Low','easy-property-listings' ),
			'type'	=>	'meta',
			'key'	=>	'property_sleeps',
			'order'	=>	'DESC',
			'orderby'	=>	'meta_value_num',

	);

	$sorters[] = array(
			'id'	=>	'sleeps_low',
			'label'	=>	__('Sleeps: Low to High','easy-property-listings' ),
			'type'	=>	'meta',
			'key'	=>	'property_sleeps',
			'order'	=>	'ASC',
			'orderby'	=>	'meta_value_num',

		);

	return $sorters;
}
add_filter('epl_sorting_options','my_epl_sleeps_custom_sorters');