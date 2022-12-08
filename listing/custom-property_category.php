<?php
/**
 * Modify and then render using a custom functio the label of the category.
 *
 */

/**
 * Modify the default property_category options
 *
 * @param array $array Array of default property_category values.
 *
 * @return void  Array of new categories.
 */
function my_custom_categories($array) {
	$array = array(
		'House'                 => __('Aan een drukke weg', 'epl'), // TESTER
		'near-busy_road'        => __('Aan een drukke weg', 'epl'),
		'near-quiet-road'       => __('Aan een rustige weg', 'epl'),
		'near-park'             => __('Aan een park', 'epl'),
		'near-water'            => __('Aan water', 'epl'),
		'near-waterway'         => __('Aan vaarwater', 'epl'),
		'near-forest'           => __('Aan bosrand', 'epl'),
		'sheltered'             => __('Beschut gelegen', 'epl'),
		'downtown'              => __('In het centrum', 'epl'),
		'wooded-area'           => __('In een bosrijke omgeving', 'epl'),
		'residential-area'      => __('In een woonwijk', 'epl'),
		'near-school'           => __('Nabij een school', 'epl'),
		'near-public-transport' => __('Nabij het openbaar vervoer', 'epl'),
		'unobstructed-view'     => __('Vrij uitzicht', 'epl'),
	);
	return $array;
}
add_filter( 'epl_listing_meta_property_category', 'my_custom_categories' );

/**
 * Test function to display the category
 *
 * @return void 
 */
function some_function() {
	global $property;
	
	$category = $property->get_property_meta( 'property_category' );
	
	$label = epl_listing_meta_property_category_value( $category );
	
	echo '<br>' . $label;
}
add_action( 'epl_property_price', 'some_function' );
