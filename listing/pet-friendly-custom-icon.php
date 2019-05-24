<?php
/**
 * Add a custom pet Friendly icon to the bed bath car icons section
 *
 * @requires EPL 3.3
 *
 */

// Alter the default icons that are output
function my_add_pets( $defaults ) {

	$defaults = array( 'bed','bath','parking','ac','pool' , 'pets' );

	return $defaults;

}
add_filter( 'epl_get_property_icons' , 'my_add_pets' );

// Return the new pet icon
function my_custom_paw_icon_callback() {

	global $property;

	echo $property->get_property_pets( 'i' );

}
add_action( 'epl_get_property_icon_pets' , 'my_custom_paw_icon_callback' );

// Alter the returned icon output to be a custom SVG icon
function my_pet_svg_icon( $return,$returntype,$value,$label ) {


	$return = '<div class="epl-icon-svg-container epl-icon-container-pet">
			<div class="epl-icon epl-icon-svg pet" title="Pet Friendly">
				<?xml version="1.0" encoding="iso-8859-1"?>
				<!-- Generator: Adobe Illustrator 18.1.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
				<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 48.839 48.839" style="enable-background:new 0 0 48.839 48.839;" xml:space="preserve">
				<g>
					<path style="fill:#030104;" d="M39.041,36.843c2.054,3.234,3.022,4.951,3.022,6.742c0,3.537-2.627,5.252-6.166,5.252
						c-1.56,0-2.567-0.002-5.112-1.326c0,0-1.649-1.509-5.508-1.354c-3.895-0.154-5.545,1.373-5.545,1.373
						c-2.545,1.323-3.516,1.309-5.074,1.309c-3.539,0-6.168-1.713-6.168-5.252c0-1.791,0.971-3.506,3.024-6.742
						c0,0,3.881-6.445,7.244-9.477c2.43-2.188,5.973-2.18,5.973-2.18h1.093v-0.001c0,0,3.698-0.009,5.976,2.181
						C35.059,30.51,39.041,36.844,39.041,36.843z M16.631,20.878c3.7,0,6.699-4.674,6.699-10.439S20.331,0,16.631,0
						S9.932,4.674,9.932,10.439S12.931,20.878,16.631,20.878z M10.211,30.988c2.727-1.259,3.349-5.723,1.388-9.971
						s-5.761-6.672-8.488-5.414s-3.348,5.723-1.388,9.971C3.684,29.822,7.484,32.245,10.211,30.988z M32.206,20.878
						c3.7,0,6.7-4.674,6.7-10.439S35.906,0,32.206,0s-6.699,4.674-6.699,10.439C25.507,16.204,28.506,20.878,32.206,20.878z
						 M45.727,15.602c-2.728-1.259-6.527,1.165-8.488,5.414s-1.339,8.713,1.389,9.972c2.728,1.258,6.527-1.166,8.488-5.414
						S48.455,16.861,45.727,15.602z"/>
				</g>
				</svg>
			</div>
		</div>';

	return $return;

}
add_filter( 'epl_get_property_pet_friendly' , 'my_pet_svg_icon',10,4);
