<?php
/**
 * Add an Australia option to the Phone field in Gravity forms.
 *
 * @see:           https://docs.gravityforms.com/gform_phone_formats/
 * @regex:         https://stackoverflow.com/questions/39990179/regex-for-australian-phone-number-validation
 * @regex_example: https://regex101.com/r/eiufOH/2
 */
function my_au_phone_format( $phone_formats ) {
    $phone_formats['au'] = array(
        'label'       => 'Australia',
        'mask'        => '9999 999 999',
        'regex'       => '/^(\+?\(61\)|\(\+?61\)|\+?61|\(0[1-9]\)|0[1-9])?( ?-?[0-9]){7,9}$/',
        'instruction' => 'Enter your mobile number.',
    );

    return $phone_formats;
}
add_filter( 'gform_phone_formats', 'my_au_phone_format' );