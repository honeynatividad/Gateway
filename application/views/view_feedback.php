<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    <?php $user = $this->session->userdata('logged_in');?>
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Feedback</div>
        </div>
        <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-danger"> <?= $this->session->flashdata('success') ?> </div>
        <?php } ?>
        <?php if ($this->session->flashdata('warning')) { ?>
        <div class="alert alert-danger"> <?= $this->session->flashdata('warning') ?> </div>
        <?php } ?>
        <div class="panel-body">
            <table class="table">
                <th>Category</th>                
                <th>Details</th>
                <th>Reference No</th>                
                <th>Status</th>
                <th>Date Submitted</th>
                <th>Date Resolved</th>
                
                <?php 
               // $s = array_sort_by_column($feedbacks, 'DateCreated');
                foreach($feedbacks as $feedback): ?>
                <tr>
                    <td><?php echo $feedback->Category ?></td>
                    <td><?php echo $feedback->FeedBack ?></td>
                    <td><?php echo $feedback->TicketNo ?></td>                    
                    <td>
                        <?php 
                        if($feedback->Status == "For Approval"){
                            echo 'Open';
                        }else{
                            echo $feedback->Status ;
                        }
                        ?>
                    </td>
                    <td>
                        <?php echo $feedback->DateCreated ?>
                    </td>
                    <td></td>
                    
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php
function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
    $reference_array = array();

    foreach($array as $key => $row) {
        $reference_array[$key] = $row[$column];
    }

    array_multisort($reference_array, $direction, $array);
}
?>