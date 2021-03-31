<?php
/**
 * Output the sold date next to the price field.
 *
 * PHP Date/Time Format: https://www.php.net/manual/en/datetime.format.php
 */
function my_sold_date_test() {

    echo '<p>Sold Date Test</p>';

    $sale_date = get_property_meta('property_sold_date');

    $php_date_format = 'j F, Y';
    $formatted_date  = date( $php_date_format, strtotime( $sale_date ) );

    echo $formatted_date;

}
add_action( 'epl_property_price' , 'my_sold_date_test' );
