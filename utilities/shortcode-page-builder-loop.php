<?php
/**
 * Load the Easy Property Listings Loop using a shortcode. For use in Page Buiders like Elementor, Divi, WP Bakery, Visual Composer.
 * Usage is [my_epl_search_results_loop]
 */

// Page Builder Archive / Search Results Loop
function my_epl_search_results_loop_callback() {

	ob_start(); ?>

	<?php if(have_posts()) : ?>
		
		<div class="epl-template-blog">
			<?php do_action( 'epl_property_loop_start' ); ?>

			<?php while(have_posts()) : the_post(); ?>
				<?php do_action( 'epl_property_blog' ); ?>
			<?php endwhile; ?>

			<?php do_action( 'epl_property_loop_end' ); ?>
		</div>

		<div class="loop-footer">
			<!-- Previous/Next page navigation -->
			<div class="loop-utility clearfix">
				<?php do_action('epl_pagination'); ?>
			</div>
		</div>

		<?php else : ?>

			<?php do_action( 'epl_property_search_not_found' ); ?>

		<?php endif; ?>

	<?php
		return ob_get_clean();

}
add_shortcode( 'my_epl_search_results_loop', 'my_epl_search_results_loop_callback' );
