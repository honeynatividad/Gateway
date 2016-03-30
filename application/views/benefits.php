<div class="col-md-9">
<?php
$session_data = $this->session->userdata('logged_in');
$prepaid = $session_data['prepaid'];


?>

    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">My Benefits</div>
        </div>
        <div class="panel-body">
 <?php if($prepaid==6){?>
            <!-- start articles -->
         	<div class="row">
				<div class="col-md-12">
                	<div class="well">
                    	<h4>My Benefit Package</h4>                                             
                        <table class="table nowline">
                        	<tr>
                            	<td>Benefit Package</td>
                                <td><?php echo $info->PackageDescription;?></td>
                            </tr>
                        	<tr>
                            	<td>Plan Type</td>
                                <td><?php echo $info->PlanType;?></td>
                            </tr>    
                         	<tr>
                            	<td>Room Type</td>
                                <td><?php echo $info->RoomDescription;?></td>
                            </tr>  
                         	<tr>
                            	<td>Room and Board Limit</td>
                                <td><?php echo $info->RoomRate;?></td>
                            </tr>  
                        	<tr>
                            	<td>Diagnosis</td>
                                <td><?php echo $info->Dental;?></td>
                            </tr>                                                                                                       
                        </table>

                	</div>
                </div>
            </div> 
            
          	<div class="row">
				<div class="col-md-12">
                	<div class="well">                                            
                        <table class="table nowline">
                        	<tr>
                            	<td>Hospitals:</td>
                                <td><?php echo $info->Hospitals;?></td>
                            </tr>
                        	<tr>
                            	<td>Benefit Limit:</td>
                                <td><?php echo $info->BenefitLimit;?></td>
                            </tr>    
                         	<tr>
                            	<td>Pre-Existing Condition:</td>
                                <td><?php echo $info->PreEx;?></td>
                            </tr>  
                         	<tr>
                            	<td>PhilHealth:</td>
                                <td><?php echo $info->PhilHealth;?></td>
                            </tr>  
                        	<tr>
                            	<td>Addiotional Coverage:</td>
                                <td><?php //echo $info->PackageDescription;?></td>
                            </tr>                                                                                                       
                        </table>

                	</div>
                </div>
            </div>             
            
 
 
          	<div class="row">
				<div class="col-md-12">
                	<div class="well">
                    	<h4>My Annual Physical Examination Benefit</h4>                                             
                        <ul>
                        	<li>Taking Medical History</li>
                            <li>Physical Examination</li>
                            <li>Chest X-Ray</li>
                            <li>Urinalysis</li>
                            <li>Stool Examination</li>
                            <li>Complete Blood Count (CBC)</li>
                        </ul>

                	</div>
                </div>
            </div>  
 <?php }else{?>

          	<div class="row">
				<div class="col-md-12">
                	<div class="well">
                    	<h4>Prepaid Access.</h4>   
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