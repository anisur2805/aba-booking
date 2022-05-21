<?php

 $formStructure = [
  [
   "name"          => "",
   "className"     => "aba_form_group",
   "concreteClass" => $this->has_error( 'name' ) ? ' form-invalid' : '',
   "label"         => "name",
   "labelName"     => "Name*",
   "type"          => "text",
   "inputClass"    => "regular-text",
   "isRequire"     => true,
  ],
  [
   "name"          => "",
   "className"     => "aba_form_group",
   "concreteClass" => $this->has_error( 'name' ) ? ' form-invalid' : '',
   "label"         => "name",
   "labelName"     => "Name*",
   "type"          => "text",
   "inputClass"    => "regular-text",
   "isRequire"     => true,
  ],

 ];

 echo "<pre>";

 function concreteClass( $className, $concreteClass ) {

  return $className . " " . $concreteClass;

 }

 foreach ( $formStructure as $form ) {

  echo '<div class="' . concreteClass( $form['className'], $form['concreteClass'] ) . '">
                  <label for="' . $form['label'] . '">' . $form['labelName'] . '</label>
                  <div>
                        <input type="text" class="regular-text" name="name" id="name" require />
                  </div>

            </div>
            ';

 }

?>



<div class="wrap">
    <h1 class="wp-heading-inline"><?php esc_html_e( 'Request an Appointment', 'aba-booking' );?></h1>
      <?php if ( isset( $_GET['requested'] ) ) {?>
            <div class="notice notice-success">
                  <p><?php esc_html_e( 'Request for appointment sent!', 'aba-booking' );?></p>
            </div>
      <?php }?>
      <form method="post" class="arpc_settings__form2">
            <div class="aba_form_group<?php echo $this->has_error( 'name' ) ? ' form-invalid' : ''; ?>">
                  <label for="name">Name*</label>
                  <div>
                        <input type="text" class="regular-text" name="name" id="name" require />
                  </div>
                  <?php if ( $this->has_error( 'name' ) ) {?>
                        <p class="description error"><?php echo $this->get_error( 'name' ); ?> </p>
                  <?php }
                  ?>
            </div>
            <div class="aba_form_group<?php echo $this->has_error( 'email' ) ? ' form-invalid' : ''; ?>">
                  <label for="email">Email*</label>
                  <div>
                        <input type="text" class="regular-text" id="email" name="email" require />
                  </div>
                  <?php if ( $this->has_error( 'email' ) ) {?>
                        <p class="description error"><?php echo $this->get_error( 'email' ); ?> </p>
                  <?php }?>
            </div>

            <div class="aba_form_group">
                  <label for="student_id">Student ID</label>
                  <div>
                        <input readonly value="<?php echo get_student_roll(); ?>" type="text" class="regular-text" id="student_id" name="student_id" />
                  </div>
            </div>

            <div class="aba_form_group<?php echo $this->has_error( 'department' ) ? ' form-invalid' : ''; ?>">
                  <label for="department">Department*</label>
                  <div>
                        <input type="text" class="regular-text" id="department" name="department" require />
                  </div>
                  <?php if ( $this->has_error( 'department' ) ) {?>
                        <p class="description error"><?php echo $this->get_error( 'department' ); ?> </p>
                  <?php }?>
            </div>

            <div class="aba_form_group<?php echo $this->has_error( 'message' ) ? ' form-invalid' : ''; ?>">
                  <label for="message">Message*</label>
                  <div>
                        <textarea class="regular-text" id="message" name="message" require></textarea>
                  </div>
                  <?php if ( $this->has_error( 'message' ) ) {?>
                        <p class="description error"><?php echo $this->get_error( 'message' ); ?> </p>
                  <?php }?>
            </div>

            <?php
             wp_nonce_field( 'req-appt' );
             submit_button( 'Request', 'primary', 'request_an_appt' );
            ?>
      </form>
</div>