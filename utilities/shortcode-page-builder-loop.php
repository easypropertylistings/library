<?php
/**
 * Page Builder Archive / Search Results Loop
 * Load the Easy Property Listings Loop using a shortcode. For use in Page Builders like Elementor, Divi, WP Bakery, Visual Composer.
 * Usage is [my_epl_search_results_loop]
 *
 * @since 1.0.0
 * @since 1.0.1 Corrected issue when not used on an archive page.
 */
function my_epl_search_results_loop_callback() {

	ob_start();

	if ( ( function_exists( 'epl_is_search' ) && true === epl_is_search() ) || ( function_exists( 'is_epl_core_post' ) && true === is_epl_core_post() ) ) {

		if ( have_posts() ) : ?>

		<div class="epl-template-blog">
			<?php do_action( 'epl_property_loop_start' ); ?>

			<?php while( have_posts() ) : the_post(); ?>
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

		<?php endif;
	}

	return ob_get_clean();

}
add_shortcode( 'my_epl_search_results_loop', 'my_epl_search_results_loop_callback' );
