<?php
/**
 * Remove and replace the epc button with a custom link from listing id - agentpro53
 *
 *
 */

//disable default epc button
remove_action('epl_buttons_single_property', 'epl_button_energy_certificate');

//New epc button
function my_epl_button_energy_certificate_hardcode_callback( ) {

       // $link = get_post_meta( get_the_ID() , 'property_energy_certificate' , true );

       $property_id = get_property_meta( 'property_unique_id' );

       $link = "http://USERNAME.agentpro53.co.uk/ipm/properties/epc_gen_v2/index.php?ref=$property_id";



       if( !empty($link) ) { ?>
               <button type="button" class="epl-button epl-energy-certificate" onclick="window.open('<?php echo $link; ?>')">
                       <?php
                               $label = apply_filters( 'epl_button_label_energy_certificate' , __('Energy Certificate', 'easy-property-listings') );
                       ?>
                       <?php echo $label ?>
               </button> <?php

        }

}
add_action('epl_buttons_single_property', 'my_epl_button_energy_certificate_hardcode_callback' , 10 , 2 );
