<?php

namespace Aba_Booking\Frontend;

class Modal {

      public function __construct() {
            add_action('wp_footer', array($this, 'load_modal_on_footer'));
      }

      public function load_modal_on_footer() {

            wp_enqueue_style('ABA_BOOKING-style');
            wp_enqueue_script('plain-modal');
            wp_enqueue_script('ABA_BOOKING-main');
            wp_enqueue_script('ABA_BOOKING-modal-form');

            $args = array(
                  'post_type'   => 'ABA_BOOKING_popup',
                  'post_status' => 'publish',
                  'meta_key'    => 'ABA_BOOKING_active',
                  'meta_value'  => 1,
            );

            $ABA_BOOKING_query = new \WP_Query($args);
            while ($ABA_BOOKING_query->have_posts()) {
                  $ABA_BOOKING_query->the_post();
                  $image_size    = get_post_meta(get_the_ID(), 'ABA_BOOKING_image_size', true);
                  $exit          = get_post_meta(get_the_ID(), 'ABA_BOOKING_show_on_exit', true);
                  $delay         = get_post_meta(get_the_ID(), 'ABA_BOOKING_show_in_delay', true);
                  $title         = get_post_meta(get_the_ID(), 'ABA_BOOKING_title', true);
                  $subtitle      = get_post_meta(get_the_ID(), 'ABA_BOOKING_subtitle', true);
                  $feature_image = get_the_post_thumbnail_url(get_the_ID(), $image_size);
                  $popup_url     = get_post_meta(get_the_ID(), 'ABA_BOOKING_popup_url', true);
                  $show_in_obj   = get_post_meta(get_the_ID(), 'ABA_BOOKING_ww_show', true);
                  $auto_hide     = get_post_meta(get_the_ID(), 'ABA_BOOKING_auto_hide_pu', true);

                  if ($delay) {
                        $delay *= 1000;
                  } else {
                        $delay = 0;
                  }

                  $show_in   = get_post($show_in_obj);
                  $showIn_id = $show_in->ID;

                  if (is_page($showIn_id)) {
?>
                        <div class="ABA_BOOKING-popup-creator" id="ABA_BOOKING-popup-creator" data-auto-hide="<?php echo ($auto_hide == 1) ? 'yes' : 'no'; ?>" data-id="popup-<?php echo get_the_ID(); ?>" data-popup-image-size="<?php echo esc_attr($image_size); ?>" data-exit="<?php echo esc_attr($exit); ?>" data-delay="<?php echo $delay ?>" data-show="<?php echo $showIn_id; ?>">
                              <div class="ABA_BOOKING-popup-creator-body">
                                    <div class="ABA_BOOKING-popup-creator-body-header">
                                          <?php
                                          $content = wp_trim_words(get_the_content(), 5, '');
                                          if( $title ):
                                                printf('<h3 class="apc-popup-modal-title">%s</h3>', $title );
                                          endif;
                                          if( $subtitle ):
                                                printf('<h4 class="apc-popup-modal-title">%s</h4>', $subtitle );
                                          endif;
                                          printf('<div>%s</div>', $content);
                                          ?>
                                    </div>
                                    <div class="ABA_BOOKING-popup-creator-body-inner">
                                          <?php if ($feature_image) : ?>
                                                <div class="ABA_BOOKING-popup-image">
                                                      <?php if ($popup_url) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($popup_url); ?>">
                                                                  <img src="<?php echo esc_url($feature_image); ?>" alt="<?php _e('Popup', 'popup-creator') ?>" />
                                                            </a>
                                                      <?php } else { ?>
                                                            <img src="<?php echo esc_url($feature_image); ?>" alt="<?php _e('Popup', 'popup-creator') ?>" />
                                                      <?php } ?>
                                                </div>
                                          <?php endif; ?>

                                          <div class="ABA_BOOKING-popup-form">
                                                <?php echo do_shortcode('[ABA_BOOKING_newsletter]'); ?>
                                          </div>
                                    </div>

                              </div>

                              <button class="ABA_BOOKING-close-button">
                                    <img src="<?php echo esc_url(ABA_BOOKING_ASSETS . '/images/close.svg') ?>" alt="Close" />
                              </button>

                        </div>
<?php
                  }
            }

            wp_reset_query();
      }
}
