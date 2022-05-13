<?php

use Aba_Booking\Admin\Data_Tables\Students_DT;

    if ( isset( $_GET['inserted'] ) ) {?>
        <div class="notice notice-success">
            <p><?php _e( 'Student added successfully!', 'aba-booking' );?></p>
        </div>
    <?php }

    if ( isset( $_GET['student-deleted'] ) && $_GET['student-deleted'] == 'true') {?>
        <div class="notice notice-success">
            <p><?php _e( 'Student deleted successfully!', 'aba-booking' );?></p>
        </div>
    <?php }
    
?> 
<div class="wrap">
    <h1 class="wp-heading-inline">Students List</h1>
    <a href="<?php echo admin_url('admin.php?page=aba-booking-student&action=new') ?>" class="page-title-action">Add New</a>

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