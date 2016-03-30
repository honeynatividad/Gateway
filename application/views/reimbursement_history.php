<div class="col-md-9">
    <link href="<?php echo base_url("resources");?>/css/datepicker.css" rel="stylesheet" />
    <script src="<?php echo base_url("resources");?>/js/bootstrap-datepicker.js"></script>
    <script language="javascript" src="<?php echo base_url('resources/js/calendar.js');?>"></script>
    <!--<div class="philcontainer">
    
    </div>		-->	
    <?php if ($this->session->flashdata('ecu_error')) { ?>
                <div class="alert alert-danger"> <?= $this->session->flashdata('ecu_error') ?> </div>
            <?php } ?>
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Reimbursement History</div>
        </div>
        
        <div class="panel-body">
            <div class="col-md-9">
               
            </div>
        </div>
        <div class="panel-body">
         
        </div>
    </div>   
</div>