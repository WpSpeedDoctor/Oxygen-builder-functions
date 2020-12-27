<?php

defined( 'ABSPATH' ) || exit;

/**
 * Description: Selective disable CSS and JS
 */

if ( ! function_exists( 'deregister_styles')){

  function deregister_styles()    { 
     wp_deregister_style( 'wp-block-library' );
     wp_dequeue_style ('wp-block-library');
  }

  add_action( 'wp_print_styles', 'deregister_styles', 100 );
}
