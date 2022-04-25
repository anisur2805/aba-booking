<?php
namespace Aba_Booking\Admin\Metabox;
class Semester_Metabox {
 
    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post',      array( $this, 'save' ) );
        add_action( 'admin_head', array( $this, 'metaboxEnqueue' ) );
    }
    
    public function metaboxEnqueue() {
        wp_enqueue_script( 'metabox' );
    }
    
   
    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
        // Limit meta box to certain post types.
        $post_types = array( 'aba_booking_semester' );

        if ( in_array( $post_type, $post_types ) ) {
            add_meta_box(
                'aba_booking_semester_metabox',
                __( 'Departments Metabox' ,'aba-booking' ),
                array( $this, 'render_semester_metabox' ),
                $post_type,
                'advanced',
                'high'
            );
        }
    }
    
    private function is_secured($nonce_field, $action, $post_id) {
        $nonce = isset($_POST[$nonce_field]) ? $_POST[$nonce_field] : '';

        if ($nonce == '') {
            return false;
        }

        if (!wp_verify_nonce($nonce, $action)) {
            return false;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return false;
        }

        if (wp_is_post_autosave($post_id)) {
            return false;
        }

        if (wp_is_post_revision($post_id)) {
            return false;
        }

        return true;
    }  
   
    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_semester_metabox( $post ) {
        wp_nonce_field( 'aba_booking_semester', 'aba_booking_semester_nonce' );

        $subject = get_post_meta( $post->ID, 'aba_semester_subject', true );
        $subject_code = get_post_meta( $post->ID, 'aba_semester_subject_code', true );
        $teacher = get_post_meta( $post->ID, 'aba_semester_teacher', true );

        ?>
        <div class="aba_booking_metabox_wrapper">

            <div class="aba_booking_form_group">
                <label for="aba_semester_subject">
                    <?php _e( 'Select Courses Title' ,'aba_booking' ); ?>
                </label>

                <select class="regular-text" name="aba_semester_subject" id="aba_semester_subject">
                    <option value="">Select Courses</option>
                    <option value="structural" <?php selected( 'structural', $this->get_semester_metabox_value( $subject ) ) ?> >Structural Programming Language</option>
                    <option value="structural-lab" <?php selected( 'structural-lab', $this->get_semester_metabox_value( $subject ) ) ?> >Structural Programming Language lab</option>
                    <option value="integral" <?php selected( 'integral', $this->get_semester_metabox_value( $subject ) ) ?> >Integral Calculus & Differential Equation</option>
                </select>
            </div>

            <div class="aba_booking_form_group">
                <label for="aba_semester_teacher">
                    <?php _e( 'Select Teacher' ,'aba_booking' ); ?>
                </label>

                <select class="regular-text" name="aba_semester_teacher" id="aba_semester_teacher">
                    <option value="">Select Courses</option>
                    <option value="sadik" <?php selected( 'sadik', $this->get_semester_metabox_value( $teacher ) ) ?> >Md. Sadiq Iqbal</option>
                    <option value="zakaria" <?php selected( 'zakaria', $this->get_semester_metabox_value( $teacher ) ) ?> >Dr. Md. Zakaria Hossain</option>
                    <option value="nesar" <?php selected( 'nesar', $this->get_semester_metabox_value( $teacher ) ) ?> >Md. Nesar Uddin</option>
                </select>
            </div>

            <div class="aba_booking_form_group">
                <label for="aba_semester_subject_code">
                    <?php _e( 'Course Code' ,'aba_booking' ); ?>
                </label>

                <select class="regular-text" name="aba_semester_subject_code" id="aba_semester_subject_code">
                    <option value="">Select Courses</option>
                    <option value="1" <?php selected( '1', $this->get_semester_metabox_value( $subject_code ) ) ?> >CSE-1201</option>
                    <option value="2" <?php selected( '2', $this->get_semester_metabox_value( $subject_code ) ) ?> >CSE-1202</option>
                    <option value="3" <?php selected( '3', $this->get_semester_metabox_value( $subject_code ) ) ?> >CSE-1203</option>
                </select>
            </div>
        
        </div>
        <?php
    }
    
    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save( $post_id ) {
        if (!$this->is_secured('aba_booking_semester_nonce', 'aba_booking_semester', $post_id)) {
            return $post_id;
        }
        
        if( isset( $_POST['aba_semester_subject'] ) ) {
            update_post_meta($post_id, 'aba_semester_subject', sanitize_text_field( $_POST['aba_semester_subject'] ) );
        }   

        if( isset( $_POST['aba_semester_subject_code'] ) ) {
            update_post_meta($post_id, 'aba_semester_subject_code', sanitize_text_field( $_POST['aba_semester_subject_code'] ) );
        }

        if( isset( $_POST['aba_semester_teacher'] ) ) {
            update_post_meta($post_id, 'aba_semester_teacher', sanitize_text_field( $_POST['aba_semester_teacher'] ) );
        }
             
    }
    
    public function get_semester_metabox_value( $value ) {
        if( isset( $value ) && !empty( $value ) ) {
            return $value;
        } else {
            return '';
        }
    }
    
  }