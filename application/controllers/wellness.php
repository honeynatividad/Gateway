<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wellness extends CI_Controller {
	
	function __construct(){
		parent::__construct();	
		$this->load->model("model_portal_users");
		 $session_data = $this->session->userdata('logged_in');
		 if(!$session_data){
			 redirect("login");
		 }
		 $data['username'] = $session_data['username'];	
		//page renew
		$renew = array("page_id"=>7);
		$this->session->set_userdata('pages',$renew);	
	}
	function maintemp($temp,$data){
		$this->load->view('header',$data);
		$this->load->view($temp,$data);
		$this->load->view('footer');
	}
	
	function index(){
		$this->maintemp('wellness_buddies',array());
	}
	
	function loadwellness(){
		$c = curl_init('http://www.philcare.com.ph/webportal.php?type=wellness');
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt(... other options you want...)
		
		$html = curl_exec($c);
		
		if (curl_error($c))
			die(curl_error($c));
		
		// Get the status code
		$status = curl_getinfo($c, CURLINFO_HTTP_CODE);
		echo $html;
		curl_close($c);	 
	 
	}	



	
}


?>