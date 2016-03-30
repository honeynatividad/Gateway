<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	private $level;
	function __construct(){
		parent::__construct();	
		$this->load->model("model_portal_users");
		$this->load->model("model_portal_admin");
		$this->load->model("model_portal_feedback");
		 $session_data = $this->session->userdata('logged_in');
		 $this->level=$session_data['level'];
		 //var_dump($session_data);
		 if(!$session_data){
			 redirect("login");
		 }
			
	}
	function maintemp($temp,$data){
		$this->load->view('header',$data);
		$this->load->view($temp,$data);
		$this->load->view('footer');
	}
	
	function index(){
            if($this->session->userdata('logged_in'))
            {
              $session_data = $this->session->userdata('logged_in');
              
              $data['username'] = $session_data['username'];
              $renew = array("page_id"=>24);
		$this->session->set_userdata('pages',$renew);	
		$data['countmsg'] = $this->model_portal_admin->countmessages();
		$data['countdl'] = $this->model_portal_admin->countdownloadforms();
                //echo '<pre>';
                //    print_r($session_data);
                //echo '</pre>';
		$this->maintemp('cms/dashboard',$data);		
            }
            else
            {
              //If no session, redirect to login page
              redirect('login', 'refresh');
            }
		
	}
	
	function dlforms(){	
		//page renew
		$renew = array("page_id"=>26);
		$this->session->set_userdata('pages',$renew);	
		if(isset($_REQUEST['newdlbtn'])){
			if($_POST['dl_id']==0){
				$dl = array("dl_name"=>$_POST['dl_name'],"dl_url"=>$_POST['dl_url'],"date_created"=>date('Y-m-d H:s:i'));
				$this->model_portal_admin->insertDlForms($dl);
				redirect("admin/dlformsa");
			}else{
				$dl = array("dl_name"=>$_POST['dl_name'],"dl_url"=>$_POST['dl_url'],"date_created"=>date('Y-m-d H:s:i'));
				$this->model_portal_admin->updatedlId($_POST['dl_id'],$dl);	
				redirect("admin/dlforms");			
				
			}
		}
		$data['dlforms'] = $this->model_portal_admin->selectAllDlLinks();
		$this->maintemp('cms/dlforms',$data);
	}

	function faq(){	
		//page renew
		$renew = array("page_id"=>27);
		$this->session->set_userdata('pages',$renew);	
		if(isset($_POST['submitinfo'])){
			$details = stripslashes($_POST['faq']);
			$this->model_portal_admin->updateinfo(array("faq_info"=>$details));
			redirect("admin/faq");
		}
		
		$data['sinfo']=$this->model_portal_admin->siteinfo();
		$this->maintemp('cms/faq',$data);
	}

	function terms(){	
		//page renew
		$renew = array("page_id"=>27);
		$this->session->set_userdata('pages',$renew);	
		if(isset($_POST['submitinfo'])){
			$details = stripslashes($_POST['terms']);
			$this->model_portal_admin->updateinfo(array("terms_info"=>$details));
			redirect("admin/terms");
		}		
		$data['sinfo']=$this->model_portal_admin->siteinfo();
		$this->maintemp('cms/terms',$data);
	}

	function privacy(){	
		//page renew
		$renew = array("page_id"=>27);
		$this->session->set_userdata('pages',$renew);	
		if(isset($_POST['submitinfo'])){
			$details = stripslashes($_POST['privacy']);
			$this->model_portal_admin->updateinfo(array("privacy_info"=>$details));
			redirect("admin/privacy");
		}		
		$data['sinfo']=$this->model_portal_admin->siteinfo();
		$this->maintemp('cms/privacy',$data);
	}		
	
	function fbslist(){		
		$renew = array("page_id"=>26);
		$this->session->set_userdata('pages',$renew);
			
		if(isset($_POST['fbs_id'])){
			$count = count($_POST['fbs_id']);
			for($i=0;$i<$count;$i++){
				$this->model_portal_feedback->deletebsById($_POST['fbs_id'][$i]);
				
			}
			redirect("admin/fbslist");
		}
		$data['feedback'] = $this->model_portal_feedback->getAllFeedback();
		$this->maintemp('cms/feedback_list',$data);
	}
	
	function feedbyid($id){
		if($this->level==1){
		$data['details'] = $this->model_portal_feedback->getFeedbackById($id);	
		
		}else{
		$data['details'] = '';
		}
		
		$this->maintemp('cms/feed_details',$data);
		
	}
			
	function getdldata(){
		if(isset($_REQUEST['dl_id'])){	
			$dl = $this->model_portal_admin->getDlById($_REQUEST['dl_id']);
			$array=array("dname"=>$dl->dl_name,"durl"=>$dl->dl_url);
			echo json_encode($array);
		}
	}
	
	function deletedl(){
		if(isset($_REQUEST['dl_id'])){
			$this->model_portal_admin->deletedl($_REQUEST['dl_id']);
		}
	}


	function logdesc(){	
		//page renew
		$renew = array("page_id"=>38);
		$this->session->set_userdata('pages',$renew);	
		if(isset($_POST['submitinfo'])){
			$details = stripslashes($_POST['logindesc']);
			$this->model_portal_admin->updateinfo(array("logindesc"=>$details));
			redirect("admin/logdesc");
		}		
		$data['sinfo']=$this->model_portal_admin->siteinfo();
		$this->maintemp('cms/logindesc',$data);
	}


	function regdesc(){	
		//page renew
		$renew = array("page_id"=>38);
		$this->session->set_userdata('pages',$renew);	
		if(isset($_POST['submitinfo'])){
			$details = stripslashes($_POST['regdesc']);
			$this->model_portal_admin->updateinfo(array("regdesc"=>$details));
			redirect("admin/regdesc");
		}		
		$data['sinfo']=$this->model_portal_admin->siteinfo();
		$this->maintemp('cms/regdesc',$data);
	}


	function addrecep(){
		$renew = array("page_id"=>26);
		$this->session->set_userdata('pages',$renew);		
		if(isset($_REQUEST['submit_addrecep'])){
			$event=$this->model_portal_admin->insertnewdepfeed($_POST);
			if($event){
				redirect("admin/viewallrec");
			}
		}
		$data['divisions']= $this->model_portal_admin->getallDivisions();
		$this->maintemp('cms/add_new_dept',$data);		
		
	}

	function viewallrec(){
		$renew = array("page_id"=>26);
		$this->session->set_userdata('pages',$renew);	
		$data['dept']= $this->model_portal_admin->getallDepartments();
		$this->maintemp('cms/departments',$data);					
	}


}


?>