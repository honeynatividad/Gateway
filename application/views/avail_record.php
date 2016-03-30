<div class="col-md-9">
<?php
$session_data = $this->session->userdata('logged_in');
$prepaid = $session_data['prepaid'];


?> 
 

    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">My Availment Record</div>
        </div>
        <div class="panel-body">
 <?php if($prepaid==6){?>
            <!-- start articles -->
         	<div class="row">
				<div class="col-md-12">
                	<div class="well">
                    	<h4>Latest Hospitalization</h4>                                             
                        <table class="table nowline">
                        	<?php if(!empty($inpatient->ClaimNo)){?>
                        	<tr>
                            	<td>Admission Date</td>
                                <td>
								<?php if($inpatient->DateAvailed){ echo date('F d, Y',strtotime($inpatient->DateAvailed)); }?>
                                </td>
                            </tr>
                        	<tr>
                            	<td>Discharge Date</td>
                                <td>
								<?php if($inpatient->DateDischarge){echo date('F d, Y',strtotime($inpatient->DateDischarge)); }?>
                                </td>
                            </tr>    
                         	<tr>
                            	<td>Place of Service</td>
                                <td><?php echo $inpatient->ProviderName;?></td>
                            </tr>  
                         	<tr>
                            	<td>Case Number</td>
                                <td><?php echo $inpatient->ClaimNo;?></td>
                            </tr>  
                        	<tr>
                            	<td>Diagnosis</td>
                                <td><?php echo $inpatient->Diagnosis;?></td>
                            </tr>                           
                            <?php }else{?>
                         	<tr>
                            	<td>“No result found”.</td>
                               
                            </tr>                            
                            
                            <?php }?>                                                                           
                        </table>

                	</div>
                </div>
            </div>  
            
            
         	<div class="row">
				<div class="col-md-12">
                	<div class="well">
                    	<h4>Latest Outpatient Availment Record</h4>                                             
                        <table class="table nowline">
                        <?php if(!empty($outpatient->ClaimNo)){?>
                        	<tr>
                            	<td>Date of Availment</td>
                                <td><?php if($outpatient->DateAvailed){echo date('F d, Y',strtotime($outpatient->DateAvailed)); }?></td>
                            </tr>
                        	<tr>
                            	<td>Place of Service</td>
                                <td><?php echo $outpatient->ProviderName;?></td>
                            </tr>    
                         	<tr>
                            	<td>Case Number</td>
                                <td><?php echo $outpatient->ClaimNo;?></td>
                            </tr>  
                         	<tr>
                            	<td>Attending Physician</td>
                                <td><?php echo $outpatient->AttendingPhysician;?></td>
                            </tr>  
                        	<tr>
                            	<td>Diagnosis</td>
                                <td><?php echo $outpatient->Diagnosis;?></td>
                            </tr>                            
                             <?php }else{?>
                         	<tr>
                            	<td>“No result found”.</td>
                               
                            </tr>                            
                            
                            <?php }?>                                                                                                        
                        </table>

                	</div>
                </div>
            </div>            


         	<div class="row">
				<div class="col-md-12">
                	<div class="well">
                    	<h4>Latest Annual Physical Examination</h4>                                             
                        <table class="table nowline">
                        	<tr>
                            	<td>Patient Code</td>
                                <td></td>
                            </tr>
                        	<tr>
                            	<td>Place of Availment</td>
                                <td></td>
                            </tr>    
                         	<tr>
                            	<td>Date of Availment</td>
                                <td></td>
                            </tr>                                                                                                         
                        </table>

                	</div>
                </div>
            </div>


         	<div class="row">
				<div class="col-md-12">
                	<div class="well">
                    	<h4>Latest Availment of Additional Benefit Package</h4> 
                        <h5>Dental Availment:</h5>   
                        <div class="col-md-offset-1">                  
                        <table class="table nowline">
                        	<tr>
                            	<td>Date of Availment</td>
                                <td><?php echo date('F d, Y',strtotime($dental->DateAvailed));?></td>
                            </tr>
                        	<tr>
                            	<td>Place of Service</td>
                                <td><?php echo $dental->Assignment;?></td>
                            </tr>    
                         	<tr>
                            	<td>Dental Code</td>
                                <td><?php echo $dental->DentalCode;?></td>
                            </tr>  
                         	<tr>
                            	<td>Dental Assessment</td>
                                <td><?php //echo $dental->;?></td>
                            </tr>  
                        	<tr>
                            	<td>Case Number</td>
                                <td><?php echo $dental->ClaimNo;?></td>
                            </tr>
                        	<tr>
                            	<td>Diagnosis</td>
                                <td><?php echo $dental->Diagnosis;?></td>
                            </tr>                        	
                            <tr>
                            	<td>Attending Physician</td>
                                <td><?php echo $dental->AttendingPhysician;?></td>
                            </tr>
                        </table>
						</div>

                        <h5>Maternity Benefit:</h5>   
                        <div class="col-md-offset-1">                  
                        <table class="table nowline">
                        	<tr>
                            	<td>Date of Availment</td>
                                <td><?php echo date('F d, Y',strtotime($maternity->DateAvailed))?></td>
                            </tr>
                        	<tr>
                            	<td>Place of Service</td>
                                <td><?php echo $maternity->ProviderName;?></td>
                            </tr>    
 
                        	<tr>
                            	<td>Case Number</td>
                                <td><?php echo $maternity->ClaimNo;?></td>
                            </tr>
                        	<tr>
                            	<td>Attending Physician</td>
                                <td><?php echo $maternity->AttendingPhysician;?></td>
                            </tr>                        	

                        </table>
						</div>



                     
                        
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