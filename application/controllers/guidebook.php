<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guidebook extends CI_Controller {
    private $user;
    private $certid;
    function __construct(){
        parent::__construct();	
        $this->load->helper(array('form', 'url'));
        
        $this->load->model("model_portal_users");
        $this->load->model("model_portal_admin");
        $this->load->model("model_portal_feedback");
        $session_data = $this->session->userdata('logged_in');
        $this->level=$session_data['level'];
        if(!$session_data){            
            redirect("login");
        }
        
        if($session_data['level']==3 ){
           redirect("admin");
        }        
        $data['username'] = $session_data['username'];	
		//page renew
        $renew = array("page_id"=>74);
        $this->session->set_userdata('pages',$renew);
        $this->agreeement = $session_data['agreement_no'];

    }
    
    function maintemp($temp,$data){
        $this->load->view('header',$data);
        $this->load->view($temp,$data);
        $this->load->view('footer');
    }
    
    function index(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
              
            $data['username'] = $session_data['username'];
            $renew = array("page_id"=>74);
            $data['guidebooks'] = $this->model_portal_admin->getAllGuidebook();
            $this->maintemp('cms/guidebook',$data);	
        }else{
            redirect('login', 'refresh');
        }
    }
    
    function add(){
        $renew = array("page_id"=>74);
		 
		 
        $this->session->set_userdata('pages',$renew);		
        if(isset($_REQUEST['submitnews'])){
            
            $target_dir = $_SERVER["DOCUMENT_ROOT"]."/gateway/resources/pdf/".$_POST['agreement_no']."/";
            
            if( is_dir($target_dir) === false ){
                mkdir($target_dir);
            }
            
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    $msg = "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $msg = "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $msg = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
           
            // Allow certain file formats
           //print_r($imageFileType);
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                //$msg =  "Sorry, your file was not uploaded.";
                //$this->session->set_flashdata('upload_error', $msg);
                $this->session->set_userdata('upload_error', $msg);
            // if everything is ok, try to upload file
            } else {
				print_r($_FILES["fileToUpload"]);
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $data = array(			
                    "title"=>$_POST['title'],   
                        "file_name" => $_FILES["fileToUpload"]["name"],
                        "agreement_no" => $_POST['agreement_no'],
                    "status" => 1,                    
                    );
                    $event=$this->model_portal_admin->insertGuidebook($data);
                    $session_data = $this->session->userdata('logged_in');
                    $this->load->library('archive');
                    
                    $this->archive->addAudit($session_data['user_id'],'guidebook','add','1',$_POST['agreement_no']);
                    if($event){
                        redirect("guidebook");
                    }
                    $msg_ok =  "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    $this->session->set_flashdata('upload_ok', $msg_ok);
                } else {
                    //echo "Sorry, there was an error uploading your file.";
                    $this->session->set_flashdata('upload_error', "Sorry, there was an error uploading your file.");
                }
            }
                
        }
        $session_data = $this->session->userdata('logged_in');
        
        $id = $session_data['agreement_no'];
        $data['agreement_no'] = $id;
        
        $data['guidebooks'] = $this->model_portal_admin->getGuidebookActive($id);
        $data['logo'] = $this->model_portal_admin->getAllUserActive();		
        $this->maintemp('cms/create_guidebook',$data);	
    }
    
    function edit(){
        if($this->session->userdata('logged_in')){
            $id = $this->uri->segment(3);
            $session_data = $this->session->userdata('logged_in');
              
            $data['username'] = $session_data['username'];
            $renew = array("page_id"=>74);
            $this->session->set_userdata('pages',$renew);			                
            
            if(isset($_REQUEST['submitnews'])){                
                $target_dir = $_SERVER["DOCUMENT_ROOT"]."/gateway/resources/pdf/".$_POST['agreement_no']."/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        $msg = "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        $msg = "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if(file_exists($target_file)) unlink($target_file);
                
               
                if ($uploadOk == 0) {
                    //$msg =  "Sorry, your file was not uploaded.";
                    //$this->session->set_flashdata('upload_error', $msg);
                    $this->session->set_userdata('upload_error', $msg);
                // if everything is ok, try to upload file
                } else {
                    

                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $data = array(			
                            "title"=>$_POST['title'],   
                            "file_name" => $_FILES["fileToUpload"]["name"],
                            "agreement_no" => $_POST['agreement_no'],
                            "status" => 1,                            
                        );
                        $id = $_POST['video_id'];
                        $event=$this->model_portal_admin->updateGuidebook($id,$data);
                        if($event){
                            $session_data = $this->session->userdata('logged_in');
                            $this->load->library('archive');
                            $this->archive->addAudit($session_data['user_id'],'guidebook','edit','1');
                                redirect("guidebook");
                        }
                        $msg_ok =  "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                        $this->session->set_flashdata('upload_ok', $msg_ok);
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                        $this->session->set_flashdata('upload_error', "Sorry, there was an error uploading your file.");
                    }
                }

            }
            
            $data['guidebook_id'] = $id;
            $data['guidebooks'] = $this->model_portal_admin->getGuidebook($id);
            $logos = $this->model_portal_admin->getUserActive($id);  
            $agreement = '';
            print_r($logos);
            foreach($logos as $l){
                $agreeement = $l->agreement_no;
            }
            $data['agreement_no'] = $agreement;
            $this->maintemp('cms/edit_guidebook',$data);		
        }else{
              //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
    function deactivate(){
        $id = $this->uri->segment(3);        
        $news=$this->model_portal_admin->deactivateGuidebook($id);
        if($news){
            $session_data = $this->session->userdata('logged_in');
            $this->load->library('archive');
            $this->archive->addAudit($session_data['user_id'],'guidebook','deactivate','1');
            redirect(base_url("guidebook"));
        }else{
            redirect(base_url("guidebook"));
        }
    }
    
    function activate(){
        $id = $this->uri->segment(3);        
        $news=$this->model_portal_admin->activateGuidebook($id);
        if($news){
            $session_data = $this->session->userdata('logged_in');
            $this->load->library('archive');
            $this->archive->addAudit($session_data['user_id'],'guidebook','activate','1');
            redirect(base_url("guidebook"));
        }else{
            redirect(base_url("guidebook"));
        }
    }
    
    function guidebook_list(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $id = $session_data['agreement_no'];
            $data['username'] = $session_data['username'];
            $renew = array("page_id"=>74);
            $data['guidebooks'] = $this->model_portal_admin->getGuidebookActive($id);
            $this->maintemp('cms/guidebook_list',$data);	
        }else{
            //redirect('login', 'refresh');
        }
    }
    
    /****
     * for super admin
     */
    function all(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
              
            $data['username'] = $session_data['username'];
            $renew = array("page_id"=>74);
            $data['guidebooks'] = $this->model_portal_admin->getAllGuidebook();
            $this->maintemp('cms/guidebook',$data);	
        }else{
            redirect('login', 'refresh');
        }
    }
    
    function delete(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            
            if($session_data['level']==1){
                $id = $this->uri->segment(3);
                $del = $this->model_portal_admin->guidebookDelete($id);
                $session_data = $this->session->userdata('logged_in');
                $this->load->library('archive');
                $this->archive->addAudit($session_data['user_id'],'guidebook','delete','1');
                $this->session->set_flashdata('msg', 'Guidebook was deleted');
                redirect('guidebook');
            }
        }
    }
}