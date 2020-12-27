<?php

defined( 'ABSPATH' ) || exit;

/**
 * Description: Add to editor URL "wp-admin" query string for disabling full page caching on Cloudflare
 */

if ( ! function_exists( 'wpa_preview_link')){
  function wpa_preview_link( $preview_link ){
      return $preview_link . '&cfqs=wp-admin';
  }
add_filter( 'preview_post_link', 'wpa_preview_link' );
}

	


if ( ! function_exists( 'add_editor_qs' )){
	function add_editor_qs() {
	
		$is_editor = is_int( strpos ( $_SERVER['REQUEST_URI'] , 'ct_template') );

		$is_cfqs = is_int( strpos ( $_SERVER['REQUEST_URI'] , 'cfqs=wp-admin') );

		$redirect_url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'&cfqs=wp-admin';

		if ( $is_editor && !$is_cfqs ) {
			
			?><meta http-equiv="refresh" content="0; URL='<?php echo $redirect_url; ?>'" /><?php

		}
		
	}
	add_action ('init','add_editor_qs');
}
