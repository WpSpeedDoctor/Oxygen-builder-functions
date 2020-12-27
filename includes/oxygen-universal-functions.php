<?php

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'oxy_functions_menu' ) && is_admin() ){
	function oxy_functions_menu() {
	
		add_submenu_page('options-general.php',
		    //add_menu_page( 
		        'Oxygen functions', 
		        'Oxygen functions', 
		        'administrator', 
		        'oxy_functions_plugin', 
		        'oxy_functions_admin_page'
		       );
		
	}

add_action('admin_menu', 'oxy_functions_menu');
}

if ( ! function_exists( 'register_oxy_plugin_settings' )){
	function register_oxy_plugin_settings( $modules ) {
		
		$modules = get_plugin_modueles();

		if ( empty($modules) ) return;

		foreach ($modules as $key => $module) {
				
			register_setting( 'oxy-functions-settings', module_setting_name($module) );

			register_setting( 'oxy-functions-settings', module_setting_name($module).'_attribute' );

		}
	
	}
	add_action ('init', 'register_oxy_plugin_settings');
}


if ( ! function_exists( 'module_setting_name' )){
	function module_setting_name( $module_filename ) {
	
		return 'ofp_'.str_replace('-','_', basename($module_filename,'.php') );
	
	}
}


if ( ! function_exists( 'get_plugin_modueles' )){
	function get_plugin_modueles() {
	
		$module_list = scandir( oxyplugindir.'/modules/' );
		
		foreach ($module_list as $key => $filename) {
			
			if ( $filename != 'index.php' && is_int(strpos( $filename , '.php') ) ) $result[] = $filename;

		}

		return ( empty($result) ? false : $result ); 
		
	}
}


if ( ! function_exists( 'load_oxy_plugin_modules' )){
	function load_oxy_plugin_modules() {
	
		$list_of_modules = get_plugin_modueles();

		if ( empty($list_of_modules) ) return;

		foreach ($list_of_modules as $key => $module) {

		    $option_value = get_option(  module_setting_name($module) );

		    if ($option_value =='off') continue;

		    $attribute = get_option(  module_setting_name($module).'_attribute' );

		    if ( $option_value == 'front' and is_admin() === true OR $option_value == 'back' and is_admin() === false ) continue;
		    
			require_once (oxyplugindir.'/modules/'.$module );
		    
		}
	
	}
}

if ( ! function_exists( 'add_action_links' ) && basename($_SERVER['REQUEST_URI']) == 'plugins.php' ){
    
    function add_action_links ( $actions ) {

       $mylinks = array(
          '<a href="' . admin_url( 'options-general.php?page=oxy_functions_plugin' ) . '">Settings</a>',
       );

       $actions = array_merge( $actions, $mylinks );

       return $actions;
    }

add_filter( 'plugin_action_links_' .'oxygen-functions/oxygen-functions.php', 'add_action_links' );

}
