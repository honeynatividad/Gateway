<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct(){
        parent::__construct();	
        $this->load->model("model_portal_users");
        $this->load->model("model_portal_admin");
        //$session_data['level']=1;
         $session_data = $this->session->userdata('logged_in');
         
         if($session_data){
             if($session_data['level']==1 || $session_data['level']==2 ){
                redirect("admin"); 
             }else{
                redirect("home");
             }
            if($session_data['hra']==1){
                redirect("hra");
            } 
         }		
    }
    function index(){
        
        $this->verify();
         
    }
    
    function verify(){
        
        $this->load->library('form_validation');
 
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        if($this->form_validation->run($this) == FALSE){
          //Field validation failed.  User redirected to login page
          $data['sinfo']=$this->model_portal_admin->siteinfo();
             $this->load->view('auth',$data);
        }else{
            $session_data = $this->session->userdata('logged_in');
            if($session_data['level']==1 || $session_data['level']==2 ){
                redirect("admin"); 
            }elseif($session_data['hra']==1){
                redirect("hra");
            }else{             
                redirect("home");
            }
        }
    }
    
    function check_database($password) {
   //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');
        $logpass = $this->input->post('password');
 
   //query the database
        $result = $this->model_portal_users->isAdmin($username);
  
        if($result){
            $sess_array = array();
     //foreach($result as $row)
     //{    
            $get_user_id = $this->model_portal_users->loginusername($username);
            $user_id =  $get_user_id->user_id;
            $check_password = $this->model_portal_users->getpassifCorrect($user_id,$password);
            if($check_password){
                $sess_array = array(
                    'level' => $result->user_level,
                    'user_id' => $get_user_id->user_id,
                    'username' => $get_user_id->username,
                    'name' => $get_user_id->username,
                    'fullname' => $get_user_id->username,
                    'agreement_no' => $get_user_id->agreement_no,
                    'certid' => ""
                );  
                $this->session->set_userdata('logged_in', $sess_array);
                $this->load->library('archive');
                $this->archive->addAudit($user_id,'login','index','1',$get_user_id->agreement_no);
                return TRUE;
            }else{
                return FALSE;
            }
            //$check_password = $this->model_portal_users->getpassifCorrect();
     //} 
        }else{
            $phil = $this->wslibrary->phillogin($username,$logpass);
            if($phil){
                if($phil->SuccessFlag=='True'){
                    if($phil->PrepaidCard=='Y'){
                            $pa_account = 5;
                    }else{
                            $pa_account = 6;
                    }

                    $memdetails = $this->wslibrary->getMembersInfo($phil->CertNo);
                    
                    $check_member = $this->model_portal_admin->checkMember($memdetails->AgreementNo);
                    $check_login = $this->model_portal_admin->checkAgreement($memdetails->AgreementNo);
                    $agreement = (string)$memdetails->AgreementNo;
                    if((string)$memdetails->CertNo=="A02DIC0"){
                        $check_login = 1;
                        
                    }
                    if((string)$memdetails->CertNo=="5443460"){
                        $check_login = 1;
                        $agreement = "PC10889";
                    }
                    if((string)$memdetails->CertNo=="7346920"){
                        $check_login = 1;
                        $agreement = "PC10945";
                    }
                    if((string)$memdetails->CertNo=="9999999"){
                        $check_login = 1;
                        $agreement = "PC10889";
                    }
                    if((string)$memdetails->CertNo=="A04HRV0"){
                        $check_login = 1;
                        $agreement = "PC10889";
                    }
                    if((string)$memdetails->CertNo=="A03WOL0"){
                        $check_login = 1;
                        $agreement = "PC10889";
                    }
                    //print_r("agreement "+$agreement);
                    $check_hra = $this->model_portal_admin->checkHRA($agreement);
                    $hra = 0;
                    if($check_login==1){                        
                        if($check_hra==1 && $check_member==0){
                            $hra = 1;                            
                        }elseif($check_hra==1 && $check_member==1){
                            $hra = 2;
                        }elseif($check_hra==0 && $check_member==1){
                            $hra = 0;
                        }                        
                        
                        $newarray = array("BirthDate"=>date('Y-m-d',strtotime($phil->BirthDate)),
                            "CertNo"=>$phil->CertNo,
                            "DateVerified"=>date('Y-m-d H:m:s',strtotime($phil->DateVerified)),
                            "Email"=>$phil->Email,
                            "FirstName"=>$phil->FirstName,
                            "LastName"=>$phil->LastName,
                            "MessageReturn"=>$phil->MessageReturn,
                            "RegistrationCode"=>$phil->RegistrationCode,
                            "SuccessFlag"=>$phil->SuccessFlag,
                            "UserName"=>$phil->UserName,
                            "MemberType"=>$phil->MemberType,
                            "MemberClassification"=>$phil->MemberClassification);	
                        $newarray['password']=$password;
                        $newarray['prepaid']=$pa_account;

                        $sess_array = array();

                        $cert_no = (string)$memdetails->CertNo;
                        $user_name = (string)$phil->UserName;
                        $first_name = (string)$phil->FirstName;
                        $fullname = (string)$phil->FirstName." ".$phil->LastName;
                        $sess_array = array(
                            'user_id' => $cert_no,
                            'username' => $user_name,
                            'level'=> 3,
                            'name'=>$first_name,
                            'certid'=>$cert_no,
                            'prepaid'=>" ",
                            'fullname'=>$fullname,
                            'page_id'=>1,
                            'agreement_no' => $agreement,
                            'hra' => $hra,
                            'MemberCertNo' => (string)$phil->CertNo,
                            'FirstName' => (string)$memdetails->FirstName,
                            'LastName' => (string)$memdetails->LastName,
                            'MiddleInitial' => (string)$memdetails->MiddleName,
                            'PolicyNo' => (string)$memdetails->PolicyNo,
                            'EmailAdd' => (string)$memdetails->Email,
                            'MemberType'    => (string)$memdetails->MemberType,
                            'APEECU'  => (string)$memdetails->APEECU,
                            'ContactNo' => (string)$memdetails->ContactNumber,
                            'MemberClassification' => (string)$memdetails->MemberClassification
                        );                    

                        $this->session->set_userdata('logged_in', $sess_array);                        
                        
                        $this->load->library('archive');
                        $this->archive->addAudit($memdetails->CertNo,'login','index','0',$memdetails->AgreementNo,$phil->FirstName,$phil->LastName);
                        
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
                    }else{
                        $this->form_validation->set_message('check_database', 'Access to this portal is limited. Please download PhilCare Go!Mobile app on iOS store or Google play to view your PhilCare benefits.');
                        return false;
                    }
                }else{
                   $r = $phil->MessageReturn;
                  
                   if (strpos($r,'Your account is not yet verified') !== false) {
                       
                       $this->form_validation->set_message('check_database', "".$phil->MessageReturn." Or request to <a href='".base_url('login/resend')."'> resend </a> verification code");
                    }else{
                        
                        $this->form_validation->set_message('check_database', $phil->MessageReturn);
                    }
                 
                 //$this->form_validation->set_message('check_database', 'Email address not yet registered');
                 return false;			
                }
		 //$this->load->view('resend',$data);	
	   }else{
		 $this->form_validation->set_message('check_database', 'Username or email does not exist.');
		 return false;
	   }
        }
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

         return true;		
    }
    
    public function resend(){
        $data['sinfo']=$this->model_portal_admin->siteinfo();
         
         if(isset($_POST['submit'])){
             $email = $_POST['email'];
             $phil = $this->wslibrary->resendVerification($email);
            // if($phil){
                    $data['msg'] = $phil->MessageReturn;
                    $data['error']=false;
                    $this->load->view('resend',$data);
                 //redirect('login');
                 //print_r($phil->MessageReturn);
            // }
         }else{
             $data['msg'] = "";
        $data['error']=false;
         $this->load->view('resend',$data);
         
         }
    }
    
}