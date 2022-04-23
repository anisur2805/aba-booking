<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Aba_Booking
 *
 * @wordpress-plugin
 * Plugin Name:       ABA Booking Appointment
 * Plugin URI:        http://github.com/anisur2805/aba-booking/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Anisur Rahman
 * Author URI:        http://github.com/anisur2805
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       aba-booking
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ABA_BOOKING_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-aba-booking-activator.php
 */
function activate_aba_booking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aba-booking-activator.php';
	Aba_Booking_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-aba-booking-deactivator.php
 */
function deactivate_aba_booking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aba-booking-deactivator.php';
	Aba_Booking_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_aba_booking' );
register_deactivation_hook( __FILE__, 'deactivate_aba_booking' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-aba-booking.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_aba_booking() {

	$plugin = new Aba_Booking();
	$plugin->run();

}
run_aba_booking();
