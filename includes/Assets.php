<?php

namespace Aba_Booking;

class Assets {
  public function __construct() {
    add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    add_action('admin_enqueue_scripts', [$this, 'enqueue_assets']);
  }

  public function get_scripts() {
    return [
      'aba-booking-main-ajax'      => [
        'src'     => ABA_BOOKING_ASSETS . '/js/main-script.js',
        'version' => filemtime(ABA_BOOKING_PATH . '/assets/js/main-script.js'),
        'deps'    => ['jquery'],
      ],

      'aba-booking-metabox-script' => [
        'src'     => ABA_BOOKING_ASSETS . '/js/aba-booking-metabox.js',
        'version' => filemtime(ABA_BOOKING_PATH . '/assets/js/aba-booking-metabox.js'),
        'deps'    => [],
      ],
      'admin-script'   => [
       'src'     => OOP_ACADEMY_ASSETS . '/js/admin.js',
       'version' => filemtime( OOP_ACADEMY_PATH . '/assets/js/admin.js' ),
       'deps'    => ['jquery', 'wp-util'],
      ],
    ];
  }

  public function get_styles() {
    return [
      'aba-booking-metabox' => [
        'src'     => ABA_BOOKING_ASSETS . '/css/aba-booking-metabox.css',
        'version' => filemtime(ABA_BOOKING_PATH . '/assets/css/aba-booking-metabox.css'),
      ],

      'aba-booking-style'   => [
        'src'     => ABA_BOOKING_ASSETS . '/css/aba-booking.css',
        'version' => filemtime(ABA_BOOKING_PATH . '/assets/css/aba-booking.css'),
      ],

      'aba-booking-datepicker-style'   => [
        'src'     => '//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/base/jquery-ui.css',
        'version' => '1.9.0',
      ],
    ];
  }

  public function enqueue_assets() {
    $scripts = $this->get_scripts();

    foreach ($scripts as $handle => $script) {
      $deps = isset($script['deps']) ? $script['deps'] : false;
      wp_register_script($handle, $script['src'], $deps, $script['version'], true);
    }

    $styles = $this->get_styles();

    foreach ($styles as $handle => $style) {
      $deps = isset($style['deps']) ? $style['deps'] : false;
      wp_register_style($handle, $style['src'], $deps, $style['version']);
    }

    // wp_localize_script('aba-booking-main-ajax', 'ABA_BOOKINGPopup', [
    //   'nonce'   => wp_create_nonce('aba-booking-ajax-nonce'),
    //   'ajaxUrl' => admin_url('admin-ajax.php'),
    //   'confirm' => __('Are you sure?', 'aba-booking-popup-creator'),
    //   'error'   => __('Something went wrong in Admin area', 'aba-booking-popup-creator'),
    //   'success'   => __('Submitted successfully', 'aba-booking-popup-creator'),
    // ]);

  }
}
