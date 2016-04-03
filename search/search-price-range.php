<?php
/**
 * Customise the search price range in the search widget/shortcode
 *
 */

function rec_epl_listing_search_price_sale_range() {
    // Check to make sure Easy Property Listings is active
    // so that the epl_currency_formatted_amount function works
    if ( ! class_exists( 'Easy_Property_Listings' ) ) {
        return;
    }

    $prices_arr = array(
        100000    =>   epl_currency_formatted_amount(100000),
        150000    =>   epl_currency_formatted_amount(150000),
        250000    =>   epl_currency_formatted_amount(250000),
        300000    =>   epl_currency_formatted_amount(300000),
        350000    =>   epl_currency_formatted_amount(350000),
        400000    =>   epl_currency_formatted_amount(400000),
        450000    =>   epl_currency_formatted_amount(450000),
        500000    =>   epl_currency_formatted_amount(500000),
        550000    =>   epl_currency_formatted_amount(550000),
        600000    =>   epl_currency_formatted_amount(600000),
        650000    =>   epl_currency_formatted_amount(650000),
        700000    =>   epl_currency_formatted_amount(700000),
        750000    =>   epl_currency_formatted_amount(750000),
        800000    =>   epl_currency_formatted_amount(800000),
        850000    =>   epl_currency_formatted_amount(850000),
        900000    =>   epl_currency_formatted_amount(900000),
        950000    =>   epl_currency_formatted_amount(950000),
        1000000   =>   epl_currency_formatted_amount(1000000),
        1500000   =>   epl_currency_formatted_amount(1500000),
        10000000   =>   epl_currency_formatted_amount(10000000) . '+',

    );
    return $prices_arr;
}
add_filter( 'epl_listing_search_price_sale' , 'rec_epl_listing_search_price_sale_range' );