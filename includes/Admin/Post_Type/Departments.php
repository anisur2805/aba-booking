<?php 
namespace Aba_Booking\Admin\Post_Type;
/**
 * Departments custom post type main class file
 */
class Departments
{
      public function __construct() {
            add_action( 'init', array( $this, 'register_departments_cpt') );            
      }
      
      public function register_departments_cpt() {
            $labels = array(
                  'name'               => __( 'Departments', 'aba-booking' ),
                  'singular_name'      => __( 'Departments', 'aba-booking' ),
                  'search_items'       => __('Search Departments', 'aba-booking' ),
                  'all_items'          => __('Departments', 'aba-booking'),
                  'add_new_item'       => __('Add New Department', 'aba-booking'),
                  'add_new'            => __('Add New Department', 'aba-booking'),
                  'new_item'           => __('New Departments', 'aba-booking'),
                  'edit_item'          => __('Edit Departments', 'aba-booking'),
                  'update_item'        => __('Update Departments', 'aba-booking'),
                  'view_item'          => __('View Departments', 'aba-booking'),
                  'remove_featured_image' => __('Remove Departments Image', 'aba-booking'),
            );
            $args = array(
                  'label'               => __( 'Departments', 'aba-booking' ),
                  'description'         => __( 'Departments Description', 'aba-booking' ),
                  'labels'              => $labels,
                  'supports'            => array( 'title' ),
                  'hierarchical'        => false,
                  'public'              => false,
                  'publicly_queryable'  => true,
                  'show_ui'             => true,
                  'show_in_menu'        => true,
                  'show_in_rest'        => true,
                  'menu_position'       => 60,
                  'show_in_admin_bar'   => true,
                  'show_in_nav_menus'   => true,
                  'has_archive'         => false,
                  'exclude_from_search' => false,
                  'capability_type'     => 'post',
                  'rewrite'             => array( 'slug' => 'aba-booking-departments', 'with_front' => true ),
                  // 'menu_icon'           => 'dashicons-screenoptions',
                  'show_in_menu'          => 'aba-booking',
            );
            register_post_type( 'aba_booking_dept', $args );
      }
}
