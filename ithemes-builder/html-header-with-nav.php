<?php
/**
 * This action hook allows you to insert a html logo left of a navigation menu in an HTML module in iThemes Builder
 *
 *
 * @see http://codex.easypropertylistings.com.au/category/41-ithemes-builder
 */

// HTML Header Content with Nav
function rec_it_builder_html_header_content() { ?>
	<?php if ( is_front_page() ) {?>
		<h1 class="site-logo">
			<a href="<?php bloginfo('url'); ?>">
				<img class="alignleft" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" title="YOUR_SEO_SITE_TITLE" alt="YOUR_SEO_SITE_ALT_TAG" width="300" height="61" />
			</a>
		</h1>
	<?php } else { ?>
		<div class="site-logo">
			<a href="<?php bloginfo('url'); ?>">
				<img class="alignleft" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" title="YOUR_SEO_SITE_TITLE" alt="YOUR_SEO_SITE_ALT_TAG" width="300" height="61" />
			</a>
		</div>
	<?php } ?>
		<div class="builder-module-navigation-menu-wrapper">
		<?php wp_nav_menu( array(
				'container' 		=> 'div',
				'container_class' 	=> 'builder-module-navigation',
				'menu' 			=> 'Site Menu',
				'menu_class' 		=> 'menu nav-right it-mobile-nav-menu'
				)
			);
		?>
	</div>
<?php
}
add_action( 'rec_builder_html_header' , 'rec_it_builder_html_header_content');