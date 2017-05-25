<?php
/*
 * Plugin Name: Easy Property Listings - Custom Settings - Hi Forclosures
 * Plugin URL: https://easypropertylistings.com.au/
 * Description: Adds filters to Easy Property Listings
 * Version: 1.0.0
 * Author: Merv Barrett
 * Author URI: http://www.realestateconnected.com.au
 */

function my_epl_button_target_floorplan() {
	return 'target="_blank"';
}
add_filter( 'epl_button_target_floorplan' , 'my_epl_button_target_floorplan' );

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
		'auction'	=>	__('1st Auction', 'easy-property-listings' ),
		'auction_2'	=>	__('2nd Auction', 'easy-property-listings' ),
	);
	return $array;
}
add_filter( 'epl_property_authority_filter' , 'my_epl_property_authority_filter' );

// Rename Authority to Auction type
function my_edited_property_authority($field) {
	$field['label'] = __('Auction Type','epl');
	return $field;
}
add_filter('epl_meta_property_authority','my_edited_property_authority');

// Modify Property & Rural Listing Type categories
function my_epl_property_category($array) {
	$array = array(
		'single-family'  	=>	__('Single Family', 'epl'),
		'condo' 		=>	__('Condo', 'epl'), // Added Snow
		'vacant-land'		=>	__('Vacant Land', 'epl'), // Added Beach
		'multi-family'		=>	__('Multi Family', 'epl'),
		'commercial'		=>	__('Commercial', 'epl'),
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
// Add: Opening Bid
function my_epl_add_opening_bid_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_opening_bid',
		'label'		=>	__('Opening Bid', 'easy-property-listings' ),
		'type'		=>	'number',
		'maxlength'	=>	'10'
	);
	return $group;
}
add_filter('epl_meta_groups_listing_type', 'my_epl_add_opening_bid_field');

// Add: Current Bid
function my_epl_add_current_bid_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_current_bid',
		'label'		=>	__('Current Max Bid', 'easy-property-listings' ),
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
		'FS'		=>	__('Fee Simple', 'easy-property-listings' ),
		'LH'		=>	__('Leasehold', 'easy-property-listings' ),
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
function my_epl_add_property_accessible_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_property_accessible',
		'label'		=>	__('Property Accessible?', 'easy-property-listings' ),
		'type'		=>	'text',
		'maxlength'	=>	'40',
	);
	return $group;
}
add_filter('epl_meta_groups_listing_type', 'my_epl_add_property_accessible_field');

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

function my_epl_get_property_rooms_label() {
	return __('half bath','');
}
add_filter('epl_get_property_rooms_label','my_epl_get_property_rooms_label');

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
            				'property_security_system',
            				'property_garage',
            				'property_carport'
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

// Change unit 'sqft' to 'sq ft'
function my_epl_opts_area_unit_filter($field) {
	unset($field['sqft']);
	$field['sq ft'] = __('Square Feet','easy-property-listings');
	return $field;
}
add_filter('epl_opts_area_unit_filter','my_epl_opts_area_unit_filter');

// Add: Interior Area
function my_epl_add_interior_area_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_interior_area',
		'label'		=>	__('Interior Area', 'easy-property-listings' ),
		'type'		=>	'text',
		'maxlength'	=>	'155',
	);
	return $group;
}
add_filter('epl_meta_groups_house_features', 'my_epl_add_interior_area_field');

// Add: Lanai Area
function my_epl_add_lanai_area_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_lanai_area',
		'label'		=>	__('Lanai Area', 'easy-property-listings' ),
		'type'		=>	'text',
		'maxlength'	=>	'155',
	);
	return $group;
}
add_filter('epl_meta_groups_house_features', 'my_epl_add_lanai_area_field');

// Add: Garage Area
function my_epl_add_garage_area_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_garage_area',
		'label'		=>	__('Garage Area', 'easy-property-listings' ),
		'type'		=>	'text',
		'maxlength'	=>	'155',
	);
	return $group;
}
add_filter('epl_meta_groups_house_features', 'my_epl_add_garage_area_field');

// Add: Carport Area
function my_epl_add_carport_area_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_carport_area',
		'label'		=>	__('Carport Area', 'easy-property-listings' ),
		'type'		=>	'text',
		'maxlength'	=>	'155',
	);
	return $group;
}
add_filter('epl_meta_groups_house_features', 'my_epl_add_carport_area_field');

// Add: Land Area
function my_epl_add_land_area_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_land_area',
		'label'		=>	__('Land Area', 'easy-property-listings' ),
		'type'		=>	'text',
		'maxlength'	=>	'155',
	);
	return $group;
}
add_filter('epl_meta_groups_house_features', 'my_epl_add_land_area_field');

// Add: Land Area
function my_epl_add_building_area_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_building_area',
		'label'		=>	__('Building Area', 'easy-property-listings' ),
		'type'		=>	'text',
		'maxlength'	=>	'155',
	);
	return $group;
}
add_filter('epl_meta_groups_house_features', 'my_epl_add_land_area_field');

// Add: Occupied by
function my_epl_add_occupied_by_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_occupied_by',
		'label'		=>	__('Occupied by', 'easy-property-listings' ),
		'type'		=>	'text',
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
		'type'		=>	'text',
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
		'unknown'	=>	__('Unknown', 'easy-property-listings' ),
	);
	return $array;
}

