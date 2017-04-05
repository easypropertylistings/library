<?php


// Checkbox Output Function
function my_checkbox_options_callback( $key , $array , $title = 'Title' ) {
	global $property;

	if ( empty( $key ) )
		return;

	$options = $property->get_property_meta( $key );

	if( !empty( $options ) ) {
		echo '<h5 class="' . $key . '">' . $title . '</h5>';
		echo '<ul>';
		foreach( $options as $value ) {
			//$select[] = isset($array[$value]) ? $array[$value] : $value;
			$label = isset($array[$value]) ? $array[$value] : $value;
			echo '<li class="'.$value.'">'.$label.'</li>';
		}
		echo '</ul>';
	}
}