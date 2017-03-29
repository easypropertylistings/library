<?php
/**
 * Alter Files and Links section by adding additional download options
 *
 */

/**
 * Add brochure upload
 */
function my_epl_add_brochure_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_file_brochure',
		'label'		=>	__('Brochure', 'easy-property-listings' ),
		'type'		=>	'file',
	);
	return $group;
}
add_filter('epl_meta_groups_files_n_links', 'my_epl_add_brochure_field');

/**
 * Add EPC upload
 */
function my_epl_add_epc_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_file_epc',
		'label'		=>	__('EPC', 'easy-property-listings' ),
		'type'		=>	'file',
	);
	return $group;
}
add_filter('epl_meta_groups_files_n_links', 'my_epl_add_epc_field');

/**
 * Add Title upload
 */
function my_epl_add_title_field($group) {
	$group['fields'][] = array(
		'name'		=>	'property_custom_file_title',
		'label'		=>	__('Title', 'easy-property-listings' ),
		'type'		=>	'file',
	);
	return $group;
}
add_filter('epl_meta_groups_files_n_links', 'my_epl_add_title_field');


// Add Brochure to Buttons
function my_epl_button_brochure() {
	$brochure	= get_post_meta( get_the_ID() , 'property_custom_file_brochure' , true );

	if ( !empty( $brochure ) ) { ?>
		<span class="epl-brochure-button-wrapper">
			<a type="button" class="fancybox image epl-button epl-brochure" href="<?php echo $brochure; ?>">Brochure</a>
		</span>
	<?php
	}
}
add_action('epl_buttons_single_property', 'my_epl_button_brochure' , 5 );

// Add EPC to Buttons
function my_epl_button_epc() {
	$epc	= get_post_meta( get_the_ID() , 'property_custom_file_epc' , true );

	if ( !empty( $epc ) ) { ?>
		<span class="epl-epc-button-wrapper">
			<a type="button" class="fancybox image epl-button epl-epc" href="<?php echo $epc; ?>">EPC</a>
		</span>
	<?php
	}
}
add_action('epl_buttons_single_property', 'my_epl_button_epc' , 15);

// Add Title to Buttons
function my_epl_button_title() {
	$title	= get_post_meta( get_the_ID() , 'property_custom_file_title' , true );

	if ( !empty( $title ) ) { ?>
		<span class="epl-title-button-wrapper">
			<a type="button" class="fancybox image epl-button epl-title" href="<?php echo $title; ?>">Title</a>
		</span>
	<?php
	}
}
add_action('epl_buttons_single_property', 'my_epl_button_title' , 20  );

