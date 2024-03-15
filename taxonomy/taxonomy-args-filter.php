<?php
/**
 * Disable the archive pages for taxonomies
 *
 */


/**
 * Location taxonomy args.
 *
 * @param array  $args     Taxonomy options.
 * @param string $taxonomy Taxonomy name.
 *
 * @return
 */
function my_epl_location_taxonomy_args( $args, $taxonomy ) {

    if ( 'location' !== $taxonomy ) {
	return $args;
    }

    $args['public'] = false;

    return $args;
}
add_filter( 'register_taxonomy_args', 'my_epl_location_taxonomy_args', 10, 2 );

/**
 * Features taxonomy args.
 *
 * @param array  $args     Taxonomy options.
 * @param string $taxonomy Taxonomy name.
 *
 * @return
 */
function my_epl_feature_taxonomy_args( $args, $taxonomy ) {

    if ( 'tax_feature' !== $taxonomy ) {
	return $args;
    }

    $args['public'] = false;

    return $args;
}
add_filter( 'register_taxonomy_args', 'my_epl_feature_taxonomy_args', 10, 2 );
