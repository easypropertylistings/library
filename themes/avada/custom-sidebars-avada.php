<?php
/*
 * Avada Archive Page tempalte with custom side bars
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>
<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>
	<?php if ( category_description() ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'fusion-archive-description' ); ?>
			<div class="post-content">
				<?php echo category_description(); ?>
			</div>
		</div>
	<?php endif; ?>

	<?php //get_template_part( 'templates/blog', 'layout' ); ?>


		<div class="entry-content loop-content">
			<?php //do_action( 'epl_property_loop_start' ); ?>
			<?php while ( have_posts() ) : // The Loop
					the_post();
					do_action('epl_property_blog');
				endwhile; // end of one post
			?>
			<?php do_action( 'epl_property_loop_end' ); ?>

			<div class="loop-utility clearfix">
				<?php do_action('epl_pagination'); ?>
			</div>
		</div>





	<?php
		echo '<div id="sidebar" class="sidebar fusion-widget-area fusion-content-widget-area" style="float: right;">';

			$post_type = get_post_type();

			if ( $post_type == 'property' ) {
				generated_dynamic_sidebar('avada-custom-sidebar-propertysidebar');

			} elseif ( $post_type == 'rental' ) {
				generated_dynamic_sidebar('avada-custom-sidebar-propertysidebar'); // Replace for each custom sidebar

			} elseif ( $post_type == 'land' ) {
				generated_dynamic_sidebar('avada-custom-sidebar-propertysidebar'); // Replace for each custom sidebar

			} elseif ( $post_type == 'commercial' ) {
				generated_dynamic_sidebar('avada-custom-sidebar-propertysidebar'); // Replace for each custom sidebar

			} else {
				generated_dynamic_sidebar('avada-custom-sidebar-propertysidebar'); // Replace for each custom sidebar
			}

		echo '</div>';


		//$sidebars = $GLOBALS['wp_registered_sidebars'];

		//print_r ($sidebars);

	?>


</div>
<?php //do_action( 'avada_after_content' ); ?>

<?php get_footer();

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
