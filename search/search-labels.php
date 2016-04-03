<?php
/**
 * Customise the default 'Any' value in the search widget/shortcode
 *
 */

function rec_epl_search_widget_label_location() {
	$label = 'Suburbs';
	return $label;
}
add_filter( 'epl_search_widget_option_label_location' , 'rec_epl_search_widget_label_location' , 1 );
function rec_epl_search_widget_label_category() {
	$label = 'Property Type';
	return $label;
}
add_filter( 'epl_search_widget_option_label_category' , 'rec_epl_search_widget_label_category' );
function rec_epl_search_widget_label_price_from() {
	$label = 'Price From:';
	return $label;
}
add_filter( 'epl_search_widget_option_label_price_from' , 'rec_epl_search_widget_label_price_from' );
function rec_epl_search_widget_label_price_to() {
	$label = 'Price To:';
	return $label;
}
add_filter( 'epl_search_widget_option_label_price_to' , 'rec_epl_search_widget_label_price_to' );
function rec_epl_search_widget_label_bedrooms_min() {
	$label = 'Bed:';
	return $label;
}
add_filter( 'epl_search_widget_option_label_bedrooms_min' , 'rec_epl_search_widget_label_bedrooms_min' );
function rec_epl_search_widget_label_bedrooms_max() {
	$label = 'Bed Max:';
	return $label;
}
add_filter( 'epl_search_widget_option_label_bedrooms_max' , 'rec_epl_search_widget_label_bedrooms_max' );
function rec_epl_search_widget_label_bathrooms() {
	$label = 'Bath:';
	return $label;
}
add_filter( 'epl_search_widget_option_label_bathrooms' , 'rec_epl_search_widget_label_bathrooms' );
function rec_epl_search_widget_label_parking() {
	$label = 'Parking';
	return $label;
}
add_filter( 'epl_search_widget_option_label_carport' , 'rec_epl_search_widget_label_parking' );