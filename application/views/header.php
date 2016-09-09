<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PhilCare Gateway</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("resources");?>/css/bootstrap.css" rel="stylesheet">
    <link type="image/x-icon" href="<?php echo base_url("resources") ?>/img/phil_fav.png" rel="shortcut icon">
    <!-- Custom CSS -->
    
    <link href="css/4-col-portfolio.css" rel="stylesheet">
    <link href="<?php echo base_url("resources");?>/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url("resources");?>/css/switch.css" rel="stylesheet">
    <link href="<?php echo base_url("resources");?>/css/calendar.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("resources");?>/css/easydropdown.metro.css" rel="stylesheet" />
    <script src="<?php echo base_url("resources");?>/js/jquery.js"></script>
    <script src="<?php echo base_url("resources");?>/js/bootstrap.min.js"></script>
   
    
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url("resources/ck/ckeditor.js");?>"></script>
    <script src="<?php echo base_url("resources/ck/style.js");?>"></script>
    <script src="<?php echo base_url("resources");?>/js/jquery.easydropdown.js"></script>
    <script>
	$(document).ready(function(){
            $(".main-back").click(function(){
                location.href="<?php echo base_url("login");?>";
            });
            $("#selectall").click(function(){

                if(this.checked){
                        $(".coloring").addClass("click");
                }else{
                        $(".coloring").removeClass("click");
                }			
                $('.checkitem').prop('checked', this.checked); 
            });
	});
	</script> 
        
</head>

<body>

<?php 

$session_data = $this->session->userdata('logged_in');
//print_r($session_data);
$sess_pages = $this->session->userdata('pages');
//print_r($session_data);
if($session_data['level']==1){    
    $pages = $this->model_portal_pages->getAllAdminPages();
    $uinfo = $this->model_portal_pages->getUserById($session_data['user_id']);
}else if($session_data['level']==2){    
    $pages = $this->model_portal_pages->getAllSubAdminPages();    
    $uinfo = $this->model_portal_pages->getUserById($session_data['user_id']);
}else{    
    $pages = $this->model_portal_pages->getAllParentPages();
    $agreement = $this->model_portal_pages->getAgreementNo($session_data['agreement_no']);
    
    if($agreement){
        $logo_img = $agreement->image_url;
    }else{
        $logo_img = 'none';
    }

    $udetails =$this->wslibrary->getMembersInfo($session_data['user_id']);
}


//$udetails = $this->model_portal_users->getUserDetails($uinfo->user_id);

