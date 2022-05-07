<?php
namespace Aba_Booking;

/**
 * Installer class
 */
class Installer {
    public function run() {
        $this->add_version();
        $this->create_student_table();
        $this->create_subscriber_tables();
        $this->create_users_tables();
    }

    public function add_version() {
        $installed = get_option( 'aba_booking_installed' );
        if ( !$installed ) {
            update_option( 'aba_booking_installed', time() );
        }

        update_option( 'aba_booking_version', ABA_BOOKING_VERSION );
    }

    public function create_student_table() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}aba_booking_student`(
            id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            name varchar(100) NOT NULL DEFAULT '',
            email varchar(100) DEFAULT NULL,
            student_id varchar(15) DEFAULT NULL,
            password varchar(15) DEFAULT NULL,
            department varchar(100) DEFAULT NULL,
            created_at DATETIME NOT NULL,
            created_by BIGINT(20) UNSIGNED NOT NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate";

        if ( !function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );
    } 
    
    public function create_subscriber_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}ABA_BOOKING_subscriber`(
            id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            name varchar(100) NOT NULL DEFAULT '', 
            email varchar(10) DEFAULT NULL,
            created_at DATETIME NOT NULL,
            created_by BIGINT(20) UNSIGNED NOT NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate";

        if ( !function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );
    } 

    public function create_users_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}ABA_BOOKING_users`(
            id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            name varchar(100) NOT NULL DEFAULT '', 
            email varchar(100) DEFAULT NULL,
            phone varchar(100) DEFAULT NULL,
            address varchar(100) DEFAULT NULL,
            created_at DATETIME NOT NULL,
            created_by BIGINT(20) UNSIGNED NOT NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate";

        if ( !function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );
    }

}
