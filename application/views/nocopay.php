<div class="col-md-9">
    
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
            <div class="pull-right main-title">NoCopay Hospital/Clinic</div>
        </div>
        
        <div class="panel-body">
            
            <p><a class="btn btn-primary" href="<?php echo base_url('resources') ?>/nocopay.pdf">Download PDF</a> </p>
            
            <div class="table-responsive">
            <table class="table" style="font-size:12px" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th width = "10%">PROVIDER NAME</th>
                    <th width = "20%">STREET</th>
                    <th width = "20%">TOWN/BRGY</th>
                    <th width = "30%">AREA</th>
                    <th width = "10%">TEL</th>
                    <th width = "10%">EMAIL</th>
                </tr>

            <?php foreach($csvData as $field){?>
                <tr>
                    <td><?php echo $field['ProviderName']?></td>
                    <td><?php echo $field['Street']?></td>
                    <td><?php echo $field['TownBrgy']?></td>
                    <td><?php echo $field['Area']?></td>
                    <td><?php echo $field['Telephone']?></td>
                    <td><?php echo $field['Email']?></td>
                </tr>
            <?php }?>
</table>
            </div>
        </div>

        
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
        var loc=$("#loc_name").val();
	var area=$("#area_name").val();
	var type=$("#availm").val();
	var dt=$("#districtvalue").val();
        var certno = $("#certno").val();
	if(type!='0'){
            //alert(loc+area+type+dt);
            $(".loaderphil").show();
            $.post("<?php echo base_url("providers/getprovider");?>",{loc_name:loc,area_name:area,district:dt,dtype:type,certno:certno},function(data){
				
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
                
            $.post("<?php echo base_url("providers/copay_district");?>",
                
		{province:$(this).val()},function(data){
                   
                    $("#districtvalue").html(data);
                   
                    $(".lloading").text('done');
            });		
	});
       
       
        
});

</script>