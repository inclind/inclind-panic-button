<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.inclind.com/
 * @since      1.0.0
 *
 * @package    Inclind_Panic_Button
 * @subpackage Inclind_Panic_Button/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Inclind_Panic_Button
 * @subpackage Inclind_Panic_Button/admin
 * @author     Carson Schulz <schulzcarson@gmail.com>
 */
class Inclind_Panic_Button_Admin {

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
	 * Checks to see if ACF is installed, if not we need to notify the user
	 *
	 * @since    1.0.0
	 */
	public function acf_check() {

		if ( ! class_exists( 'ACF' ) ) {
			$class = 'notice notice-warning is-dismissible';
			$message = __( 'The Inclind Panic Button requires that ACF Pro is installed and activated for customization. If not, default customization will be used.', 'inclind-panic-button' );
		}

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );

	}

}
