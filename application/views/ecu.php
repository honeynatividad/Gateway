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
                <?php if($apeecu==""){ ?>
                
                    <p>Online appointment request is applicable to the following:</p>
                    <p>a. Executive Check – up (ECU) appointment  - limited to Senior Manager level and above</p>
                    <p>b. Annual Physical Examination (APE) for dependents – exclusive to Manager level and above who availed of company-sponsored plan</p> 

                    <p><i><span style="color: #ff0000">*</span> not applicable to Rank and File to Manager level. Please verify the Onsite APE schedule at the onsite clinic.</i></p>
                <?php }else{?>
                
                <form method="POST" action="" class="form-horizontal">
                    <div class="col-sm-10 col-md-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Type of Appointment</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="sel1" name="type">
                                    <?php if($apeecu=="APE" || $apeecu=="APE/ECU"): ?>
                                    <option value="APE">Annual Physical Examination</option>
                                    <?php endif; ?>                                    
                                    <?php if($apeecu=="ECU" || $apeecu=="APE/ECU"): ?>
                                    <option value="ECU">Executive Check Up</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Type of Availment</label>
                                <div class="col-sm-10">
                                <select class="form-control" id="availment" name="availment">
                                    <option value="OP">Outpatient Care</option>
                                    <option value="IP">Inpatient Care</option>                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">  
                        <?php if($agreement == 'PC10889' || $agreement == 'PC10917' || $agreement == 'PC10939'){ ?>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="metro">
                                        <select class="form-control" id="dsctval" name="district">
                                            <option value="0" class="label">PROVIDER'S NAME</option>
                                            <option value="66">Asian Hospital & Medical Center</option>
                                            <option value="141"> Capitol Medical Center</option>
                                            <option value="145">Cardinal Santos Medical Center</option>
                                            <option value="494">Makati Medial Center</option>
                                            <option value="894">SLMC-GC</option>
                                            <option value="891">SLMC_ QC</option>
                                            <option value="947">The Medical City- Ortigas</option>
                                            <option value="1375">The Medical City- Clark</option>
                                        </select>
                                    </div>   
                                </div><!-- /input-group -->
                            </div>
                            <?php }else{?>                          
                            <div class="col-sm-5 ">
                                <div class="input-group">
                                    <div class="metro">
                                        <select class="form-control" id="area_name" data-settings='{"cutOff":10}'>
                                            <option value="0" class="label">PROVINCE/METRO MANILA</option>
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
                                        <select class="form-control" id="dsctval" name="district">
                                            <option value="0" class="label">PROVIDER'S NAME</option>
                                        </select>
                                    </div>   
                                </div><!-- /input-group -->
                            </div>
                            <?php } ?>
                            <div class="col-lg-2">
                                <div class="lloading"></div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="inputEmail3">Preferred Schedule</label>
                            <div class="col-sm-10">
                                <p><input class="form-control datepicker fcntrl" data-date-format="yyyy-mm-dd" required="required" name="ev_date"></p>
                            </div>
                        </div>
 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-10">
                                <input type="submit" name="submitevent" value="SEND" class="btn btn-green">
                            </div>
                        </div>
                    </div>
                </form>  
                <?php } ?>
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
    
});
</script>