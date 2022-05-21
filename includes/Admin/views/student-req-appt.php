<div class="wrap">
    <h1 class="wp-heading-inline"><?php esc_html_e('Request an Appointment', 'aba-booking'); ?></h1>

      <form method="post" class="arpc_settings__form2">
            <div class="aba_form_group<?php echo $this->has_error( 'name' ) ? ' form-invalid' : ''; ?>">
                  <label for="name">Name*</label>
                  <div>
                        <input type="text" class="regular-text" value="<?php echo esc_attr( $student_req_appt->name ); ?>" readonly name="name" id="name" />
                  </div>
                  <?php if ( $this->has_error( 'name' ) ) {?>
                        <p class="description error"> <?php echo $this->get_error( 'name' ); ?> </p>
                  <?php }
                  ?>
            </div>

            <div class="aba_form_group<?php echo $this->has_error( 'email' ) ? ' form-invalid' : ''; ?>">
                  <label for="email">Email*</label>
                  <div>
                        <input type="text" class="regular-text" id="email" value="<?php echo esc_attr( $student_req_appt->email ); ?>" readonly name="email" />
                  </div>
                  <?php if ( $this->has_error( 'email' ) ) {?>
                        <p class="description error"> <?php echo $this->get_error( 'email' ); ?> </p>
                  <?php }?>
            </div>
            
            <div class="aba_form_group">
                  <label for="student_id">Student ID</label>
                  <div>
                        <input value="<?php echo esc_attr( $student_req_appt->student_id ); ?>" readonly value="<?php echo get_student_roll(); ?>" type="text" class="regular-text" id="student_id" name="student_id" />
                  </div>
            </div>

            <div class="aba_form_group<?php echo $this->has_error( 'department' ) ? ' form-invalid' : ''; ?>">
                  <label for="department">Department*</label>
                  <div>
                        <input type="text" class="regular-text" id="department" name="department" value="<?php echo esc_attr( $student_req_appt->department ); ?>" readonly />
                  </div>
                  <?php if ( $this->has_error( 'department' ) ) {?>
                        <p class="description error"> <?php echo $this->get_error( 'department' ); ?> </p>
                  <?php }?>
            </div>
            
            <div class="aba_form_group<?php echo $this->has_error( 'message' ) ? ' form-invalid' : ''; ?>">
                  <label for="message">Message*</label>
                  <div>
                        <textarea class="regular-text" id="message" name="message"></textarea>
                  </div>
                  <?php if ( $this->has_error( 'message' ) ) {?>
                        <p class="description error"> <?php echo $this->get_error( 'message' ); ?> </p>
                  <?php }?>
            </div>

            <?php
            wp_nonce_field( 'req-appt' );
            submit_button( 'Request', 'primary', 'request_an_appt' );
            ?>
      </form>
</div>