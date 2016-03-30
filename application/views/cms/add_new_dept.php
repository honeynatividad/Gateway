<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    <link href="<?php echo base_url("resources");?>/css/datepicker.css" rel="stylesheet" />
	<script src="<?php echo base_url("resources");?>/js/bootstrap-datepicker.js"></script>
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">New Event</div>
        </div>
        <div class="panel-body">
        	<div class="row">
            <!-- start messages -->
            <table class="table" id="tablemsg">
            <thead id="msgheader">
            <tr>
              <th>
<i class="glyphicon glyphicon-edit"></i> ADD RECEPIENT
              </th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
            </thead>
            </table>
            
                 <form method="POST" action="" class="form-horizontal">
				  <div class="col-sm-10 col-md-12">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail3">DIVISION</label>
                        <div class="col-sm-5">
                          <p>
                          	<select name="dep_id" class="form-control fcntrl">
                            <?php foreach($divisions as $dv){?>
                            	<option value="<?php echo $dv->dep_id;?>"><?php echo $dv->dep_name;?></option>
                            <?php } ?>    
                            </select>
                          </p>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="col-sm-2 control-label">EMAIL</label>
                        <div class="col-sm-10">
                          <input type="email" name="dep_email" value="" class="form-control fcntrl" required="required">
                        </div>
                      </div>
                                            
                      <div class="form-group">
                        <label class="col-sm-2 control-label">NAME</label>
                        <div class="col-sm-10">
                          <input type="text" name="dep_name" value="" class="form-control fcntrl" required="required">
                        </div>
                      </div>
                                         
 
 
                       <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-10">
                          <input type="submit" name="submit_addrecep" value="SAVE" class="btn btn-green">
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