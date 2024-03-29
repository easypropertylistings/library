<?php
/**
 * Add the Business post type as a search House Category.
 */

// Add Business option in Property Category.
function my_epl_search_add_business( $fields ) {
	foreach($fields as $field_key   =>  &$field) {
		if($field['meta_key'] == 'property_category') {
			$field['options']['Business'] = __('Business','easy-property-listings');
		}
	}
	return $fields;
}
add_filter( 'epl_search_widget_fields_frontend', 'my_epl_search_add_business' );

// Add script to select Business Post type on selecting Category > Business.
function my_epl_search_business_script() { ?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			// On select change.
			$('.epl-search-forms-wrapper #property_category').on('change', function(e) {
			if( $(this).find(':selected').val() == 'Business' ) {
				$(this).closest('form').find('#post_type').val('business');
			} else {
				$(this).closest('form').find('#post_type').val('property');
			}
		    });
		});
	</script>
<?php
}
add_action( 'wp_footer', 'my_epl_search_business_script' );

// Unset Property category if Business is selected.
function my_epl_search_unset_business_property_category($query) {
	$meta_query = $query->get('meta_query');

	// Do nothing if in dashboard or not an archive page.
	if (epl_is_search() && isset( $_GET['property_category'] ) && $_GET['property_category'] == 'Business') {

		if( !empty( $meta_query ) ) :
		foreach($meta_query as $index => &$metakey) {
			if($metakey['key'] == 'property_category') {
				unset($meta_query[$index]);
			}
		}
		endif;
		//$post_types = (array) $query->get( 'post_type' );
		$post_types = 'business';
		$query->set('post_type',$post_types);
		$query->set('meta_query',$meta_query);
	}
}
add_filter( 'pre_get_posts', 'my_epl_search_unset_business_property_category' );

// Unset Property category if Business is selected.
function my_epl_search_include_business($query) {

	$meta_query = $query->get('meta_query');

	// Do nothing if in dashboard or not an archive page.
	if ( epl_is_search() ) {
		
		$post_types = (array) $query->get( 'post_type' );
		$post_types[] = 'business';
	       
		$query->set('post_type',$post_types);
	}
}
add_filter( 'pre_get_posts', 'my_epl_search_include_business', 99 );
