<?php
/**
 * Add the commercial post type as a search House Category.
 */

// Add commercial option in Property Category.
function my_epl_search_add_commercial( $fields, $post_type ) {
	
	// Do not add to rental archive or a rent page.
	if ( is_post_type_archive( 'rental' ) || is_page('rent') || 'rental' == $post_type ) {
		return $fields;
	}
	
	foreach($fields as $field_key   =>  &$field) {
		if($field['meta_key'] == 'property_category') {
			$field['options']['Commercial'] = __('Commercial','easy-property-listings');
		}
	}
	return $fields;
}
add_filter( 'epl_search_widget_fields_frontend', 'my_epl_search_add_commercial', 10, 2 );

// Add script to select commercial Post type on selecting Category commercial.
function my_epl_search_commercial_script() { ?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			// On select change.
			$('.epl-search-forms-wrapper #property_category').on('change', function(e) {
			if( $(this).find(':selected').val() == 'Commercial' ) {
				$(this).closest('form').find('#post_type').val('commercial');
			} else {
				$(this).closest('form').find('#post_type').val('property');
			}
		    });
		});
	</script>
<?php
}
add_action( 'wp_footer', 'my_epl_search_commercial_script' );

// Unset Property category if commercial is selected.
function my_epl_search_unset_commercial_property_category($query) {
	$meta_query = $query->get('meta_query');

	// Alter the query to include the commercial post type in the search.
	if ( $query->is_epl_search && isset( $_GET['property_category'] ) && $_GET['property_category'] == 'Commercial') {

		if( !empty( $meta_query ) ) :
		foreach($meta_query as $index => &$metakey) {
			if($metakey['key'] == 'property_category') {
				unset($meta_query[$index]);
			}
		}
		endif;
		//$post_types = (array) $query->get( 'post_type' );
		$post_types = 'commercial';
		$query->set('post_type',$post_types);
		$query->set('meta_query',$meta_query);
	}
}
add_filter( 'pre_get_posts', 'my_epl_search_unset_commercial_property_category' );

// Unset Property category if commercial is selected.
function my_epl_search_include_commercial($query) {

	$meta_query = $query->get('meta_query');

	// Alter the search.
	if ( epl_is_search() && isset( $_GET['property_category'] ) && $_GET['property_category'] == 'Commercial' ) {
		
		$post_types = (array) $query->get( 'post_type' );
		$post_types[] = 'commercial';
	       
		$query->set('post_type',$post_types);
	}
}
add_filter( 'pre_get_posts', 'my_epl_search_include_commercial', 99 );
