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

		// Delete pages
		self::removePages(AS_AMAZON_PAGES);
	}

	function removePages($pages) {
		$pages = json_decode($pages);
		foreach ($pages as $page) {
			$the_slug = str_replace(' ', '-', strtolower($page));
			$args = ['name'=> $the_slug, 'post_type'   => 'page', 'numberposts' => 1 ];
			$the_page = get_posts($args);
			if( $the_page ) { wp_delete_post($the_page[0]->ID, true); }
		}
	}
}
