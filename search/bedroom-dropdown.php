<?php
/**
 * Customise the bedroom minimum dropdown range
 *
 */

function rec_epl_search_custom_range_bedrooms_min() {
    $range = array(
        '1'     =>   '1+',
        '2'     =>   '2+',
        '3'     =>   '3+',
        '4'     =>   '4+',
    );
    return $range;
}
add_filter( 'epl_listing_search_bed_select_min' , 'rec_epl_search_custom_range_bedrooms_min' );