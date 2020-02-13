<?php
/**
 * Remove second email.
 *
 * @usage [import_remove_second_email({email[1]})]
 */
function import_remove_second_email( $email ) {

	$search_for_value = ',';

	// Confirm string has a comma/
	if ( strpos( $email, $search_for_value ) !== false ) {
		$tokens = explode( ',', $email );      // split string on ,
		array_pop( $tokens );                   // get rid of last element
		$email = implode( ':', $tokens );   // wrap back
	}
	return $email;
}