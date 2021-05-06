<?php
/**
 * Register a new template for the Search Widget using the View option.
 *
 * This will load a custom file from YOUR_THEME/easypropertylistings/shortcodes/listing-search/ folder.
 */

/**
 * Add custom templates for search
 */
function my_epl_custom_search_widget_templates( $fields ) {

	$fields[] = array(
		'key'     => 'view',
		'label'   => __('View','easy-property-listings'),
		'default' => 'default',
		'type'    => 'select',
		'options' => array(
			'default'  => __('Default' , 'easy-property-listings'),
			'filename' => __('New Search File' , 'easy-property-listings'),
		)
	);
	return $fields;
}
add_filter( 'epl_search_widget_fields', 'my_epl_custom_search_widget_templates' );