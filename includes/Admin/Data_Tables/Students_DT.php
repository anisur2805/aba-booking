<?php

namespace Aba_Booking\Admin\Data_Tables;


if (!class_exists('WP_List_Table')) {
      require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Students_DT extends \WP_List_Table {
      private $_items;
      private $users_data;

      public function __construct() {
            parent::__construct( [
                'singular' => 'student',
                'plural'   => 'students',
                'ajax'     => false,
            ] );
      }
      
      private function get_users_data( $search = '' ) {
            global $wpdb;
            if( !empty( $search ) ) {
                  return $wpdb->get_results(
                        "SELECT id, name, email, student_id, department from {$wpdb->prefix}aba_booking_student WHERE id LIKE '%{$search}%' OR name Like '%{$search}%' OR email Like '%{$search}%'", ARRAY_A );
            } else {
                  return $wpdb->get_results(
                        "SELECT id, name, email, student_id, department from {$wpdb->prefix}aba_booking_student", ARRAY_A );
            }
      }

      public function prepare_items() {
            
            if( isset($_GET['page'] ) && isset($_GET['s'] ) ) {
                  $this->users_data = $this->get_users_data( $_GET['s'] );
            } else {
                  $this->users_data = $this->get_users_data();
            }
            
            $columns  = $this->get_columns();
            $hidden   = $this->get_hidden_columns();
            $sortable = $this->get_sortable_columns();
            
            usort( $this->users_data, [ $this, 'sort_data' ] );

            $perPage     = 20;
            $currentPage = $this->get_pagenum();
            // $totalItems  = count($this->_items);
            $totalItems  = count($this->users_data);

            $this->set_pagination_args(array(
                  'total_items' => $totalItems,
                  'per_page'    => $perPage,
            ));

            // $data = array_slice($this->_items, ($currentPage - 1) * $perPage, $perPage);
            $this->users_data       = array_slice($this->users_data, ($currentPage - 1) * $perPage, $perPage);
            $this->_column_headers  = array($columns, $hidden, $sortable);
            $this->items            = $this->users_data;
            // $this->table_data($data);
      }

      public function get_columns() {
            $columns = array(
                  'cb'              => '<input type="checkbox" />',
                  'name'            => __('Name', 'dbdemo'),
                  'student_id'      => __('Student ID', 'dbdemo'),
                  'email'           => __('Email', 'dbdemo'),
                  'department'      => __('Department', 'dbdemo'),
            );

            return $columns;
      }

      public function column_cb($item) {
            return "<input type='checkbox' value='{$item["id"]}'/>"; }

      public function column_name($item) {
            $nonce = wp_create_nonce('student-edit');
            $actions = [];

            $actions['edit']   = sprintf('<a href="?page=%s&action=edit&id=%s">Edit</a>', $_REQUEST['page'], $item['id'] );
            $actions['delete'] = sprintf( 
			'<a href="#" class="submit_delete" title="%s" data-id="%s">%s</a>',
		__( 'Delete', 'aba-booking' ), $item['id'], __( 'Delete', 'aba-booking' ) );

            // $actions['delete'] = sprintf( 
            //       	'<a href="%s" class="submitdelete" title="%s" onclick="return confirm(\'Are you sure?\');">%s</a>', 
            //       wp_nonce_url( 
            //       	admin_url( 
            //       		'admin-post.php?action=aba-delete-student&id=' . $item['id'] ),
            //       		'aba-delete-student'), $item['id'],
            //       __( 'Delete', 'aba-booking' ), __( 'Delete', 'aba-booking' ) );


            return sprintf('<strong>%1$s</strong>%2$s', $item['name'], $this->row_actions($actions));
      }

      public function get_hidden_columns() {
            return array();
      }

      public function get_sortable_columns() {
            return array(
                  'id'              => array('id', false),
                  'student_id'      => array('student_id', false),
                  'name'            => array('name', false),
                  'email'           => array('email', false),
                  'department'      => array('department', false),
            );
      }

      public function get_bulk_actions() {
            $actions = [
                  'edit' => __('Edit', 'word-count'),
            ];

            return $actions;
      }

      public function dbdemo_user_search($item) {
            $name       = strtolower($item['name']);
            $search_name = sanitize_text_field($_REQUEST['s']);
            // $search_name = strtolower($search_name);     
            if (strpos($name, $search_name) !== false) {
                  return true;
                  wp_die("You gonna die");
            }
            return false;
      }

      public function filter_callback($item) {
            $director = $_REQUEST['filter_s'] ? $_REQUEST['filter_s'] : 'all';
            $director = strtolower($director);

            if ('all' == $director) {
                  return true;
            } else {
                  if ($director == $item['director']) {
                        return true;
                  }
            }

            return false;
      }


      private function table_data($data) {
            global $wpdb;
            $data = $wpdb->get_results($wpdb->prepare("SELECT name FROM {$wpdb->prefix}aba_booking_student"), ARRAY_A);

            if (isset($_REQUEST['s'])) {
                  $data2 = array_filter($data, array($this, 'dbdemo_user_search'));
            }

            return $data2;
      }

      public function column_default($item, $column_name) {
            switch ($column_name) {
                  case 'id':
                  case 'name':
                  case 'email':
                  case 'student_id':
                  case 'department':
                        return $item[$column_name];

                  default:
                        return print_r($item, true);
            }

            // return $item[$column_name];
      }

      private function sort_data($a, $b) {
            $orderby = 'name';
            $order   = 'asc';

            if (!empty($_GET['orderby'])) {
                  $orderby = $_GET['orderby'];
            }

            if (!empty($_GET['order'])) {
                  $order = $_GET['order'];
            }

            $result = strcmp($a[$orderby], $b[$orderby]);

            if ($order === 'asc') {
                  return $result;
            }

            return $result;
      }
}
