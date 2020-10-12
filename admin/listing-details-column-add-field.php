<?php
/**
 * Add a Custom Field value in admin to Listing Details column when viewing listings
 *
 */

// Display Frontage IN admin Details Column
function my_frontage_epl_manage_listing_column_listing() {
	global $property;

	$value = $property->get_property_meta('property_frontage');

	if ( $value ) {
		?>
		<div class="epl_meta_frontage_details">
			<span class="epl_meta_land"><?php echo esc_html( $value); ?></span>
			<span class="epl_meta_land_unit">meter</span>
		</div>

		<?php
	}
}
add_action( 'epl_manage_listing_column_listing', 'my_frontage_epl_manage_listing_column_listing' );