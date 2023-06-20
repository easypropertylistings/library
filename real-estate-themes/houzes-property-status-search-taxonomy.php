<?php
/**
 * Fix : Houzez theme status taxonomy conflict with EPL : property_status
 *
 * @return void
 */
function my_rec_unregister_houzez_taxonomy() {

	unregister_taxonomy( 'property_status' );
}
add_action( 'init', 'my_rec_unregister_houzez_taxonomy', 20 );
