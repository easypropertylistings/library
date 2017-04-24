<?php
/**
 * Add a custom field to a specific location with array splice
 *
 */

function epl_meta_groups_pricing_auction_site($fields) {

	$new_fields = array(
		array(
			'name'		=>	'property_auction_place',
			'label'		=>	__('Auction Place', 'easy-property-listings' ),
			'type'		=>	'text',
			'default'	=>	'On Site'
		)
	);


	array_splice($fields['fields'], 3, 0, $new_fields );
	return $fields;
}

add_filter('epl_meta_groups_pricing','epl_meta_groups_pricing_auction_site');
