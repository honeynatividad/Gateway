<?php

class Model_portal_Messages extends CI_Model{
	
	
	function insertMessage($data){
      $this->db->insert('portal_messages', $data); 			
	  return $this->db->insert_id();
	}

	function insertReceiver($data){
      $this->db->insert('portal_messages_receiver', $data); 			
	  return $this->db->insert_id();
	}	
	function getAllReceiver(){
		$q = $this->db->query("SELECT * FROM portal_users WHERE user_level=3");
		return $q->result();
	}

	function getAllSent(){
		$q = $this->db->query("SELECT * FROM portal_messages WHERE is_deleted!=1 ORDER BY date_created DESC LIMIT 20");
		return $q->result();
	}
	function getAllMessageByUser($id){
		$q = $this->db->query("SELECT * FROM portal_messages_receiver mr 
		LEFT JOIN portal_messages m ON m.msg_id=mr.msg_id WHERE mr.receiver_id=$id ORDER BY m.date_created DESC
		 LIMIT 20");
		return $q->result();
	}
	
	function getMessageById($id){
		$q = $this->db->query("SELECT * FROM portal_messages m 
		LEFT JOIN portal_messages_receiver mr ON mr.msg_id=m.msg_id
		LEFT JOIN portal_users u ON u.user_id=mr.receiver_id WHERE m.msg_id=$id");
		return $q->row();	
	}
	
		
	function getAdminMessageById($id){
		$q = $this->db->query("SELECT * FROM portal_messages WHERE msg_id=$id");
		return $q->row();	
	}	
			
	function readMessage($id){
		$this->db->where("msg_id",$id);
		$this->db->update("portal_messages_receiver",array('read_status'=>1));	
	}
		
	function deletemessagesAdmin($id){
		$this->db->where("msg_id",$id);
		$this->db->update("portal_messages",array('is_deleted'=>1));	
	}	
	function deleteMsgfromReceivers($msg,$userid){
		$array = array('msg_id' => $msg, 'receiver_id' => $userid);
		$this->db->where($array);
		$this->db->delete("portal_messages_receiver");		
	}
	
	function deletefromReceiversAdmin($id){
		$this->db->where("msg_id",$id);
		$this->db->delete("portal_messages_receiver");
	}
}
?>