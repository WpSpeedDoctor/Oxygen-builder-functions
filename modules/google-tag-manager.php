<?php

defined( 'ABSPATH' ) || exit;

/**
 * Description: Google Tag manager for Oxygen builder website, enter GTM property as attribute
 * Credit and documentation https://wpdevdesign.com/how-to-add-google-tag-manager-code-in-oxygen/
 */

define( 'OXY_GTM_PROPERTY', $attribute );

/**
 * Adds Google Tag Manager code in <head> below the <title>.
 */
if ( ! function_exists( 'sk_google_tag_manager1' ) ){

	function sk_google_tag_manager1() {

		if ( empty( OXY_GTM_PROPERTY ) ) {
			
			echo '<!-- Google Tag Manager is disabled, has no set property in settings -->';

			return;
		}

		?>

	    <!-- Google Tag Manager -->
	    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	    })(window,document,'script','dataLayer','<?php echo OXY_GTM_PROPERTY; ?>');</script>
	    <!-- End Google Tag Manager -->

	<?php }

	add_action( 'wp_head', 'sk_google_tag_manager1', 1 );

}

/**
 * Adds Google Tag Manager code immediately after the opening <body> tag.
 */
if ( ! function_exists( 'sk_google_tag_manager2' ) && !empty( OXY_GTM_PROPERTY ) ){
	function sk_google_tag_manager2() { 
		
		?>
	    <!-- Google Tag Manager (noscript) -->
	    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo OXY_GTM_PROPERTY; ?>"
	    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	    <!-- End Google Tag Manager (noscript) -->
		<?php
	}

	add_action( 'ct_before_builder', 'sk_google_tag_manager2' );

}
