<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Messages</div>
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
              <th>
              <span class="hidden-xs">GO BACK TO MESSAGES</span>
              <span class="visible-xs">GO BACK</span>
              </th>
              <th class="hidden-xs"></th>
              <th class="hidden-xs"></th>
              <th>
              <span class="btn btn-trash pull-right singledlete hidden-xs">MOVE TO TRASH <i class="glyphicon glyphicon-trash"></i></span>
              <span class="btn btn-danger pull-right singledlete visible-xs"><i class="glyphicon glyphicon-trash"></i></span>
              </th>
            </tr>
            </thead>
            </table>
            </div>
            <div>
                 <div class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail3">From</label>
                        <div class="col-sm-10">
                          <p>Philcare Customer Support</p>
                        </div>
                      </div>
                      <?php 
					  $ses = $this->session->userdata('logged_in');
					  if($ses['level']!=1){?>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail3">To</label>
                        <div class="col-sm-10">
                          <p><?php echo $details->fname." ".$details->lname;?></p>
                        </div>
                      </div>
                      <?php }?>
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
                          <?php echo $details->messages;?>
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
			location.href="<?php echo base_url("messages");?>";
		});
		$(".singledlete").click(function(){
			if(confirm("Are you sure?.")){
				
			}
		});
});
</script>