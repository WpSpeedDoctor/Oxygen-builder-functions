<?php

defined( 'ABSPATH' ) || exit;

/**
 * Description: Set and remove WordPress thumbnails
 */

if ( ! function_exists( 'custom_image_sizes_oximg')){
	function custom_image_sizes_oximg() {

		add_image_size('smartphone',414,0, false );
		add_image_size('smartphone-portrait',414,800, true );

		remove_image_size( '1536x1536' );
		remove_image_size( '2048x2048' );

	}

	add_action('init', 'custom_image_sizes_oximg');

}

// Add custom sizes to WordPress Media Library dropdown menu
if ( ! function_exists('add_thumbnail_into_menu_oximg') ){
	function add_thumbnail_into_menu_oximg( $sizes ) {
	  
	    return array_merge( $sizes, array(
		'smartphone' => __('Smartphone'),
	     	'smartphone-portrait' => __('Smartphone portrait'),
	    ) );
	}
	add_filter( 'image_size_names_choose', 'add_thumbnail_into_menu_oximg' );
}
