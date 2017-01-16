<?php
/**
 * How to completely override the meta-boxes.php file using the epl_listing_meta_boxes filter
 * Note: we have only included a snippet of the metaboxes file.
 *
 * @see https://github.com/easypropertylistings/Easy-Property-Listings/blob/master/lib/meta-boxes/meta-boxes.php
 *
 * @see http://codex.easypropertylistings.com.au/article/354-how-to-completely-replace-the-meta-boxes-with-the-epllistingmetaboxes-filter
 */

function my_custom_epl_metaboxes( $epl_meta_boxes ) {

	$opts_property_status = apply_filters (  'epl_opts_property_status_filter', array(
			'current'	=>	__('Current', 'easy-property-listings' ),
			'withdrawn'	=>	__('Withdrawn', 'easy-property-listings' ),
			'offmarket'	=>	__('Off Market', 'easy-property-listings' ),
			'sold'		=>	array(
				'label'		=>	apply_filters( 'epl_sold_label_status_filter' , __('Sold', 'easy-property-listings' ) ),
				'exclude'	=>	array('rental')
			),
			'leased'		=>	array(
				'label'		=>	apply_filters( 'epl_leased_label_status_filter' , __('Leased', 'easy-property-listings' ) ),
				'include'	=>	array('rental', 'commercial', 'commercial_land', 'business')
			)
		)
	);
	$opts_property_authority = apply_filters (  'epl_property_authority_filter', array(
			'exclusive'	=>	__('Exclusive', 'easy-property-listings' ),
			'auction'	=>	__('Auction', 'easy-property-listings' ),
			'multilist'	=>	__('Multilist', 'easy-property-listings' ),
			'conjunctional'	=>	__('Conjunctional', 'easy-property-listings' ),
			'open'		=>	__('Open', 'easy-property-listings' ),
			'sale'		=>	__('Sale', 'easy-property-listings' ),
			'setsale'	=>	__('Set Sale', 'easy-property-listings' )
		)
	);
	$opts_property_exclusivity = apply_filters (  'epl_opts_property_exclusivity_filter', array(
			'exclusive'	=>	__('Exclusive', 'easy-property-listings' ),
			'open'		=>	__('Open', 'easy-property-listings' )
		)
	);
	$opts_property_com_authority = apply_filters (  'epl_opts_property_com_authority_filter', array(
			'Forsale'	=>	__('For Sale', 'easy-property-listings' ),
			'auction'	=>	__('Auction', 'easy-property-listings' ),
			'tender'	=>	__('Tender', 'easy-property-listings' ),
			'eoi'		=>	__('EOI', 'easy-property-listings' ),
			'Sale'		=>	__('Sale', 'easy-property-listings' ),
			'offers'	=>	__('Offers', 'easy-property-listings' )
		)
	);
	$opts_area_unit = apply_filters (  'epl_opts_area_unit_filter', array(
			'square'	=>	__('Square', 'easy-property-listings' ),
			'squareMeter'	=>	__('Square Meter', 'easy-property-listings' ),
			'acre'		=>	__('Acre', 'easy-property-listings' ),
			'hectare'	=>	__('Hectare', 'easy-property-listings' ),
			'sqft'		=>	__('Square Feet', 'easy-property-listings' )
		)
	);
	$opts_rent_period = apply_filters (  'epl_opts_rent_period_filter', array(
			'day'		=>	__('Day', 'easy-property-listings' ),
			'daily'		=>	__('Daily', 'easy-property-listings' ),
			'week'		=>	__('Week', 'easy-property-listings' ),
			'weekly'	=>	__('Weekly', 'easy-property-listings' ),
			'month'		=>	__('Month', 'easy-property-listings' ),
			'monthly'	=>	__('Monthly', 'easy-property-listings' )
		)
	);
	$opts_property_com_listing_type = apply_filters (  'epl_opts_property_com_listing_type_filter', array(
			'sale'		=>	__('Sale', 'easy-property-listings' ),
			'lease'		=>	__('Lease', 'easy-property-listings' ),
			'both'		=>	__('Both', 'easy-property-listings' )
		)
	);
	$opts_property_com_tenancy = apply_filters (  'epl_opts_property_com_tenancy_filter', array(
			'unknown'	=>	__('Unknown', 'easy-property-listings' ),
			'vacant'	=>	__('Vacant', 'easy-property-listings' ),
			'tenanted'	=>	__('Tenanted', 'easy-property-listings' )
		)
	);
	$opts_property_com_property_extent = apply_filters (  'epl_opts_property_com_property_extent_filter', array(
			'whole'		=>	__('Whole', 'easy-property-listings' ),
			'part'		=>	__('Part', 'easy-property-listings' )
		)
	);

	global $epl_meta_boxes;
	$epl_meta_boxes = array(

		array(
			'id'		=>	'epl-property-listing-section-id',
			'label'		=>	__('Listing Details', 'easy-property-listings' ),
			'post_type'	=>	array('property', 'rural', 'rental', 'land', 'commercial', 'commercial_land', 'business'),
			'context'	=>	'normal',
			'priority'	=>	'default',
			'groups'	=>	array(
				array(
					'id'		=>	'property_heading',
					'columns'	=>	'1',
					'label'		=>	'',
					'fields'	=>	array(
						array(
							'name'		=>	'property_heading',
							'label'		=>	__('My Custom Heading', 'easy-property-listings' ),
							'type'		=>	'text',
							'maxlength'	=>	'200'
						)
					)
				),

				array(
					'id'		=>	'listing_agents',
					'columns'	=>	'1',
					'label'		=>	__('Listing Agent(s)', 'easy-property-listings' ),
					'fields'	=>	array(
						array(
							'name'		=>	'property_office_id',
							'label'		=>	__('Office ID', 'easy-property-listings' ),
							'type'		=>	'text',
							'maxlength'	=>	'50'
						),

						array(
							'name'		=>	'property_agent',
							'label'		=>	__('Listing Agent', 'easy-property-listings' ),
							'type'		=>	'text',
							'maxlength'	=>	'40'
						),

						array(
							'name'		=>	'property_second_agent',
							'label'		=>	__('Second Listing Agent', 'easy-property-listings' ),
							'type'		=>	'text',
							'maxlength'	=>	'40',
							'help'		=>	__('Search for secondary agent.','easy-property-listings' )
						),

						array(
							'name'		=>	'property_agent_hide_author_box',
							'label'		=>	__('Hide Author Box', 'easy-property-listings' ),
							'type'		=>	'checkbox_single',
							'opts'		=>	array(
								'yes'	=>	__('Hide Author Box', 'easy-property-listings' ),
							)
						)
					)
				),

				array(
					'id'		=>	'listing_type',
					'columns'	=>	'2',
					'label'		=>	__('Listing Type', 'easy-property-listings' ),
					'fields'	=>	array(
						array(
							'name'		=>	'property_status',
							'label'		=>	__('Property Status', 'easy-property-listings' ),
							'type'		=>	'select',
							'opts'		=>	$opts_property_status
						),

						array(
							'name'		=>	'property_list_date',
							'label'		=>	__('Date Listed', 'easy-property-listings' ),
							'type'		=>	'date',
							'maxlength'	=>	'100'
						),

						array(
							'name'		=>	'property_authority',
							'label'		=>	__('Authority', 'easy-property-listings' ),
							'type'		=>	'select',
							'opts'		=>	$opts_property_authority,
							'exclude'	=>	array('rental', 'commercial', 'commercial_land')
						),

						array(
							'name'		=>	'property_category',
							'label'		=>	__('House Category', 'easy-property-listings' ),
							'type'		=>	'select',
							'opts'		=>	epl_listing_load_meta_property_category(),
							'exclude'	=>	array('land', 'commercial', 'commercial_land', 'business', 'rural')
						),

						array(
							'name'		=>	'property_rural_category',
							'label'		=>	__('Rural Category', 'easy-property-listings' ),
							'type'		=>	'select',
							'opts'		=>	epl_listing_load_meta_rural_category(),
							'include'	=>	array('rural')
						),

						array(
							'name'		=>	'property_unique_id',
							'label'		=>	__('Unique ID', 'easy-property-listings' ),
							'type'		=>	'text',
							'maxlength'	=>	'50'
						),

						array(
							'name'		=>	'property_mod_date',
							'label'		=>	__('XML Importer Mod Date', 'easy-property-listings' ),
							'type'		=>	'text',
							'maxlength'	=>	'60'
						),

						array(
							'name'		=>	'property_images_mod_date',
							'label'		=>	'',
							'type'		=>	'hidden',
							'maxlength'	=>	'60'
						),

						array(
							'name'		=>	'property_com_authority',
							'label'		=>	__('Commercial Authority', 'easy-property-listings' ),
							'type'		=>	'select',
							'opts'		=>	$opts_property_com_authority,
							'include'	=>	array('commercial', 'commercial_land', 'business')
						),

						array(
							'name'		=>	'property_com_exclusivity',
							'label'		=>	__('Exclusivity', 'easy-property-listings' ),
							'type'		=>	'select',
							'opts'		=>	$opts_property_exclusivity,
							'include'	=>	array('commercial', 'commercial_land', 'business')
						),

						array(
							'name'		=>	'property_com_listing_type',
							'label'		=>	__('Commercial Listing Type', 'easy-property-listings' ),
							'type'		=>	'select',
							'opts'		=>	$opts_property_com_listing_type,
							'include'	=>	array('commercial', 'commercial_land' , 'business' )
						),

						array(
							'name'		=>	'property_commercial_category',
							'label'		=>	__('Commercial Category', 'easy-property-listings' ),
							'type'		=>	'select',
							'opts'		=>	epl_listing_load_meta_commercial_category(),
							'include'	=>	array('commercial', 'commercial_land')
						),
					)
				),

				array(
					'id'		=>	'display_details',
					'columns'	=>	'2',
					'label'		=>	__('Display Details', 'easy-property-listings' ),
					'fields'	=>	array(
						array(
							'name'		=>	'property_featured',
							'label'		=>	__('Featured', 'easy-property-listings' ),
							'type'		=>	'checkbox_single',
							'opts'	=>	array(
								'yes'	=>	__('Yes', 'easy-property-listings' ),
							),
						),

						array(
							'name'		=>	'property_inspection_times',
							'label'		=>	__('Inspection Times ( one per line )', 'easy-property-listings' ),
							'type'		=>	'textarea',
							'maxlength'	=>	'500'
						)
					)
				)
			)
		)
	);

	return $epl_meta_boxes;

}
add_filter( 'epl_listing_meta_boxes' , 'my_custom_epl_metaboxes' );
