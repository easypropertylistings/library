<?php

function rec_panel_sales_result_callback() {
?>
	<div class="panel-sales-result-background-wrapper">
		<div class="panel-sales-result-outer-wrapper">
			<div class="panel-sales-result">
				<div class="panel-title">OUR amazing sales result</div>
				<div class="panel-address"> 89A Lawson Ave, Frankston South</div>
				<div class="panel-sub-title">sold at auction $916,000</div>
				<div class="panel-content">
					<p>$156,000 over reserve<br />
					$255,000 over previous street record<br />
					5 bidders (70% from Melbourne)
					</p>
				</div>
			</div>
			<div class="panel-subscribe-form-wrapper">
				<div class="panel-subscribe-form">
					<?php echo do_shortcode('[gravityform id="6" title="true" description="false" tabindex="99"]'); ?>
					
					
				</div>
				<div style="display:none" class="rec-panel-appraisal-popout fancybox-hidden">
					<div id="fancyboxID-1">
                        <?php

                        if (is_page( array(  'inspection-times', 'why-lease-with-us', 'leasing-appraisal', 'urgent-repairs', 'tenant-forms', 'transfer-your-property-to-ash-marton-realty' ) ) ||  is_post_type_archive('rental')) {
                            echo do_shortcode('[gravityform id="24" title="true" description="true" tabindex="98"]');
                        }
                        else {
                            echo do_shortcode('[gravityform id="25" title="true" description="true" tabindex="99"]');
                        }

                        ?>
					</div>
				</div>
				<a href="#fancyboxID-1" class="rec-panel-appraisal-popout-fancybox fancybox">Request An Appraisal</a>
				
			</div>
			
		</div>
	</div>
<?php
}
add_action( 'rec_panel_sales_result' , 'rec_panel_sales_result_callback' );