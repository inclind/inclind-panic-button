<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/inclind/inclind-panic-button
 * @since             1.0.1
 * @package           Inclind_Panic_Button
 *
 * @wordpress-plugin
 * Plugin Name:       Inclind Panic Button
 * Plugin URI:        https://github.com/inclind/inclind-panic-button
 * Description:       Creates an [inclind-panic-button] shortcode for use in Elementor and others.
 * Version:           1.0.1
 * Author:            Carson Schulz
 * Author URI:        https://www.inclind.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       inclind-panic-button
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.1 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'INCLIND_PANIC_BUTTON_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-inclind-panic-button-activator.php
 */
function activate_inclind_panic_button() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-inclind-panic-button-activator.php';
	Inclind_Panic_Button_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-inclind-panic-button-deactivator.php
 */
function deactivate_inclind_panic_button() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-inclind-panic-button-deactivator.php';
	Inclind_Panic_Button_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_inclind_panic_button' );
register_deactivation_hook( __FILE__, 'deactivate_inclind_panic_button' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-inclind-panic-button.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.1
 */
function run_inclind_panic_button() {

	$plugin = new Inclind_Panic_Button();
	$plugin->run();

}
run_inclind_panic_button();
