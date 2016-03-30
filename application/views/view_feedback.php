<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    <?php $user = $this->session->userdata('logged_in');?>
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Feedback</div>
        </div>
        <div class="panel-body">
            <table class="table">
                <th>Category</th>
                <th>Sub Category</th>
                <th>Feedback</th>
                <th>Status</th>
                <th>Action</th>
                <?php foreach($feedbacks as $feedback): ?>
                <tr>
                    <td><?php echo $feedback->category ?></td>
                    <td><?php echo $feedback->sub_category ?></td>
                    <td><?php echo $feedback->feedback ?></td>
                    <td>
                        <?php 
                        if($feedback->response==""){
                            echo "No response";
                        }else{
                            echo "Already replied";
                        }
                        ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url("feedback/view/".$feedback->portal_feedback_id) ?>" class="btn btn-default-green" >View</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>