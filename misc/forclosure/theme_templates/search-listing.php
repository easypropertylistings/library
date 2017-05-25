<?php
/**
 * The Default Template for displaying all Easy Property Listings archive/loop posts with the Genesis Theme Framework
 *
 * @package EPL
 * @subpackage Templates/Themes/Genesis
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

 get_header();
 do_action( 'genesis_before_content_sidebar_wrap' );

 genesis_markup( array(
		'html5'   => '<div %s>',
		'xhtml'   => '<div id="content-sidebar-wrap">',
		'context' => 'content-sidebar-wrap',
	) );

		do_action( 'genesis_before_content' );
		genesis_markup( array(
			'html5'   => '<main %s>',
			'xhtml'   => '<div id="content" class="hfeed">',
			'context' => 'content',
		) );
			do_action( 'genesis_before_loop' );
				?>

				<div id="primary">
					<div id="content" role="main">
						<?php
						if ( have_posts() ) : ?>
							<div class="loop">
								<div class="loop-header">
									<h4 class="loop-title">
										<?php 
										global $wp_query;
										echo $wp_query->found_posts.' results found.'; ?>
									</h4>
								</div>

								<div class="loop-content <?php echo epl_template_class( 'genesis', 'archive' ).' '.epl_template_class( 'search', 'archive' ); ?>">
									<table class="table hi-property-details-list">
										<thead>
											<tr class="hi-property-detail-heading">
												<th class="hi-table-heading-item" data-breakpoints="xs sm" class="hide"><?php echo __('Status','easy-property-listings');?></th>
												<th class="hi-table-heading-item" data-breakpoints="xs sm" class="hide"><?php echo __('Type','easy-property-listings');?></th>
												<th class="hi-table-heading-item"><?php echo __('Address','easy-property-listings');?></th>
												<th class="hi-table-heading-item"><?php echo __('City','easy-property-listings');?></th>
												<th class="hi-table-heading-item"><?php echo __('Bed','easy-property-listings');?></th>
												<th class="hi-table-heading-item"><?php echo __('Bath','easy-property-listings');?></th>
												<th class="hi-table-heading-item" data-breakpoints="xs sm" class="hide"><?php echo __('Sq Ft','easy-property-listings');?></th>
												<th class="hi-table-heading-item" data-breakpoints="xs sm" class="hide"><?php echo __('Land Sq Ft','easy-property-listings');?></th>
												<th class="hi-table-heading-item" data-breakpoints="xs sm" class="hide"><?php echo __('LT','easy-property-listings');?></th>
												<th class="hi-table-heading-item" data-type="numeric"><?php echo __('Opening Bid','easy-property-listings');?></th>
												<th class="hi-table-heading-item" data-breakpoints="xs sm" data-type="numeric" class="hide"><?php echo __('Curr Max Bid','easy-property-listings');?></th>
												<th class="hi-table-heading-item" data-breakpoints="xs sm" data-type="numeric" class="hide"><?php echo __('Est. Mrkt Value','easy-property-listings');?></th>
												<th class="hi-table-heading-item" data-breakpoints="xs sm" data-type="date" class="hide"><?php echo __('1st Auction','easy-property-listings');?></th>
												<th class="hi-table-heading-item" data-breakpoints="xs sm" data-type="date" class="hide"><?php echo __('2nd Auction','easy-property-listings');?></th>
											</tr>
										</thead>
										<tbody>

									<?php //do_action( 'epl_property_loop_start' ); ?>
									<?php while ( have_posts() ) : // The Loop
											the_post(); 
											do_action('epl_property_blog','search');
								
										endwhile; // end of one post
									?>
										</tbody>
									</table>
									<?php do_action( 'epl_property_loop_end' ); ?>
								</div>

								<div class="loop-footer">
									<!-- Previous/Next page navigation -->
									<div class="loop-utility clearfix">
										<?php do_action('epl_pagination'); ?>
									</div>
								</div>
							</div>
						<?php
						else : ?>
							<div class="hentry">
								<?php do_action( 'epl_property_search_not_found' ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php
			do_action( 'genesis_after_loop' );
		genesis_markup( array(
			'html5' => '</main>', //* end .content
			'xhtml' => '</div>', //* end #content
		) );
		do_action( 'genesis_after_content' );

	echo '</div>'; //* end .content-sidebar-wrap or #content-sidebar-wrap
do_action( 'genesis_after_content_sidebar_wrap' );
get_footer();
