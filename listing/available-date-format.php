<?php
/**
 * Change available date format. Date format is is using PHP date formatting function https://www.php.net/manual/en/datetime.format.php
 *
 */

/**
 * Change available/availability date format.
 */
function my_epl_property_available_date_format( $date_format ) {
	$date_format = 'l j F';
	return $date_format;
}
add_filter( 'epl_property_available_date_format', 'my_epl_property_available_date_format' );
