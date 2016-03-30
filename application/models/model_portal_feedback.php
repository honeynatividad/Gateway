<?php

class Model_portal_Feedback extends CI_Model{
	private $user;
	
	function __construct(){
		parent::__construct();
		$sesdata = $this->session->userdata('logged_in');
		$this->user = $sesdata['user_id'];	
	}	
	
	function insertFeedbak($post){
	  $data = array(
	  "subject"=>$post['newsub'],
	  "comments"=>$post['comment'],
	  "user_id"=>$this->user,
	  "date_created"=>date('Y-m-d H:i:s'),
	  "contact_no"=>$post['contact']);
      $this->db->insert('portal_feedbacks', $data); 			
	  return $this->db->insert_id();
	}

	function getAllFeedback(){
		$q = $this->db->query("SELECT * 
		FROM portal_feedbacks fb LEFT JOIN portal_users u ON u.user_id=fb.user_id 
		WHERE fb.is_deleted!=1 ORDER BY fb.date_created DESC LIMIT 20");
		return $q->result();
	}
	
	function getFeedbackById($id){
		$q = $this->db->query("SELECT * FROM portal_feedbacks fb 
		LEFT JOIN portal_users u ON u.user_id=fb.user_id 
		WHERE fb.fbs_id=$id");
		return $q->row();	
	}

	function deletebsById($fbsid){
		$array = array('fbs_id' => $fbsid);
		$this->db->where($array);
		$this->db->delete("portal_feedbacks");		
	}
	
	function getallDepartmentsByDivId($id){
		$q = $this->db->query("SELECT * FROM portal_dep_emails WHERE dep_id=$id");
		return $q->result();	
	}
	
	function cclist(){
		$q = $this->db->query("SELECT * FROM portal_dep_emails WHERE dep_id=4 OR dep_id=5");
		return $q->result();	
	}			
}
?>