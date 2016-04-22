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
            <p>Details: <?php echo $feedback->feedback ?></p>
            <hr>
            
            <?php endforeach; ?>
            
        </div>
    </div>
</div>