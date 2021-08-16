<?php
/**
 * Change the search result order to sort by status and then date.
 *
 */


/**
 * Order by Status & then Date
 *
 */
function epl_alter_orderby($query) {
	if( $query->is_epl_search ) {

		$query->set('meta_key','property_status');
		$query->set('orderby', array(
			'property_status' => 'ASC',
			'date'            => 'DESC' )
		);
	}
}
add_action( 'pre_get_posts', 'epl_alter_orderby', 99 );