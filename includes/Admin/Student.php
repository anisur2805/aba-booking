<?php

namespace Aba_Booking\Admin;

use Aba_Booking\Traits\Form_Error;

class Student {
    use Form_Error;

    public function render_student_page() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';
        $id     = isset($_GET['id']) ? intval($_GET['id']) : 0;

        switch ($action) {
            case 'new':
                $template = __DIR__ . '/views/new-student.php';
                break;
            case 'edit':
                $template = __DIR__ . '/views/edit-student.php';
                break;
            case 'view':
                $template = __DIR__ . '/views/view-student.php';
                break;
            default:
                $template = __DIR__ . '/views/list-student.php';
                break;
        }

        if (file_exists($template)) {
            include $template;
        }

    }

    public function student_insert_form_handler() { 

        if (!isset($_POST['insert_new_student'])) {            
            return;
        }

        if (!current_user_can('manage_options')) {
            return;
        }

        if (!wp_verify_nonce($_REQUEST['_wpnonce'], 'new-student')) {
            wp_die('Are you cheating, huh?');
        }

        $name       = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $email      = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
        $password   = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';
        $student_id = isset($_POST['student_id']) ? sanitize_text_field($_POST['student_id']) : '';
        $department = isset($_POST['department']) ? sanitize_text_field($_POST['department']) : '';

        if (empty($name)) {
            echo "hello from student";
            $this->errors['name'] = __('Must provide a name', 'aba-booking');
        }

        if (empty($email)) {
            $this->errors['email'] = __('Must provide email', 'aba-booking');
        }

        if (empty($password)) {
            $this->errors['password'] = __('Must provide password number', 'aba-booking');
        }

        if (empty($student_id)) {
            $this->errors['student_id'] = __('Must provide student id', 'aba-booking');
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
            'student_id' => $student_id,
            'department' => $department,
        ];

        $insert_student_id = aba_student_insert($args);

        var_dump($insert_student_id);

        if (is_wp_error($insert_student_id)) {
            wp_die($insert_student_id->get_error_message());
        }

        $redirected_to = admin_url('admin.php?page=aba-booking-student');
        wp_redirect($redirected_to);

        exit();
    }

}
