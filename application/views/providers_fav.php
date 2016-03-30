<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">My Providers</div>
        </div>
        <div class="panel-body">
			<div style="margin-top: -15px;">
            <!-- start articles -->
          <div class="loaderphil" id="thisanchor">
          	<div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div>
          </div>          
          <div class="row gmap"></div>
          <div class="loadcontent"></div> 
		  <?php
		  $pcount = count($plist);
		  if($pcount<1){
			  echo '<div class=""><p><br>"You have not yet nominated a favorite provider."</p></div>';
		  }
		  ?>
		  
          <?php foreach($plist as $pl){?>  
          <div class="row">  
          <div class="col-md-12 mfinder" id="main<?php echo $pl->prov_code;?>">
              <div class="col-sm-12 col-md-8 getmap" id="<?php echo $pl->prov_code;?>">
                <h4 class="media-heading"><?php echo $pl->prov_name;?></h4>
                <div>Coordinator: <?php echo $pl->prov_coordinator;?></div>
                <div>Address: <?php echo $pl->prov_address;?></div>
                <div>Contact No: <?php echo $pl->prov_contact;?></div>
              </div>
              <div class="col-xs-12 col-md-4">
              <a href="#" class="pull-right delfromfav" id="btbutton<?php echo $pl->prov_code;?>"  val-id="<?php echo $pl->prov_code;?>">
                <label class="btn btn-remove-fav">REMOVE TO MY FAVORITES <i class="glyphicon glyphicon-trash"></i></label>
              </a>
                  <input type="hidden" id="Latitude<?php echo $pl->prov_code;?>" value="<?php echo $pl->prov_lat;?>">
                  <input type="hidden" id="Longitude<?php echo $pl->prov_code;?>" value="<?php echo $pl->prov_long;?>">
              </div>
            </div>           
            </div> 
            <?php }?>
            
            
    		<!-- end articles -->
            </div>
        </div>
    </div>               
    
    
</div>		
<script>
$(document).ready(function(){
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
	
	$("body").on("click",".delfromfav",function(){
		var thisId = $(this).attr("val-id");
		if(confirm("Are you sure?")){
			$.post("<?php echo base_url("providers/delpfav");?>",{code:thisId},function(data){
				location.href="<?php echo base_url("providers");?>";		
			});
		}
	});	
	
});
</script>