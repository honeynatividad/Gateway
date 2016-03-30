<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {
	private $level;
	function __construct(){
		parent::__construct();	
		$this->load->model("model_portal_users");
		$this->load->model("model_portal_messages");
		 $session_data = $this->session->userdata('logged_in');
		 if(!$session_data){
			 redirect("login");
		 }
		 $data['username'] = $session_data['username'];	
		 $this->level=$session_data['level'];
		//page renew
		$renew = array("page_id"=>3);
		$this->session->set_userdata('pages',$renew);	
	}
	function maintemp($temp,$data){
		$this->load->view('header',$data);
		$this->load->view($temp,$data);
		$this->load->view('footer');
	}
	


	function index(){
		$sdata = $this->session->userdata('logged_in');
		if($sdata['level']==1){
			redirect("messages/sent");
		}
		
		if(isset($_POST['msg_id'])){
			$count = count($_POST['msg_id']);
			for($i=0;$i<$count;$i++){
			$this->model_portal_messages->deleteMsgfromReceivers($_POST['msg_id'][$i],$sdata['user_id']);
				
			}
			redirect("messages");
		}		
		$data['messages'] = $this->model_portal_messages->getAllMessageByUser($sdata['user_id']);
		$this->maintemp('messages',$data);	
	}
	
	function msg($id){
		if($this->level==1){
		$data['details'] = $this->model_portal_messages->getAdminMessageById($id);	
		}else{
		$data['details'] = $this->model_portal_messages->getMessageById($id);
		$this->model_portal_messages->readMessage($id);
		}
		$this->maintemp('msg_content',$data);
		
	}
	
	function create(){
		if(isset($_REQUEST['submitmsg'])){
			$data = array(
			"messages"=>stripslashes($_POST['message']),
			"subject"=>$_POST['subject'],
			"date_created"=>date('Y-m-d H:i:s'));
			$msgid=$this->model_portal_messages->insertMessage($data);
			$list=$this->model_portal_messages->getAllReceiver();
			foreach($list as $lst){
				$rcv = array("msg_id"=>$msgid,"receiver_id"=>$lst->user_id);
				$this->model_portal_messages->insertReceiver($rcv);
			}
			redirect("messages/sent");
		}
		$this->maintemp('cms/msg_create',array());
	}	

	function sent(){		
		if(isset($_POST['msg_id'])){
			$count = count($_POST['msg_id']);
			for($i=0;$i<$count;$i++){
				$this->model_portal_messages->deletemessagesAdmin($_POST['msg_id'][$i]);
				$this->model_portal_messages->deletefromReceiversAdmin($_POST['msg_id'][$i]);
				
			}
			redirect("messages/sent");
		}
		$data['messages'] = $this->model_portal_messages->getAllSent();
		$this->maintemp('cms/msg_sent',$data);
	}
        
    function inbox(){
        
    }
	
}


?>