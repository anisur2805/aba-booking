<div class="ABA_BOOKING-popup-creator-wrapper" id="ABA_BOOKING-popup-creator-wrapper">
      <form action="" method="post">
            <div class="ABA_BOOKING-form-group-row">
                  <?php
                  ABA_BOOKING_input_field("text", "name", "name", "Enter your name", '');
                  ?>
            </div>

            <div class="ABA_BOOKING-form-group-row">
                  <?php
                  ABA_BOOKING_input_field("email", "email", "email", "Enter your email", '');
                  ?>
            </div>

            <div class="ABA_BOOKING-form-group-row">
                  <?php wp_nonce_field('ABA_BOOKING-modal-form'); ?>
                  <input type="hidden" name="action" value="ABA_BOOKING-modal-form">
                  <input type="submit" class="ABA_BOOKING_submit" name="ABA_BOOKING_submit" id="ABA_BOOKING_submit" value="<?php esc_attr_e('Subscribe Now', 'ABA_BOOKING-popup-creator'); ?>" />
            </div>
            
      </form>
</div>