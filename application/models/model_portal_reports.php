<?php

class Model_portal_Reports extends CI_Model{
    
    //*************************
    // Report for all user who login 
    //*************************
     
    function getAllLogin(){
        $q = $this->db->query("SELECT * FROM portal_audit WHERE page_name='login' AND status='1' GROUP BY agreement_no");
        $s = $q->result();
        $this->db->close();
        return $s;
    }
    
    function getLogin($id){
        $q = $this->db->query("SELECT * FROM portal_audit WHERE page_name='login' AND agreement_no='$id' AND status='1'ORDER BY created");
        $s = $q->result();
        $this->db->close();
        return $s;
    }
    
    function updateAudit($fname,$lname,$id){
        $q = $this->db->query("UPDATE portal_audit SET first_name='$fname', last_name='$lname' WHERE audit_id='$id'");
        
    }
    
    function searchLoginDate($id,$first_date,$second_date){
        $q = $this->db->query("SELECT * FROM portal_audit WHERE created >= '$first_date' AND created <= '$second_date' AND agreement_no= '$id'");
        $s = $q->result();
        $this->db->close();
        return $s;
    }
}