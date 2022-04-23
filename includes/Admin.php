<?php

namespace Aba_Booking;

use Aba_Booking\Admin\Menu;
use Aba_Booking\Admin\Metabox\Courses_Metabox;
use Aba_Booking\Admin\Post_Type\Courses;
use Aba_Booking\Admin\Post_Type\Departments;
use Aba_Booking\Data_Table;
use Aba_Booking\Traits\Form_Error;

class Admin {

    use Form_Error;

    public function __construct() {
        // Instantiate Data Table
        new Data_Table();

        // Instantiate Subscriber Data Table
        // new Subscriber_Data_Table();

        //Instantiate Course Meta box
        new Courses_Metabox();

        // Add Menu page
        new Menu();

        // Instantiate Courses CPT
        new Courses();
        
        // Instantiate Departments CPT
        new Departments();

        add_action('admin_head', array($this, 'load_assets'));

        // add_action('admin_menu', [$this, 'admin_form_menu']);
    }



    public function load_assets() {
        wp_enqueue_style('aba-booking-metabox');
        wp_enqueue_style('aba-booking-datepicker-style');
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('aba-booking-metabox-script');
        wp_enqueue_script('aba-booking-main-ajax');
    }
}
