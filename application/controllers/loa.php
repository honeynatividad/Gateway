<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loa extends CI_Controller {
    
    function __construct(){
        parent::__construct();	
        $this->load->model("model_portal_users");
        $this->load->model("model_portal_admin");
        $this->load->model("model_portal_feedback");
        $session_data = $this->session->userdata('logged_in');
        $this->level=$session_data['level'];
         //var_dump($session_data);         
        
        $data['username'] = $session_data['username'];	
		//page renew
        $renew = array("page_id"=>46);
        $this->session->set_userdata('pages',$renew);
    }
    
    public function index(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
              
            $data['username'] = $session_data['username'];
            $renew = array("page_id"=>49);
            $this->session->set_userdata('pages',$renew);			
                //echo '<pre>';
                //    print_r($session_data);
                //echo '</pre>';
            
                
            $this->maintemp('loa',$data);		
        }else{              //If no session, redirect to login page
            redirect('login', 'refresh');
        }	
    }
    
    function maintemp($temp,$data){
        $this->load->view('header',$data);
        $this->load->view($temp,$data);
        $this->load->view('footer');
    }
}