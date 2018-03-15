<?php

/**
 * Fired during plugin deactivation
 *
 * @link       blubirdinteractive.com
 * @since      1.0.0
 *
 * @package    Amazon_Store
 * @subpackage Amazon_Store/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Amazon_Store
 * @subpackage Amazon_Store/includes
 * @author     BBIL <info@blubirdinteractive.com>
 */
class Amazon_Store_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		// Delete plugin data
		Helper::resetPluginOptions();
	}

}
