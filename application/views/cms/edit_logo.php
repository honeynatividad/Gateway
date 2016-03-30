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
                                    <i class="glyphicon glyphicon-edit"></i> CREATE logo
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
            
                    <?php echo $error;?>
                    <?php echo form_open_multipart('logo/do_update'); ?>
                        <?php foreach($result as $r): ?>
                        <input type="hidden" name="logo_id" value="<?php echo $logo_id ?>">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Agreement No</label>
                                <div class="col-sm-10">
                                    <input type="text" name="agreement_no" value="<?php echo $r->agreement_no ?>" class="form-control fcntrl" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Agreement Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="agreement_name" value="<?php echo $r->agreement_name ?>" class="form-control fcntrl" required="required">
                                </div>
                            </div>
                      
                            <div class="form-group">
                                <label class="col-sm-2 control-label" >Image</label>
                                <div class="col-sm-10">
                                    <img src="<?php echo base_url($r->image_url); ?>">
                                    <input type="file" name="userfile" value="" class="form-control fcntrl" required="required">
                                </div>
                            </div>                     
                            <div class="form-group">
                                <label class="col-sm-2 control-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    <input type="submit" value="Update" name="upload" class="btn btn-green">
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