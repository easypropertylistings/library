<?php
// Add field to the User Profile in the EPL Section
function my_epl_add_author_box_fields($fields) {
	$fields[] = array(
				'name'		=>	'some_unique_name',
				'label'		=>	__('My label', 'easy-property-listings' ),
				'description'	=>	__('My description of the field', 'easy-property-listings' ),
				'class'		=>	'regular-text',
				'type'		=>	'text',
			);
	return $fields;
}
add_filter('epl_custom_user_profile_fields','my_epl_add_author_box_fields');
