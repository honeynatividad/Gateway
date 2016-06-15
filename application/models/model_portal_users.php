<?php

class Model_portal_users extends CI_Model{
	
    function validateuser($user,$pass){
		$q = $this->db->query("SELECT * FROM portal_users WHERE (email='".$user."' OR username='".$user."')  AND password='".$this->ecrpt($pass,md5('philportal'))."'");		
	
		return $q->row();
    }
    
    function isAdmin($user){
        $q = $this->db->query("SELECT user_level FROM portal_users WHERE username='".$user."' AND is_activated='1'");
        return $q->row();
    }

	function loginusername($user){
		$q = $this->db->query("SELECT * FROM portal_users WHERE email='".$user."' OR username='".$user."'");		
	
		return $q->row();
	}
		
	function getpassifCorrect($id,$pass){
		$q = $this->db->query("SELECT * FROM portal_users WHERE user_id=$id AND password='".$this->ecrpt($pass,md5('philportal'))."'");		
		return $q->row();		
	}
	
	function getUserById($id){
		$q = $this->db->query("SELECT * FROM portal_users WHERE user_id=$id");
		return $q->row();
	}
        
	function checkemail($email){
		$q = $this->db->query("SELECT * FROM portal_users WHERE email='".$email."'");	
		
		return $q->row();
	}

	function insertUserFromLive($post){	
        $data = array(
           'certNo' =>$post['CertNo'],
		   'email'=>$this->db->escape_str($post['Email']),
		   'username'=>$this->db->escape_str($post['Email']),
		   'password'=>$this->ecrpt($post['password'],md5('philportal')),
		   'fname'=>$this->db->escape_str($post['FirstName']),
		   'lname'=>$this->db->escape_str($post['LastName']),
		   'user_level'=>3,
		   'bdate'=>$this->db->escape_str($post['BirthDate']),
		   'date_created'=>date('Y-m-d H:m:s'),
		   'is_activated'=>0,
		   'prepaid_access'=>$post['prepaid'],
		   'dateVerified'=>date('Y-m-d',strtotime($post['DateVerified']))
		   
        );
      $this->db->insert('portal_users', $data); 			
	
	  return $this->db->insert_id();		
	} 

	function insertUserDetailsFromLive($info,$user){	
        $data = array(
			"user_id"=>$user,
			"address"=>$this->db->escape_str($info->Address),
			"agreement_name"=>$this->db->escape_str($info->AgreementName),
			"agreement_no"=>$this->db->escape_str($info->AgreementNo),
			"barangay"=>$this->db->escape_str($info->Barangay),
			"benifit_limit"=>$this->db->escape_str($info->BenefitLimit),
			"birthdate"=>date('Y-m-d H:m:s',strtotime($info->BirthDate)),
			"certno"=>$this->db->escape_str($info->CertNo),
			"city"=>$this->db->escape_str($info->City),
			"civil_stat"=>$this->db->escape_str($info->CivilStat),
			"cotact_no"=>$this->db->escape_str($info->ContactNumber),
			"date_registered"=>date('Y-m-d H:m:s',strtotime($info->DateRegistered)),
			"date_verified"=>date('Y-m-d H:m:s',strtotime($info->DateVerified)),
			"dental"=>$this->db->escape_str($info->Dental),
			"effective_date"=>date('Y-m-d',strtotime($info->EffectiveDate)),
			"email"=>$this->db->escape_str($info->Email),
			"expiry_date"=>date('Y-m-d',strtotime($info->ExpiryDate)),
			"firstname"=>$this->db->escape_str($info->FirstName),
			"home_no"=>$this->db->escape_str($info->HomeNo),
			"hospitals"=>$this->db->escape_str($info->Hospitals),
			"house_no"=>$this->db->escape_str($info->HouseNo),
			"lastname"=>$this->db->escape_str($info->LastName),
			"member_type"=>$this->db->escape_str($info->MemberType),
			"middlename"=>$this->db->escape_str($info->MiddleName),
			"package_desc"=>$this->db->escape_str($info->PackageDescription), 
			"philhealth"=>$this->db->escape_str($info->PhilHealth),
			"plan_type"=>$this->db->escape_str($info->PlanType),
			"policy_no"=>$this->db->escape_str($info->PolicyNo),
			"pre_ex"=>$this->db->escape_str($info->PreEx),
			"province"=>$this->db->escape_str($info->Province),
			"riders"=>$this->db->escape_str($info->Riders),
			"room_desc"=>$this->db->escape_str($info->RoomDescription),
			"room_rate"=>$this->db->escape_str($info->RoomRate),
			"sex"=>$this->db->escape_str($info->Sex),
			"street"=>$this->db->escape_str($info->Street));
      $this->db->insert('portal_users_details', $data); 
	
	  return $this->db->insert_id();		
	}



