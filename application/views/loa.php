<div class="col-md-9">
<script src="http://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=true"></script>
    <!--<div class="philcontainer">
    
    </div>		-->	
  <style>
.ndropdown option {
    text-transform: uppercase;
}
#doctor_name {
    width: 311px;
}
#specialization > option {
    text-transform: uppercase;
}
.lloading {
    color: #ffffff;
}
.list-group {
    margin-top: -15px;
}
.list-group-item {
    background-color: #323c46;
    border: medium none;
    display: block;
    margin-bottom: -1px;
	border-radius: 0 !important;
    padding: 10px 15px;
    position: relative;
}
</style>  
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Create a LOA</div>
        </div>
        
        <div class="panel-body">
            <div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <div class="panel-body">
                        <form method="post" id="loa-post">
                            <input type="hidden" name="certno" id="certno" value="<?php echo $userid ?>">
                        <ul class="list-group row">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-5">
                                        <div class="form-group">
                                            <div class="metro">
                                                <div class="form-white">
                                                   <div class="radio">
                                                        <label>
                                                            <input id="consultation" name="service_type" value="consultation" type="radio"> Consultation
                                                        </label>
                                                   </div>
                                                   <div class="radio">
                                                        <label>
                                                            <input id="procedures" name="service_type" value="procedures" type="radio"> Procedures
                                                        </label>
                                                   </div>
                                                </div>                                                
                                            </div>  
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                    
                                    

                                    

                                </div><!-- /.row -->						
                            </li>
                        </ul>
                        <ul class="list-group row">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-5">
                                        <div class="form-group">
                                            <div class="metro">
                                                <select class="form-control" id="area_name" data-settings='{"cutOff":10}'>
                                                    <option value="0">PROVINCE/METRO MANILA</option>
                                                    <?php
                                                        $count = count($provinces['ProvinceResult']);
                                                    ?>
                                                    <?php for($x = 0;$x<$count;$x++): ?>
                                                        <option value="<?php echo $provinces['ProvinceResult'][$x]['ProvinceCode'] ?>"><?php echo $provinces['ProvinceResult'][$x]['ProvinceDesc'] ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>  
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                    
                                    <div class="col-sm-6 col-lg-5">
                                        <div class="form-group" id="dist">
                                            <div class="metro">
                                                <select class="form-control" onchange="sp(this.value);" id="districts" data-settings='{"cutOff":10}'>
                                                    <option value="0">DISTRICT/CITY</option>
                                                </select>
                                            </div>   
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                    <div class="col-sm-12 col-lg-2">
                                       <div class="loaderphil" id="thisanchor">
                                            <div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div>
                                        </div>   
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="lloading"></div>
                                    </div>

                                </div><!-- /.row -->						
                            </li>
                        </ul>
                        
                        <ul class="list-group row">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-5">
                                        <div class="form-group" id="content-hospital">
                                            <div class="metro">
                                                <label class='form-white' >Affiliated Hospital</label>
                                                <select class="form-control" onchange="attending(this.value);" id="hospital" data-settings='{"cutOff":10}'>
                                                    <option value="0">PROVIDERS/HOSPITALS</option>
                                                    
                                                </select>
                                            </div>  
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                    
                                    <div class="col-sm-6 col-lg-5">
                                        
                                        <div class="form-group" id="content-doctor">
                                            <div class="metro">
                                                <label class='form-white' >Attending MD</label>
                                                <select class="dval form-control" id="doctor" name="doctor">
                                                    <option value="0">-ATTENDING/DOCTOR-</option>
                                                </select>
                                            </div>   
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                    

                                </div><!-- /.row -->						
                            </li>
                        </ul>
                        
                        <div id='serviceType'>
                            
                        </div>
                        <div class="col-sm-12 col-lg-2">
                                       <div class="loaderphil2" id="thisanchor">
                                            <div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div>
                                        </div>   
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="lloading2"></div>
                                    </div>
                                   
                        <div class="row">
                        <div class="row gmap"></div>
                        <div class="loadcontent">
                            
                        </div>  
                    </div>
                    
                    </form>
                </div>
                <div class="panel-body">
                    <div id="result"></div>
                </div>
                    
            </div>

        </div>

    </div>               
</div>		
</div>
<script>
$(document).ready(function(){
    
	$("#diagnosis").change(function(){
            alert("test");
            $(".lloading2").text("Loading....");
            $(".loaderphil2").show();    
            $.post("<?php echo base_url("loa/getProcedure");?>",
                
		{diagnosis:$(this).val()},function(data){
			
                    $("#content-procedure").html(data);	
                        
                    $(".lloading2").text('');
                    $(".loaderphil2").hide();
		});	
        });
	
	$("#area_name").change(function(){
		$(".lloading").text("Loading....");
                
		$.post("<?php echo base_url("loa/getDistrict");?>",
                
		{city:$(this).val()},function(data){
			
			$("#dist").html(data);	
                        
			$(".lloading").text('done');
		});		
	});
        
        $("#consultation").click(function(){
            $(".lloading2").text("Loading....");
            $(".loaderphil2").show();    
            $.post("<?php echo base_url("loa/getServiceType");?>",
                
		{service:$(this).val()},function(data){
			
                    $("#serviceType").html(data);	
                        
                    $(".lloading2").text('');
                    $(".loaderphil2").hide();
		});	
        });
        
        $("#procedures").click(function(){
            $(".lloading2").text("Loading....");
            $(".loaderphil2").show();    
            $.post("<?php echo base_url("loa/getServiceType");?>",
                
		{service:$(this).val()},function(data){
			
                    $("#serviceType").html(data);	
                        
                    $(".lloading2").text('');
                    $(".loaderphil2").hide();
		});	
        });
        
});
function sp(val){
    var city=$("#area_name").val();
    
    $(".lloading").text("Loading....");
                            //alert(document.getElementById('city').value);
    $.ajax({
        type: 'post',
        url: '<?php echo base_url("loa/getHospital");?>',
            data: {
                city:document.getElementById('districts').value,
               
            },
            success: function (response) {
                                 //alert(response);
                               //document.getElementById("distrct_rep").innerHTML=response; 
                $("#content-hospital").html(response);
                $(".lloading").text('done');
            }
        });
} 

function attending(val){

$(".lloading").text("Loading....");
                            //alert(document.getElementById('city').value);
    $.ajax({
        type: 'post',
        url: '<?php echo base_url("loa/getSearchAttending");?>',
            data: {
                prov:document.getElementById('hospital').value,
               
            },
            success: function (response) {
                                 //alert(response);
                               //document.getElementById("distrct_rep").innerHTML=response; 
                $("#content-doctor").html(response);
                $(".lloading").text('done');
            }
        });
}
</script>