<?php
/**
* Skip the Tenanted With Income feature on import.
**/

function epl_dont_remove_featured_selling_with_income( $term_taxonomy_ids, $tx_name, $pid, $import_id ) {

    // Only check features.
    if ( $tx_name == 'tax_feature' ){

        // Retrieve all currently assigned features.
        $txes_list = get_the_terms($pid, $tx_name);

        // Do nothing if no categories are set.
        if ( ! empty($txes_list) ){
           foreach ($txes_list as $cat){

                // If feature name is 'Tenanted With Income' add it to import.
                if ($cat->name == 'Tenanted With Income'){
                    $term_taxonomy_ids[] = $cat->term_taxonomy_id;
                    break;
                } 
            }
        }
    }

    // Return the updated list of taxonomies to import.
    return $term_taxonomy_ids;

}

add_filter( 'wp_all_import_set_post_terms', 'epl_dont_remove_featured_selling_with_income', 10, 4 );
