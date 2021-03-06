<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://blu.com
 * @since             1.0.0
 * @package           Woo_Partner
 *
 * @wordpress-plugin
 * Plugin Name:       WooPartner for Affiliation
 * Plugin URI:        http://blu.com/woo-Partner-uri/
 * Description:       This is for generating referral urls for different product categories with different commission rate.
 * Version:           1.0.0
 * Author:            Blu
 * Author URI:        http://blu.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-Partner
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOO_PARTNER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-Partner-activator.php
 */
function activate_woo_Partner() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-Partner-activator.php';
	Woo_Partner_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-Partner-deactivator.php
 */
function deactivate_woo_Partner() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-Partner-deactivator.php';
	Woo_Partner_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_Partner' );
register_deactivation_hook( __FILE__, 'deactivate_woo_Partner' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-Partner.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_Partner() {

	$plugin = new Woo_Partner();
	$plugin->run();

}
run_woo_Partner();
