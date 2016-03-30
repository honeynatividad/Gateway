<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Philcare Portal</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("resources");?>/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/4-col-portfolio.css" rel="stylesheet">
	<link href="<?php echo base_url("resources");?>/css/style.css" rel="stylesheet">
	<script src="<?php echo base_url("resources");?>/js/jquery.js"></script>
    <script src="<?php echo base_url("resources");?>/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php 

$session_data = $this->session->userdata('logged_in');
$sess_pages = $this->session->userdata('pages');
if($session_data['user_id']){
	$uinfo = $this->model_portal_pages->getUserById($session_data['user_id']);
}
?>	
    <!-- Navigation -->
    <!--<nav class="navbar navbar-default navbar-fixed-top" role="navigation"-->
    <nav class="navbar navbar-default" role="navigation">
	<div class="top-head"></div>
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
                <img src="<?php echo base_url("resources");?>/img/logo.png">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="philcollapse">
                <ul class="nav navbar-nav visible-xs">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
				<ul class="nav navbar-nav navbar-right">
                <?php if($session_data['user_id']){?>
 					<li class="headname">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome!  
                     <span  class="badge badge-green"><?php echo $session_data['name'];?></span> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                         <li><a href="#" id="changephoto">Change Photo</a><li>
                         <li><a href="#" id="changepass">Change Password</a><li>
                        </ul>                    
                        </li>
					<li class="headphoto">
                    <a href="#">
                    <?php if(!empty($uinfo->image)){?>
                    <img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("upload/profile/".$uinfo->image);?>" data-holder-rendered="true">
                    <?php }else{?>
                    <img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("resources");?>/img/dummy.png" data-holder-rendered="true">
                    <?php }?>
                    </a></li>               
                <?php }else{?>
					<li class="headname"><a href="<?php echo base_url("login");?>"><span  class="badge badge-log-green">LOGIN</span></a></li>
					<li class="headphoto"><a href="#">
                    <img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("resources");?>/img/dummy_reg.png" data-holder-rendered="true"></a></li>
				<?php }?>
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
			<div class="col-md-12">
            
                  <!-- reg form-->      
                <div class="panel panel-philcare">
                    <div class="panel-heading">
                    	<div class="pull-left main-back">
                        	<span class=""><i class="glyphicon glyphicon-circle-arrow-left"></i></span>
                        </div>
                        
                        <div class="pull-right main-title"><?php echo $title;?></div>
                    </div>
                    <div class="panel-philinfo-body">
                    	<div class="row">
                     	<div class="well"> 
							<?php echo $page_content;?>
                      	</div>
                        </div>
                    </div>
                    
                </div>                
                        
                        
                  <!-- end form-->   
                  
                     
           </div> 
		</div>
    </div>
    <!-- /.container -->
	
	<!-- end philbody-->
	
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="footer-info">
                      <li>&copy; 2015 PhilHealthCare Inc.</li>
                    	<!--<li><a href="<?php echo base_url("phil/terms");?>">Terms and Condition</a></li>
                        <li><a href="<?php echo base_url("phil/privacy");?>">Privacy Policy</a></li>-->
                     	<li><a href="http://www.philcare.com.ph/terms-and-conditions/">Terms and Condition</a></li>
                        <li><a href="http://www.philcare.com.ph/privacy-policy/">Privacy Policy</a></li>  
                    </ul>
                    
                </div>
            </div>
            <!-- /.row -->
        </footer>	
	
	</div>
	
	
	
    <!-- jQuery -->
    

    <!-- Bootstrap Core JavaScript -->
    <script>
	$(document).ready(function(){
		$(".main-back").click(function(){
			location.href="<?php echo base_url("home");?>";
		});
		
	});
	</script>


</body>

</html>
            