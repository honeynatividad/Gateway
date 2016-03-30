<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends CI_Controller {
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
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $renew = array("page_id"=>100);
            $this->session->set_userdata('pages',$renew);	
            $data['modules'] = $this->model_portal_admin->getAllModule();
            $this->maintemp('cms/module', $data);
	
        }else{
            redirect('login', 'refresh');
        }
    }
    
    function add(){
        $renew = array("page_id"=>100);
        $this->session->set_userdata('pages',$renew);		
        //$this->load->view('upload_form', array('error' => ' ' ));
        $session_data = $this->session->userdata('logged_in');
        if($session_data['level']==1){
            
            $data['logo'] = $this->model_portal_admin->getAllUserActive();
            $this->maintemp('cms/create_module',$data);
        }else{
            redirect("login","refresh");
        }
        
        if(isset($_REQUEST['upload'])){
            $data = array(
                "agreement_no"          =>  $_POST['agreement_no'],
                "newsfeed"              =>  $_POST['newsfeed'],
                "provider"              =>  $_POST['provider'],
                "ecu"                   =>  $_POST['ecu'],
                "reimbursement"         =>  $_POST['reimbursement'],
                "status"                =>  1
            );
            $insert = $this->model_portal_admin->insertModule($data);
            $this->load->library('archive');
            $this->archive->addAudit($session_data['user_id'],'module','add',$session_data['agreement_no'],1);
            $this->session->set_flashdata('success', "You successfully added a new module");
            redirect('module');
        }
        
        
    }
    
    function edit(){
        $data = array();
        $id = $this->uri->segment(3);
        $data['module_id'] = $id;
        $data['result'] = $this->model_portal_admin->getModule($id);
        
        $this->maintemp('cms/edit_module',$data);        
        if(isset($_REQUEST['upload'])){
            $data = array(			
                "newsfeed"              =>  $_POST['newsfeed'],
                "provider"              =>  $_POST['provider'],
                "ecu"                   =>  $_POST['ecu'],
                "reimbursement"         =>  $_POST['reimbursement']
			);
            $id = $_POST['module_id'];
            $this->model_portal_admin->updateModule($id,$data);
            redirect("module");
        }    
    }
    
    function activate(){
        $id = $this->uri->segment(3);        
        $page=$this->model_portal_admin->activateModule($id);
        if($page){
            redirect(base_url("module"));
        }else{
            redirect(base_url("module"));
        }
    }
    
    function deactivate($id){
        $id = $this->uri->segment(3);        
        $page=$this->model_portal_admin->deactivateModule($id);
        if($page){
            redirect(base_url("module"));
        }else{
            redirect(base_url("module"));
        }
    }    
}