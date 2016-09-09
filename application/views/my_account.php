<div class="col-md-9">
    <?php
    $session_data = $this->session->userdata('logged_in');
    $prepaid = $session_data['prepaid'];


    ?>
    <!--<div class="philcontainer">
    </div>		-->	
<style>
    label {
    font-size: 12px;
    }
    .dpdtls{cursor:pointer;}
</style>

<div class="panel panel-philcare">
    <div class="panel-heading">
        <div class="pull-right main-info">Member Information</div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="well">
                    <div class="row">
                        <div class="col-md-4">Member Name:</div>
                        <div class="col-md-8"><?php echo $info->FirstName." ".$info->MiddleName." ".$info->LastName ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Agreement No:</div>
                        <div class="col-md-8"><?php echo $info->AgreementNo; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Policy No:</div>
                        <div class="col-md-8"><?php echo $info->PolicyNo; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Certificate No:</div>
                        <div class="col-md-8"><?php echo $info->CertNo; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Effectivity Date:</div>
                        <div class="col-md-8"><?php echo $info->EffectiveDate ?></div>
                    </div>
                </div>
            </div>            
        </div>   
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">COVERAGE</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">BASIC</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">UTILIZATION</a></li>        
                </ul>
                <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">            
            <div class="row">                    
                <div class="well">
                    <p></p>
                    <div class="row-color">
                        <div class="col-md-12 row-color">Membership Card Information</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Original Effective Date</div>
                        <div class="col-md-8">
                            <?php 
                            $createDate = new DateTime($info->MemberOED );

                            $effDate = $createDate->format('d/m/Y');
                            echo $effDate;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Pre Existing Condition</div>
                        <div class="col-md-8"><?php echo $info->PreEx ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">OP Emergency</div>
                        <div class="col-md-8"><?php echo $info->OPER ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">OP Limit</div>
                        <div class="col-md-8"><?php echo $info->OPLIMIT ?></div>                                
                    </div>
                    <div class="row">
                        <div class="col-md-4">OP Medicine</div>
                        <div class="col-md-8"><?php echo $info->OPMEDS ?></div>                                
                    </div>
                    <div class="row">
                        <div class="col-md-4">Hospitals</div>
                        <div class="col-md-8"><?php echo $info->Hospitals ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">PhilHealth</div>
                        <div class="col-md-8"><?php echo $info->PhilHealth ?></div>
                    </div>                            
                </div>
            </div>
            <div class="row">                    
                <div class="well">
                    <div class="row-color">
                        <div class="col-md-12 row-color">Plan Packages</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Account type</div>
                        <div class="col-md-8"><?php echo $info->AccountType ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><font color="red">*</font>Access Type</div>
                        <div class="col-md-8"><?php echo $info->PackageDescription ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Plan Type</div>
                        <div class="col-md-8"><?php echo $info->PlanType ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Room Type</div>
                        <div class="col-md-8"><?php echo $info->RoomDescription ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Room Description</div>
                        <div class="col-md-8"><?php echo $info->RoomDescription ?></div>                                
                    </div>
                    <div class="row">
                        <div class="col-md-4">R & B Limit</div>
                        <div class="col-md-8"><?php echo $info->RoomRate ?></div>                                
                    </div>
                    <div class="row">
                        <div class="col-md-4">Benefits Package</div>
                        <div class="col-md-8"><?php echo $info->PackageDescription ?></div>
                    </div>
                    <?php
                    
                    if($session_data['agreement_no']=="PC10917"){
                    }elseif($session_data['agreement_no']=="PC10889"){}elseif($session_data['agreement_no']=="PC10939"){
                    }else{
                        ?>
                   
                    <div class="row">
                        <div class="col-md-4">Membership Fee</div>
                        <div class="col-md-8"><?php echo $info->MbrFee ?></div>
                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-4">Benefit Limit</div>
                        <div class="col-md-8"><?php echo $info->BenefitLimit ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>&nbsp;</p>
                            <p style="color:red;font-size:12px;font-style:italic;">Clinic based/Preferred access: For Out-patient, a member’s health is managed only through our accredited clinics of PhilCare. For In-Patient and Emergency cases, member may avail of the service to any of our accredited hospitals.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">                    
                <div class="well">
                    <div class="row-color">
                        <div class="col-md-12 row-color">Dental</div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Assignment</th>
                                    <th>Retainer Fee</th>
                                    <th>Rider Charge</th>
                                    <th>Eff Date</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($dental as $ax): ?>
                                
                                
                                <tr class="success">
                                    
                                    <td><?php echo $ax->Code ?></td>
                                    <td><?php echo $ax->Assignment ?></td>
                                    <td><?php echo $ax->RetainerFee ?></td>
                                    <td><?php echo $ax->RiderCharge ?></td>
                                    <td><?php echo $ax->EffDate ?></td>
                                    <td><?php echo $ax->Remarks ?></td>
                                    
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">                    
                <div class="well">
                    <div class="row-color">
                        <div class="col-md-12 row-color">Maternity</div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table table-fixed">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Effective Date</th>
                                    <th>InMaxLimit</th>
                                    <th>OutMaxLimit</th>
                                    <th>Type Of Delivery</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                 <?php foreach($maternity as $am): ?>
                                <tr class="success">
                                    
                                    <td><?php echo $am->Description ?></td>
                                    <td><?php echo $am->EffDate ?></td>
                                    <td><?php echo $am->InMaxLimit ?></td>
                                    <td><?php echo $am->OutMaxLimit ?></td>
                                    <td><?php echo $am->TypeDelivery ?></td>
                                    <td><?php echo $am->Remarks ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">                    
                <div class="well">
                    <div class="row-color">
                        <div class="col-md-12 row-color">Life AD & D</div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                                 
                                <tr>
                                    
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Rider Charge</th>
                                    <th>Covered Amt</th>
                                    <th>Retainer Fee</th>
                                    <th>Effective Date</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <?php foreach($life as $al): ?>
                                <tr class="success">
                                    
                                    <td><?php echo $al->Code ?></td>
                                    <td><?php echo $al->Description ?></td>
                                    <td><?php echo $al->RiderCharge ?></td>
                                    <td><?php echo $al->CoveredAmount ?></td>
                                    <td><?php echo $al->RetainerFee ?></td>
                                    <td><?php echo $al->EffDate ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">            
            <div class="row">
                <div class="well">
                    <div class="row-color">
                        <div class="col-md-12 row-color">Basic Information</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Street:</div>
                        <div class="col-md-8"><?php echo $info->Street ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">City/Province:</div>
                        <div class="col-md-8"><?php echo $info->City ?>,<?php echo $info->Province ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">District/Brgy:</div>
                        <div class="col-md-8"><?php echo $info->Barangay ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Sex: <?php echo $info->Sex ?></div>
                        <div class="col-md-4">Weight: <?php echo $info->Weight ?></div>
                        <div class="col-md-4">Race: <?php echo $info->Race ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Civil Status: <?php echo $info->CivilStat ?></div>
                        <div class="col-md-4">Height: <?php echo $info->Height ?></div>
                        <div class="col-md-4">BMI: <?php echo $info->BMINo ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">BMI Category:</div>
                        <div class="col-md-8"><?php echo $info->BMICategoty ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Citizenship:</div>
                        <div class="col-md-8"><?php echo $info->Citizenship ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Position:</div>
                        <div class="col-md-8"><?php echo $info->Position ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Occupation:</div>
                        <div class="col-md-8"><?php echo $info->Occupation ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Email:</div>
                        <div class="col-md-8"><?php echo $info->Email ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Mobile Number: </div>
                        <div class="col-md-8"><?php echo $info->MobileNo ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Telephone Number:</div>
                        <div class="col-md-8"><?php echo $info->HomeNo ?></div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="well">
                    <div class="row-color">
                        <div class="col-md-12 row-color">Personal Information <span class="btn badge badge-feed-green pull-right" id="editadd">EDIT</span></div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">Street:</div>
                        <div class="col-md-8"><?php echo $info->PStreet ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">City/Province:</div>
                        <div class="col-md-8"><?php echo $info->PCityProv ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">District/Brgy:</div>
                        <div class="col-md-8"><?php echo $info->PDistBrgy ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Email: <?php echo $info->PEmail ?></div>
                        <div class="col-md-8">Weight:</div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">Mobile Number:</div>
                        <div class="col-md-8"><?php echo $info->PMobileNo ?></div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">Telephone Number:</div>
                        <div class="col-md-8"><?php echo $info->PTelNo ?></div>
                    </div>                    
                </div>
            </div> 
            <div class="row">
                <div class="well">
                    
                        <p class="col-md-12 row-color">Dependents</p>
                    
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Certificate No</th>
                                    <th>Policy No</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Initial</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                               
                                $url ='https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/GetFamily/?CertNo='.$cert;
                                $getxml = file_get_contents($url);
                                $xml = simplexml_load_string($getxml);
                                $ns = $xml->getNamespaces(true);
                                
                                $xml = new SimpleXMLElement($getxml);
                                $xml->registerXPathNamespace('a', 'http://schemas.datacontract.org/2004/07/wcfPCare');
                                $show = 0;
                                foreach($xml->xpath('//a:FamilyMember') as $event) {
                                    $event->registerXPathNamespace('a', 'http://schemas.datacontract.org/2004/07/wcfPCare');
                                    $t = $event->xpath('//a:CertNo');
                                   // var_export($t);
                                    if(!empty($t)){
                                        $show = 1;
                                    }else{
                                       $show = 0;
                                       
                                    }
                                }
                                
                                if($show==1){
                                    
                                foreach($mydependents as $p){
                                    $namespaces = $mydependents->getNameSpaces(true);
                                    
                                    
                                    $dpends = $p->children($namespaces['a'])->FamilyMember;
                                    //if ($dpends===false){
                                        
                                    //}else{
                                    foreach($dpends as $if){
                                        $ddetails = $if->children($namespaces['a']);
				?>
				<tr> 
                                    <td><?php echo $ddetails->CertNo;?></td>
                                    <td><?php echo $ddetails->PolicyNo;?></td>
                                    <td><?php echo $ddetails->LastName;?></td>
                                    <td><?php echo $ddetails->FirstName;?></td>
                                    <td><?php echo $ddetails->MI ?></td>                                    
				</tr>
                                    <?php }
                                    
                                    //}  
                                  } }?> 
                            </tbody>
                        </table>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="messages">
            <div class="row">
                <div class="well">
                    <div class="row-color">
                        <div class="col-md-12 row-color">Member Utilization</div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Provider</th>
                                    <th>Date Availed</th>
                                    <th>Illness</th>
                                    <th>Nature</th>
                                    <th>Case No</th>                                    
                                    <th>Status</th>
                                    <th>Create Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($util as $u ): ?>
                                <tr class="success">
                                    <td><?php echo $u->Provider?></td>
                                    <td><?php echo date("m/d/Y",strtotime($u->DateAvailed)) ?></td>
                                    <td><?php echo $u->Illness ?></td>
                                    <td><?php echo $u->Nature ?></td>
                                    <td><?php echo $u->CaseNo ?></td>                                    
                                    <td><?php echo $u->Status ?></td>
                                    <td><?php echo date("m/d/Y",strtotime($u->DateCreated)) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        </div>
                    </div>                    
                </div>
            </div>
            <!--
            <div class="row">
                <div class="well">
                    <div class="row-color">
                        <div class="col-md-12 row-color">Maximum Limit/Utilization/Remaining Balance</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Maximum Limit:</div>
                        <div class="col-md-8"><?php //echo $util_summary->MaxLimit ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Utilization:</div>
                        <div class="col-md-8"><?php //echo $util_summary->Utilization ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Remaining Balance:</div>
                        <div class="col-md-8"><?php //echo $util_summary->RemainingBalance ?></div>
                    </div>
                </div>
            </div>
            !-->
        </div>        
    </div>
            </div>
        </div>
    </div>
    
    
</div>
<div class="panel panel-philcare">
    
  <!-- Nav tabs -->
    

  <!-- Tab panes -->
  
    
    
</div>

              
    
    
</div>		
<script>
$(document).ready(function(){	
	$("#editadd").click(function(){
		$("#editprofmodal").modal("show");
	});
	
	$("#editother").click(function(){
		$("#editotherinfomodal").modal("show");
	});	
	$("body").on("click",".dpdtls",function(){
		var thisId = $(this).attr("id");
		$("#dfendentsmodal").modal("show");
		$("#replacealldpdnts").html('<div class="col-md-2"><div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div></div>');
		$.post("<?php echo base_url("account/getdefendesntsinfo");?>",{cert:thisId},function(data){
			$("#replacealldpdnts").html(data);
			
		});
		
	});
});
</script>



<!-- Modal -->
<div class="modal fade" id="editprofmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="badge badge-red">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="myModalLabel">Edit My Profile</h3>
      </div>
      <div class="modal-body ">
      
      <div class="row">
      <div class="col-md-12">
      
             <form class="form-horizontal" role="form" action="" method="POST">


              <div class="form-group">
                <label for="" class="col-sm-2 control-label">Home Address</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="HouseNo" value="<?php echo $info->HouseNo;?>" >
                  <label class="control-label">Street Number</label>
                </div>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="Street" value="<?php echo $info->Street;?>" required>
                  <label class="control-label">Street Name</label>
                </div>        
                
                <div class="col-sm-3">
                  <input type="text" class="form-control" name="Barangay" value="<?php echo $info->Barangay;?>" required>
                  <label class="control-label">Barangay</label>
                </div>  
              </div>
  
               <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="Province" value="<?php echo $info->Province;?>" required>
                  <label class="control-label">Region</label>
                </div>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="City" value="<?php echo $info->City;?>" required>
                  <label class="control-label">City/Province</label>
                </div>        
              </div> 
              

              <div class="form-group">
                <label for="" class="col-sm-2 control-label">Home Number</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="HomeNo" value="<?php echo $info->HomeNo;?>" placeholder="">
                </div>      
              </div>
              
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">Mobile Number</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="MobileNo" value="<?php echo $info->MobileNo;?>" placeholder="">
                </div>      
              </div>

              <div class="form-group">
                <label for="" class="col-sm-2 control-label">Email Address</label>
                <div class="col-sm-5">
                  <input type="email" class="form-control" value="<?php echo $info->Email;?>" readonly>
                </div>      
              </div>              
              
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-green">SAVE</button>
                  <input type="hidden" name="update_add" value="1">
                  <input type="hidden" name="CertNo" value="<?php echo $info->CertNo ?>">
                  <button type="button" class="btn btn-red" data-dismiss="modal">CANCEL</button>
                </div>
              </div>
            </form>
 		</div>
        </div>
        
      </div>

    </div>
  </div>
</div>






<!-- Modal -->
<div class="modal fade" id="editotherinfomodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="badge badge-red">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="myModalLabel">Edit Information</h3>
      </div>
      <div class="modal-body ">
      
      <div class="row">
      <div class="col-md-12">
      
             <form class="form-horizontal" role="form" action="" method="POST">

              <div class="form-group">
                <label for="" class="col-sm-4 control-label">Company Name</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="company_name" value="<?php echo $info->company_name;?>" placeholder="">
                </div>      
              </div>
              
              <div class="form-group">
                <label for="" class="col-sm-4 control-label">Company Address</label>
                <div class="col-sm-6">
                  <textarea class="form-control" name="company_address"><?php echo $info->company_address;?></textarea>
                </div>      
              </div>

              <div class="form-group">
                <label for="" class="col-sm-4 control-label">Work Number</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="work_no" value="<?php echo $info->work_no;?>" required>
                </div>      
              </div>              

              <div class="form-group">
                <label for="" class="col-sm-4 control-label">Designation</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="designation" value="<?php echo $info->designation;?>" required>
                </div>      
              </div>
                            
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-green">SAVE</button>
                  <input type="hidden" name="update_comp" value="1">
                  <button type="button" class="btn btn-red" data-dismiss="modal">CANCEL</button>
                </div>
              </div>
            </form>
 		</div>
        </div>
        
      </div>

    </div>
  </div>
</div>









<!-- Modal -->
<div class="modal fade" id="dfendentsmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="badge badge-red">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="myModalLabel">Dependent Information</h3>
      </div>
      <div class="modal-body ">
      
      <div class="row">
      <div class="col-md-12" >
    	  <form class="form-horizontal" role="form" id="replacealldpdnts">
                                                                    
                
          </form>                  
 		</div>
        </div>
        
      </div>

    </div>
  </div>
</div>