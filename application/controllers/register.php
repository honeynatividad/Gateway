<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	
    function __construct(){
        parent::__construct();	
        $this->load->model("model_portal_users");
        $this->load->model("model_portal_admin");
        $this->load->library('My_PHPMailer');
        $session_data = $this->session->userdata('logged_in');
        if($session_data){
            redirect("home");
        }
        $this->certid=$session_data['certid'];
        $this->agreement = $session_data['agreement_no'];
    }

    function index(){
        
        $this->config->load('recaptcha');
        $this->load->helper('recaptchalib');
        $publickey  = $this->config->item('public_key');
        $privatekey = $this->config->item('private_key');
        $data['provinces'] = $this->model_portal_admin->getAllProvinces();		
        if(isset($_POST['submit'])){
            //$resp = recaptcha_check_answer($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);	
            //if(!$resp->is_valid) {
            //    $this->session->set_flashdata('error','Incorrect Captcha');
            //	$data['recaptcha_html'] = recaptcha_get_html($publickey,null,1);
            //	$this->load->view("registration",$data);
            //	redirect('register');				
            //} else {
            $data['sinfo']=$this->model_portal_admin->siteinfo();

            $memdetails = $this->wslibrary->getMembersInfo($_POST['CertNo']);
            //print_r($memdetails->DateRegistered);
            /*
             * Validating of Cert No and BirthDate
             */
            $certNo = $_POST['CertNo'];
            $toconvert = $_POST['yyyy'].'-'.$_POST['mm'].'-'.$_POST['dd'];
            $bdate_provided = date('m/d/Y',strtotime($toconvert));

            //$reg_checking = $this->wslibrary->checkRegister($certNo,$bdate_provided);
            $validate = $this->wslibrary->validateRegister($certNo,$bdate_provided);
            $check =$this->model_portal_admin->checkAgreement((string)$validate->AgreementNo);
            if($check==1){
                if($validate->SuccessFlag=="True"){
                //validating user
                //check if allowed to register
                     $data['philerror']=false;							
                    $data['info'] = $memdetails;  
                    $memdetails = $this->wslibrary->getMembersInfo($_POST['CertNo']);
                    $data['provinces'] = $this->wslibrary->getCities();
                    $this->load->view("valid_cert_reg",$data);
                
                //teletech go mobile
                }else{
                    $data['error_registration'] = $validate->MessageReturn;
                    $this->load->view("registration",$data);  
                }
               
            }else{
                $data['error_registration'] = "Access to this portal is limited. Please download PhilCare Go!Mobile app on iOS store or Google play to view your PhilCare benefits";
                $this->load->view("registration",$data);
            }
            
            
            //}
        }elseif(isset($_REQUEST['submit_2'])){
            
            $registertoPhilLive = $this->wslibrary->philRegister($_REQUEST);
            if($registertoPhilLive->SuccessFlag=="False"){
                $data['failed_register'] = true;
                $data['message_return'] = $registertoPhilLive->MessageReturn;                            
                $this->load->view("valid_cert_reg",$data);
            }else{
                $data['step3']=true;
                $data['message_success'] = $registertoPhilLive->Message;
                $this->load->view("valid_cert_reg",$data);
                $this->load->library('archive');
                $cert = $session_data['certid'];
                //$this->archive->addAudit($_POST['CertNo'],'register','index','0',$memdetails->AgreementNo);
                $this->archive->addAudit($cert,'register','view','0',$this->agreement);
            }
        } elseif(isset($_REQUEST['resend_email'])){
            $getInfo = $this->wslibrary->getMembersInfo($_REQUEST['CertNo']);
            $_REQUEST['Email'] = $_REQUEST['resend_email'];		
            $_REQUEST['user_id'] = $_REQUEST['user_id'];	
            //call wslibrary -> for resending of verification code
            $this->sendRegsEMail($getInfo,$_REQUEST);								

            $data['step3']=true;
            $data['rsendmail']='Email sent! If you need further assistance, please call our 24/7 Customer Hotline at 63 (2) 461 1800. For outside Metro Manila (toll free for PLDT): 1800 1888 3230';
            $this->load->view("valid_cert_reg",$data);                   
            $this->load->library('archive');
            //$this->archive->addAudit($_POST['CertNo'],'register','resend','0',$getInfo['AgreementNo']);
            $cert = $session_data['certid'];
                //$this->archive->addAudit($_POST['CertNo'],'register','index','0',$memdetails->AgreementNo);
            $this->archive->addAudit($cert,'register','resend','0',$this->agreement);
        }else{
            //$resp = recaptcha_check_answer($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
            $data['recaptcha_html'] = recaptcha_get_html($publickey);
            $this->load->view("registration",$data);			

        }       
    }
    
    function getallDistrict(){
		if(isset($_POST['City'])){
		$distct = $this->wslibrary->getDistrict($_POST['City']);
                
		if($distct){
			$random = rand(1, 115);
		?>

                    <div class="metro open">
                        <select class="form-control" data-settings='{"cutOff":10}' id="dsctval<?php echo $random;?>" name="Province">
                        <option value="0" class="label">DISTRICT/CITY</option>
                        <?php
							foreach($distct as $p){
								$namespaces = $distct->getNameSpaces(true);
								$list = $p->children($namespaces['a']);
									foreach($list as $li){
									$prov = $li->children($namespaces['a']);
							?>
							<option value="<?php echo urlencode($prov->District);?>"><?php echo $prov->District;?></option>
                            <?php }}?>
                        </select>
                        <label class="control-label">Region</label>
                    </div>
                     <script>
					 $(document).ready(function(){
							$(".loaderphil").hide(); 
                                                        
                                                        
					 });
					 </script>
		<?php	}else{
					echo "error";
				}
		}
	}
    
    function index_original(){
        $this->config->load('recaptcha');
		$this->load->helper('recaptchalib');
		$publickey  = $this->config->item('public_key');
		$privatekey = $this->config->item('private_key');
		$data['provinces'] = $this->model_portal_admin->getAllProvinces();		
		if(isset($_POST['submit'])){
			$certlocalchecker = $this->model_portal_users->checkCurrentCertId($_POST['CertNo']);
			
			if(!$certlocalchecker){
				$resp = recaptcha_check_answer($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);	
				if(!$resp->is_valid) {
					$this->session->set_flashdata('error','Incorrect Captcha');
					$data['recaptcha_html'] = recaptcha_get_html($publickey,null,1);
					$this->load->view("registration",$data);
					redirect('register');				
				} else {
					$data['sinfo']=$this->model_portal_admin->siteinfo();
					$memdetails = $this->wslibrary->getMembersInfo($_POST['CertNo']);
					
					if(!empty($memdetails->CertNo)){
						$toconvert = $_POST['yyyy'].'-'.$_POST['mm'].'-'.$_POST['dd'];
						$bdate_provided = date('Y-m-d',strtotime($toconvert));
						$webservicedbate = date('Y-m-d',strtotime($memdetails->BirthDate));
						//var_dump($toconvert." ".$webservicedbate);
						if($bdate_provided==$webservicedbate){
							$data['philerror']=false;
							
							$data['info'] = $memdetails;
							$this->load->view("valid_cert_reg",$data);	
						}else{
							$this->session->set_flashdata('error','Certificate number  and birthdate did not match!');
							$resp = recaptcha_check_answer($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
							$data['recaptcha_html'] = recaptcha_get_html($publickey,null,1);
							$this->load->view("registration",$data);
							redirect('register');	
						}
					}else{
						/*$data['philerror']=true;
						$this->load->view("valid_cert_reg",$data);
						*/
						$this->session->set_flashdata('error','Certificate number is invalid!');
						$resp = recaptcha_check_answer($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
						$data['recaptcha_html'] = recaptcha_get_html($publickey,null,1);
						$this->load->view("registration",$data);
						redirect('register');						
					
					}
				}
			}else{
				$this->session->set_flashdata('error','Certificate Already Registered!');
				$resp = recaptcha_check_answer($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
				$data['recaptcha_html'] = recaptcha_get_html($publickey,null,1);
				$this->load->view("registration",$data);
				redirect('register');	
			}
			
			//var_dump($this->recaptcha->getIsValid());
			/* temporary include this here. inside valid captcha */

		}elseif(isset($_REQUEST['submit_2'])){
			
			$registertoPhilLive = $this->wslibrary->philRegister($_REQUEST);
		
		//if($registertoPhilLive->SuccessFlag=="True"){
				
			/*	
				$getInfo = $this->wslibrary->getMembersInfo($_REQUEST['CertNo']);
				
				if(isset($getInfo->PrepaidCard)){
					if($getInfo->PrepaidCard=='Y'){
						$pa_account = 5;
					}else{
						$pa_account = 6;
					}
				}else{
					$pa_account = 6;
				}
				
				$newarray = array("BirthDate"=>date('Y-m-d',strtotime($_REQUEST['BirthDate'])),
				"CertNo"=>$_REQUEST['CertNo'],
				"Email"=>$_REQUEST['Email'],
				"FirstName"=>$_REQUEST['FirstName'],
				"LastName"=>$_REQUEST['LastName'],
				"UserName"=>isset($_REQUEST['Username'])?$_REQUEST['Username']:'');
				$newarray['password']=$_REQUEST['Password'];
				$newarray['DateVerified']=$getInfo->DateVerified;
				$newarray['prepaid']=$pa_account;
				
				$duplicate_check = $this->model_portal_users->checkemail($_REQUEST['Email']);
				if(!$duplicate_check){
					$id = $this->model_portal_users->insertUserFromLive($newarray);
					$_REQUEST['user_id']=$id;
					$_REQUEST['Address']=trim($_REQUEST['HouseNo']." ".$_REQUEST['Street']." ".$_REQUEST['Subdivision']." ".$_REQUEST['City']." ".$_REQUEST['Province']." ".$_REQUEST['Zipcode']);
					$object = json_decode(json_encode($_REQUEST), FALSE);
					
					$inserted_user_details_id=$this->model_portal_users->insertUserDetailsFromLive($object,$id);
					$_REQUEST['user_id']=$id;
					//send mail
					$this->sendRegsEMail($getInfo,$_REQUEST);								
				}

				*/
				
			$data['step3']=true;
			$this->load->view("valid_cert_reg",$data);
			
		}elseif(isset($_REQUEST['resend_email'])){
			$getInfo = $this->wslibrary->getMembersInfo($_REQUEST['CertNo']);
			$_REQUEST['Email'] = $_REQUEST['resend_email'];		
			$_REQUEST['user_id'] = $_REQUEST['user_id'];	
			$this->sendRegsEMail($getInfo,$_REQUEST);								
			
			$data['step3']=true;
			$data['rsendmail']='Email sent! If you need further assistance, please call our 24/7 Customer Hotline at 63 (2) 461 1800. For outside Metro Manila (toll free for PLDT): 1800 1888 3230';
			$this->load->view("valid_cert_reg",$data);			
			
		}else{
			//$resp = recaptcha_check_answer($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
			$data['recaptcha_html'] = recaptcha_get_html($publickey);
			$this->load->view("registration",$data);			
			
		}
		
    }
	
	
    function sendRegsEMail($info,$post){
        $to=$post['Email'];
        //$to = 'jayrabang2@gmail.com';
        $subject='PhilCare Individual Portal Registration';
        if($info->Sex=='MALE'){
                $data['name'] = 'MR. '.$info->LastName;
        }else{
                $data['name'] = 'MS. '.$info->LastName;
        }
        $data['username']=$post['Email'];
        $data['password']=$post['Password'];

        $data['hash']='UEBzc3cwcmQ'.$post['user_id'];

        $message=$this->wslibrary->mail_register($data);
        $this->send_mail($to,$subject,$message);
    }

	/*
	function onBoardEmail($info,$post){
		$to=$post['Email'];
		//$to = 'jayrabang2@gmail.com';
		$subject='PhilCare Individual Portal Registration';
		if($info->Sex=='MALE'){
			$data['name'] = 'MR. '.$info->LastName;
		}else{
			$data['name'] = 'MS. '.$info->LastName;
		}
		$data['username']=$post['Email'];
		$data['password']=$post['Password'];
		$data['hash']='UEBzc3cwcmQ'.$post['user_id'];
		$message=$this->wslibrary->mail_register_confirmation($data);
		$this->send_mail($to,$subject,$message);
	}
	*/
	
	
    public function send_mail($to,$subject,$message) {
        $mail = new PHPMailer();	
        $mail->SMTPAuth   = false; 
        $mail->SMTPSecure = "ssl"; 
        $mail->Host       = 'smtp.philcare.com.ph'; 
        $mail->Port       = 25; 
        $mail->Username   = 'advisory@philcare.com.ph'; 
        $mail->Password   = 'P@ssw0rd'; 
        $mail->SetFrom('advisory@philcare.com.ph','PhilCare Advisory');  
        $mail->IsHTML(true);
		$mail->Subject    = $subject;
		$msg =$message;
        $mail->Body = $msg;
        //$mail->AltBody    = "Plain text message";
        $destino = $to; 
        $mail->AddAddress($destino);

        if(!$mail->Send()) {
            $data["message"] = "Error: " . $mail->ErrorInfo;
        } else {
            $data["message"] = "Message sent correctly!";
        }
		
		return json_encode($data);
    }	
	
	
	
    function checkusername(){
        if(isset($_POST['username'])){
            $name = $this->model_portal_users->checkusername_newchecker($_POST['username']);
            if($name){
                    echo json_encode(array('status'=>'true'));
            }else{
                    echo json_encode(array('status'=>'false'));
            }
        }
    }
    
    function verify(){
        $certNo = $_GET['Certno'];
        $username = $_GET['UserName'];
        $registrationCode = $_GET['RegistrationCode'];
        $memdetails = $this->wslibrary->getMembersInfo($certNo);
        
        $data['check'] = $this->wslibrary->verifyUser($certNo,$username,$registrationCode,$memdetails->AgreementNo);
        $cert = $session_data['certid'];
                //$this->archive->addAudit($_POST['CertNo'],'register','index','0',$memdetails->AgreementNo);
		$this->archive->addAudit($cert,'register','verify','0',$this->agreement);

        $this->load->view("verified",$data);	
    }
    
    function resend(){
        /*
         * certno
         * 
         */
        
    }
	
}


?>