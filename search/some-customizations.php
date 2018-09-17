function my_rental_property_filter($query) {

    // Do nothing if is dashboard/admin or doing search
    if ( is_admin() )
        return;

    // The query to exclude a taxonomy eg. projects from archive listings
    $tax_query = $query->get('tax_query');

    $tax_query[] = array(
        'taxonomy'=>'tax_feature',
        'terms'   => array('projects'),
        'field'    => 'slug',
        'operator' => 'NOT IN'
    );

    if ( $query->is_epl_search ) {

        //sort sold listings by sold date
        if ($_GET['property_search_cat'] == 'sold') {

            // The query to sort sold listings by DESC sold date
            $query->set( 'meta_key', 'property_sold_date' );
            $query->set( 'orderby', 'meta_value' );
            $query->set( 'order', 'DESC' );
        }
		     //sort leased listings by leased date
		    if ($_GET['property_search_cat'] == 'leased') {

            // The query to sort sold listings by DESC rental date
            $query->set( 'meta_key', 'property_date_available' );
            $query->set( 'orderby', 'meta_value' );
            $query->set( 'order', 'DESC' );
        }

        if (($_GET['property_search_cat'] == 'buy') && ($_GET['property_category'] !== 'Land' ) ) { 

            $query->set('post_type',array('property','land'));
            $query->set( 'orderby', 'date' );
            $query->set( 'order', 'DESC' );
        }

        //if property category is land,post type will be land
        //unset property category
        if ($_GET['property_category'] == 'Land' ) {

            $query->set('post_type', 'land');
            $query->query['post_type'] = 'land';
            $query->set( 'orderby', 'date' );
            $query->set( 'order', 'DESC' );

            $mq = $query->get('meta_query');

            foreach($mq as $mqk => &$mqd) {
                if($mqd['key'] == 'property_category') {
                    unset($mq[$mqk]);
                }
            }
            $query->set('meta_query',$mq);

        }
        
        //tax query for excluding projects
        $query->set('tax_query',$tax_query);
         
        return;
    }
}
add_action( 'pre_get_posts', 'my_rental_property_filter' , 99  );
