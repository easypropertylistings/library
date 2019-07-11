<?php
/**
 * Filter listings by post_id by adding a custom sorting option to the manage listings pages
 */


/**
 * Add text field to filter listing ID
 */
function my_theme_add_listing_id_search() {

	global $post_type;
	if( is_epl_core_post( $post_type ) ) {

		if(isset($_GET['prop_listing_id'])) {
			$val = stripslashes($_GET['prop_listing_id']);
		} else {
			$val = '';
		}
		echo '<input type="text" name="prop_listing_id" placeholder="'.__('Filter by Post ID.', 'easy-property-listings' ).'" value="'.$val.'" />';
	}
}

// Add custom filters to post type posts listings
add_action( 'restrict_manage_posts', 'my_theme_add_listing_id_search',99 );

/**
 * Filter by listing ID
 *
 * @since 1.0
 */
function my_theme_listings_filter( $query ) {

	global $pagenow;
	if( is_admin() && $pagenow == 'edit.php' ) {

		if( isset($_GET['prop_listing_id']) && trim($_GET['prop_listing_id']) != '') {

			$value 	= sanitize_text_field( $_GET['prop_listing_id'] );
			$value 	= array_map( 'trim', explode( ',', $value ) );

			$query->set( 'post__in', $value  );
		}

	}
}

add_filter( 'parse_query', 'my_theme_listings_filter',99 );