?>	
    <!-- Navigation -->
    <!--<nav class="navbar navbar-default navbar-fixed-top" role="navigation"-->
    <nav class="navbar navbar-default" role="navigation">
	<div class="top-head"></div>
    
	<div class="top-bar visible-xs">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="top-number">
                            <p>
                       <!--<i class="fa fa-phone-square"></i> jayrabang -->
                            </p>
                        </div>
                        <ul class="social-share">
                            <li>
                                 <a href="https://www.facebook.com/philcareph" data-toggle="tooltip" data-placement="bottom" title="Facebook">
                                <img src="<?php echo base_url('resources/img/fb.png');?>"></a>
                             </li>
                             <li>
                                <a href="https://twitter.com/philcareph" data-toggle="tooltip" data-placement="bottom" title="Twitter">
                                <img src="<?php echo base_url('resources/img/tweet.png');?>"></a>
                             </li>
                             <li>
                                <a href="http://www.youtube.com/philcareph" data-toggle="tooltip" data-placement="bottom" title="Youtube">
                                <img src="<?php echo base_url('resources/img/yt.png');?>"></a>
                             </li>
                             <li>
                                <a href="http://instagram.com/philcareph" data-toggle="tooltip" data-placement="bottom" title="Instagram">
                                <img src="<?php echo base_url('resources/img/insta.png');?>"></a>
                             </li> 
                        </ul>                        
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="social">
                            <ul class="head-mb-user ">
                                <li><a href="#"><?php echo $session_data['name'];?> </a></li> 
                                <li>
                                    <a href="#">
                                    <?php if(!empty($uinfo->image)){?>
                                    <img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("upload/profile/".$uinfo->image);?>" data-holder-rendered="true">
                                    <?php }else{
                                        $target_dir = dirname($_SERVER["SCRIPT_FILENAME"])."/upload/profile/";                                        
                           
                                        $files = glob($target_dir . $udetails->CertNo . ".jpg");
                                        $count = count($files);
                            
                            if($count > 0) { ?>
                                <?php if($udetails->Sex =='MALE'){?>
                                <img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("upload");?>/profile/<?php echo $udetails->CertNo ?>.jpg" data-holder-rendered="true">
                            <?php }else{?>
                            <img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("upload");?>/profile/<?php echo $udetails->CertNo ?>.jpg" data-holder-rendered="true">
                                <?php }?>
                                        
                            <?php                            
                            }else{
                            ?>
                                <?php if($udetails->Sex =='MALE'){?>
                                <img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("resources");?>/img/dummy_m.png" data-holder-rendered="true">
                                <?php }else{?>
                                <img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("resources");?>/img/dummy_f.png" data-holder-rendered="true">
                                <?php }?>
                            <?php
                            }                                           
                            ?>
                                        
                                    <?php }?>
                                    </a>
                                </li>     
                            </ul>
                            <!--<div class="search">
                                <form role="form">
                                    <input type="text" placeholder="Search" autocomplete="off" class="search-form">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>-->
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div>
        
       <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#philcollapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url('home');?>">
                    <img src="<?php echo base_url("resources");?>/img/philcare_logo_small.png">
                </a>
                <?php
                
                    if($session_data['level']==3 ){
                        if($logo_img!='none'){
                            if($agreement->agreement_no=='PC00400'){
                                //will not show PC00400 Logo
                            }else{
                           
                ?>
                
                <a class="navbar-brand" href="<?php echo base_url('home');?>">
                    <img src="<?php echo base_url($agreement->image_url);?> " >
                </a>
                    <?php }}} ?>
                
            </div>
           
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="philcollapse">
                <ul class="nav navbar-nav visible-xs">
                    <li class="dropdown">
                    	<a href="" data-toggle="dropdown" class="dropdown-toggle">
                            My Profile <i class="glyphicon glyphicon-chevron-right"></i>
                        </a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="#" class="changephoto">Change Photo</a><li>
                            <li><a href="#" class="changepass">Change Password</a><li> 
                        </ul>
                    </li>
                    <?php foreach($pages as $page){ 
                        
                        if($page->page_id == 1){
                            $check = $this->model_portal_pages->checkNewsfeedModule($session_data['agreement_no']);
                            if($check==1){
                                        //echo "Newsfeed";
                    ?>
                    <li class="<?php if($sess_pages['page_id']==$page->page_id){echo 'active';}?> <?php if($page->has_sub==1){echo 'dropdown';}?>">
                        <a href="<?php echo base_url($page->page_url);?>" <?php if($page->has_sub==1){echo 'data-toggle="dropdown" class="dropdown-toggle"';}?>>
				            <?php echo $page->page_name;?>
							<!--<span class="badge badge-orange">14</span>-->
                            
                            <?php if($page->has_sub==1){echo '<i class="glyphicon glyphicon-chevron-right"></i>';}?>
                            <?php if($page->page_id==3){?>
                                <?php if($page->msg_totals>0){?>
                                    <span class="badge badge-orange"><?php echo $page->msg_totals;?></span>
                                <?php }?>
                            <?php }?>                             
				        </a>
							
                            <?php if($page->has_sub==1){?>
                            	<ul role="menu" class="dropdown-menu dd-menu">
                                <?php 
                                    if($session_data['level']==2){
                                        $subs = $this->model_portal_pages->getAllSubAdminPagesById($page->page_id);                                    
                                    }else {
                                        $subs = $this->model_portal_pages->getAllSubPagesById($page->page_id);
                                    }
                                    foreach($subs as $sub){?>
                                    <li>
                                    	<?php if($sub->page_id==18){ ?>
                                    	<a href="#" class="myappointclick"><?php echo $sub->page_name;?></a>
                                   	<?php }else{
                                            if($session_data['level']==1){
                                                if($sub->page_level==2){
                                                    
                                                }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php }}?>
                                    </li>
                                    <?php }?>
                            	</ul>
                            <?php }?>
                            
                            </li>
                                    <?php
                                    }
                                }elseif($page->page_id == 36){
                                    $check = $this->model_portal_pages->checkProviderModule($session_data['agreement_no']);
                                    if($check==1){
                                        //echo "Provider";
                                ?>
                            <li class="<?php if($sess_pages['page_id']==$page->page_id){echo 'active';}?> <?php if($page->has_sub==1){echo 'dropdown';}?>">
                                <a href="<?php echo base_url($page->page_url);?>" <?php if($page->has_sub==1){echo 'data-toggle="dropdown" class="dropdown-toggle"';}?>>
				                <?php echo $page->page_name;?>
							<!--<span class="badge badge-orange">14</span>-->
                            
                                <?php if($page->has_sub==1){echo '<i class="glyphicon glyphicon-chevron-right"></i>';}?>
                                <?php if($page->page_id==3){?>
                                    <?php if($page->msg_totals>0){?>
                                        <span class="badge badge-orange"><?php echo $page->msg_totals;?></span>
                                    <?php }?>
                                <?php }?>                             
				</a>
							
                            <?php if($page->has_sub==1){?>
                            	<ul role="menu" class="dropdown-menu dd-menu">
                                <?php 
                                    if($session_data['level']==2){
                                        $subs = $this->model_portal_pages->getAllSubAdminPagesById($page->page_id);                                    
                                    }else {
                                        $subs = $this->model_portal_pages->getAllSubPagesById($page->page_id);
                                    }
                                    foreach($subs as $sub){?>
                                    <li>
                                    	<?php if($sub->page_id==18){ ?>
                                    	<a href="#" class="myappointclick"><?php echo $sub->page_name;?></a>
                                   	<?php }else{
                                            if($session_data['level']==1){
                                                if($sub->page_level==2){
                                                    
                                                }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php }}?>
                                    </li>
                                    <?php }?>
                            	</ul>
                            <?php }?>
                            
                            </li>
                                    <?php
                                    }
                                }elseif($page->page_id == 46){
                                    $check = $this->model_portal_pages->checkEcuModule($session_data['agreement_no']);
                                    if($check==1){
                                        //check if membertype== dependent
                                        if($session_data['APEECU']=="APE" || $session_data['APEECU']=="ECU"){
                                        //    print_r('I am a dependent');
                                        
                                        //echo "ECU";
                                    ?>
                            <li class="<?php if($sess_pages['page_id']==$page->page_id){echo 'active';}?> <?php if($page->has_sub==1){echo 'dropdown';}?>">
                                <a href="<?php echo base_url($page->page_url);?>" <?php if($page->has_sub==1){echo 'data-toggle="dropdown" class="dropdown-toggle"';}?>>
				                <?php echo $page->page_name;?>
							<!--<span class="badge badge-orange">14</span>-->
                            
                                <?php if($page->has_sub==1){echo '<i class="glyphicon glyphicon-chevron-right"></i>';}?>
                                <?php if($page->page_id==3){?>
                                    <?php if($page->msg_totals>0){?>
                                        <span class="badge badge-orange"><?php echo $page->msg_totals;?></span>
                                    <?php }?>
                                <?php }?>                             
				</a>
							
                            <?php if($page->has_sub==1){?>
                            	<ul role="menu" class="dropdown-menu dd-menu">
                                <?php 
                                    if($session_data['level']==2){
                                        $subs = $this->model_portal_pages->getAllSubAdminPagesById($page->page_id);                                    
                                    }else {
                                        $subs = $this->model_portal_pages->getAllSubPagesById($page->page_id);
                                    }
                                    foreach($subs as $sub){?>
                                    <li>
                                    	<?php if($sub->page_id==18){ ?>
                                    	<a href="#" class="myappointclick"><?php echo $sub->page_name;?></a>
                                   	<?php }else{
                                            if($session_data['level']==1){
                                                if($sub->page_level==2){
                                                    
                                                }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php }}?>
                                    </li>
                                    <?php }?>
                            	</ul>
                            <?php }?>
                            
                            </li>
                                    <?php
                                    }
                                }
                                }elseif($page->page_id == 47){
                                    $check = $this->model_portal_pages->checkReimbursementModule($session_data['agreement_no']);
                                    if($check==1){
                                        //echo "Reimbursement";
                                    ?>
                            <li class="<?php if($sess_pages['page_id']==$page->page_id){echo 'active';}?> <?php if($page->has_sub==1){echo 'dropdown';}?>">
                                <a href="<?php echo base_url($page->page_url);?>" <?php if($page->has_sub==1){echo 'data-toggle="dropdown" class="dropdown-toggle"';}?>>
				<?php echo $page->page_name;?>
							<!--<span class="badge badge-orange">14</span>-->
                            
                                <?php if($page->has_sub==1){echo '<i class="glyphicon glyphicon-chevron-right"></i>';}?>
                                <?php if($page->page_id==3){?>
                                    <?php if($page->msg_totals>0){?>
                                        <span class="badge badge-orange"><?php echo $page->msg_totals;?></span>
                                    <?php }?>
                                <?php }?>                             
				</a>
							
                            <?php if($page->has_sub==1){?>
                            	<ul role="menu" class="dropdown-menu dd-menu">
                                <?php 
                                    if($session_data['level']==2){
                                        $subs = $this->model_portal_pages->getAllSubAdminPagesById($page->page_id);                                    
                                    }else {
                                        $subs = $this->model_portal_pages->getAllSubPagesById($page->page_id);
                                    }
                                    foreach($subs as $sub){?>
                                    <li>
                                    	<?php if($sub->page_id==18){ ?>
                                    	<a href="#" class="myappointclick"><?php echo $sub->page_name;?></a>
                                   	<?php }else{
                                            if($session_data['level']==1){
                                                if($sub->page_level==2){
                                                    
                                                }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php }}?>
                                    </li>
                                    <?php }?>
                            	</ul>
                            <?php }?>
                            
                            </li>
                                    <?php
                                    }
                                }elseif($page->page_id == 88){
                                    $check = $this->model_portal_pages->checkHRAModule($session_data['agreement_no']);
                                    if($check==1){
                                        //echo "Reimbursement";
                                    ?>
                            <li class="<?php if($sess_pages['page_id']==$page->page_id){echo 'active';}?> <?php if($page->has_sub==1){echo 'dropdown';}?>">
                                <a href="<?php echo base_url($page->page_url);?>" <?php if($page->has_sub==1){echo 'data-toggle="dropdown" class="dropdown-toggle"';}?>>
                <?php echo $page->page_name;?>
                            <!--<span class="badge badge-orange">14</span>-->
                            
                                <?php if($page->has_sub==1){echo '<i class="glyphicon glyphicon-chevron-right"></i>';}?>
                                <?php if($page->page_id==3){?>
                                    <?php if($page->msg_totals>0){?>
                                        <span class="badge badge-orange"><?php echo $page->msg_totals;?></span>
                                    <?php }?>
                                <?php }?>                             
                </a>
                            
                            <?php if($page->has_sub==1){?>
                                <ul role="menu" class="dropdown-menu dd-menu">
                                <?php 
                                    if($session_data['level']==2){
                                        $subs = $this->model_portal_pages->getAllSubAdminPagesById($page->page_id);                                    
                                    }else {
                                        $subs = $this->model_portal_pages->getAllSubPagesById($page->page_id);
                                    }
                                    foreach($subs as $sub){?>
                                    <li>
                                        <?php if($sub->page_id==18){ ?>
                                        <a href="#" class="myappointclick"><?php echo $sub->page_name;?></a>
                                    <?php }else{
                                            if($session_data['level']==1){
                                                if($sub->page_level==2){
                                                    
                                                }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php }}?>
                                    </li>
                                    <?php }?>
                                </ul>
                            <?php }?>
                            
                            </li>
                                    <?php
                                    }
                                }else{
			?>
                    <li class="<?php if($sess_pages['page_id']==$page->page_id){echo 'active';}?> <?php if($page->has_sub==1){echo 'dropdown';}?>">
                        <a href="<?php echo base_url($page->page_url);?>" <?php if($page->has_sub==1){echo 'data-toggle="dropdown" class="dropdown-toggle"';}?>>
                        <?php echo $page->page_name;?>
                        <?php if($page->has_sub==1){echo '<i class="glyphicon glyphicon-chevron-right"></i>';}?>
                        <?php if($page->page_id==3){?>
                            <?php if($page->msg_totals>0){?>
                        	<span class="badge badge-orange"><?php echo $page->msg_totals;?></span>
                            <?php }?>
                        <?php }?>                        
                        </a>
                        <?php if($page->has_sub==1){?>
                            <ul role="menu" class="dropdown-menu">
                                <?php
                                
                                ?>
                            <?php 
                                
                                if($session_data['level']==2){
                                    $subs = $this->model_portal_pages->getAllSubAdminPagesById($page->page_id);                                    
                                }else {
                                    $subs = $this->model_portal_pages->getAllSubPagesById($page->page_id);
                                }
                                
                                foreach($subs as $sub){?>
                                <li>
                                    <?php if($sub->page_id==18){ ?>
                                    <a href="#" class="myappointclick"><?php echo $sub->page_name;?></a>
                                    <?php }else{?>
                                    <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                    <?php }?>
                                </li>
                                <?php }?>
                                <?php if($page->page_id==2){?><!--
                                	 <li><a href="#" class="changephoto">Change Photo</a><li>
                        			 <li><a href="#" class="changepass">Change Password</a><li> -->                        
                                <?php }?>
                                
                            </ul>
                        <?php }}?>                        
                        
                    </li>
                    <?php }?>
                    <li>
                        <a href="<?php echo base_url("home/logout");?>">
                            Logout
                        </a>
                    </li>                   
                </ul>
                <ul class="nav navbar-nav navbar-right hidden-xs">
                
                    <li class="headname">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome!  
                            <span  class="badge badge-green"><?php echo $session_data['name'];?></span> <span class="caret  hidden-xs"></span>
                        </a>
                        <ul class="dropdown-menu  hidden-xs" role="menu">
                            <li><a href="#" class="changephoto">Change Photo</a><li>
                            <li><a href="#" class="changepass">Change Password</a><li>
                        </ul>                    
                    </li>
                    <li class="headphoto">
                        <a href="#">
                        <?php if(!empty($uinfo->image)){?>
                            <img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("upload/profile/".$uinfo->image);?>" data-holder-rendered="true">
                        <?php }else{ 
                            $target_dir = dirname($_SERVER["SCRIPT_FILENAME"])."/upload/profile/";                                        
                                                       
                            $files = glob($target_dir . $udetails->CertNo . ".jpg");
                            $count = count($files);
                            
                            if($count > 0) {?>
                            <?php if($udetails->Sex =='MALE'){?>
                            <img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("upload");?>/profile/<?php echo $udetails->CertNo ?>.jpg" data-holder-rendered="true">
                            <?php }else{?>
                            <img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("upload");?>/profile/<?php echo $udetails->CertNo ?>.jpg" data-holder-rendered="true">
                            <?php }
                            }else{ ?>
                            <?php if($udetails->Sex =='MALE'){?>
                            <img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("resources");?>/img/dummy_m.png" data-holder-rendered="true">
                            <?php }else{?>
                            <img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("resources");?>/img/dummy_f.png" data-holder-rendered="true">
                            <?php }?>
                        <?php }}?>
                        </a>
                    </li>
		</ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

	<!-- wrapper-->
    <div class="philbody">
    <!-- Page Content -->
        <div class="container" id="philbodymain">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidephil hidden-xs">
                        <div id="philpic">
                        <?php if(!empty($uinfo->image)){
                            ?>
                            <img class="img-circle" style="width: 130px; height: 130px;" src="<?php echo base_url("upload/profile/".$uinfo->image);?>" data-holder-rendered="true">
                        <?php }else{
                            $target_dir = dirname($_SERVER["SCRIPT_FILENAME"])."/upload/profile/";                                        
                            $fileSearch = "God_of_War";
                            
                            //print_r($_SERVER["SCRIPT_FILENAME"]);
                            $files = glob($target_dir . $udetails->CertNo . ".jpg");
                            $count = count($files);
                            
                            if($count > 0) {
                            ?>
                            <?php if($udetails->Sex =='MALE'){?>
                            <img class="img-circle" style="width: 130px; height: 130px;" src="<?php echo base_url("upload");?>/profile/<?php echo $udetails->CertNo ?>.jpg" data-holder-rendered="true">
                            <?php }else{?>
                            <img class="img-circle" style="width: 130px; height: 130px;" src="<?php echo base_url("upload");?>/profile/<?php echo $udetails->CertNo ?>.jpg" data-holder-rendered="true">
                            <?php }?>
                            
                            <?php
                            }else{
                            
                            ?>
                            <?php if($udetails->Sex =='MALE'){?>
                            <img class="img-circle" style="width: 130px; height: 130px;" src="<?php echo base_url("resources");?>/img/dummy_m.png" data-holder-rendered="true">
                            <?php }else{?>
                            <img class="img-circle" style="width: 130px; height: 130px;" src="<?php echo base_url("resources");?>/img/dummy_f.png" data-holder-rendered="true">
                            <?php }?>
                            
                        <?php }}?>
                    
                            <div class="philname"><?php echo $session_data['fullname'];?></div>
			</div>
                        
			<ul class="nav row hidden-xs">
                    
                        <?php 
                        
                            foreach($pages as $page){ 
                                if($page->page_id == 1){
                                    $check = $this->model_portal_pages->checkNewsfeedModule($session_data['agreement_no']);
                                    if($check==1){
                                        //echo "Newsfeed";
                                    ?>
                            <li class="<?php if($sess_pages['page_id']==$page->page_id){echo 'active';}?> <?php if($page->has_sub==1){echo 'dropdown';}?>">
                                <a href="<?php echo base_url($page->page_url);?>" <?php if($page->has_sub==1){echo 'data-toggle="dropdown" class="dropdown-toggle"';}?>>
				<?php echo $page->page_name;?>
							<!--<span class="badge badge-orange">14</span>-->
                            
                                <?php if($page->has_sub==1){echo '<i class="glyphicon glyphicon-chevron-right"></i>';}?>
                                <?php if($page->page_id==3){?>
                                    <?php if($page->msg_totals>0){?>
                                        <span class="badge badge-orange"><?php echo $page->msg_totals;?></span>
                                    <?php }?>
                                <?php }?>                             
				</a>
							
                            <?php if($page->has_sub==1){?>
                            	<ul role="menu" class="dropdown-menu dd-menu">
                                <?php 
                                    if($session_data['level']==2){
                                        $subs = $this->model_portal_pages->getAllSubAdminPagesById($page->page_id);                                    
                                    }else {
                                        $subs = $this->model_portal_pages->getAllSubPagesById($page->page_id);
                                    }
                                    foreach($subs as $sub){?>
                                    <li>
                                    	<?php if($sub->page_id==18){ ?>
                                    	<a href="#" class="myappointclick"><?php echo $sub->page_name;?></a>
                                   	<?php }else{
                                            if($session_data['level']==1){
                                                if($sub->page_level==2){
                                                    
                                                }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php }}?>
                                    </li>
                                    <?php }?>
                            	</ul>
                            <?php }?>
                            
                            </li>
                                    <?php
                                    }
                                }elseif($page->page_id == 36){
                                    $check = $this->model_portal_pages->checkProviderModule($session_data['agreement_no']);
                                    if($check==1){
                                        //echo "Provider";
                                    ?>
                            <li class="<?php if($sess_pages['page_id']==$page->page_id){echo 'active';}?> <?php if($page->has_sub==1){echo 'dropdown';}?>">
                                <a href="<?php echo base_url($page->page_url);?>" <?php if($page->has_sub==1){echo 'data-toggle="dropdown" class="dropdown-toggle"';}?>>
				<?php echo $page->page_name;?>
							<!--<span class="badge badge-orange">14</span>-->
                            
                                <?php if($page->has_sub==1){echo '<i class="glyphicon glyphicon-chevron-right"></i>';}?>
                                <?php if($page->page_id==3){?>
                                    <?php if($page->msg_totals>0){?>
                                        <span class="badge badge-orange"><?php echo $page->msg_totals;?></span>
                                    <?php }?>
                                <?php }?>                             
				</a>
							
                            <?php if($page->has_sub==1){?>
                            	<ul role="menu" class="dropdown-menu dd-menu">
                                <?php 
                                    if($session_data['level']==2){
                                        $subs = $this->model_portal_pages->getAllSubAdminPagesById($page->page_id);                                    
                                    }else {
                                        $subs = $this->model_portal_pages->getAllSubPagesById($page->page_id);
                                    }
                                    foreach($subs as $sub){?>
                                    <li>
                                    	<?php if($sub->page_id==18){ ?>
                                    	<a href="#" class="myappointclick"><?php echo $sub->page_name;?></a>
                                   	<?php }else{
                                            if($session_data['level']==1){
                                                if($sub->page_level==2){
                                                    
                                                }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php
                                                }
                                            }else{
                                                if($sub->page_id==106){
                                                    if($session_data['agreement_no']=='PC10889' || $session_data['agreement_no'] == 'PC10917' || $session_data['agreement_no'] == 'PC10939'){
                                                    ?>
                                                    <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                                    <?php
                                                    }else{
                                                        
                                                    }
                                                }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                                <?php }}}?>
                                    </li>
                                    <?php }?>
                            	</ul>
                            <?php }?>
                            
                            </li>
                                    <?php
                                    }
                                }elseif($page->page_id == 46){
                                    $check = $this->model_portal_pages->checkEcuModule($session_data['agreement_no']);
                                    if($check==1){
                                        //echo "ECU";
                                        
                                        if($session_data['APEECU']=="APE" || $session_data['APEECU']=="ECU"){                                          
                                           //echo "apeecu ". $session_data['APEECU'];
                                    ?>
                            <li class="<?php if($sess_pages['page_id']==$page->page_id){echo 'active';}?> <?php if($page->has_sub==1){echo 'dropdown';}?>">
                                <a href="<?php echo base_url($page->page_url);?>" <?php if($page->has_sub==1){echo 'data-toggle="dropdown" class="dropdown-toggle"';}?>>
				<?php echo $page->page_name;?>
							<!--<span class="badge badge-orange">14</span>-->
                            
                                <?php if($page->has_sub==1){echo '<i class="glyphicon glyphicon-chevron-right"></i>';}?>
                                <?php if($page->page_id==3){?>
                                    <?php if($page->msg_totals>0){?>
                                        <span class="badge badge-orange"><?php echo $page->msg_totals;?></span>
                                    <?php }?>
                                <?php }?>                             
				</a>
							
                            <?php if($page->has_sub==1){?>
                            	<ul role="menu" class="dropdown-menu dd-menu">
                                <?php 
                                    if($session_data['level']==2){
                                        $subs = $this->model_portal_pages->getAllSubAdminPagesById($page->page_id);                                    
                                    }else {
                                        $subs = $this->model_portal_pages->getAllSubPagesById($page->page_id);
                                    }
                                    foreach($subs as $sub){?>
                                    <li>
                                    	<?php if($sub->page_id==18){ ?>
                                    	<a href="#" class="myappointclick"><?php echo $sub->page_name;?></a>
                                   	<?php }else{
                                            if($session_data['level']==1){
                                                if($sub->page_level==2){
                                                    
                                                }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php }}?>
                                    </li>
                                    <?php }?>
                            	</ul>
                            <?php }?>
                            
                            </li>
                                    <?php
                                    }}
                                }elseif($page->page_id == 47){
                                    $check = $this->model_portal_pages->checkReimbursementModule($session_data['agreement_no']);
                                    if($check==1){
                                        //echo "Reimbursement";
                                    ?>
                            <li class="<?php if($sess_pages['page_id']==$page->page_id){echo 'active';}?> <?php if($page->has_sub==1){echo 'dropdown';}?>">
                                <a href="<?php echo base_url($page->page_url);?>" <?php if($page->has_sub==1){echo 'data-toggle="dropdown" class="dropdown-toggle"';}?>>
				<?php echo $page->page_name;?>
							<!--<span class="badge badge-orange">14</span>-->
                            
                                <?php if($page->has_sub==1){echo '<i class="glyphicon glyphicon-chevron-right"></i>';}?>
                                <?php if($page->page_id==3){?>
                                    <?php if($page->msg_totals>0){?>
                                        <span class="badge badge-orange"><?php echo $page->msg_totals;?></span>
                                    <?php }?>
                                <?php }?>                             
				</a>
							
                            <?php if($page->has_sub==1){?>
                            	<ul role="menu" class="dropdown-menu dd-menu">
                                <?php 
                                    if($session_data['level']==2){
                                        $subs = $this->model_portal_pages->getAllSubAdminPagesById($page->page_id);                                    
                                    }else {
                                        $subs = $this->model_portal_pages->getAllSubPagesById($page->page_id);
                                    }
                                    foreach($subs as $sub){?>
                                    <li>
                                    	<?php if($sub->page_id==18){ ?>
                                    	<a href="#" class="myappointclick"><?php echo $sub->page_name;?></a>
                                   	<?php }else{
                                            if($session_data['level']==1){
                                                if($sub->page_level==2){
                                                    
                                                }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php }}?>
                                    </li>
                                    <?php }?>
                            	</ul>
                            <?php }?>
                            
                            </li>
                                    <?php
                                    }
                                }elseif($page->page_id == 88){
                                    $check = $this->model_portal_pages->checkHRAModule($session_data['agreement_no']);
                                    if($check==1){
                                        //echo "Reimbursement";
                                    ?>
                            <li class="<?php if($sess_pages['page_id']==$page->page_id){echo 'active';}?> <?php if($page->has_sub==1){echo 'dropdown';}?>">
                                <a href="<?php echo base_url($page->page_url);?>" <?php if($page->has_sub==1){echo 'data-toggle="dropdown" class="dropdown-toggle"';}?>>
                <?php echo $page->page_name;?>
                            <!--<span class="badge badge-orange">14</span>-->
                            
                                <?php if($page->has_sub==1){echo '<i class="glyphicon glyphicon-chevron-right"></i>';}?>
                                <?php if($page->page_id==3){?>
                                    <?php if($page->msg_totals>0){?>
                                        <span class="badge badge-orange"><?php echo $page->msg_totals;?></span>
                                    <?php }?>
                                <?php }?>                             
                </a>
                            
                            <?php if($page->has_sub==1){?>
                                <ul role="menu" class="dropdown-menu dd-menu">
                                <?php 
                                    if($session_data['level']==2){
                                        $subs = $this->model_portal_pages->getAllSubAdminPagesById($page->page_id);                                    
                                    }else {
                                        $subs = $this->model_portal_pages->getAllSubPagesById($page->page_id);
                                    }
                                    foreach($subs as $sub){?>
                                    <li>
                                        <?php if($sub->page_id==18){ ?>
                                        <a href="#" class="myappointclick"><?php echo $sub->page_name;?></a>
                                    <?php }else{
                                            if($session_data['level']==1){
                                                if($sub->page_level==2){
                                                    
                                                }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php }}?>
                                    </li>
                                    <?php }?>
                                </ul>
                            <?php }?>
                            
                            </li>
                                    <?php
                                    }
                                }elseif($page->page_id == 65){
                                    if($session_data['agreement_no']==""){
                                        
                                    }else{
                                ?>
                            <li class="<?php if($sess_pages['page_id']==65){echo 'active';}?> <?php if($page->has_sub==1){echo 'dropdown';}?>">
                                <a href="<?php echo base_url($page->page_url);?>" <?php if($page->has_sub==1){echo 'data-toggle="dropdown" class="dropdown-toggle"';}?>>
				<?php echo $page->page_name;?>
							<!--<span class="badge badge-orange">14</span>-->
                            
                                <?php if($page->has_sub==1){echo '<i class="glyphicon glyphicon-chevron-right"></i>';}?>
                                <?php if($page->page_id==3){?>
                                    <?php if($page->msg_totals>0){?>
                                        <span class="badge badge-orange"><?php echo $page->msg_totals;?></span>
                                    <?php }?>
                                <?php }?>                             
				</a>
							
                            <?php if($page->has_sub==1){?>
                            	<ul role="menu" class="dropdown-menu dd-menu">
                                <?php 
                                    if($session_data['level']==2){
                                        $subs = $this->model_portal_pages->getAllSubAdminPagesById($page->page_id);                                    
                                    }else {
                                        $subs = $this->model_portal_pages->getAllSubPagesById($page->page_id);
                                    }
                                    foreach($subs as $sub){?>
                                    <li>
                                    	<?php if($sub->page_id==18){ ?>
                                    	<a href="#" class="myappointclick"><?php echo $sub->page_name;?></a>
                                   	<?php }else{
                                            if($session_data['level']==1){
                                                if($sub->page_level==2){
                                                    
                                                }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php }}?>
                                    </li>
                                    <?php }?>
                            	</ul>
                            <?php }?>
                            
                            </li>
                            
                                <?php
                                    }
                                }elseif($page->page_id == 54){
                                    if($session_data['agreement_no']==""){
                                        
                                    }else{
                                ?>
                            <li class="<?php if($sess_pages['page_id']==54){echo 'active';}?> <?php if($page->has_sub==1){echo 'dropdown';}?>">
                                <a href="<?php echo base_url($page->page_url);?>" <?php if($page->has_sub==1){echo 'data-toggle="dropdown" class="dropdown-toggle"';}?>>
				<?php echo $page->page_name;?>
							<!--<span class="badge badge-orange">14</span>-->
                            
                                <?php if($page->has_sub==1){echo '<i class="glyphicon glyphicon-chevron-right"></i>';}?>
                                <?php if($page->page_id==3){?>
                                    <?php if($page->msg_totals>0){?>
                                        <span class="badge badge-orange"><?php echo $page->msg_totals;?></span>
                                    <?php }?>
                                <?php }?>                             
				</a>
							
                            <?php if($page->has_sub==1){?>
                            	<ul role="menu" class="dropdown-menu dd-menu">
                                <?php 
                                    if($session_data['level']==2){
                                        $subs = $this->model_portal_pages->getAllSubAdminPagesById($page->page_id);                                    
                                    }else {
                                        $subs = $this->model_portal_pages->getAllSubPagesById($page->page_id);
                                    }
                                    foreach($subs as $sub){?>
                                    <li>
                                    	<?php if($sub->page_id==18){ ?>
                                    	<a href="#" class="myappointclick"><?php echo $sub->page_name;?></a>
                                   	<?php }else{
                                            if($session_data['level']==1){
                                                if($sub->page_level==2){
                                                    
                                                }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php }}?>
                                    </li>
                                    <?php }?>
                            	</ul>
                            <?php }?>
                            
                            </li>
                            
                                <?php
                                    }
                                }else{
                                    
                                        
                                   
			?>
                            <li class="<?php if($sess_pages['page_id']==$page->page_id){echo 'active';}?> <?php if($page->has_sub==1){echo 'dropdown';}?>">
                                <a href="<?php echo base_url($page->page_url);?>" <?php if($page->has_sub==1){echo 'data-toggle="dropdown" class="dropdown-toggle"';}?>>
				<?php echo $page->page_name;?>
							<!--<span class="badge badge-orange">14</span>-->
                            
                                <?php if($page->has_sub==1){echo '<i class="glyphicon glyphicon-chevron-right"></i>';}?>
                                <?php if($page->page_id==3){?>
                                    <?php if($page->msg_totals>0){?>
                                        <span class="badge badge-orange"><?php echo $page->msg_totals;?></span>
                                    <?php }?>
                                <?php }?>                             
				</a>
							
                            <?php if($page->has_sub==1){?>
                            	<ul role="menu" class="dropdown-menu dd-menu">
                                <?php 
                                    if($session_data['level']==2){
                                        $subs = $this->model_portal_pages->getAllSubAdminPagesById($page->page_id);                                    
                                    }else {
                                        $subs = $this->model_portal_pages->getAllSubPagesById($page->page_id);
                                    }
                                    foreach($subs as $sub){?>
                                    <li>
                                    	<?php if($sub->page_id==18){ ?>
                                    	<a href="#" class="myappointclick"><?php echo $sub->page_name;?></a>
                                   	<?php }else{
                                            if($session_data['level']==1){
                                                if($sub->page_level==2){
                                                    
                                                }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <a href="<?php echo base_url($sub->page_url);?>"><?php echo $sub->page_name;?></a>
                                        <?php }}?>
                                    </li>
                                    <?php }?>
                            	</ul>
                            <?php }?>
                            
                            </li>
                                <?php }}?>                        
                    					
                            <li>
                                <a href="<?php echo base_url("home/logout");?>">
				Logout		
                            </a>							
			</li>						
                    </ul>

                    <div class="row">
                        <div id="philsocial">
                            <ul class="social_icons clearfix">
                                <li>
                                    <a href="https://www.facebook.com/philcareph" data-toggle="tooltip" data-placement="top" title="Facebook">
                                    <img src="<?php echo base_url('resources/img/fb.png');?>"></a>
                                </li>
                             <li>
                                <a href="https://twitter.com/philcareph" data-toggle="tooltip" data-placement="top" title="Twitter">
                                <img src="<?php echo base_url('resources/img/tweet.png');?>"></a>
                             </li>
                             <li>
                                <a href="http://www.youtube.com/philcareph" data-toggle="tooltip" data-placement="top" title="Youtube">
                                <img src="<?php echo base_url('resources/img/yt.png');?>"></a>
                             </li>
                             <li>
                                <a href="http://instagram.com/philcareph" data-toggle="tooltip" data-placement="top" title="Instagram">
                                <img src="<?php echo base_url('resources/img/insta.png');?>"></a>
                             </li> 
                            </ul>                  
			</div>
                    </div>					
		</div>
            </div>
	<script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
					
            });
            $(document).ready(function(){
		$("body").on("click",".changepass",function(){
			$("#changepassmodal").modal("show");
		});
		
		$("body").on("click",".changephoto",function(){
			$("#chnagephotomodal").modal("show");
		});
		
		$("body").on("click",".myappointclick",function(){
			$(".loaderphil").show();
			$("#sappt_rep").load("<?php echo base_url("providers/getOnlineAppointment");?>");
			$("#viewappoint").modal("show");
		});		
		
	});
	
	
        </script>