<?php

function rec_panel_register_for_property_alerts_callback() {
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
                        <?php echo do_shortcode('[gravityform id="11" title="true" description="false" tabindex="99"]'); ?>
                    </div>
                </div>
                <a href="#fancyboxID-1" class="rec-panel-appraisal-popout-fancybox fancybox">register for property alerts</a>

            </div>

        </div>
    </div>
    <?php
}
add_action( 'rec_panel_register_for_property_alerts' , 'rec_panel_register_for_property_alerts_callback' );