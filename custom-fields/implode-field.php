<?php


// Implode Example
function my_implode_array_callback( $key , $array , $title = 'Title' ) {
	global $property;

	$selected = array();
	if( !empty($selected) ) {
		echo '<ul><li>' . implode( '</li><li>', $selected) . '</li></ul>';
	}
}