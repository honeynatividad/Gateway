<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
    function __construct(){
        parent::__construct();	
	$this->load->model("model_portal_users");
	$session_data = $this->session->userdata('logged_in');
	if(!$session_data){
            redirect("login");
        }
	$data['username'] = $session_data['username'];	
		//page renew                 
		
	$renew = array("page_id"=>1);
	$this->session->set_userdata('pages',$renew);
		//$this->model_portal_users->activateuser($session_data['user_id']);
		//$this->model_portal_users->deactivatepages();
		//$this->model_portal_users->updatename(22,'Feedback');
    }
    
    function maintemp($temp,$data){
        $this->load->view('header',$data);
	$this->load->view($temp,$data);
	$this->load->view('footer');
    }
	
    function index(){            
          
        $this->load->model("model_portal_admin");
        $session_data = $this->session->userdata('logged_in');
        /*if(isset($session_data['hra'])){
        	if($session_data['hra']==1){
            	redirect('hra');
            }
        }*/
        $data['session_data'] = $session_data;
        $id = $session_data['agreement_no'];
        $data['warning'] =$this->session->flashdata('error_access');
        $data['id'] = $id;
        $data['newsfeed'] = $this->model_portal_admin->getallNewsHome($id); 
        $data['videos'] = $this->model_portal_admin->getAllVideoActive($id);
        $data['guidebooks'] = $this->model_portal_admin->getGuidebookActive($id);
            //$this->load->view('header',$data);
        //print_r($session_data);
        $this->maintemp('newsfeed',$data);
	}
   
	function logout(){
		$this->session->unset_userdata('logged_in');
	   	redirect('home', 'refresh');
	}
	
	function tilefeed(){
	 //$this->load->view("feed_tile");	
		$c = curl_init('http://www.philcare.com.ph/webportal.php?type=thumb');
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

	function listfeed(){
		$c = curl_init('http://www.philcare.com.ph/webportal.php?type=list');
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
        
        function news($id){
            
            $this->load->model("model_portal_admin");
            $data['newsfeed'] = $this->model_portal_admin->getNewsfeed($id);
            
            $this->maintemp('news_view',$data);
        }
        
        function newsall(){
            $c = curl_init('http://localhost/memberportal/home/news_all');
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
        
        function news_all(){
            $session_data = $this->session->userdata('logged_in');
            $this->load->model("model_portal_admin");
            $agreement_no = $session_data['agreement_no'];
            $data['newsfeed'] = $this->model_portal_admin->getallNewsHome($agreement_no);
            
            $this->load->view('news_all',$data);
        }
}
?>