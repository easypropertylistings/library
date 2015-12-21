<?php
/**
 * Author Box: Simple Card
 *
 * @package easy-property-listings
 * @subpackage Theme
**/
?>

<div id="post-<?php the_ID(); ?>" class="epl-author-archive epl-author-simple epl-author-card epl-author">
	<div class="entry-content">
		<div class="epl-author-box epl-author-image">
			<!-- Featured Image -->
			<?php if ( has_post_thumbnail() ) { ?>
				<a class="ag-link" href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $author_image_size , array( 'class' => 'author-thumbnail' ) ); ?>
				</a>
				<?php } elseif (function_exists('get_avatar')) { ?>
				<a href="<?php the_permalink(); ?>">	
					<?php echo get_avatar( $epl_author->email , '180' ); ?>
				</a>
				<?php
				}
			?>
		</div>
		
		<div class="epl-author-box epl-author-details">
			<div class="epl-author-info">
			
				<?php 
				
				if( get_the_content() != '' ) { ?>
					<h5 class="epl-author-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<?php } else { ?>
					<h5 class="epl-author-title"><?php the_title(); ?></h5>
				<?php } ?>
				
				<div class="epl-author-position"><?php echo $epl_author->get_author_position() ?></div>
				<div class="epl-author-contact">
					
					<span class="label-mobile"><i class="fa fa-mobile"></i> <?php echo $epl_author->get_author_mobile() ?></span>
					<span class="label-email"><i class="fa fa-envelope"></i> <a href="mailto:<?php the_author_meta('user_email') ?>">Email</a></span>
					
				</div>
			</div>
		<div class="epl-author-social-buttons">
		<?php
			$social_icons = array('facebook','twitter','google','linkedin','skype');
			foreach($social_icons as $social_icon){
				echo call_user_func(array($epl_author,'get_'.$social_icon.'_html')); 
			}
		?>
		</div>
				<?php
				
					if ( $author_excerpt == 1) {
						echo '<div class="epl-author-content">';
							the_excerpt();
						echo '</div>';
					}
				?>	
		</div>
	</div>
</div>
