<?php
/**
 * Replace single listing images with your own customised version. Fallback featured image.
 *
 */

// Disable the default single listing image actions, needs to be hooked in early on the wp hook
function my_remove_default_image_filter() {
	remove_action( 'epl_property_featured_image' , 'epl_property_featured_image' );
	remove_action( 'epl_single_featured_image' , 'epl_property_featured_image' );
}
add_action('wp', 'my_remove_default_image_filter');


// Customised Featured Image, alter as needed
function my_epl_property_featured_image( $image_size = 'index_thumbnail' , $image_class = 'index-thumbnail' ) {
	if ( has_post_thumbnail() ) { ?>
		<div class="entry-image">

			<h2>CUSTOM Image: Alter as needed</h2>

			<div class="epl-featured-image it-featured-image">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $image_size , array( 'class' => $image_class ) ); ?>
				</a>
			</div>
		</div>
	<?php }
}
add_action( 'epl_property_featured_image' , 'my_epl_property_featured_image' , 10 , 2);
add_action( 'epl_single_featured_image' , 'my_epl_property_featured_image' , 10 , 2 );
