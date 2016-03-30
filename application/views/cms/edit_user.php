<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    <link href="<?php echo base_url("resources");?>/css/datepicker.css" rel="stylesheet" />
	<script src="<?php echo base_url("resources");?>/js/bootstrap-datepicker.js"></script>
        <div class="panel panel-philcare">
            <div class="panel-heading">
                <div class="pull-right main-title">User</div>
            </div>
            <div class="panel-body">
                <div class="row">
            <!-- start messages -->
                    <table class="table" id="tablemsg">
                        <thead id="msgheader">
                            <tr>
                                <th>
                                    <i class="glyphicon glyphicon-edit"></i> Edit User
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
            
                    <form method="POST" action="" class="form-horizontal">
                        <?php foreach($result as $r): ?>
                        <div class="col-sm-10 col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" value="<?php echo $r->username ?>" class="form-control fcntrl" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" value="" class="form-control fcntrl" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Agreement No</label>
                                <div class="col-sm-10">
                                    <input type="text" name="agreement_no" value="<?php echo $r->agreement_no ?>" class="form-control fcntrl" required="required">
                                </div>
                            </div>        
                            <div class="form-group">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-10">
                                    <div class="checkbox">
                                        <label><input type="checkbox" value="1" name="hra">HRA</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-10">
                                    <div class="checkbox">
                                    <label><input type="checkbox" value="1" name="member">Member</label>
                                </div>
                                </div>
                            </div>
                                                 
                            <div class="form-group">
                                <label class="col-sm-2 control-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    <input type="submit" name="submitnews" value="SAVE" class="btn btn-green">
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
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