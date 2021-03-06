<?php
/*
 * Plugin Name: Easy Property Listings - Custom Settings
 * Plugin URL: https://easypropertylistings.com.au/
 * Description: Adds filters to Easy Property Listings
 * Version: 1.0.0
 * Author: Merv Barrett
 * Author URI: http://www.realestateconnected.com.au
 */




// Modify Status
function my_epl_opts_property_status_filter() {

	$array = array(
		'current'	=>	__('Current', 'easy-property-listings' ),
		'withdrawn'	=>	__('Cancelled', 'easy-property-listings' ),
		'offmarket'	=>	__('Postponed', 'easy-property-listings' ),
		'sold'		=>	array(
			'label'		=>	apply_filters( 'epl_sold_label_status_filter' , __('Sold', 'easy-property-listings' ) ),
			'exclude'	=>	array('rental')
		),
		'leased'		=>	array(
			'label'		=>	apply_filters( 'epl_leased_label_status_filter' , __('Leased', 'easy-property-listings' ) ),
			'include'	=>	array('rental', 'commercial', 'commercial_land', 'business')
		)
	);
	return $array;

}
add_filter( 'epl_opts_property_status_filter' , 'my_epl_opts_property_status_filter' );



// Modify Authority
function my_epl_property_authority_filter() {

	$array = array(
		'exclusive'	=>	__('Exclusive', 'easy-property-listings' ),
		'auction'	=>	__('1st Auction', 'easy-property-listings' ),
		'auction_2'	=>	__('2nd Auction', 'easy-property-listings' ),
	);
	return $array;

}
add_filter( 'epl_property_authority_filter' , 'my_epl_property_authority_filter' );



// Modify Property & Rural Listing Type categories
function my_epl_property_category($array) {
	$array = array(
		'single-family'  	=>	__('Single Family', 'epl'),
		'condo' 		=>	__('Condo', 'epl'), // Added Snow
		'vacant-land'		=>	__('Vacant Land', 'epl'), // Added Beach
		'multi-family'		=>	__('Multi Family', 'epl'),
	);
	return $array;
}
add_filter('epl_listing_meta_property_category', 'my_epl_property_category');


// Unset Group
function my_epl_unset_group($group) {
	return;
}

// Remove: Listing Agents Group
add_filter('epl_meta_groups_listing_agents', 'my_epl_unset_group');

// Remove: Heading Section
add_filter('epl_meta_groups_property_heading', 'my_epl_unset_group');




// New Fields

// Add: Current Bid
function my_epl_add_current_bid_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_current_bid',
		'label'		=>	__('Current Bid', 'easy-property-listings' ),
		'type'		=>	'number',
		'maxlength'	=>	'10'
	);
	return $group;
}
add_filter('epl_meta_groups_listing_type', 'my_epl_add_current_bid_field');

// Add: Tenure
function my_epl_add_tenure_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_tenure',
		'label'		=>	__('Tenure', 'easy-property-listings' ),
		'type'		=>	'select',
		'opts'		=>	my_epl_add_tenure_select_options(),
	);
	return $group;
}
add_filter('epl_meta_groups_listing_type', 'my_epl_add_tenure_field');

// Tenure Select Options
function my_epl_add_tenure_select_options() {
	$array = array(
		'fee_simple'		=>	__('Fee Simple', 'easy-property-listings' ),
		'leasehold'		=>	__('Leasehold', 'easy-property-listings' ),
	);
	return $array;
}


// Add: Condo/HOA Name
function my_epl_add_condo_name_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_condo_name',
		'label'		=>	__('Condo/HOA Name', 'easy-property-listings' ),
		'type'		=>	'text',
		'maxlength'	=>	'40',
	);
	return $group;
}
add_filter('epl_meta_groups_listing_type', 'my_epl_add_condo_name_field');


// Add: Est. Market Value – $ input
function my_epl_add_market_value_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_market_value',
		'label'		=>	__('Est. Market Value', 'easy-property-listings' ),
		'type'		=>	'number',
		'maxlength'	=>	'10'
	);
	return $group;
}
add_filter('epl_meta_groups_listing_type', 'my_epl_add_market_value_field');


// Add: Property Accessible?
function my_epl_add_property_accessable_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_property_accessable',
		'label'		=>	__('Property Accessible?', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Property Accessible?', 'easy-property-listings' ),
		)
	);
	return $group;
}
add_filter('epl_meta_groups_listing_type', 'my_epl_add_property_accessable_field');

