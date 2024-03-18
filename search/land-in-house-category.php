<?php
/**
 * Add the Land post type as a search House Category.
 */

// Add Land option in Property Category.
function my_epl_search_add_land( $fields ) {
	
	// Do not add to rental archive or a rent page.
	if ( is_post_type_archive( 'rental' ) || is_page('rent') ) {
		return $fields;
	}
	
	foreach($fields as $field_key   =>  &$field) {
		if($field['meta_key'] == 'property_category') {
			$field['options']['Land'] = __('Land','easy-property-listings');
		}
	}
	return $fields;
}
add_filter( 'epl_search_widget_fields_frontend', 'my_epl_search_add_land' );

// Add script to select Land Post type on selecting Category Land.
function my_epl_search_land_script() { ?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			// On select change.
			$('.epl-search-forms-wrapper #property_category').on('change', function(e) {
		        if( $(this).find(':selected').val() == 'Land' ) {
		        	$(this).closest('form').find('#post_type').val('land');
		        } else {
		        	$(this).closest('form').find('#post_type').val('property');
		        }
		    });
		});
	</script>
<?php
}
add_action( 'wp_footer', 'my_epl_search_land_script' );

// Unset Property category if Land is selected.
function my_epl_search_unset_land_property_category($query) {
	$meta_query = $query->get('meta_query');

	// Alter the query to include the land post type in the search.
	if ( $query->is_epl_search && isset( $_GET['property_category'] ) && $_GET['property_category'] == 'Land') {

		if( !empty( $meta_query ) ) :
		foreach($meta_query as $index => &$metakey) {
			if($metakey['key'] == 'property_category') {
				unset($meta_query[$index]);
			}
		}
		endif;
                //$post_types = (array) $query->get( 'post_type' );
                $post_types = 'land';
                $query->set('post_type',$post_types);
		$query->set('meta_query',$meta_query);
	}
}
add_filter( 'pre_get_posts', 'my_epl_search_unset_land_property_category' );

// Unset Property category if Land is selected.
function my_epl_search_include_land($query) {

	$meta_query = $query->get('meta_query');

	// Alter the search.
	if ( epl_is_search() ) {
		
                $post_types = (array) $query->get( 'post_type' );
                $post_types[] = 'land';
               
                $query->set('post_type',$post_types);
	}
}
add_filter( 'pre_get_posts', 'my_epl_search_include_land', 99 );
