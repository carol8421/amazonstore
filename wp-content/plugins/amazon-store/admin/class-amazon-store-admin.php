<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       blubirdinteractive.com
 * @since      1.0.0
 *
 * @package    Amazon_Store
 * @subpackage Amazon_Store/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Amazon_Store
 * @subpackage Amazon_Store/admin
 * @author     BBIL <info@blubirdinteractive.com>
 */
class Amazon_Store_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for including the styles on admin area.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Amazon_Store_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Amazon_Store_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/amazon-store-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for including the scripts on admin area.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Amazon_Store_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Amazon_Store_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-easing', plugin_dir_url( __FILE__ ) . 'js/jquery.easing.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-multipart', plugin_dir_url( __FILE__ ) . 'js/multipart.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/amazon-store-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add menu items in admin area
	 *
	 * @since    1.0.0
	 */
	public function admin_menus_items() {
		if (AS_SETTINGS_SAVED) {
			add_menu_page('Amazon Store', 'Amazon Store', 'manage_options', 'bbil_amazon_store', function (){ $this->as_credential(); } ,'',10);
			add_submenu_page('bbil_amazon_store', 'amazon credential', 'amazon credential', 'manage_options', 'bbil_amazon_store' );
			add_submenu_page('bbil_amazon_store', 'Amazon preference', 'Amazon preference', 'manage_options', 'bbil_amazone_preference', function (){ $this->as_preference(); } );
			add_submenu_page('bbil_amazon_store', 'Settings', 'Settings', 'manage_options', 'bbil_amazon_settings ', function (){ $this->as_settings(); } );
		} else {
			add_menu_page('Amazon Store', 'Amazon Store', 'manage_options', 'bbil_amazon_store', function (){ $this->as_setup(); } ,'',10);
			add_submenu_page('bbil_amazon_store', 'Amazon Setting', 'Amazon Setting', 'manage_options', 'bbil_amazon_store' );
		}
	}

	/**
	 * Add setup menu items in admin area
	 *
	 * @since    1.0.0
	 */
	public function as_setup() {
		include plugin_dir_path( dirname( __FILE__ ) ).'admin/partials/amazon-store-admin-setup.php';
	}

	/**
	 * Add credential menu items in admin area
	 *
	 * @since    1.0.0
	 */
	public function as_credential() {
		echo 'as_credential';
	}

	/**
	 * Add preferences menu items in admin area
	 *
	 * @since    1.0.0
	 */
	public function as_preference() {
		echo 'as_preference';
	}

	/**
	 * Add settings menu items in admin area
	 *
	 * @since    1.0.0
	 */
	public function as_settings() {
		echo 'as_settings';
	}
}
