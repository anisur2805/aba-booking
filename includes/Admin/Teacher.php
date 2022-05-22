<?php

namespace Aba_Booking\Admin;

use Aba_Booking\Traits\Form_Error;

class Teacher {
    use Form_Error;

    public function render_teacher_page() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';
        $id     = isset($_GET['id']) ? intval($_GET['id']) : 0;
        // $teacher_req_appt  = aba_booking_req_appt( $id );
        // var_dump( $teacher_req_appt );

        switch ($action) {
            case 'new':
                $template = __DIR__ . '/views/new-teacher.php';
                break;

            case 'edit':
                //$teacher  = aba_booking_get_teachers( $id );
                $template = __DIR__ . '/views/edit-teacher.php';
                break;

                case 'view-req-appt':
                   // $teacher_req_appt  = aba_booking_req_appt( $id );
                    $template = __DIR__ . '/views/teacher-req-appt.php';
                    break;
                    
                default:
                    $template = __DIR__ . '/views/list-teacher.php';
                    break;
        }

        if (file_exists($template)) {
            include $template;
        }

    }

    /**
     * Insert Student to DB
     *
     * @return void
     */
    public function teacher_insert_form_handler() { 

        if (!isset($_POST['insert_new_teacher'])) {            
            return;
        }

        if (!current_user_can('manage_options')) {
            return;
        }

        if (!wp_verify_nonce($_REQUEST['_wpnonce'], 'new-teacher')) {
            wp_die('Are you cheating, huh?');
        }

        $id         = isset( $_POST['id'] ) ? $_POST['id'] : 0;
        $name       = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $email      = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
        $password   = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';
        $teacher_id = isset($_POST['teacher_id']) ? sanitize_text_field($_POST['teacher_id']) : '';
        $department = isset($_POST['department']) ? sanitize_text_field($_POST['department']) : '';

        if (empty($name)) {
            $this->errors['name'] = __('Must provide a name', 'aba-booking');
        }

        if (empty($email)) {
            $this->errors['email'] = __('Must provide email', 'aba-booking');
        }

        if (empty($password)) {
            $this->errors['password'] = __('Must provide password number', 'aba-booking');
        }

        if (empty($teacher_id)) {
            $this->errors['teacher_id'] = __('Must provide teacher id', 'aba-booking');
        } 
        
        if (empty($department)) {
            $this->errors['department'] = __('Must provide department', 'aba-booking');
        }

        if ( !empty($this->errors) ) {
        //  echo $this->errors;
            return;
        }

        $args = [
            'name'       => $name,
            'email'      => $email,
            'password'   => $password,
            'teacher_id' => $teacher_id,
            'department' => $department,
        ];

        if( $id ) {
            $args['id'] = $id;
        }

        $insert_teacher_id = aba_teacher_insert($args);

        if (is_wp_error($insert_teacher_id)) {
            wp_die($insert_teacher_id->get_error_message());
        }

        if( $id ) {
            $redirected_to = admin_url('admin.php?page=aba-booking-teacher&action=edit&teacher-update&id='.$id );
        } else {
            $redirected_to = admin_url('admin.php?page=aba-booking-teacher&inserted=true');
        }

        wp_redirect($redirected_to);
        exit();

    }

    /**
     * Request appt teacher
     *
     * @return void
     */
    public function request_appt_form_handler() { 

        if (!isset($_POST['request_an_appt'])) {            
            return;
        }

        if (!current_user_can('manage_options')) {
            return;
        }

        if (!wp_verify_nonce($_REQUEST['_wpnonce'], 'req-appt')) {
            wp_die('Are you cheating, huh?');
        }

        $id         = isset( $_POST['id'] ) ? $_POST['id'] : 0;
        $name       = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $email      = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
        $teacher_id = isset($_POST['teacher_id']) ? sanitize_text_field($_POST['teacher_id']) : '';
        $department = isset($_POST['department']) ? sanitize_text_field($_POST['department']) : '';
        $message = isset($_POST['message']) ? sanitize_text_field($_POST['message']) : '';

        if (empty($name)) {
            $this->errors['name'] = __('Must provide a name', 'aba-booking');
        }

        if (empty($email)) {
            $this->errors['email'] = __('Must provide email', 'aba-booking');
        }

        if (empty($teacher_id)) {
            $this->errors['teacher_id'] = __('Must provide teacher id', 'aba-booking');
        } 
        
        if (empty($message)) {
            $this->errors['message'] = __('Must provide message', 'aba-booking');
        }

        if ( !empty($this->errors) ) {
        //  echo $this->errors;
            return;
        }

        $args = [
            'name'       => $name,
            'email'      => $email,
            'teacher_id' => $teacher_id,
            'department' => $department,
            'message' => $message,
        ];

        $insert_teacher_req_appt_id = aba_teacher_req_appt_insert($args);

        if (is_wp_error($insert_teacher_req_appt_id)) {
            wp_die($insert_teacher_req_appt_id->get_error_message());
        }
        $redirected_to = admin_url('admin.php?page=aba-booking-teacher&request-appt=true');
        
        wp_redirect($redirected_to);
        exit();

    }

    public function delete_teacher() {
        if ( !wp_verify_nonce( $_REQUEST['_wpnonce'], 'aba-delete-teacher' ) ) {
            wp_die( 'Are you cheating mia!' );
        }

        if ( !current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating!' );
        }

        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

        // if ( aba_booking_delete_teacher( $id ) ) {
        //     $redirected_to = admin_url( "admin.php?page=aba-booking-teacher&teacher-deleted=true" );
        // } else {
        //     $redirected_to = admin_url( "admin.php?page=aba-booking-teacher&teacher-deleted=false" );
        // }

        // wp_redirect( $redirected_to );
        exit;

    }

}
