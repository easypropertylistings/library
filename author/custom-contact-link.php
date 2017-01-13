<?php
/**
 * Add a custom contact link and icon to the author box
 *
 * @see http://codex.easypropertylistings.com.au/article/351-how-to-add-a-custom-link-and-icon-to-the-author-box
 */

// Add custom contact field to user profile
function my_epl_custom_user_contact( $contactmethods ) {
	$contactmethods['custom']	= __( 'Custom', 'easy-property-listings' );

	return $contactmethods;
}
add_filter ('user_contactmethods','my_epl_custom_user_contact',10,1);

// Create the html output for a custom contact field
function my_epl_get_custom_author_html($html = '') {
	global $epl_author;

	if ( $epl_author->custom != '' ) {
		$html = '
			<a class="epl-author-icon author-icon custom-icon-24" href="http://custom.com/' . $epl_author->custom . '"
				title="'.__('Follow', 'easy-property-listings' ).' ' . $epl_author->name . ' '.__('on Custom', 'easy-property-listings' ).'">'.
				 __('C', 'easy-property-listings' ).
			'</a>';
	}
	return $html;
}

// Add new icon after email icon
function my_epl_custom_social_icons_filter( $html ) {

	// Add the new icon
	$html .= my_epl_get_custom_author_html();

	return $html;
}
add_filter( 'epl_author_email_html' , 'my_epl_custom_social_icons_filter' );


// Add CSS to your theme and icon to your theme images folder
/*
	.epl-author-icon.custom-icon-24 {
		background: url(images/social-custom-icon.png) 0 0 no-repeat;
	}
*/