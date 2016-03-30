<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
    private $userid;
    private $certid;

    function __construct(){
        parent::__construct();	
        $this->load->model("model_portal_users");
        $this->load->model("model_portal_admin");
        $this->load->model("model_portal_reports");
        $session_data = $this->session->userdata('logged_in');

        if(!$session_data){
                 redirect("login");
        }
         //$data['username'] = $session_data['username'];	
        $data = $session_data;
      
        $this->userid = $session_data['user_id'];
        $renew = array("page_id"=>103);
        $this->session->set_userdata('pages',$renew);	

        $this->certid=$session_data['certid'];


    }
    function maintemp($temp,$data){
        $this->load->view('header',$data);
        $this->load->view($temp,$data);
        $this->load->view('footer');
    }

    function index(){        
        $session_data = $this->session->userdata('logged_in');
        
        $this->load->view('cms/reports',array());
    }
    
    function login(){
        $session_data = $this->session->userdata('logged_in');
        if($session_data['level']==1){
            $id = $this->uri->segment(3);
            $first =  date("Y-m-d");
            $f = date('Y-m-d', strtotime('-1 day', strtotime($first)));
            $second = date('Y-m-d', strtotime('+1 Week'));
            $data['agreement'] = $id;
            //$data['login'] = $this->model_portal_reports->getLogin($id);
            $data['login'] = $this->model_portal_reports->searchLoginDate($id,$f,$second);
            //print_r($data['login']);
            $this->maintemp('cms/report_login',$data);
        }else{
            redirect("login","refresh");
        }
    }
    
    function login_list(){
        
        $session_data = $this->session->userdata('logged_in');
        
        
        if($session_data['level']==1){
            $data['login'] = $this->model_portal_reports->getAllLogin();
            //$data['login'] = $this->model_portal_reports->searchLoginDate($first,$second);
             $this->maintemp('cms/report_login_list',$data);
        }else{
            redirect("login","refresh");
        }
    }
}