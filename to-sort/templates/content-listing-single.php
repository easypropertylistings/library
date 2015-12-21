<?php
/*
 * Single Property Template: Expanded
 *
 * @package easy-property-listings
 * @subpackage Theme
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'epl-listing-single epl-property-single view-expanded' ); ?>>
	<div class="entry-header epl-header epl-clearfix">
			<div class="entry-col property-heading-left property-details">
				<h2 class="entry-title"><?php do_action('epl_property_heading'); ?></h2>
			</div>
	
			<div class="entry-col property-price-right property-pricing-details">
			
				<?php do_action('epl_property_price_before'); ?>
				<div class="property-meta pricing">
					<?php do_action('epl_property_price'); ?>
				</div>
				<?php do_action('epl_property_price_after'); ?>
			</div>
	</div>

	<div class="entry-content epl-content epl-clearfix">
	
		<?php // do_action( 'epl_property_featured_image' ); ?>
		
		<?php // do_action( 'epl_buttons_single_property' ); ?>

		<div class="tab-wrapper">

			<div class="epl-tab-section epl-section-description">
				<div class="tab-content">
								
					<?php do_action('epl_property_content_before'); ?>
						
					<?php the_content(); ?>
					<div id="rec-epl-video-container">
						<?php do_action('epl_property_content_after'); ?>
					</div>
				</div>
			</div>

			<?php do_action('epl_property_tab_section_before'); ?>
			<div class="epl-tab-section epl-tab-section-features">
				<?php do_action('epl_property_tab_section'); ?>
			</div>
			
				<?php do_action('epl_property_tab_section_after'); ?>

			<?php do_action( 'epl_property_gallery' ); ?>
			
			<?php do_action( 'epl_property_map' ); ?>
			
			<?php do_action( 'epl_single_extensions' ); ?>
			
			<!-- Agent -->
			<?php // do_action( 'epl_single_author' ); ?>

		</div>
		<?php //do_action('epl_property_address'); ?>
		<?php //do_action('epl_property_land_category'); ?>
		<?php //do_action('epl_property_price_content'); ?>
		<?php //do_action('epl_property_commercial_category'); ?>
		<?php //do_action('epl_property_available_dates');// meant for rent only ?>								
		<?php // do_action('epl_property_inspection_times'); ?>

	</div>
	<!-- categories, tags and comments -->
	<div class="entry-footer epl-clearfix">
		<div class="entry-meta">
			<?php wp_link_pages( array( 'before' => '<div class="entry-utility entry-pages">' . __( 'Pages:', 'epl' ) . '', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>		
		</div>
	</div>
</div>
<!-- end property -->