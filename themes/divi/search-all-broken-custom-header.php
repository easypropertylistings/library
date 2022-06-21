<?php
/**
 * Divi theme fix for a broken custom header/footer 
 *
 * Add this function to your child theme functions.php file
 */
function init_ds_fix_epl_search() {

	if ( isset( $_GET['tab_post_types'] ) && ! isset( $_GET['post_type'] ) ) {

		$post_type = isset( $_GET['tab_post_types'] ) ? sanitize_text_field( $_GET['tab_post_types'] ) : '';
		$post_type = explode(',', $post_type );
		$post_type = array_filter( $post_type );

		if( ! empty( $post_type ) ) {
			$_GET['post_type'] = $post_type;
		}

	}
}
add_action( 'after_setup_theme', 'init_ds_fix_epl_search', 1 );
