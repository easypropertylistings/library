<?php
/**
 * Allow the inspection times to display search for a word in this example "Appointment" and display the words.
 *
 */

// Override inspection Filter/
function rec_override_inspection_filter() {
	remove_action( 'epl_inspection_format', 'epl_inspection_format' );
	add_filter( 'epl_inspection_format', 'rec_filter_inspection_date' );
}
add_action( 'wp', 'rec_override_inspection_filter' );

// Replace inspection time filter to allow for "Open by Appointment"
function rec_filter_inspection_date( $inspection_date ) {
	if( ( strpos( $inspection_date, 'Appointment' ) !== 0 ) ) {
		return $inspection_date;
	}
	$formatted_date  = '';
	$inspection_date = explode( ' ', $inspection_date );
	$date_format = epl_get_inspection_date_format();
	$time_format = epl_get_inspection_time_format();
	$date       = isset( $inspection_date[0] ) ? date( $date_format, strtotime( $inspection_date[0] ) ) : '';
	$time_start = isset( $inspection_date[1] ) ? date( $time_format, strtotime( $inspection_date[1] ) ) : '';
	$time_end   = isset( $inspection_date[3] ) ? date( $time_format, strtotime( $inspection_date[3] ) ) : '';
	return "{$date} {$time_start} to {$time_end}";
}
add_filter( 'epl_inspection_format', 'rec_filter_inspection_date' );