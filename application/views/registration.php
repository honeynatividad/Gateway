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
    <link type="image/x-icon" href="http://www.philcare.com.ph/wp-content/uploads/2014/09/phil_fav.png" rel="shortcut icon">
    <!-- Custom CSS -->
    <link href="css/4-col-portfolio.css" rel="stylesheet">
    
    <link href="<?php echo base_url("resources");?>/css/style.css" rel="stylesheet">
    <script src="<?php echo base_url("resources");?>/js/jquery.js"></script>
    <script src="<?php echo base_url("resources");?>/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url("resources");?>/js/numeric.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
 
    <!-- IE 8 or below -->   
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" type="text/css"  href="<?php echo base_url("resources"); ?>/css/ie.css" />        
    <![endif]-->
    <!-- IE 9 or above -->
    <!--[if gte IE 9]>
    <link rel="stylesheet" type="text/css" media="(max-width: 100000px) and (min-width:481px)"
        href="<?php echo base_url("resources"); ?>/css/ie.css" />
    <link rel="stylesheet" type="text/css" media="(max-width: 480px)"
        href="<?php echo base_url("resources"); ?>/css/ie.css" />        
    <![endif]-->
    <!-- Not IE -->
    <!-- [if !IE] -->
    
    <!-- [endif] -->
    
    
  
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-49624511-7', 'auto');
  ga('send', 'pageview');
</script>
</head>

<body>
<?php 
$session_data = $this->session->userdata('logged_in');
$sess_pages = $this->session->userdata('pages');
?>	
    <!-- Navigation -->
    <!--<nav class="navbar navbar-default navbar-fixed-top" role="navigation"-->
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar navbar-default ">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url('home');?>">
                        <img src="<?php echo base_url("resources");?>/img/logo.png">
                    </a>               
                </div>
                <center>
                    <div class="navbar-collapse collapse" id="navbar-main">
                    </div>
                </center>
            </div>
        </div>
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
                            <div class="pull-right main-title">Registration</div>
                        </div>
                        <div class="panel-reg-body">
                            <div class="row">	
                                <div class="col-md-8">
                                    <p class="lead2">Please enter your certificate number and birth date.</p>
                                </div>
                            </div>  
                      
                            <form class="form-horizontal" role="form" method="POST" action="">
                                <div class="form-group">
                                    <label for="" class="col-sm-4 panel-label">Certificate Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" pattern=".{7,}" maxlength="7" class="form-control" name="CertNo" value="<?php echo isset($_POST['CertNo'])?$_POST['CertNo']:'';?>" placeholder="" required title="7 characters minimum">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-4 panel-label">Birth date</label>
                                    <div class="col-sm-1 col-md-2">
                                    <!--<input type="text" maxlength="2" class="form-control" id="" name="mm" placeholder="mm" value="<?php echo isset($_POST['mm'])?$_POST['mm']:'';?>" required>-->
                                        <select class="form-control" name="mm" required>
                                            <?php for($i=01;$i<=12;$i++){?>
                                                          <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT);?>"><?php echo date('M',strtotime('2014-'.$i.'-01'));?></option>
                                            <?php }?>

                                        </select>
                                        <label class="ulabel">Month</label>
                                    </div>
                                    <div class="col-sm-1 col-md-2">
                                    <!--<input type="text" maxlength="2" class="form-control" id="" name="dd" placeholder="dd" value="<?php echo isset($_POST['dd'])?$_POST['dd']:'';?>" required>-->
                                        <select class="form-control" name="dd" required>
                                            <?php for($i=01;$i<=31;$i++){?>
                                            <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT);;?></option>
                                            <?php }?>

                                        </select>                          
                                        <label class="ulabel">Day</label>
                                    </div>
                                    <div class="col-sm-1 col-md-2">
                              <!--<input type="text" maxlength="4" class="form-control" id="" name="yyyy" placeholder="yyyy" value="<?php echo isset($_POST['yyyy'])?$_POST['yyyy']:'';?>" required>-->

                                        <select class="form-control" name="yyyy" required>
                                        <?php 
                                            $thisyear = date('Y');
                                            $currty = $thisyear;
                                            for($i=1950;$i<=$currty;$i++){?>
                                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                        <?php }?>                          
                                        </select>                          
                                        <label class="ulabel">Year</label>
                                    </div>                                                
                        
                                </div>
                      
                                <div class="form-group">
                                    
                                    <div class="col-sm-12">

                                        <?php //echo $recaptcha_html; ?> 
                                        
                                            <?php if(isset($error_registration)){ 
                                            echo '<div class="alert alert-danger">'.$error_registration.'</div>';
                                            }?>
                                            <?php if ($this->session->flashdata('error') != FALSE) { 
                                            echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>'; 
                                            } ?>

                                                              
                                    </div>  
                                    
                                </div>
                      
                                <div class="form-group">
                                    <label for="" class="col-sm-4 panel-label"></label> 
                                    <div class="col-sm-2" style="text-align:center;">
                                        <button type="submit" class="btn btn-green" name="submit">SUBMIT</button>
                                    </div>
                                    <div class="col-sm-2" style="text-align:center;">
                                        <button type="button" class="btn btn-red cancel-back">CANCEL</button>
                                    </div> 

                                </div>
                            </form>                      
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
                      <li>&copy; <?php echo date("Y"); ?> PhilHealthCare Inc.</li>
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
	
		$("#numeric").numeric();
		$(".main-back").click(function(){
			location.href="<?php echo base_url("login");?>";
		});

		$(".cancel-back").click(function(){
			location.href="<?php echo base_url("login");?>";
		});		
	});
	
    </script>


</body>

</html>