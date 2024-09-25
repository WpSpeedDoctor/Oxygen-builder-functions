<?php

namespace oxy_func;

defined( 'ABSPATH' ) || exit;

/**
 * Description: Insert script into the header
 * 
*/
 
global $pagenow;

switch(true){
	case wp_doing_cron():
	case wp_doing_ajax():
		break;

	case is_admin() && $_SERVER['REQUEST_METHOD'] === 'GET' && $pagenow === 'post.php':

		add_action('add_meta_boxes', __NAMESPACE__ . '\\add_header_script_metabox');
		break;

	case is_admin() && isset($_GET['meta-box-loader']):

		add_action('save_post', __NAMESPACE__ . '\\save_header_script_metabox');
		break;

	default:

		add_action('wp_head', __NAMESPACE__ . '\\insert_header_script');
		break;
}

function add_header_script_metabox(){

	add_meta_box(
		'insert_header_script',
		esc_html__('Script to insert into the header'),
		__NAMESPACE__ . '\\render_header_script_metabox',
		['post', 'page'],
		'normal',
		'high'
	);
}

function render_header_script_metabox($post){
	
	$script = get_post_meta($post->ID, 'insert_header_script', true);

	$text_area = $script ?: esc_textarea($script);

	echo <<<HTML
	<textarea name="insert_header_script" style="width:100%; height:200px;">{$text_area}</textarea>
	HTML;

}



function save_header_script_metabox($post_id){
	
	if(!isset($_POST['insert_header_script']) || !current_user_can('edit_post', $post_id)) return;

	$new_script = htmlspecialchars_decode(wp_unslash($_POST['insert_header_script']));

	$original_script = get_post_meta( $post_id, 'insert_header_script', true);

	if( empty($new_script) && empty($original_script) ) return;

	update_post_meta($post_id, 'insert_header_script', $new_script);
}

function insert_header_script(){
	
	$script = get_post_meta(get_the_ID(), 'insert_header_script', true);
	
	if($script) echo $script;
}