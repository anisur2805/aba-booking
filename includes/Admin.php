<?php

namespace Aba_Booking;

use Aba_Booking\Admin\Menu;
use Aba_Booking\Admin\Metabox\Courses_Metabox;
use Aba_Booking\Admin\Metabox\Departments_Metabox;
use Aba_Booking\Admin\Metabox\Semester_Metabox;
use Aba_Booking\Admin\Post_Type\Courses;
use Aba_Booking\Admin\Post_Type\Departments;
use Aba_Booking\Admin\Post_Type\Semester;
use Aba_Booking\Data_Table;
use Aba_Booking\Traits\Form_Error;

class Admin {

    public function __construct() {
        $student = new Admin\Student();
        $this->dispatch_actions( $student );
        // Add Menu page
        new Admin\Menu( $student );

        // Instantiate Data Table
        new Data_Table();

        // Instantiate Subscriber Data Table
        // new Subscriber_Data_Table();

        //Instantiate Course Meta box
        new Courses_Metabox();

        //Instantiate Course Meta box
        new Departments_Metabox();

        //Instantiate Course Meta box
        new Semester_Metabox();


        // Instantiate Courses CPT
        new Courses();
        
        // Instantiate Departments CPT
        new Departments();

        // Instantiate Departments CPT
        new Semester();
        
        add_action('admin_head', array($this, 'load_assets'));
    }

    public function dispatch_actions( $student ) {
        add_action('admin_init', array( $student, 'student_insert_form_handler' ) );
    }
    

    public function load_assets() {
        wp_enqueue_style('aba-booking-metabox');
        wp_enqueue_style('aba-booking-datepicker-style');
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('aba-booking-metabox-script');
        wp_enqueue_script('aba-booking-main-ajax');
    }
}
