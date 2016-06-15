<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    <link href="<?php echo base_url("resources");?>/css/datepicker.css" rel="stylesheet" />
	<script src="<?php echo base_url("resources");?>/js/bootstrap-datepicker.js"></script>
        <div class="panel panel-philcare">
            <div class="panel-heading">
                <div class="pull-right main-title">Module</div>
            </div>
            <div class="panel-body">
                <div class="row">
            <!-- start messages -->
                    <table class="table" id="tablemsg">
                        <thead id="msgheader">
                            <tr>
                                <th>
                                    <i class="glyphicon glyphicon-edit"></i> CREATE module
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
            
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-danger"> <?= $this->session->flashdata('success') ?> </div>
                    <?php } ?>
                    <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">                        
                        <div class="col-sm-10 col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Agreement No</label>
                                <div class="col-sm-10">
                                    <select class="form-control col-sm-10" id="sel1" name="agreement_no">
                                        <?php foreach($logo as $l): ?>
                                        <option value="<?php echo $l->agreement_no ?>"><?php echo $l->agreement_no ?> - <?php echo $l->username ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Newsfeed</label>
                                <div class="col-sm-10">
                                    <select class="form-control col-sm-10" id="sel1" name="newsfeed">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Provider</label>
                                <div class="col-sm-10">
                                    <select class="form-control col-sm-10" id="sel1" name="provider">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ECU</label>
                                <div class="col-sm-10">
                                    <select class="form-control col-sm-10" id="sel1" name="ecu">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Reimbursement</label>
                                <div class="col-sm-10">
                                    <select class="form-control col-sm-10" id="sel1" name="reimbursement">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">HRA</label>
                                <div class="col-sm-10">
                                    <select class="form-control col-sm-10" id="sel1" name="hra">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                                         
                            <div class="form-group">
                                <label class="col-sm-2 control-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    <input type="submit" value="Add" name="upload" class="btn btn-green">
                                </div>
                            </div>
                        </div>
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