<?php

defined( 'ABSPATH' ) || exit;

/**
 * Description: Exclude JS from loading by Cloudflare's Rocket Loader by adding data-cfasync="false" attribute. Default is set for jQuery.
 * 
 */

if ( ! function_exists( 'add_attributes_to_script' )){

	function add_attributes_to_script( $tag, $handle, $src ) {

		$sctipts_exclude_rocket_loader = array('jquery-core','jquery','jquery.cookie','jquery-effects-core','jquery-effects-slide','jquery-effects-highlight','jquery-effects-fold','jquery-effects-blind');

	    if (in_array($handle , $sctipts_exclude_rocket_loader)) {

	            $tag = '<script type="text/javascript" data-cfasync="false" src="' . esc_url( $src ) . '"></script>';

	    } 

	    return $tag;
	}

	add_filter('script_loader_tag', 'add_attributes_to_script', 10, 3); 

}