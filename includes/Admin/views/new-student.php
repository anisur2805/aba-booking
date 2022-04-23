<?php// if (isset($_GET['inserted'])) { ?>
      <!-- <div class="notice notice-success">
            <p><?php// _e('Address added successfully!', 'aba-booking'); ?></p>
      </div> -->
<?php// } ?>
<form method="post" class="arpc_settings__form2">
      <div class="arpc_form_group">
            <label for="name">Name</label>
            <div>
                  <input type="text" class="regular-text" name="name" id="name" />
            </div>
      </div>
      <div class="arpc_form_group">
            <label for="email">Email</label>
            <div>
            <input type="text" class="regular-text" id="email" name="email" />
           
            </div>
      </div>
      <div class="arpc_form_group">
            <label for="password">Password</label>
            <div>
            <input type="password" class="regular-text" id="password" name="password" />
            </div>
      </div>

      <div class="arpc_form_group">
            <label for="student_id">Student ID</label>
            <div>
            <input readonly type="text" class="regular-text" id="student_id" name="student_id" />
            </div>
      </div>

      <div class="arpc_form_group">
            <label for="department">Department</label>
            <div>
            <input type="text" class="regular-text" id="department" name="department" />
            </div>
      </div>

      <?php
      wp_nonce_field('new-form');
      submit_button('Add Address', 'primary', 'submit_new_form');
      ?>
</form>