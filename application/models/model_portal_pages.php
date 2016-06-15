<?php

class Model_portal_pages extends CI_Model{
	private $user;
	
	function __construct(){
		parent::__construct();
                
		$sesdata = $this->session->userdata('logged_in');
		$this->user = $sesdata['user_id'];	
		//var_dump($sesdata);
	}
		
	function getAllParentPages(){
		$q = $this->db->query("SELECT *,
		(SELECT COUNT(*) FROM portal_messages_receiver WHERE receiver_id=2 
		AND read_status=0) AS msg_totals FROM portal_pages WHERE has_sub IN (0,1) 
		AND page_parent!=1 AND active_stat=1 ORDER BY page_id ASC");	
	
		return $q->result();	
	}
	
	function getAllSubPagesById($id){
		$q = $this->db->query("SELECT * FROM portal_pages WHERE has_sub=".$id." AND active_stat=1");
		
		return $q->result();
	}
        
        function getAllSubAdminPagesById($id){
            $q = $this->db->query("SELECT * FROM portal_pages WHERE has_sub=".$id." AND active_stat=1 AND page_level=2");		
            return $q->result();
        }

	function getAllAdminPages(){
		$q = $this->db->query("SELECT * FROM portal_pages WHERE page_parent=1 AND active_stat=1  ORDER BY page_id ASC");	
                $this->db->close();
		return $q->result();	
	}
        
        function getAllSubAdminPages(){
            $q = $this->db->query("SELECT * FROM portal_pages WHERE page_parent=1 AND active_stat=1 AND page_level=2  ORDER BY page_id ASC");
            return $q->result();
        }
        
        function getAllModule(){
            $q = $this->db->query("SELECT * FROM portal_module WHERE status='1'");
            return $q->result();
        }
        
        function checkNewsfeedModule($id){
            $q = $this->db->query("SELECT * FROM portal_module WHERE status='1' AND agreement_no='$id' AND newsfeed='1'");
            $count = $q->num_rows();
            return $count;
        }
        
        function checkProviderModule($id){
            $q = $this->db->query("SELECT * FROM portal_module WHERE status='1' AND agreement_no='$id' AND provider='1'");
            $count = $q->num_rows();
            return $count;
        }
        
        function checkEcuModule($id){
            $q = $this->db->query("SELECT * FROM portal_module WHERE status='1' AND agreement_no='$id' AND ecu='1'");
            $count = $q->num_rows();
            return $count;
        }
        
        function checkReimbursementModule($id){
            $q = $this->db->query("SELECT * FROM portal_module WHERE status='1' AND agreement_no='$id' AND reimbursement='1'");
            $count = $q->num_rows();
            return $count;
        }

        function checkHRAModule($id){
            $q = $this->db->query("SELECT * FROM portal_module WHERE status='1' AND agreement_no='$id' AND hra='1'");
            $count = $q->num_rows();
            return $count;
        }
        
	function getUserById($id){
		$q = $this->db->query("SELECT * FROM portal_users WHERE user_id=$id");		
	
		return $q->row();
	}
    
    function getAgreementNo($id){
        $q = $this->db->query("SELECT * FROM portal_logo WHERE agreement_no='$id' AND status='1'");
        return $q->row();
    }
    
    
		
}
?>