// Add: TMK
function my_epl_add_tmk_field($group) {
    if(!empty($group['fields'])) {
	    $group['fields'] = array_filter($group['fields']);
        foreach($group['fields'] as $k => &$fieldvalue) {
            if( in_array($fieldvalue['name'], array(
            				'property_land_area',
            				'property_land_area_unit',
            				'property_building_area',
	           				'property_building_area_unit'
			) ) ) {
                unset($group['fields'][$k]);
            }
        }
    }
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
/**
 * Custom Property Tab section details output
 *
 * @since 1.0
 * @hooked property_tab_section
 */
function my_epl_property_tab_auction_details() {
	global $property;

	$property_status = $property->get_property_meta('property_status');
	$sold_date = __('Not Available','easy-property-listings');
	if ($property->get_property_meta('property_sold_date') != '')
		$sold_date = date('j/n/y',strtotime($property->get_property_meta('property_sold_date')));
	ob_start();
	if ( $property_status == 'sold' ) { ?>
		<div class="epl-tab-section epl-section-description">
			<h5 class="epl-tab-title tab-title"><?php echo apply_filters('epl_property_tab_sale_title_description',__('Sale Details', 'easy-property-listings' )); ?>
			</h5>
			<div class="epl-tab-content tab-content epl-tab-auction-details">
				<ul class="epl-tab-2-columns">
					<li><?php echo __('Sold Price: ', 'easy-property-listings' ).epl_currency_formatted_amount($property->get_property_meta('property_sold_price')); ?></li>
					<li><?php echo __('Sold Date: ','easy-property-listings').$sold_date; ?></li>
				</ul>
			</div>
		</div>
	<?php
	} else {
	?>
	<div class="epl-tab-section epl-section-description">
		<h5 class="epl-tab-title tab-title"><?php echo apply_filters('epl_property_tab_title_description',__('Auction Details', 'easy-property-listings' )); ?>
		</h5>
		<div class="epl-tab-content tab-content epl-tab-auction-details">
			<?php
				//Data
				$opening_bid 	= $property->get_property_meta('property_custom_opening_bid');
				$market_value	= $property->get_property_meta('property_custom_market_value');
				$current_bid	= $property->get_property_meta('property_custom_current_bid');
			echo '<ul class="epl-tab-2-columns">';
				if ( $opening_bid != '' ) {
					echo '<li>'.__('Opening Bid: ', 'easy-property-listings' ).epl_currency_formatted_amount( $opening_bid ).'</li>';
				}
				if ( $market_value != '' ) {
					echo '<li>'.__('Est. Market Value: ', 'easy-property-listings' ).epl_currency_formatted_amount( $market_value ).'</li>';
				}
				if ( $current_bid != '' ) {
					echo '<li>'.__('Current Max Bid: ', 'easy-property-listings' ).epl_currency_formatted_amount( $current_bid ).'</li>';
				}
			echo '</ul>';
			?>
		</div>
		<div class="epl-tab-content tab-content epl-tab-inspection">
			<?php do_action('epl_property_inspection_times'); ?>
		</div>
		<?php $auction_date_2 = $auction_date_1 = '';
		if ($property->get_property_meta('property_auction') != '')
			//$auction_date_1 = date('l, F j Y \a\t h:i A',strtotime($property->get_property_meta('property_auction')));
			$auction_date_1 = date('l, F j Y',strtotime($property->get_property_meta('property_auction')));
		if ($property->get_property_meta('property_auction_2') != '')
			//$auction_date_2 = date('l, F j Y \a\t h:i A',strtotime($property->get_property_meta('property_auction_2')));
			$auction_date_2 = date('l, F j Y',strtotime($property->get_property_meta('property_auction_2')));
		if (($auction_date_1 !='') || ($auction_date_2 != '')) { ?>
			<div class="epl-tab-content tab-content epl-tab-auction-date">
			<?php
			echo '<ul>';
			if ($auction_date_1 !='')
				echo '<li>'.__('1st Auction Date: ','easy-property-listings').$auction_date_1.'</li>';
			if ($auction_date_2 !='')
				echo '<li>'.__('2nd Auction Date: ','easy-property-listings').$auction_date_2.'</li>';
			echo '</ul>';
			?>
			</div> <?php
		}
		?>
	</div>
	<?php
	}
	echo ob_get_clean();
}
add_action('epl_property_tab_auction_details','my_epl_property_tab_auction_details');
/**
 * Custom Property Tab section details output
 *
 * @since 1.0
 * @hooked property_tab_section
 */
function my_epl_property_tab_section() {
	global $property;
	ob_start();
	$the_property_feature_list = '';
	$common_features = array (
		'property_custom_tmk',
		'property_year_built',
		'property_custom_interior_area',
		'property_custom_lanai_area',
		'property_custom_garage_area',
		'property_custom_carport_area',
		'property_custom_land_area',
		'property_category',
		'property_custom_property_accessible',
		'property_custom_tenure',
		'property_custom_condo_name',
		'property_custom_condition',
		'property_custom_neighborhood',
		'property_custom_occupied_by',
		'property_custom_monthly_maintenance',
		'property_custom_property_manager',
		'property_custom_monthly_taxes'
	);
	foreach($common_features as $common_feature){
		$the_property_feature_list .= my_get_common_features_html($common_feature);
	}
	echo '<div class="epl-tab-content tab-content"><ul class="listing-info epl-tab-'.$property->get_epl_settings('display_feature_columns').'-columns">'.$the_property_feature_list.'</ul></div>';

// Internal Features
	$additional_features 	= array (
		'property_study' => __('Study', 'easy-property-listings' ),
		'property_custom_internal_ac_central' => __('A/C – Central', 'easy-property-listings' ),
		'property_custom_internal_ac_split' => __('A/C – Split', 'easy-property-listings' ),
		'property_custom_internal_ac_window' => __('A/C – Window', 'easy-property-listings' ),
		'property_custom_internal_ceiling_fans' => __('Ceiling Fans', 'easy-property-listings' ),
		'property_custom_internal_dishwasher' => __('Dishwasher', 'easy-property-listings' ),
		'property_custom_internal_dryer' => __('Dryer', 'easy-property-listings' ),
		'property_custom_internal_garage_remote' => __('Garage Remote', 'easy-property-listings' ),
		'property_custom_internal_gym' => __('Gym', 'easy-property-listings' ),
		'property_custom_internal_jacuzzi' => __('Jacuzzi', 'easy-property-listings' ),
		'property_custom_internal_pool' => __('Pool', 'easy-property-listings' ),
		'property_custom_internal_single_story' => __('Single-Story', 'easy-property-listings' ),
		'property_custom_internal_spa_bathtub' => __('Spa Bathtub', 'easy-property-listings' ),
		'property_custom_internal_split_level' => __('Split Level', 'easy-property-listings' ),
		'property_custom_internal_stove_oven' => __('Stove Oven', 'easy-property-listings' ),
		'property_custom_internal_washing_machine' => __('Washing Machine', 'easy-property-listings' ),
	);
	$the_property_feature_list = '';
	foreach($additional_features as $additional_feature => $feature_label){
		$the_property_feature_list .= my_get_additional_features_html($additional_feature,$feature_label);
	} ?>
	<?php
	if ( $the_property_feature_list != '' ) { ?>
		<h5 class="epl-tab-title epl-tab-title-property-features tab-title"><?php apply_filters( 'epl_property_sub_title_property_features' , _e('Home Details', 'easy-property-listings' ) ); ?></h5>
		<div class="epl-tab-content tab-content">
			<ul class="listing-info epl-tab-<?php echo $property->get_epl_settings('display_feature_columns'); ?>-columns">
				<?php echo $the_property_feature_list ?>
			</ul>
		</div>
	<?php
	}
	?>
	<?php

// External Features
	$additional_features 	= array (
		'property_custom_external_courtyard' => __('Courtyard', 'easy-property-listings' ),
		'property_custom_external_deck' => __('Deck', 'easy-property-listings' ),
		'property_custom_external_fenced_yard' => __('Fenced yard', 'easy-property-listings' ),
		'property_custom_external_lanai' => __('Lanai', 'easy-property-listings' ),
		'property_custom_external_shed' => __('Shed', 'easy-property-listings' ),
		'property_custom_external_storage_unit' => __('Storage Unit', 'easy-property-listings' ),
	);
	$the_property_feature_list = '';
	foreach($additional_features as $additional_feature => $feature_label){
		$the_property_feature_list .= my_get_additional_features_html($additional_feature,$feature_label);
	} ?>
	<?php
	if ( $the_property_feature_list != '' ) { ?>
		<h5 class="epl-tab-title epl-tab-title-property-features tab-title"><?php apply_filters( 'epl_property_sub_title_property_features' , _e('Land Details', 'easy-property-listings' ) ); ?></h5>
		<div class="epl-tab-content tab-content">
			<ul class="listing-info epl-tab-<?php echo $property->get_epl_settings('display_feature_columns'); ?>-columns">
				<?php echo $the_property_feature_list ?>
			</ul>
		</div>
	<?php
	}
	?>
	<?php

// Parking
	$additional_features 	= array (
		'property_custom_parking_1_stall' => __('1 Stall', 'easy-property-listings' ),
		'property_custom_parking_2_stall' => __('2 Stalls', 'easy-property-listings' ),
		'property_custom_parking_3_stall' => __('3 Stalls', 'easy-property-listings' ),
		'property_custom_parking_assigned_stall' => __('Assigned Stalls', 'easy-property-listings' ),
		'property_custom_parking_carport' => __('Carport', 'easy-property-listings' ),
		'property_custom_parking_driveway' => __('Driveway', 'easy-property-listings' ),
		'property_custom_parking_garage' => __('Garage', 'easy-property-listings' ),
		'property_custom_parking_guest_parking' => __('Guest Parking', 'easy-property-listings' ),
		'property_custom_parking_secured' => __('Remote Garage', 'easy-property-listings' ),
		'property_custom_parking_tandem_stalls' => __('Tandem Stalls', 'easy-property-listings' ),
		'property_custom_parking_unassigned_stalls' => __('Unsssigned Stalls', 'easy-property-listings' ),
	);
	$the_property_feature_list = '';
	foreach($additional_features as $additional_feature => $feature_label){
		$the_property_feature_list .= my_get_additional_features_html($additional_feature,$feature_label);
	} ?>
	<?php
	if ( $the_property_feature_list != '' ) { ?>
		<h5 class="epl-tab-title epl-tab-title-property-features tab-title"><?php apply_filters( 'epl_property_sub_title_property_features' , _e('Parking', 'easy-property-listings' ) ); ?></h5>
		<div class="epl-tab-content tab-content">
			<ul class="listing-info epl-tab-<?php echo $property->get_epl_settings('display_feature_columns'); ?>-columns">
				<?php echo $the_property_feature_list ?>
			</ul>
		</div>
	<?php
	}
	?>
	<?php

// Community
	$additional_features 	= array (
		'property_custom_community_bbq' => __('BBQ', 'easy-property-listings' ),
		'property_custom_community_basketball_court' => __('Basketball Court', 'easy-property-listings' ),
		'property_custom_community_community_laundry' => __('Community Laundry', 'easy-property-listings' ),
		'property_custom_community_gym' => __('Gym', 'easy-property-listings' ),
		'property_custom_community_jacuzzi' => __('Jacuzzi', 'easy-property-listings' ),
		'property_custom_community_jogging_path' => __('Jogging Path', 'easy-property-listings' ),
		'property_custom_community_pavilion' => __('Pavilion', 'easy-property-listings' ),
		'property_custom_community_playground' => __('Playground', 'easy-property-listings' ),
		'property_custom_community_pool' => __('Pool', 'easy-property-listings' ),
		'property_custom_community_recreation_area' => __('Recreation Area', 'easy-property-listings' ),
		'property_custom_community_resident_manager' => __('Resident Manager', 'easy-property-listings' ),
		'property_custom_community_restaurant' => __('Restaurant', 'easy-property-listings' ),
		'property_custom_community_sauna' => __('Sauna', 'easy-property-listings' ),
		'property_custom_community_secured_entry' => __('Secured Entry', 'easy-property-listings' ),
		'property_custom_community_security_guard' => __('Security Guard', 'easy-property-listings' ),
		'property_custom_community_tennis_court' => __('Tennis Court', 'easy-property-listings' ),
		'property_custom_community_trash_chute' => __('Trash Chute', 'easy-property-listings' ),
		'property_custom_community_workout_area' => __('Workout Area', 'easy-property-listings' )
	);
	$the_property_feature_list = '';
	foreach($additional_features as $additional_feature => $feature_label){
		$the_property_feature_list .= my_get_additional_features_html($additional_feature,$feature_label);
	} ?>
	<?php
	if ( $the_property_feature_list != '' ) { ?>
		<h5 class="epl-tab-title epl-tab-title-property-features tab-title"><?php apply_filters( 'epl_property_sub_title_property_features' , _e('Community Amenities', 'easy-property-listings' ) ); ?></h5>
		<div class="epl-tab-content tab-content">
			<ul class="listing-info epl-tab-<?php echo $property->get_epl_settings('display_feature_columns'); ?>-columns">
				<?php echo $the_property_feature_list ?>
			</ul>
		</div>
	<?php
	}
	?>
	<?php
	echo ob_get_clean();
}
add_action('epl_property_tab_section','my_epl_property_tab_section');
function my_get_additional_features_html( $metakey,$label='' ) {
		global $property;
        $metavalue = $property->get_property_meta($metakey);
		$return = '';
		if( $metavalue != '' || intval($metavalue) != 0) {
            switch($metavalue) {
                case '1':
                case 'yes':
                case 'on':
                    $return = '<li class="'.$property->get_class_from_metakey($metakey).'">'.apply_filters('epl_get_'.$metakey.'_label',__($label, 'easy-property-listings' ) ).'</li>';
                break;
				case '0':
				case 'no':
                case 'off':
					$return = '';
				break;
                default:
                    $return = '<li class="'.$property->get_class_from_metakey($metakey).'">'.__($metavalue,'easy-property-listings' ).' '.apply_filters('epl_get_'.$metakey.'_label',__($label, 'easy-property-listings' ) ).'</li>';
                break;
            }
        }
	return apply_filters('epl_get_additional_features_html',$return);
}
function my_get_common_features_html( $metakey ) {
		global $property;
		$area_unit = __('sq ft' , 'easy-property-listings' );
        $metavalue = $property->get_property_meta($metakey);
		$return = '';
		$label = get_common_feature_label_from_metakey($metakey);
		if( $metavalue != '' || intval($metavalue) != 0) {
			switch($metavalue) {
                case '1':
                //case 'yes':
                case 'on':
                	$return = '<li class="'.$property->get_class_from_metakey($metakey).'">'.apply_filters('epl_get_'.$metakey.'_label',__($label, 'easy-property-listings' ) ).'</li>';
		    		break;
		  		case 'yes':
		    	case 'X':
		    	case 'x':
		    		$return = '<li class="'.$property->get_class_from_metakey($metakey).'">' .apply_filters('epl_get_'.$metakey.'_label',__($label, 'easy-property-listings' ) ). __(': Yes','epl').'</li>';
		    		break;
				case '0':
		        case 'off':
					$return = '';
					break;
				case 'no':
					$return = '<li class="'.$property->get_class_from_metakey($metakey).'">' .apply_filters('epl_get_'.$metakey.'_label',__($label, 'easy-property-listings' ) ). __(': No','epl').'</li>';
					break;
                default:
                	if ( ($metakey == 'property_custom_monthly_maintenance') ||
                		($metakey == 'property_custom_monthly_taxes') ||
            			($metakey == 'property_custom_current_bid') ||
            			($metakey == 'property_custom_market_value')
            			)    {
                		$metavalue = epl_currency_formatted_amount($metavalue);
                	}
                	if( ($metakey == 'property_custom_interior_area') || ($metakey == 'property_custom_garage_area') || ($metakey == 'property_custom_carport_area') || ($metakey == 'property_custom_lanai_area') || ($metakey == 'property_custom_land_area')  )    {
                		$metavalue .= ' '.$area_unit;
                	}
                	if( $metakey == 'property_custom_tenure') {
                		switch ($metavalue) {
                			case 'LH':
                				$metavalue = __('Leasehold','epl');
                				break;
                			case 'FS':
                				$metavalue = __('Fee Simple','epl');
                				break;
                			default:
                				//do nothing
                		}
                	}
                	if( $metakey != 'property_custom_tmk') {
	                    $metavalue = ucwords(str_replace('-',' ',$metavalue));
	                    $metavalue = ucwords(str_replace('_',' ',$metavalue));
                	}
                	$return = '<li class="'.$property->get_class_from_metakey($metakey).'"><span class="epl-label">'.apply_filters('epl_get_'.$metakey.'_label',__($label, 'easy-property-listings' ) ).': </span><span class="epl-value">'.__($metavalue,'easy-property-listings' ).'</span></li>';
                	break;
            }
        }
	return apply_filters('epl_get_common_features_html',$return);
}
function get_common_feature_label_from_metakey( $key , $search = 'property_custom_' ){
	if ($key == 'property_year_built' || $key=='property_category')
		$search = 'property_';
	return ucwords(str_replace('_',' ',str_replace($search, "", $key)));
}

// Add and Remove fields from pricing section
function my_epl_remove_pricing_fields($group) {
    if(!empty($group['fields'])) {
        $group['fields'] = array_filter($group['fields']);
        foreach($group['fields'] as $k => &$fieldvalue) {
            if( in_array($fieldvalue['name'], array(
				'property_under_offer',
				'property_is_home_land_package',
			) ) ) {
                unset($group['fields'][$k]);
            }
            if ($fieldvalue['name'] == 'property_auction')
            	$fieldvalue['label'] = __('1st Auction Date', 'easy-property-listings' );
        }
        $group['fields'][] = array(
			'name'		=>	'property_auction_2',
			'label'		=>	__('2nd Auction Date', 'easy-property-listings' ),
			'type'		=>	'auction-date',
			'maxlength' => 100
		);
    }
    return $group;
}
add_filter('epl_meta_groups_pricing', 'my_epl_remove_pricing_fields',99);
function add_date_picker_script() {
	wp_enqueue_script( 'epl_custom_hi_admin_script', plugin_dir_url(__FILE__) . 'admin-script.js' );
}
add_action( 'admin_enqueue_scripts', 'add_date_picker_script' );

// Add and Remove fields from pricing section
function my_epl_remove_address_block_fields($group) {
    if(!empty($group['fields'])) {
    	unset($group['fields']);
        $group['fields'] =	array(
			array(
				'name'		=>	'property_address_display',
				'label'		=>	__('Display Street Address?', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'		=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
			),
			array(
				'name'		=>	'property_address_lot_number',
				'label'		=>	__('Lot', 'easy-property-listings' ),
				'type'		=>	'text',
				'maxlength'	=>	'40',
				'include'	=>	array('land', 'commercial_land')
			),
			array(
				'name'		=>	'property_address_street_number',
				'label'		=>	__('Street Number', 'easy-property-listings' ),
				'type'		=>	'text',
				'maxlength'	=>	'40'
			),
			array(
				'name'		=>	'property_address_sub_number',
				'label'		=>	__('Unit', 'easy-property-listings' ),
				'type'		=>	'text',
				'maxlength'	=>	'40',
				'exclude'	=>	array('land', 'commercial_land')
			),
			array(
				'name'		=>	'property_address_street',
				'label'		=>	__('Street Name', 'easy-property-listings' ),
				'type'		=>	'text',
				'maxlength'	=>	'80'
			),
			array(
				'name'		=>	'property_address_suburb',
				'label'		=>	epl_labels('label_suburb'),
				'type'		=>	'text',
				'maxlength'	=>	'80'
			),
			array(
				'name'		=>	'property_com_display_suburb',
				'label'		=>	__('Display', 'easy-property-listings' ) . ' ' .epl_labels('label_suburb'),
				'type'		=>	'checkbox_single',
				'opts'		=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				),
				'include'	=>	array('commercial', 'commercial_land', 'business'),
			),
			( isset($epl_settings['epl_enable_city_field'] ) &&  $epl_settings['epl_enable_city_field'] == 'yes' ) ?
			array(
				'name'		=>	'property_address_city',
				'label'		=>	epl_labels('label_city'),
				'type'		=>	'text',
				'maxlength'	=>	'80'
			) : array(),
			array(
				'name'		=>	'property_address_state',
				'label'		=>	epl_labels('label_state'),
				'type'		=>	'text',
				'maxlength'	=>	'80'
			),
			array(
				'name'		=>	'property_address_postal_code',
				'label'		=>	epl_labels('label_postcode'),
				'type'		=>	'text',
				'maxlength'	=>	'30'
			),
			array(
				'name'		=>	'property_address_country',
				'label'		=>	__('Country', 'easy-property-listings' ),
				'type'		=>	'text',
				'maxlength'	=>	'40'
			),
			array(
				'name'		=>	'property_address_coordinates',
				'label'		=>	__('Coordinates', 'easy-property-listings' ),
				'type'		=>	'text',
				'help'		=>	__('Drag the pin to manually set listing coordinates', 'easy-property-listings' ),
				'geocoder'	=>	'true',
				'maxlength'	=>	'40'
			),
			array(
				'name'		=>	'property_address_hide_map',
				'label'		=>	__('Hide Map', 'easy-property-listings' ),
				'type'		=>	'checkbox_single',
				'opts'		=>	array(
					'yes'	=>	__('Yes', 'easy-property-listings' ),
				)
			)
		);
	}
	//epl_print_r($group,true);
    return $group;
}
add_filter('epl_meta_groups_address_block', 'my_epl_remove_address_block_fields',99);
function my_epl_property_custom_title() {
	//$epl_property_address_seperator	= apply_filters('epl_property_address_seperator',',');
	global $property,$epl_settings, $post;
	$region = wp_get_object_terms( $post->ID,  'location');
	if ( $property->get_property_meta('property_address_display') == 'yes' ) { ?>
		<div class="item-street"><?php echo $property->get_formatted_property_address(); ?></div>
	<?php } ?>
	<div class="item-state-line"> <?php
		if ( $property->get_property_meta('property_address_suburb') != '' ) { ?>
			<span class="item-state"><?php echo $property->get_property_meta('property_address_suburb').','; ?></span>
			<?php
		}

		if ( $property->get_property_meta('property_address_state') != '' ) { ?>
			<span class="item-state"><?php echo $property->get_property_meta('property_address_state').' '; ?></span>
			<?php
		}	?>
			<span class="item-pcode"><?php echo $property->get_property_meta('property_address_postal_code'); ?></span>
	</div>	<?php
	if ($region) {
		$region = $region[0]->name; ?>
		<div class="item-region-line"><?php echo __('Region: ').$region; ?></div> <?php
	}
}
add_action('epl_property_custom_title','my_epl_property_custom_title');
function my_epl_get_formatted_property_address() {
	global $property;
	$street =  '';
	if($property->get_property_meta('property_address_street_number') != '')
		$street .= $property->get_property_meta('property_address_street_number').' ';
	$street .= $property->get_property_meta('property_address_street').' ';
	if($property->get_property_meta('property_address_sub_number') != '')
		$street .= '#'.$property->get_property_meta('property_address_sub_number').' ';
	//epl_print_r($street,true);
	return $street;
}
add_filter('epl_get_formatted_property_address','my_epl_get_formatted_property_address');

// Add Custom Options to Search Widget
function my_epl_custom_search_fields_callback( $array ) {
	$array[] = array(
		'key'			=>	'search_tenure',
		'label'			=>	__('Tenure','epl'),
		'default'		=>	'off',
		'type'			=>	'checkbox',
	);
	$array[] = array(
		'key'			=>	'search_current_bid',
		'label'			=>	__('Current Max Bid','epl'),
		'default'		=>	'off',
		'type'			=>	'checkbox',
	);
	$array[] = array(
		'key'			=>	'search_property_accessible',
		'label'			=>	__('Property Accessible','epl'),
		'default'		=>	'off',
		'type'			=>	'checkbox',
	);
	$array[] = array(
		'key'			=>	'search_year_built',
		'label'			=>	__('Year Built','epl'),
		'default'		=>	'off',
		'type'			=>	'checkbox',
	);
	$array[] = array(
		'key'			=>	'search_inspection_dates',
		'label'			=>	__('Inspection Dates','epl'),
		'default'		=>	'on',
		'type'			=>	'checkbox',
	);
	$array[] = array(
		'key'			=>	'search_auction_dates',
		'label'			=>	__('Auction Dates','epl'),
		'default'		=>	'on',
		'type'			=>	'checkbox',
	);
	$array[] = array(
		'key'			=>	'search_suburb',
		'label'			=>	__('City','epl'),
		'default'		=>	'off',
		'type'			=>	'checkbox',
	);
	$array[] = array(
		'key'			=>	'search_land',
		'label'			=>	__('Land Area','epl'),
		'default'		=>	'off',
		'type'			=>	'checkbox',
	);
	$array[] = array(
		'key'			=>	'search_building',
		'label'			=>	__('Building Area','epl'),
		'default'		=>	'off',
		'type'			=>	'checkbox',
	);
	$array[] = array(
		'key'			=>	'search_auction',
		'label'			=>	__('Auction Type','epl'),
		'default'		=>	'off',
		'type'			=>	'checkbox',
	);
	return $array;
}
add_filter( 'epl_search_widget_fields' , 'my_epl_custom_search_fields_callback' );

// Add Custom Search Items to Front End
function my_epl_custom_search_widget_fields_frontend_callback( $fields ) {

	$post_type = 'property';
	foreach($fields as $field_index => &$field) {
		// change class of property location
		if( $field['meta_key'] == 'property_location' ){
			$field['class'] = 'epl-search-row-half';
		}
		// change class of property location
		if( $field['meta_key'] == 'property_category' ){
			$field['class'] = 'epl-search-row-half';
			$field['label'] = __('Property Category','epl');
		}
		if( $field['meta_key'] == 'property_status' ){
			$field['type'] = 'select';
			$field['class'] = 'epl-search-row-half';
		}
		if( $field['meta_key'] == 'property_price_from' ){
			$field['type']				=	'number';
			$field['wrap_start']		=	'epl-search-row-half epl-search-price-wrap';
			$field['class'] 			= 	'epl-search-row-half';
		}
		if( $field['meta_key'] == 'property_price_to' ){
			$field['type']				=	'number';
			$field['wrap_end']			=	true;
			$field['class'] 			= 	'epl-search-row-half';
		}
		if( $field['meta_key'] == 'property_land_area_max' ){
			$field['wrap_end']			=	true;
		}
		if( $field['meta_key'] == 'property_building_area_max' ){
			$field['wrap_end']			=	true;
		}
		if( $field['meta_key'] == 'property_land_area_unit' || $field['meta_key'] == 'property_building_area_unit'){
			unset($fields[$field_index]);
		}

	}
	$year_array		= array_combine(range( date('Y'),1900 ), range( date('Y'),1900 ) );
	$fields[] = array(
		'key'		=>	'search_tenure',
		'meta_key'	=>	'property_custom_tenure',
		'label'		=>	__('Tenure', 'epl'),
		'type'		=>	'select',
		'option_filter'	=>	'tenure',
		'options'	=>	my_epl_add_tenure_select_options(),
		'query'		=>	array(
						'query'		=>	'meta',
						'compare'	=>	'IN'
					),
		'class'		=>	'epl-search-row-half',
		'order'		=>  '300'
	);
	$fields[] = array(
		'key'		=>	'search_current_bid',
		'meta_key'	=>	'property_custom_current_bid_min',
		'label'		=>	__('Current Bid Min', 'epl'),
		'type'		=>	'number',
		'option_filter'	=>	'property_custom_current_bid_min',
		'query'		=>	array(
						'query'		=>	'meta',
						'type'		=>	'numeric',
						'compare'	=>	'>=',
						'key'		=>	'property_custom_current_bid'
					),
		'wrap_start'		=>	'epl-search-row-half epl-search-current-bid-wrap',
		'class'		=>	'epl-search-row-half',
		'order'		=>  305
	);
	$fields[] = array(
		'key'		=>	'search_current_bid',
		'meta_key'	=>	'property_custom_current_bid_max',
		'label'		=>	__('Current Bid Max', 'epl'),
		'type'		=>	'number',
		'option_filter'	=>	'property_custom_current_bid_max',
		'query'		=>	array(
						'query'		=>	'meta',
						'type'		=>	'numeric',
						'compare'	=>	'<=',
						'key'		=>	'property_custom_current_bid'
					),
		'class'		=>	'epl-search-row-half',
		'wrap_end'		=>	true,
		'order'		=>  306
	);
	$fields[] = array(
		'key'		=>	'search_property_accessible',
		'meta_key'	=>	'property_custom_property_accessible',
		'label'		=>	__('Property Accesible', 'epl'),
		'type'		=>	'checkbox',
		'query'		=>	array(
							'query'		=>	'meta',
							'compare'	=>	'IN',
							'value'		=>	array('yes','1')
						),
		'class'		=>	'epl-search-row-half',
		'order'		=>  330
	);
	$fields[] = array(
		'key'		=>	'search_year_built',
		'meta_key'	=>	'property_year_built_min',
		'label'		=>	__('Built Year Min', 'epl'),
		'type'		=>	'number',
		'option_filter'	=>	'property_year_built_min',
		'query'		=>	array(
						'query'		=>	'meta',
						'type'		=>	'numeric',
						'compare'	=>	'>=',
						'key'		=>	'property_year_built'
					),
		'wrap_start'		=>	'epl-search-row-half epl-search-current-year-built-wrap',
		'class'		=>	'epl-search-row-half',
		'order'		=>  320
	);
	$fields[] = array(
		'key'		=>	'search_year_built',
		'meta_key'	=>	'property_year_built_max',
		'label'		=>	__('Built Year Max', 'epl'),
		'type'		=>	'number',
		'option_filter'	=>	'property_year_built_min',
		'query'		=>	array(
						'query'		=>	'meta',
						'type'		=>	'numeric',
						'compare'	=>	'<=',
						'key'		=>	'property_year_built'
					),
		'class'		=>	'epl-search-row-half',
		'wrap_end'		=>	true,
		'order'		=>  321
	);
	$fields[] = array(
		'key'		=>	'search_land',
		'meta_key'	=>	'property_custom_land_area_min',
		'label'		=>	__('Land Area Min', 'epl'),
		'type'		=>	'number',
		'option_filter'	=>	'land_min',
		'query'		=>	array(
						'query'		=>	'meta',
						'type'		=>	'numeric',
						'compare'	=>	'>=',
						'key'		=>	'property_custom_land_area'
					),
		'wrap_start'		=>	'epl-search-row-half epl-search-current-year-built-wrap',
		'class'		=>	'epl-search-row-half',
		'order'		=>  211
	);
	$fields[] = array(
		'key'		=>	'search_land',
		'meta_key'	=>	'property_custom_land_area_max',
		'label'		=>	__('Land Area Max', 'epl'),
		'type'		=>	'number',
		'option_filter'	=>	'land_max',
		'query'		=>	array(
						'query'		=>	'meta',
						'type'		=>	'numeric',
						'compare'	=>	'<=',
						'key'		=>	'property_custom_land_area'
					),
		'class'		=>	'epl-search-row-half',
		'wrap_end'		=>	true,
		'order'		=>  213
	);
	$fields[] = array(
		'key'		=>	'search_building',
		'meta_key'	=>	'property_custom_building_area_min',
		'label'		=>	__('Building Area Min', 'epl'),
		'type'		=>	'number',
		'option_filter'	=>	'building_min',
		'query'		=>	array(
						'query'		=>	'meta',
						'type'		=>	'numeric',
						'compare'	=>	'>=',
						'key'		=>	'property_custom_building_area'
					),
		'wrap_start'		=>	'epl-search-row-half epl-search-current-year-built-wrap',
		'class'		=>	'epl-search-row-half',
		'order'		=>  215
	);
	$fields[] = array(
		'key'		=>	'search_building',
		'meta_key'	=>	'property_custom_building_area_max',
		'label'		=>	__('Building Area Max', 'epl'),
		'type'		=>	'number',
		'option_filter'	=>	'building_max',
		'query'		=>	array(
						'query'		=>	'meta',
						'type'		=>	'numeric',
						'compare'	=>	'<=',
						'key'		=>	'property_custom_building_area'
					),
		'class'		=>	'epl-search-row-half',
		'wrap_end'		=>	true,
		'order'		=>  216
	);
	$fields[] = array(
		'key'		=>	'search_inspection_dates',
		'meta_key'	=>	'property_inspection_times_min',
		'label'		=>	__('Inspection Date Min', 'epl'),
		'type'		=>	'text',
		'option_filter'	=>	'property_inspection_times_min',
		'query'		=>	array(
						'query'		=>	'meta',
						'compare'	=>	'REGEXP',
						'key'		=>	'property_inspection_times'
					),
		'wrap_start'		=>	'epl-search-row-half epl-search-current-year-built-wrap',
		'class'		=>	'epl-search-row-half',
		'order'		=>  322
	);
	$fields[] = array(
		'key'		=>	'search_inspection_dates',
		'meta_key'	=>	'property_inspection_times_max',
		'label'		=>	__('Inspection Date Max', 'epl'),
		'type'		=>	'text',
		'option_filter'	=>	'property_inspection_times_min',
		'query'		=>	array(
						'query'		=>	'meta',
						'compare'	=>	'REGEXP',
						'key'		=>	'property_inspection_times'
					),
		'class'		=>	'epl-search-row-half',
		'wrap_end'		=>	true,
		'order'		=>  323
	);
	$fields[] = array(
		'key'		=>	'search_auction_dates',
		'meta_key'	=>	'property_auction_times_min',
		'label'		=>	__('Auction Date Min', 'epl'),
		'type'		=>	'text',
		'option_filter'	=>	'property_auction_dates_min',
		'query'		=>	array(
						'query'		=>	'meta',
						'compare'	=>	'REGEXP',
						'key'		=>	'property_auction'
					),
		'wrap_start'		=>	'epl-search-row-half epl-search-current-year-built-wrap',
		'class'		=>	'epl-search-row-half',
		'order'		=>  324
	);
	$fields[] = array(
		'key'		=>	'search_auction_dates',
		'meta_key'	=>	'property_auction_times_max',
		'label'		=>	__('Auction Date Max', 'epl'),
		'type'		=>	'text',
		'option_filter'	=>	'property_auction_dates_min',
		'query'		=>	array(
						'query'		=>	'meta',
						'compare'	=>	'REGEXP',
						'key'		=>	'property_auction'
					),
		'class'		=>	'epl-search-row-half',
		'wrap_end'		=>	true,
		'order'		=>  325
	);
	$fields[] = array(
		'key'			=>	'search_suburb',
		'meta_key'		=>	'property_address_suburb',
		'label'			=>	epl_labels('label_suburb'),
		'type'			=>	'select',
		'option_filter'		=>	'property_suburb',
		'options'		=>	epl_get_unique_post_meta_values('property_address_suburb', $post_type ),
		'query'			=>	array('query'	=>	'meta'),
		'class'			=>	'epl-search-row-half',
		'order'			=>	50
	);
	$fields[] = array(
		'key'			=>	'search_auction',
		'meta_key'		=>	'property_authority',
		'label'			=>	__('Auction Type', 'easy-property-listings'),
		'type'			=>	'select',
		'option_filter'		=>	'auction',
		'options'		=>	array(
								'auction' => __('1st Auction','epl'),
								'auction_2' => __('2nd Auction','epl'),
							),
		'query'			=>	array(
								'query'   => 'meta',
								'compare' => 'IN',
							),
		'class'			=>	'epl-search-row-half',
		'order'			=>	35
	);
	return $fields;
}
add_filter( 'epl_search_widget_fields_frontend' , 'my_epl_custom_search_widget_fields_frontend_callback' );
// Property Imported Tag - Admin
function my_epl_property_impoted_tag_callback() {
	global $property;
	$imported = $property->get_property_meta('property_imported');
	if ( $imported == 'yes' ) {
		echo '<div class=epl-imported><span style="background: #ffd300; padding: 0.1em 0.5em;">Imported</span></div>';
	}
}
add_action( 'epl_manage_listing_column_property_status','my_epl_property_impoted_tag_callback' );

function epl_hi_load_search_templates($template) {

	if ( epl_is_search() ) {
		$post_tpl	=	'';
		$common_tpl		= apply_filters('epl_common_search_template','search-listing.php');
		$post_tpl 		= 'search-'.str_Replace('_','-',get_post_type()).'.php';
		$find[] 		= $post_tpl;
		$find[] 		= epl_template_path() . $post_tpl;
		$find[] 		= $common_tpl;
		$find[] 		= epl_template_path() . $common_tpl;
		if ( $post_tpl ) {
	        /*** Template found in theme ? ***/
			$template       = locate_template( array_unique( $find ) );
			if(!$template) {
	            /*** If not found, fallback to extension's default template ***/
				$template	=	$template_path . $common_tpl;
	            if( !file_exists($template) ) {
	                /*** If extension doesnt have templates, fallback to core templates ***/
	                $template	=	EPL_PATH_TEMPLATES_CONTENT . $common_tpl;
	            }
			}
		}
	}
	return $template;
}
add_filter('template_include','epl_hi_load_search_templates',99);

/**
 * For date picker
 */
function epl_hi_wp_enqueue_scripts() {
	// enqueue core css & js required
	$current_dir_path = EPL_PLUGIN_URL.'lib/assets';
	wp_enqueue_script(	'jquery-datetime-picker',			$current_dir_path . '/js/jquery-datetime-picker.js', 	array('jquery') );
	wp_enqueue_style(	'jquery-ui-datetime-picker-style',  		$current_dir_path . '/css/jquery-ui.min.css');
	wp_enqueue_script( 'epl_custom_hi_script', plugin_dir_url(__FILE__) . 'script.js' );
	wp_enqueue_script(	'footable-script', plugin_dir_url(__FILE__) . 'assets/footable.js', 	array('jquery') );
	wp_enqueue_script(	'footable-filetr-script', plugin_dir_url(__FILE__) . 'assets/footable.filter.js', 	array('jquery') );
	//wp_enqueue_script(	'footable-page-script', plugin_dir_url(__FILE__) . 'assets/footable.paginate.js', 	array('jquery') );
	wp_enqueue_script(	'footable-sort-script', plugin_dir_url(__FILE__) . 'assets/footable.sort.js', 	array('jquery') );
	wp_enqueue_style(	'footable-style', plugin_dir_url(__FILE__) . 'assets/footable.css');
}
add_action( 'wp_enqueue_scripts', 'epl_hi_wp_enqueue_scripts' );

function epl_hi_custom_search_processing($meta_query) {
	if(
		!isset($_GET['property_inspection_times_min'] ) ||
		!isset($_GET['property_inspection_times_max'] ) ||
		$_GET['property_inspection_times_max'] == '' ||
		$_GET['property_inspection_times_min'] == '' ){
			// no query for inspection times
	} else {
		foreach($meta_query as $query_index =>  &$query){
			if($query['key'] == 'property_inspection_times'){
				unset($meta_query[$query_index]);
			}
		}
		$range_start = sanitize_text_field($_GET['property_inspection_times_min'] );
		$range_end = sanitize_text_field($_GET['property_inspection_times_max'] );
		$dates = getDatesFromRange($range_start, $range_end,'d-M-Y');
		$dates = implode('|', $dates);
		$query['value'] = $dates;
		$inspection_query = array(
			'key'		=>	'property_inspection_times',
			'value'		=>	$dates,
			'compare'	=>	'REGEXP'
		);
		$meta_query[] = $inspection_query;
	}
	if(
		!isset($_GET['property_auction_times_min'] ) ||
		!isset($_GET['property_auction_times_max'] ) ||
		$_GET['property_auction_times_max'] == '' ||
		$_GET['property_auction_times_min'] == '' ){
			// no query for auction times
	} else {
		foreach($meta_query as $query_index =>  &$query){
			if($query['key'] == 'property_auction'){
				unset($meta_query[$query_index]);
			}
		}
		$range_start = sanitize_text_field($_GET['property_auction_times_min'] );
		$range_end = sanitize_text_field($_GET['property_auction_times_max'] );
		$dates = getDatesFromRange($range_start, $range_end,'Y-m-d');
		$dates = implode('|', $dates);
		$query['value'] = $dates;
		$auction_query = array(
			'relation'	=>	'OR',
			array(
				'key'		=>	'property_auction',
				'value'		=>	$dates,
				'compare'	=>	'REGEXP'
			),
			array(
				'key'		=>	'property_auction_2',
				'value'		=>	$dates,
				'compare'	=>	'REGEXP'
			)

		);
		$meta_query[] = $auction_query;
	}

	//epl_print_r($meta_query,true);
	return $meta_query;
}
add_filter('epl_preprocess_search_meta_query','epl_hi_custom_search_processing',10,2);

/**
 * Generate an array of string dates between 2 dates
 *
 * @param string $start Start date
 * @param string $end End date
 * @param string $format Output format (Default: Y-m-d)
 * @return array
 */
function getDatesFromRange($start, $end, $format = 'Y-m-d') {
    $array = array();
    $interval = new DateInterval('P1D');
    $realEnd = new DateTime($end);
    $realEnd->add($interval);
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
    foreach($period as $date) {
        $array[] = $date->format($format);
    }
    return $array;
}

function my_epl_attachments_sections($meta_box) {
	// Convert Attachment to url during import
	global $pagenow;
	$file_url_type = in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) ? 'file' : 'url';
	//epl_print_r($meta_box['groups'][0]['fields'],true);
	if(!empty($meta_box['groups'][0]['fields'])) {
	    $meta_box['groups'][0]['fields'] = array_filter($meta_box['groups'][0]['fields']);
	    foreach($meta_box['groups'][0]['fields'] as $k => &$fieldvalue) {
	    	if( in_array($fieldvalue['name'], array(
            				'property_floorplan',
            				'property_floorplan_2',
            				'property_external_link',
	           				'property_external_link_2'
			) ) ) {
                unset($meta_box['groups'][0]['fields'][$k]);
            }
    	}
	    $meta_box['groups'][0]['fields'][] = array(
							'name'		=>	'property_comps',
							'label'		=>	__('Comps', 'easy-property-listings' ),
							'type'		=>	$file_url_type
						);
		$meta_box['groups'][0]['fields'][] = array(
							'name'		=>	'property_title_report',
							'label'		=>	__('Title Report', 'easy-property-listings' ),
							'type'		=>	$file_url_type
						);
		$meta_box['groups'][0]['fields'][] = array(
							'name'		=>	'property_file_link',
							'label'		=>	__('File 1', 'easy-property-listings' ),
							'type'		=>	$file_url_type
						);
		$meta_box['groups'][0]['fields'][] = array(
							'name'		=>	'property_file_link_2',
							'label'		=>	__('File 2', 'easy-property-listings' ),
							'type'		=>	$file_url_type
						);
    }
    //epl_print_r($meta_box['groups'][0]['fields'],true);
    return $meta_box;
}
add_filter('epl_meta_box_block_epl_attachments_section_id','my_epl_attachments_sections');
//add_filter('epl_meta_groups_filen_n_links','my_epl_attachments_sections',9999);

