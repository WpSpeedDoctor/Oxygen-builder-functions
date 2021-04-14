<?php

defined( 'ABSPATH' ) || exit;

/**
 * Description: Preload jquery on the font-end
 * 
 */

if ( ! function_exists( 'oxymodule_preload_jquery' )){
	function oxymodule_preload_jquery() {
		
		if ( is_admin() ) return;

		global $wp_scripts;

		$preload_script_handles = array ( 'jquery-core' /*, 'jquery-migrate'*/ );

		foreach ( $preload_script_handles as $key => $handle ) {
		
			$script_array = $wp_scripts->registered[$handle];

			$preload_script_url = rtrim( get_site_url(),'/' ).$script_array->src.'?ver='.$script_array->ver;
			
			?><link rel="preload" href="<?php echo $preload_script_url; ?>" as="script"><?php
		}
	
	}
	
	add_action('wp_head','oxymodule_preload_jquery');
}

