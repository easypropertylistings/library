<?php
/*
 * EPL Suburb Profile Template : Archive Card
 * @since       1.0.3
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('suburb-blog clearfix'); ?>>
	<div id="epl-suburb-blog" class="suburb-blog-wrapper-container">
		<div class="entry-header">
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="suburb-box property-featured-image-wrapper">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'medium' ); ?>
					</a>
				</div>
			<?php } ?>
			
			<h3 class="entry-title clearfix"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div>
		
		<div class="entry-content property-content">
			<?php 
				if( function_exists('xx_epl_the_excerpt') ) { 
					epl_the_excerpt(); 
				} else {
					the_excerpt();
				} 
			?>
			
			<div class="suburb-more-link"><a href="<?php the_permalink(); ?>">LEARN MORE</a></div>
		</div>
	</div>
</div>
