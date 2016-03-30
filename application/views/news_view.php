<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">News Feed</div>
        </div>
        <div class="panel-body">
           
            
            <!--start video 
            added bv; hanna
            -->
            <div class='newsfeedlist'>
                <?php 
                $break = ".";
                $pad = "...";
                $limit = 50;
                foreach($newsfeed as $news){
                ?>
                
                
                    
                    <div class="col-md-12">
                        <h4 class=""><?php echo $news->title; ?></h4>
                        <p> <?php 
                            $text = $news->description;
                    
                            
                                echo $text;
                            
                            ?>
                        </p>
                        
                    </div>
                
                
               
                <?php } ?>
                
               
                
            </div>
            <!-- start articles -->
            
    		<!-- end articles -->
        </div>
    </div>               
    
    
</div>	
          
<script>
$(document).ready(function(){
	$(".feedchange").bootstrapSwitch();

	$('.feedchange').on('switchChange.bootstrapSwitch', function (event, state) {
		var thisData = $(this).attr('data-checkbox');
		 	if(thisData==1){
				
				$(this).attr('data-checkbox',2);
				$("#left-switch").css('color','#168246');
				$("#right-switch").css('color','#cecfd1');
				getloadcurrent();
			}else if(thisData==2){
				
				$(this).attr('data-checkbox',1);
				$("#left-switch").css('color','#cecfd1');
				$("#right-switch").css('color','#168246');
				
				$("#articlereplace").html('<div class="loaderphil" id="thisanchor"><div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div></div>');
				$(".loaderphil").show();
				$("#articlereplace").load("<?php echo base_url("home/tilefeed");?>",function(){
					
				});
				
			}
	});
	
	//new switching method
	
	$("#left-switch").click(function(){
				
		///$(this).attr('data-checkbox',2);
		$("#left-switch").css('color','#168246');
		$("#right-switch").css('color','#cecfd1');
		getloadcurrent();		
	});
	
	
	$("#right-switch").click(function(){
		//$(this).attr('data-checkbox',1);
		$("#left-switch").css('color','#cecfd1');
		$("#right-switch").css('color','#168246');
		
		$("#articlereplace").html('<div class="loaderphil" id="thisanchor"><div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div></div>');
		$(".loaderphil").show();
		$("#articlereplace").load("<?php echo base_url("home/tilefeed");?>",function(){
			
		});		
	});	
	
	
	
	getloadcurrent();
});
function getloadcurrent(){
	$("#articlereplace").html('<div class="loaderphil" id="thisanchor"><div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div></div>');
	$(".loaderphil").show();	
	$("#articlereplace").load("<?php echo base_url("home/listfeed");?>",function(){
		
	});	
	
}
</script>
<style>
.articleimge > img {
    /*max-height: 178px;*/
    overflow: hidden;
}
.thumbnail_article > img {
   /* height: 173px;*/
	width:100%;
}
.thumbnail_article .caption > h3 {
    font-size: 15px !important;
}
#left-switch{
	cursor:pointer;	
}
#right-switch{
	cursor:pointer;	
}
</style>