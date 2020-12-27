<?php

/**
 * @wordpress-plugin
 * Plugin URI:      https://github.com/WpSpeedDoctor/Oxygen-builder-functions
 * Plugin Name:     Oxygen builder functions
 * Description:     Execute PHP functions or code that normally goes to functions.php, sorted in modueles
 * Version:         1.0.0
 * Author:          Jaro Kurimsky <pixtweaks@protonmail.com>
 * Author URI:      mailto:pixtweaks@protonmail.com
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:     /languages
 */

defined( 'ABSPATH' ) || exit;

define ('oxyplugindir', __DIR__ );

define ('oxypluginurl', plugin_dir_url( __FILE__ ) );

require_once (oxyplugindir.'/includes/oxygen-universal-functions.php');

load_oxy_plugin_modules();

if ( isset($_GET['page']) && $_GET['page'] == 'oxy_functions_plugin' ) require_once (oxyplugindir.'/includes/admin.php');




