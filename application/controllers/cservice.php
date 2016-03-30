<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cservice extends CI_Controller {
	private $uid;
	
	function __construct(){
		parent::__construct();	
		$this->load->model("model_portal_users");
		$this->load->model("model_portal_admin");
		$this->load->model("model_portal_feedback","fb");
		$this->load->library('My_PHPMailer');
		 $session_data = $this->session->userdata('logged_in');
		 if(!$session_data){
			 redirect("login");
		 }
		 $data['username'] = $session_data['username'];	
		 $this->uid = $session_data['user_id'];
		//page renew
		$renew = array("page_id"=>9);
		$this->session->set_userdata('pages',$renew);	
	}
	function maintemp($temp,$data){
		$this->load->view('header',$data);
		$this->load->view($temp,$data);
		$this->load->view('footer');
	}
	
	function index(){
		$data['dlforms'] = $this->model_portal_admin->selectAllDlLinks();
		$this->maintemp('dlforms',$data);
	}
	
	function feedback(){
		if(isset($_REQUEST['fbbtn'])){			
			$user = $this->model_portal_users->getUserDetails($this->uid);
		
			if($_POST['subject']==1){
				$subj = 'Benefit Coverage & Availment';
				$div = $this->fb->getallDepartmentsByDivId(3);			
			}elseif($_POST['subject']==2){
				$subj = 'Reimbursement & Claims';
				$div = $this->fb->getallDepartmentsByDivId(2);
			}elseif($_POST['subject']==3){
				$subj = 'Complaints & Compliments';
				$div = $this->fb->getallDepartmentsByDivId(1);
			}elseif($_POST['subject']==4){
				$subj = 'Suggestions';
				$div = $this->fb->getallDepartmentsByDivId(1);
			}elseif($_POST['subject']==5){
				$subj = 'Go!Mobile and Website/Portal';
				$div = $this->fb->getallDepartmentsByDivId(1);
			}else{
				$subj = 'Others';
				$div = $this->fb->getallDepartmentsByDivId(1);
			}

			$info=array();
			$info['subject']=$subj;
			$info['message']=$_POST['comment'];
			$info['name']=$user->firstname;
			$info['comapany']=$user->company_name;
			$info['contact']=$_POST['contact'];
			$info['email']=$user->email;			
			foreach($div as $dddd){
				$msg_body = $this->wslibrary->internal_email($info);
				
				$this->sendMailer($subject,$dddd->dep_email,$msg_body);
				
				
			}
			$_POST['newsub']=$subj;
			$msg_body2 = $this->wslibrary->auto_email($info);
			$this->sendMailer($subj,$user->email,$msg_body2);
			$this->fb->insertFeedbak($_POST);		
			$this->session->set_flashdata('flashnoti', 'Send Successfully.');
			echo "<script>alert('Message Sent'); location.href='".base_url("cservice/feedback")."';</script>";
			//redirect("cservice/feedback");
		}
		$this->maintemp('feedback',array());
	}
	
	function lar(){
		
		$this->maintemp('lar',array());
	}

	function card(){
		
		$this->maintemp('card',array());
	}

	function replacement(){
		
		$this->maintemp('rep_card',array());
	}	

	function sendMailer($subject,$email,$message){
		$to=$email;
		//$to = 'jayrabang2@gmail.com';
		$subject='MyPhilCare: '.$subject;
		$this->email_sender($to,$subject,$message);
	}
	
    public function email_sender($to,$subject,$message) {
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
        $mail->AltBody    = "";
        $destino = $to; 
		$thecc = $this->fb->cclist();
		foreach($thecc as $c){
			$mail->AddCC =($c->dep_email);
		}
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