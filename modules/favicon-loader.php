<?php

defined( 'ABSPATH' ) || exit;

/**
 * Description: Loads favicon icon. Check if you have uploaded /favicon.ico.
 * 
 */

if ( ! function_exists( 'oxy_favicon_loader' ) ){

	function oxy_favicon_loader() {

		?>
<link rel="icon" href="<?php echo home_url(); ?>/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo home_url(); ?>/favicon.ico" type="image/x-icon" />
	<?php }

	add_action( 'wp_head', 'oxy_favicon_loader' );

}
