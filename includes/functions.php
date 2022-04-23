<?php

/**
 * Insert a new address
 *
 * @param array $args
 *
 * @return int|WP_Error
 */
function aba_booking_insert($args = []) {
      global $wpdb;

      if (empty($args['name'])) {
            return new \WP_Error('no-name', __('You must provide a name', 'ABA_BOOKING-popup-creator'));
      }

      $defaults = [
            "name"       => '',
            "email"    => '',
            "created_by" => get_current_user_id(),
            "created_at" => current_time('mysql'),
      ];

      $data = wp_parse_args($args, $defaults);

      if (isset($data['id'])) {

            $id = $data['id'];
            unset($data['id']);

            $updated = $wpdb->update(
                  "{$wpdb->prefix}aba_booking_subscriber",
                  $data,
                  ['id' => $id],
                  [
                        '%s',
                        '%s',
                        '%d',
                        '%s',
                  ],
                  ['%d']
            );

            return $updated;
      } else {

            $inserted = $wpdb->insert(
                  "{$wpdb->prefix}aba_booking_subscriber",
                  $data,
                  [
                        '%s',
                        '%s',
                        '%d',
                        '%s',
                  ]
            );

            if (!$inserted) {
                  return new \WP_Error('failed-to-insert', __('Failed to insert', 'ABA_BOOKING-popup-creator'));
            }

            return $wpdb->insert_id;
      }
}

/**
 * Fetch address
 *
 * @param array
 *
 * @return array
 */
function aba_booking_get_addresses($args = []) {
      global $wpdb;

      $defaults = [
            "offset"  => 0,
            "number"  => 20,
            "orderby" => "id",
            "order"   => "ASC",
      ];

      $args = wp_parse_args($args, $defaults);

      $items = $wpdb->get_results(
            $wpdb->prepare(
                  "SELECT * FROM {$wpdb->prefix}ac_addresses
            ORDER BY {$args["orderby"]} {$args["order"]}
            LIMIT %d OFFSET %d",
                  $args["number"],
                  $args["offset"],
            )
      );

      return $items;
}

/**
 * Get the count
 *
 * @return int
 */
function aba_booking_addresses_count() {
      global $wpdb;

      return (int) $wpdb->get_var("SELECT count(id) FROM {$wpdb->prefix}ac_addresses ");
}

/**
 * Fetch a single contact form DB
 *
 * @param int $id
 *
 * @return object
 */
function aba_booking_get_address($id) {
      global $wpdb; // Global WPDB class object

      $address = wp_cache_get('book-' . $id, 'address');
      if (false === $address) {
            $address = $wpdb->get_row(
                  $wpdb->prepare(  // use prepare for avoid sql injection
                        "SELECT  * FROM {$wpdb->prefix}ac_addresses WHERE id = %d",
                        $id // select by id
                  )
            );

            wp_cache_set('book-' . $id, $address, 'address');
      }
      return $address;
}

/**
 * Delete an address
 *
 * @param int $id
 *
 * @return int|boolean
 */
function aba_booking_delete_address($id) {
      global $wpdb;

      return $wpdb->delete(
            $wpdb->prefix . 'ac_addresses',
            ['id' => $id],
            ['%d'],
      );
}


/**
 * Register aba-booking image sizes
 */
function aba_booking_register_image_size() {
      add_image_size('popup-creator-landscape', 800, 600, true);
      add_image_size('popup-creator-square', 500, 500, true);
      add_image_size('popup-creator-thumbnail', 70);
}

aba_booking_register_image_size();

// Form input field and label 
function aba_booking_inputLabel($for, $name) {
      echo '<label for="' . $for . '">' . __($name, 'aba-booking') . '</label>';
}

function aba_booking_input_field($type = "text", $id = '', $name = '', $placeholder = '', $value = '', $class = "regular-text aba_booking_input") {
      printf(
            '<input 
                  type="%s" 
                  id="%s" 
                  name="%s" 
                  placeholder="%s" 
                  value="%s" 
                  class="%s" 
                  require
            />',

            $type,
            $id,
            $name,
            $placeholder,
            $value,
            $class
      );
}


