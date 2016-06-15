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
    
    <style>
        .new-labelj {
            font-size: 15px;
        }
        .new-labelj > a {
            color: #ffffff;
        }
        .new-labelj{
            padding-left: 0;
            text-align: left !important;	
        }
        .lloading {
    color: #ffffff;
}
    </style>
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
					<li class="headphoto"><a href="#"><img class="img-circle" style="width: 50px; height: 50px;" src="<?php echo base_url("resources");?>/img/dummy_reg.png" data-holder-rendered="true"></a></li>
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
                        
                            <div class="pull-right main-title">Registration</div>
                        </div>
                        <div class="panel-reg-body">
                        <?php if(isset($failed_register)){ ?>
                            <form action="" method="POST">
                                <div class="center congrats">                                    
                                    
                                    <p><?php echo $message_return; ?></p>                                    
                                
                                    <div class="dts">
                                        <a href="<?php echo base_url("login");?>" class="btn btn-green">LOGIN</a>
                                        <input type="hidden" value="<?php echo isset($_REQUEST['Email'])?$_REQUEST['Email']:'';?>" name="resend_email">
                                        <input type="hidden" value="<?php echo isset($_REQUEST['CertNo'])?$_REQUEST['CertNo']:'';?>" name="CertNo">
                                        <input type="hidden" value="<?php echo isset($_REQUEST['Password'])?$_REQUEST['Password']:'';?>" name="Password">
                                        <input type="hidden" value="<?php echo isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'';?>" name="user_id">
                                        <a href="<?php echo base_url("register");?>" class="btn btn-red">REGISTER</a>                                        
                                    </div>
                                </div>
                            </form>
                            
                        <?php } elseif(isset($step3)){?>
                            <form action="" method="POST">
                                <div class="center congrats">
                                    <?php if(!isset($rsendmail)){?>
                                    <h1>Congratulations!</h1>
                                    <h2>You are one step away from making health happen through PhilCare Online!</h2>
                                    <p><?php echo $message_success; ?></p>
                                    
                                    
                                <?php }else{?>
                                <div><?php echo $rsendmail;?></div>
                                <?php }?>
                                    <div class="dts">
                                        <a href="<?php echo base_url("login");?>" class="btn btn-green">LOGIN</a>
                                        <input type="hidden" value="<?php echo isset($_REQUEST['Email'])?$_REQUEST['Email']:'';?>" name="resend_email">
                                        <input type="hidden" value="<?php echo isset($_REQUEST['CertNo'])?$_REQUEST['CertNo']:'';?>" name="CertNo">
                                        <input type="hidden" value="<?php echo isset($_REQUEST['Password'])?$_REQUEST['Password']:'';?>" name="Password">
                                        <input type="hidden" value="<?php echo isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'';?>" name="user_id">
                                        <!--<button type="submit" class="btn btn-red">RESEND LINK</button>!-->
                                        <a class="btn btn-red" href="<?php echo base_url("login/resend") ?>" >RESEND LINK</a>
                                    </div>
                                </div>
                            </form>
                            <?php }else{?>  
                            <div class="row">	
                                <div class="col-md-8 pdesc">
                                <!--<p>Lorem ipsum dolor eset it. Duis eget luctus mit. Class apent tecti ad litora torqent per conuba nostra.</p>-->                    	
                                    <?php 
                                    //echo $sinfo->regdesc;
                                    ?>                        
                                    <p>Please fill out the registration form.</p>
                                </div>
                            </div>  
                                <?php if($philerror==false){?>  
                                <form class="form-horizontal" role="form" method="POST" action="" id="allreg">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 panel-label">Certificate Number</label>
                                        <div class="col-sm-6">
                                          <p><?php echo $info->CertNo;?></p>
                                          <input type="hidden" name="CertNo" value="<?php echo $info->CertNo;?>">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 panel-label">Birthdate</label>
                                        <div class="col-sm-2">
                                            <p><?php echo date('M d, Y',strtotime($info->BirthDate));?></p>
                                            
                                            <input type="hidden" name="BirthDate" value="<?php echo $info->BirthDate;?>">
                                            <input type="hidden" name="FirstName" value="<?php echo $info->FirstName;?>">
                                            <input type="hidden" name="LastName" value="<?php echo $info->LastName;?>">

                                            <input type="hidden" name="AgreementName" value="<?php echo $info->AgreementName;?>">
                                            <input type="hidden" name="AgreementNo" value="<?php echo $info->AgreementNo;?>">
                                            <input type="hidden" name="BenefitLimit" value="<?php echo $info->BenefitLimit;?>">
                                            <input type="hidden" name="CivilStat" value="<?php echo $info->CivilStat;?>">
                                            <input type="hidden" name="DateRegistered" value="<?php echo $info->DateRegistered;?>">
                                            <input type="hidden" name="DateVerified" value="<?php echo $info->DateVerified;?>">
                                            <input type="hidden" name="Dental" value="<?php echo $info->Dental;?>">
                                            <input type="hidden" name="EffectiveDate" value="<?php echo $info->EffectiveDate;?>">
                                            <input type="hidden" name="ExpiryDate" value="<?php echo $info->ExpiryDate;?>">
                                            <input type="hidden" name="Hospitals" value="<?php echo $info->Hospitals;?>">
                                            <input type="hidden" name="MemberType" value="<?php echo $info->MemberType;?>">
                                            <input type="hidden" name="MiddleName" value="<?php echo $info->MiddleName;?>">
                                            <input type="hidden" name="PackageDescription" value="<?php echo $info->PackageDescription;?>">
                                            <input type="hidden" name="PhilHealth" value="<?php echo $info->PhilHealth;?>">
                                            <input type="hidden" name="PlanType" value="<?php echo $info->PlanType;?>">
                                            <input type="hidden" name="PolicyNo" value="<?php echo $info->PolicyNo;?>">
                                            <input type="hidden" name="PreEx" value="<?php echo $info->PreEx;?>">
                                            <input type="hidden" name="Riders" value="<?php echo $info->Riders;?>">
                                            <input type="hidden" name="RoomDescription" value="<?php echo $info->RoomDescription;?>">
                                            <input type="hidden" name="RoomRate" value="<?php echo $info->RoomRate;?>">
                                            <input type="hidden" name="Sex" value="<?php echo $info->Sex;?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 panel-label homeaddmobile">Home address</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" value="<?php echo $info->HouseNo;?>" name="HouseNo" required>
                                            <label class="control-label">Street Number</label>
                                        </div>
                                        <div class="col-sm-3">
                                          <input type="text" class="form-control" value="<?php echo $info->Street;?>" name="Street" required>
                                          <label class="control-label">Street Name</label>
                                        </div>        
                                        

                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 panel-label"></label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" value="<?php echo $info->Barangay;?>" name="Barangay" required>
                                            <label class="control-label">Barangay</label>
                                        </div>                   
                                        <div class="col-sm-2">
                                          <!--<input type="text" class="form-control" value="<?php echo $info->City;?>" name="City" required>--> 

                                            <select class="form-control" name="City" id="area_name" required>
                                            <option value="">Select City/Provinces</option>
                                            <?php 

                                                        foreach($provinces as $p){
                                                            $namespaces = $provinces->getNameSpaces(true);
                                                            $list = $p->children($namespaces['a']);
                                                            foreach($list as $li){
                                                                $prov = $li->children($namespaces['a']);
                                                            ?>
                                                            <option value="<?php echo urlencode($prov->City);?>"><?php echo $prov->City;?></option>
                                                            <?php }

                                                            }?>
                                             
                                            </select>

                                          <label class="control-label">Province</label>
                                        </div>
                                        <div class="col-sm-2" id="distrct_rep">
                                            <div class="metro open">
                                          <!--<input type="text" class="form-control" value="<?php echo $info->Province;?>" name="Province" required>-->
                                            <select class="form-control" id="dsctval" name="Province" required>
                                                <option value="">Select Region</option>
                                                <?php //echo getRegion();?>
                                            </select>
                                            </div>
                                            <label class="control-label">City</label>
                                        </div> 
                                        <div class="col-lg-2">
                                            <div class="lloading"></div>
                                        </div>
                                        <div class="loaderphil" id="thisanchor">
                                            <div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div>
                                        </div>   
   
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 panel-label">Home Number</label>
                                        <div class="col-sm-5">
                                            <?php
                                            if(!empty($info->HomeNo)){
                                                $repHome = str_replace('+63','+63',$info->HomeNo);
                                            }else{
                                                $repHome = '+63';
                                            }
                                            ?>
                                            <input type="text" class="form-control" id="hnumber" value="<?php echo trim($repHome);?>" name="HomeNo" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php
                                        if(!empty($info->ContactNumber)){
                                            $repMob = str_replace('+63','+63',$info->ContactNumber);
                                        }else{
                                            $repMob = '+63';
                                        }
                                        ?>                      
                                        <label for="" class="col-sm-3 panel-label">Mobile Number</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="mdumber" value="<?php echo trim($repMob);?>" name="ContactNumber" required >
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="" class="col-sm-3 panel-label">Email</label>
                                        <div class="col-sm-5">
                                            <input type="email" class="form-control" value="<?php echo $info->Email;?>" name="Email" id="Email" required>
                                        </div>

                                        <div class="col-sm-4" id="unamevalidation">

                                        </div>                       
                                    </div>

                                    <div class="form-group" style="display:none;">
                                        <label for="" class="col-sm-3 panel-label">Username</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" class="form-control" value="<?php echo $info->Email;?>" name="Username" id="username" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 panel-label">Password</label>
                                        <div class="col-sm-5">
                                            <input type="password" class="form-control" value="" name="Password" placeholder="6-20 alphanumeric characters" id="pass1" pattern=".{6,}" title="6 characters minimum" required>
                                            <label class="control-label">Input password</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" value="" id="pass2" placeholder="6-20 alphanumeric characters" pattern=".{6,}" title="6 characters minimum"  required>
                                            <label class="control-label">Confirm password</label>
                                        </div>              
                                    </div>                  

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 panel-label"></label>
                                        <div class="col-sm-7">
                                            <div class="checkbox">
                                                <label class="new-labelj">
                                                    <input type="checkbox" value="1" id="agree">
                                                    Yes, I have read and accept the following: <a href="http://www.philcare.com.ph/terms-and-conditions/">Terms and Conditions</a> and <a href="http://www.philcare.com.ph/privacy-policy/">Privacy Policy</a>.
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 panel-label"></label> 
                                        <div class="col-sm-2">
                                            <button type="button" id="submit_2" class="btn btn-green"  name="submit_2">SUBMIT</button>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="<?php echo base_url("register");?>" class="btn btn-red">CANCEL</a>
                                        </div>                         
                                    </div>
                                </form>     
                                <?php }else{?>
                                <div class="form-horizontal" >
                                    <div class="col-md-offset-4">Certificate Number or Birthdate is incorrect.</div>
                                        <div class="col-md-offset-4">
                                        <a class="btn btn-green"href="<?php echo base_url("register");?>">BACK TO REGISTRATION</a>
                                    </div>

                                </div>
                                <?php }?>                 
                      
                        <?php }?>                         
                      
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
<script>
(function (exports) {
    function valOrFunction(val, ctx, args) {
        if (typeof val == "function") {
            return val.apply(ctx, args);
        } else {
            return val;.
            
        }
    }

    function InvalidInputHelper(input, options) {
        input.setCustomValidity(valOrFunction(options.defaultText, window, [input]));

        function changeOrInput() {
            if (input.value == "") {
                input.setCustomValidity(valOrFunction(options.emptyText, window, [input]));
            } else {
                input.setCustomValidity("");
            }
        }

        function invalid() {
            if (input.value == "") {
                input.setCustomValidity(valOrFunction(options.emptyText, window, [input]));
            } else {
               console.log("INVALID!"); input.setCustomValidity(valOrFunction(options.invalidText, window, [input]));
            }
        }

        input.addEventListener("change", changeOrInput);
        input.addEventListener("input", changeOrInput);
        input.addEventListener("invalid", invalid);
    }
    exports.InvalidInputHelper = InvalidInputHelper;
})(window);


