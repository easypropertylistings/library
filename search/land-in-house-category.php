<?php
// General Functions

//Add Land option in Property Category
function epl_search_field_customizations($fields) {
  foreach($fields as $field_key   =>  &$field) {
  	  if($field['meta_key'] == 'property_category') {
         $field['options']['Land'] = __('Land','easy-property-listings');
        }       
  }
  
  return $fields;
}
add_filter('epl_search_widget_fields_frontend','epl_search_field_customizations');

//Add script to select Land Posttype on selecting Category Land
function rec_search_script() { ?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {

		    //On select change
			$('.epl-search-forms-wrapper #property_category').on('change', function(e) {
		        if( $(this).find(':selected').val() == 'Land' ) {
		            $(this).closest('form').find('#post_type').val('land');
		        } else {
		        	$(this).closest('form').find('#post_type').val('property');
		        }

		    });
		});
	</script>
<?php }
add_action('wp_footer','rec_search_script');


//Unset Property category if Land is selected
function rec_unset_property_category($query) {
   $meta_query = $query->get('meta_query');
    // Do nothing if in dashboard or not an archive page
    
    if (epl_is_search() && $_GET['property_category'] == 'Land') {
        
        if( !empty( $meta_query ) ) :
        foreach($meta_query as $index => &$metakey) {
            if($metakey['key'] == 'property_category') {
                
               unset($meta_query[$index]);
            }
        }
        endif;
        
        $query->set('meta_query',$meta_query);
    }
}
add_filter('pre_get_posts','rec_unset_property_category');
