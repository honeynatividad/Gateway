<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reimbursement extends CI_Controller {
    private $user;
    private $certid;
    private $agreement;
    function __construct(){
        parent::__construct();	
        $this->load->model("model_portal_users");
        $this->load->model("model_portal_calendar");
        $this->load->model("model_portal_admin");
		
        $session_data = $this->session->userdata('logged_in');
        if(!$session_data){
            redirect("login");
        }
        $data['username'] = $session_data['username'];	
        //page renew
        $renew = array("page_id"=>46);
        $this->session->set_userdata('pages',$renew);
        $this->certid=$session_data['certid'];
        $this->agreeement = $session_data['agreement_no'];
        $this->certid=$session_data['certid'];
    }
    function maintemp($temp,$data){
        $this->load->view('header',$data);
        $this->load->view($temp,$data);
        $this->load->view('footer');
    }
    
    function index(){
        
    }
    
    function request(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');            
            
            $renew = array("page_id"=>47);
            $this->session->set_userdata('pages',$renew);		
            if(isset($_REQUEST['submitevent'])){

                $target_dir = $_SERVER["DOCUMENT_ROOT"]."/gateway/resources/reimbursement/".$_POST['agreement_no']."/";

                if( is_dir($target_dir) === false ){
                    mkdir($target_dir,0777);
                }

                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                
                if (file_exists($target_file)) {
                    chmod($target_dir,0755); //Change the file permissions if allowed
                    unlink($target_file);		
		}
                
                // Check if $uploadOk is set to 0 by an error
                if ($_FILES["fileToUpload"]["size"] > 2000000) {
                        //echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                    $this->session->set_flashdata('upload_error', 'Sorry, you reached maximum limit of 2 mb.');
                }
                if ($uploadOk == 0) {
                    $msg =  "Sorry, you reached maximum limit of 2 mb.";
                    
                    
                    $this->session->set_flashdata('upload_error', 'Sorry, you reached maximum limit of 2 mb.');
                    redirect("reimbursement/request",'refresh');
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        //call webservice to send reimbursement
                        $data = array(
                            "date"          =>  $_POST['ev_date'],
                            "description"   =>  $_POST['description'],
                            "attachment"    =>  $_FILES['fileToUpload']['name']
                        );
                        //$reimbursement = $this->wslibrary->setReimbursement($_REQUEST);
                        $session_data = $this->session->userdata('logged_in');
                        
                        $this->load->library('archive');
                        $this->archive->addAudit($session_data['certid'],'reimbursement','request','0',$this->agreement);
                        
                        $msg_ok =  "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                        //$this->session->set_flashdata('upload_ok', $msg_ok);
                        $request_date= $_POST['ev_date'];
                        $description = $_POST['description'];
                        $others = $_POST['others'];
                        $attachment = $target_file;
						
                        $d = array(
                            "date_availed"          =>  $request_date,
                            "description"           =>  $description,
                            "attachment_file"       =>  $target_file,
                            "status"                =>  1,
                            "cert_no"               =>  $this->certid,
                            "others"                => $others
                        );
						
						$file_path = 'http://'.$_SERVER['HTTP_HOST'].'/gateway/resources/reimbursement/'.$_POST['agreement_no'].'/'.basename($_FILES["fileToUpload"]["name"]);
                        //$set = $this->wslibrary->setReimbursement($this->certid,$request_date,$description,$file_path);
                       // print_r($set);
                        //if($set){
                            $insert = $this->model_portal_admin->insertReimbursement($d);
							$this->send_mail('hanna.natividad@philcare.com.ph','TTECH Request for Reimbursement',$d);
                            $this->session->set_flashdata('upload_ok', 'Successfully send a reimbursement request ');
                        //}else{
                        //    $this->session->set_flashdata('upload_errors', $set->MessageReturn);
                        //}
                        
                        
                        redirect("reimbursement/request",'refresh');
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                        $this->session->set_flashdata('upload_error', "Sorry, there was an error uploading your file.");
                    }
                }
                //call webservice for 
                
            }
            $data['agreement_no'] = $session_data['agreement_no'];
            $this->maintemp('request',$data);
            
        }else{
            $this->session->set_flashdata('error_access', "You are not allowed to access this page.");
            redirect('reimbursement/history','refresh');
        }
    }
    
    function history(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');            
            
            $renew = array("page_id"=>47);
            $this->session->set_userdata('pages',$renew);
            $this->maintemp('reimbursement_history',array());
        }
    }
	function test(){
		$t = $this->send_mail("hanna.natividad@philcare.com.ph","This is my email for you");
		//print_r($t);
	}
    public function send_mail($to,$subject,$d) {
		
        $this->load->library('My_PHPMailer');
        $mail = new PHPMailer();	
		//$mail->SMTPDebug = 2;       
        $mail->SMTPAuth   = false; 
        $mail->SMTPSecure = "ssl"; 
        $mail->Host       = '172.16.255.6'; 
        $mail->Port       = 25; 
        $mail->Username   = 'advisory@philcare.com.ph'; 
        $mail->Password   = 'P@ssw0rd'; 
        $mail->SetFrom('advisory@philcare.com.ph','PhilCare Advisory');  
        
        $destino = $to;         
        //$mail->addAddress('Rosemarie.Sangalang@PhilCare.com.ph');        
        $mail->addAddress('teletechclaims@philcare.com.ph');
        $mail->AddBCC("Rosemarie.Sangalang@PhilCare.com.ph");
        $mail->AddBCC($to);        
        $mail->IsHTML(true);
        $mail->Subject    = $subject;

        $session_data = $this->session->userdata('logged_in');
        $mail->AddAttachment($d['attachment_file']);
        $mail->AddEmbeddedImage($d['attachment_file'], "my-attach");
		$message = "<html>
        <head>
        <title></title>
        </head>
        <body>
        <br><br>
        <h4>Dear All,</h4>
        <p>Please be informed that there is a request for Reimbursement, please see details below.</p>
		<p><b>DATE:</b>".$d['date_availed']." </p>
		<p><b>AGREEEMENT NO:</b>".$session_data['agreement_no']." </p>		
                <p><b>Certificate No: ".$session_data['MemberCertNo']."</b></p>
		<p><b>LAST NAME:</b> ".$session_data['LastName']."</p>
		<p><b>FIRST NAME:</b> ".$session_data['FirstName']."</p>
		<p><b>MIDDLE INITIAL:</b> ".$session_data['MiddleInitial']."</p>
		<p><b>EMAIL ADDRESS:</b> ".$session_data['EmailAdd']."</p>
		<p><b>DESCRIPTION:</b> ".$d['description']."</p>
        <p><b>Reimbursement Type:</b> ".$d['others']."</p>
		<p><b>Mobile No:</b> ".$session_data['ContactNo']."</p>
        <div>Sincerely,<br>PhilCare</div><br>
        
        <p>(This email is auto-generated. Please do not reply.)</p>

        <table>
        <tbody>
        <tr>
        <td>
        &copy; PhilhealthCare, Inc.m 4th and 5th floor, STI Holdings Center, 6764 Ayala Avenue, Makati City, Philippines
        </td>
        </tr>
        </tbody>
        </table>
        </body>
        </html>
		
		";
		$msg =$message;
        $mail->Body = $msg;
        //$mail->AltBody    = "Plain text message";
        
        

        if(!$mail->Send()) {
            $data["message"] = "Error: " . $mail->ErrorInfo;
			//echo "Mailer Error: " . $mail->ErrorInfo;
			//print_r(error_get_last());
			
        } else {
            $data["message"] = "Message sent correctly!";
        }
		
		return json_encode($data);
    }
}