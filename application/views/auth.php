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
	
    <!-- jQuery -->
    <script src="<?php echo base_url("resources");?>/js/jquery.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script>
		$(document).ready(function()
		{
		 var ei = detectIE();
		 if(ei!=false){

			 if(detectIE()<9){
				 alert('Best Viewed using Internent Explorer Version 8 and up');
			 }
		 }
		 
		});
		function detectIE() {
			var ua = window.navigator.userAgent;
		
			var msie = ua.indexOf('MSIE ');
			if (msie > 0) {
				// IE 10 or older => return version number
				return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
			}
		
			var trident = ua.indexOf('Trident/');
			if (trident > 0) {
				// IE 11 => return version number
				var rv = ua.indexOf('rv:');
				return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
			}
		
			var edge = ua.indexOf('Edge/');
			if (edge > 0) {
			   // IE 12 => return version number
			   return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
			}		
			// other browser
			return false;
		}
	</script>
        <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-49624511-7', 'auto');
  ga('send', 'pageview');
</script>
</head>

<body class="auth_body">
	<!-- Navigation -->
    
	<!-- wrapper-->
    <div class="philloginbody">
    <!-- Page Content -->
    <div class="container" id="philbody">
      <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
				  <img src="<?php echo base_url("resources");?>/img/logo_lg.png">
        </div>		
        <div class="col-md-3">
        </div>
		  </div>
      <div class="try-reset">
        <p>&nbsp;</p>
        <div class="row alert alert-warning2">
                    
          <p class="t2">If you are an existing PhilCare Go!Mobile user, no registration is required. You may directly proceed to access the portal by using your PhilCare Go!Mobile account.</p>
        
        </div>
      </div>
        <div class="row">
            <div class="headlogininfo">

                <div class="col-md-3"></div>
                <div class="col-md-6 " id="validate_anchor">
                    
                <!--<p>Etiam dui odio, finibus vitae mollis sed, tincidunt quis metus. Fusce vulputate ac turpis vitae facilisis. Cras erat justo, vulputate eu purus ut, posuere imperdiet libero. Integer non arcu justo.</p>-->
                
                    <form class="form-horizontal logform" method="POST" role="form" >
                        <div class="form-group">
							<div class="col-sm-4 green_label">
								<label>Username or Email Address</label>
							</div>
                            <div class="col-sm-8">
                                <input type="text" name="username" value="<?php echo isset($_COOKIE['remember_me_username'])?$_COOKIE['remember_me_username']:''; ?>" class="form-control" id="" placeholder="" required autofocus>
                            </div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 green_label">
								<label>Password</label>
							</div>
                            <div class="col-sm-8">
                                <input type="password" value="<?php echo isset($_COOKIE['remember_me_password'])?$_COOKIE['remember_me_password']:''; ?>" name="password" class="form-control" id="" required placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
							<div class="col-sm-4"></div>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-green">LOGIN</button>
                                <a href="<?php echo base_url("register");?>" class="btn btn-green">REGISTER</a>
                        <!--<a href="<?php echo base_url("forgot");?>" class="btn btn-red">FORGOT PASSWORD</a>  -->
                                <div class="row"><div class="col-md-12">Forgot your password? <a class="hlink" href="<?php echo base_url("forgot");?>">Click Here</a></div></div>                                          
                            </div> 
                        </div>     
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="remember" <?php if(isset($_COOKIE['remember_me_checked']) && !empty($_COOKIE['remember_me_checked'])){ echo 'checked="checked"';}?> >Remember Me
                            </label>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12" >
                            <?php echo form_open('login'); ?>
                             <?php 
                            if(!empty(validation_errors())){
                            echo "<div class='alert alert-danger'>".validation_errors()."</div>"; 
                            echo '
                                <script>$(window).scrollTop($("#validate_anchor").offset().top).scrollLeft($("#validate_anchor").offset().left);
                                </script>';
                            }
                            ?>	
                            </div>
                        </div>
                        
                  
                    </form>
                    <?php echo $sinfo->logindesc;?>
		</div>       
                <div class="col-md-3"></div>
            </div>    
        </div>
    
        
        
       
    <!-- /.container -->
    </div>
	<!-- end philbody-->
	
        <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <ul class="footer-info">
                    <li>&copy; <?php echo date("Y"); ?> PhilCare Inc.</li>
                    	<!--<li><a href="<?php echo base_url("phil/terms");?>">Terms and Condition</a></li>
                        <li><a href="<?php echo base_url("phil/privacy");?>">Privacy Policy</a></li>-->
                    <li><a href="http://www.philcare.com.ph/terms-and-conditions/">Terms and Condition</a></li>
                    <li><a href="http://www.philcare.com.ph/privacy-policy/">Privacy Policy</a></li>  
                </ul>
                    
            </div>
        </div>
            <!-- /.row -->
    </footer>	
	
<style>
/*.articleimge > img {
    max-height: 175px;
    overflow: hidden;
}
*/
/*.thumbnail_article > img {
    max-height: 175px;
}*/



.thumbnail_article .caption > h3 {
    font-size: 15px !important;
}
</style>	
	
	


    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("resources");?>/js/bootstrap.min.js"></script>
    <script>
	
   (function ($) {
         $.support.placeholder = ('placeholder' in document.createElement('input'));
     })(jQuery);


     //fix for IE7 and IE8
     $(function () {
         if (!$.support.placeholder) {
             $("[placeholder]").focus(function () {
                 if ($(this).val() == $(this).attr("placeholder")) $(this).val("");
             }).blur(function () {
                 if ($(this).val() == "") $(this).val($(this).attr("placeholder"));
             }).blur();

             $("[placeholder]").parents("form").submit(function () {
                 $(this).find('[placeholder]').each(function() {
                     if ($(this).val() == $(this).attr("placeholder")) {
                         $(this).val("");
                     }
                 });
             });
         }
     });
	 
   $(document).ready(function(){
	   getloadcurrent();
	   
	   $(".unlockacc").click(function(){
		   var em = $(this).attr("data-eadd");
		  $.post("<?php echo base_url("forgot/eunlock");?>",{acc_email:em},function(data){
			$(".alert-danger").html("<p>Email sent! Please check your email. If you need further assistance, please call our 24 / 7 Customer Hotline at +63 (2) 462 1800. For outside Metro Manila (Toll Free for PLDT): 1 800 1888 3230</p>");  
		  }); 
	   });
	});
	function getloadcurrent(){
	$("#relatedarticle").html('<div class="loaderphil" id="thisanchor"><div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div></div>');
	$(".loaderphil").show();	
	$("#relatedarticle").load("<?php echo base_url("login/related");?>",function(){
		
	});	
	
	}
  
   </script> 
    
</body>

</html>