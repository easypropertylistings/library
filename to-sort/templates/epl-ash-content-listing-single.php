<?php
/*
 * Single Property Template: Expanded
 *
 * @package easy-property-listings
 * @subpackage Theme
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'epl-listing-single epl-property-single view-expanded' ); ?>>

	<div class="entry-content epl-content epl-clearfix cus_epl_feature">
	
		<?php //do_action( 'epl_property_featured_image' ); ?>
		
		<?php do_action( 'epl_buttons_single_property' ); ?>

		<div class="tab-wrapper">
			<div class="epl-tab-section">
				<h5 class="tab-title"><?php echo apply_filters('property_tab_title',__('Property Details', 'epl')); ?></h5>
				<div class="tab-content">
					<div class="property-details">
						<?php do_action('epl_property_before_title'); ?>
						<h1 class="tab-address">
							<?php do_action('epl_property_address'); ?>
						</h1>
						<?php do_action('epl_property_after_title'); ?>
						<?php do_action('epl_property_land_category'); ?>
						<?php do_action('epl_property_price_content'); ?>
						<?php do_action('epl_property_commercial_category'); ?>
					</div>
					<div class="property-meta">
						<?php do_action('epl_property_available_dates');// meant for rent only ?>								
						<?php do_action('epl_property_inspection_times'); ?>
					</div>
				</div>
			</div>

			<div class="epl-tab-section">
				<h5 class="tab-title"><?php _e('Description', 'epl'); ?></h5>
				<div class="tab-content">
					<!-- heading -->
					<h2 class="entry-title"><?php do_action('epl_property_heading'); ?></h2>
			
					<h3 class="secondary-heading"><?php do_action('epl_property_secondary_heading'); ?></h3>
					<?php
						do_action('epl_property_content_before');
						
						the_content();
						
						do_action('epl_property_content_after');
					?>
				</div>
			</div>

			<?php do_action('epl_property_tab_section_before'); ?>
			<div class="epl-tab-section">
					<?php do_action('epl_property_tab_section'); ?>
			</div>
			<?php do_action('epl_property_tab_section_after'); ?>
			
			<?php do_action( 'epl_property_gallery' ); ?>
			
			<?php do_action( 'epl_property_map' ); ?>
			
			<?php do_action( 'epl_single_extensions' ); ?>
			
			
			<!-- Agent -->
			<?php /*?><?php
			if ( get_post_type() != 'rental' ) { ?>
				<div class="epl-tab-section">
					<h5 class="tab-title"><?php _e('Real Estate Agent', 'epl'); ?></h5>
					<div class="tab-content">
						<?php do_action( 'epl_single_author' ); ?>
					</div>
				</div>
			<?php } else { ?>
				<div class="epl-tab-section">
					<h5 class="tab-title"><?php _e('Property Manager', 'epl'); ?></h5>
					<div class="tab-content">
						<?php do_action( 'epl_single_author' ); ?>
					</div>
				</div>				
			<?php } ?><?php */?>
		</div>
	</div>
	<!-- categories, tags and comments -->
	<div class="entry-footer epl-clearfix">
		<div class="entry-meta">
			<?php wp_link_pages( array( 'before' => '<div class="entry-utility entry-pages">' . __( 'Pages:', 'epl' ) . '', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>		
		</div>
	</div>
</div>
<!-- end property -->
