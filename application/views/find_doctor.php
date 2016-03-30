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
            <div class="pull-right main-title">Find a Doctor</div>
        </div>
        
        <div class="panel-body">
            <div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <div class="panel-body">
                        <ul class="list-group row">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-5">
                                        <div class="form-group">
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
                                    </div><!-- /.col-lg-6 -->
                                    
                                    <div class="col-sm-6 col-lg-5">
                                        <div class="form-group" id="dist">
                                            <div class="metro">
                                                <select class="dval form-control" id="dval" name="district">
                                                    <option value="0" class="label">DISTRICT/CITY</option>
                                                </select>
                                            </div>   
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                    <div class="col-lg-2">
                                        <div class="lloading"></div>
                                    </div>

                                </div><!-- /.row -->						
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-5">
                                        <div class="form-group" id="specs">
                                            <div class="metro">
                                                <select class="sp form-control" id="specialization" data-settings='{"cutOff":10}' name='specialization'>
                                                    <option value="0" class="label">SPECIALIZATION</option>
                                                </select>
                                            </div>   
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-sm-6 col-lg-5">
                                        <div class="form-group">
                                            <div class="">
                                                <input class="form-control" type="text" id="doctor_name" placeholder="Doctor's Name">
                                            </div>     
                                        </div><!-- /input-group -->
                                    </div>
                                    
                                    
                                    <input type="hidden" id="certno" name="certno" value="<?php echo $userid ?>">
                                    <div class="col-sm-12 col-lg-2">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default-orange" type="button" id="startfinding">
                                                SEARCH
                                            </button>
                                        </span>
                                    </div>

                                </div><!-- /.row -->						
                            </li>	
                            
                        </ul>
                        <div class="row">
                            </form>
                        </div>   
                        <div class="loaderphil" id="thisanchor">
                            <div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div>
                        </div>   
                        <div class="">
                            <p>To find a provider - clinic:<br /> Step 1: Choose Province/Metro Manila<br />Step 2: Click SEARCH<br/>You may do an advanced search by choosing a location or specifying the clinic or hospital name. 
                                <?php
    
                    $session_data = $this->session->userdata('logged_in');
                    if($session_data['agreement_no']!="PC10917" && $session_data['agreement_no']!="PC10889" && $session_data['agreement_no']!="PC10939"){
                        ?>
                                For further assistance, please call our Customer Service Hotline: +63 (2) 462-1800 or for outside Metro Manila (Toll Free for PLDT): 1-800-1888-3230.</p>
                    <?php } else{ ?>
                            For further assistance, please call our Customer Service Hotline: +63 (2) 462-1802, for Globe Philcare Mobile Hotline : 0995-1353160, for Smart Philcare Mobile Hotline: 0998-9647517.</p>
                    <?php } ?>
                        </div>  		  

                        <div class="row gmap"></div>
                        <div class="loadcontent"></div>  
                    </div>
                </div>

            </div>

        </div>

            <!-- start articles -->
            
    		<!-- end articles -->
        
    </div>               
</div>		
<script>
$(document).ready(function(){
	$("#startfinding").click(function(){
		var loc=$("#doctor_name").val();
		var area=$("#area_name").val();
		var type=$(".sp").val();
		var dt=$("#district").val();
                var certno = $("#certno").val();
                
		if(area!='0' || dt!='0' || type!='0'){
                   //alert("doctorname is "+ loc +": area is "+ area +": specialization is "+type+" district is "+dt +" : cert no is "+certno);
			$(".loaderphil").show();
			$.post("<?php echo base_url("providers/getprovider_doctor");?>",{doctor_name:loc,area_name:area,district:dt,specialization:type,certno:certno},function(data){
				
				$(".loadcontent").html(data);
				$(".loaderphil").hide();
			});
		}else{
                    
			alert("Please Provide Required Fields");
		}
		
	});
	
	$("body").on("click",".getmap",function(){
		var thisId=$(this).attr("id");
		var lat = $("#Latitude"+thisId).val();
		var long = $("#Longitude"+thisId).val();
		$(".mfinder").removeClass("active");
		$("#main"+thisId).addClass("active");
		$(".loaderphil").show();
		$(".gmap").html('<div class="col-md-12"><div class="row"><iframe width="100%" height="365px" frameborder="0" style="border:0" src="<?php echo base_url("providers/getMap");?>?longs='+long+'&lats='+lat+'"></iframe></div></div>');
		$(".loaderphil").hide();
		$("html, body").animate({ scrollTop: 0 }, "slow");
		
	});
	
	$("body").on("click",".addtofav",function(){
		var thisId = $(this).attr("val-id");
		var adds=$("#Address"+thisId).val();
		var coor=$("#Coordinator"+thisId).val();
		var lat=$("#Latitude"+thisId).val();
		var long=$("#Longitude"+thisId).val();
		var proCode=$("#ProviderCode"+thisId).val();
		var proName=$("#ProviderName"+thisId).val();
		var region=$("#Region"+thisId).val();
		var tel=$("#Telephone"+thisId).val();
		
		$.post("<?php echo base_url("providers/savefav");?>",
		{address:adds,coordinator:coor,latitude:lat,longitude:long,code:proCode,name:proName,region:region,cp:tel},
		function(data){
			$("#btbutton"+thisId).removeClass('addtofav');
			$("#btbutton"+thisId).addClass('delfromfav');
			$("#btbutton"+thisId).html('<label class="btn btn-remove-fav">REMOVE TO MY FAVORITES <i class="glyphicon glyphicon-trash"></i></label>');
		});
		
	});
	
	$("body").on("click",".delfromfav",function(){
		var thisId = $(this).attr("val-id");
		if(confirm("Are you sure?")){
			$.post("<?php echo base_url("providers/delpfav");?>",{code:thisId},function(data){
				$("#btbutton"+thisId).removeClass('delfromfav');
				$("#btbutton"+thisId).addClass('addtofav');
				$("#btbutton"+thisId).html('<label class="btn btn-fav">ADD TO MY FAVORITES <i class="glyphicon glyphicon-star"></i></label>');			
			});
		}
	});
	
	$("#area_name").change(function(){
		$(".lloading").text("Loading....");
                
		$.post("<?php echo base_url("providers/getallDistrictDoctors");?>",
                
		{city:$(this).val()},function(data){
			
			$("#dist").html(data);	
                        
			$(".lloading").text('done');
		});		
	});
        
       
        
});

</script>