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
<i class="glyphicon glyphicon-edit"></i> CREATE MESSAGE
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
                        <label class="col-sm-2 control-label" for="inputEmail3">Date</label>
                        <div class="col-sm-10">
                          <p><?php echo date('M d, Y h:i a');?></p>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-10">
                          <input type="text" name="subject" value="" class="form-control fcntrl" required="required">
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail3"></label>
                        <div class="col-sm-10">
                            <textarea cols="100" id="editor1" name="message" rows="20" required></textarea>
                            <script>
                                //CKEDITOR.replace( 'editor1' );
                                CKEDITOR.replace( 'editor1');
                            </script>                         
                         </div>
                      </div>                     
 
 
                       <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-10">
                          <input type="submit" name="submitmsg" value="SEND" class="btn btn-green">
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
});
</script>