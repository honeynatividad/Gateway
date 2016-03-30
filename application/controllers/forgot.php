<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot extends CI_Controller {
	
	function __construct(){
		parent::__construct();	
		$this->load->model("model_portal_users");
		$this->load->library('My_PHPMailer');
		 $session_data = $this->session->userdata('logged_in');
		 if($session_data){
			 redirect("home");
		 }
	}
	
    function index(){
		
	if(isset($_POST['submit'])){
            //call wslibrary -> forgot password
            /*
             * ask for email address or certno
             */
            $email = $_POST['email'];
            $check = $this->wslibrary->forgotPassword($email);
            $data['msg'] = $check->MessageReturn;
            $data['error']=false;
        
      
	}else{
            $data['error']=false;
            $data['msg']=false;
        }
        $this->load->view("forgot",$data);
    }

	function eunlock(){
		
		if(isset($_POST['acc_email'])){
			$check = $this->model_portal_users->checkemail($_POST['acc_email']);
			
			if($check){
				$data['error']=false;
				$data['msg']='Successful!';
				//$info['password'] = $this->model_portal_users->dcrpt($check->password,md5('philportal'));
				$newpass = $this->generateRandomString(8);
				$info['password'] = $newpass;
				$info['username'] = $check->email;
				$info['uname'] = $check->username;
				$info['name'] = $check->fname." ".$check->lname;
				$info['fname'] =$check->fname; 
				$info['hash']='UEBzc3cwcmQ'.$check->user_id;
				$msg_body = $this->wslibrary->account_unlocker($info);
				$this->model_portal_users->updatepass($check->user_id,$newpass);
				$this->sendUnlocktMail($check->email,$msg_body);
			}else{
				$data['error']=true;
				$data['msg']='unsuc!';
			}
		}
		
				
	}

	
	function sendForgotMail($email,$message){
		$to=$email;
		//$to = 'jayrabang2@gmail.com';
		$subject='MyPhilCare: Forgot Username/Password';
		$this->forgot_send_mail($to,$subject,$message);
	}
	
	function sendUnlocktMail($email,$message){
		$to=$email;
		//$to = 'jayrabang2@gmail.com';
		$subject='MyPhilCare: Unlock Account';
		$this->forgot_send_mail($to,$subject,$message);
	}	
		
    public function forgot_send_mail($to,$subject,$message) {
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
        $mail->AltBody    = "Plain text message";
        $destino = $to; 
        $mail->AddAddress($destino);

        if(!$mail->Send()) {
            $data["message"] = "Error: " . $mail->ErrorInfo;
        } else {
            $data["message"] = "Message sent correctly!";
        }
		
		return json_encode($data);
    }	

	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}	

}


?>