	function getUserDetails($id){
		$q = $this->db->query("SELECT * FROM portal_users_details ud LEFT JOIN portal_users_other_info uf ON uf.user_id=ud.user_id WHERE ud.user_id=$id");
		
		return $q->row();
	}

	function getUserDetailsByCertId($id){
		$q = $this->db->query("SELECT * FROM portal_users ud WHERE ud.certNo='".$id."'");
		
		return $q->row();
	}	
	
	function checkCurrentCertId($id){
		$q = $this->db->query("SELECT * FROM portal_users WHERE certNo='".$id."'");
		
		return $q->row();
	}

	function checkusername($name){
		$q = $this->db->query("SELECT * FROM portal_users WHERE username='".$name."'");
		
		return $q->row();
	}

	function checkusername_newchecker($name){
		$q = $this->db->query("SELECT * FROM portal_users WHERE username='".$name."' OR email='".$name."'");
		
		return $q->row();
	}
	
	function ecrpt($pure_string, $encryption_key) {
		$encrypt = base64_encode($pure_string).$encryption_key;
		return $encrypt;
	}
	

	function dcrpt($str, $key) {
		$encrypted=$str;
		$string=str_replace($key,'',$encrypted);
		$decrypted=base64_decode($string);
		return $decrypted;
	}
	
	function updateImage($id,$image){
		$data= array("image"=>$image);
		$this->db->where("user_id",$id);
		$this->db->update("portal_users",$data);
		
	}
	
	function activateuser($id){
		$data= array("is_activated"=>1);
		$this->db->where("user_id",$id);
		$this->db->update("portal_users",$data);
		
	}	


	function updatepass($id,$pass){
		$data= array("password"=>$this->ecrpt($pass,md5('philportal')));
		$this->db->where("user_id",$id);
		$this->db->update("portal_users",$data);
		
	}		

	function updatemyaddress($info,$user){	
		$myaddress = trim($info['HouseNo']." ".$info['Street']." ".$info['subdivision']." ".$info['City']." ".$info['Province']." ".$info['zipcode']);
        $data = array(
			"address"=>$this->db->escape_str($myaddress),
			"barangay"=>$this->db->escape_str($info['barangay']),
			"subdivision"=>$this->db->escape_str($info['subdivision']),
			"city"=>$this->db->escape_str($info['city']),
			"cotact_no"=>$this->db->escape_str($info['cotact_no']),
			"home_no"=>$this->db->escape_str($info['home_no']),
			"house_no"=>$this->db->escape_str($info['house_no']),
			"province"=>$this->db->escape_str($info['province']),
			"zipcode"=>$this->db->escape_str($info['zipcode']),
			"street"=>$this->db->escape_str($info['street']));
	  $this->db->where("user_id",$user);		
     return $this->db->update('portal_users_details', $data); 
		
	}

	function updatecompany($info,$user){	
        $data = array(
			"company_name"=>$this->db->escape_str($info['company_name']),
			"company_address"=>$this->db->escape_str($info['company_address']),
			"work_no"=>$this->db->escape_str($info['work_no']),
			"designation"=>$this->db->escape_str($info['designation']),
			"date_created"=>date('Y-m-d H:i:s'));
	  $this->db->where("user_id",$user);		
     return $this->db->update('portal_users_other_info', $data); 
		
	}		
	function insertcompany($info,$user){	
        $data = array(
			"user_id"=>$user,
			"company_name"=>$this->db->escape_str($info['company_name']),
			"company_address"=>$this->db->escape_str($info['company_address']),
			"work_no"=>$this->db->escape_str($info['work_no']),
			"designation"=>$this->db->escape_str($info['designation']),
			"date_created"=>date('Y-m-d H:i:s'));		
			
     return $this->db->insert('portal_users_other_info', $data); 
		
	}	
	
	function checkcompany($user){
		$q = $this->db->query("SELECT * FROM portal_users_other_info WHERE user_id=$user");
		
		return $q->row();
	}	


	function updateAttempt($user,$log,$stat=1){	
		if($stat==1){
        $data = array(
			"login_attempt"=>$log,
			"login_date"=>date('Y-m-d H:i:s'));			
		}else{
       	 $data = array(
			"login_attempt"=>$log,
			"login_attempt_date"=>date('Y-m-d H:i:s'));			
		}

		  $this->db->where("user_id",$user);		
    	 return $this->db->update('portal_users', $data); 	
	}
	

	function deactivatepages(){
		$data= array("active_stat"=>0);
		$this->db->where_in("page_id",array(7,8,17,20,21,23));
		$this->db->update("portal_pages",$data);
		
	}	

	function updatename($id,$string=''){
		$data= array("page_name"=>$string);
		$this->db->where("page_id",$id);
		$this->db->update("portal_pages",$data);
		
	}		
	
}

?>