// Add: Neighborhood – text input
function my_epl_add_neighborhood_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_neighborhood',
		'label'		=>	__('Neighborhood', 'easy-property-listings' ),
		'type'		=>	'text',
		'maxlength'	=>	'40',
	);
	return $group;
}
add_filter('epl_meta_groups_listing_type', 'my_epl_add_neighborhood_field');




// Rename rooms to Half Bathrooms
function my_epl_modify_rooms_field($field) {

	$field['label'] = __('Half Bathrooms','easy-property-listings');

	return $field;

}
add_filter('epl_meta_property_rooms','my_epl_modify_rooms_field');


// Remove fields from house_features group
function my_epl_remove_fields_house_features($group) {

    if(!empty($group['fields'])) {
        $group['fields'] = array_filter($group['fields']);
        foreach($group['fields'] as $k => &$fieldvalue) {
            if( in_array($fieldvalue['name'], array(
            				'property_ensuite',
            				'property_toilet' ,
            				'property_open_spaces' ,
            				'property_new_construction',
            				'property_pool',
            				'property_air_conditioning',
            				'property_security_system'
            			) ) ) {
                unset($group['fields'][$k]);
            }
        }
    }
    return $group;
}
add_filter('epl_meta_groups_house_features', 'my_epl_remove_fields_house_features',99);






// Rename Garage
function my_epl_modify_property_garage_field($field) {

	$field['label'] = __('Garage Area','easy-property-listings');

	return $field;

}
add_filter('epl_meta_property_garage','my_epl_modify_property_garage_field');

// Rename Carport
function my_epl_modify_property_carport_field($field) {

	$field['label'] = __('Carport Area','easy-property-listings');

	return $field;

}
add_filter('epl_meta_property_carport','my_epl_modify_property_carport_field');


// Add: Occupied by
function my_epl_add_occupied_by_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_occupied_by',
		'label'		=>	__('Occupied by', 'easy-property-listings' ),
		'type'		=>	'select',
		'opts'		=>	my_epl_add_occupied_by_select_options(),
	);
	return $group;
}
add_filter('epl_meta_groups_house_features', 'my_epl_add_occupied_by_field');

// Occupied by Select Options
function my_epl_add_occupied_by_select_options() {
	$array = array(
		'homeowner'		=>	__('Homeowner', 'easy-property-listings' ),
		'tenant_association'	=>	__('Tenant of Association', 'easy-property-listings' ),
		'tenant_commissioner'	=>	__('Tenant of Commissioner', 'easy-property-listings' ),
		'tenant_homeowner'	=>	__('Tenant of Homeowner', 'easy-property-listings' ),
		'Vacant'		=>	__('Vacant', 'easy-property-listings' ),
		'unknown'		=>	__('Unknown', 'easy-property-listings' ),
	);
	return $array;
}


// Add: Monthly Maintenance Fee - $ input
function my_epl_add_monthly_maintenance_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_monthly_maintenance',
		'label'		=>	__('Monthly Maintenance Fee', 'easy-property-listings' ),
		'type'		=>	'decimal',
		'maxlength'	=>	'10'
	);
	return $group;
}
add_filter('epl_meta_groups_house_features', 'my_epl_add_monthly_maintenance_field');

// Add: Property Manager – text input
function my_epl_add_property_manager_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_property_manager',
		'label'		=>	__('Property Manager', 'easy-property-listings' ),
		'type'		=>	'text',
		'maxlength'	=>	'155',
	);
	return $group;
}
add_filter('epl_meta_groups_house_features', 'my_epl_add_property_manager_field');


// Add: Condition
function my_epl_add_condition_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_condition',
		'label'		=>	__('Condition', 'easy-property-listings' ),
		'type'		=>	'select',
		'opts'		=>	my_epl_add_condition_select_options(),
	);
	return $group;
}
add_filter('epl_meta_groups_house_features', 'my_epl_add_condition_field');

// Condition by Select Options
function my_epl_add_condition_select_options() {
	$array = array(
		'excellent'	=>	__('Excellent', 'easy-property-listings' ),
		'very_good'	=>	__('Very Good', 'easy-property-listings' ),
		'good'		=>	__('Good', 'easy-property-listings' ),
		'fair'		=>	__('Fair', 'easy-property-listings' ),
		'poor'		=>	__('Poor', 'easy-property-listings' ),
		'tear_down'	=>	__('Tear Down', 'easy-property-listings' ),
	);
	return $array;
}



