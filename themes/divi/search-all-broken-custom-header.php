<?php
/**
 * Divi theme fix for a broken custom header/footer 
 *
 * Add this function to your child theme functions.php file
 *
 * @since 1.0.1 Support for all search possibilities.
 */
function init_ds_fix_epl_search() {
 
	if ( isset( $_GET['tab_post_types'] ) && !isset( $_GET['post_type'] ) ) {
		$post_type = isset( $_GET['tab_post_types'] ) ? sanitize_text_field( $_GET['tab_post_types'] ) : '';
		$post_type = explode(',', $post_type );
		$post_type = array_filter( $post_type );
		
		if( !empty( $post_type ) ) {
			$_GET['post_type'] = $post_type;
		}
	}
	
	if ( ( isset( $_GET['action'] ) && 'epl_search' === $_GET['action'] ) && !isset( $_GET['post_type'] ) && !isset( $_GET['tab_post_types'] ) ) {
		$post_type = epl_get_active_post_types();
		$post_type = array_keys( $post_type );
		
		if( !empty( $post_type ) ) {
			$_GET['post_type'] = $post_type;
		}
	}
 }
 add_action( 'init', 'init_ds_fix_epl_search', 1 );
