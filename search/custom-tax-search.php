<?php

/**
 * Add custom tax search in EPL
 */

/**
 * Add field in frontend form
 */
function my_epl_search_widget_fields_frontend($fields) {
	
	// assuming tax = property_custom_tax

	$custom_tax	= get_terms('property_custom_tax',array('hide_empty'	=> true) );
	$arr = array();
	foreach($custom_tax as $custom_tax_single) {
		$arr[$custom_tax_single->term_id] = $custom_tax_single->name;
	}

	$fields[] = array(
		'key'			=>	'search_custom_tax',
		'meta_key'		=>	'property_custom_tax',
		'label'			=>	'Custom Tax',
		'type'			=>	'select',
		'option_filter'		=>	'custom_tax',
		'options'		=>	$arr,
		'query'			=>	array('query'	=>	'tax'),
		'class'			=>	'epl-search-row-full',
		'order'			=>	40
	);

	return $fields;
}
add_filter('epl_search_widget_fields_frontend','my_epl_search_widget_fields_frontend');

/**
 * Add field in backend / widget
 */

function my_epl_search_widget_fields($fields) {
	
	// assuming tax = property_custom_tax

	$fields[] = array(
		'key'			=>	'search_custom_tax',
		'label'			=>	'Custom Tax',
		'default'		=>	'on',
		'type'			=>	'checkbox',
	);

	return $fields;
}
add_filter('epl_search_widget_fields','my_epl_search_widget_fields');
