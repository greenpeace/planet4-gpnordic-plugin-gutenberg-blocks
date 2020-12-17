<?php
/**
 * Plugin Name: Planet4 Greenpeace Nordic - Gutenberg Blocks
 * Description: Contains the Gutenberg blocks that are used by Planet4 for Greenpeace Nordic.
 * Plugin URI: https://github.com/greenpeace/planet4-gpnordic-plugin-gutenberg-blocks
 * Php Version: 7.0
 * Version: 0.1.2
 * Text Domain: planet4-gpn-blocks
 *
 * @category Wordpress-plugin
 * @package  P4GPNGBKS
 * @author   Greenpeace Nordic <svilena.koleva@greenpeace.org>
 * @license  MIT Licence https://github.com/greenpeace/planet4-gpnordic-plugin-gutenberg-blocks/blob/master/LICENCE
 * @link     https://github.com/greenpeace/planet4-gpnordic-plugin-gutenberg-blocks
 */

// Exit if accessed directly.
defined('ABSPATH') || die('Direct access is forbidden!');

// Define constants.
if (! defined('P4GPNGBKS_REQUIRED_PHP') ) {
    define('P4GPNGBKS_REQUIRED_PHP', '7.0');
}
if (! defined('P4GPNGBKS_REQUIRED_PLUGINS') ) {
    define(
        'P4GPNGBKS_REQUIRED_PLUGINS',
        [
        'timber' => [
                'min_version' => '1.9.0',
                'rel_path'    => 'timber-library/timber.php',
        ],
        ]
    );
}
if (! defined('P4GPNGBKS_PLUGIN_BASENAME') ) {
    define('P4GPNGBKS_PLUGIN_BASENAME', plugin_basename(__FILE__));
}
if (! defined('P4GPNGBKS_BASE_PATH') ) {
    define('P4GPNGBKS_BASE_PATH', plugin_dir_path(__FILE__));
}
if (! defined('P4GPNGBKS_BASE_URL') ) {
    define('P4GPNGBKS_BASE_URL', plugin_dir_url(__FILE__));
}
if (! defined('P4GPNGBKS_PLUGIN_DIRNAME') ) {
    define('P4GPNGBKS_PLUGIN_DIRNAME', dirname(P4GPNGBKS_PLUGIN_BASENAME));
}
if ( ! defined( 'P4GPNGBKS_PLUGIN_DIR' ) ) {
	define( 'P4GPNGBKS_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . P4GPNGBKS_PLUGIN_DIRNAME );
}
if (! defined('P4GPNGBKS_PLUGIN_NAME') ) {
    define('P4GPNGBKS_PLUGIN_NAME', 'Planet 4 - Greenpeace Nordic Gutenberg Blocks');
}
if (! defined('P4GPNGBKS_ADMIN_DIR') ) {
    define('P4GPNGBKS_ADMIN_DIR', plugins_url(P4GPNGBKS_PLUGIN_DIRNAME . '/admin/'));
}
if (! defined('WP_UNINSTALL_PLUGIN') ) {
    define('WP_UNINSTALL_PLUGIN', P4GPNGBKS_PLUGIN_BASENAME);
}
// Include the Composer autoload file.
require P4GPNGBKS_BASE_PATH . 'vendor/autoload.php';

require P4GPNGBKS_BASE_PATH . 'classes/class-loader-gpn.php';

// Initialize the Plugin.
$p4_gpnordic_gutenberg_blocks = P4GPNGBKS\P4_GPN_GBKS::get_instance();

