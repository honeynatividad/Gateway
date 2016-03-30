<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloads extends CI_Controller {
    
    function __construct(){
        parent::__construct();	
        $this->load->model("model_portal_users");
        $this->load->model("model_portal_admin");
        $this->load->model("model_portal_feedback");
        $session_data = $this->session->userdata('logged_in');
        $this->level=$session_data['level'];
         //var_dump($session_data);
        
        if(!$session_data){
            
            redirect("login");
        }
        $data['username'] = $session_data['username'];	
		//page renew
        $renew = array("page_id"=>89);
        $this->session->set_userdata('pages',$renew);
    }
    
    function maintemp($temp,$data){
            $this->load->view('header',$data);
            $this->load->view($temp,$data);
            $this->load->view('footer');
    }

    function index(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            if($session_data['level']==1){
                $data['username'] = $session_data['username'];
                $renew = array("page_id"=>90);
                $this->session->set_userdata('pages',$renew);	
                $data['downloads'] = $this->model_portal_admin->getDownload();

                $this->maintemp('download',$data);		
            }else{
                redirect('download/list_all','refresh');
            }
        }
        else
        {
          //If no session, redirect to login page
          redirect('login', 'refresh');
        }

    }
    
    
    function delete(){
        $session_data = $this->session->userdata('logged_in');
        if($session_data['level']==1){           
            $id = $this->uri->segment(3);        
            $logo=$this->model_portal_admin->deleteDownload($id);
            if($logo){         
                $this->load->library('archive');
                $this->archive->addAudit($session_data['user_id'],'download','activate','1');
                redirect(base_url("downloads"));
            }else{
                redirect(base_url("downloads"));
            }
        }
    }
    
    function activate(){        
        $session_data = $this->session->userdata('logged_in');
        if($session_data['level']==1 || $session_data['level']==2){
           
            $id = $this->uri->segment(3);        
            $logo=$this->model_portal_admin->activateDownload($id);
            if($logo){         
                $this->load->library('archive');
                $this->archive->addAudit($session_data['user_id'],'download','activate','1');
                redirect(base_url("downloads"));
            }else{
                redirect(base_url("downloads"));
            }
        }
    }
    
    function deactivate(){
        $session_data = $this->session->userdata('logged_in');
        if($session_data['level']==1 || $session_data['level']==2){
            $id = $this->uri->segment(3);        
            $logo=$this->model_portal_admin->deactivateDownload($id);
            if($logo){         
                $this->load->library('archive');
                $this->archive->addAudit($session_data['user_id'],'download','deactivate','1',$session_data['agreement_no']);
                redirect(base_url("downloads"));
            }else{
                redirect(base_url("downloads"));
            }
        }
    }
    
    function list_all(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            if($session_data['level']==2){
                $data['username'] = $session_data['username'];
                $renew = array("page_id"=>90);
                $this->session->set_userdata('pages',$renew);	
                $data['downloads'] = $this->model_portal_admin->getDownloadActive($session_data['agreement_no']);

                $this->maintemp('download',$data);		
            }            
        }
        else
        {
          //If no session, redirect to login page
          redirect('login', 'refresh');
        }
    }
    
    function member(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            
            $data['username'] = $session_data['username'];
            $renew = array("page_id"=>90);
            $this->session->set_userdata('pages',$renew);	
            $data['downloads'] = $this->model_portal_admin->getDownloadActive($session_data['agreement_no']);
           
            $this->maintemp('member',$data);		
        }
        else
        {
          //If no session, redirect to login page
          redirect('login', 'refresh');
        }
    }
    
    function pdf(){
       
        $file = base_url("resources/pdf/").$this->uri->segment(3)."/".$this->uri->segment(4);
        $path = $_SERVER['DOCUMENT_ROOT']."/gateway/resources/pdf/".$this->uri->segment(3)."/"; // change the path to fit your     websites document structure
        
        $fullPath = $path.basename($this->uri->segment(4));
        //print_r($fullPath);
        if (is_readable ($fullPath)) {
        $fsize = filesize($fullPath);
        $path_parts = pathinfo($fullPath);
        $ext = strtolower($path_parts["extension"]);
        switch ($ext) {
            case "pdf":
            header("Content-type: application/pdf"); // add here more headers for diff.     extensions
            header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");     // use 'attachment' to force a download
            break;
            default;
            header("Content-type: application/octet-stream");
            header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
        }
        header("Content-length: $fsize");
        header("Cache-control: private"); //use this to open files directly
        readfile($fullPath);
        exit;
        } else {
                die("Invalid request");
        }
    }
    
    function create(){
        $renew = array("page_id"=>90);
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
           
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                //$msg =  "Sorry, your file was not uploaded.";
                //$this->session->set_flashdata('upload_error', $msg);
                $this->session->set_userdata('upload_error', $msg);
                
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $data = array(			
                        "dl_name"=>$_POST['dl_name'],   
                        "dl_url" => $_POST["agreement_no"]."/".$_FILES["fileToUpload"]["name"],
                        "agreement_no" => $_POST['agreement_no'],
                        "status" => 1,                    
                    );
                    $event=$this->model_portal_admin->insertDownload($data);
                    $session_data = $this->session->userdata('logged_in');
                    $this->load->library('archive');
                    $this->archive->addAudit($session_data['user_id'],'download','add','1',$session_data['agreement_no']);
                    if($event){
                        redirect("downloads/list_all");
                    }
                    $msg_ok =  "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    $this->session->set_flashdata('upload_ok', $msg_ok);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    $this->session->set_flashdata('upload_error', "Sorry, there was an error uploading your file.");
                }
            }
                
        }
        $session_data = $this->session->userdata('logged_in');
        if($session_data['level']==1 || $session_data['level']==2){
            $id = $session_data['agreement_no'];
            $data['agreement_no'] = $id;

            $data['logo'] = $this->model_portal_admin->getLogoActive($id);
            $this->maintemp('create_download',$data);	
        }else{
            redirect('downloads','refresh');
        }
        
    }
    
    function edit(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            if($session_data['level']==1 || $session_data['level']==2){
                
                $id = $this->uri->segment(3);
                $session_data = $this->session->userdata('logged_in');

                $data['username'] = $session_data['username'];
                $renew = array("page_id"=>90);
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

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        //$msg =  "Sorry, your file was not uploaded.";
                        //$this->session->set_flashdata('upload_error', $msg);
                        $this->session->set_userdata('upload_error', $msg);
                    // if everything is ok, try to upload file
                    } else {

                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            $data = array(			
                            "dl_name"=>$_POST['dl_name'],   
                            "dl_url" => $_POST["agreement_no"]."/".$_FILES["fileToUpload"]["name"],
                            "agreement_no" => $_POST['agreement_no'],
                            "status" => 1,                    
                        );
                            $id = $_POST['dl_id'];
                            $event=$this->model_portal_admin->updateDownload($id,$data);
                            if($event){
                                $session_data = $this->session->userdata('logged_in');
                                $this->load->library('archive');
                                $this->archive->addAudit($session_data['user_id'],'download','edit','1',$session_data['agreement_no']);
                                    redirect("download/list_all");
                            }
                            $msg_ok =  "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                            $this->session->set_flashdata('upload_ok', $msg_ok);
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                            $this->session->set_flashdata('upload_error', "Sorry, there was an error uploading your file.");
                        }
                    }
                }            
                $data['dl_id'] = $id;
                $data['agreement_no'] = $session_data['agreement_no'];
                $data['downloads'] = $this->model_portal_admin->getDownloadView($id);
                $data['logo'] = $this->model_portal_admin->getLogoActive($id);    
                $this->maintemp('cms/edit_download',$data);	
            }
            	
        }else{
              //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
    function create_admin(){
        $renew = array("page_id"=>90);
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
           
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                //$msg =  "Sorry, your file was not uploaded.";
                //$this->session->set_flashdata('upload_error', $msg);
                $this->session->set_userdata('upload_error', $msg);
                
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $data = array(			
                        "dl_name"=>$_POST['dl_name'],   
                        "dl_url" => $_POST["agreement_no"]."/".$_FILES["fileToUpload"]["name"],
                        "agreement_no" => $_POST['agreement_no'],
                        "status" => 1,                    
                    );
                    $event=$this->model_portal_admin->insertDownload($data);
                    $session_data = $this->session->userdata('logged_in');
                    $this->load->library('archive');
                    $this->archive->addAudit($session_data['user_id'],'download','add admin','1');
                    if($event){
                        redirect("downloads");
                    }
                    $msg_ok =  "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    $this->session->set_flashdata('upload_ok', $msg_ok);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    $this->session->set_flashdata('upload_error', "Sorry, there was an error uploading your file.");
                }
            }
                
        }
        $session_data = $this->session->userdata('logged_in');
        if($session_data['level']==1){//for philadmin only
            $id = $session_data['agreement_no'];
            $data['agreement_no'] = $id;

            $data['users'] = $this->model_portal_admin->getAllUserActive();
            $this->maintemp('cms/create_download',$data);	
        }else{
            redirect('downloads','refresh');
        }
    }
}