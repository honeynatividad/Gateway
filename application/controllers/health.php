<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Health extends CI_Controller {
	
	function __construct(){
		parent::__construct();	
		$this->load->model("model_portal_users");
		 $session_data = $this->session->userdata('logged_in');
		 if(!$session_data){
			 redirect("login");
		 }
		 $data['username'] = $session_data['username'];	
		//page renew
		$renew = array("page_id"=>4);
		$this->session->set_userdata('pages',$renew);	
	}
	function maintemp($temp,$data){
		$this->load->view('header',$data);
		$this->load->view($temp,$data);
		$this->load->view('footer');
	}
	
	function index(){
		$this->maintemp('health',array());
	}
	
	function bmi(){
		
		$this->maintemp('bmi',array());
	}
	

	
}


?>