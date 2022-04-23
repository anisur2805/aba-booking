<?php

namespace Aba_Booking\Admin\Metabox;

class Courses_Metabox {

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post',      array($this, 'save'));
        add_action('admin_head', array($this, 'metaboxEnqueue'));
    }

    public function metaboxEnqueue() {
        wp_enqueue_script('metabox');
    }


    /**
     * Adds the meta box container.
     */
    public function add_meta_box($post_type) {
        // Limit meta box to certain post types.
        $post_types = array('aba_booking_courses');

        if (in_array($post_type, $post_types)) {
            add_meta_box(
                'aba_booking_popup_metabox',
                __('Courses Metabox', 'aba-booking'),
                array($this, 'render_courses_metabox'),
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
    public function render_courses_metabox($post) {
        wp_nonce_field('aba_booking_course', 'aba_booking_course_nonce');

        $agenda = get_post_meta($post->ID, 'aba_course_description', true);
        $course_date = get_post_meta($post->ID, 'aba_booking_course_date', true);
        $course_id = get_post_meta($post->ID, 'aba_booking_course_id', true);

?>
        <div class="aba_booking_metabox_wrapper">
            <div class="aba_booking_form_group">
                <label for="aba_booking_course_id">
                    <?php _e('Course ID', 'aba_booking'); ?>
                </label>
                <input placeholder="Course ID" readonly type="text" name="aba_booking_course_id" id="aba_booking_course_id" value="<?php echo $course_id; ?>" class="regular-text" />
            </div>

            <div class="aba_booking_form_group">
                <label for="aba_course_description">
                    <?php _e('Course Description', 'aba_booking'); ?>
                </label>
                <textarea name="aba_course_description" id="aba_course_description" placeholder="Course Description" class="regular-text"><?php echo $agenda; ?></textarea>
            </div>

            <div class="aba_booking_form_group">
                <label for="aba_booking_course_date">
                    <?php _e('Course Date', 'aba_booking'); ?>
                </label>
                <input placeholder="Select Date" type="text" name="aba_booking_course_date" id="aba_booking_course_date" value="<?php echo $course_date; ?>" class="regular-text" />
            </div>

        </div>
<?php
    }

    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save($post_id) {
        if (!$this->is_secured('aba_booking_course_nonce', 'aba_booking_course', $post_id)) {
            return $post_id;
        }

        if (isset($_POST['aba_course_description'])) {
            update_post_meta($post_id, 'aba_course_description', sanitize_text_field($_POST['aba_course_description']));
        }

        if (isset($_POST['aba_course_description'])) {
            update_post_meta($post_id, 'aba_course_description', sanitize_text_field($_POST['aba_course_description']));
        }

        if (isset($_POST['aba_booking_course_id'])) {
            update_post_meta($post_id, 'aba_booking_course_id', sanitize_text_field($_POST['aba_booking_course_id']));
        }
    }

    public function get_popup_metabox_value($value) {
        if (isset($value) && !empty($value)) {
            return $value;
        } else {
            return '';
        }
    }
}
