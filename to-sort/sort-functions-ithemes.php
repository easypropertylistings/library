<?php

// Adds Support for Alternate Module Styles
if ( ! function_exists( 'it_builder_loaded' ) ) {
	function it_builder_loaded() {
		builder_register_module_style( 'image', 'No Spacing', 'image-no-spacing' );
		builder_register_module_style( 'image', 'Full Window', 'image-full-window' );
		builder_register_module_style( 'widget-bar', 'Featured', 'featured-wb' );
		builder_register_module_style( 'widget-bar', 'White Circles', 'white-circles-wb' );
		builder_register_module_style( 'widget-bar', 'Dark', 'dark-wb' ); // Search Bar
		builder_register_module_style( 'widget-bar', 'Marketing Hero', 'marketing-hero-wb' );
		builder_register_module_style( 'widget-bar', 'Marketing Dark', 'marketing-dark-wb' );
		builder_register_module_style( 'widget-bar', 'Marketing Light', 'marketing-light-wb' );
		builder_register_module_style( 'widget-bar', 'Marketing White', 'marketing-white-wb' );
		builder_register_module_style( 'widget-bar', 'Positioning', 'pos-wb' );
		builder_register_module_style( 'widget-bar', 'Testimonial', 'testimonial-wb' );
		builder_register_module_style( 'widget-bar', 'No Padding', 'no-padding-wb' );
		builder_register_module_style( 'widget-bar', 'Footer', 'footer-wb' );
		builder_register_module_style( 'html', 'Header', 'header-html' );
		builder_register_module_style( 'html', 'Featured', 'featured-html' );
		builder_register_module_style( 'html', 'No Padding', 'no-padding-html' );
		builder_register_module_style( 'html', 'Tint', 'tint-html' );
		builder_register_module_style( 'html', 'Dark', 'dark-html' );
		builder_register_module_style( 'content', 'Listing Grid', 'listing-grid-content' );
		builder_register_module_style( 'navigation', 'Alternate', 'alternate-nav' );
	}
}
add_action( 'it_libraries_loaded', 'it_builder_loaded' );


// Forum CPT Archive
function rec_cpt_forum_filter_layout( $layout_id ) {

	if ( is_post_type_archive( 'property' ) )
		return '543c81dc7652f';

	if ( is_post_type_archive( 'rental' ) )
		return '55837dad5a1dc';

	if ( is_post_type_archive( 'land' ) )
		return '564fba3b5c7db';

	if ( is_post_type_archive( 'directory' ) )
		return '54f3eb6d6e311';

	if ( is_post_type_archive( 'testimonial' ) )
		return '5587dbaeeffe8';

	if ( is_post_type_archive( 'location_profile' ) )
		return '558381f60538c';

    return $layout_id;

	}
add_filter( 'builder_filter_current_layout', 'rec_cpt_forum_filter_layout' );



// HTML Header Content
function rec_it_builder_html_header_content() { ?>
	<?php if ( is_front_page() ) {?>
		<h1 class="site-logo">
			<a href="<?php bloginfo('url'); ?>">
				<img class="alignleft" src="<?php echo get_stylesheet_directory_uri(); ?>/images/ashmartonA.png" title="Ash Marton Real Estate" alt="Ash Marton Real Estate" width="224" height="50" />
			</a>
		</h1>
	<?php } else { ?>
		<div class="site-logo">
			<a href="<?php bloginfo('url'); ?>">
				<img class="alignleft" src="<?php echo get_stylesheet_directory_uri(); ?>/images/ashmartonA.png" title="Ash Marton Real Estate" alt="Ash Marton Real Estate" width="224" height="50" />
			</a>
		</div>
	<?php } ?>

		<div class="builder-module-navigation-menu-wrapper header-menu">
		<?php wp_nav_menu( array(
				'container' => 'div',
				'container_class' => 'builder-module-navigation',
				'menu' => 'Slim',
				'menu_class' => 'menu nav-right it-mobile-nav-menu'
				)
			);

		?>
			<div class="search-header-box">
				<div class="h-form-wrapper">
					<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
					    <div>
					        <input type="text" value="" name="s" id="s" placeholder="Search" />
					        <input type="submit" id="searchsubmit" value="Search" />
					    </div>
					</form>
				</div>

				<div id="h-search-toogle">
					<i class="fa fa-search"></i>
				</div>

			</div>
		</div>

    <div class="mobile-menu">
        <?php wp_nav_menu( array(
                'container' => 'div',
                'container_class' => '',
                'menu' => 'Slim',
                'menu_class' => 'menu'
            )
        );

        ?>
    </div>
<?php
}
add_action( 'rec_builder_html_header' , 'rec_it_builder_html_header_content');


// Add Details to secondary nav
function rec_add_phone_social_to_nav($items, $args) {


        $items .= '<div class="site-secondary-info-wrapper">

			<div class="site-secondary-info-social alignright">

				<span class="sub-title"><i class="fa fa-phone"></i>03 9770 2828</span>

				<span class="site-header-social">
			<a href="mailto:enquiries@ashmarton.com.au"><i class="fa fa-envelope"></i></a>

					<a href="http://www.facebook.com/ashmartonrealty/"><i class="fa fa-facebook"></i></a>

					<a href="https://twitter.com/ashmarton"><i class="fa fa-twitter"></i></a>

					<a href="https://plus.google.com/+AshMarton/"><i class="fa fa-google"></i></a>

					<a href="https://www.youtube.com/user/ashmarton"><i class="fa fa-youtube"></i></a>
				</span>
			</div>

		</div>';
    return $items;
}
add_filter('wp_nav_menu_main_items','rec_add_phone_social_to_nav', 10, 2);
add_filter('wp_nav_menu_main-buy_items','rec_add_phone_social_to_nav', 10, 2);
add_filter('wp_nav_menu_main-sell_items','rec_add_phone_social_to_nav', 10, 2);
add_filter('wp_nav_menu_main-about_items','rec_add_phone_social_to_nav', 10, 2);
add_filter('wp_nav_menu_main-community_items','rec_add_phone_social_to_nav', 10, 2);
add_filter('wp_nav_menu_main-lease_items','rec_add_phone_social_to_nav', 10, 2);