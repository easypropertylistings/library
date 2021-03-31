<?php
/**
 * Change custom fields to text from numbers.
 *
 * @see: https://github.com/easypropertylistings/Easy-Property-Listings/blob/master/lib/meta-boxes/meta-box-init.php
 */


/**
 * This function will allow you to change fields from number to text.
 *
 * Use this as an example to change existing custom fields options to whatever you require.
 *

 */
function my_epl_change_type( $field ) {
	$field['type'] = 'text';
	return $field;
}
add_filter( 'epl_meta_property_toilet', 'my_epl_change_type' );
add_filter( 'epl_meta_property_ensuite', 'my_epl_change_type' );
add_filter( 'epl_meta_property_garage', 'my_epl_change_type' );
add_filter( 'epl_meta_property_carport', 'my_epl_change_type' );
add_filter( 'epl_meta_property_rooms', 'my_epl_change_type' );
add_filter( 'epl_meta_property_open_spaces', 'my_epl_change_type' );
