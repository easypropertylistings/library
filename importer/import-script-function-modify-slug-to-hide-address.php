<?php
/**
 * During WP All Import this function will run and if the address is
 * set to no it will change the listing slug to hide the address.
 *
 * Usage: Add function to site, will alter all EPL imports.
 */
function my_epl_all_import_post_saved_property_unique_id($id) {

	$the_post = get_post($id);

	if( ! in_array( $the_post->post_type, epl_get_core_post_types(), true ) ) {
		return;
	}

        $display = get_post_meta($id, 'property_address_display', true);

        if( 'yes' !== $display ) {

                $u_id     = get_post_meta($id, 'property_unique_id', true);
                $suburb   = get_post_meta($id, 'property_address_suburb', true);
                $state    = get_post_meta($id, 'property_unique_state', true);
                $postcode = get_post_meta($id, 'property_address_postal_code', true);

                $title = $u_id.'-'.$suburb.'-'.$state.'-'.$postcode;

                if( ! empty( $u_id ) ) {

                        $my_post = array(
                                'ID'         => $id,
                                'post_title' => $title,
                                'post_name'  => sanitize_title( $title )
                        );

                        wp_update_post( $my_post );
                }
        }
}
add_action( 'pmxi_saved_post', 'my_epl_all_import_post_saved_property_unique_id', 10, 1 );

/**
 * Helper function to update all listings and implement the above script.
 * Enable the action and disable once you run the one-time process.
 *
 * Usage: trigger it using ?epl_process_listings in URL.
 */
function rec_epl_process_all_listings() {

        if( !isset( $_GET['epl_process_listings'] ) ) {
                return;
        }

        $listings = get_posts(
                [
                        'post_type'      => epl_get_core_post_types(),
                        'posts_per_page' => -1
                ]
        );

        foreach( $listings as $listing ) {
                my_epl_all_import_post_saved_property_unique_id( $listing->ID );
        }

}
//add_action( 'init', 'epl_all_import_post_saved_property_unique_id' );

/**
 * Helper function to update single listing and implement the above script.
 * Enable the action and disable once you run the one-time process.
 *
 * Usage: trigger it using ?epl_process_listing={unique_id} in URL.
 */
function rec_epl_process_single_listing() {

        if( empty( $_GET['epl_process_listing'] ) ) {
                return;
        }

        $post_id =  epl_get_post_id_from_unique_id( $_GET['epl_process_listing'] );

        if( $post_id ) {
                $listing = get_post($post_id);
                my_epl_all_import_post_saved_property_unique_id( $listing->ID );

        }
        
        

}
//add_action( 'init', 'rec_epl_process_single_listing' );
