<?php

class Model_portal_Admin extends CI_Model{
    
    //added for feedback
    //hanna
    function feedback_add($data){
        $this->db->insert('portal_feedback',$data);
        return $this->db->insert_id();
    }
    
    function feedback_history($id){
        $q = $this->db->query("SELECT * FROM portal_feedback WHERE cert_no='$id'");
        $this->db->close();
        return $q->result();
    }
    
    function feedback_view($id){
        $q = $this->db->query("SELECT * FROM portal_feedback WHERE portal_feedback_id='$id'");
        $this->db->close();
        return $q->result();
    }
	
    function insertDlForms($data){
        $this->db->insert('portal_dl_forms', $data); 			
        return $this->db->insert_id();	
    }

    function updatedlId($id,$data){
            $this->db->where("dl_id",$id);
            $this->db->update('portal_dl_forms', $data); 

    }

    function selectAllDlLinks(){
            $q = $this->db->query("SELECT * FROM portal_dl_forms");	
            $this->db->close();    
            return $q->result();
    }

    function getDlById($id){
            $q = $this->db->query("SELECT * FROM portal_dl_forms WHERE dl_id=$id");	
            $this->db->close();
            return $q->row();		
    }

    function deletedl($id){
            $this->db->where("dl_id",$id);
            $this->db->delete("portal_dl_forms");	
    }

    function siteinfo(){
            $q = $this->db->query("SELECT * FROM portal_informations WHERE info_id=1");
            $this->db->close();
            return $q->row();	
    }

    function updateinfo($data){
            $this->db->where("info_id",1);
            $this->db->update('portal_informations', $data); 

    }

    function countmessages(){
            $q = $this->db->query("SELECT COUNT(*) as totals FROM portal_messages WHERE is_deleted!=1");
            $this->db->close();
            return $q->row();
    }

    function countdownloadforms(){
            $q = $this->db->query("SELECT COUNT(*) as totals FROM portal_dl_forms");
            $this->db->close();
            return $q->row();	
    }

    function insertPFav($post){
      $data = array("user_id"=>$post['user_id'],
      "prov_coordinator"=>$post['coordinator'],
      "prov_name"=>$post['name'],
      "prov_address"=>$post['address'],
      "prov_contact"=>$post['cp'],
      "prov_code"=>$post['code'],
      "prov_lat"=>$post['latitude'],
      "prov_long"=>$post['longitude'],
      "prov_region"=>$post['region'],
      "date_pin"=>date('Y-m-d H:i:s'));	
        $this->db->insert('portal_fav_provider', $data); 			
        $this->db->close();
      return $this->db->insert_id();	
    }	

    function deletepfav($id){
            $this->db->where("prov_code",$id);
            $this->db->delete("portal_fav_provider");	
    }

    function getAllFavByUser($user){
            $q = $this->db->query("SELECT * FROM portal_fav_provider WHERE user_id='$user'");
            $this->db->close();
            return $q->result();	
    }

    function checkFavByUser($user,$code){
            $q = $this->db->query("SELECT * FROM portal_fav_provider WHERE prov_code='".$code."' AND user_id='$user'");
            $this->db->close();
            return $q->row();	
    }

    function getAllCodeFav(){
            $q = $this->db->query("SELECT prov_code FROM portal_fav_provider WHERE user_id='$user'");
            $this->db->close();
            return $q->result();	
    }	


    function insertEvent($post){
  $this->db->insert('event_calendar', $post); 			
  $this->db->close();
      return $this->db->insert_id();	
    }

    function getallEvents(){
            $q = $this->db->query("SELECT * FROM event_calendar");
            $this->db->close();
            return $q->result();	
    }

    function insertNews($post){
        $this->db->insert('portal_news',$post);
        $this->db->close();
        return $this->db->insert_id();
    }

    function getallNews(){
        $q = $this->db->query("SELECT * FROM portal_news ORDER BY created DESC");
        $this->db->close();
        return $q->result();
    }
    function getNews($id){
        $q = $this->db->query("SELECT * FROM portal_news WHERE news_id='$id'");            
        $this->db->close();
        return $q->result();
    }
    
    function getAllNewsActive($id){
        $q = $this->db->query("SELECT * FROM portal_news WHERE agreement_no='$id' ORDER BY created DESC");
        $this->db->close();
        return $q->result();
    }

