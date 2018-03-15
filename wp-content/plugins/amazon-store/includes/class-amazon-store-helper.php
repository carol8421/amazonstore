<?php
class Helper {

	/**
	 * Save data to option table
	 *
	 * Save or update data into the option table
	 *
	 * @since    1.0.0
	 *
	 * @param $optionName
	 * @param $value
	 */
	public static function saveOnOptionTable($optionName, $value) {
		if( !empty(trim(get_option($optionName))) ) update_option( $optionName, $value,'no' );
		else add_option( $optionName, $value, '', 'no' );
	}

	/**
	 * Sanitize the posted data for future use
	 *
	 * @since    1.0.0
	 *
	 * @param $value
	 * @param bool $default
	 *
	 * @return bool|string
	 */
	public static function getPostField($value, $default='') {
		return isset($value) && !empty(trim($value)) ? trim($value) : $default;
	}

	/**
	 * redirectUri
	 *
	 * Generate the redirect url used by the google API
	 *
	 * @since    1.0.0
	 *
	 * @return  string
	 */
	public static function redirectUri(){
		$myUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && !in_array(strtolower($_SERVER['HTTPS']),array('off','no'))) ? 'https' : 'http';
		$myUrl .= '://'.$_SERVER['HTTP_HOST'];
		$myUrl .= $_SERVER['REQUEST_URI'];
		return $myUrl;
	}

	/**
	 * pluginLibUrl
	 *
	 * The plugin `lib` directory url
	 *
	 * @since    1.0.0
	 *
	 * @param string $fileUrl
	 *
	 * @return string
	 */
	public static function pluginLibUrl($fileUrl='analytics/HelloAnalytics.php'){
		return str_replace('admin/partials/', '', plugins_url('/', __FILE__ )).$fileUrl;
	}

	/**
	 * setDefatltPreferences
	 *
	 * Set some default preferences and settings data into options table
	 *
	 * @since    1.0.0
	 */
	public static function setDefatltPreferences(){
		// Set Default options
	}

	/**
	 * resetThemeOptions
	 *
	 * Remove default preferences and settings data into options table
	 *
	 * @since    1.0.0
	 */
	public static function resetPluginOptions() {
		delete_option('bbilas_accessKey');
		delete_option('bbilas_secretKey');
		delete_option('bbilas_associate');
		delete_option('bbilas_storeKeyword');
		delete_option('bbilas_defaultDiscount');
		delete_option('bbilas_category');
		delete_option('bbilas_theme');
		delete_option('bbilas_settingsSaved');
	}
}