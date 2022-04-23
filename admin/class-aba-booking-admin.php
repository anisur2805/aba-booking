<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Aba_Booking
 * @subpackage Aba_Booking/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Aba_Booking
 * @subpackage Aba_Booking/admin
 * @author     Your Name <email@example.com>
 */
class Aba_Booking_Admin {

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
	 * @param      string    $aba_booking       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $aba_booking, $version ) {

		$this->Aba_Booking = $aba_booking;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Aba_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aba_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->Aba_Booking, plugin_dir_url( __FILE__ ) . 'css/aba-booking-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Aba_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aba_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->Aba_Booking, plugin_dir_url( __FILE__ ) . 'js/aba-booking-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Create custom CRA page if not exists
	 *
	 * @since    1.0.0
	 */
	 function aba_booking_create_cra_page() {
			$my_page = get_option('aba_booking_page');
			if (!$my_page||FALSE === get_post_status( $my_page )) {
			    // Create post/page object
			    $my_new_page = array(
			        'post_title' => 'CRA App Page',
			        'post_content' => '',
			        'post_status' => 'publish',
							'post_type' => 'page'
			    );
			    // Insert the post into the database
			    $my_page = wp_insert_post( $my_new_page );
			    update_option('aba_booking_page',$my_page);
			}
	 }

	/**
	 * An example post type that you can remove.
	 *
	 * @since    1.0.0
	 */
 // public function create_aba_booking_post_type() {
	// 	 register_post_type( 'aba-booking-post-type',
	// 			 array(
	// 					 'labels' => array(
	// 							 'name' => 'Custom Post Type',
	// 							 'menu_name' => 'Custom',
	// 							 'singular_name' => 'Custom',
	// 							 'add_new' => 'Add New',
	// 							 'add_new_item' => 'Add New Custom',
	// 							 'edit' => 'Edit',
	// 							 'edit_item' => 'Edit Custom',
	// 							 'new_item' => 'New Custom',
	// 							 'view' => 'View',
	// 							 'view_item' => 'View Custom',
	// 							 'search_items' => 'Search Custom',
	// 							 'not_found' => 'No Custom found',
	// 							 'not_found_in_trash' => 'No Custom found in Trash',
	// 							 'parent' => 'Parent Custom'
	// 					 ),
	// 					 'public' => true,
	// 					 'show_in_rest' => true,
	// 					 'menu_position' => 15,
	// 					 'supports' => array( 'title' , 'editor', 'custom-fields', 'thumbnail', 'excerpt'),
	// 					 'taxonomies' => array( '' ),
	// 					 'menu_icon' => 'dashicons-welcome-learn-more',
	// 					 'has_archive' => true
	// 			 )
	// 	 );
 // }

 	/**
 	 * Add post type to rest
 	 *
 	 * @since    1.0.0
 	 */
 	// function aba_booking_add_post_type_to_rest() {
 	// 	global $wp_post_types;
 	// 	$wp_post_types['aba-booking-post-type']->show_in_rest = true;
 	// }

}
