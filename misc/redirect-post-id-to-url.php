<?php
/**
 * Redirect a post ID to a URL
 * EG if you have a link: ​https://some_site.com.au/?post_type=property&p=3273&preview=true
 * And need to redirect it, use the snippet below
 *
 */

// Redirect snippet.
function rec_redirect_deleted_listing() {

	// Post ID => URL to redirect to.
        $map = [
                3273 => 'https://some_url.com.au/property/22-gordon-street-byron-bay-nsw-2481/',
        ];

        $redirect = '';

        if( isset( $_GET['post_type'] ) && 'property' ==  $_GET['post_type'] ) {

                if( isset( $_GET['p'] ) ) {

                        $p = intval( $_GET['p'] );

                        if( isset( $map[$p] ) ) {

                                $redirect = $map[$p];
                        }
                }
        }

        if( !empty( $redirect ) ) {
                wp_redirect( $redirect );
                die;
        }
}
add_action( 'init', 'rec_redirect_deleted_listing' );
