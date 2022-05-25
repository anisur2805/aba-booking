<?php

namespace Aba_Booking\Admin;

use Aba_Booking\Admin\Teacher;

/**
 * Menu class
 */
class Menu {
    public $student;

    public function __construct( $student ) {
        $this->student = $student;
        add_action( 'admin_menu', [$this, 'admin_menu'] );
    }

    public function admin_menu() {
        $capability  = 'manage_options';
        $menu_slug   = 'aba-booking';
        $parent_slug = 'aba-booking';
        $page_title  = __( 'Settings', 'Aba Booking' );

        add_menu_page( __( 'Booking Appt', 'aba-booking' ), __( 'Booking Appt', 'aba-booking' ), $capability, $menu_slug, [$this, 'render_aba_booking_page'], 'dashicons-calendar', 25 );
        add_submenu_page( $menu_slug, __( 'Teachers', 'aba-booking' ), __( 'Teachers', 'aba-booking' ), $capability, 'aba-booking-teacher', [$this, 'render_teacher_page'] );
        add_submenu_page( $menu_slug, __( 'Students', 'aba-booking' ), __( 'Students', 'aba-booking' ), $capability, 'aba-booking-student', [$this->student, 'render_student_page'] );
    }

    public function render_aba_booking_page() {
        echo "Hello from Main booking page";
    }

    public function render_teacher_page() {
        $teacher = new Teacher();
        $teacher->render_teacher_page();

    }

}