    function newsUpdate($id,$data){
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),                
        );

        $this->db->where('news_id', $id);
        $this->db->update('portal_news', $data);
        $this->db->close();
        return true;
    }
    function getallNewsHome($id){
        $q = $this->db->query("SELECT * FROM portal_news WHERE status='1' AND is_video='0' AND agreement_no='$id' ORDER BY created DESC");
        $this->db->close();
        $this->db->close();
        return $q->result();
    }

    function getNewsfeed($id){
        $q = $this->db->query("SELECT * FROM portal_news WHERE news_id='$id' ORDER BY created DESC");
        $this->db->close();
        return $q->result();
    }

    function deactivateNews($id){
        $q = $this->db->query("UPDATE portal_news SET status='0' WHERE news_id='$id' ORDER BY created DESC");
        $this->db->close();
        return true;
    }

    function activateNews($id){
        $q = $this->db->query("UPDATE portal_news SET status='1' WHERE news_id='$id'");
        $this->db->close();
        return true;
    }

    function editNews($id,$title,$description){
        $q = $this->db->query("UPDATE portal_news SET title='', desctiption='' WHERE news_id='$id'");
        $this->db->close();
        return true;
    }
    
    //********************
    //* Logo Functions
    //********************
    function getAllLogo(){
        $q = $this->db->query("SELECT * FROM portal_logo");
        $s = $q->result();
        $this->db->close();
        return $s;
    }
    function getLogo($id){
        $q = $this->db->query("SELECT * FROM portal_logo WHERE logo_id='$id'");
        $this->db->close();
        return $q->result();
    }
    
    function getLogoWithStatus(){
        $q = $this->db->query("SELECT * FROM portal_logo WHERE status='1'");
        $this->db->close();
        return $q->result();
    }
    
    function getLogoActive($id){
        $q = $this->db->query("SELECT * FROM portal_logo WHERE status=1 AND agreement_no='$id'");
        $this->db->close();
        return $q->result();
    }
    
    function logoUpdate($id,$data){                        
        $data = array(
            'agreement_no' => $data['agreement_no'],
            'agreement_name' => $data['agreement_name'],                
            'image_url' => $data['image_url'],
            'status' => '1'
        );

        $this->db->where('logo_id', $id);
        $this->db->update('portal_logo', $data);
        return true;
    }
    function logoDelete($id){
        $this->db->where('logo_id', $id);
        $this->db->delete('portal_logo'); 
    }
    
    function checkLogo($id){
        $q = $this->db->query("SELECT * FROM portal_logo WHERE agreement_no='$id'");
        $count = $q->num_rows();
        $this->db->close();
        return $count;
    }
    
    function deactivateLogo($id){
        $q = $this->db->query("UPDATE portal_logo SET status='0' WHERE logo_id='$id'");
        $this->db->close();
        return true;
    }

    function activateLogo($id){
        $q = $this->db->query("UPDATE portal_logo SET status='1' WHERE logo_id='$id'");
        $this->db->close();
        return true;
    }

    function insertLogo($post){
        $this->db->insert('portal_logo',$post);
        $this->db->close();
        return $this->db->insert_id();
    }
    
    function getAgreement($agreement){
        $q = $this->db->query("SELECT * FROM portal_logo WHERE agreement_no='$agreement'");
        $this->db->close();
        return $q->result();
    }
    
    function insertVideo($post){
        $this->db->insert('portal_videos',$post);
        $this->db->close();
        return $this->db->insert_id();
    }
    
    function deactivateVideo($id){
        $q = $this->db->query("UPDATE portal_videos SET status='0' WHERE video_id='$id'");
        $this->db->close();
        return true;
    }
    
    function activateVideo($id){
        $q = $this->db->query("UPDATE portal_videos SET status='1' WHERE video_id='$id'");
        $this->db->close();
        return true;
    }

    function getAllUser(){
        $q = $this->db->query("SELECT * FROM portal_users");
        $this->db->close();
        return $q->result();
    }
    
    function getAllUserActive(){
        $q = $this->db->query("SELECT * FROM portal_users WHERE is_activated='1'");
        $this->db->close();
        return $q->result();
    }
    
    function insertUser($post){
        $this->db->insert("portal_users",$post);
        $this->db->close();
        return $this->db->insert_id();
    }
    
    function getUser($id){
        $q = $this->db->query("SELECT * FROM portal_users WHERE user_id='$id'");
        $this->db->close();
        return $q->result();
    }
    
    function getUserActive($id){
        $q = $this->db->query("SELECT * FROM portal_users WHERE agreement_no='$id'");
        $this->db->close();
        return $q->result();
    }
    
    function userUpdate($id,$data){        

        $this->db->where('user_id', $id);
        $this->db->update('portal_users', $data);
        $this->db->close();
        return true;
    }
    
    function deactivateUser($id){
        $q = $this->db->query("UPDATE portal_users SET is_activated='0' WHERE user_id='$id'");        
        $this->db->close();
        return true;
    }
    
    function activateUser($id){
        $q = $this->db->query("UPDATE portal_users SET is_activated='1' WHERE user_id='$id'");        
        $this->db->close();
        return true;
    }
    
    function getAllPages(){
        $q = $this->db->query("SELECT * FROM portal_pages");
        $this->db->close();
        return $q->result();
    }
    
    function getPages(){
        $q = $this->db->query("SELECT * FROM portal_pages WHERE has_sub=0");
        $this->db->close();
        return $q->result();
    }
    
    function getPage($id){
        $q = $this->db->query("SELECT * FROM portal_pages WHERE page_id='$id'");
        $this->db->close();
        return $q->result();
    }
    
    function deactivatePage($id){
        $q = $this->db->query("UPDATE portal_pages SET active_stat='0' WHERE page_id='$id' OR has_sub='$id'");
        $this->db->close();
        return true;
    }
    
    function activatePage($id){
        $q = $this->db->query("UPDATE portal_pages SET active_stat='1' WHERE page_id='$id' OR has_sub='$id'");
        $this->db->close();
        return true;
    }
    
    function pageUpdate($id,$data){        

        $this->db->where('page_id', $id);
        $this->db->update('portal_pages', $data);
        $this->db->close();
        return true;
    }
    
    function getAllModule(){
        $q = $this->db->query("SELECT * FROM portal_module");
        $this->db->close();
        return $q->result();
    }
    function insertModule($post){
        $this->db->insert('portal_module',$post);
        $this->db->close();
        return $this->db->insert_id();
    }
    function deactivateModule($id){
        $q = $this->db->query("UPDATE portal_module SET status='0' WHERE module_id='$id'");
        $this->db->close();
        return true;
    }
    function activateModule($id){
        $q = $this->db->query("UPDATE portal_module SET status='1' WHERE module_id='$id'");
        $this->db->close();
        return true;
    }
    function getModule($id){
        $q = $this->db->query("SELECT * FROM portal_module WHERE module_id='$id'");
        $this->db->close();
        return $q->result();
    }
    function updateModule($id,$data){
        $this->db->where('module_id', $id);
        $this->db->update('portal_module', $data);
        $this->db->close();
        return true;
    }
    function getallVideo(){
        $q = $this->db->query("SELECT * FROM portal_videos ORDER BY created DESC");
        $this->db->close();
        return $q->result();
    }
    
    function getAllVideoActive($id){
        $q = $this->db->query("SELECT * FROM portal_videos WHERE agreement_no='$id' AND status='1'");
        $s = $q->result();
        $this->db->close();
        return $s;
    }
    function getAllVideoAgreement($id){
        $q = $this->db->query("SELECT * FROM portal_videos WHERE agreement_no='$id'");
        $this->db->close();
        return $q->result();
    }
    
    function getVideo($id){
        $q = $this->db->query("SELECT * FROM portal_videos WHERE video_id='$id'");
        $this->db->close();
        return $q->result();
    }
    
    function updateVideo($id,$data){
        $this->db->where('video_id', $id);
        $this->db->update('portal_videos', $data);
        $this->db->close();
        return true;
    }
    
    function videoDelete($id){
        $this->db->where('video_id', $id);
        $this->db->delete('portal_videos'); 
        $this->db->close();
    }
    
    function newsDelete($id){
        $this->db->where('news_id', $id);
        $this->db->delete('portal_news'); 
        $this->db->close();
    }
    
    function userDelete($id){
        $this->db->where('user_id', $id);
        $this->db->delete('portal_users'); 
        $this->db->close();
    }
    
    function faqDelete($id){
        $this->db->where('faq_id', $id);
        $this->db->delete('portal_faq'); 
        $this->db->close();
    }
    
    function guidebookDelete($id){
        $this->db->where('guidebook_id', $id);
        $this->db->delete('portal_guidebook'); 
        $this->db->close();
    }
    
    
    
    function getallDivisions(){
            $q = $this->db->query("SELECT * FROM portal_department");
            $this->db->close();
            return $q->result();	
    }

    function getallDepartments(){
            $q = $this->db->query("SELECT dd.dep_name as 'div_name',pe.dep_name,pe.dep_email,pe.dep_id FROM portal_dep_emails pe LEFT JOIN portal_department dd ON dd.dep_id = pe.dep_id");
            $this->db->close();
            return $q->result();	
    }

    function insertnewdepfeed($post){
      $data = array("dep_email"=>$post['dep_email'],
      "dep_name"=>$post['dep_name'],
      "dep_id"=>$post['dep_id']);	
  $this->db->insert('portal_dep_emails', $data); 			
  $this->db->close();
      return $this->db->insert_id();	
    }	



    function getAllProvinces(){
            $q = $this->db->query("SELECT * FROM provinces ORDER BY name ASC");
            $this->db->close();
            return $q->result();
    }

    function getCitiesById($id){
            $q = $this->db->query("SELECT * FROM cities WHERE province_id=$id");
            $this->db->close();
            return $q->result();
    }

    function testModel(){
       $q = $this->db->query("ALTER TABLE portal_fav_provider CHANGE user_id user_id VARCHAR(128) NULL DEFAULT NULL;");
       $this->db->close();
       return $q->result();
    }

    function testDelete($id){
        $this->db->where('page_id', $id);
        $this->db->delete('portal_pages'); 
        $this->db->close();
    }

    function testUpdate(){
        //ALTER TABLE `portal_fav_provider` CHANGE `user_id` `user_id` VARCHAR(128) NULL DEFAULT NULL;
    }
    function testInsert(){
        $data = array(
            'page_name' => 'List Logo' ,
            'page_parent' => '0' ,
            'has_sub' => '59',
            'page_url' =>'logo',
            'active_stat' => 1
        );

        $this->db->insert('portal_pages', $data); 
        $this->db->close();
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
    
    //checking if user is allowed to access portal
    function checkAgreement($id){
        $q = $this->db->query("SELECT * FROM portal_users WHERE agreement_no='$id' and is_activated='1'");
        $count = $q->num_rows();
        $this->db->close();
        return $count;
    }
    //checking if user is allowed in hra    
    function checkHRA($id){
        $q = $this->db->query("SELECT * FROM portal_users WHERE agreement_no='$id' AND hra='1'");
        $count = $q->num_rows();
        $this->db->close();
        return $count;
    }
    //checking if user is allowed in member
    function checkMember($id){
        $q = $this->db->query("SELECT * FROM portal_users WHERE agreement_no='$id' AND member='1'");
        $count = $q->num_rows();
        $this->db->close();
        return $count;
    }
    
    //***************************
    //for guidebook
    //***************************
    function getAllGuidebook(){
        $q = $this->db->query("SELECT * FROM portal_guidebook");
        $this->db->close();
        return $q->result();
    }
    
    function getGuidebookActive($id){
        $q = $this->db->query("SELECT * FROM portal_guidebook WHERE agreement_no='$id' AND status='1'");    
        $this->db->close();
        return $q->result();
    }
    
    function getGuidebook($id){
        $q = $this->db->query("SELECT * FROM portal_guidebook WHERE guidebook_id='$id'");
        $this->db->close();
        return $q->result();
    }
    
    function activateGuidebook($id){
        $q = $this->db->query("UPDATE portal_guidebook SET status='1' WHERE guidebook_id='$id'");
        $this->db->close();
        return true;
    }
    
    function deactivateGuidebook($id){
        $q = $this->db->query("UPDATE portal_guidebook SET status='0' WHERE guidebook_id='$id'");
        $this->db->close();
        return true;
    }
    
    function updateGuidebook($id,$data){
        $this->db->where('guidebook_id', $id);
        $this->db->update('portal_guidebook', $data);
        $this->db->close();
        return true;
    }
    
    function insertGuidebook($post){
        $this->db->insert("portal_guidebook",$post);
        
        return $this->db->insert_id();
    }    
    //***************************
    //end of guidebook
    //***************************
    
    //***************************
    //start of FAQ settingss
    //***************************
    
    function insertFAQ($post){
        $this->db->insert('portal_faq',$post);
        return $this->db->insert_id();
    }
    function getFAQ(){
        $q = $this->db->query("SELECT * FROM portal_faq WHERE status='1'");
        $this->db->close();
        return $q->result();
    }
    
    function getFAQID($id){
        $q = $this->db->query("SELECT * FROM portal_faq WHERE status='1' AND agreement_no='$id'");
        $this->db->close();
        return $q->result();
    }
    
    function getFAQActive($id){
        $q = $this->db->query("SELECT * FROM portal_faq WHERE agreement_no='$id' AND status='1'");
        $this->db->close();
        return $q->result();
    }
    
    function getFAQData($id){
        $q = $this->db->query("SELECT * FROM portal_faq WHERE faq_id='$id'");
        $this->db->close();
        return $q->result();
    }
    
    function checkFAQ($id){
        $q = $this->db->query("SELECT * FROM portal_faq WHERE agreement_no='$id' AND status='1'");
        $count = $q->num_rows();
        $this->db->close();
        return $count;
    }
    
    function deleteFAQ($id){
        $q = $this->db->query("UPDATE portal_faq SET status='0' WHERE agreement_no='$id'");
        $this->db->close();
        return true;
    }
    
    //***************************
   
    
    //***************************
    //start of audit function
    //***************************
    function getAudit(){
        $q = $this->db->query("SELECT * FROM portal_users LEFT JOIN portal_audit ON portal_users.user_id = portal_audit.user_id");
        $this->db->close();
        return $q->result();
    }
    
    function insertAudit($post){
        $this->db->insert("portal_audit",$post);
        $this->db->close();
        return $this->db->insert_id();
    }
    
    //***************************
    //start of download funciton
    //***************************
    
    function getDownload(){
        $q = $this->db->query("SELECT * FROM portal_dl_forms");
        $this->db->close();
        return $q->result();
    }
    
    function getDownloadActive($id){
        $q = $this->db->query("SELECT * FROM portal_dl_forms WHERE agreement_no='$id' AND status='1'");
        $this->db->close();
        return $q->result();
    }
    
    function getDownloadView($id){
        $q = $this->db->query("SELECT * FROM portal_dl_forms WHERE dl_id='$id'");
        $this->db->close();
        return $q->result();
    }
    
    function insertDownload($post){
        $this->db->insert("portal_dl_forms",$post);
        $this->db->close();
        return $this->db->insert_id();
    }
    
    function updateDownload($id,$data){
        $this->db->where('dl_id', $id);
        $this->db->update('portal_dl_forms', $data);
        $this->db->close();
        return true;
    }
    
    function activateDownload($id){
        $q = $this->db->query("UPDATE portal_dl_forms SET status='1' WHERE dl_id='$id'");
        $this->db->close();
        return true;
    }
    
    function deactivateDownload($id){
        $q = $this->db->query("UPDATE portal_dl_forms SET status='0' WHERE dl_id='$id'");
        $this->db->close();
        return true;
    }
    
    function deleteDownload($id){
        $this->db->where('dl_id', $id);
        $this->db->delete('portal_dl_forms'); 
        $this->db->close();
    }
    
    //***************************
    //start of ECU functions
    //***************************
    
    function getECU(){
        $q = $this->db->query("SELECT * FROM portal_ecu WHERE status='1' ORDER BY created DESC");
        $s = $q->result();
        $this->db->close();
        return $s;
    }
    
    function addECU($data){
        $this->db->insert('portal_ecu', $data); 			
        return $this->db->insert_id();	
    }
    
    
    //**************************
    //start of reimbursement
    //**************************
    
    function insertReimbursement($data){
        $this->db->insert('portal_reimbursement',$data);
        return $this->db->insert_id();
    }
}

?>