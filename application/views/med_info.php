
<div class="col-md-9">
<?php
$session_data = $this->session->userdata('logged_in');
$prepaid = $session_data['prepaid'];


?> 
 
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">My Medical Information</div>
        </div>
        <div class="panel-body">
 <?php if($prepaid==6){?>
            <!-- start articles -->
         	<div class="row">
				<div class="col-md-12">
                	<div class="well">
                    	<h4>Latest Annual Physical Examination</h4>                                             
                        <table class="table nowline">
                        	<tr>
                            	<td>Date Of Availment</td>
                                <td><?php echo !empty($medinfo->DateOfAvailment)?date('F d, Y',strtotime($medinfo->DateOfAvailment)):'NONE';?></td>
                            </tr>
                        	<tr>
                            	<td>Place of Service</td>
                                <td><?php echo !empty($medinfo->PlaceOfService)?$medinfo->PlaceOfService:'NONE';?></td>
                            </tr>                       
                        </table>

                	</div>
                </div>
            </div> 
            
            
         	<div class="row">
				<div class="col-md-12">
                	<div class="well">
                    	<h4>Laboratory Examination Findings</h4>                                             
                        <table class="table nowline">
                        	<tr>
                            	<td>Urinalysis</td>
                                <td><?php echo !empty($medinfo->Urinalysis)?$medinfo->Urinalysis:'NONE';?></td>
                            </tr>
                        	<tr>
                            	<td>ECG</td>
                                <td><?php echo !empty($medinfo->ECG)?$medinfo->ECG:'NONE';?></td>
                            </tr>                       
                        	<tr>
                            	<td>X-Ray</td>
                                <td><?php echo !empty($medinfo->XRay)?$medinfo->ECG:'NONE';?></td>
                            </tr> 
                        	<tr>
                            	<td>Ultrasound</td>
                                <td><?php echo !empty($medinfo->UltraSound)?$medinfo->UltraSound:'NONE';?></td>
                            </tr> 
                        </table>

                	</div>
                </div>
            </div>
            
  <?php  }else{?>
          	<div class="row">
				<div class="col-md-12">
                	<div class="well">
                    	<!--<h4>No Prepaid Access.</h4>-->   
                    </div>
                </div>     
  			</div>
  <?php }?>                           
    		<!-- end articles -->
            
        </div>
    </div>               
    
    
</div>		
<script>
$(document).ready(function(){

});
</script>