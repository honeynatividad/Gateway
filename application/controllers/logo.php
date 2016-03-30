<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logo extends CI_Controller {
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
        $data['username'] = $session_data['username'];	
		//page renew
        $renew = array("page_id"=>55);
        $this->session->set_userdata('pages',$renew);

    }
    
    function maintemp($temp,$data){
        $this->load->view('header',$data);
        $this->load->view($temp,$data);
        $this->load->view('footer');
    }
    
    public function index(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            if($session_data['level']==1){
                $data['username'] = $session_data['username'];
                $renew = array("page_id"=>55);
                $this->session->set_userdata('pages',$renew);			
                $data['logos'] = $this->model_portal_admin->getAllLogo();
                //$test = $this->model_portal_admin->testInsert();
                //$test = $this->model_portal_admin->testModel();    
                //echo '<pre>';
               // print_r($test);
                //echo '</pre>';
                $this->maintemp('cms/logo',$data);		
            }elseif($session_data['level']==2){
                redirect('logo/view_list','refresh');
            }  
            
        }else{
              //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
    public function add(){
        
        $renew = array("page_id"=>55);
        $this->session->set_userdata('pages',$renew);		
        //$this->load->view('upload_form', array('error' => ' ' ));
        $session_data = $this->session->userdata('logged_in');
        if($session_data['level']==1){
            $this->maintemp('cms/create_logo',array('error' => ' ' ));
        }else{
            redirect("login","refresh");
        }
        //$this->load->library('archive');
        //$this->archive->addAudit($session_data['user_id'],'logo','add','1');
        
    }
    
    public function edit(){
        $data = array();
        $id = $this->uri->segment(3);
        $data['result'] = $this->model_portal_admin->getLogo($id);
        $data['error'] = ' ';
        $data['logo_id'] = $id;
        $session_data = $this->session->userdata('logged_in');
        $this->load->library('archive');
        $this->archive->addAudit($session_data['user_id'],'logo','edit','1');
        $this->maintemp('cms/edit_logo',$data);        
        
    }
    
    public function deactivate(){
        $id = $this->uri->segment(3);        
        $logo=$this->model_portal_admin->deactivateLogo($id);
        
        if($news){
            $session_data = $this->session->userdata('logged_in');
            $this->load->library('archive');
            $this->archive->addAudit($session_data['user_id'],'logo','deactivate','1');
            redirect(base_url("logo"));
        }else{
            redirect(base_url("logo"));
        }
    }
    
    function delete(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            
            if($session_data['level']==1){
                $id = $this->uri->segment(3);
                $del = $this->model_portal_admin->logoDelete($id);
                $session_data = $this->session->userdata('logged_in');
                $this->load->library('archive');
                $this->archive->addAudit($session_data['user_id'],'logo','delete','1');
                $this->session->set_flashdata('msg', 'Logo was deleted');
                redirect('logo');
            }
        }
    }
    public function activate(){
        $id = $this->uri->segment(3);        
        $logo=$this->model_portal_admin->activateLogo($id);
        if($news){
            $session_data = $this->session->userdata('logged_in');
            $this->load->library('archive');
            $this->archive->addAudit($session_data['user_id'],'logo','activate','1');
            redirect(base_url("logo"));
        }else{
            redirect(base_url("logo"));
        }
    }
    
    function uploader($files){
        //error_reporting(0);
        
    }
    
    function do_upload() {
        $config = array(
            //'upload_path'   => base_url('upload/logo'),
            'upload_path'   => 'upload/logo/',
            'allowed_types' => 'gif|jpg|png',
            'max_size'      => '10000000',
            'max_width'     => '2056',
            'max_height'    => '768',
            'encrypt_name'  => true,
        );

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            //$this->load->view('cms/create_logo', $error);
            redirect("logo/add");
        } else {
            $upload_data = $this->upload->data();
           // print_r($upload_data);
            $data_ary = array(
                'agreement_no'     => $_POST['agreement_no'],
                'agreement_name'      => $_POST['agreement_name'],
                'image_url'     => 'upload/logo/'.$upload_data['file_name'],
                'status'    =>'1'
            );
            
            $count = $this->model_portal_admin->checkLogo($_POST['agreement_no']);
            if($count==1){
                $this->session->set_flashdata('login_error', "Sorry, Agreement No already exist.");
                redirect("logo");
            }else{
                $this->load->database();
                $this->db->insert('portal_logo', $data_ary);

                //$data = array('upload_data' => $upload_data);
                redirect("logo");
            }

            
        }
    }
    
    function do_update() {
        $config = array(
            //'upload_path'   => base_url('upload/logo'),
            'upload_path'   => 'upload/logo/',
            'allowed_types' => 'gif|jpg|png',
            'max_size'      => '10000000',
            'max_width'     => '2056',
            'max_height'    => '768',
            'encrypt_name'  => true,
        );

        $this->load->library('upload', $config);
        $id = $this->uri->segment(3);
        if (!$this->upload->do_upload()) {
            $id = $this->uri->segment(3);
            $error = array('error' => $this->upload->display_errors());
            //$this->load->view('cms/create_logo', $error);
            redirect("logo/edit/".$id);
        } else {
           // $id = $this->uri->segment(3);
            $upload_data = $this->upload->data();
            $id = $_POST['logo_id'];
            $data_ary = array(
                'agreement_no'     => $_POST['agreement_no'],
                'agreement_name'      => $_POST['agreement_name'],
                'image_url'     => 'upload/logo/'.$upload_data['file_name'],
                'status'    =>'1'
            );
            //print_r("test->".$id);
            //$this->load->database();
            //$this->db->where("logo_id",$id);            
            //$this->db->update('portal_logo', $data_ary);
            $this->model_portal_admin->logoUpdate($id,$data_ary);
            
            //$data = array('upload_data' => $upload_data);
            redirect("logo/view_list");
        }
    }
    
    function view_list(){
         if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $id = $session_data['agreement_no'];
            $data['username'] = $session_data['username'];
            $renew = array("page_id"=>55);
            $this->session->set_userdata('pages',$renew);			
            $data['logos'] = $this->model_portal_admin->getLogoActive($id);
            
            $this->maintemp('list_logo',$data);		
        }else{
              //If no session, redirect to login page
            redirect('login', 'refresh');
        }    
   
    }
}