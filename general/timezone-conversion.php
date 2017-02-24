<?php
/**
 * Switch date time string from one timezone to other
 * @param  boolean $date_time     date time string to change
 * @param  string  $old_time_zone current time zone of date time string
 * @param  string  $new_timezone  new time zone to change to
 * @param  string  $format        return format of the dat time string
 * @return mixed
 */

function switch_date_time($date_time=false,$old_time_zone='Australia/Perth',$new_timezone='Australia/Perth',$format='Y-m-d H:i:s') {

	if( !$date_time) {
		$date_time = date( 'Y-m-d H:i:s',time() );
	}
	if( !$old_time_zone) {
		$old_time_zone = 'Australia/Perth';
	}
	if( !$new_timezone) {
		$new_timezone = 'Australia/Perth';
	}

	$schedule_date = new DateTime($date_time, new DateTimeZone($new_timezone) );
	$schedule_date->setTimeZone(new DateTimeZone($old_time_zone));
	return $schedule_date->format($format);

}