// Add: TMK
function my_epl_add_tmk_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_tmk',
		'label'		=>	__('TMK', 'easy-property-listings' ),
		'type'		=>	'text',
		'maxlength'	=>	'100',
	);
	return $group;
}
add_filter('epl_meta_groups_land_details', 'my_epl_add_tmk_field');

// Add: Monthly Taxes - $ input
function my_epl_add_monthly_taxes_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_monthly_taxes',
		'label'		=>	__('Monthly Taxes', 'easy-property-listings' ),
		'type'		=>	'decimal',
		'maxlength'	=>	'10'
	);
	return $group;
}
add_filter('epl_meta_groups_land_details', 'my_epl_add_monthly_taxes_field');


// Additional Fields


function my_epl_additional_features_custom($group) {
	$array = array(
		array(
			'name'		=>	'property_remote_garage',
			'label'		=>	__('Remote Garage', 'easy-property-listings' ),
			'type'		=>	'checkbox_single',
			'opts'	=>	array(
				'yes'	=>	__('Yes', 'easy-property-listings' ),
			),
		),
		array(
			'name'		=>	'property_secure_parking',
			'label'		=>	__('Secure Parking', 'easy-property-listings' ),
			'type'		=>	'checkbox_single',
			'opts'	=>	array(
				'yes'	=>	__('Yes', 'easy-property-listings' ),
			),
		),
		array(
			'name'		=>	'property_study',
			'label'		=>	__('Study', 'easy-property-listings' ),
			'type'		=>	'checkbox_single',
			'opts'	=>	array(
				'yes'	=>	__('Yes', 'easy-property-listings' ),
			),
		),
	);
}


// Remove fields from house_features group
function my_epl_remove_fields_internal($group) {

    if(!empty($group['fields'])) {
        $group['fields'] = array_filter($group['fields']);
        foreach($group['fields'] as $k => &$fieldvalue) {
            if( in_array($fieldvalue['name'], array(
            				'property_remote_garage',
            				'property_secure_parking',
            				'property_study',
            				'property_dishwasher',
            				'property_built_in_robes',
            				'property_gym',
            				'property_workshop',
            				'property_rumpus_room',
            				'property_floor_boards',
            				'property_broadband',
            				'property_pay_tv',
            				'property_vacuum_system',
            				'property_intercom',
            				'property_spa',
            			) ) ) {
                unset($group['fields'][$k]);
            }
        }
    }
    return $group;
}
add_filter('epl_meta_groups_internal', 'my_epl_remove_fields_internal',99);






