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
            <div class="pull-right main-title">Find a Dentist</div>
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
                                                <select class="form-control" id="state" name="state" data-settings='{"cutOff":10}'>
                                                    <option value="0" >STATE</option>
                                                    <option value="MM">METRO MANILA</option>
                                                    <option value="LZ">LUZON</option>
                                                    <option value="VI">VISAYAS</option>
                                                    <option value="MI">MINDANAO</option>
                                                </select>
                                            </div>  
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                    
                                    <div class="col-sm-6 col-lg-5">
                                        <div class="form-group">
                                            <div class="metro">
                                                <select class="dval form-control" id="dregion" name="region">
                                                    <option value="0" class="label">REGION</option>
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
                                        <div class="form-group">
                                            <div class="metro">
                                                <select class="form-control" id="area_name" data-settings='{"cutOff":10}'>
                                                    <option value="0" class="label">PROVINCE/METRO MANILA</option>
                                                    
                                                </select>
                                            </div>  
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                    
                                    <div class="col-sm-6 col-lg-5">
                                        <div class="form-group" id="dist">
                                            <div class="metro">
                                                <select class="dval form-control" id="district" name="district">
                                                    <option value="0" class="label">DISTRICT/CITY</option>
                                                </select>
                                            </div>   
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                    
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
                            <p>You may do an advanced search by choosing a location or specifying the clinic or hospital name. For further assistance, please call our Customer Service Hotline: +63(2) 462-1802, for Globe Philcare Mobile Hotline: 0995-1353160, for Smart Philcare Mobile Hotline: 0998-9647517.</p>
                                
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

<div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                
            <!-- Modal content-->
                    <div id="modalContent" style="display:none;">

        </div>

              </div>
            </div>
<script>
$(document).ready(function(){
   
    $("#startfinding").click(function(){
        var state = $("#state").val();
        var region = $("#dregion").val();
		
        var area=$("#area_name").val();	
        var dt=$("#district").val();
        var certno = $("#certno").val();
        
        var region2 = region.split("|");
        region2 = region2[1];
        
        var area2 = area.split("|");
        area2 = area2[1];
        
        var dt2 = dt.split("|");
        dt2 = dt2[1];
        //if(area!='0' || dt!='0' || state !='0' || region!='0'){
            //alert(state+" "+region2+" "+area2+" "+dt2);
            $(".loaderphil").show();
            $.post("<?php echo base_url("providers/getprovider_dentist");?>",{state:state,region:region2,province:area2,district:dt2},function(data){
				
                $(".loadcontent").html(data);
		$(".loaderphil").hide();
            });
	//}else{                    
        //    alert("Please Provide Required Fields");
	//}
		
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
	
	
        $("#state").change(function(){
            $(".lloading").text("Loading....");
                
            $.post("<?php echo base_url("providers/getRegion");?>",
                
		{state:$(this).val()},function(data){
                   
                    $("#dregion").html(data);
                    
                  
                    $(".lloading").text('done');
            });		
	});
        
        $("#dregion").change(function(){
            $(".lloading").text("Loading....");
                
            $.post("<?php echo base_url("providers/getProvince");?>",
                
		{region:$(this).val()},function(data){
                   
                    $("#area_name").html(data);
                    //alert($("#dregion").val());
                  
                    $(".lloading").text('done');
            });		
	});
        
        $("#area_name").change(function(){
            $(".lloading").text("Loading....");
                
            $.post("<?php echo base_url("providers/getDistrict");?>",
                
		{province:$(this).val()},function(data){
                   
                    $("#district").html(data);
                   
                    $(".lloading").text('done');
            });		
	});
       
       
        
});

</script>