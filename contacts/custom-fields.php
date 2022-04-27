<?php

/**
 * Demo showing how to add a custom field - `heading` in contact widget and then saving it.
 */

function theme_epl_contact_capture_get_widget_fields( $fields ) {

        foreach( $fields as $key => &$field ) {


                // unset save button to add to last
                if( 'epl_contact_submit' == $field['id'] ) {

                        unset( $fields[$key] );
                }
        }

        // add extra fields
        $fields[] = [
                        'label'        => __( 'Heading', 'easy-property-listings' ),
			'name'         => 'epl_contact_heading',
			'id'           => 'epl_contact_heading',
			'type'         => 'text',
			'data-default' => 'on',
        ];

        // add submit field back
        $fields[] = [
                        'name'         => 'epl_contact_submit',
			'id'           => 'epl_contact_submit',
			'type'         => 'submit',
			'value'        => __( 'Submit', 'easy-property-listings' ),
			'data-default' => 'on',
        ];

        return $fields;
}

add_filter( 'epl_contact_capture_get_widget_fields', 'theme_epl_contact_capture_get_widget_fields' );

/**
 * Contact Form Callback - custom fields
 */
function theme_epl_contact_capture_form_callback( $form_data, $request ) {

	if ( isset( $request['epl_contact_anti_spam'] ) && ! empty( $attributes['submit'] ) ) {
		// spam.
		return;
	}

	$contact        = new EPL_contact( $request['epl_contact_email'] );
	$heading        = isset( $request['epl_contact_heading'] ) ? sanitize_text_field( $request['epl_contact_heading'] ) : '';

	if ( !empty( $contact->id ) ) {

		$contact->update_meta( 'epl_contact_heading', $heading );
	}
}

add_action( 'epl_form_builder_contact_capture_form', 'theme_epl_contact_capture_form_callback', 99, 2 );
