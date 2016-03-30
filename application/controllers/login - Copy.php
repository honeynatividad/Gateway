<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();	
		$this->load->model("model_portal_users");
		$this->load->model("model_portal_admin");
		 $session_data = $this->session->userdata('logged_in');
		 if($session_data){
			 if($session_data['level']==1){
				redirect("admin"); 
			 }else{
			 	redirect("home");
			 }
		 }		
	}

	public function index()
	{
		 //var_dump($this->model_portal_users->ecrpt('P@ssw0rd',md5('philportal')));
		$this->verify();	
	}
	

	 function verify(){

	  
	  ### comment out old login process ###
		
	   $this->load->library('form_validation');
		/*
	   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
		*/
	   //if($this->form_validation->run() == FALSE){
	   if(!isset($_POST['username'])){
		 //Field validation failed.  User redirected to login page
		 	$data['sinfo']=$this->model_portal_admin->siteinfo();
			
			$this->load->view('auth',$data);
			
	   }else{
		
						$username = $this->input->post('username');
						$logpass = $this->input->post('password');	
						$phil = $this->wslibrary->phillogin($username,$logpass);
						
						if($phil->SuccessFlag=='True'){
							
								if($phil->PrepaidCard=='Y'){
									$pa_account = 5;
								}else{
									$pa_account = 6;
								}
								
							
							/*
							# new web service login
							#
							#
							*/
							
							
								 $sess_array = array();
								  $sess_page = array();
								 //var_dump($result);
								 $memdetails = $this->wslibrary->getMembersInfo($phil->CertNo);
								 $fromlocaldb= $this->model_portal_users->getUserDetailsByCertId($phil->CertNo);

								 
								 // end system details
								  $sess_array = array(
									 'user_id' => $fromlocaldb->user_id,
									 'username' => $memdetails->Email,
									 'level'=>$fromlocaldb->user_level,
									 'name'=>$memdetails->FirstName,
									 'certid'=>$phil->CertNo,
									 'prepaid'=>$pa_account,
									 'fullname'=>$memdetails->FirstName." ".$memdetails->LastName
								   );
								
								  $sess_page = array('page_id'=>1);
								  $this->session->set_userdata('logged_in', $sess_array);
								  $this->session->set_userdata('pages', $sess_page);
									//setting cookie
									
									
									
									if($this->input->post('remember')){
									$year = time() + 31536000;
										setcookie('remember_me_username', $_POST['username'], $year);
										setcookie('remember_me_password', $_POST['password'], $year);
										setcookie('remember_me_checked', $_POST['remember'], $year);
									}else{
										setcookie('remember_me_username');
										setcookie('remember_me_password');
										setcookie('remember_me_checked');				
										
									}

					
						//Go to private area
						 
						 $session_data = $this->session->userdata('logged_in');
						 $session_alldata = $this->session->get_userdata();
							 if($session_data['level']==1){
								redirect("admin"); 
							 }else{
								//redirect("home");
								//var_dump($session_data);
							 }		 
						 //redirect('home', 'refresh');
					  }else{
						
						
						// $this->form_validation->set_message('check_database', 'Email address not yet registered');
						
							$data['sinfo']=$this->model_portal_admin->siteinfo();
							$data['error_phil_message'] = $phil->MessageReturn;
							$this->load->view('auth',$data);		
						$this->form_validation->set_message('check_database', $phil->MessageReturn);	
				
					}
	   }

	 }

	 function check_database($password){
	   //Field validation succeeded.  Validate against database
	   $username = $this->input->post('username');
	   $logpass = $this->input->post('password');
	   //query the database
	   //$checkloginusername = $this->model_portal_users->loginusername($username);
	   
	   
	  
		/*
	   if($checkloginusername){
		 $result = $this->model_portal_users->validateuser($username, $password); 
		 if($checkloginusername->login_attempt<4){
			 if($result){ 
				 if($result->is_activated==1){  
				 $this->model_portal_users->updateAttempt($checkloginusername->user_id,0,1);
				 $sess_array = array();
				 //var_dump($result);
				 
				 // system get details 
				 if($result->certNo!=0 || $result->certNo!=''){
					 $getDetailsExist = $this->model_portal_users->getUserDetails($result->user_id);
					 if(!$getDetailsExist){
						$memdetails = $this->wslibrary->getMembersInfo($result->CertNo);
						$this->model_portal_users->insertUserDetailsFromLive($memdetails,$result->user_id);		
					 }
				 }
				 // end system details
				   $sess_array = array(
					 'user_id' => $result->user_id,
					 'username' => $result->username,
					 'level'=>$result->user_level,
					 'name'=>$result->fname,
					 'certid'=>$result->certNo,
					 'prepaid'=>$result->prepaid_access,
					 'fullname'=>$result->fname." ".$result->lname
				   );
				   
				   $sess_page = array('page_id'=>1);
				   $this->session->set_userdata('logged_in', $sess_array);
				   $this->session->set_userdata('pages', $sess_page);
					//setting cookie
					if($this->input->post('remember')){
					$year = time() + 31536000;
						setcookie('remember_me_username', $_POST['username'], $year);
						setcookie('remember_me_password', $_POST['password'], $year);
						setcookie('remember_me_checked', $_POST['remember'], $year);
					}else{
						setcookie('remember_me_username');
						setcookie('remember_me_password');
						setcookie('remember_me_checked');				
						
					}
				 
				 return TRUE;
				 }else{
				 $this->model_portal_users->updateAttempt($checkloginusername->user_id,0,1);
				 $this->form_validation->set_message('check_database', '“Account registered but not yet verified. Click the verification link sent to your email address to finish setting up your account. If you haven’t received any email, please make sure to check your spam mail.”');
				 return false;			 
				 }
			 }else{
				 $this->model_portal_users->updateAttempt($checkloginusername->user_id,($checkloginusername->login_attempt+1),0);				 
				 $count_attempt=(5-($checkloginusername->login_attempt+1));
				 if($count_attempt>1){
				 	$attemps = $count_attempt." attempts remaining.";
				 }else{
					$attemps = $count_attempt." attempt remaining."; 
				 }
				 
				 $this->form_validation->set_message('check_database', 'Username or Password is Incorrect.'." ".$attemps);
				 return false;				
			 }
		 }elseif($checkloginusername->login_attempt==4){
			  $this->model_portal_users->updateAttempt($checkloginusername->user_id,($checkloginusername->login_attempt+1),0);
			 $this->form_validation->set_message('check_database', "<b>Account temporarily blocked</b><br>To help protect your account from fraud or abuse, we might have temporarily blocked it because we noticed some unusual activity. Please provide the email address you've used to register this account and we'll send to you your new password. Or just <a href='#validate_anchor' data-eadd='".$checkloginusername->email."' class='unlockacc'>Click Here.</a>");
			 return false;			 
		 }else{
			 
			 $this->form_validation->set_message('check_database', "<b>Account temporarily blocked</b><br>To help protect your account from fraud or abuse, we have temporarily blocked it because we noticed some unusual activity. Please click the link below and we’ll send to your registered email your new password.</p><br><p><a href='#validate_anchor' data-eadd='".$checkloginusername->email."' class='unlockacc'>Send new password.</a>");
			 return false;			 
		 }
	   }elseif(!$checkloginusername){
		   
		  */
	   		$phil = $this->wslibrary->phillogin($username,$logpass);
			
			if($phil->SuccessFlag=='True'){
				if($phil->PrepaidCard=='Y'){
					$pa_account = 5;
				}else{
					$pa_account = 6;
				}
			/*
			# new web service login
			#
			#
			*/
			
				 $sess_array = array();
				 //var_dump($result);
				 $memdetails = $this->wslibrary->getMembersInfo($phil->CertNo);
				 $fromlocaldb= $this->model_portal_users->getUserDetailsByCertId($phil->CertNo);

				 
				 // end system details
				  $sess_array = array(
					 'user_id' => $fromlocaldb->user_id,
					 'username' => $memdetails->Email,
					 'level'=>$fromlocaldb->user_level,
					 'name'=>$memdetails->FirstName,
					 'certid'=>$phil->CertNo,
					 'prepaid'=>$pa_account,
					 'fullname'=>$memdetails->FirstName." ".$memdetails->LastName
				   );
				 
				   $sess_page = array('page_id'=>1);
				 //  $this->session->set_userdata('logged_in', $sess_array);
				 //  $this->session->set_userdata('pages', $sess_page);
					//setting cookie
					if($this->input->post('remember')){
					$year = time() + 31536000;
						setcookie('remember_me_username', $_POST['username'], $year);
						setcookie('remember_me_password', $_POST['password'], $year);
						setcookie('remember_me_checked', $_POST['remember'], $year);
					}else{
						setcookie('remember_me_username');
						setcookie('remember_me_password');
						setcookie('remember_me_checked');				
						
					}
				 
				 return TRUE;


				/*
				#end webservice login
				#
				#
				*/				
				
				/*
				$memdetails = $this->wslibrary->getMembersInfo($phil->CertNo);
				$newarray = array("BirthDate"=>date('Y-m-d',strtotime($phil->BirthDate)),
				"CertNo"=>$phil->CertNo,
				"DateVerified"=>date('Y-m-d H:m:s',strtotime($phil->DateVerified)),
				"Email"=>$phil->Email,
				"FirstName"=>$phil->FirstName,
				"LastName"=>$phil->LastName,
				"MessageReturn"=>$phil->MessageReturn,
				"RegistrationCode"=>$phil->RegistrationCode,
				"SuccessFlag"=>$phil->SuccessFlag,
				"UserName"=>$phil->UserName);	
				$newarray['password']=$password;
				$newarray['prepaid']=$pa_account;
				
				$id = $this->model_portal_users->insertUserFromLive($newarray);
				$this->newuserportal($id);
				$this->model_portal_users->insertUserDetailsFromLive($memdetails,$id);	
					*/
			


			}else{
			 //$this->form_validation->set_message('check_database', $phil->MessageReturn);
			 $this->form_validation->set_message('check_database', 'Email address not yet registered');
			 return false;			
			}
		 
	   
	  /* }else{
		 $this->form_validation->set_message('check_database', 'Username or email does not exist.');
		 return false;
	   }
	  */
	 }
	 
	 function newuserportal($id){
		 
		 $result = $this->model_portal_users->getUserById($id);
		 $sess_array = array();
		 //var_dump($result);
		 
		   $sess_array = array(
			 'user_id' => $result->user_id,
			 'username' => $result->username,
			 'level'=>$result->user_level,
			 'name'=>$result->fname,
			 'certid'=>$result->certNo,
			 'prepaid'=>$result->prepaid_access,
			 'fullname'=>$result->fname." ".$result->lname,
			 'page_id'=>1
		   );
		   $this->session->set_userdata('logged_in', $sess_array);
		    //setting cookie
			if($this->input->post('remember')){
			$year = time() + 31536000;
				setcookie('remember_me_username', $_POST['username'], $year);
				setcookie('remember_me_password', $_POST['password'], $year);
				setcookie('remember_me_checked', $_POST['remember'], $year);
			}else{
				setcookie('remember_me_username');
				setcookie('remember_me_password');
				setcookie('remember_me_checked');				
				
			}
		 
		 return TRUE;		 
		 
		 
		 
	 }
	 
	function related(){
		$c = curl_init('http://www.philcare.com.ph/webportal.php?type=related');
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt(... other options you want...)
		
		$html = curl_exec($c);
		
		if (curl_error($c))
			die(curl_error($c));
		
		// Get the status code
		$status = curl_getinfo($c, CURLINFO_HTTP_CODE);
		echo $html;
		curl_close($c);	 
	 
	}	 
	
	function phildecoder(){
		echo $this->model_portal_users->dcrpt('c2gzcnlsMHpA1baaf03b9b4e7bff9869edad33dc803d',md5('philportal'));
	}
}
