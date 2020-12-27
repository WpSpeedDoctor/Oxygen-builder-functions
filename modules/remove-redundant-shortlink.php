<?php

defined( 'ABSPATH' ) || exit;

/**
 * Description: Remove redundant shortlink ?p=25 and rel=shortlink
 * Credit https://wordpress.stackexchange.com/questions/288089/remove-rel-shortlink-from-http-header
 */

if ( ! function_exists( 'remove_redundant_shortlink')){
  function remove_redundant_shortlink() {
      // remove HTML meta tag
      // <link rel='shortlink' href='http://example.com/?p=25' />
      remove_action('wp_head', 'wp_shortlink_wp_head', 10);

      // remove HTTP header
      // Link: <https://example.com/?p=25>; rel=shortlink
      remove_action( 'template_redirect', 'wp_shortlink_header', 11);
  }
  add_filter('after_setup_theme', 'remove_redundant_shortlink');
}
