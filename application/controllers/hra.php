<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hra extends CI_Controller {
    private $userid;
    private $certid;

    function __construct(){
        parent::__construct();	
        $this->load->model("model_portal_users");
        $this->load->model("model_portal_admin");
        $session_data = $this->session->userdata('logged_in');
         
        

         if(!$session_data){
                 redirect("login");
         }
         //$data['username'] = $session_data['username'];	
         $data = $session_data;
         //echo '<pre>';
         //print_r($data);
         //echo '</pre>';
        //page renew

        $this->userid = $session_data['user_id'];
        $renew = array("page_id"=>2);
        $this->session->set_userdata('pages',$renew);	

        $this->certid=$session_data['certid'];


    }
    function maintemp($temp,$data){
        $this->load->view('header',$data);
        $this->load->view($temp,$data);
        $this->load->view('footer');
    }

    function index(){        
        $session_data = $this->session->userdata('logged_in');
        
        $data['certno'] = $session_data['user_id'];
        $memdetails = $this->wslibrary->getMembersInfo($session_data['MemberCertNo']);
        $this->load->library('archive');
        $this->archive->addAudit($memdetails->CertNo,'hra','index','0',$memdetails->AgreementNo,$memdetails->FirstName,$memdetails->LastName);
                        
        $this->load->view('hra',$data);
    }
}