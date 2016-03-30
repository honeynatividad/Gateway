<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Wellness Buddies</div>
        </div>
        <div class="panel-body">

            <!-- start articles -->
                <div id="relatedarticle" style="padding-top: 8px;">
                      <div class="row">      
                              <div class="col-sm-6 col-md-4">
                                <div class="thumbnail_article">
                                  <img src="<?php echo base_url("resources");?>/img/article1.jpg" alt="...">
                                  <div class="phil-overlay"></div>
                                  <div class="caption">
                                    <h3>Lorem ipsum dolor sit amet</h3>
                                  </div>
                                  <div class="readmore phil-green">
                                  <i class="glyphicon glyphicon-circle-arrow-right"></i>
                                  <span>Read More</span>
                                  </div>
                                  
                                </div>
                              </div>       
                
                              <div class="col-sm-6 col-md-4">
                                <div class="thumbnail_article">
                                  <img src="<?php echo base_url("resources");?>/img/article2.jpg" alt="...">
                                  <div class="phil-overlay"></div>
                                  <div class="caption">
                                    <h3>Lorem ipsum dolor sit amet</h3>
                                  </div>
                                  <div class="readmore phil-yellow">
                                  <i class="glyphicon glyphicon-circle-arrow-right"></i>
                                  <span>Read More</span>
                                  </div>
                                  
                                </div>
                              </div> 
                              
                                
                              
                              <div class="col-sm-6 col-md-4">
                                <div class="thumbnail_article">
                                  <img src="<?php echo base_url("resources");?>/img/article3.jpg" alt="...">
                                  <div class="phil-overlay"></div>
                                  <div class="caption">
                                    <h3>Lorem ipsum dolor sit amet</h3>
                                  </div>
                                  <div class="readmore phil-orange">
                                  <i class="glyphicon glyphicon-circle-arrow-right"></i>
                                  <span>Read More</span>
                                  </div>
                                  
                                </div>
                              </div>  
 
 
                               <div class="col-sm-6 col-md-4">
                                <div class="thumbnail_article">
                                  <img src="<?php echo base_url("resources");?>/img/article3.jpg" alt="...">
                                  <div class="phil-overlay"></div>
                                  <div class="caption">
                                    <h3>Lorem ipsum dolor sit amet</h3>
                                  </div>
                                  <div class="readmore phil-orange">
                                  <i class="glyphicon glyphicon-circle-arrow-right"></i>
                                  <span>Read More</span>
                                  </div>
                                  
                                </div>
                              </div>                
                              
  
                               <div class="col-sm-6 col-md-4">
                                <div class="thumbnail_article">
                                  <img src="<?php echo base_url("resources");?>/img/article3.jpg" alt="...">
                                  <div class="phil-overlay"></div>
                                  <div class="caption">
                                    <h3>Lorem ipsum dolor sit amet</h3>
                                  </div>
                                  <div class="readmore phil-orange">
                                  <i class="glyphicon glyphicon-circle-arrow-right"></i>
                                  <span>Read More</span>
                                  </div>
                                  
                                </div>
                              </div>  
                              




                              <div class="col-sm-6 col-md-4">
                                <div class="thumbnail_article">
                                  <img src="<?php echo base_url("resources");?>/img/article3.jpg" alt="...">
                                  <div class="phil-overlay"></div>
                                  <div class="caption">
                                    <h3>Lorem ipsum dolor sit amet</h3>
                                  </div>
                                  <div class="readmore phil-orange">
                                  <i class="glyphicon glyphicon-circle-arrow-right"></i>
                                  <span>Read More</span>
                                  </div>
                                  
                                </div>
                              </div> 


                                           
                          </div>
                </div>   
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

			}else if(thisData==2){
				
				$(this).attr('data-checkbox',1);
				$("#left-switch").css('color','#cecfd1');
				$("#right-switch").css('color','#168246');
			}

	});
	getloadcurrent();
});


function getloadcurrent(){
	$("#relatedarticle").html('<div class="loaderphil" id="thisanchor"><div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div></div>');
	$(".loaderphil").show();	
	$("#relatedarticle").load("<?php echo base_url("wellness/loadwellness");?>",function(){
		
	});	
	
}
</script>
<style>
.articleimge > img {
    max-height: 178px;
    overflow: hidden;
}
.thumbnail_article > img {
    height: 173px;
}
.thumbnail_article .caption > h3 {
    font-size: 15px !important;
}
</style>