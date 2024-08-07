<?php
/**
 * Use the following functions to display and disable image sizes in WordPress
 *
 */

/**
 * This function is to be used for testing as it will list all the registered image sizes 
 * and names you can use in the next function.
 * Disable is by commenting out the add_action line.
 */
if ( current_user_can('administrator') ) {
   /**
    * List registered image sizes with WordPress
    *
    * @return
    */
   function my_list_additional_image_sizes() {
       global $_wp_additional_image_sizes;
       
       $sizes = array();
       $get_intermediate_image_sizes = get_intermediate_image_sizes();
       
       // Create the full array with sizes and crop info
       foreach( $get_intermediate_image_sizes as $_size ) {
       
           if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
       
               $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
               $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
               $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
           } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
       
               $sizes[ $_size ] = array( 
                   'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                   'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                   'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
               );
           }
       }
       
       // Get only 1 size if found
       if ( $size ) {
           if( isset( $sizes[ $size ] ) ) {
               return $sizes[ $size ];
           } else {
               return false;
           }
       }
       echo '<pre>';
       print_r ($sizes);
       echo '</pre>';
   }
   // Comment out the following line to disable the function.
   add_action( 'init', 'my_list_additional_image_sizes', 900 );
}


/**
 * The following function is run late in order to disable the majority of images registered by WordPress, themes and plugins. 
 * Once you disable the images, use a plugin like Force Regenerate Thumbnails to delete and re-process all site images.
 */
function my_remove_large_image_sizes() {
    remove_image_size( '1536x1536' );             // 2 x Medium Large (1536 x 1536), registered by WordPress
    remove_image_size( '2048x2048' );             // 2 x Large (2048 x 2048), registered by WordPress
    remove_image_size( 'et-pb-portfolio-image' );
    remove_image_size( 'et-pb-portfolio-module-image' );
    remove_image_size( 'et-pb-portfolio-image-single' );
    remove_image_size( 'et-pb-gallery-module-image-portrait' );
   // remove_image_size( 'et-pb-post-main-image-fullwidth-large' ); // Used with blog posts
    remove_image_size( 'et-pb-image--responsive--desktop' );
    remove_image_size( 'et-pb-image--responsive--tablet' );
    remove_image_size( 'et-pb-image--responsive--phone' );
}
add_action( 'init', 'my_remove_large_image_sizes', 800 );
