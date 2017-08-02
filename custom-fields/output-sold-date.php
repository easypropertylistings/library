<?php
/*
 * Output the sold date next to the price field
 */

function my_sold_date_test() {

    echo '<p>Sold Date Test</p>';

    $sale_date = get_property_meta('property_sold_date');

    echo $sale_date;

}
add_action( 'epl_property_price' , 'my_sold_date_test' );