<?php
/*
 * EPL-SP Template for single Location Profiles
 */
 
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'epl-location-profiles-single' ); ?>>
	
	<!-- title, meta, and date info -->				
	<div class="entry-header clearfix">
		<?php //do_action('epl_property_featured_image'); ?>
		
		<!--<h1 class="entry-title">
			<a href="<?php // the_permalink(); ?>">
				<?php // the_title(); ?>
			</a>
		</h1>-->
	</div>
	
	<!-- post content -->
	<div class="entry-content clearfix">
		<?php
		//Video
		if($location_profile_video_url != '') {
			$videoID = epl_get_youtube_id_from_url($location_profile_video_url);
			$video = '<div style="width: 500px;float:right;margin-left:15px;" class="videoContainer">' . wp_oembed_get( ('http://www.youtube.com/watch?v=' . $videoID) , array('width'=>600) ) . '</div>';
		}
		echo apply_filters('the_content',$video);
		?>

		<?php
		if( function_exists('epl_the_content') ) { 
			epl_the_content(); 
		} else {
			the_content();
		}
		?>
		<!-- Location Profile Tab -->
		<div class="tab-wrapper">
		
			<!-- Location profile Tabbed Info Box -->
			<?php if ( $display_tabbed_info == 1 ) { ?>
				<div class="tab-section">
					<div class="tab-content">
						<?php epl_lp_location_profiles_tab_left() ?>
					</div>
				</div>
			<?php } ?>
			<!-- Community Features -->
				<!--
				<div class="tab-section">
						<h5 class="tab-title">Location Profile Features</h5>
					<div class="tab-content">
						<?php //echo get_the_term_list($post->ID, 'community_feature', '<li>', '</li><li>', '</li>' ); ?>
					</div>
				</div>
				-->
			<!-- Location Profile Tabbed Box  -->
			<?php do_action( 'epl_extension_location_profile_single' ); ?>
				
			<!-- Show or hide Gallery -->
			<?php	$attachments = get_children( array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image') );
				// check if the post has a Post Thumbnail assigned to it.
				if ( $attachments && $display_gallery == 1 ) { ?>
					<div class="tab-section">
						<h5 class="tab-title">Gallery</h5>
						<div class="tab-content">
							<?php echo do_shortcode('[gallery columns="4" link="file"]'); ?>
						</div>
					</div>
				<?php } ?>
			
			<!-- Location Profile Map -->
			<?php if ( $display_map == 1 ) { ?>
				<?php do_action( 'epl_property_map' ); ?>
			<?php } ?>
			
			<!-- Show or hide agent profile -->
			<?php if ( $display_author == 1 ) { ?>
			<div class="tab-section">
				<!--<h5 class="tab-title">Property Manager</h5>-->
				<div class="tab-content">
					<?php do_action( 'epl_single_author' ); ?>
				</div>
			</div>
			<?php } ?>
			
		</div>
	</div>
	<!-- categories, tags and comments -->
	<div class="entry-footer clearfix">
		<div class="entry-meta">
			<?php wp_link_pages( array( 'before' => '<div class="entry-utility entry-pages">' . __( 'Pages:', 'epl-lp' ) . '', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>		
		</div>
	</div>
</div>
<!-- end .post -->
