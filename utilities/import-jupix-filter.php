<?php
// Filter for importing Jupix direct with importer add-on 1.1

function recepl_import_mod_time($updatemodtime,$xml_object,$pid){

	if( !empty($updatemodtime) ) {
		return $updatemodtime;
	}

	$date = '';
	$time = '';
	if( isset($xml_object['dateLastModified']) ) {
		$date = $xml_object['dateLastModified'];
	}
	if( isset($xml_object['timeLastModified']) ) {
		$time = $xml_object['timeLastModified'];
	}

	$updatemodtime = $date.'-'.$time;
	return $updatemodtime;
}
add_filter('epl_import_mod_time','recepl_import_mod_time',10,3);
