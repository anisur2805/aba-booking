<?php 
namespace Aba_Booking\Admin\Post_Type;
/**
 * Semester custom post type main class file
 */
class Semester
{
      public function __construct() {
            add_action( 'init', array( $this, 'register_semester_cpt') );            
      }
      
      public function register_semester_cpt() {
            $labels = array(
                  'name'               => __( 'Semester', 'aba-booking' ),
                  'singular_name'      => __( 'Semester', 'aba-booking' ),
                  'search_items'       => __('Search Semester', 'aba-booking' ),
                  'all_items'          => __('Semester', 'aba-booking'),
                  'add_new_item'       => __('Add New Semester', 'aba-booking'),
                  'add_new'            => __('Add New Semester', 'aba-booking'),
                  'new_item'           => __('New Semester', 'aba-booking'),
                  'edit_item'          => __('Edit Semester', 'aba-booking'),
                  'update_item'        => __('Update Semester', 'aba-booking'),
                  'view_item'          => __('View Semester', 'aba-booking'),
                  'remove_featured_image' => __('Remove Semester Image', 'aba-booking'),
            );
            $args = array(
                  'label'               => __( 'Semester', 'aba-booking' ),
                  'description'         => __( 'Semester Description', 'aba-booking' ),
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
                  'rewrite'             => array( 'slug' => 'aba-booking-semester', 'with_front' => true ),
                  'show_in_menu'          => 'aba-booking',
            );
            register_post_type( 'aba_booking_semester', $args );
      }
}
