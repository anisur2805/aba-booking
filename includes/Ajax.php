<?php

namespace Aba_Booking;

class Ajax {
    function __construct() {
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

        wp_send_json_success(aba_booking_delete_student( $id ));
    }
    
}
