<?php
namespace Aba_Booking\Admin\Metabox;
class Departments_Metabox {
 
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
        $post_types = array( 'aba_booking_dept' );

        if ( in_array( $post_type, $post_types ) ) {
            add_meta_box(
                'aba_booking_departments_metabox',
                __( 'Departments Metabox' ,'aba-booking' ),
                array( $this, 'render_departments_metabox' ),
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
    public function render_departments_metabox( $post ) {
        wp_nonce_field( 'aba_booking_departments', 'aba_booking_departments_nonce' );

        $agenda = get_post_meta( $post->ID, 'aba_departments_description', true );
        $departments_date = get_post_meta( $post->ID, 'aba_booking_departments_date', true );
        $departments_id = get_post_meta( $post->ID, 'aba_booking_departments_id', true );
        $courses = get_post_meta( $post->ID, 'aba_booking_departments_courses', true );

        ?>
        <div class="aba_booking_metabox_wrapper">
            
            <div class="aba_booking_form_group">
                <label for="aba_departments_description">
                    <?php _e( 'Department Description' ,'aba_booking' ); ?>
                </label>
                <textarea name="aba_departments_description" id="aba_departments_description" placeholder="Department Description" class="regular-text"><?php echo $agenda; ?></textarea>
            </div>
            
            <div class="aba_booking_form_group">
                <label for="aba_booking_departments_date">
                    <?php _e( 'Department Date' ,'aba_booking' ); ?>
                </label>
                <input placeholder="Select Date" type="text" name="aba_booking_departments_date" id="aba_booking_departments_date" value="<?php echo $departments_date; ?>" class="regular-text" />
            </div>

            <div class="aba_booking_form_group">
                <label for="aba_booking_departments_id">
                    <?php _e( 'Department ID' ,'aba_booking' ); ?>
                </label>
                <input placeholder="Department ID" readonly type="text" name="aba_booking_departments_id" id="aba_booking_departments_id" value="<?php echo $departments_id; ?>" class="regular-text" />
            </div>

            <div class="aba_booking_form_group">
                <label for="aba_booking_departments_courses">
                    <?php _e( 'Select Courses' ,'aba_booking' ); ?>
                </label>

                <select class="regular-text" name="aba_booking_departments_courses" id="aba_booking_departments_courses">
                    <option value="">Select Courses</option>
                    <option value="cse" <?php selected( 'cse', $this->get_departments_metabox_value( $courses ) ) ?> >Computer Fundamental</option>
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
        if (!$this->is_secured('aba_booking_departments_nonce', 'aba_booking_departments', $post_id)) {
            return $post_id;
        }
        
        if( isset( $_POST['aba_departments_description'] ) ) {
            update_post_meta($post_id, 'aba_departments_description', sanitize_text_field( $_POST['aba_departments_description'] ) );
        } 
        
        if( isset( $_POST['aba_departments_description'] ) ) {
            update_post_meta($post_id, 'aba_departments_description', sanitize_text_field( $_POST['aba_departments_description'] ) );
        }

        if( isset( $_POST['aba_booking_departments_id'] ) ) {
            update_post_meta($post_id, 'aba_booking_departments_id', sanitize_text_field( $_POST['aba_booking_departments_id'] ) );
        }

        if( isset( $_POST['aba_booking_departments_courses'] ) ) {
            update_post_meta($post_id, 'aba_booking_departments_courses', sanitize_text_field( $_POST['aba_booking_departments_courses'] ) );
        }
             
    }
    
    public function get_departments_metabox_value( $value ) {
        if( isset( $value ) && !empty( $value ) ) {
            return $value;
        } else {
            return '';
        }
    }
    
  }