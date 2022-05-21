<?php

use Aba_Booking\Admin\Data_Tables\Students_DT;

    display_crud_status( 'inserted', 'Student added successfully!' );
    display_crud_status( 'student-deleted', 'Student deleted successfully' );
    display_crud_status( 'request-appt', 'Request Appointment successfully!' );

?> 
<?php $student_req_appt_id = get_student_id(); ?>

<div class="wrap">
    <h1 class="wp-heading-inline">Students List</h1>

    <a href="<?php echo admin_url('admin.php?page=aba-booking-student&action=new') ?>" class="page-title-action">Add New</a>
    <a href="<?php echo admin_url('admin.php?page=aba-booking-student&action=req-appt&id='. $student_req_appt_id['id'] ) ?>" class="page-title-action">Request an Appointment</a>

    <?php
        $student_data_table = new Students_DT();
    ?>
    <div class="wrap">
        <form id="art-search-form" method="GET">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />
            <?php
                $student_data_table->prepare_items();
                $student_data_table->search_box( 'search', 'search_id' );
                $student_data_table->display();
            ?>
        </form>
    </div>
</div>