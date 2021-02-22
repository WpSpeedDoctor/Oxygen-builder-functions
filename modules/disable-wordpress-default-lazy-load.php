<?php

defined( 'ABSPATH' ) || exit;

/**
 * Description: Disable WordPress default image lazy load
 * Credit: https://wpjohnny.com/disable-wordpress-default-lazy-load/
 */

add_filter( 'wp_lazy_loading_enabled', '__return_false' );