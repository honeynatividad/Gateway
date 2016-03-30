

<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    <?php 
            if($this->session->flashdata('upload_ok')){
                
            
        ?>
        <div class="alert alert-danger">
            <strong>Warning! </strong><?php echo $warning ?>.
        </div>
            <?php } ?>
    <div class="panel panel-philcare">
        
        <div class="panel-heading">
            <div class="pull-right main-title">News Feed</div>
        </div>
        <div class="panel-body">
            <div class="row">
                
                <div class="col-md-6">
                    <span class="label badge-feed-green">Watch Video</span>                    
                    <?php foreach($videos as $video): ?>
                    <div class="col-md-12">                        
                        <a href="<?php echo $video->file_name ?>" target="_blank"  ><?php echo $video->title ?></a>
                    </div>
                    <?php endforeach; ?>
                    
                    
                </div>
                <div class="col-md-6">
                    <span class="label badge-feed-green">Guide Book</span>
                    <?php foreach($guidebooks as $guidebook): ?>
                    <div class="col-md-12">
                        <a href="pdf_server.php?file=<?php echo $guidebook->file_name ?>">Download Pdf file for guide book</a>
                    </div>
                    <?php endforeach; ?>
                    
                </div>
            </div>
            <div class="row">&nbsp;</div>
            
            <div class="row">
                <div class="col-md-8">
                    <span class="label badge-feed-green">Latest News</span>
					<!--<span class="label badge-feed-yellow">Philcare Advisory</span>
					<span class="label badge-feed-orange">Products</span>-->
					<!--<span class="label badge-feed-red">Wellness Buddies</span>-->	
                </div>
                <div class="col-md-4">
                    <div class="feed-sp-button">
                        
                        <?php 
                        $session_data = $this->session->userdata('logged_in');
                        $agreement = $this->model_portal_pages->getAgreementNo($session_data['agreement_no']);
                        if(isset($agreement->agreement_name)){
                        ?>
                        <span class="label badge-feed-green2" id="left-switch" title="List View">
                        <?php
                            echo $agreement->agreement_name;
                        ?>
                        </span>
                        <?php
                        }
                        ?>
                           
               	   <!-- <input type="checkbox" value="1" name="my-checkbox" data-checkbox="2" class="feedchange"> -->
                	<span class="label badge-feed-light " id="right-switch" title="Grid View">PhilCare</span>
                    </div>     
                </div>
            </div>
            
            <!--start video 
            added bv; hanna
            -->
             <?php 
                        if(isset($agreement->agreement_name)){
                        ?>
                  
                        
                        <?php
                        }else{
                    ?>
            <div id="articlereplace2" >


            </div>
            
            <?php
                        }
                        ?>
            <div id="articlereplace" >


            </div>
    </div>               
    
    
</div>	

<script>
$(document).ready(function(){
    $("#close").on('click', function(){
        stopVideo();
    });
    $('.thumbnail').click(function(){
  	$('.modal-body').empty();
  	var title = $(this).parent('a').attr("title");
  	$('.modal-title').html(title);
  	$($(this).parents('div').html()).appendTo('.modal-body');
  	$('#myModal').modal({show:true});
});
    var video = document.getElementById("videoModal");
     function stopVideo(){
          video.pause();
          video.currentTime = 0;
     }
     
    autoPlayYouTubeModal();
	$(".feedchange").bootstrapSwitch();

	$('.feedchange').on('switchChange.bootstrapSwitch', function (event, state) {
		var thisData = $(this).attr('data-checkbox');
		 	if(thisData==1){
                            alert(1);
				
				$(this).attr('data-checkbox',2);
				$("#left-switch").css({'color':'#168246','line-height': '1','background-color': '#45b29d','font-size':'13px','border-radius':'5px','padding':'5px 16px'});
				$("#right-switch").css('color','#cecfd1');
				getloadcurrent();
			}else if(thisData==2){
				
				$(this).attr('data-checkbox',1);
				$("#left-switch").css('color','#fff');
				$("#right-switch").css({'color':'#fff','line-height': '1','background-color': '#45b29d','font-size':'13px','border-radius':'5px','padding':'5px 16px'});
				
				$("#articlereplace").html('<div class="loaderphil" id="thisanchor"><div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div></div>');
				$(".loaderphil").show();
				$("#articlereplace").load("<?php echo base_url("home/news_all");?>",function(){
					
				});
				
			}
	});
	
	//new switching method
	
	$("#left-switch").click(function(){
				
		///$(this).attr('data-checkbox',2);
		$("#left-switch").css({'color':'#fff','line-height': '1','background-color': '#45b29d','font-size':'13px','border-radius':'5px','padding':'5px 16px'});
		$("#right-switch").css({'background-color':'#bbc3bf','color':'#fff'});
		getloadcurrent();		
	});
	
	
	$("#right-switch").click(function(){
		//$(this).attr('data-checkbox',1);
		$("#left-switch").css({'background-color':'#bbc3bf','color':'#fff'});
		$("#right-switch").css({'color':'#fff','line-height': '1','background-color': '#45b29d','font-size':'13px','border-radius':'5px','padding':'5px 16px'});
		
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
	$("#articlereplace").load("<?php echo base_url("home/news_all");?>",function(){
		
	});	
	
}

function autoPlayYouTubeModal(){
    jQuery('#videoModal').on('hidden.bs.modal', function (e) {
  // do something...
    jQuery('#videoModal video').attr("src", jQuery("#videoModal  video").attr("src"));
    });

  var trigger = $("body").find('[data-toggle="modal"]');
  trigger.click(function() {
    var theModal = $(this).data( "target" ),
    videoSRC = $(this).attr( "data-theVideo" ), 
    videoSRCauto = videoSRC+"?autoplay=0" ;
    $(theModal+' iframe').attr('src', videoSRCauto);
    $(theModal+' button.close').click(function () {
        $(theModal+' iframe').attr('src', videoSRC);
    });   
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
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" id="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div>
          <iframe width="100%" height="450" allowfullscreen="" src=""></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<!-- Bootstrap JS is not required, but included for the responsive demo navigation and button states -->
<!--<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>-->
<!--<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script> -->
<script src="<?php echo base_url('resources/') ?>js/bootstrap-image-gallery.js"></script>
<script src="<?php echo base_url('resources/') ?>js/demo.js"></script>