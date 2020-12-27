<?php 

defined( 'ABSPATH' ) || exit;

/*
* Description: Lazyload CSS background image that has class name "lazy"
*/

if ( ! function_exists( 'lazy_bg_img' )){
	function lazy_bg_img() { 

		?><style>.lazy {background-image: none!important}</style><?php

			add_action( 'wp_footer', 'enqueue_lazy_bg_img_js' );
		
	}

	add_action( 'ct_before_builder', 'lazy_bg_img' );
}

if ( ! function_exists( 'enqueue_lazy_bg_img_js' )){

	function enqueue_lazy_bg_img_js() {
		
		wp_enqueue_script( 'll-bg-images', oxypluginurl . 'assets/js/lazyload-bg-images.js', array(), '1.0', false );

	}

}


?>