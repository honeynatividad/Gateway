<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    private $user;
    private $certid;
    function __construct(){
        parent::__construct();	
        $this->load->helper(array('form', 'url'));
        
        $this->load->model("model_portal_users");
        $this->load->model("model_portal_admin");
        $this->load->model("model_portal_feedback");
        $session_data = $this->session->userdata('logged_in');
        $this->level=$session_data['level'];
        if(!$session_data){            
            redirect("login");
        }
        
        if($session_data['level']!=1){
           redirect("admin");
        }        
        $data['username'] = $session_data['username'];	
		//page renew
        $renew = array("page_id"=>58);
        $this->session->set_userdata('pages',$renew);

    }
    
    function maintemp($temp,$data){
        $this->load->view('header',$data);
        $this->load->view($temp,$data);
        $this->load->view('footer');
    }
    
    public function index(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            
            if($session_data['level']==1){
                $data['username'] = $session_data['username'];
                $renew = array("page_id"=>58);
                $this->session->set_userdata('pages',$renew);			
                $data['users'] = $this->model_portal_admin->getAllUser();
                //$test = $this->model_portal_admin->testInsert();
                //$test = $this->model_portal_admin->testModel();    
                //echo '<pre>';
               // print_r($test);
                //echo '</pre>';
                
                $this->maintemp('cms/user',$data);	
            }else{
                redirect('login', 'refresh');
            }
              
            	
        }else{
              //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
    function add(){
        $renew = array("page_id"=>58);
        $this->session->set_userdata('pages',$renew);		
	if(isset($_REQUEST['submitnews'])){
            $data = array(			
                "username"=>$_POST['username'],
		"password"=>$this->model_portal_admin->ecrpt($_POST['password'],md5('philportal')),
                "agreement_no"=>$_POST['agreement_no'],
                "is_activated" => 1,
                "user_level" => 2,
                "image" => 'dummy_m.jpg'
            );
            $user=$this->model_portal_admin->insertUser($data);
            if($user){
                redirect("user/");
            }
	}
	$this->maintemp('cms/create_user',array());	
    }
    
    public function edit(){
        $data = array();
        $id = $this->uri->segment(3);
        $data['result'] = $this->model_portal_admin->getUser($id);
        
        $this->maintemp('cms/edit_user',$data);        
        if(isset($_REQUEST['submitnews'])){
            $member = 0;
            $hra = 0;
            if(isset($_POST['member'])){
                $member=1;
            }
            if(isset($_POST['hra'])){
                $hra=1;
            }
            $data = array(			
                "username"=>$_POST['username'],
		"password"=>$this->model_portal_admin->ecrpt($_POST['password'],md5('philportal')),
                "agreement_no"=>$_POST['agreement_no'],
                "hra" => $hra,
                "member" => $member
			);
            $this->model_portal_admin->userUpdate($id,$data);
            redirect("user");
        }    
        
    }
    
    public function deactivate(){
        $id = $this->uri->segment(3);        
        $user=$this->model_portal_admin->deactivateUser($id);
        if($user){
            redirect(base_url("user"));
        }else{
            redirect(base_url("user"));
        }
    }
    
    public function activate(){
        $id = $this->uri->segment(3);        
        $user=$this->model_portal_admin->activateUser($id);
        if($user){
            redirect(base_url("user"));
        }else{
            redirect(base_url("user"));
        }
    }
    
    function delete(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            
            if($session_data['level']==1){
                $id = $this->uri->segment(3);
                $del = $this->model_portal_admin->userDelete($id);
                $this->session->set_flashdata('msg', 'User was deleted');
                redirect('user/user');
            }
        }
        
    }
}