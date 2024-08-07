<?php
/**
 * Register and create a dashboard widget displaying the registered image sizes.
 *
*/

/**
 * WordPress Dashboard widget with all image sizes in Admin
 */
function my_rec_register_imagesizes_dashboard_widget() {
	global $wp_meta_boxes;
	
	wp_add_dashboard_widget(
		'imagesizes_dashboard_widget',
		'Registered Image Sizes',
		'my_rec_imagesizes_dashboard_widget_display'
	);
	
	$dashboard  = $wp_meta_boxes['dashboard']['normal']['core'];
	$new_widget = array( 'imagesizes_dashboard_widget' => $dashboard['imagesizes_dashboard_widget'] );
	unset( $dashboard['imagesizes_dashboard_widget'] );
	
	$sorted_dashboard = array_merge( $new_widget, $dashboard );
	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action( 'wp_dashboard_setup', 'my_rec_register_imagesizes_dashboard_widget' );
    
/**
 * Display registered image sizes.
 *
 * @return void render the image sizes.
 */
function my_rec_imagesizes_dashboard_widget_display() {
	
	if ( function_exists( 'wp_get_registered_image_subsizes' ) ) {
		$sizes = wp_get_registered_image_subsizes();
		?>
		<ul>
			<?php
			foreach( $sizes as $name => $values) {
				?>
				<li>
					<strong><?php echo esc_html( $name ); ?>:</strong>
					<span>width: <?php echo esc_html( $values['width'] ); ?>px</span>
					<span>height: <?php echo esc_html( $values['height'] ); ?>px</span>
				<?php
				if ( $values['crop'] === true ){
					?>
					<span>, cropped</span>
					<?php
				}
				?>
				</li>
				<?php
			}
			?>
		</ul>
		<?php
	}
	
}


/**
 * The following function is run late in order to disable the majority of images registered by WordPress, themes and plugins. 
 * Once you disable the images, use a plugin like Force Regenerate Thumbnails to delete and re-process all site images.
 */
function my_rec_remove_image_sizes() {
	remove_image_size( '1536x1536' );             // 2 x Medium Large (1536 x 1536), registered by WordPress
	remove_image_size( '2048x2048' );             // 2 x Large (2048 x 2048), registered by WordPress
	remove_image_size( 'et-pb-portfolio-image' ); // Divi theme.
	remove_image_size( 'et-pb-portfolio-module-image' ); // Divi theme.
	remove_image_size( 'et-pb-portfolio-image-single' ); // Divi theme.
	remove_image_size( 'et-pb-gallery-module-image-portrait' ); // Divi theme.
	// remove_image_size( 'et-pb-post-main-image-fullwidth-large' ); // Used with blog posts
	remove_image_size( 'et-pb-image--responsive--desktop' ); // Divi theme.
	remove_image_size( 'et-pb-image--responsive--tablet' ); // Divi theme.
	remove_image_size( 'et-pb-image--responsive--phone' ); // Divi theme.
}
add_action( 'init', 'my_rec_remove_image_sizes', 800 );
