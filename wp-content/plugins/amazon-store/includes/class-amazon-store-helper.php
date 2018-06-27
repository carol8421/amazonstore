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
	public static function setDefatltPreferences() {
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

	public static function rootCategories() {
		return [
			'All' => 'All',
			'Appliances' => 2619526011,
			'ArtsAndCrafts' => 2617942011,
			'Baby' => 165797011,
			'Beauty' => 11055981,
			'Blended' => 11055981,
			'Books' => 1000,
			'Collectibles' => 4991426011,
			'Electronics' => 493964,
			'Fashion' => 7141124011,
			'FashionBaby' => 7147444011,
			'FashionBoys' => 7147443011,
			'FashionGirls' => 7147442011,
			'FashionMen' => 7147441011,
			'FashionWomen' => 7147440011,
			'GiftCards' => 2864120011,
			'Grocery' => 16310211,
			'Handmade' => 11260433011,
			'HealthPersonalCare' => 3760931,
			'HomeGarden' => 1063498,
			'Industrial' => 16310161,
			'KindleStore' => 133141011,
			'LawnAndGarden' => 3238155011,
			'Luggage' => 9479199011,
			'Magazines' => 599872,
			'Marketplace' => 599872,
			'MobileApps' => 2350150011,
			'Movies' => 2625374011,
			'MP3Downloads' => 624868011,
			'Music' => 301668,
			'MusicalInstruments' => 11965861,
			'OfficeProducts' => 1084128,
			'PCHardware' => 541966,
			'PetSupplies' => 2619534011,
			'Software' => 409488,
			'SportingGoods' => 3375301,
			'Tools' => 468240,
			'Toys' => 165795011,
			'UnboxVideo' => 2858778011,
			'Vehicles' => 10677470011,
			'VideoGames' => 11846801,
			'Wine' => 2983386011,
			'Wireless' => 2335753011
		];
	}
}