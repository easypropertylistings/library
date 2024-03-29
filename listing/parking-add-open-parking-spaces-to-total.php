<?php
/**
 * Add open parking spaces to parking icons total.
 * Helps with AgentBox using the total parking spaces.
 *
 * @requires Easy Property Listings 3.4.21
 *
 */
function my_epl_add_open_parking_spaces_callback( $parking_total ) {
    global $property;

    $open_spaces = intval ( $property->get_property_meta( 'property_open_spaces' ) );

    $parking_total = $parking_total + $open_spaces;

    return $parking_total;

}
add_filter( 'epl_total_parking_spaces', 'my_epl_add_open_parking_spaces_callback' );
