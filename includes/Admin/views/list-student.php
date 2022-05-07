<?php

use Aba_Booking\Student_Data_Table;
?>
<div class="wrap">
    <h1 class="wp-heading-inline">Students List</h1>
    <a href="<?php echo admin_url('admin.php?page=aba-booking-student&action=new') ?>" class="page-title-action">Add New</a>

    <?php
        $subscriber_table = new Student_Data_Table();
    ?>
    <div class="wrap">
        <form id="art-search-form" method="GET">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />
            <?php
                $subscriber_table->prepare_items();
                $subscriber_table->search_box( 'search', 'search_id' );
                $subscriber_table->display();
            ?>
        </form>
    </div>
</div>