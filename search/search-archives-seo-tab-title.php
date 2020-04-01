<?php
/**
 * Alter the browser tab title of search results
 *
 */
function my_customise_search_results_title( $title_parts_array ) {
	if ( function_exists( 'is_epl_search' ) ) {
		if ( is_epl_search() ) {
			$title_parts_array['title']      = 'Custom Page Title'; // Title of the viewed page.
			// $title_parts_array['page']    = 'Page'; // Optional // Page number if paginated.
			// $title_parts_array['tagline'] = 'Tagline'; // Optional. Site description when on home page.
			// $title_parts_array['site']    = 'Custom Page Title'; // Optional. Site title when not on home page.
		}
	}
	return $title_parts_array;
}
add_filter( 'document_title_parts', 'my_customise_search_results_title' );
