<?php
 /**
  * Plugin Name: Booking Appointment
  * Description: Awesome Booking Appointment 
  * Plugin URI:  http://github.com/anisur2805/aba-booking
  * Version:     1.0
  * Author:      Anisur Rahman
  * Author URI:  http://github.com/anisur2805
  * Text Domain: aba-booking
  * License:     GPL v2 or later
  * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
  */

use Aba_Booking\Admin;
use Aba_Booking\Ajax;
use Aba_Booking\Assets;
use Aba_Booking\Frontend;
use Aba_Booking\Installer;

if ( !defined( 'ABSPATH' ) ) {
      exit;
}

require_once __DIR__ . "/vendor/autoload.php";

      final class ABA_BOOKING {
            const version = '1.0';
            
            private function __construct() {
                  $this->define_constants();
                  add_action( 'plugins_loaded', array( $this, 'init_plugin') );
                  
                  register_activation_hook( __FILE__, array( $this, 'activate' ) );
            }
            
            /**
             * Initialize a singleton instance
             *
             * @return Popup_Creator
             */
            public static function init() {
                  static $instance = false;
                  
                  if ( ! $instance ) {
                        $instance = new self();
                  }

                  return $instance;
            }
            
            /**
             * define plugin require constants
             *
             * @return void
             */
            public function define_constants() {
                  define( 'ABA_BOOKING_VERSION', self::version );
                  define( 'ABA_BOOKING_FILE', __FILE__ );
                  define( "ABA_BOOKING_PATH", __DIR__ );
                  define( "ABA_BOOKING_URL", plugins_url( '', __FILE__ ) );
                  define( "ABA_BOOKING_ASSETS", ABA_BOOKING_URL . '/assets' );
                  define( "ABA_BOOKING_INCLUDES", ABA_BOOKING_URL . "/includes" ); 
            }
            
            /**
             * Do stuff upon plugin installation
             */
            public function activate() {
                  
                  $installer = new Installer();
                  $installer->run();
                  
                  $installed = get_option( 'aba_booking_installed' );
                  
                  if( ! $installed ) {
                        update_option( 'aba_booking_installed', time() );
                  }
                  
                  update_option( 'aba_booking_version', ABA_BOOKING_VERSION );
            }
            
            /**
             * Load plugin text domain 
             */
            public function init_plugin() {
                  load_plugin_textdomain( 'aba-booking', false, plugin_dir_path( __FILE__ ) . 'languages' );
                  
                  if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
                        new Ajax();
                  }
                  
                  if( is_admin() ) {
                        // Instantiate Meta box
                        new Admin();
                  } else {
                       // Instantiate Front End Popup
                        new Frontend();
                  }
                  
                  new Assets();
            }
           
      }
            
/**
 * Initialize the main plugin
 *
 * @return ABA_BOOKING
 */
function aba_booking() {
      return ABA_BOOKING::init();
}

// kick-off the plugin
aba_booking();