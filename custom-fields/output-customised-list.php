<?php
// Single Template customised output list
function epl_single_snapshot_items() {

	global $property;

	$item_array = array(
		'property_unique_id' 		=>	'Property ID',
		'property_price' 		=>	'Price',
		'property_category' 		=>	'Type',
		'property_authority' 		=>	'Contract',
		'property_auction' 		=>	'Auction Date',
		'property_auction_venue' 	=>	'Auction Venue',
		'property_auction_address' 	=>	'Location',
		'property_bedrooms' 		=>	'Bedrooms',
		'property_bathrooms' 		=>	'Bathrooms',
		'property_car_spaces' 		=>	'Car Spaces',
		'property_garage' 		=>	'Garage',
		'property_carport' 		=>	'Carport',
		'property_land_area' 		=>	'Land Size',
		'property_building_area' 	=>	'Building Size',
		'property_water_rates' 		=>	'Water Rates',
		'property_council_rates' 	=>	'Council Rates',
	);

	?>

	<div class="epl-snaphsot-items-wrapper">

		<?php foreach ( $item_array as $key=>$label ) {

			$value 		= $property->get_property_meta( $key );

			// Special Case Keys
			$special = array ( 'property_car_spaces' );

			if ( in_array( $key , $special ) ) {
				$value = true;
			}

			$disable_output = '';

			if ( $value ) { ?>

				<div class="epl-snapshot-item">

					<?php

					switch ( $key ) {

						case 'property_price':

							$label 		= $label;
							$value 		= $property->get_price_plain_value();

							break;

						case 'property_auction':

							$label 		= $label;
							$value 		= $property->get_property_auction();

							break;

						case 'property_authority':

							$label		= $label;
							$options 	= epl_get_property_authority_opts();
							$value 		= $options[$value];

							break;

						case 'property_car_spaces':

							$label 		= $label;
							$value 		= $property->get_property_parking('v');

							break;

						case 'property_land_area':

							$label 		= $label;
							$value 		= $property->get_property_land_value('v');

							break;

						case 'property_building_area':

							$label 		= $label;
							$value 		= $property->get_property_building_area_value('v');

							break;

						default :

							$label 		= $label;
							$value 		= $value;

							break;

					} ?>

					<?php if ( $disable_output != true ) { ?>

						<div class="epl-snapshot-label"><?php echo $label; ?></div>

						<div class="epl-snapshot-value"><?php echo $value; ?></div>

					<?php } ?>
				</div>
			<?php
			}

		} ?>

	</div>

<?php
}
add_action( 'epl_snapshot' , 'epl_single_snapshot_items' );