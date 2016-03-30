<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">FAQ SETTING</div>
        </div>
        <div class="panel-body">
        	<div class="row">
            <!-- start messages -->
            
                 <form action="" method="post" class="form-horizontal">
				  <div class="col-sm-10 col-md-12">
                      
                       <div class="form-group">
                        <div class="col-sm-12">
                            <textarea cols="100" id="editor1" name="faq" rows="20"><?php echo $sinfo->faq_info;?></textarea>
                            <script>
                                //CKEDITOR.replace( 'editor1' );
                                CKEDITOR.replace( 'editor1');
                            </script>                         
                         </div>
                      </div>                     
 
 
                       <div class="form-group">
                        
                        <div class="col-sm-10">
                          <input type="submit" name="submitinfo" value="SAVE" class="btn btn-green">
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