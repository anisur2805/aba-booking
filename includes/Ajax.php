<?php

namespace Aba_Booking;

class Ajax {
    function __construct() {
        // $this->ABA_BOOKING_dispatch();

        add_action('wp_ajax_ABA_BOOKING_add_contact', array($this, 'ABA_BOOKING_add_contact'));
        add_action('wp_ajax_ABA_BOOKING_modal_form', array($this, 'ABA_BOOKING_modal_form'));
        // add_action('wp_ajax_aba-booking-delete-student', array($this, 'delete_student_ajax'));
        add_action('wp_ajax_aba-booking-delete-student', array($this, 'delete_ajax_row', 'aba-booking-student-nonce', ));
    }

    public function delete_ajax_row( $callable_func, $action, $table_name, $verify_nonce_msg = 'Are you cheating mia, huh!', $capacity_msg = 'Are you cheating!' ) {
        if ( !wp_verify_nonce( $_REQUEST['_wpnonce'], $action ) ) {
            wp_die( $verify_nonce_msg );
        }

        if ( !current_user_can( 'manage_options' ) ) {
            wp_die( $capacity_msg );
        }

        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;
        $callable_func = aba_booking_delete_row( $id, $table_name );
        wp_send_json_success( $callable_func );

    }

    public function delete_student_ajax() {
        if ( !wp_verify_nonce( $_REQUEST['_wpnonce'], 'aba-booking-student-nonce' ) ) {
            wp_die( 'Are you cheating mia, huh!' );
        }

        if ( !current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating!' );
        }

        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

        wp_send_json_success( aba_booking_delete_row( $id, 'aba_booking_student' ) );
    }

    public function ABA_BOOKING_dispatch() {
        // add_action('admin_init', ( array( $this, 'add_address_form_handler' ) ) );
    }


    public function ABA_BOOKING_modal_form() {

        // if( ! isset( $_POST['ABA_BOOKING_submit' ] ) ) {
        //     return;
        // }

        // if (! check_ajax_referer('ABA_BOOKING_modal_form', 'nonce') ) {
            if( ! wp_verify_nonce( $_REQUEST['nonce'], 'ABA_BOOKING_modal_form' )) {
            wp_send_json_error([
                'message' => 'Nonce verify failed!',
            ]);
        } else {
            wp_send_json_success([
                'message' => 'Nonce verify successful!',
            ]);
        }

        // check_ajax_referer('ABA_BOOKING_modal_form', 'nonce');
        $newsletterValues = isset($_POST['modalEntries']) ? $_POST['modalEntries'] : '';
        // echo "<pre>";
        var_dump($newsletterValues);

        echo "Yeah";

        exit();

        // $to_admin_email = get_option( 'admin_email' );
        // $subject = "This is an testing message";
        // $message = "This is a body content of test message";
        // $headers = array( 'Content-Type: text/html; charset=UTF-8' );

        // exit();
    }

    public function ABA_BOOKING_add_contact() {
        check_ajax_referer('ABA_BOOKING-ajax-nonce', 'nonce');
        $firstName = isset($_POST['popup_settings_data']) ? $_POST['popup_settings_data'] : '';
        var_dump($firstName);
        die();
    }
    
    
}
