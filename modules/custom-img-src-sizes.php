<?php

defined( 'ABSPATH' ) || exit;

/**
 * Description: Adjust sizes attribute for responsive img elements. Works only for codeblocks and WP functions like wp_get_attachment_image()
 * 
 */


function oxy_filter_wp_calculate_image_sizes( $sizes, $size, $image_src, $image_meta, $attachment_id ) { 
    
    $sizes = '(max-width: 414px) 39vw, (max-width: 1024px) 61vw';
    return $sizes; 
}; 
         
add_filter( 'wp_calculate_image_sizes', 'oxy_filter_wp_calculate_image_sizes', 10, 5 ); 