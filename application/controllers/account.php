<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
	private $userid;
	private $certid;
	
	function __construct(){
		parent::__construct();	
		$this->load->model("model_portal_users");
                $this->load->model("model_portal_admin");
		 $session_data = $this->session->userdata('logged_in');

		 if(!$session_data){
			 redirect("login");
		 }
		 //$data['username'] = $session_data['username'];	
		 $data = $session_data;
                 //echo '<pre>';
                 //print_r($data);
                 //echo '</pre>';
		//page renew
                if($session_data['hra']==1){
                    redirect("hra");
                }
                //print_r($session_data['hra']);
		$this->userid = $session_data['user_id'];
		$renew = array("page_id"=>2);
		$this->session->set_userdata('pages',$renew);	
		
		$this->certid=$session_data['certid'];
		
		
	}
	function maintemp($temp,$data){
		$this->load->view('header',$data);
		$this->load->view($temp,$data);
		$this->load->view('footer');
	}
	
	function index(){
		if(isset($_REQUEST['update_add'])){
			//$update = $this->model_portal_users->updatemyaddress($_REQUEST,$this->userid);
                        $update = $this->wslibrary->philUpdate($_REQUEST);
                        $this->load->library('archive');
						$session_data = $this->session->userdata('logged_in');
						
                        $this->archive->addAudit($_POST['CertNo'],'account','edit','0',$session_data['agreement_no']);
						//$this->archive->addAudit($this->certid,'account','member information','0',$info->AgreementNo);
			if($update){
				redirect("account");
			}
		}
		
			
		//$data['info'] = $this->model_portal_users->getUserDetails($this->userid);
                //$data['dental'] = $this->wslibrary->getDentalAvailments($this->certid);
                
		$data['info'] = $this->wslibrary->getMembersInfo($this->certid);
                $info = $this->wslibrary->getMembersInfo($this->certid);
		
		$data['dental'] = $this->wslibrary->ridersDental($this->certid);
                $data['cert'] = $this->certid;
                $data['life'] = $this->wslibrary->ridersLife($this->certid);
                $data['maternity'] = $this->wslibrary->ridersMaternity($this->certid);
		$data['mydependents'] = $this->wslibrary->getDependents($this->certid);
                
               $data['util'] = $this->wslibrary->getUtilMainList($this->certid);
                $data['util_summary'] = $this->wslibrary->getUtilSummary($this->certid);
                
                $this->load->library('archive');
                $this->archive->addAudit($this->certid,'account','member information','0',$info->AgreementNo);
                    
		$this->maintemp('my_account',$data);
	}
    
        function editprofile(){
            if(isset($_REQUEST['editprofile'])){
                
            }
        }
	function mmi(){
		$data['medinfo'] = $this->wslibrary->getMedInfo($this->certid);
		
		$this->maintemp('med_info',$data);
	}
	
	function mar(){
		$data['inpatient'] = $this->wslibrary->getInpatient($this->certid);
		$data['outpatient'] = $this->wslibrary->getOutpatient($this->certid);
		$data['dental'] = $this->wslibrary->getDentalAvailments($this->certid);
		$data['maternity'] = $this->wslibrary->getMaternity($this->certid);
		
		$this->maintemp('avail_record',$data);
	}
	
	function benefits(){
		$data['info'] = $this->wslibrary->getMembersInfo($this->certid);
		
		$this->maintemp('benefits',$data);
	}

    function changephoto(){
        if(isset($_FILES)){	
            $this->uploader($_FILES);
	}
    }


	function uploader($files){
		//error_reporting(0);
		//$target_dir = dirname($_SERVER["SCRIPT_FILENAME"])."/upload/profile/";
		//$target_dir = $_SERVER["DOCUMENT_ROOT"]."/gateway/upload/profile/";
                $target_dir = $_SERVER["DOCUMENT_ROOT"]."/gateway/upload/profile/";
		$target_file = $target_dir . basename($files["new_photo"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		//$newname = strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
		
                //$newpath = $target_dir.$newname;
                $newname = $_POST['certno'];
                $newpath = $target_dir.$newname.".".$imageFileType;
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($files["new_photo"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
                
		// Check if file already exists
		if (file_exists($newpath)) {
                    chmod($target_dir,0755); //Change the file permissions if allowed
                    unlink($newpath);
			//echo "File will be overwrite.".$newpath."<br>";
			//$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["new_photo"]["size"] > 20000000) {
			echo "* Sorry, your file is too large. Maximum file size allowed is 20MB."."<br>";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "jpeg" ) {
			echo "* Sorry, only JPG, JPEG files are allowed."."<br>";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "* Sorry, your file was not uploaded."."<br>";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($files["new_photo"]["tmp_name"], $newpath)) {

				//$this->model_portal_users->updateImage($this->userid,$newname);
				//echo 'truephiuploaded';                            
			} else {
				echo "* Sorry, there was an error uploading your file."."<br>";
			}
                        //redirect('home'); 
		}
		
	}
	
	

	function getdefendesntsinfo(){ 
		$info = $this->wslibrary->getMembersInfo($_POST['cert']);
		?>
		
              <div class="form-group">
                <label for="" class="col-sm-4"><strong>Last Name:</strong></label>
                <div class="col-sm-6">
                  <?php echo $info->LastName;?>
                </div>      
              </div>
              
              <div class="form-group">
                <label for="" class="col-sm-4"><strong>First Name:</strong></label>
                <div class="col-sm-6">
                  <?php echo $info->FirstName;?>
                </div>      
              </div>

              <div class="form-group">
                <label for="" class="col-sm-4"><strong>Middle Initial:</strong></label>
                <div class="col-sm-6">
                  <?php echo $info->MiddleName;?>
                </div>      
              </div>

              <div class="form-group">
                <label for="" class="col-sm-4"><strong>Gender:</strong></label>
                <div class="col-sm-6">
                  <?php echo $info->Sex;?>
                </div>      
              </div>
              
              <div class="form-group">
                <label for="" class="col-sm-4"><strong>Civil Status:</strong></label>
                <div class="col-sm-6">
                  <?php echo $info->CivilStat;?>
                </div>      
              </div>
              
              <div class="form-group">
                <label for="" class="col-sm-4"><strong>Birth Date:</strong></label>
                <div class="col-sm-6">
                  <?php echo date('M d, Y',strtotime($info->BirthDate));?>
                </div>      
              </div>   		
		
	<?php }

	
		
}


?>