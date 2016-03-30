<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {
	
	function __construct(){
		parent::__construct();	
		$this->load->model("model_portal_users");
		$this->load->model("model_portal_calendar");
		$this->load->model("model_portal_admin");
		 $session_data = $this->session->userdata('logged_in');
		 if(!$session_data){
			 redirect("login");
		 }
		 $data['username'] = $session_data['username'];	
                 //print_r($session_data);
		//page renew
		$renew = array("page_id"=>46);
		$this->session->set_userdata('pages',$renew);	
	}
	function maintemp($temp,$data){
		$this->load->view('header',$data);
		$this->load->view($temp,$data);
		$this->load->view('footer');
	}
	
	function index(){
		$this->maintemp('calendar',array());
	}
	
	function sched(){
		
		$this->maintemp('sched',array());
	}
	
	function dd(){
		(intval($_REQUEST["month"])>0) ? $cMonth = intval($_REQUEST["month"]) : $cMonth = date("m");
		(intval($_REQUEST["year"])>0) ? $cYear = intval($_REQUEST["year"]) : $cYear = date("Y");		
                
                $session_data = $this->session->userdata('logged_in');
                $cert = $session_data['certid'];
                $check = $this->wslibrary->getListAppointment($cert);            
                if(!$check){
                    $data['calendar'] = array();                
                }else{
                    $data['calendar'] = $check;
                }
                
		//$data['calendar'] = $this->model_portal_calendar->getEvent($cYear,$cMonth);                
		$data['cYear1']=$cYear;
		$data['cMonth1']=$cMonth;		
		$this->load->view("calendar_ajax",$data);
	}
        
        function callEvent(){
            
        }
	
	function monthevent(){
            //(intval($_REQUEST["month"])>0) ? $cMonth = intval($_REQUEST["month"]) : $cMonth = date("m");
            //$data['events'] = $this->model_portal_calendar->getEventPerMonth($cMonth);
            //print_r($this->model_portal_calendar->getEventPerMonth($cMonth));
            $session_data = $this->session->userdata('logged_in');
            $cert = $session_data['certid'];
            $check = $this->wslibrary->getListAppointment($cert);
            
            if(!$check){
                $data['events'] = array();                
            }else{
                $data['events'] = $check;
            }
            //print_r($this->wslibrary->getListAppointment($cert));
            $this->load->view("calendar_event",$data);
		
	}

	function admincreateevents(){
		$renew = array("page_id"=>41);
		$this->session->set_userdata('pages',$renew);		
		if(isset($_REQUEST['submitevent'])){
			$data = array(
			"event_date"=>$_POST['ev_date'],
			"title"=>$_POST['ev_title'],
			"description"=>$_POST['ev_desc'],
			"date_created"=>date('Y-m-d H:i:s'));
			$event=$this->model_portal_admin->insertEvent($data);
			if($event){
				redirect("calendar/adminceventslist");
			}
		}
		$this->maintemp('cms/create_event',array());		
		
	}
	
	function adminceventslist(){
		$renew = array("page_id"=>41);
		$this->session->set_userdata('pages',$renew);
			
		if(isset($_POST['event_id'])){
			$count = count($_POST['event_id']);
			for($i=0;$i<$count;$i++){
				$this->model_portal_calendar->deleteeventAdmin($_POST['event_id'][$i]);
				
			}
			redirect("calendar/adminceventslist");
		}
		
		$data['events'] = $this->model_portal_admin->getallEvents();
		$this->maintemp('cms/event_list',$data);		
	}
}


?>