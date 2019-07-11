<?php
// alphabatically sort listings in shortcode
function theme_epl_archive_sorting($query) {

	if( $query->is_main_query() ){
		return;
	}

	
	if( in_array( 'rental', $query->get('post_type') )  ){ 

		$query->set( 'orderby', 'post_title' );
		$query->set( 'order', 'ASC' );
		$query->set( 'posts_per_page', -1 );
		
	}
	
}

add_action('pre_get_posts','theme_epl_archive_sorting',99);
