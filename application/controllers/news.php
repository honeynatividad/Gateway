<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
    
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
        $renew = array("page_id"=>49);
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
              
            $data['username'] = $session_data['username'];
            $renew = array("page_id"=>49);
            $this->session->set_userdata('pages',$renew);			
            $id = $session_data['agreement_no'];
            $data['agreement_no'] = $id;
            $data['get_news'] = $this->model_portal_admin->getAllNewsActive($id);
            //$data['get_video'] = $this->model_portal_admin->getallVideo();
                
            $this->maintemp('cms/newslist',$data);		
        }else{
              //If no session, redirect to login page
            redirect('login', 'refresh');
        }		
    }
    
    function edit(){
        $data = array();
        $id = $this->uri->segment(3);
        $data['result'] = $this->model_portal_admin->getNews($id);
        
        $this->maintemp('cms/edit_news',$data);        
        if(isset($_REQUEST['submitnews'])){
            $data = array(			
                "title"=>$_POST['title'],
		"description"=>$_POST['description'],     
                "agreement_no" => $_POST['agreement_no']
			);
            $this->model_portal_admin->newsUpdate($id,$data);
            redirect("news");
        }
    }
    
    function deactivate(){
        $id = $this->uri->segment(3);        
        $news=$this->model_portal_admin->deactivateNews($id);
        if($news){
            redirect(base_url("news"));
        }else{
            redirect(base_url("news"));
        }
    }
    
    function activate(){
        $id = $this->uri->segment(3);        
        $news=$this->model_portal_admin->activateNews($id);
        if($news){
            redirect(base_url("news"));
        }else{
            redirect(base_url("news"));
        }
    }
    
    function create_news(){
        $renew = array("page_id"=>49);
        $this->session->set_userdata('pages',$renew);	

        if(isset($_REQUEST['submitnews'])){
        /*
         * march 14,2016
         * this is for thumbnail 
         * 
         *  $target_dir = $_SERVER["DOCUMENT_ROOT"]."/gateway/resources/video/".$_POST['agreement_no']."/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            //print_r($_FILES["fileToUpload"]);
            if( is_dir($target_dir) === false ){
                mkdir($target_dir,0777);
            }
         */
            $data = array(			
                "title"=>$_POST['title'],
                "description"=>$_POST['description'],
                "status" => 1,
                "is_video" => 0,
                "agreement_no" => $_POST['agreement_no']
            );
            $event=$this->model_portal_admin->insertNews($data);
            if($event){
                redirect("news/");
            }
        }
        $session_data = $this->session->userdata('logged_in');
              
        $data['username'] = $session_data['username'];
        $renew = array("page_id"=>49);
        $this->session->set_userdata('pages',$renew);			
        $id = $session_data['agreement_no'];
        $data['agreement_no'] = $id;
        $this->load->library('archive');
        $this->archive->addAudit($session_data['user_id'],'news','create_news','1',$session_data['agreement_no']);
	$this->maintemp('cms/create_news',$data);	
    }
    
    function video_add(){
        $renew = array("page_id"=>49);
        
        //phpinfo();
        $this->session->set_userdata('pages',$renew);		
        $session_data = $this->session->userdata('logged_in');
        $this->session->set_userdata('pages',$renew);			
        $id = $session_data['agreement_no'];
        $data['agreement_no'] = $id;        
        $data['logo'] = $this->model_portal_admin->getLogoActive($id);
        $this->maintemp('cms/video_add',$data);	
        if(isset($_REQUEST['submitnews'])){
            
            
           
            // Allow certain file formats
           $data = array(			
                "title"=>$_POST['title'],   
                    "file_name" => $_POST["fileToUpload"],
                    "agreement_no" => $_POST['agreement_no'],
                "status" => 1,                    
                );
            $event=$this->model_portal_admin->insertVideo($data);
            $this->load->library('archive');
            $this->archive->addAudit($session_data['user_id'],'news','video_add','1',$session_data['agreement_no']);
            if($event){
                redirect("news/video_list");
            }
            $msg_ok =  "The file ". basename( $_POST["fileToUpload"]). " has been uploaded.";
           // echo $msg_ok;
            $this->session->set_flashdata('upload_ok', $msg_ok);


                
        }
        
    }
    
    function video_edit(){
        if($this->session->userdata('logged_in')){
            $id = $this->uri->segment(3);
            $session_data = $this->session->userdata('logged_in');
              
            $data['username'] = $session_data['username'];
            $renew = array("page_id"=>49);
            $this->session->set_userdata('pages',$renew);			                
            
            if(isset($_REQUEST['submitnews'])){
                $target_dir = $_SERVER["DOCUMENT_ROOT"]."/gateway/resources/video/".$_POST['agreement_no']."/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                //print_r($_FILES["fileToUpload"]);
                if( is_dir($target_dir) === false ){
                    mkdir($target_dir,0777);
                }
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
                    chmod($target_dir,0755); //Change the file permissions if allowed
                    unlink($target_file);
			//echo "File will be overwrite.".$newpath."<br>";
			//$uploadOk = 0;
		}
                // Check file size

                // Allow certain file formats

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    //$msg =  "Sorry, your file was not uploaded.";
                    //$this->session->set_flashdata('upload_error', $msg);
                    $this->session->set_userdata('upload_error', $msg);
                // if everything is ok, try to upload file
                    redirect("news/video_edit/".$_POST['video_id']);
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $data = array(			
                        "title"=>$_POST['title'],   
                             "file_name" => $_POST['agreement_no']."/".$_FILES["fileToUpload"]["name"],
                            "agreement_no" => $_POST['agreement_no'],
                        "status" => 1,                            
                        );
                        $id = $_POST['video_id'];
                        $event=$this->model_portal_admin->updateVideo($id,$data);
                        //$session_data = $this->session->userdata('logged_in');
                        //$this->load->library('archive');
                        //$this->archive->addAudit($session_data['user_id'],'news','video_edit','1');
                        
                        
                        $msg_ok =  "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                        $this->session->set_flashdata('upload_ok', $msg_ok);
                        redirect("news/video_list");
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                        $this->session->set_flashdata('upload_error', "Sorry, there was an error uploading your file.");
                    }
                }

            }
            $session_data = $this->session->userdata('logged_in');
            $this->session->set_userdata('pages',$renew);			
            $ids = $session_data['agreement_no'];
            $data['agreement_no'] = $ids;
            $data['video_id'] = $id;
            $data['videos'] = $this->model_portal_admin->getVideo($id);
            $data['logo'] = $this->model_portal_admin->getLogoActive($ids);    
            $this->maintemp('cms/video_edit',$data);		
        }else{
              //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
    function video_list(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
              $ids = $session_data['agreement_no'];
            $data['username'] = $session_data['username'];
            $renew = array("page_id"=>49);
            $this->session->set_userdata('pages',$renew);			                
            
            $data['videos'] = $this->model_portal_admin->getAllVideoAgreement($ids);
                
            $this->maintemp('cms/video_list',$data);		
        }else{
              //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
    function video_activate(){
        $id = $this->uri->segment(3);        
        $news=$this->model_portal_admin->activateVideo($id);
        $session_data = $this->session->userdata('logged_in');
        $this->load->library('archive');
        $this->archive->addAudit($session_data['user_id'],'news','video_activate','1');
        if($news){
            redirect(base_url("news/video_list"));
        }else{
            redirect(base_url("news/video_list"));
        }
    }
    
    function video_deactivate(){
        $id = $this->uri->segment(3);        
        $news=$this->model_portal_admin->deactivateVideo($id);
        $session_data = $this->session->userdata('logged_in');
        $this->load->library('archive');
        $this->archive->addAudit($session_data['user_id'],'news','video_deactivate','1',$session_data['agreement_no']);
        if($news){
            redirect(base_url("news/video_list"));
        }else{
            redirect(base_url("news/video_list"));
        }
    }
    
    function truncate_chars($text, $limit, $ellipsis = '...') {
        if( strlen($text) > $limit ) 
            $text = trim(substr($text, 0, $limit)) . $ellipsis; 
        return $text;
    }
    
    function video_add_admin(){
        $renew = array("page_id"=>49);
        //phpinfo();
        $this->session->set_userdata('pages',$renew);		
        
        if(isset($_REQUEST['submitnews'])){
            $all=0;
            if(isset($_POST['upload_all'])){
                $target_dir = $_SERVER["DOCUMENT_ROOT"]."/gateway/resources/video/";
                $all = 1;
            }else{
                $target_dir = $_SERVER["DOCUMENT_ROOT"]."/gateway/resources/video/".$_POST['agreement_no']."/";
                $all = 0;
            }
            
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            if( is_dir($target_dir) === false ){
                mkdir($target_dir,0777,true);
            }
            
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    $msg = "File is an image - " . $check["mime"] . ".";
                   // $uploadOk = 1;
                } else {
                    $msg = "File is not an image.";
                   // $uploadOk = 0;
                }
                echo $msg;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $msg = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            
            if ($uploadOk == 0) {
                //$msg =  "Sorry, your file was not uploaded.";
                //$this->session->set_flashdata('upload_error', $msg);
                $this->session->set_userdata('upload_error', $msg);
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $agreement_no="";
                    if($all == 1){
                        $agreement_no = "";
                    }else{
                        $agreement_no = $_POST['agreement_no'];
                    }
                    $data = array(			
                        "title"=>$_POST['title'],   
                        "file_name" => $_POST['agreement_no']."/".$_FILES["fileToUpload"]["name"],
                        "agreement_no" => $agreement_no,
                        "status" => 1,                    
                    );
                    $event=$this->model_portal_admin->insertVideo($data);
                    //$session_data = $this->session->userdata('logged_in');
                    $this->load->library('archive');
                    $this->archive->addAudit($session_data['user_id'],'news','video_add_admin','1');
                    if($event){
                        redirect("news/video_all");
                    }
                    $msg_ok =  "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                   // echo $msg_ok;
                    $this->session->set_flashdata('upload_ok', $msg_ok);
                } else {
                    //echo "Sorry, there was an error uploading your file.";
                    $this->session->set_flashdata('upload_error', "Sorry, there was an error uploading your file.");
                }
            }
                
        }
        $session_data = $this->session->userdata('logged_in');
        $this->session->set_userdata('pages',$renew);			
        $id = $session_data['agreement_no'];
        $data['agreement_no'] = $id;        
        $data['logo'] = $this->model_portal_admin->getAllUserActive();
        $this->maintemp('cms/video_add_admin',$data);	
    }
    
    /*
     * for super admin
     */
    function news_all(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            
            if($session_data['level']==1){
                $data['username'] = $session_data['username'];
                $renew = array("page_id"=>49);
                $this->session->set_userdata('pages',$renew);			
                $id = $session_data['agreement_no'];
                $data['agreement_no'] = $id;
                $data['get_news'] = $this->model_portal_admin->getAllNews($id);
                //$data['get_video'] = $this->model_portal_admin->getallVideo();
                    
                $this->maintemp('cms/news_all',$data);		
            }else{
                redirect('news', 'refresh');
            }
              
            
        }else{
              //If no session, redirect to login page
            redirect('login', 'refresh');
        }		
    }
    
    function video_all(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            
            if($session_data['level']==1){
                $ids = $session_data['agreement_no'];
                $data['username'] = $session_data['username'];
                $renew = array("page_id"=>49);
                $this->session->set_userdata('pages',$renew);			                

                $data['videos'] = $this->model_portal_admin->getAllVideo($ids);

                $this->maintemp('cms/video_all',$data);		
            }else{
                redirect('news/video_list','refresh');
            }
            
        }else{
              //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
    function video_delete(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            
            if($session_data['level']==1){
                $id = $this->uri->segment(3);
                $del = $this->model_portal_admin->videoDelete($id);
                $this->session->set_flashdata('msg', 'Video was deleted');
                //$session_data = $this->session->userdata('logged_in');
                $this->load->library('archive');
                $this->archive->addAudit($session_data['user_id'],'news','video_delete','1');
                redirect('news/video_all');
            }
        }
    }
    
    function news_delete(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            
            if($session_data['level']==1){
                $id = $this->uri->segment(3);
                $del = $this->model_portal_admin->newsDelete($id);
                $this->session->set_flashdata('msg', 'News was deleted');
                //$session_data = $this->session->userdata('logged_in');
                $this->load->library('archive');
                $this->archive->addAudit($session_data['user_id'],'news','news_delete','1');
                redirect('news/news_all');
            }
        }
    }
    
    function video_edit_admin(){
        if($this->session->userdata('logged_in')){
            $id = $this->uri->segment(3);
            $session_data = $this->session->userdata('logged_in');
              
            $data['username'] = $session_data['username'];
            $renew = array("page_id"=>49);
            $this->session->set_userdata('pages',$renew);			                
            
            if(isset($_REQUEST['submitnews'])){
                $all=0;
                if(empty($_POST['agreement_no'])){
                    $target_dir = $_SERVER["DOCUMENT_ROOT"]."/gateway/resources/video/";
                    $all = 1;
                }else{
                    $target_dir = $_SERVER["DOCUMENT_ROOT"]."/gateway/resources/video/".$_POST['agreement_no']."/";
                    $all = 0;
                }
                //$target_dir = $_SERVER["DOCUMENT_ROOT"]."/gateway/resources/video/".$_POST['agreement_no']."/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                //print_r($_FILES["fileToUpload"]);
                $uploadOk = 1;
                
                if (file_exists($target_file)) {
                    chmod($target_dir,0755); //Change the file permissions if allowed
                    unlink($target_file);
		}
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

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    //$msg =  "Sorry, your file was not uploaded.";
                    //$this->session->set_flashdata('upload_error', $msg);
                    $this->session->set_userdata('upload_error', $msg);
                // if everything is ok, try to upload file
                    redirect("news/video_edit/".$_POST['video_id']);
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $agreement_no="";
                        if($all == 1){
                            $agreement_no = "";
                        }else{
                            $agreement_no = $_POST['agreement_no'];
                        }
                        $data = array(			
                        "title"=>$_POST['title'],   
                             "file_name" => $_POST['agreement_no']."/".$_FILES["fileToUpload"]["name"],
                            "agreement_no" => $agreement_no,
                        "status" => 1,                            
                        );
                        $id = $_POST['video_id'];
                        $event=$this->model_portal_admin->updateVideo($id,$data);
                        //$session_data = $this->session->userdata('logged_in');
                        $this->load->library('archive');
                        $this->archive->addAudit($session_data['user_id'],'news','video_edit_admin','1');
                        
                        
                        $msg_ok =  "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                        $this->session->set_flashdata('upload_ok', $msg_ok);
                        redirect("news/video_all");
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                        $this->session->set_flashdata('upload_error', "Sorry, there was an error uploading your file.");
                    }
                }

            }
            $session_data = $this->session->userdata('logged_in');
            $this->session->set_userdata('pages',$renew);			
            $ids = $session_data['agreement_no'];
            $data['agreement_no'] = $ids;
            $data['video_id'] = $id;
            $data['videos'] = $this->model_portal_admin->getVideo($id);
            $data['logo'] = $this->model_portal_admin->getLogoWithStatus();
            $this->maintemp('cms/video_edit_admin',$data);		
        }else{
              //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
        
}