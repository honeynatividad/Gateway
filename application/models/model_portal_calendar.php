<?php

class Model_portal_calendar extends CI_Model{
	
	function getEvent($cYear,$cMonth){
		$q = $this->db->query("SELECT * FROM event_calendar 
		WHERE event_date LIKE '".$cYear."-".$cMonth."-%'");		
	
		return $q->result();
	}

	function getEventPerMonth($month){
		$q = $this->db->query("SELECT * FROM event_calendar 
		WHERE DATE_FORMAT(event_date,'%m')='".$month."'");	
		
		return $q->result();
	}

	
	function deleteeventAdmin($id){
		$this->db->where("id",$id);
		$this->db->delete("event_calendar");	
	}		
}


?>