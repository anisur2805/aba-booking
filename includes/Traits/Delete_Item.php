<?php
namespace Aba_Booking\Traits;

trait Delete_Item {
    public function delete_method( $action, $update_url, $insert_url, $nonce_msg = 'Are you cheating!', $user_capacity = 'manage_options' ) {
        // var_dump( $_REQUEST["_wpnonce"] );
        if( isset( $_REQUEST["_wpnonce"]) ) {
        if ( !wp_verify_nonce( $_REQUEST["_wpnonce"], $action ) ) {
            wp_die( $nonce_msg );
        }
        }


        if ( !current_user_can( $user_capacity ) ) {
            wp_die( $nonce_msg );
        }

        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

        if ( aba_booking_delete_student( $id ) ) {
            $redirected_to = $update_url;
        } else {
            $redirected_to = $insert_url;
        }

        wp_redirect( $redirected_to );
        exit;

    }
}