//Add custom buttons in frontend
function my_property_extra_buttons() {
	global $property;
	$comps = $property->get_property_meta('property_comps');
	$title_report = $property->get_property_meta('property_title_report');
	$file_1 = $property->get_property_meta('property_file_link');
	$file_2 = $property->get_property_meta('property_file_link_2');
	if ($comps != '' ) { ?>
		<a class="epl-button epl-file1-button" href="<?php echo $comps;?>" download>
			<?php echo __('Comps', 'easy-property-listings'); ?>
		</a>
	<?php
	}
	if ( $title_report != '' ) { ?>
		<a class="epl-button epl-file2-button" href="<?php echo $title_report;?>" download>
			<?php echo __('Title Report', 'easy-property-listings'); ?>
		</a> <?php
	}
	if (  $file_1 != '' ) { ?>
		<a class="epl-button epl-file1-button" href="<?php echo $file_1;?>" download>
			<?php echo __('File 1', 'easy-property-listings'); ?>
		</a>
	<?php
	}
	if ( $file_2 != '' ) { ?>
		<a class="epl-button epl-file2-button" href="<?php echo $file_2;?>" download>
			<?php echo __('File 2', 'easy-property-listings'); ?>
		</a> <?php
	}
}
add_action('epl_buttons_single_property','my_property_extra_buttons', 9 );

