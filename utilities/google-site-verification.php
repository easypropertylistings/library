<?php
/**
 * Google Site Verification.
 */

// Google Site Verification
function my_render_site_verification_code () {

	$key = 'YOUR_KEY_HERE';

	if ( ! empty( $key ) ) {
		echo '<meta name="google-site-verification" content="' . $key . '" >' . "\n";
	}

}
add_action ( 'wp_head', 'chase_render_site_verification_code');
