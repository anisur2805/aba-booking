<?php

namespace Aba_Booking;

class Ajax {
    function __construct() {
        // $this->ABA_BOOKING_dispatch();

        add_action('wp_ajax_ABA_BOOKING_add_contact', array($this, 'ABA_BOOKING_add_contact'));
        add_action('wp_ajax_ABA_BOOKING_modal_form', array($this, 'ABA_BOOKING_modal_form'));
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
