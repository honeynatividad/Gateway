<?php
/*
Author : Hanna
*/
class archive {

    private $config = array();
    private $buffer = NULL;
    private $lines = 0;    
    private $data = NULL;
    public function __construct() {
        
    //--------------        
       
    }
    function addAudit($id,$page,$action,$admin,$agreement_no,$first = NULL,$last = NULL){
        $CI =& get_instance();
        $CI->load->model("model_portal_users");
        $data = array(			
            "page_name"     =>  $page,
            "action_name"   =>  $action,
            "user_id"       =>  (string)$id,
            "status"        =>  1, 
            "is_admin"      =>  $admin,
            "agreement_no"  =>  (string)$agreement_no,
            "first_name"    =>  (string)$first,
            "last_name"     =>  (string)$last,
        );        
        $add = $CI->model_portal_admin->insertAudit($data);
        return true;
    }
    
    
}