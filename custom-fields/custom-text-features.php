<?php
/*
 * Text output to listing features
 */

// Create new meta box of groups of custom fields - for bulleted list of features.
function my_add_custom_features_text_callback($meta_fields) {
	$custom_field = array(
		'id'		=>	'epl_property_listing_custom_data_id',
		'label'		=>	__('Custom Features', 'epl'), // Box header
		'post_type'	=>	array('property', 'rural', 'rental', 'land', 'commercial', 'commercial_land', 'business'), // Which listing types these will be attached to
		'context'	=>	'normal',
		'priority'	=>	'default',
		'groups'	=>	array(
			array(
				'id'		=>	'property_custom_feature_section',
				'columns'	=>	'2', // One or two columns
				'label'		=>	'Custom features',
				'fields'	=>	array(
					array(
						'name'		=>	'property_custom_feature_1',
						'label'		=>	__('Custom feature 1', 'epl'),
						'type'		=>	'text',


					),
					array(
						'name'		=>	'property_custom_feature_2',
						'label'		=>	__('Custom feature 2', 'epl'),
						'type'		=>	'text',

					),
				)
			),
			array(
				'id'		=>	'property_custom_feature_section_2',
				'columns'	=>	'2', // One or two columns
				'label'		=>	'Custom features 2',
				'fields'	=>	array(
					array(
						'name'		=>	'property_custom_feature_3',
						'label'		=>	__('Custom feature 3', 'epl'),
						'type'		=>	'text',

					),
					array(
						'name'		=>	'property_custom_feature_4',
						'label'		=>	__('Custom feature 4', 'epl'),
						'type'		=>	'text',

					)
				)
			)
		)
	);
	$meta_fields[] = $custom_field;
	return $meta_fields;
}
add_filter( 'epl_listing_meta_boxes' , 'my_add_custom_features_text_callback' );



function my_text_features() {

	$features = array(
		'property_custom_feature_1',
		'property_custom_feature_2',
		'property_custom_feature_3',
		'property_custom_feature_4',
	);

	$return = '';
	foreach ( $features as $feature ) {

		$value = get_property_meta( $feature );

		if ( ! empty( $value ) ) {
			$return .= '<li>' . get_property_meta( $feature ) . '</li>';
		}
	}

	return $return;

}
add_filter( 'epl_the_property_feature_list_after' , 'my_text_features' );