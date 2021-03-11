<?php
/**
 * Dynamically output custom fields based on an array and using a switch to control output.
 *
 */

// Features
function my_epl_property_content_after_callback() {

	global $property;
	?>
	<div class="rec-property-availabilities-background-wrapper">
		<div class="rec-property-availabilities-outer-wrapper">
			<div class="rec-property-availabilities">

				<h4>Property Availabilities</h4>

				<ul>
				<?php
					$values = [
						[
							'key'   => 'property_min_available_sqft',
							'label' => 'Minimum Available SQFT',
							'type'  => 'number',
						],
						[
							'key'   => 'property_max_contiguous_sqft',
							'label' => 'Max Contiguous SQFT',
							'type'  => 'number',
						],
						[
							'key'   => 'property_total_gla',
							'label' => 'Total GLA',
							'type'  => 'number',
						],
						[
							'key'   => 'property_type',
							'label' => 'Type',
							'type'  => 'text',
						],
					];

					foreach ( $values as $value ) {

						$result = $property->get_property_meta( $value['key'] );

						if ( $result ) {

							switch (  $value['type'] ) {
								case 'number':
									$result = number_format_i18n( $result, 2 );
									break;
								case 'text':
									$result = ucfirst( $result );
									break;
							}

							?>
							<li class="epl-item epl-<?php echo esc_attr( $value['key'] ); ?>">
								<span class="epl-label"><?php echo esc_html( $value['label'] ); ?></span> <span class="epl-value"><?php echo esc_html( $result ); ?></span>
							</li>
							<?php
						}
					}
				?>
				</ul>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'epl_property_content_after', 'my_epl_property_content_after_callback' );