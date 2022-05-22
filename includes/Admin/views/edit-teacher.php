<div class="wrap">
    <h1 class="wp-heading-inline">Edit Teacher Info</h1>

      <?php 
        display_crud_status( 'student-update', 'Update Information successfully!' );
      ?>

      <form method="post" class="arpc_settings__form2">
            <div class="aba_form_group<?php echo $this->has_error( 'name' ) ? ' form-invalid' : ''; ?>">
                  <label for="name">Name*</label>
                  <div>
                        <input type="text" class="regular-text" name="name" id="name" value="<?php echo esc_attr( $student->name ); ?>" require />
                  </div>
                  <?php if ( $this->has_error( 'name' ) ) {?>
                        <p class="description error"> <?php echo $this->get_error( 'name' ); ?> </p>
                  <?php }
                  ?>
            </div>

            <div class="aba_form_group<?php echo $this->has_error( 'email' ) ? ' form-invalid' : ''; ?>">
                  <label for="email">Email*</label>
                  <div>
                        <input type="text" class="regular-text" id="email" name="email" value="<?php echo esc_attr( $student->email ); ?>" require />
                  </div>
                  <?php if ( $this->has_error( 'email' ) ) {?>
                        <p class="description error"> <?php echo $this->get_error( 'email' ); ?> </p>
                  <?php }?>
            </div>

            <div class="aba_form_group<?php echo $this->has_error( 'password' ) ? ' form-invalid' : ''; ?>">
                  <label for="password">Password*</label>
                  <div>
                        <input type="password" class="regular-text" id="password" name="password" value="<?php echo esc_attr( $student->password ); ?>" require />
                  </div>
                  <?php if ( $this->has_error( 'password' ) ) {?>
                        <p class="description error"> <?php echo $this->get_error( 'password' ); ?> </p>
                  <?php }?>
            </div>

            <div class="aba_form_group">
                  <label for="student_id">Student ID</label>
                  <div>
                        <input readonly value="<?php echo esc_attr( $student->student_id ); ?>" type="text" class="regular-text" id="student_id" name="student_id" />
                  </div>
            </div>

            <div class="aba_form_group<?php echo $this->has_error( 'department' ) ? ' form-invalid' : ''; ?>">
                  <label for="department">Department*</label>
                  <div>
                        <input type="text" class="regular-text" id="department" name="department" value="<?php echo esc_attr( $student->department ); ?>" require />
                  </div>
                  <?php if ( $this->has_error( 'department' ) ) {?>
                        <p class="description error"> <?php echo $this->get_error( 'department' ); ?> </p>
                  <?php }?>
            </div>
                    <input type="hidden" name="id" value="<?php echo $student->id; ?>" />
            <?php
            wp_nonce_field( 'new-student' );
            submit_button( 'Update Student', 'primary', 'insert_new_student' );
            ?>
      </form>
</div>