// Add: Additional Internal Features
function my_epl_add_additional_features_internal_custom($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_ac_central',
		'label'		=>	__('A/C – Central', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('A/C – Central', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_ac_split',
		'label'		=>	__('A/C – Split ', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('A/C – Split ', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_ac_window',
		'label'		=>	__('A/C – Window Unit(s)', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('A/C – Window Unit(s)', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_ceiling_fans',
		'label'		=>	__('Ceiling Fans', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Ceiling Fans', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_dishwasher',
		'label'		=>	__('Dishwasher', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Dishwasher', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_dryer',
		'label'		=>	__('Dryer', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Dryer', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_garage_remote',
		'label'		=>	__('Garage Remote', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Garage Remote', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_gym',
		'label'		=>	__('Gym', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Gym', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_jacuzzi',
		'label'		=>	__('Jacuzzi', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Jacuzzi', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_pool',
		'label'		=>	__('Pool', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Pool', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_single_story',
		'label'		=>	__('Single-Story', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Single-Story', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_spa_bathtub',
		'label'		=>	__('Spa Bathtub', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Spa Bathtub', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_split_level',
		'label'		=>	__('Split Level', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Split Level', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_stove_oven',
		'label'		=>	__('Stove/Oven', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Stove/Oven', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_internal_washing_machine',
		'label'		=>	__('Washing Machine', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Washing Machine', 'easy-property-listings' ),
		)
	);
	return $group;
}
add_filter('epl_meta_groups_internal', 'my_epl_add_additional_features_internal_custom');


// Remove fields from external group
function my_epl_remove_fields_external($group) {

    if(!empty($group['fields'])) {
        $group['fields'] = array_filter($group['fields']);
        foreach($group['fields'] as $k => &$fieldvalue) {
            if( in_array($fieldvalue['name'], array(
            				'property_tennis_court',
            				'property_balcony',
            				'property_deck',
            				'property_courtyard',
            				'property_outdoor_entertaining',
            				'property_shed',
            			) ) ) {
                unset($group['fields'][$k]);
            }
        }
    }
    return $group;
}
add_filter('epl_meta_groups_external', 'my_epl_remove_fields_external',99);



// Add: Additional External Features
function my_epl_add_additional_features_external_custom($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_external_courtyard',
		'label'		=>	__('Courtyard', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Courtyard', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_external_deck',
		'label'		=>	__('Deck', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Deck', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_external_fenced_yard',
		'label'		=>	__('Fenced yard', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Fenced yard', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_external_lanai',
		'label'		=>	__('Lanai', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Lanai', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_external_shed',
		'label'		=>	__('Shed', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Shed', 'easy-property-listings' ),
		)
	);

	$group['fields'][] = array(
		'name'		=>	'property_custom_external_storage_unit',
		'label'		=>	__('Storage unit', 'easy-property-listings' ),
		'type'		=>	'checkbox_single',
		'opts'		=>	array(
			'yes'	=>	__('Storage unit', 'easy-property-listings' ),
		)
	);

	return $group;
}
add_filter('epl_meta_groups_external', 'my_epl_add_additional_features_external_custom');


// Unset heating_cooling group
add_filter('epl_meta_groups_heating_cooling', 'my_epl_unset_group');



// Add: Additional Parking and Community Section Features
function my_epl_additional_features_parking_community_custom($meta_box) {

	$meta_box['groups'][] = array(
		'id'		=>	'parking',
		'columns'	=>	'3',
		'label'		=>	__('Parking', 'easy-property-listings' ),
		'fields'	=>	array(

			array(
				'name'		=>	'property_custom_parking_1_stall',
				'label'		=>	__('1 Stall', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_parking_2_stall',
				'label'		=>	__('2 Stalls', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_parking_3_stall',
				'label'		=>	__('3+ Stalls', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_parking_assigned_stall',
				'label'		=>	__('Assigned stalls', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_parking_carport',
				'label'		=>	__('Carport', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_parking_driveway',
				'label'		=>	__('Driveway', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_parking_garage',
				'label'		=>	__('Garage', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_parking_guest_parking',
				'label'		=>	__('Guest parking', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_parking_secured',
				'label'		=>	__('Secured', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_parking_tandem_stalls',
				'label'		=>	__('Tandem stalls', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_parking_unassigned_stalls',
				'label'		=>	__('Unassigned stalls', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			)
		)
	);

	$meta_box['groups'][] = array(
		'id'		=>	'community',
		'columns'	=>	'3',
		'label'		=>	__('Community Amenities', 'easy-property-listings' ),
		'fields'	=>	array(

			array(
				'name'		=>	'property_custom_community_bbq',
				'label'		=>	__('BBQ', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_basketball_court',
				'label'		=>	__('Basketball Court', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_community_laundry',
				'label'		=>	__('Community Laundry', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_gym',
				'label'		=>	__('Gym', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_jacuzzi',
				'label'		=>	__('Jacuzzi', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_jogging_path',
				'label'		=>	__('Jogging Path', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_pavilion',
				'label'		=>	__('Pavilion', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_playground',
				'label'		=>	__('Playground', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_pool',
				'label'		=>	__('Pool', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_recreation_area',
				'label'		=>	__('Recreation Area', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_resident_manager',
				'label'		=>	__('Resident Manager', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_restaurant',
				'label'		=>	__('Restaurant', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_sauna',
				'label'		=>	__('Sauna', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_secured_entry',
				'label'		=>	__('Secured Entry', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_security_guard',
				'label'		=>	__('Security Guard', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_tennis_court',
				'label'		=>	__('Tennis Court', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_trash_chute',
				'label'		=>	__('Trash Chute', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),

			array(
				'name'		=>	'property_custom_community_workout_area',
				'label'		=>	__('Workout Area', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'	=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			)
		)
	);

	return $meta_box;
}
add_filter('epl_meta_box_block_epl_additional_features_section_id','my_epl_additional_features_parking_community_custom');

