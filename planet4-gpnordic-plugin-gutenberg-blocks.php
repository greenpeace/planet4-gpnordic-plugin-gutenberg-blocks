<?php
/**
 * Plugin Name: Planet 4 Greenpeace Nordic Custom Gutenberg Blocks
 * Plugin URI: https://github.com/greenpeace/planet4-gpnordic-plugin-gutenberg-blocks
 * Description: Greenpeace Nordic's spesific Gutenberg cutomisations and additions to the core stack
 * Version: 0.1
 * License: TBD
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || die('Direct access is forbidden!');

// Define constants
define( 'P4_GPN_PLUGIN_BASE_PATH', plugin_dir_path( __FILE__ ) );
define( 'P4_GPN_PLUGIN_BASE_URL', plugin_dir_url( __FILE__ ) );

// Include the Composer autoload file
require P4_GPN_PLUGIN_BASE_PATH . 'vendor/autoload.php';

use Greenpeace\Planet4GPNGutenbergBlocks;

// Initialize the Plugin
$p4_gpnordic_gutenberg_blocks = Planet4GPNGutenbergBlocks\P4_GPN_Gutenberg_Blocks::get_instance();
