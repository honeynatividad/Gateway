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
                <th>Sub Category</th>
                <th>Feedback</th>
                <th>Date</th>
                
                <?php foreach($feedbacks as $feedback): ?>
                <tr>
                    <td><?php echo $feedback->Category ?></td>
                    <td><?php echo $feedback->SubCategory ?></td>
                    <td><?php echo $feedback->FeedBack ?></td>
                    <td>
                        <?php echo $feedback->DateCreated ?>
                    </td>
                    
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>