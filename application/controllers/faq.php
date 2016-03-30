<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {
	
	function __construct(){
		parent::__construct();	
		$this->load->model("model_portal_users");
		$this->load->model("model_portal_admin","admin");
		 $session_data = $this->session->userdata('logged_in');
		 if(!$session_data){
			 redirect("login");
		 }
		 $data['username'] = $session_data['username'];	
		//page renew
		$renew = array("page_id"=>78);
		$this->session->set_userdata('pages',$renew);	
	}
	function maintemp($temp,$data){
		$this->load->view('header',$data);
		$this->load->view($temp,$data);
		$this->load->view('footer');
	}
	
    function index(){
        $renew = array("page_id"=>78);
        $session_data = $this->session->userdata('logged_in');
        if($session_data['level']==1){
            $data['username'] = $session_data['username'];        
            $this->session->set_userdata('pages',$renew);			
            $id = $session_data['agreement_no'];
            $data['agreement_no'] = $id;        

            $data['title']='FAQ';
            //$data['page_content']=$this->admin->siteinfo()->faq_info;		
            $data['page_content'] = $this->admin->getFAQ();

            $this->maintemp('faq',$data);
        }else{
            $id = $session_data['agreement_no'];
            $data['faq']    = $this->admin->getFAQID($id);
            $this->maintemp('cms/faq_view',$data);
        }
        
    }
    
    function create_faq(){
        $renew = array("page_id"=>78);
        $this->session->set_userdata('pages',$renew);	

        if(isset($_REQUEST['submitnews'])){
                $data = array(			                
                "content"=>$_POST['description'],
                "status" => 1,                
                "agreement_no" => $_POST['agreement_no']
                );
                $event=$this->admin->insertFAQ($data);
                if($event){
                    $session_data = $this->session->userdata('logged_in');
                $this->load->library('archive');
                $this->archive->addAudit($session_data['user_id'],'faq','create','1');
                        redirect("faq/");
                }
        }
        $session_data = $this->session->userdata('logged_in');
              
        $data['username'] = $session_data['username'];
        $renew = array("page_id"=>78);
        $this->session->set_userdata('pages',$renew);			
        $id = $session_data['agreement_no'];
        $data['agreement_no'] = $id;        
        $check = $this->admin->checkFAQ($id);
        
        if($check==1){
            redirect("faq/edit_faq");            
        }else{
            $this->maintemp('cms/create_faq',$data);
        }
	
    }
    
    function edit_faq(){
        $data = array();
        //$id = $this->uri->segment(3);
        $session_data = $this->session->userdata('logged_in');        
        $id = $session_data['agreement_no'];
        $data['agreement_no'] = $id;
        $data['result'] = $this->admin->getFAQActive($id);
        
        
        $this->maintemp('cms/edit_faq',$data);        
        if(isset($_REQUEST['submitnews'])){
            $data = array(			                
		"content"=>$_POST['description'],     
                "agreement_no" => $_POST['agreement_no']
			);
            $this->admin->FAQUpdate($id,$data);
            $session_data = $this->session->userdata('logged_in');
                $this->load->library('archive');
                $this->archive->addAudit($session_data['user_id'],'faq','edit','1');
            redirect("faq");
        }
    }
    
    function delete_faq(){
        $session_data = $this->session->userdata('logged_in');        
        $id = $session_data['agreement_no'];
        $data['agreement_no'] = $id;
        $data['result'] = $this->admin->deleteFAQ($id);
        $session_data = $this->session->userdata('logged_in');
                $this->load->library('archive');
                $this->archive->addAudit($session_data['user_id'],'faq','delete','1');
        $this->session->set_flashdata('msg', 'You successfully deleted '.$id.' FAQ');
        $this->maintemp('cms/create_faq',$data);       
    }
    
    function faq_view(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            
            if($session_data['level']==1){
                $id = $this->uri->segment(3);
                $data['faq'] = $this->admin->getFAQData($id);
                $this->maintemp('cms/faq_view',$data);
            }else{
                redirect('login','refresh');
            }
        }
    }
    
    function delete(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            
            if($session_data['level']==1){
                $id = $this->uri->segment(3);
                $del = $this->admin->faqDelete($id);
                $session_data = $this->session->userdata('logged_in');
                $this->load->library('archive');
                $this->archive->addAudit($session_data['user_id'],'faq','delete','1');
                $this->session->set_flashdata('msg', 'FAQ was deleted');
                redirect('faq/faq');
            }
        }
    }
    

	
}


?>