<?php
/**
 * The configurations file of the plugin
 *
 * This file contain most of the static resorces ie. all global variables, autoloaded values etc
 *
 * - Values should be added using define() method
 * - Check if request is actually coming from the site
 * - Run an admin referrer check to make sure it goes through authentications
 *
 * @link       blubirdinteractive.com
 * @since      1.0.0
 *
 * @package    amazon-store
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// static variables declaration
define('AS_OPTION_PREFIX', 'bbilas_');
define('AS_ROOT_DIR_NAME', basename(__DIR__)); // plugin's directory name
define('AS_ROOT_URL', plugins_url(AS_ROOT_DIR_NAME).'/');
define('AS_SETTINGS_SAVED', get_option('bbilas_settingsSaved'));

// amazon access variables
define('AS_ACCESS_KEY', get_option('bbilas_accessKey'));
define('AS_SECRET_KEY', get_option('bbilas_secretKey'));
define('AS_ASSOCIATE', get_option('bbilas_associate'));

// amazon search properties
define('AS_CATEGORY', get_option('bbilas_category', '{"All":All}'));
define('AS_KEYWORD', get_option('bbilas_storeKeyword', 'dog'));
define('AS_OFFER', get_option('bbilas_defaultDiscount', '10'));

// Theme information
define('AS_THEME_NAME', get_option('bbilas_currentThemeName', 'default'));
define('AS_PLUGIN_DIR', plugin_dir_url(true). AS_ROOT_DIR_NAME .'/');
define('AS_PLUGIN_PATH', dirname(plugin_dir_path( __FILE__ )));
define('AS_TEMPLATE_DIR', plugin_dir_url(true). AS_ROOT_DIR_NAME .'/public/themes/');
define('AS_THEME_DIR', plugin_dir_url(true). AS_ROOT_DIR_NAME .'/public/themes/'. AS_THEME_NAME .'/');
define('AS_UPLOAD_DIR', TH::getRlativeUrl(AS_TEMPLATE_DIR));

// pages
define( 'AS_AMAZON_PAGES', json_encode(['Search Products', 'Single Product']) );
define( 'AS_SINGLE', get_option(AS_OPTION_PREFIX .'detailsOpenStyle', 'popup') ); // popup, newtab

//echo '<br><br><br><br><br> AS_ROOT_URL AS_ROOT_URL AS_ROOT_URL AS_ROOT_URL : '. AS_SINGLE;