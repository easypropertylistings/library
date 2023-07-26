<?php
/**
 * Refactor the Inspection times HTML.
 */


/**
 * Inspection Date Loader
 *
 * @since 1.0.0
 * @since 1.9.1
 */
function rec_custom_inspection_date_loader( $inspection_date ) {
	global $property;
	
	$formatted_date  = '';
	$inspection_date = explode( ' ', $inspection_date );
	
	$day       = isset($inspection_date[0]) ? $inspection_date[0] : '';
	$day       = str_replace(',','',$day);
	
	$date      = isset($inspection_date[1]) ? $inspection_date[1] : '';
	$remove    = array('st','nd','rd','th');
	//$date    = str_replace($remove,'',$date);
	
	$month      = isset( $inspection_date[2]) ? $inspection_date[2]  : '';
	
	$time_start = isset($inspection_date[3]) ? $inspection_date[3].' '.$inspection_date[4] : '';
	
	$time_end   = isset( $inspection_date[6]) ? $inspection_date[6].' '.$inspection_date[7] : '';
	
	$label_home_open = $property->get_epl_settings( 'label_home_open' );
	$label_home_open = apply_filters( 'epl_inspection_times_label', $label_home_open );
	
	return get_defined_vars();
}

/**
 * Customise Inspection Times
 *
 * @since 1.0.0
 * @since 1.9.1
 */
function rec_custom_inspection_format_global( $inspection_date ) {
	
	$variables = rec_custom_inspection_date_loader( $inspection_date );

	$attributes = [
		'label_home_open' => $variables['label_home_open'],
		'month'           => $variables['month'],
		'day'             => $variables['day'],
		'date'            => $variables['date'],
		'time_start'      => $variables['time_start'],
		'time_end'        => $variables['time_end'],
		'separator'       => ' to ',
		//'icon'            => 'fas fa-calendar',
		'icon'            => 'rec-icon rec-icon-calendar',
	];

	if ( is_single() ) {
		return rec_inspection_format_option_date_year_time( $attributes );
	} else {
		return rec_inspection_format_option_date_year_time( $attributes );
	}
	
}
add_filter( 'epl_inspection_format', 'rec_custom_inspection_format_global', 20 );

/**
 * Formats Like
 *
 * Friday 05th August 2023 
 * 12:00 pm - 01:00 pm
 *
 * @since 1.9.1
 */
function rec_inspection_format_option_date_year_time( $attributes ) {
	
	$year = date( 'Y' );
	
	ob_start();
	
	?>
	
	<div class="epl-inspection__card epl-inspection__card--date-time">
		<div class="epl-inspection__item epl-inspection__item__all">
			<div class="epl-inspection_line">
				<span class="epl-inspection__item__date"><?php echo esc_html( $attributes['day'] ) . ', ' . esc_html( $attributes['date'] ) .  ' ' . esc_html( $attributes['month'] ) .' '. esc_html( $year ); ?></span>
			</div>
			<div class="epl-inspection_line">
				<span class="epl-inspection__item__time"><?php echo esc_html( $attributes['time_start'] ) . esc_html( $attributes['separator'] ) . esc_html( $attributes['time_end'] ); ?></span>
			</div>
		</div>
	</div>
	
	<?php return ob_get_clean();

}
