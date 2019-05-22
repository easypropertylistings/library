<?php
/**
 * Listing shortcode sorted in following order :
 - Current
 - Current ( Under Offer )
 - Sold
 * @param  [type] $query [description]
 * @return [type]        [description]
 */
function epl_alter_orderby($query) {

	if( !$query->is_main_query() && in_array('property', (array) $query->get('post_type') ) ) {

		$meta_query = $query->get('meta_query');
		$meta_query['property_status_clause'] = array(
			'key'		=>	'property_status',
			'value'		=>	'',
			'compare'	=>	'!='
		);
		$query->set('meta_query',$meta_query);
		$query->set('meta_key','property_under_offer');
		$query->set('orderby', array('property_status_clause' => 'ASC','property_under_offer' => 'ASC'));

	}
}
add_action('pre_get_posts','epl_alter_orderby',99);