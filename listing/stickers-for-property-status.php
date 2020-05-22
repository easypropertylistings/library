<?php
/**
 * Add custom sticker for property category.
 *
 * @requires EPL 3.4.27
 *
 */

/**
 * Add a sticker for property category
 */
function my_add_epl_sticker( $stickers_array ) {
	// loop $stickers_array to change existing stickers
	// or add a new one
	$stickers_array['category'] = array(
		'conditions'			=>	array(
			'property_category'			=>	'',
		),
		'compare'			=>	'!=',
		'type'				=>	epl_get_core_post_types(),
		'label'				=>	get_property_meta( 'property_category' ),
		'before'			=>	'',
		'after'				=>	'',
		'class'				=>	'listing-category'
	);
	return $stickers_array;
}
add_filter( 'epl_available_stickers', 'my_add_epl_sticker' );

/**
 * filter to change stickers which will render for current listing
 */
function my_customise_epl_sticker( $stickers_array ) {
	// dont render for sale stickers for property
	if( isset( $stickers_array[ 'current_sales'] ) )
		unset( $stickers_array[ 'current_sales'] );
	// change label for home open
	if( isset( $stickers_array[ 'home_open'] ) ) {
		$stickers_array[ 'home_open']['label'] = __( 'Live Inspections', 'theme' );
	}
	// add an icon before sold label
	if( isset( $stickers_array[ 'sold'] ) ) {
		$stickers_array[ 'sold']['before'] = '<i class="fa fa-key"></i>';
	}
	return $stickers_array;
}
add_filter( 'epl_stickers_array', 'my_customise_epl_sticker' );