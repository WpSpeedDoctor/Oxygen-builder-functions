<?php
namespace oxy_func\menu_pro_js_icons;

/**
 * Description: Replaces JS generated icons in pro menu oxygen's element with PHP generated icons, helps generate better CCSS
 *  
 */

defined( 'ABSPATH' ) || exit;

add_filter('do_shortcode_tag', 'oxy_func\menu_pro_js_icons\add_icons_for_menu_with_child',10,3);

function add_icons_for_menu_with_child( $content, $shortcode_name='', $shortcode_options=false ){
	
	if ( $shortcode_name !== 'oxy-pro-menu' ) return $content;

	//when pro menu shortcode found, filter is removed. If you have more than one pro menus on the page, comment next line
	remove_filter('do_shortcode_tag', 'oxy_func\menu_pro_js_icons\add_icons_for_menu_with_child',10,3);
   
	return add_icon_to_submenu_with_child( remove_inlined_js($content), get_icon_name( $shortcode_options['ct_options'] ) );

}

function add_icon_to_submenu_with_child( $menu_markup, $icon_name ){

	if( empty($icon_name) ) return $menu_markup;

	$icon_replacement = ltrim( get_dropdown_icon_markup($icon_name),'<' ).'<';
	
	foreach( get_menu_with_children_markup( $menu_markup ) as $replacement_string ){

		$menu_markup = str_replace( $replacement_string, $replacement_string.$icon_replacement, $menu_markup );
		
	}

	return $menu_markup;
}

function get_dropdown_icon_markup($icon_name){

	return 
		'<div class="oxy-pro-menu-dropdown-icon-click-area">
			<svg class="oxy-pro-menu-dropdown-icon">
				<use xlink:href="#'.$icon_name.'"></use>
			</svg>
		</div>';

}

function get_menu_with_children_markup( $menu_markup ){
	
	preg_match_all('/menu-item-has-children[^li>].+?<a.+?</', $menu_markup, $menu_with_children);

	return $menu_with_children[0];
}


function remove_inlined_js($content){

	return explode('<script', $content)[0];
}

function get_icon_name( $shortcode_options ){

	//regex is faster than json_decode in this case, 50 μs to 5 μs difference
	preg_match('/"oxy-pro-menu_dropdown_icon":"(.+?)"/', $shortcode_options, $output_array);

	return $output_array[1]??'';
}
