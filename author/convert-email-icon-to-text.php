<?php
/**
 * This filter allows you to convert the email icon to words
 *
 *
 * @see http://docs.easypropertylistings.com.au/source-class-EPL_Author_Meta.html#81
 */
function rec_epl_author_icon_email_text_callback( $html = '') {

	global $epl_author;

	$html = '<a class="epl-author-email" href="mailto:' . $epl_author->email . '" title="'.__('Contact', 'easy-property-listings' ).' '.$epl_author->name.' '.__('by Email', 'easy-property-listings' ).'">' . $epl_author->email . '</a>';

	return $html;
}
add_filter( 'epl_author_icon_email' , 'rec_epl_author_icon_email_text_callback' , 1 );