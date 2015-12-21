<?php

function rec_panel_google_places_reviews_callback() {
    ?>
    <div id="scroller_container">
        <div class=" " id="carousel">
            <?php dynamic_sidebar( 'Google Places reviews' ); ?>
        </div>
    </div>
    <?php
}
add_action( 'rec_panel_google_places_reviews' , 'rec_panel_google_places_reviews_callback' );