<?php 
namespace Aba_Booking\Admin\Post_Type;
/**
 * Courses custom post type main class file
 */
class Courses
{
      public function __construct() {
            add_action( 'init', array( $this, 'register_courses_cpt') );            
      }
      
      public function register_courses_cpt() {
            $labels = array(
                  'name'               => __( 'Courses', 'aba-booking' ),
                  'singular_name'      => __( 'Course', 'aba-booking' ),
                  'featured_image'     => __( 'Course Image', 'aba-booking' ),
                  'set_featured_image' => __( 'Set Course Image as Background', 'aba-booking' ),
                  'search_items'       => __('Search Course', 'aba-booking' ),
                  'all_items'          => __('All Courses', 'aba-booking'),
                  'add_new_item'       => __('Add New Course', 'aba-booking'),
                  'add_new'            => __('Add New Course', 'aba-booking'),
                  'new_item'           => __('New Course', 'aba-booking'),
                  'edit_item'          => __('Edit Course', 'aba-booking'),
                  'update_item'        => __('Update Course', 'aba-booking'),
                  'view_item'          => __('View Course', 'aba-booking'),
                  'remove_featured_image' => __('Remove Course Image', 'aba-booking'),
            );
            $args = array(
                  'label'               => __( 'Courses', 'aba-booking' ),
                  'description'         => __( 'Course Description', 'aba-booking' ),
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
                  'rewrite'             => array( 'slug' => 'aba-booking-courses', 'with_front' => true ),
                  'menu_icon'           => 'dashicons-screenoptions',
            );
            register_post_type( 'aba_booking_courses', $args );
      }
}