// Change Add title to 
function aba_booking_courses_title($title) {
      $screen = get_current_screen();

      if ('aba_booking_courses' == $screen->post_type) {
            $title = __('Add Course Name', 'aba-booking');
      }

      return $title;
}

add_filter('enter_title_here', 'aba_booking_courses_title');


// Change Add title to 
function aba_booking_departments_title($title) {
      $screen = get_current_screen();

      if ('aba_booking_dept' == $screen->post_type) {
            $title = __('Add Department Name', 'aba-booking');
      }

      return $title;
}

add_filter('enter_title_here', 'aba_booking_departments_title');

// Change Add title to 
function aba_booking_semester_title($title) {
      $screen = get_current_screen();

      if ('aba_booking_semester' == $screen->post_type) {
            $title = __('Add Semester Name', 'aba-booking');
      }

      return $title;
}

add_filter('enter_title_here', 'aba_booking_semester_title');
/**
 * Insert users to db
 *
 * @param array $args
 * @return int|WP_Error
 */
function aba_booking_insert_users($args = []) {
      global $wpdb;

      if (empty($args['name'])) {
            return new \WP_Error('no-name', __('You must provide a name', 'ABA_BOOKING-popup-creator'));
      }

      if (empty($args['email'])) {
            return new \WP_Error('no-email', __('You must provide a email address', 'ABA_BOOKING-popup-creator'));
      }
      if (empty($args['phone'])) {
            return new \WP_Error('no-phone', __('You must provide a phone number', 'ABA_BOOKING-popup-creator'));
      }

      $defaults = [
            'name'            => '',
            'email'           => '',
            'phone'           => '',
            'address'         => '',
            'created_by'      => get_current_user_id(),
            'created_at'      => current_time('mysql'),
      ];

      $data = wp_parse_args($args, $defaults);


      $inserted = $wpdb->insert(
            "{$wpdb->prefix}aba_booking_users",
            $data,
            [
                  '%s',
                  '%s',
                  '%s',
                  '%s',
                  '%d',
                  '%s',
            ]
      );

      if (!$inserted) {
            return new \WP_Error('failed-to-insert', __('Failed to insert', 'ABA_BOOKING-popup-creator'));
      }

      return $wpdb->insert_id;
}


/* Create Staff Member User Role */
add_role(
      'aba_teacher', //  System name of the role.
      __('Teacher'), // Display name of the role.
      array(
            'read'  => true,
            'delete_posts'  => true,
            'delete_published_posts' => true,
            'edit_posts'   => true,
            'publish_posts' => true,
            'upload_files'  => true,
            'edit_pages'  => true,
            'edit_published_pages'  =>  true,
            'publish_pages'  => true,
            'delete_published_pages' => false, // This user will NOT be able to  delete published pages.
      )
);

/* Create Staff Member User Role */
add_role(
      'aba_student', //  System name of the role.
      __('Student'), // Display name of the role.
      array(
            'read'  => true,
            'delete_posts'  => true,
            'delete_published_posts' => true,
            'edit_posts'   => true,
            'publish_posts' => true,
            'upload_files'  => true,
            'edit_pages'  => true,
            'edit_published_pages'  =>  true,
            'publish_pages'  => true,
            'delete_published_pages' => false, // This user will NOT be able to  delete published pages.
      )
);


/* Upgrade the Author Role */
function author_level_up() {
      // Retrieve the  Author role.
      $role = get_role(  'aba_teacher' );
      
      // Let's add a set  of new capabilities we want Authors to have.
      $role->add_cap(  'edit_pages' );
      $role->add_cap(  'edit_published_pages' );
      $role->add_cap(  'publish_pages' );
  }
  add_action( 'admin_init', 'author_level_up');