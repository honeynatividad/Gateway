<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phil extends CI_Controller {
	
	function __construct(){
		parent::__construct();	
		//$this->load->model("model_portal_users");
		$this->load->model("model_portal_admin","admin");
		//$session_data = $this->session->userdata('logged_in');
		//$data['username'] = $session_data['username'];	
		//page renew
		$renew = array("page_id"=>0);
		$this->session->set_userdata('pages',$renew);	
	}
	
	function index(){
		//$this->maintemp('faq',array());
	}
	
	function terms(){
		$data['title']='Terms and Condition';
		$data['page_content']=$this->admin->siteinfo()->terms_info;
		$this->load->view("siteinfo",$data);
	}

	function privacy(){
		$data['title']='Privacy';
		$data['page_content']=$this->admin->siteinfo()->privacy_info;
		$this->load->view("siteinfo",$data);
	}
	
}


?>