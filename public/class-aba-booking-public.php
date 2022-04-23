<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Aba_Booking
 * @subpackage Aba_Booking/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Aba_Booking
 * @subpackage Aba_Booking/public
 * @author     Your Name <email@example.com>
 */
class Aba_Booking_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $aba_booking    The ID of this plugin.
	 */
	private $aba_booking;

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
	 * @param      string    $aba_booking       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $aba_booking, $version ) {

		$this->Aba_Booking = $aba_booking;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'dashicons' );

		$my_page = get_option('aba_booking_page');
		if($my_page && is_page($my_page)) {
			if (!in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
				$CSSfiles = scandir(dirname(__FILE__) . '/create-react-app-name/build/static/css/');
			 	foreach($CSSfiles as $filename) {
					if(strpos($filename,'.css')&&!strpos($filename,'.css.map')) {
						wp_enqueue_style( 'aba_booking_react_css', plugin_dir_url( __FILE__ ) . 'create-react-app-name/build/static/css/' . $filename, array(), mt_rand(10,1000), 'all' );
					}
			 	}
			}
		} else {
			wp_enqueue_style( $this->Aba_Booking, plugin_dir_url( __FILE__ ) . 'css/aba-booking-public.css', array(), mt_rand(10,1000), 'all' );
		}

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		$my_page = get_option('aba_booking_page');
		if($my_page && is_page($my_page)) {
			if (!in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
	    	// code for localhost here
				// PROD
			 	$JSfiles = scandir(dirname(__FILE__) . '/create-react-app-name/build/static/js/');
			 	$react_js_to_load = '';
			 	foreach($JSfiles as $filename) {
			 		if(strpos($filename,'.js')&&!strpos($filename,'.js.map')) {
			 			$react_js_to_load = plugin_dir_url( __FILE__ ) . 'create-react-app-name/build/static/js/' . $filename;
			 		}
			 	}
			} else {
				$react_js_to_load = 'http://localhost:3000/static/js/bundle.js';
			}
		 	// DEV
		 	// React dynamic loading
		 	wp_enqueue_script('aba_booking_react', $react_js_to_load, '', mt_rand(10,1000), true);
		 	// wp_register_script('aba_booking_react', $react_js_to_load, '', mt_rand(10,1000), true);
      //
			// wp_localize_script('aba_booking_react', 'params', array(
			//     'nonce' => wp_create_nonce('wp_rest'),
			//     'nonce_verify' => wp_verify_nonce($_REQUEST['X-WP-Nonce'], 'wp_rest')
			// ));
			// wp_enqueue_script( 'aba_booking_react' );
		} else {
			wp_enqueue_script( $this->Aba_Booking, plugin_dir_url( __FILE__ ) . 'js/aba-booking-public.js', array( 'jquery' ), mt_rand(10,1000), false );
		}

	}

	/**
	 * Creating custom CRA app page template
	 *
	 * @since    1.0.0
	 */
	public function aba_booking_cra_template( $template ) {
		$my_page = get_option('aba_booking_page');
		$file_name = 'aba-booking-page-template.php';

    if ( $my_page && is_page( $my_page ) ) {
        if ( locate_template( $file_name ) ) {
            $template = locate_template( $file_name );
        } else {
            // Template not found in theme's folder, use plugin's template as a fallback
            $template = plugin_dir_path( __FILE__ ) . $file_name;
        }
    }

    return $template;
	}

}
