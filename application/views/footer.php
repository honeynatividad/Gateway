<?php
$ses_data = $this->session->userdata('logged_in');

if($ses_data['level']==1){
    $uinfo = $this->model_portal_pages->getUserById($ses_data['user_id']);
    $udetails = $this->model_portal_users->getUserDetails($uinfo->user_id);
    
}else{
    $udetails =$this->wslibrary->getMembersInfo($ses_data['user_id']);
}
?>
<style>
.table.tb td{
	border-top: 0 solid #dddddd;
}
</style>
<!-- Modal -->
<div class="modal fade" id="changepassmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="badge badge-red">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="myModalLabel">Change Password</h3>
            </div>
            <div class="modal-body ">
      
                <div class="row">
                    <div class="col-md-12">

                        <form action="" method="post" class="form-horizontal">
                            <input type="hidden" value="<?php echo $udetails->CertNo;?>" name="certid">
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">Old Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="old_pass" required>
                                    <div id="changestat"></div> 
                                </div>     
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">New Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" value="" name="new_pass" id="newpass" required>
                                    <div id="changestat2"></div> 
                                </div>     
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">Confirm Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" value="" name="confirmpass" required>
                                    <div id="changestat2"></div> 
                                </div>     
                            </div> 
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-green">SAVE</button>
                                    <button type="button" class="btn btn-red" data-dismiss="modal">CANCEL</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        
            </div>

        </div>
    </div>
</div>




<!-- view appointment modal -->
<!-- Modal -->
<div class="modal fade" id="viewappoint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="badge badge-red">&times;</span><span class="sr-only">Close</span></button>
                <h2 class="modal-title" id="myModalLabel">Online Appointment</h2>
            </div>
            <div class="modal-body" style="padding: 12px 53px;">
                <div class="row">
                    <div class="col-md-12" id="sappt_rep">
                        <div class="loaderphil" id="thisanchor"><div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- change photo modal -->

<div class="modal fade" id="chnagephotomodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="badge badge-red">&times;</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="myModalLabel">Change Profile Photo</h3>
        </div>
        <div class="modal-body ">      
            <div class="row">
                <div class="col-md-12">      
                    <form class="form-horizontal" id="changephotoform" action="<?php echo base_url("account/changephoto");?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="certno" value="<?php echo $ses_data['user_id'] ?>">
                            <div class="col-xs-6 col-md-3">
                                <a href="#" class="thumbnail">
                                    <?php if(!empty($uinfo->image)){?>
                                    <img  src="<?php echo base_url("upload/profile/".$uinfo->image);?>" data-holder-rendered="true">
                                    <?php }else{
                                        $target_dir = dirname($_SERVER["SCRIPT_FILENAME"])."/upload/profile/";                                        
                                        $fileSearch = "God_of_War";


                                        $files = glob($target_dir . $udetails->CertNo . ".jpg");
                                        $count = count($files);

                                        if($count > 0) {?>
                                            <?php if($udetails->Sex =='MALE'){?>
                                            <img  src="<?php echo base_url("upload");?>/profile/<?php echo $udetails->CertNo ?>.jpg" data-holder-rendered="true">
                                            <?php }else{?>
                                            <img src="<?php echo base_url("upload");?>/profile/<?php echo $udetails->CertNo ?>.jpg" data-holder-rendered="true">
                                            <?php } ?>
                                        <?php }else{ ?>
                                         <?php if($udetails->Sex =='MALE'){?>
                                        <img  src="<?php echo base_url("resources");?>/img/dummy_m.png" data-holder-rendered="true">
                                        <?php }else{?>
                                        <img src="<?php echo base_url("resources");?>/img/dummy_f.png" data-holder-rendered="true">
                                        <?php }?>
                                    <?php }}?>
                                </a>
                            </div>   
                            <div class="col-xs-6 col-md-6">
                                <input type="file" name="new_photo">
                                <p style="color:#ff5151; font-size: 11px;">Maximum file size allowed is 2MB. Only JPG file is allowed</p>
                            </div> 
                            <div class="col-xs-6 col-md-6" id="uploadmsg">
                 	
                            </div> 
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="hidden" name="user_id" value="<?php echo $ses_data['user_id'];?>">
                                <button type="submit" class="btn btn-green">SAVE</button>
                                <button type="button" class="btn btn-red" data-dismiss="modal">CANCEL</button>
                            </div>
                        </div>
                    </form>
 		</div>
            </div>        
        </div>
    </div>
  </div>
    <script type="text/javascript">

