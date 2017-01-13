<?php
/**
 * Replace street address with custom text when set to not display the address
 *
 * @see http://codex.easypropertylistings.com.au/article/351-how-to-add-a-custom-link-and-icon-to-the-author-box
 */

 // Replace street address with custom text when set to not display the address
function my_epl_display_text_address_callback() {
	global $property;

	if ( $property->get_property_meta('property_address_display') != 'yes' ) { ?>
		<span class="item-street">Contact for address details</span>
	<?php }
}
// Apply the custom function to the template hooks
add_action('epl_property_title','my_epl_display_text_address_callback' , 9 );
add_action('epl_property_tab_address','my_epl_display_text_address_callback' , 9 );
add_action('epl_property_address','my_epl_display_text_address_callback' , 9 );