/** dont let wp all import pro delete custom fields **/
function my_epl_wpimport_pmxi_custom_field_to_delete($default, $pid, $post_type, $options, $cur_meta_key) {
	if(in_array($cur_meta_key,array(
					'property_custom_internal_ac_central',
					'property_custom_internal_ac_split',
					'property_custom_internal_ac_window',
					'property_custom_internal_ceiling_fans',
					'property_custom_internal_dryer',
					'property_custom_internal_dishwasher',
					'property_custom_internal_garage_remote',
					'property_custom_internal_gym',
					'property_custom_internal_jacuzzi',
					'property_custom_internal_pool',
					'property_custom_internal_single_story',
					'property_custom_internal_spa_bathtub',
					'property_custom_internal_split_level',
					'property_custom_internal_stove_oven',
					'property_custom_internal_washing_machine',
					'property_custom_external_courtyard',
					'property_custom_external_deck',
					'property_custom_external_fenced_yard',
					'property_custom_external_lanai',
					'property_custom_external_shed',
					'property_custom_external_storage_unit',
					'property_custom_parking_1_stall',
					'property_custom_parking_2_stall',
					'property_custom_parking_3_stall',
					'property_custom_parking_assigned_stall',
					'property_custom_parking_carport',
					'property_custom_parking_driveway',
					'property_custom_parking_garage',
					'property_custom_parking_guest_parking',
					'property_custom_parking_secured',
					'property_custom_parking_tandem_stalls',
					'property_custom_parking_unassigned_stalls',
					'property_comps',
					'property_title_report',
					'property_file_link',
					'property_file_link_2',
					'wppcp_post_page_visibility',
					'property_custom_condition',
					'property_custom_occupied_by',
					'property_custom_property_accessible'
				))) {
		return false;
	}
	return true;
}
add_filter('pmxi_custom_field_to_delete','my_epl_wpimport_pmxi_custom_field_to_delete',10,5);

function my_edited_property_com_rent_period($field) {

	$field['label'] = __('Lease Type','epl');
	return $field;

}
add_filter('epl_meta_property_com_rent_period','my_edited_property_com_rent_period');

/**
function epl_file_type_fix() {
	$keys = array('property_comps','property_title_report','property_file_link','property_file_link_2');
	$posts_array = get_posts( array( 'post_type'        => 'property', 'posts_per_page'  => -1 ));
	foreach ($posts_array as $post) {
		foreach ( $keys as $metakey) {
			$value = get_post_meta($post->ID, $metakey, true);
			if ( is_array($value) && isset($value['image_url_or_path']) ) {
				$value = $value['image_url_or_path'];
				$status = update_post_meta( $post->ID, $metakey, $value);
			}
		}
	}
}
**/
//add_Action('admin_init','epl_file_type_fix');