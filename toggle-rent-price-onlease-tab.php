<?php
/** Add search rent option */
function rec_search_rent_frontend_fields($fields) {

	$price_array = epl_get_price_array('rental','lease');

	$fields[] = array(
		'key'			=>	'search_rent',
		'meta_key'		=>	'property_rent_from',
		'label'			=>	__('Rent From', 'easy-property-listings'),
		'type'			=>	'select',
		'options'		=>	$price_array,
		'option_filter'		=>	'rent_from',
		'query'			=>	array(
								'query'		=>	'meta',
								'key'		=>	'property_rent',
								'type'		=>	'numeric',
								'compare'	=>	'>='
							),
		'class'			=>	'epl-search-row-half',
		'order'			=>	155
	);

	$fields[] = array(
		'key'			=>	'search_rent',
		'meta_key'		=>	'property_rent_to',
		'label'			=>	__('Rent To', 'easy-property-listings'),
		'type'			=>	'select',
		'options'		=>	$price_array,
		'option_filter'		=>	'rent_to',
		'query'			=>	array(
								'query'		=>	'meta',
								'key'		=>	'property_rent',
								'type'		=>	'numeric',
								'compare'	=>	'<='
							),
		'class'			=>	'epl-search-row-half',
		'order'			=>	155
	);
	return $fields;
}
add_filter('epl_search_widget_fields_frontend','rec_search_rent_frontend_fields');

//Add Search rent option
function search_rent_fields($fields) {
	$fields[] = array(
		'key'			=>	'search_rent',
		'label'			=>	__('Rent Price','easy-property-listings'),
		'default'		=>	'on',
		'type'			=>	'checkbox',
	);

	return $fields;
}
add_filter('epl_search_widget_fields','search_rent_fields');

/** Custom Search Scripts */
function rec_search_custom_scripts() { ?>
	<script type="text/javascript" charset="utf-8" async defer>
		jQuery(document).ready(function($) {
			if(jQuery('#property_status :selected').val() == 'lease') {
	            jQuery('.epl-property_price_from, .epl-property_price_to').hide();
	            jQuery('.epl-property_rent_from, .epl-property_rent_to').show();
	        } else {
	            jQuery('.epl-property_price_from, .epl-property_price_to').show();
	            jQuery('.epl-property_rent_from, .epl-property_rent_to').hide();
	        }
		    jQuery("#property_status").change(function() {

		        if(jQuery('#property_status :selected').val() == 'lease') {
		            jQuery('.epl-property_price_from, .epl-property_price_to').hide();
		            jQuery('.epl-property_rent_from, .epl-property_rent_to').show();
		        } else {
		            jQuery('.epl-property_price_from, .epl-property_price_to').show();
		            jQuery('.epl-property_rent_from, .epl-property_rent_to').hide();
		        }
		    });
		});
	</script>
<?php }
add_action( 'wp_footer', 'rec_search_custom_scripts' );
