<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
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
            $renew = array("page_id"=>68);
            $this->session->set_userdata('pages',$renew);	
            $data['pages'] = $this->model_portal_admin->getAllPages();
            $this->maintemp('cms/pages', $data);
	
        }else{
            redirect('login', 'refresh');
        }
    }
    
    function add(){
        
    }
    
    function edit(){
        $data = array();
        $id = $this->uri->segment(3);
        $data['result'] = $this->model_portal_admin->getPage($id);
        
        $this->maintemp('cms/edit_page',$data);        
        if(isset($_REQUEST['submitnews'])){
            $data = array(			
                "page_name" =>  $_POST['page_name'],
		"page_level"=>  $_POST['page_level']
			);
            $this->model_portal_admin->pageUpdate($id,$data);
            redirect("pages");
        }    
    }
    
    function activate(){
        $id = $this->uri->segment(3);        
        $page=$this->model_portal_admin->activatePage($id);
        if($page){
            redirect(base_url("pages"));
        }else{
            redirect(base_url("pages"));
        }
    }
    
    function deactivate($id){
        $id = $this->uri->segment(3);        
        $page=$this->model_portal_admin->deactivatePage($id);
        if($page){
            redirect(base_url("pages"));
        }else{
            redirect(base_url("pages"));
        }
    }    
}