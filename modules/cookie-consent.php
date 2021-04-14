<?php

defined( 'ABSPATH' ) || exit;

/**
 * Description: Cookie consent popup window
 * Credit: https://wpspeedmatters.com/fastest-cookie-consent-wordpress-plugin/
 */


if ( ! function_exists( 'oxycookie_consent' )){
	function oxycookie_consent() {
		
		$message = _('This website uses cookies to ensure you get the best experience on our website');
		
		$button_text = _('Got it!');
?>
<p id="cookie-notice"><?php echo $message; ?><br><button onclick="acceptCookie();"><?php echo $button_text; ?></button></p>

<style>#cookie-notice{color:#fff;font-family:inherit;background:#596cd5;padding:20px;position:fixed;bottom:10px;left:10px;width:100%;max-width:300px;box-shadow:0 10px 20px rgba(0,0,0,.2);border-radius:5px;margin:0px;visibility:hidden;z-index:1000000;box-sizing:border-box}#cookie-notice button{color:inherit;background:#3842c7;border:0;padding:10px;margin-top:10px;width:100%;cursor:pointer}@media only screen and (max-width:600px){#cookie-notice{max-width:100%;bottom:0;left:0;border-radius:0}}</style>

<script>function acceptCookie(){document.cookie="cookieaccepted=1; expires=Thu, 18 Dec 2030 12:00:00 UTC; path=/",document.getElementById("cookie-notice").style.visibility="hidden"}document.cookie.indexOf("cookieaccepted")<0&&(document.getElementById("cookie-notice").style.visibility="visible");</script>
<?php
	}
	add_action ('wp_footer', 'oxycookie_consent');
}