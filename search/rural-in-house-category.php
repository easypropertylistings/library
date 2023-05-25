<?php
/**
 * Add the Rural post type as a search House Category.
 */

// Add Rural option in Property Category.
function my_epl_search_add_rural( $fields ) {
	
	// Do not add to rental archive or a rent page.
	if ( is_post_type_archive( 'rental' ) || is_page('rent') ) {
		return $fields;
	}
	
	foreach($fields as $field_key   =>  &$field) {
		if($field['meta_key'] == 'property_category') {
			$field['options']['Rural'] = __('Rural','easy-property-listings');
		}
	}
	return $fields;
}
add_filter( 'epl_search_widget_fields_frontend', 'my_epl_search_add_rural' );

// Add script to select Rural Post type on selecting Category Rural.
function my_epl_search_rural_script() { ?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			// On select change.
			$('.epl-search-forms-wrapper #property_category').on('change', function(e) {
		        if( $(this).find(':selected').val() == 'Rural' ) {
		        	$(this).closest('form').find('#post_type').val('rural');
		        } else {
		        	$(this).closest('form').find('#post_type').val('property');
		        }
		    });
		});
	</script>
<?php
}
add_action( 'wp_footer', 'my_epl_search_rural_script' );

// Unset Property category if Rural is selected.
function my_epl_search_unset_rural_property_category($query) {
	$meta_query = $query->get('meta_query');
	
	// Alter the query to include the rural post type in the search.
	if ( epl_is_search() && isset( $_GET['property_category'] ) && $_GET['property_category'] == 'Rural') {

		if( !empty( $meta_query ) ) :
		foreach( $meta_query as $index => &$metakey ) {
			if( $metakey['key'] == 'property_category') {
				unset($meta_query[$index]);
			}
		}
		endif;
                //$post_types = (array) $query->get( 'post_type' );
                $post_types = 'rural';
                $query->set('post_type',$post_types);
		$query->set('meta_query',$meta_query);
	}
}
add_filter( 'pre_get_posts', 'my_epl_search_unset_rural_property_category' );

// Include rural in search results
function my_epl_search_include_rural($query) {

	$meta_query = $query->get('meta_query');

	// Alter the search.
	if ( epl_is_search() ) {
		
                $post_types = (array) $query->get( 'post_type' );
                $post_types[] = 'rural';
               
                $query->set('post_type',$post_types);
	}
}
add_filter( 'pre_get_posts', 'my_epl_search_include_rural', 99 );
