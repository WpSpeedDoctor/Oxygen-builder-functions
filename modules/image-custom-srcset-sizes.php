<?php

namespace oxy_func\image_srcset_sizes;

defined( 'ABSPATH' ) || exit;

/**
 * Description: Adjusts responsive image sizes, values are valid for 414px by 0 thumbnail, serving 414px images on mobile screens
 * 
*/


//set your sizes here
function get_custom_sizes(){

    return '(max-width: 420px) 48vw, (max-width: 1024px) 61vw';
}

//filter for oxy element image
add_filter('do_shortcode_tag', 'oxy_func\image_srcset_sizes\replace_srcset_sizes',10,3);

function replace_srcset_sizes( $content, $shortcode_name='', $shortcode_options=false ){

	if( $shortcode_name != 'ct_image' || strpos( $content,'sizes="' ) === false ) return $content;
	
    return preg_replace('/sizes="([^"]+)"/', 'sizes="'.get_custom_sizes().'"', $content);
    
}

//filter for WP core generated images
add_filter( 'wp_calculate_image_sizes', 'oxy_func\image_srcset_sizes\filter_wp_calculate_image_sizes', 1, 5 ); 

function filter_wp_calculate_image_sizes( $sizes, $size, $image_src, $image_meta, $attachment_id ) { 
	
	return get_custom_sizes();

}