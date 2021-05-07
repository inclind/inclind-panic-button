<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.inclind.com/
 * @since      1.0.0
 *
 * @package    Inclind_Panic_Button
 * @subpackage Inclind_Panic_Button/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Inclind_Panic_Button
 * @subpackage Inclind_Panic_Button/public
 * @author     Carson Schulz <schulzcarson@gmail.com>
 */
class Inclind_Panic_Button_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Create the shortcode to be used by the end user
	 *
	 * @since    1.0.0
	 */
	public function create_shortcode( $args ) {

		// Default values
		$text = __( 'Exit', 'inclind-panic-button' );
		$redirect_url = 'https://www.google.com';     // Where should we send them? Default is Google
		$default_class = true;
		$classes = [
			'inclind-panic-button'
		];

		// Lets process any arguments if we have them
		if ( $args ) {

			// Handle the text
			if ( array_key_exists( 'text', $args ) ) {
				$text = esc_html( $args['text'] );
			}

			// If there is a redirect location
			if ( array_key_exists( 'location', $args ) ) {
				$redirect_url = esc_url( $args['location'] );
			}

			// If the user does not want the default class we can accomodate
			if ( array_key_exists( 'default_class', $args ) ) {
				if ( $args['default_class'] === "false" ) {
					$classes = [];
				}
			}

			// Handle the classes
			if ( array_key_exists( 'classes', $args ) ) {
				$arg_classes = explode( ' ', $args['classes'] );

				foreach ( $arg_classes as $class ) {
					$classes[] = esc_attr( $class );
				}
			}
		}

		// Combine the classes
		$classes_str = implode( ' ', $classes );

		// Send the button
		return "<button id=\"inclind-panic-button\" class=\"$classes_str\" data-redirect-url=\"$redirect_url\">$text</button>";
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Inclind_Panic_Button_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Inclind_Panic_Button_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/inclind-panic-button.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Inclind_Panic_Button_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Inclind_Panic_Button_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/inclind-panic-button.js', array( 'jquery' ), $this->version, false );

	}

}
