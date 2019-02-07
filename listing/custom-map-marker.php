<?php
function my_custom_marker_scripts() {
?>
	<script type="text/javascript">
		jQuery(document).ready( function($) {
			setTimeout(function() {
				epldefaultmarker.setMap(null);
				epldefaultmarker = new google.maps.Marker({
					position: epldefaultmap.getCenter(),
					map: epldefaultmap,
					icon : 'http://someURL.com.au/wp-content/themes/Divi-child/img/icon-map.png'
				});
			},
			3000);

		});
	</script>
<?php
}
add_action('wp_footer','my_custom_marker_scripts');