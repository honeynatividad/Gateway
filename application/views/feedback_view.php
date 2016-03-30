<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    <?php $user = $this->session->userdata('logged_in');?>
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Feedback</div>
        </div>
        <div class="panel-body">
            <?php foreach($feedbacks as $feedback): ?>
            <p>Category: <?php echo $feedback->category ?></p>
            <p>Sub Category: <?php echo $feedback->sub_category ?></p>
            <p>Feedback: <?php echo $feedback->feedback ?></p>
            <hr>
            <p>Response: <?php echo $feedback->response ?></p>
            <p>Agent: <?php echo $feedback->agent ?></p>
            <?php endforeach; ?>
            
        </div>
    </div>
</div>