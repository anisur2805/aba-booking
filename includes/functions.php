<?php

/**
 * Insert a new address
 *
 * @param array $args
 *
 * @return int|WP_Error
 */
function aba_booking_insert( $args = [] ) {
      global $wpdb;

      if ( empty( $args['name'] ) ) {
            return new \WP_Error( 'no-name', __( 'You must provide a name', 'aba-booking' ) );
      }

      $defaults = [
            "name"       => '',
            "email"      => '',
            "created_by" => get_current_user_id(),
            "created_at" => current_time( 'mysql' ),
      ];

      $data = wp_parse_args( $args, $defaults );

      if ( isset( $data['id'] ) ) {

            $id = $data['id'];
            unset( $data['id'] );

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

            if ( !$inserted ) {
                  return new \WP_Error( 'failed-to-insert', __( 'Failed to insert', 'aba-booking' ) );
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
function aba_booking_get_addresses( $args = [] ) {
      global $wpdb;

      $defaults = [
            "offset"  => 0,
            "number"  => 20,
            "orderby" => "id",
            "order"   => "ASC",
      ];

      $args = wp_parse_args( $args, $defaults );

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

      return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}ac_addresses " );
}

/**
 * Fetch a single contact form DB
 *
 * @param int $id
 *
 * @return object
 */
function aba_booking_get_students( $id ) {
      global $wpdb; // Global WPDB class object

      $student = wp_cache_get( 'abas-' . $id, 'student' );
      if ( false === $student ) {
            $student = $wpdb->get_row(
                  $wpdb->prepare(  // use prepare for avoid sql injection
                        "SELECT  * FROM {$wpdb->prefix}aba_booking_student WHERE id = %d",
                        $id // select by id
                  )
            );

            wp_cache_set( 'abas-' . $id, $student, 'student' );
      }
      return $student;
}

/**
 * Delete an student
 *
 * @param int $id
 *
 * @return int|boolean
 */
function aba_booking_delete_student( $id ) {
      global $wpdb;

      return $wpdb->delete(
            $wpdb->prefix . 'aba_booking_student',
            ['id' => $id],
            ['%d'],
      );
}

/**
 * Register aba-booking image sizes
 */
function aba_booking_register_image_size() {
      add_image_size( 'popup-creator-landscape', 800, 600, true );
      add_image_size( 'popup-creator-square', 500, 500, true );
      add_image_size( 'popup-creator-thumbnail', 70 );
}

aba_booking_register_image_size();

// Form input field and label
function aba_booking_inputLabel( $for, $name ) {
      echo '<label for="' . $for . '">' . __( $name, 'aba-booking' ) . '</label>';
}

function aba_booking_input_field( $type = "text", $id = '', $name = '', $placeholder = '', $value = '', $class = "regular-text aba_booking_input" ) {
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
function aba_booking_courses_title( $title ) {
      $screen = get_current_screen();

      if ( 'aba_booking_courses' == $screen->post_type ) {
            $title = __( 'Add Course Name', 'aba-booking' );
      }

      return $title;
}

add_filter( 'enter_title_here', 'aba_booking_courses_title' );

// Change Add title to
function aba_booking_departments_title( $title ) {
      $screen = get_current_screen();

      if ( 'aba_booking_dept' == $screen->post_type ) {
            $title = __( 'Add Department Name', 'aba-booking' );
      }

      return $title;
}

add_filter( 'enter_title_here', 'aba_booking_departments_title' );

// Change Add title to
function aba_booking_semester_title( $title ) {
      $screen = get_current_screen();

      if ( 'aba_booking_semester' == $screen->post_type ) {
            $title = __( 'Add Semester Name', 'aba-booking' );
      }

      return $title;
}

add_filter( 'enter_title_here', 'aba_booking_semester_title' );
/**
 * Insert users to db
 *
 * @param array $args
 * @return int|WP_Error
 */
function aba_student_insert( $args = [] ) {
      global $wpdb;

      if ( empty( $args['name'] ) ) {
            return new \WP_Error( 'no-name', __( 'You must provide a name', 'aba-booking' ) );
      }

      if ( empty( $args['email'] ) ) {
            return new \WP_Error( 'no-email', __( 'You must provide a email address', 'aba-booking' ) );
      }
      if ( empty( $args['password'] ) ) {
            return new \WP_Error( 'no-password', __( 'You must provide a password number', 'aba-booking' ) );
      }

      if ( empty( $args['student_id'] ) ) {
            return new \WP_Error( 'no-student_id', __( 'You must provide a student_id number', 'aba-booking' ) );
      }

      if ( empty( $args['department'] ) ) {
            return new \WP_Error( 'no-department', __( 'You must provide a department number', 'aba-booking' ) );
      }

      $defaults = [
            'name'       => '',
            'email'      => '',
            'password'   => '',
            'student_id' => '',
            'department' => '',
            'created_by' => get_current_user_id(),
            'created_at' => current_time( 'mysql' ),
      ];

      $data = wp_parse_args( $args, $defaults );

      if ( isset( $data['id'] ) ) {

            $id = $data['id'];
            unset( $data['id'] );

            $updated = $wpdb->update(
                  "{$wpdb->prefix}aba_booking_student",
                  $data,
                  ['id' => $id],
                  [
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%d',
                        '%s',
                  ],
                  ['%d']
            );

            return $updated;
      } else {

            // globalInsert('aba_booking_student', $data,[
            //       '%s',
            //       '%s',
            //       '%s',
            //       '%s',
            //       '%s',
            //       '%d',
            //       '%s',
            // ]);


            $inserted = $wpdb->insert(
                  "{$wpdb->prefix}aba_booking_student",
                  $data,
                  [
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%d',
                        '%s',
                  ]
            );

            if ( !$inserted ) {
                  return new \WP_Error( 'failed-to-insert', __( 'Failed to insert', 'aba-booking' ) );
            }

            return $wpdb->insert_id;
      }
}

/* Create Staff Member User Role */
add_role(
      'aba_teacher', //  System name of the role.
      __( 'Teacher' ), // Display name of the role.
      array(
            'read'                   => true,
            'delete_posts'           => true,
            'delete_published_posts' => true,
            'edit_posts'             => true,
            'publish_posts'          => true,
            'upload_files'           => true,
            'edit_pages'             => true,
            'edit_published_pages'   => true,
            'publish_pages'          => true,
            'delete_published_pages' => false, // This user will NOT be able to  delete published pages.
      )
);

/* Create Staff Member User Role */
add_role(
      'aba_student', //  System name of the role.
      __( 'Student' ), // Display name of the role.
      array(
            'read'                   => true,
            'delete_posts'           => true,
            'delete_published_posts' => true,
            'edit_posts'             => true,
            'publish_posts'          => true,
            'upload_files'           => true,
            'edit_pages'             => true,
            'edit_published_pages'   => true,
            'publish_pages'          => true,
            'delete_published_pages' => false, // This user will NOT be able to  delete published pages.
      )
);

/* Upgrade the Author Role */
function author_level_up() {
      // Retrieve the  Author role.
      $role = get_role( 'aba_teacher' );

      // Let's add a set  of new capabilities we want Authors to have.
      $role->add_cap( 'edit_pages' );
      $role->add_cap( 'edit_published_pages' );
      $role->add_cap( 'publish_pages' );
}

add_action( 'admin_init', 'author_level_up' );

/**
 * Generate Student id
 * ex. 201811050101
 */
function get_student_roll() {
      global $wpdb;
      $id         = 'id';
      $student_id = $wpdb->get_row( $wpdb->prepare( "SELECT student_id FROM {$wpdb->prefix}aba_booking_student ORDER BY %s DESC", $id ), ARRAY_A );

      $roll_start = 1;
      $date       = date( 'Ymd' );

      $validate_student_id = isset( $student_id['student_id'] ) ? $student_id['student_id'] : 1;
      $init_student_id     = $date . $roll_start;
      $exists_id           = $validate_student_id + $roll_start;
      $std_id_res          = isset( $student_id['student_id'] ) ? $exists_id : $init_student_id;

      return $std_id_res;
}

get_student_roll();

function globalInsert($tableName, $data = [], $format = null ) {
      global $wpdb;

      if ( 0 == count( $data ) ) {
            return false;
      }

      $inserted = $wpdb->insert("{$wpdb->prefix}". $tableName,$data, $format);
      
      if (!$inserted ) {
            return new \WP_Error( 'failed-to-insert', __( 'Failed to insert', 'aba-booking' ) );
      }

      return $wpdb->insert_id; 
}




function globalUpdate($tableName, $update = [], $where, $format = null, $whereFormat = null ) {
      global $wpdb;

      if ( 0 == count( $update ) ) {
            return false;
      } 
      
      return $wpdb->update(
                  "{$wpdb->prefix}". $tableName,
                  $update,
                  $where,
                  $format,
                  $whereFormat
            );    
}