</script>
</div>

        

<!-- end modal popup-->		

</div>
</div>
    <!-- /.container -->
	
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
                        <!--<li>Sitemap</li>-->
            </ul>
           
        </div>
        <div class="col-lg-12">
            
            <ul class="footer-info">
                <img src="<?php echo base_url('resources/img/gomobile.png') ?>" style="width:50px;height:50px;">
                <!--<li><a href="<?php echo base_url("phil/terms");?>">Terms and Condition</a></li>
                <li><a href="<?php echo base_url("phil/privacy");?>">Privacy Policy</a></li>-->
                <a href='https://play.google.com/store/apps/details?id=com.app.philcaregomobile&hl=en'><img src='<?php echo base_url("resources/img/android.jpg") ?>'></a>
                <a href='https://itunes.apple.com/ph/app/philcare-go!mobile/id917095709?mt=8'><img src='<?php echo base_url("resources/img/appstore.jpg") ?>'></a>
                        <!--<li>Sitemap</li>-->
            </ul>
                    
        </div>
    </div>
            <!-- /.row -->
</footer>	
	
</div>
    <!-- jQuery -->
    

    <!-- Bootstrap Core JavaScript -->
    
    <script src="<?php echo base_url("resources");?>/js/switch.js"></script>
    <script src="<?php echo base_url("resources");?>/js/jquery.form.js"></script>
    <script src="<?php echo base_url("resources");?>/js/philjs.js"></script>
    <script>
	$(document).ready(function(){
            $('#report').DataTable();
		$( ".dropdown" ).mouseover(function() {
		$( this ).addClass("open");
		})
		.mouseout(function() {
		$( this ).removeClass("open");
		});
		

		
	}); 	
	
	function wrongoldpass(){
		$("#changestat").html('<span class="badge badge-red">!</span>&nbsp; Invalid Old Password!');
		$("#changestat2").html('');
		$("#changepassmodal").modal("show");
		
	}
	
	function successfulchange(){
		$("#changestat").html('');
		$("#changestat2").html('<span class="badge badge-green">!</span> Password Has Been Updated!');
		$("#changepassmodal").modal("show");		
		
	}

	function didnotmatch(){
		$("#changestat").html('');
		$("#changestat2").html('<span class="badge badge-red">!</span> Passwords did not match!');
		$("#changepassmodal").modal("show");		
		
	}
	
	function webvalidation(stat){
		$("#changestat").html('');
		$("#changestat2").html('<span class="badge badge-red">!</span>'+stat);
		$("#changepassmodal").modal("show");		
		
	}	
    </script>


<?php
//changepass
    if(isset($_REQUEST['new_pass'])){
	/*$checkpass=$this->model_portal_users->getpassifCorrect($ses_data['user_id'],$_REQUEST['old_pass']);
	if($checkpass){
		if($_REQUEST['new_pass']==$_REQUEST['confirmpass']){
		//$this->model_portal_users->updatepass($ses_data['user_id'],$_REQUEST['new_pass']);
		$this->wslibrary->changePassWebservice($_REQUEST);
		echo '<script>successfulchange();</script>';
		}else{
			echo '<script>didnotmatch();</script>';
		}
	}else{
		echo '<script>wrongoldpass();</script>';
	}
	*/
	$service = $this->wslibrary->changePassWebservice($_REQUEST);
	if($_REQUEST['new_pass']==$_REQUEST['confirmpass']){
            if($service->SuccessFlag=='True'){
                echo '<script>successfulchange();</script>';
            }else{
		echo '<script>webvalidation(" '.$service->MessageReturn.' ");</script>';
			//echo '<script>wrongoldpass();</script>';
            }
	}else{
            echo '<script>didnotmatch();</script>';
	}
	
    }


?>
</body>

</html>