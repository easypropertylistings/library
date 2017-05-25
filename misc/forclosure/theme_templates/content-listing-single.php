<?php
/*
 * Single Property Template: Expanded
 *
 * @package     EPL
 * @subpackage  Templates/Content
 * @copyright   Copyright (c) 2015, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

global $property;
$status = ucwords($property->get_property_meta('property_status'));

if (!empty($property->get_property_meta('property_authority'))){
	if ($property->get_property_meta('property_authority') == 'auction') {
		$auction = __('1st Auction','easy-property-listings');
	} elseif ($property->get_property_meta('property_authority') == 'auction_2') {
		$auction = __('2nd Auction','easy-property-listings');
	}	
} else {
	$auction = __('Not Available','easy-property-listings');
} ?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'epl-listing-single epl-property-single view-expanded' ); ?>>
	<div class="entry-header epl-header epl-clearfix">
		<div class="title-meta-wrapper">
			<div class="entry-col epl-property-details property-details">

				<?php do_action('epl_property_before_title'); ?>
				<h1 class="entry-title">
					<?php //do_action('epl_property_title');
						do_action('epl_property_custom_title'); ?>
				</h1>
				<?php do_action('epl_property_after_title'); ?>

			</div>

			<div class="entry-col property-pricing-details">

				<?php do_action('epl_property_price_before'); ?>
				<div class="epl-property-meta property-meta pricing">
					<div class="epl-bid-line">
						<?php echo __('Status : ','easy-property-listings').$status.' | '.__('Auction Type : ','easy-property-listings').$auction; ?>
					</div>
					<div class="epl-bid-line">
						<?php //do_action('epl_property_price');
						echo __('Opening Bid : ','easy-property-listings').epl_currency_formatted_amount($property->get_property_meta('property_custom_opening_bid')); ?>
					</div>
					<div class="epl-bid-line">
						<?php //do_action('epl_property_price');
						echo __('Current Max Bid : ','easy-property-listings').epl_currency_formatted_amount($property->get_property_meta('property_custom_current_bid')); ?>
					</div>
				</div>
				<?php do_action('epl_property_price_after'); ?>
				<div class="epl-property-featured-icons property-feature-icons epl-clearfix">
					<?php do_action('epl_property_icons'); ?>
				</div>

			</div>
		</div>
	</div>

	<div class="entry-content epl-content epl-clearfix">

		<?php do_action( 'epl_property_featured_image' ); ?>

		<?php do_action( 'epl_buttons_single_property' ); ?>

		<div class="epl-tab-wrapper tab-wrapper">

			<!--

			<div class="epl-tab-section epl-section-property-details">
				<h5 class="epl-tab-title tab-title"><?php echo apply_filters('property_tab_title',__('Property Details', 'easy-property-listings' )); ?></h5>
				<div class="epl-tab-content tab-content">
					<div class="epl-property-address property-details">
						<h3 class="epl-tab-address tab-address">
							<?php do_action('epl_property_address'); ?>
						</h3>
						<?php do_action('epl_property_land_category'); ?>
						<?php do_action('epl_property_price_content'); ?>
						<?php do_action('epl_property_commercial_category'); ?>
					</div>
					<div class="epl-property-meta property-meta">
						<?php do_action('epl_property_available_dates');// meant for rent only ?>
						<?php do_action('epl_property_inspection_times'); ?>
					</div>
				</div>
			</div>
			-->


			<div class="epl-tab-section epl-section-description">
				<div class="epl-tab-content tab-content">
					<?php
						do_action('epl_property_content_before');

						do_action('epl_property_the_content');

						do_action('epl_property_content_after');
					?>
				</div>
			</div>



			<?php do_action('epl_property_tab_auction_details'); ?>



			<!--
			<div class="epl-tab-section epl-section-description">
				<h5 class="epl-tab-title tab-title"><?php echo apply_filters('epl_property_tab_title_description',__('Description', 'easy-property-listings' )); ?></h5>
				<div class="epl-tab-content tab-content">

					<h2 class="entry-title"><?php do_action('epl_property_heading'); ?></h2>

					<h3 class="secondary-heading"><?php do_action('epl_property_secondary_heading'); ?></h3>
					<?php
						do_action('epl_property_content_before');

						do_action('epl_property_the_content');

						do_action('epl_property_content_after');
					?>
				</div>
			</div>
			-->

			<?php do_action('epl_property_tab_section_before'); ?>
			<div class="epl-tab-section epl-tab-section-features">
				<?php do_action('epl_property_tab_section'); ?>
			</div>
			<?php do_action('epl_property_tab_section_after'); ?>

			<?php do_action( 'epl_property_gallery' ); ?>

			<?php do_action( 'epl_property_map' ); ?>

			<?php // do_action( 'epl_single_extensions' ); ?>

			<?php do_action( 'epl_single_before_author_box' ); ?>
			<?php do_action( 'epl_single_author' ); ?>
			<?php do_action( 'epl_single_after_author_box' );
			echo do_shortcode('[gravityform id="5" title="true" description="true" ajax="true" field_values="listing_address='.get_the_title().'"]');

			?>
		</div>
	</div>
	<!-- categories, tags and comments -->
	<div class="entry-footer epl-clearfix">
		<div class="entry-meta">
			<?php wp_link_pages( array( 'before' => '<div class="entry-utility entry-pages">' . __( 'Pages:', 'easy-property-listings'  ) . '', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>
		</div>
	</div>
</div>
<!-- end property -->
