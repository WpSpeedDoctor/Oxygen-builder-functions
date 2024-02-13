<?php

defined( 'ABSPATH' ) || exit;

/**
 * Description: Selective disable CSS and JS
 */


function wpsd_deregister_styles(){
	
	$css_handles_to_remove = [

		/**
		 * default WP styles that are useless for Oxygen Builder 
		 */
		'wp-block-library',
		
		'global-styles',
		
		'classic-theme-styles'
	
	
	];

	foreach( $css_handles_to_remove as $css_handle ){

		wp_deregister_style( $css_handle );

		wp_dequeue_style( $css_handle );

	}

}

add_action( 'wp_print_styles', 'wpsd_deregister_styles', 100 );
