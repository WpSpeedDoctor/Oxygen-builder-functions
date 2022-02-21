<?php

defined( 'ABSPATH' ) || exit;

/**
 * Description: Creates Website settings menu for ACF.
 * 
 * Credit: https://akzhy.com/blog/create-options-page-in-wordpress-using-free-acf
 * 
 * Installation:
 * First create a page with the name "site-settings", create ACF group and
 * as the location set this page.
 * Then activate this snippet, setting "ON", get page ID of page "site-settings".
 * In this file replace "0" with page ID on the line number 20 where is defined SITE_SETTINGS_PAGE_ID
 * To get data from the settings to the oxygen template use as input "Inset Dynamic Data" and
 * "PHP Function Return value". Place there function name "get_site_settings" and Argument is ACF field name. 
 * 					
 */

define ( 'SITE_SETTINGS_PAGE_ID', 0 ); //replace "0" with page ID of settings page

function get_site_settings( $field_name=false ){

	if ( $field_name === false || !class_exists( 'ACF' ) ) return '';

	$result = get_field( $field_name, SITE_SETTINGS_PAGE_ID );

	return ( $result===false || $result === null ) ? 'Undefined page setting' : $result; 
	
}

function hide_settings_page( $query ) {

	if ( !is_admin() || !is_admin() && !is_main_query() ) return;

	global $typenow;

	if ( $typenow !== "page" ) return;
	
	// Replace "site-settings" with the slug of your site settings page.
	$query->set( 'post__not_in', array( SITE_SETTINGS_PAGE_ID ) );    

}

add_action( 'pre_get_posts', 'hide_settings_page' );


function add_site_settings_to_admin_menu(){

	if ( !class_exists( 'ACF' ) ) return;

	add_menu_page( 	'Site Settings',
					'Site Settings',
					'manage_options',
					'post.php?post='.SITE_SETTINGS_PAGE_ID.'&action=edit',
					'',
					'dashicons-admin-tools', 90
				 );
}

add_action( 'admin_menu', 'add_site_settings_to_admin_menu' );


// Change the active menu item
function higlight_custom_settings_page( $file ) {
	
	if ( !isset( $_GET["post"] ) ) return $file;
		
	global $parent_file, $pagenow, $typenow, $self;

	$settings_page = SITE_SETTINGS_PAGE_ID;

	$post = ( int )$_GET["post"];

	if ( $pagenow === "post.php" && $post === $settings_page ) {

		$file = "post.php?post=$settings_page&action=edit";
	
	}
	
	return $file;
}

add_filter( 'parent_file', 'higlight_custom_settings_page' );


function edit_site_settings_title() {

	global $post, $title, $action, $current_screen;

	if( !is_settings_edit_page() ) return $title;
		
	$title = $post->post_title.' - '.get_bloginfo( 'name' );           
		
	return $title;  
}

add_action( 'admin_title', 'edit_site_settings_title' );


function hide_settings_page_elements(){

	if( !is_settings_edit_page() ) return;

?><style type="text/css">a.page-title-action, #titlediv, #postdivrich {display: none;}</style><?php

}

add_action( 'admin_head', 'hide_settings_page_elements' );


function is_settings_edit_page(){

	global $post, $action, $current_screen;

	return $post->ID == SITE_SETTINGS_PAGE_ID && 

			( $current_screen->post_type ?? false ) === 'page' &&

			$action == 'edit';

}

function disable_settings_page_on_frontend(){

	global $post;

	if ( $post->ID == SITE_SETTINGS_PAGE_ID && !is_admin() ) {

		wp_redirect( '/',301 );
	}
}

add_action ( 'parse_query','disable_settings_page_on_frontend' );


function disable_gutenberg_on_settings_page( $can, $post ){

    return $post->ID == SITE_SETTINGS_PAGE_ID ? false : $can;
}

add_filter( 'use_block_editor_for_post', 'disable_gutenberg_on_settings_page', 5, 2 );