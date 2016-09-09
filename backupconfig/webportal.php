<?php
require_once("wp-blog-header.php");


$thumb_args = array(
	'cat' => '9,2,8,5',
	'posts_per_page'=>12,
	'orderby'=>'date',
	'order'=>'DESC'
);



$list_args = array(
	'cat' => '9,2,8,5',
	'posts_per_page'=>4,
	'orderby'=>'date',
	'order'=>'DESC'
);

$wellness = array(
	'cat' =>'9,2', 
	'posts_per_page'=>12,
	'orderby'=>'date',
	'order'=>'DESC'
);

$login = array(
	'cat' =>'9,2,8,5',
	'posts_per_page'=>4,
	'orderby'=>'date',
	'order'=>'DESC'
);

if(isset($_REQUEST['type'])){
if($_REQUEST['type']=='list'){
?>
 <div id="newsfeedlist" class="newsfeedlistclass">
<?php
$the_query = new WP_Query( $list_args );
$lccount = 1;
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		
//var_dump($the_query);
?>  
    
 <?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($the_query->post->ID) ); ?>
 

                <div class="row <?php if($lccount<4){echo "phildivider";}?>" id="<?php //echo $lccount;?>">
                    <div class="col-xs-12 col-sm-4 col-md-4"> 
                    <a class="articleimge" href="#">
                    <img src="<?php echo $feat_image;?>">
                    </a>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8">
                    <h4 class=""><?php echo get_the_title();?></h4>
                    <p>	  <?php 
	  $extStr = (strlen(get_the_content())>270)?"...":"";
	  echo  strip_tags (substr(get_the_content(),0,270).$extStr); 
	  ?></p>                           
                    
                    <a href="<?php echo get_permalink($the_query->post->ID);?>" class="art-readmore" target="_blank">
                   	 <i class="glyphicon glyphicon-circle-arrow-right"></i>
                 	 <span>Read More</span>                   
                    </a>
                    </div>
                </div>
				
 <?php $lccount++;}?>
</div>
<?php }elseif($_REQUEST['type']=='thumb'){?>




<div id="relatedarticle" style="padding-top: 30px;">
  <div class="row"> 
<?php
$the_query = new WP_Query( $thumb_args );
$rthc = 1;
	while ( $the_query->have_posts() ) {
		$the_query->the_post();

?>

		<?php
		if($rthc==1 || $rthc==5 || $rthc==8 ||  $rthc==10){
			$colorrelated='phil-green';
		}elseif($rthc==2 || $rthc==4 || $rthc==9 || $rthc==11){
			$colorrelated='phil-yellow';
		}elseif($rthc==3 || $rthc==6 || $rthc==7 || $rthc==12){
			$colorrelated='phil-orange';
		}else{
			$colorrelated='phil-yellow';
		}
		?>
 <?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($the_query->post->ID) ); ?>
         
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="thumbnail_article">
                  <img src="<?php echo $feat_image;?>" alt="<?php echo $rthc;?>">
                  <div class="phil-overlay"></div>
                  <div class="caption">
                   <!-- <h3>
					<?php 
					  //$title = (strlen(get_the_title())>22)?"...":"";
				    //echo  substr(get_the_title(),0,22).$title; 
					echo get_the_title();
					?>
					</h3>-->
                  </div>
                  <a class="readmore <?php echo $colorrelated;?>" href="<?php echo get_permalink($the_query->post->ID);?>" target="_blank">
                <!--  <i class="glyphicon glyphicon-circle-arrow-right"></i>
                  <span>Read More</span>-->
				                  
					<?php 
					  //$title = (strlen(get_the_title())>22)?"...":"";
				    //echo  substr(get_the_title(),0,22).$title; 
					echo get_the_title();
					?>
                  </a>
                  
                </div>
              </div> 
		
	<?php 
	$rthc++;
	}?>	
</div>	  	
</div>			  
<?php }elseif($_REQUEST['type']=='wellness'){?>

<div id="relatedarticle" style="padding-top: 30px;">
  <div class="row">     
 <?php
$the_query = new WP_Query( $wellness );
$rthc = 1;
	while ( $the_query->have_posts() ) {
		$the_query->the_post();

?>
      <?php
		if($rthc==1 || $rthc==5 || $rthc==8 ||  $rthc==10){
			$colorrelated='phil-green';
		}elseif($rthc==2 || $rthc==4 || $rthc==9 || $rthc==11){
			$colorrelated='phil-yellow';
		}elseif($rthc==3 || $rthc==6 || $rthc==7 || $rthc==12){
			$colorrelated='phil-orange';
		}else{
			$colorrelated='phil-yellow';
		}
		?>
 <?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($the_query->post->ID) ); ?>
 
			  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="thumbnail_article">
				   <img src="<?php echo $feat_image;?>" alt="">
				  <div class="phil-overlay"></div>
                  <div class="caption">
					<h3>
						<?php 
					  //$title = (strlen(get_the_title())>22)?"...":"";
				    //echo  substr(get_the_title(),0,22).$title; 
					echo get_the_title();
					?>				
					</h3>
				  </div>
                                  <a class="readmore <?php echo $colorrelated;?>" href="<?php echo get_permalink($the_query->post->ID);?>" target="_blank">
                <!--  <i class="glyphicon glyphicon-circle-arrow-right"></i>
                  <span>Read More</span>-->
				                  
					<?php 
					  //$title = (strlen(get_the_title())>22)?"...":"";
				    //echo  substr(get_the_title(),0,22).$title; 
					echo get_the_title();
					?>
                  </a>
				 
				</div>
			  </div>  
			  
		  <?php $rthc++;}?>
		  
</div>
</div>
<?php }elseif($_REQUEST['type']=='related'){?>

 <?php
$the_query = new WP_Query( $login );
$rl=1;
	while ( $the_query->have_posts() ) {
		$the_query->the_post();

?>
 <?php 
  //$feat_image = get_the_post_thumbnail( $the_query->post->ID, 'medium' );
 $feat_image = wp_get_attachment_url( get_post_thumbnail_id($the_query->post->ID) ); 
 ?>
			<?php
			if($rl==1){
				$colorrelated='phil-green';
			}elseif($rl==2){
				$colorrelated='phil-yellow';
			}elseif($rl==3){
				$colorrelated='phil-orange';
			}else{
				$colorrelated='phil-yellow';
			}
			?>


              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="thumbnail_article">
                  <img src="<?php echo $feat_image;?>" alt="">

                  <div class="phil-overlay"></div>
                  <div class="caption">
                    <!--<h3>
						<?php 
					  //$title = (strlen(get_the_title())>22)?"...":"";
				    //echo  substr(get_the_title(),0,22).$title; 
					echo get_the_title();
					?>	
					</h3>-->
                  </div>
                  <a class="readmore <?php echo $colorrelated;?>" href="<?php echo get_permalink($the_query->post->ID);?>" target="_blank">
                  <!--<i class="glyphicon glyphicon-circle-arrow-right"></i>
                  <span>Read More</span>-->
						<?php 
					  //$title = (strlen(get_the_title())>22)?"...":"";
				    //echo  substr(get_the_title(),0,22).$title; 
					echo get_the_title();
					?>					  
                  </a>
                  
                </div>
              </div> 

			<?php $rl++;}?>



<?php }?>











<?php }?>			  