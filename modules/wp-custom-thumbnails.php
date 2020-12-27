<?php

defined( 'ABSPATH' ) || exit;

/**
 * Description: Set and remove WordPress thumbnails
 */

if ( ! function_exists( 'custom_image_sizes')){
	function custom_image_sizes() {

		add_image_size('smartphone',414,0, false );
		//add_image_size('smartphone_portrait',414,800, true );

		remove_image_size( '1536x1536' );
		remove_image_size( '2048x2048' );

	}

	add_action('init', 'custom_image_sizes');

}


