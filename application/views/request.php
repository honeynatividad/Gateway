<div class="col-md-9">
    <link href="<?php echo base_url("resources");?>/css/datepicker.css" rel="stylesheet" />
    <script src="<?php echo base_url("resources");?>/js/bootstrap-datepicker.js"></script>
    <script language="javascript" src="<?php echo base_url('resources/js/calendar.js');?>"></script>
    <!--<div class="philcontainer">
    
    </div>		-->	
    <?php if ($this->session->flashdata('upload_error')) { ?>
	<div class="row">
		
			<div class="flash_center"> <?= $this->session->flashdata('upload_error') ?> </div>
		
	</div>
    
    <?php } ?>
	
	<?php if ($this->session->flashdata('upload_errors')) { ?>
	<div class="row">
		
			<div class="flash_center"> <?= $this->session->flashdata('upload_errors') ?> </div>
		
	</div>
    
    <?php } ?>
	
	<?php if ($this->session->flashdata('upload_ok')) { ?>
	<div class="row">
		
		
			<div class="flash_center"> <?= $this->session->flashdata('upload_ok') ?> </div>
		
	</div>
    <?php } ?>
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Reimbursement</div>
        </div>
        
        <div class="panel-body">
            <div class="col-md-9">
                <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
                    <div class="col-sm-10 col-md-12">                        
                        <input type='hidden' name='agreement_no' value='<?php echo $agreement_no ?>'>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="inputEmail3">Date of Availment</label>
                            <div class="col-sm-10">
                                <p><input class="form-control datepicker fcntrl" data-date-format="yyyy-mm-dd" required="required" name="ev_date"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="inputEmail3">Description</label>
                            <div class="col-sm-10">
                                <p><textarea class="form-control fcntrl" name="description" required></textarea></p>                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="inputEmail3"></label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label><input type="radio" name="others" value="HIB">HIB (Hospital Income Benefit) – reimbursement for excess in room and board on confinements due accident
</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="others" value="HMO">HMO – General Reimbursement Request
</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="inputEmail3">Attachment</label>
                            <div class="col-sm-8">
                                <p><input type="file" name="fileToUpload" value="" class="form-control fcntrl" required="required"></p>
                            </div>
							<label class="col-sm-2 control-label" for="inputEmail3">*2mb</label>
                        </div>
 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-10">
                                <input type="submit" name="submitevent" value="SEND" class="btn btn-green">
                            </div>
                        </div>
                    </div>
                </form>  
            </div>
        </div>
        <div class="panel-body">
            
            <!-- start articles -->
           <?php /* <div class="col-md-9">	
            	<div id="Calendar" class=""></div>
            </div>
            
            <div class="col-md-3">
            	<div id="Events" class=""> </div>
            </div>    */?>
    		<!-- end articles -->
           
        </div>
    </div>               
    
    
</div>		
<script>
$(document).ready(function(){
    $(".msg-back").click(function(){
        location.href="<?php echo base_url("messages");?>";
    });
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        todayHighlight:'TRUE',        
        autoclose: true,
    });
});
</script>