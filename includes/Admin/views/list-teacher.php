<?php

use Aba_Booking\Admin\Data_Tables\Students_DT;

    display_crud_status( 'inserted', 'Student added successfully!' );
    display_crud_status( 'teacher-deleted', 'Student deleted successfully' );
    display_crud_status( 'request-appt', 'Request Appointment successfully!' );

?> 
<?php //$teacher_req_appt_id = get_teacher_id(); ?>

<div class="wrap">
    <h1 class="wp-heading-inline">Teachers List</h1>

    <a href="<?php echo admin_url('admin.php?page=aba-booking-teacher&action=new') ?>" class="page-title-action">Add New</a>
    <a href="<?php echo admin_url('admin.php?page=aba-booking-teacher&action=view-req-appt&id=' ) ?>" class="page-title-action">View Request Appointment</a> 
    <!-- $teacher_req_appt_id['id'] -->

    <?php
        $teacher_data_table = new Students_DT();
    ?>
    <div class="wrap">
        <form id="art-search-form" method="GET">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />
            <?php
                $teacher_data_table->prepare_items();
                $teacher_data_table->search_box( 'search', 'search_id' );
                $teacher_data_table->display();
            ?>
        </form>
    </div>
</div>