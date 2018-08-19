<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              blubirdinteractive.com
 * @since             1.0.0
 * @package           Amazon_Store
 *
 * @wordpress-plugin
 * Plugin Name:       Amazon Store
 * Plugin URI:        www.blubirdinteractive.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            BBIL
 * Author URI:        blubirdinteractive.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       amazon-store
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The core plugin class that is used to define all helper methods,
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-amazon-store-helper.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-amazon-store-themeHelper.php';

/**
 * The code that runs for some static configuration stuff
 * This action is documented in configurations.php
 */
require_once plugin_dir_path( __FILE__ ) . 'configurations.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-amazon-store-activator.php
 */
function activate_amazon_store() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-amazon-store-activator.php';
	Amazon_Store_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-amazon-store-deactivator.php
 */
function deactivate_amazon_store() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-amazon-store-deactivator.php';
	Amazon_Store_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_amazon_store' );
register_deactivation_hook( __FILE__, 'deactivate_amazon_store' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-amazon-store.php';

/**
 * The core plugin class that is used to define all ajax methods,
 * admin-specific ajax, and public-facing site ajax call.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-amazon-ajax.php';

/**
 * The core plugin classes that is used to define all amazon API methods,
 *
 * 1. Amazon base class to request access
 * 2. Search class to search product on amazon
 * 3. Category class for retriving categories associate width specific browser node
 */
require plugin_dir_path( __FILE__ ) . 'amazon/class-amazon-api.php';
require plugin_dir_path( __FILE__ ) . 'amazon/class-amazon-api-search.php';
require plugin_dir_path( __FILE__ ) . 'amazon/class-amazon-api-categories.php';
require plugin_dir_path( __FILE__ ) . 'amazon/class-amazon-api-cart.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_amazon_store() {

	$plugin = new Amazon_Store();
	$plugin->run();

}
run_amazon_store();
