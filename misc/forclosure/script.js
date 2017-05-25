jQuery(document).ready(function($) { 
	if($( "#property_inspection_times_max" ).length){
		$( "#property_inspection_times_max" ).epl_datetimepicker({
			format: "d-M-Y",
			validateOnBlur: false,
			'timepicker':false
		});
	}
	if($( "#property_inspection_times_min" ).length){
		$( "#property_inspection_times_min" ).epl_datetimepicker({
			format: "d-M-Y",
			validateOnBlur: false,
			'timepicker':false
		});
	}
	if($( "#property_auction_times_max" ).length){
		$( "#property_auction_times_max" ).epl_datetimepicker({
			format: "Y-m-d",
			validateOnBlur: false,
			'timepicker':false
		});
	}
	if($( "#property_auction_times_min" ).length){
		$( "#property_auction_times_min" ).epl_datetimepicker({
			format: "Y-m-d",
			validateOnBlur: false,
			'timepicker':false
		});
	}
});
jQuery(function($){
	$('.table').footable({
		breakpoints: {
			xs: 250,
			sm: 555
		}
	});
});