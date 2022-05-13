<?php

namespace Aba_Booking;

class Ajax {
    function __construct() {
        // $this->ABA_BOOKING_dispatch();

        add_action('wp_ajax_ABA_BOOKING_add_contact', array($this, 'ABA_BOOKING_add_contact'));
        add_action('wp_ajax_ABA_BOOKING_modal_form', array($this, 'ABA_BOOKING_modal_form'));
        add_action('wp_ajax_aba-booking-delete-student', array($this, 'delete_student_ajax'));
    }

    public function delete_student_ajax() {
        if ( !wp_verify_nonce( $_REQUEST['_wpnonce'], 'aba-booking-student-nonce' ) ) {
            wp_die( 'Are you cheating mia, huh!' );
        }

        if ( !current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating!' );
        }

        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

        // if ( aba_booking_delete_student( $id ) ) {
        //     $redirected_to = admin_url( "admin.php?page=aba-booking-student&student-deleted=true" );
        // } else {
        //     $redirected_to = admin_url( "admin.php?page=aba-booking-student&student-deleted=false" );
        // }

        // wp_redirect( $redirected_to );
        // exit;
        wp_send_json_success(aba_booking_delete_student( $id ));
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
