<?php 

defined( 'ABSPATH' ) || exit;

/*
 * Description: Back to top button lightweight button, under 2KB JS&CSS
 * credit https://codyhouse.co/gem/back-to-top/
*/
if ( ! function_exists( 'back_to_top' )){
  function back_to_top() {

    ?> <a href="#0" class="cd-top js-cd-top">Top</a> <?php

  }
  add_action( 'wp_footer', 'back_to_top' );
  add_action( 'wp_footer', 'enqueue_back_to_top_js' );
}


if ( ! function_exists( 'enqueue_back_to_top_js' )){

	function enqueue_back_to_top_js() {
		
		wp_enqueue_script( 'back-to-top', oxypluginurl . 'assets/js/back-to-top.js' );
		wp_enqueue_style ('back-to-top', oxypluginurl . 'assets/css/back-to-top.css' );
	}

}


?>