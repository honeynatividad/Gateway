<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Audit extends CI_Controller {
    
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
        $data['username'] = $session_data['username'];	
		//page renew
        $renew = array("page_id"=>89);
        $this->session->set_userdata('pages',$renew);
    }
    
    function index(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            
            if($session_data['level']==1){
                $data['audits'] = $this->model_portal_admin->getAudit();
            }
        }
    }
    
    
    function activate(){
        
    }
    
    function deactivate(){
        
    }
    
    function download(){
        
    }
}