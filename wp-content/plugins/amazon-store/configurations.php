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
define('AS_ROOT_DIR_NAME', basename(__DIR__));
define('AS_ROOT_URL', plugins_url(AS_ROOT_DIR_NAME).'/');
define('AS_SETTINGS_SAVED', get_option('bbilas_settingsSaved'));

// amazon access variables
define('AS_ACCESS_KEY', get_option('bbilas_accessKey'));
define('AS_SECRET_KEY', get_option('bbilas_secretKey'));
define('AS_ASSOCIATE', get_option('bbilas_associate'));

// amazon search properties
define('AS_CATEGORY', get_option('bbilas_category', 'All'));
define('AS_KEYWORD', get_option('bbilas_storeKeyword', 'dog'));
define('AS_OFFER', get_option('bbilas_defaultDiscount', '20'));

//echo '<br><br><br><br><br> AS_ROOT_URL AS_ROOT_URL AS_ROOT_URL AS_ROOT_URL : '. AS_ROOT_URL;