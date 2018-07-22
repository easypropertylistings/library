<?php
/**
 * How to add additional buttons and alter the order of the Switch (grid/list) and sorting
 *
 * @requires 3.2.3
 *
 */

// Add a new option to the left hand side of the switch/sorting options
function my_epl_button_to_the_left( $defaults ) {

	echo '<div class="test-wrapper-to-left" style="float: left;">';
	echo '<span>nifty to the left</span>';

	echo '</div>';

}
add_filter( 'epl_add_custom_menus' , 'my_epl_button_to_the_left' , 1 );

// Add a new option to the right aligned switch/sorting options and change the order
function my_new_switch_sorting_button( $defaults ) {

	$defaults = array(
		// Alter the order of the buttons
		'sorting_tool',
		'switch_views',
		'new_button',
	);

	return $defaults;

}
add_filter( 'epl_switch_views_sorting' , 'my_new_switch_sorting_button' );

// New button function
function my_epl_new_button() {

	echo '<span class="test-wrapper">';
	echo 'New Button';

	echo '</span>';

}
// Hooked to epl_switch_views_sorting_{filter_name} from epl_switch_views_sorting filter eg new_button
add_action( 'epl_switch_views_sorting_new_button' , 'my_epl_new_button' );