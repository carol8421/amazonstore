<?php

/**
 * Fired during plugin activation
 *
 * @link       blubirdinteractive.com
 * @since      1.0.0
 *
 * @package    Amazon_Store
 * @subpackage Amazon_Store/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Amazon_Store
 * @subpackage Amazon_Store/includes
 * @author     BBIL <info@blubirdinteractive.com>
 */
class Amazon_Store_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		self::create_pages();
	}

	public function create_pages() {
		global $user_ID;

		$templates = json_decode(AS_AMAZON_PAGES) ;
		foreach ($templates as $template) {
			$args = array(
				'post_title' => $template,
				'post_content' => '',
				'post_status' => 'publish',
				'post_date' => date('Y-m-d H:i:s'),
				'post_author' => $user_ID,
				'post_type' => 'page'
			);
			$pageTemplatePath = str_replace(' ', '_', strtolower($template)) . '.php';
			$page = wp_insert_post($args);
			if ($page) {
				update_post_meta($page, '_wp_page_template', $pageTemplatePath);
			}

			// Set Search page as homepage
			if ($template == 'Search Products') {
				update_option( 'page_on_front', $page );
				update_option( 'show_on_front', 'page' );
			}
		}
	}

}
