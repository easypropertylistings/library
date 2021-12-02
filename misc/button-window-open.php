<?php
/**
 * Window open options when using buttons
 * @link https://www.codegrepper.com/code-examples/javascript/javascript+onclick+open+url+same+window
 */

// EG
?>

<button type="button" class="epl-button" onclick="window.open( '<?php echo esc_url( $link ); ?>' )">Some Button</button>


/* New Tab*/
window.open("instagram.com/9_tay")

/* Same Window (replace) */
window.open("instagram.com/9_tay", "_self" )

/* SECOND WAY*/
window.location.href = "instagram.com/9_tay"

/* THIRD WAY*/
window.location.replace("instagram.com/9_tay")