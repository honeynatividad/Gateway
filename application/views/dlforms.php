<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Downloadable Forms</div>
        </div>
        <div class="panel-body">

            <!-- start articles -->
              <div class="col-md-12">
              	<?php foreach($dlforms as $dl){?>
            		<div class="row dlforms">
                    	<div class="col-md-12">
                        	<i class="phil-pdf"></i>
                        	<p><?php echo $dl->dl_name;?></p>
                        	<div class="pull-right dlformbtn">
                            	<a href="<?php echo $dl->dl_url;?>" class="btn btn-reponsive-green">
                                Download Form &nbsp;&nbsp;&nbsp;
                                <i class="glyphicon glyphicon-download-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
				<?php }?>

                    
              </div>
    		<!-- end articles -->
            
        </div>
    </div>               
    
    
</div>		
<script>
$(document).ready(function(){

});
</script>