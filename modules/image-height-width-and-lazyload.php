<?php

namespace oxy_func\image_dimentions;

defined( 'ABSPATH' ) || exit;

/**
 * Description: Adds image's height and width to html img element generated by Oxygen. Also adds loading="lazy" and decoding="async" attributes, disable with adding class "no-ll" or wp filter "wp_lazy_loading_enabled"
 * 
 */

add_filter('do_shortcode_tag', 'oxy_func\image_dimentions\the_image_dimentions',10,3);

function the_image_dimentions( $content, $shortcode_name='', $shortcode_options=false ){

	if($shortcode_name!='ct_image') return $content;

	$image_options = json_decode($shortcode_options['ct_options'],true);

	$image_with_dimentions = add_height_and_width( $content, $image_options['original']??[] );
	
	return add_loading_lazy_markup($image_with_dimentions, $image_options['classes']??[]);
}

function add_loading_lazy_markup($content, $classes){

	if( is_lazyload_disabled_in_wp() || in_array( 'no-ll', $classes ) ) return $content;

	return str_replace('<img ','<img decoding="async" loading="lazy" ',$content);
}

function is_lazyload_disabled_in_wp(){

	return wp_lazy_loading_enabled( 'img', 'wp_get_attachment_image' ) === false;
}

function add_height_and_width($content, $image_options){

	if(empty($image_options['attachment_height'])) return $content;
	
	$image_dimensions_markup = ' height="'.$image_options['attachment_height'].'" width="'.$image_options['attachment_width'].'" />';

	return str_replace('/>',$image_dimensions_markup,$content);

}