<?php
/**
 * Gravity Forms Functions
 *
 */

function rec_epl_populate_section_32_attachment($value) {

	$lu_pdf = '';

	if (function_exists('epl_lu_listing_unlimited_id') ) {
		$lu_post_id = epl_lu_listing_unlimited_id();

		$lu_pdf = get_post_meta( $lu_post_id , 'listing_unlimited_pdf' , true );

	}

	return $lu_pdf;
}
add_filter('gform_field_value_section_32', 'rec_epl_populate_section_32_attachment');


function rec_epl_populate_address($value) {

	$address = epl_property_get_the_full_address();

	return $address;
}
add_filter('gform_field_value_property_address', 'rec_epl_populate_address');

function rec_epl_populate_post_author_details($value) {
	global $post;

	$author_email 	= get_the_author_meta('user_email', $post->post_author);

	$author_vars = array(
		'name'	=>	'display_name',
		'phone'	=>	'mobile',
		'email'	=>	'user_email',
	);

	$string = '';
	if ( !empty($author_email) ) {
		foreach ( $author_vars as $type => $v ) {
			switch ( $type ) {
				case 'name';
				case 'phone';
					$prefix = '';
					$suffix = '%0A%0A';

					break;

				case 'email';
					$prefix = '<a href="mailto:' . $v . '">';
					$suffix = '</a>';

					break;
			}
			$string .= $prefix . get_the_author_meta( $v , $post->post_author) . $suffix;
		}
		return esc_attr ($string);
	}
	return;

}
//add_filter('gform_field_value_author_details', 'rec_epl_populate_post_author_details');

function rec_epl_populate_post_author_name($value) {
	global $post;
	$author_name = get_the_author_meta('display_name', $post->post_author);
	return $author_name;
}
add_filter('gform_field_value_author_name', 'rec_epl_populate_post_author_name');

function rec_epl_populate_post_author_phone($value) {
	global $post;
	$author_phone = get_the_author_meta('mobile', $post->post_author);
	return $author_phone;
}
add_filter('gform_field_value_author_phone', 'rec_epl_populate_post_author_phone');