InvalidInputHelper(document.getElementById("pass1"), {
    defaultText: "You must choose a password to proceed!",
    emptyText: "You must choose a password to proceed!",
    invalidText: function (input) {
        return 'Please create a 6-20 alphanumeric password';
    }
});

InvalidInputHelper(document.getElementById("pass2"), {
    defaultText: "You must choose a password to proceed!",
    emptyText: "You must choose a password to proceed!",
    invalidText: function (input) {
        return 'Please create a 6-20 alphanumeric password';
    }
});

/*
var username_validate = document.getElementById("Email");
username_validate.addEventListener("input", function() {

	$.post("<?php echo base_url("register/checkusername");?>",{username:usrname},function(data){
		obj = JSON.parse(data);
		if(obj.status=='true'){
		username_validate.setCustomValidity(("Email already registered with PhilCare. Please nominate another email address.");
		}else{
		username_validate.setCustomValidity("");
		}
	});	

});
*/
var password = document.getElementById("pass1")
  , confirm_password = document.getElementById("pass2");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;



</script>    

    <!-- Bootstrap Core JavaScript -->
<script>
    
    /*
     * 
     * Check #allreg script
     * script is disabling connection to webservice in terms of inserting data (registration)
     * Get certificate for new registration
     * 
     */
    
    
    
    $(document).ready(function(){
        
        $("#area_name").change(function(){
		//$(".lloading").text("Loading....");
                $(".loaderphil").show();
		$.post("<?php echo base_url("register/getallDistrict");?>",
		{City:$(this).val()},function(data){
			$("#distrct_rep").html(data);	
			//$(".lloading").text('done');
                        $(".loaderphil").hide();
		});		
	});
        
        
        $(".main-back").click(function(){
            location.href="<?php echo base_url("login");?>";
	});
		
	$("#agree").change(function(){
            var mbile = $("#mnumber").val();
            var hbile = $("#hnumber").val();	
            var usrname= $("#Email").val();		
            if($(this).is(':checked')){
		/* mobile validation */			
                if(mbile=='' && hbile=='') {
                    alert("Atleast 1 Contact Number Required");	
                				
		}else{
                    $("#submit_2").attr("type","submit");
		}
            }else{
                alert("looking for submit_2");
                $("#submit_2").attr("type","button");
            }
			
        });
		
        $("#allreg").submit(function(event){
            var pass1 = $("#pass1").val();
            var pass2 = $("#pass2").val();
            //var usrname= $("#Email").val();
			
            var hnum = $("#hnumber").val();
            var mnum = $("#mnumber").val();
			
            if(hnum == '' && mnum == ''){
                alert("Please fill up Home Number or Mobile Number!");
		event.preventDefault();	
		   /* }else if(usrname){
				$.post("<?php echo base_url("register/checkusername");?>",{username:usrname},function(data){
					obj = JSON.parse(data);
					if(obj.status=='true'){
						alert("Email already registered with PhilCare. Please nominate another email address.");
						event.preventDefault();
					}else{
						return;
					}
					event.preventDefault();	
				});		
				*/
            }else if(pass1==pass2){
		return;
            }else{
		alert("Passwords did not match!");
		event.preventDefault();				
            }			
	});
		
	$("#submit_2").click(function(){
            if($("#agree").is(':checked')){
                return true;
            }else{
                alert("You must agree to the terms and conditions of use to proceed further.");
                return false;
            }
	});
		
	
		
    });
	</script>
<?php
function getRegion(){
	$option = '';
	$option .= '<option value="NCR">NCR</option>';
	$option .= '<option value="Region I">Region I</option>';
	$option .= '<option value="Region II">Region II</option>';
	$option .= '<option value="Region III">Region III</option>';
	$option .= '<option value="Region IV-A">Region IV-A</option>';
	$option .= '<option value="Region IV-B">Region IV-B</option>';
	$option .= '<option value="Region V">Region V</option>';
	$option .= '<option value="Region VI">Region VI</option>';
	$option .= '<option value="Region VII">Region VII</option>';
	$option .= '<option value="Region VIII">Region VIII</option>';
	$option .= '<option value="Region IX">Region IX</option>';
	$option .= '<option value="Region X">Region X</option>';
	$option .= '<option value="egion XI">Region XI</option>';
	$option .= '<option value="Region XII">Region XII</option>';
	$option .= '<option value="Region XIII">Region XIII</option>';
	$option .= '<option value="Region XIV">Region XIV</option>';
	$option .= '<option value="CAR">CAR</option>';	
	$option .= '<option value="ARMM">ARMM</option>';	
	
	return $option;
}


?>    
</body>

</html>
            