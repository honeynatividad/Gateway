<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verify extends CI_Controller {
	
	function __construct(){
		parent::__construct();	
		$this->load->model("model_portal_users");
		$this->load->library('My_PHPMailer');
	}
	
	function index(){
		if(isset($_REQUEST['hash'])){
			$hash = $_REQUEST['hash'];
			$explode = explode('UEBzc3cwcmQ',$hash);
			$data['one'] = $explode[1];
			if(isset($explode[1])){
			$this->model_portal_users->activateuser($explode[1]);
			$userdetails = $this->model_portal_users->getUserDetails($explode[1]);
			$this->sendRegsEMail2($userdetails);
			}
			$this->load->view("verified",$data);
		}elseif(isset($_REQUEST['unlock'])){
			$hash = $_REQUEST['unlock'];
			$explode = explode('UEBzc3cwcmQ',$hash);
			$data['one'] = $explode[1];
			if(isset($explode[1])){
			$this->model_portal_users->updateAttempt($explode[1],0,1);
			}
			$this->load->view("activation",$data);		
		}else{
			redirect("home");
		}
		
	}
	
	
	function sendRegsEMail2($info){
		//$to=$info->Email;
		if(!empty($info->email)){
		$to = $info->email;
		$data['name'] = $info->lastname;
		$data['email'] = $info->email;
		$data['firstname'] = $info->firstname;
		}else{
		$to = '';
		$data['name'] = '';		
		$data['email'] = '';
		$data['firstname'] = '';			
		}
		$subject='PhilCare Individual Portal Registration';
		/*if($info->sex=='MALE'){
			$data['name'] = 'MR. '.$info->lastname;
		}else{
			$data['name'] = 'MS. '.$info->lastname;
		}
		*/
		
		$message=$this->wslibrary->mail_register_confirmation($data);
		$this->send_mail2($to,$subject,$message);
	}
	
	
	
    public function send_mail2($to,$subject,$message) {
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
		
}


?>