<?php
/**
 * Below code will run daily cron jobs to check if rental is leased for more than 14 days & convert them to draft
 *
 */

if ( !wp_next_scheduled( 'epl_set_leased_to_draft' ) ) {
	wp_schedule_event( time(), 'daily', 'epl_set_leased_to_draft' );
}

add_action( 'epl_set_leased_to_draft', 'epl_set_leased_to_draft' );

function epl_set_leased_to_draft() {

	$all_posts = get_posts(
		array(
			'post_type'		=>	'rental',
			'post_status'	=>	'publish',
			'numberposts'	=>	'-1',
			'meta_query'	=>	array(
				array(
					'key'		=>	'property_status',
					'value'		=>	'leased'
				)
			)
		)
	);

	if( ! empty( $all_posts ) ) {
		foreach( $all_posts as $single ) {

			$mod_time = get_post_meta( $single->ID, 'property_mod_date', true);
			$mod_time = epl_feedsync_format_date( $mod_time );
			$date          = new DateTime( $mod_time );
			$now           = new DateTime();

			if ( method_exists( $now, 'diff' ) ) {

				$diff = $now->diff( $date );
				$diff = $diff->days;
			} else {
				$diff = strtotime( $now->format( 'M d Y ' ) ) - strtotime( $date->format( 'M d Y ' ) );
				$diff = floor( $diff / 3600 / 24 );

			}

			if( $diff >= 14 ) {
				wp_update_post( array( 'ID'	=>	$single->ID, 'post_status'	=>	'draft' ) );
			}
		}
	}
}
