<?php
/*
 * Loop Property Template: Default
 *
 * @package easy-property-listings
 * @subpackage Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
global $property;
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('epl-listing-post epl-property-blog ash-listing-grid epl-clearfix-disabled'); ?>>
	<div class="epl-property-blog-content-wrapper">

		<?php do_action('epl_property_before_content'); ?>				
		<div class="entry-header">
			<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>">
						<div class="epl-blog-image">
							<?php the_post_thumbnail( 'rec_crop_600', array( 'class' => 'teaser-left-thumb' ) ); ?>
						</div>
					</a>
					<!-- Home Open -->
					<?php // do_action('epl_property_inspection_times'); ?>
			<?php endif; ?>
		</div>
		<div class="entry-content">
			<!-- Property Featured Icons -->
			<div class="property-feature-icons">
				<?php do_action('epl_property_icons'); ?>				
			</div>
			
			<div class="epl-archive-listing-details-wrapper">
				<div class="epl-archive-listing-details">
					<div class="epl-archive-box epl-archive-listing-box-left">
				
						<div class="property-address">
							<a href="<?php the_permalink(); ?>">
								<?php do_action('epl_property_address'); ?>
							</a>
						</div>
						<div class="address price">
							<?php do_action('epl_property_price'); ?>
						</div>
					</div>
					<div class="epl-archive-box epl-archive-listing-box-right">
						<div class="epl-archive-buttons">
							<?php do_action( 'epl_buttons_single_property' ); ?>
						</div>
					</div>
				</div>	
			</div>	
		</div>
		<?php do_action('epl_property_after_content'); ?>
	</div>
</div>