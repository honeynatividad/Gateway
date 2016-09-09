<div class="col-md-9">
    <link href="<?php echo base_url("resources");?>/css/datepicker.css" rel="stylesheet" />
    <script src="<?php echo base_url("resources");?>/js/bootstrap-datepicker.js"></script>
    <script language="javascript" src="<?php echo base_url('resources/js/calendar.js');?>"></script>
    <!--<div class="philcontainer">
    
    </div>		-->	
    <?php if ($this->session->flashdata('ecu_error')) { ?>
        <div class="alert alert-danger"> <?= $this->session->flashdata('ecu_error') ?> </div>
    <?php } ?>
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Online Schedule Appointment</div>
        </div>
        
        <div class="panel-body">
            <div class="col-md-12">
                <?php if($member_type=="DEPENDENT"){ ?>
                <p>Online appointment request is applicable to the following:</p>
                    <p>a. Executive Check – up (ECU) appointment  - limited to Senior Manager level and above</p>
                    <p>b. Annual Physical Examination (APE) for dependents – exclusive to Manager level and above who availed of company-sponsored plan</p> 
                <?php
                }else{
                    
                ?>
                <?php if($apeecu=="" || $apeecu == "NO"){ ?>
                
                    <p>Online appointment request is applicable to the following:</p>
                    <p>a. Executive Check – up (ECU) appointment  - limited to Senior Manager level and above</p>
                    <p>b. Annual Physical Examination (APE) for dependents – exclusive to Manager level and above who availed of company-sponsored plan</p> 

                    <p><i><span style="color: #ff0000">*</span> not applicable to Rank and File to Manager level. Please verify the Onsite APE schedule at the onsite clinic.</i></p>
                <?php }else{?>
                
                <form method="POST" action="" class="form-horizontal">
                    <div class="col-sm-10 col-md-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Dependents</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="dependent" name="dependent">
                                    <option value='0'>-</option>
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
                                        if($ddetails->PolicyNo == "PC10939-001"){
                                            
                                        }else{
                                            
                                        
				?>                                    
                                    <option value="<?php echo $ddetails->CertNo;?>"><?php echo $ddetails->FirstName;?> - <?php echo $ddetails->LastName;?></option>
                                  
                                    <?php } }
                                    
                                    //}  
                                  } }?> 
                                        </select>
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Type of Appointment</label>
                            <div class="col-sm-10" id='appointment'>
                                <select class="form-control" id="sel1" name="type">
                                    <?php if($apeecu=="APE" || $apeecu=="APE/ECU"): ?>
                                    <option value="APE">Annual Physical Examination</option>
                                    <?php endif; ?>                                    
                                    <?php if($apeecu=="ECU" || $apeecu=="APE/ECU"): ?>
                                    <option value="ECU">Executive Check Up</option>
                                    <?php endif; ?>
                                    <?php if($apeecu=="N/A"): ?>
                                    <option value="0"></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id='av'>
                            <label class="col-sm-2 control-label">Type of Availment</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="availment" name="availment">
                                        
                                        <?php
                                        if($classCode == "01" || $classCode == "02"){
                                        ?>
                                        <option value="IP">In Patient</option>
                                        <?php
                                        }else{
                                        ?>
                                        <option value="OP">Out Patient</option>
                                        <?php
                                        }
                                        ?>
                                                                       
                                    </select>
                            </div>
                        </div>
                        <div class="form-group" id='typeAPE'>     
                            <label class="col-sm-2 control-label">Provider's Name</label>
                            
                        <?php if($apeecu =="ECU"){ ?>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="metro">
                                        <select class="form-control" id="dsctval" name="district" required="">
                                            <option value="0">PROVIDER'S NAME</option>
                                            <?php
                                            $count  = count($providers_ape['ECUProvidersListPerAccountResult']);
                                            
                                            for($x = 0;$x<$count;$x++):
                                            ?>
                                            
                                            <option value="<?php echo $providers_ape['ECUProvidersListPerAccountResult'][$x]['ProviderCode']; ?>"><?php echo $providers_ape['ECUProvidersListPerAccountResult'][$x]['ProviderName'] ?></option>
                                            
                                            <?php endfor; ?>
                                        </select>
                                    </div>   
                                </div><!-- /input-group -->
                            </div>
                            <?php }else{?>   
                           
                            <div class="col-sm-5 ">
                                <div class="input-group">
                                    <div class="metro">
                                        <select class="form-control" id="area_name" data-settings='{"cutOff":10}' required="" >
                                            
                                            <?php 

                                            foreach($provinces as $p){
                                                $namespaces = $provinces->getNameSpaces(true);
                                                $list = $p->children($namespaces['a']);
                                                foreach($list as $li){
                                                    $prov = $li->children($namespaces['a']);
                                                ?>
                                                <option value="<?php echo urlencode($prov->City);?>"><?php echo $prov->City;?></option>
                                                <?php }

                                                }?>
                                        </select>
                                    </div>  
                                </div><!-- /input-group -->
                            </div>
                            
                            <div class="col-sm-5">
                                <div class="input-group" id="distrct_rep">
                                    <div class="metro">
                                        <select class="form-control" id="dsctval" name="district" required="">
                                            <option value="0" class="label">PROVIDER'S NAME</option>
                                        </select>
                                    </div>   
                                </div><!-- /input-group -->
                            </div>
                            <?php } ?>
                            
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="inputEmail3">Preferred Schedule</label>
                            <div class="col-sm-10">
                                <p><input class="form-control datepicker fcntrl" data-date-format="yyyy-mm-dd" required="" name="ev_date"></p>
                            </div>
                        </div>
                        <input type='hidden' name='typeA' value='<?php echo $apeecu ?>' id='typeA'>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-8" id="submitevent">
                                <input type="submit"  name="submitevent" value="SEND" class="btn btn-green">
                            </div>
                            <div class="col-lg-2">
                                <div class="lloading"></div>
                            </div>
                        </div>
                    </div>
                    
                </form>  
                <?php } } ?>
            </div>
        </div>
        <div class="panel-body">
            
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
    $(".msg-back").click(function(){
        location.href="<?php echo base_url("messages");?>";
    });
    //$('.datepicker').datepicker()
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        todayHighlight:'TRUE',
        startDate: '+10d',
        autoclose: true,
    });
    $("#availment").change(function(){
        //$("#area_name").empty();
        //$("#area_name").val($("#area_name option:first").val());
        //alert(document.getElementById('area_name').value);
        
            
        $(".lloading").text("Loading....");
        $.post("<?php echo base_url("ecu/getallDistrict");?>",
        {city:document.getElementById('area_name').value,availment:document.getElementById('availment').value},function(data){

                /*var $selects = $('.dsctval2');
                        $selects.easyDropDown({
                                cutOff: 10
                        });

                $("#distrct_rep").html(data);
                */

                $("#distrct_rep").html(data);	
                $(".lloading").text('done loading');
        });	
    });
    
    $("#area_name").change(function(){
        //alert("change"+document.getElementById('availment').value);
        //$("#availment").val($("#availment option:first").val());
        $(".lloading").text("Loading....");
        $.post("<?php echo base_url("ecu/getallDistrict");?>",
        {city:$(this).val(),availment:document.getElementById('availment').value},function(data){
              
            $("#distrct_rep").html(data);	
            $(".lloading").text('done loading');
        });		
    });
    
    $("#dependent").change(function(){        //alert("change"+document.getElementById('availment').value);
        //$("#availment").val($("#availment option:first").val());
        var typeA = $("#typeA").val();
        //alert($(this).val());
        $.post("<?php echo base_url("ecu/changeAppointment");?>",
        {dependent:$(this).val(),typeA:typeA},function(data){              
            //alert(data);
            $("#sel1").html(data);
            //$('#av').html($('#changeAvail' , data).html());
            $(".lloading").text('done loading');
        });		
    });    
});
</script>