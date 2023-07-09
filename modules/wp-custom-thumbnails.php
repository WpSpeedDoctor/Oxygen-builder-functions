<?php

namespace oxy_func\image_thumbnails;

defined( 'ABSPATH' ) || exit;

/**
 * Description: Set new and remove useless WordPress thumbnails
 */

function custom_image_sizes_oximg() {

	add_image_size('smartphone',414,0, false );

	//Vertically cropped image
	//add_image_size('smartphone-vertical',414,800, true );


	remove_image_size( '1536x1536' );
	remove_image_size( '2048x2048' );

}

add_action('init', 'oxy_func\image_thumbnails\custom_image_sizes_oximg');



// Add custom sizes to WordPress Media Library dropdown menu
function add_thumbnail_into_menu_oximg( $sizes ) {
	
	return array_merge( $sizes, array(
		'smartphone' => __('Smartphone'),
		'smartphone-portrait' => __('Smartphone portrait'),
	) );
}

add_filter( 'image_size_names_choose', 'oxy_func\image_thumbnails\add_thumbnail_into_menu_oximg' );
