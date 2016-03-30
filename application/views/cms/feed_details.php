<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Feedback</div>
        </div>
        <div class="panel-body">
        	<div class="row">
            <!-- start messages -->
            <table class="table" id="tablemsg">
            <thead id="msgheader">
            <tr>
              <th>
                <div class="pull-left msg-back">
                    <span class=""><i class="glyphicon glyphicon-circle-arrow-left"></i></span>
                </div>
              </th>
              <th>GO BACK TO FEEDBACK LIST</th>
              <th></th>
              <th></th>
              <th><span class="btn btn-trash pull-right singledlete">MOVE TO TRASH <i class="glyphicon glyphicon-trash"></i></span></th>
            </tr>
            </thead>
            </table>
            
                 <div class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail3">From</label>
                        <div class="col-sm-10">
                          <p><?php echo $details->fname." ".$details->lname;?></p>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail3">Date</label>
                        <div class="col-sm-10">
                          <p><?php echo date('F d, Y H:i a',strtotime($details->date_created));?></p>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail3">Subject</label>
                        <div class="col-sm-10">
                          <p><?php echo $details->subject;?></p>
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail3"></label>
                        <div class="col-sm-9">
                          <?php echo $details->comments;?>
                        </div>
                      </div>                     
                      
                    </div>           
            
            
    		<!-- end messages -->
        </div>
    </div>               
   </div>
    
</div>		
<script>
$(document).ready(function(){
		$(".msg-back").click(function(){
			location.href="<?php echo base_url("admin/fbslist");?>";
		});
		$(".singledlete").click(function(){
			if(confirm("Are you sure?.")){
				
			}
		});
});
</script>