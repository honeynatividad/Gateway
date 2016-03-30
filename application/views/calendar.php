<div class="col-md-9">
<script language="javascript" src="<?php echo base_url('resources/js/calendar.js');?>"></script>
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Calendar</div>
        </div>
        <?php if ($this->session->flashdata('msg_return')) { ?>
                <div class="alert alert-danger"> <?= $this->session->flashdata('msg_return') ?> </div>
            <?php } ?>
        
        
        
        <div class="panel-body">
            <div id="Calendar">
            </div> 
            <!-- start articles -->
           <?php /* <div class="col-md-9">	
            	<div id="Calendar" class=""></div>
            </div>
            
            <div class="col-md-3">
            	<div id="Events" class=""> </div>
            </div>    */?>
    		<!-- end articles -->
           
        </div>
    </div>               
    
    
</div>		
<script>
$(document).ready(function(){

});
</script>