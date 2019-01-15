<?php
function epl_filter_search_widget_fields_frontend($fields) {
 	foreach($fields as &$field) {
 		if($field['key'] == 'search_house_category') {
 			$field['type'] 		= 	'multiple_select';
 			break;
 		}
 	}
 	return $fields;
 }
add_filter('epl_search_widget_fields_frontend','epl_filter_search_widget_fields_frontend');
