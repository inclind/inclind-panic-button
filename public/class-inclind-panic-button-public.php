<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.inclind.com/
 * @since      1.0.1
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
	 * @since    1.0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.1
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
	 * @since    1.0.1
	 */
	public function create_shortcode( $args ) {

		// Get the options from the settings page
		$settings = get_option( 'inclind_panic_button_settings' );

		// Default values
		$text = __( 'Exit', 'inclind-panic-button' );
		$redirect_url = 'https://www.google.com';     // Where should we send them? Default is Google
		$default_class = true;
		$classes = [
			'inclind-panic-button'
		];

		// Process the user settings if we have them
		if ( $settings ) {

			// Button Text
			if ( array_key_exists( 'inclind_panic_button_text', $settings ) ) {
				if ( $settings['inclind_panic_button_text'] ) {
					$text = $settings['inclind_panic_button_text'];
				}
			}

			// Redirect URL
			if ( array_key_exists( 'inclind_panic_button_url_field', $settings ) ) {
				if ( $settings['inclind_panic_button_url_field'] ) {
					$redirect_url = $settings['inclind_panic_button_url_field'];
				}
			}

		}

		// Lets process any shortcode arguments if we have them
		if ( $args ) {

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
	 * Outputs a fixed button if so defined
	 *
	 * @since    1.0.1
	 */
	public function create_button() {

		// Get the plugin settings
		$settings = get_option( 'inclind_panic_button_settings' );

		// Custom button text?
		if ( array_key_exists( 'inclind_panic_button_text', $settings) && $settings['inclind_panic_button_text'] ) {
			$button_text = $settings['inclind_panic_button_text'];
		} else {
			$button_text = __( 'Exit', 'inclind-panic-button' );
		}

		// Custom redirect URL?
		if ( array_key_exists( 'inclind_panic_button_url_field', $settings) && $settings['inclind_panic_button_url_field'] ) {
			$redirect_url = $settings['inclind_panic_button_url_field'];
		} else {
			$redirect_url = 'https://www.google.com';
		}

		// Check to see if we can show the button
		if ( array_key_exists( 'inclind_panic_button_show_fixed', $settings) && $settings['inclind_panic_button_show_fixed'] ) {

			// Icon
			$alert_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform:;-ms-filter:"><path d="M12.884,2.532c-0.346-0.654-1.422-0.654-1.768,0l-9,17c-0.164,0.31-0.154,0.684,0.027,0.983C2.324,20.816,2.649,21,3,21h18 c0.351,0,0.676-0.184,0.856-0.484c0.182-0.3,0.191-0.674,0.027-0.983L12.884,2.532z M13,18h-2v-2h2V18z M11,14V9h2l0.001,5H11z"></path></svg>';

			// Print the button
			printf( '<button class="inclind-panic-button-fixed" id="inclind-panic-button-fixed" data-redirect-url="%s">%s %s</button>',  $redirect_url, $alert_icon, $button_text );
		}
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.1
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
	 * @since    1.0.1
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
