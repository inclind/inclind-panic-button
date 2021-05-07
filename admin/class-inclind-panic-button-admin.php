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
	 * Register settings
	 *
	 * @since    1.0.0
	 */
	public function register_settings() {

		// Register
		register_setting(
			'inclind_panic_button_settings',
			'inclind_panic_button_settings',
			[
				'sanitize_callback' => [$this, 'validate_fields']
			]
		);

		// Entry section
		add_settings_section(
			'inclind_panic_button_entry_section',
			'Inclind Panic Button Settings',
			[$this, 'create_entry_section'],
			'inclind_panic_button'
		);

		// Button text field
		add_settings_field(
			'inclind_panic_button_text',
			'Button Text',
			[$this, 'button_text_field'],
			'inclind_panic_button',
			'inclind_panic_button_entry_section'
		);

		// Redirect URL field
		add_settings_field(
			'inclind_panic_button_url_field',
			'Redirect URL',
			[$this, 'redirect_url_field'],
			'inclind_panic_button',
			'inclind_panic_button_entry_section'
		);

		// Button toggle field
		add_settings_field(
			'inclind_panic_button_show_fixed',
			'Show Fixed Button',
			[$this, 'button_fixed_field'],
			'inclind_panic_button',
			'inclind_panic_button_entry_section'
		);


	}

	/**
	 * Section field
	 *
	 * @since    1.0.0
	 */
	public function create_entry_section( $arg ) {
		echo '<p>Here are the settings for the Inclind Panic Button. Do note that only valid URLs can be entered for the panic button URL.</p>';
	}

	/**
	 * Button text field
	 *
	 * @since    1.0.0
	 */
	public function button_text_field( $arg ) {
		$options = get_option( 'inclind_panic_button_settings' );
		printf(
			'<input type="text" name="%s" value="%s" />',
			esc_attr( 'inclind_panic_button_settings[inclind_panic_button_text]' ),
			esc_attr( $options['inclind_panic_button_text'] )
		);
	}

	/**
	 * Redirect URL field
	 *
	 * @since    1.0.0
	 */
	public function redirect_url_field( $arg ) {
		$options = get_option( 'inclind_panic_button_settings' );
		printf(
			'<input type="url" name="%s" value="%s" />',
			esc_attr( 'inclind_panic_button_settings[inclind_panic_button_url_field]' ),
			esc_attr( $options['inclind_panic_button_url_field'] )
		);
	}

	/**
	 * Button fixed field
	 *
	 * @since    1.0.0
	 */
	public function button_fixed_field( $arg ) {
		$options = get_option( 'inclind_panic_button_settings' );
		printf(
			'<input type="checkbox" name="%s" value="1" %s />',
			esc_attr( 'inclind_panic_button_settings[inclind_panic_button_show_fixed]' ),
			checked( 1, $options['inclind_panic_button_show_fixed'], false )
		);
	}

	/**
	 * Validate all the fields
	 *
	 * @since    1.0.0
	 */
	public function validate_fields( $input ) {
		$output['inclind_panic_button_text'] = sanitize_text_field( $input['inclind_panic_button_text'] );
		$output['inclind_panic_button_url_field'] = esc_url_raw( $input['inclind_panic_button_url_field'] );
		$output['inclind_panic_button_show_fixed'] = $input['inclind_panic_button_show_fixed'];
		return $output;
	}

	/**
	 * Add a settings page
	 *
	 * @since    1.0.0
	 */
	public function add_settings_page() {
		add_options_page(
			'Inclind Panic Button',
			'Panic Button',
			'manage_options',
			'inclind-panic-button',
			[$this, 'build_settings_page']
		);
	}

	/**
	 * Register a settings page
	 *
	 * @since    1.0.0
	 */
	public function build_settings_page() {
		?>
		<form action="options.php" method="post">
			<?php
			settings_fields( 'inclind_panic_button_settings' );
			do_settings_sections( 'inclind_panic_button' );
			?>
			<input
			type="submit"
			name="submit"
			class="button button-primary"
			value="<?php esc_attr_e( 'Save' ); ?>"
			/>
		</form>
		<?php

	}
}
