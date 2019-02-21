<?php
/** Custom map marker script **/
function my_custom_marker_scripts() {

    if ( is_epl_post_single() ) { ?>
        <script type="text/javascript">
    		jQuery(document).ready( function($) {
    			epldefaultmarker.setMap(null);
    			epldefaultmarker = new google.maps.Marker({
    				position: epldefaultmap.getCenter(),
    				map: epldefaultmap,
    				icon : 'http://someURL.com.au/wp-content/themes/Divi-child/img/icon-map.png'
    			});

    		});
    	</script>
    <?php
    }
}
add_action('wp_footer','my_custom_marker_scripts');