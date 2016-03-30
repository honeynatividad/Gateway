<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    <link href="<?php echo base_url("resources");?>/css/datepicker.css" rel="stylesheet" />
	<script src="<?php echo base_url("resources");?>/js/bootstrap-datepicker.js"></script>
        <div class="panel panel-philcare">
            <div class="panel-heading">
                <div class="pull-right main-title">Logo</div>
            </div>
            <div class="panel-body">
                <div class="row">
            <!-- start messages -->
                    <table class="table" id="tablemsg">
                        <thead id="msgheader">
                            <tr>
                                <th>
                                    <i class="glyphicon glyphicon-edit"></i> EDIT Module
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
            
                    
                    <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
                        <?php foreach($result as $r): ?>
                        <input type="hidden" name="module_id" value="<?php echo $module_id ?>">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Agreement No</label>
                                <div class="col-sm-10">
                                    <input type="text" name="agreement_no" value="<?php echo $r->agreement_no ?>" class="form-control fcntrl" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Newsfeed</label>
                                <div class="col-sm-10">
                                    <select class="form-control col-sm-10" id="sel1" name="newsfeed">
                                        <option value="<?php echo $r->newsfeed ?>">
                                            <?php 
                                                if($r->newsfeed == 1) 
                                                    echo 'Yes';
                                                else
                                                    echo 'No';
                                            ?>
                                        </option>
                                        <?php 
                                            if($r->newsfeed == 1){
                                        ?>                                        
                                        <option value="0">No</option>
                                        <?php 
                                            }else{
                                        ?>
                                        <option value="1">Yes</option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Provider</label>
                                <div class="col-sm-10">
                                    <select class="form-control col-sm-10" id="sel1" name="provider">
                                        <option value="<?php echo $r->provider ?>">
                                            <?php 
                                                if($r->provider == 1) 
                                                    echo 'Yes';
                                                else
                                                    echo 'No';
                                            ?>
                                        </option>
                                        <?php 
                                            if($r->provider == 1){
                                        ?>                                        
                                        <option value="0">No</option>
                                        <?php 
                                            }else{
                                        ?>
                                        <option value="1">Yes</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ECU</label>
                                <div class="col-sm-10">
                                    <select class="form-control col-sm-10" id="sel1" name="ecu">
                                        <option value="<?php echo $r->newsfeed ?>">
                                            <?php 
                                                if($r->ecu == 1) 
                                                    echo 'Yes';
                                                else
                                                    echo 'No';
                                            ?>
                                        </option>
                                        <?php 
                                            if($r->ecu == 1){
                                        ?>                                        
                                        <option value="0">No</option>
                                        <?php 
                                            }else{
                                        ?>
                                        <option value="1">Yes</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Reimbursement</label>
                                <div class="col-sm-10">
                                    <select class="form-control col-sm-10" id="sel1" name="reimbursement">
                                        <option value="<?php echo $r->reimbursement ?>">
                                            <?php 
                                                if($r->reimbursement == 1) 
                                                    echo 'Yes';
                                                else
                                                    echo 'No';
                                            ?>
                                        </option>
                                        <?php 
                                            if($r->reimbursement == 1){
                                        ?>                                        
                                        <option value="0">No</option>
                                        <?php 
                                            }else{
                                        ?>
                                        <option value="1">Yes</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    <input type="submit" value="Edit" name="upload" class="btn btn-green">
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </form>           
            
            
    		<!-- end messages -->
                </div>
            </div>               
        </div>
    
    </div>		
<script>
$(document).ready(function(){
		$(".msg-back").click(function(){
			location.href="<?php echo base_url("messages");?>";
		});
		$('.datepicker').datepicker()
});


</script>