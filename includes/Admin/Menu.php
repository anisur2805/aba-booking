<?php

namespace Aba_Booking\Admin;

/**
 * Menu class
 */
class Menu {
      public function __construct() {
            add_action('admin_menu', [$this, 'admin_menu']);
      }

      public function admin_menu() {
            $capability = 'manage_options';
            $parent_slug = 'edit.php?post_type=ABA_BOOKING_popup';
            $page_title = __('Settings', 'ABA_BOOKING-popup-creator');

            add_submenu_page($parent_slug, __('Settings', 'ABA_BOOKING-popup-creator'), __('Settings', 'ABA_BOOKING-popup-creator'), $capability, 'ABA_BOOKING-popup-settings', [ $this, 'settings_page']);
            add_submenu_page($parent_slug, __('Subscribers', 'ABA_BOOKING-popup-creator'), __('Subscribers', 'ABA_BOOKING-popup-creator'), $capability, 'ABA_BOOKING-popup-subscribers', [ $this, 'subscribers_page']);

            add_submenu_page($parent_slug, __('Addresses', 'ABA_BOOKING-popup-creator'), __('Addresses', 'ABA_BOOKING-popup-creator'), $capability, 'ABA_BOOKING-popup-form', [$this, 'address_page']);
            
            wp_enqueue_style('ABA_BOOKING-tabbed');
            wp_enqueue_script('ABA_BOOKING-tabbed');
            
      }

}
