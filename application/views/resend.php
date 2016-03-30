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
    <link href="<?php echo base_url("resources");?>/css/switch.css" rel="stylesheet">
	<script src="<?php echo base_url("resources");?>/js/jquery.js"></script>
    <script src="<?php echo base_url("resources");?>/js/bootstrap.min.js"></script>
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
            <!-- Collect the nav links, forms, and other content for toggling 
            <div class="collapse navbar-collapse" id="philcollapse">

				<ul class="nav navbar-nav navbar-right">
					<li class="headname"><a href="<?php echo base_url("login");?>"><span  class="badge badge-log-green">LOGIN</span></a></li>
					<li class="headphoto"><a href="./"><img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("resources");?>/img/dummy_reg.png" data-holder-rendered="true"></a></li>
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

                            <div class="pull-right main-title">Resend Verification Link</div>
                        </div>
                        <div class="panel-forgot-body">
                            <div class="container">

                                <p class="lead">Please provide the email address you've used to register this account and we'll send to you your username, password and verification code.</p>

                            </div>
                            <form class="form-horizontal" role="form" method="POST">
                                <div class="form-group">

                                    <div class="col-md-offset-4 col-sm-4 col-sm-5">

                                  <?php
                                  if($error==true || $msg==false){
                                                            ?>
                                        <h4 >Enter Email Address</h4>
                                        <input id="" class="form-control" type="email" autofocus required placeholder="" value="" name="email">  
                                                   <?php   }

                                                      ?>
                                
                                                           <?php if($msg!=false){?>
                                        <div class="alert"><span class="badge badge-green">!</span>&nbsp; <?php echo $msg;?>
                                        
                                        </div>
                                   <?php 
                                           }
                                           ?>

                                    </div>

                                </div>   

                                <div class="form-group">
                                    <div class="col-md-offset-4 col-sm-4 col-sm-5">
                                                           <?php
                                                       if($error==true || $msg==false){
                                                             ?>
                                    <button class="btn btn-green" type="submit" name="submit">SUBMIT</button> 
                                    <?php }?> 
                                    </div> 
                                </div>    
                            </form>
                        </div>
                    </div>     
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
    
    <script src="<?php echo base_url("resources");?>/js/switch.js"></script>
    <script>
	$(document).ready(function(){
		$(".main-back").click(function(){
			location.href="<?php echo base_url("login");?>";
		});
		
	});
	</script>
</body>

</html>
            