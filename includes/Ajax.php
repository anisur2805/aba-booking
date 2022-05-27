<?php

namespace Aba_Booking;

class Ajax {
    function __construct() {
        add_action('wp_ajax_ABA_BOOKING_add_contact', array($this, 'ABA_BOOKING_add_contact'));
        add_action('wp_ajax_ABA_BOOKING_modal_form', array($this, 'ABA_BOOKING_modal_form'));
        add_action('wp_ajax_aba-booking-delete-student', array($this, 'delete_student_ajax'));
        add_action('wp_ajax_aba-booking-delete-student', array($this, 'delete_ajax_row', 'aba-booking-student-nonce', ));
    }

    // public function delete_ajax_row( $callable_func, $action, $table_name, $verify_nonce_msg = 'Are you cheating mia, huh!', $capacity_msg = 'Are you cheating!' ) {
    //     if ( !wp_verify_nonce( $_REQUEST['_wpnonce'], $action ) ) {
    //         wp_die( $verify_nonce_msg );
    //     }

    //     if ( !current_user_can( 'manage_options' ) ) {
    //         wp_die( $capacity_msg );
    //     }

    //     $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;
    //     $callable_func = aba_booking_delete_row( $id, $table_name );
    //     wp_send_json_success( $callable_func );

    // }

    public function delete_student_ajax() {
        if ( !wp_verify_nonce( $_REQUEST['_wpnonce'], 'aba-booking-student-nonce' ) ) {
            wp_die( 'Are you cheating mia, huh!' );
        }

        if ( !current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating!' );
        }

        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

        wp_send_json_success( aba_booking_delete_student( $id, 'aba_booking_student' ) );
    } 
    
}
