<div class="col-md-9">
  
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">News Feed</div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <!--
                    <div class="embed-responsive embed-responsive-16by9">
                        <?php
                       // foreach($get_video as $video){
                        ?>
                        <iframe class="embed-responsive-item" src="//<?php //echo $video->title ?>"></iframe>
                        <?php
                     //   }
                        ?>
                        
                    </div>
                    !-->
                </div>
            </div>
            <div class="row">&nbsp;</div>
            <div class="row">
                <div class="col-md-8">
                    <span class="label badge-feed-green">Latest News</span>					
                </div>
                
                <div class="col-md-4">
                    <div class="feed-sp-button">
                        <span class="glyphicon glyphicon-th-list" id="left-switch" title="List View"></span>
               	   <!-- <input type="checkbox" value="1" name="my-checkbox" data-checkbox="2" class="feedchange"> -->
                	<span class="glyphicon glyphicon-th-large" id="right-switch" title="Grid View"></span>
                    </div>     
                </div>
            </div>
            
            <div class="row">
                <div id="newsfeedlist" class="newsfeedlistclass">
                    <div class="table-responsive">
                        <table class="table">
                            <th>Title</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Action</th>
                            <?php 
                            $break = ".";
                            $pad = "...";
                            $limit = 50;
                            $newsfeed = $this->model_portal_admin->getallNews();
                            foreach($get_news as $news){
                            ?>
                            <tr>
                                <td>
                                    <a class="articleimge" href="<?php echo base_url("home/news/".$news->news_id);?>">
                                        <?php echo $news->title; ?>
                                    </a>
                                </td>
                                <td>
                                    <p>
                                        <?php 
                                        $text = $news->description;

                                        if(strlen($text) <= $limit){
                                            echo strip_tags($text);
                                        }else if(false !== ($breakpoint = strpos($text, $break, $limit))) {
                                            if($breakpoint < strlen($text) - 1) {
                                                $text = substr($text, 0, $breakpoint) . $pad;
                                            }
                                            echo strip_tags($text);
                                        }
                                        ?>
                                    </p>
                                    <a href="<?php echo base_url("home/news/".$news->news_id);?>" class="art-readmore">
                                    <i class="glyphicon glyphicon-circle-arrow-right"></i>
                                    <span>Read More</span>
                                </td>
                                <td>
                                    <?php
                                    if($news->status==1){
                                        echo 'Active';
                                    }else{
                                        echo 'Not Active';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($news->status==1){
                                    ?>
                                    <a class="btn btn-danger" href="<?php echo base_url("news/deactivate/".$news->news_id); ?>">Deactivate</a>
                                    <?php
                                    }else{
                                    ?>
                                    <a class="btn btn-primary" href="<?php echo base_url("news/activate/".$news->news_id); ?>">Activate</a>
                                    <?php
                                    }
                                    ?>
                                    <a class="btn btn-success" href="<?php echo base_url("news/edit/".$news->news_id); ?>">Edit</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                            
                        </table>
                    </div>
                </div>
            </div>
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