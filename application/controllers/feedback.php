<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {
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
        $renew = array("page_id"=>65);
        $this->session->set_userdata('pages',$renew);	
    }
    function maintemp($temp,$data){
        $this->load->view('header',$data);
        $this->load->view($temp,$data);
        $this->load->view('footer');
    }
    
    function index(){
        $this->maintemp('feedback',array());
        $session_data = $this->session->userdata('logged_in');
        if(isset($_POST['submit'])){
            $category = $_POST['category'];
            $subcategory = $_POST['subcategory'];
            $comment = $_POST['comment'];
            $certno = $session_data['MemberCertNo'];
            $email = $session_data['EmailAdd'];
            $data = array(
                "category"      => $category,
                "sub_category"  => $subcategory,
                "feedback"      => $comment,
                "cert_no"       => $certno,
                "status"        => 1,
                "email_add"     => $email
                );
            
            $insert = $this->model_portal_admin->feedback_add($data);
            $data['first_name'] = $session_data['FirstName'];
            $data['last_name'] = $session_data['LastName'];
            $data['agreement_no'] = $session_data['agreement_no'];
            $this->send_mail($email, $category, $data);
            $this->session->set_flashdata('success', "Feed was sent successfully.");
            redirect("feedback/view_feedback",'refresh');
        }
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
        $mail->AddAddress("hanna.natividad@PhilCare.com.ph");
        //$mail->addAddress('hanna.natividad@philcare.com.ph');
        //$mail->addAddress('teletechclaims@philcare.com.ph');
        $mail->IsHTML(true);
        $mail->Subject    = $subject;

       
        
		$message = "<html>
        <head>
        <title></title>
        </head>
        <body>
        <br><br>
        <h4>Dear All,</h4>
         <p>Sent by: ".$d['first_name']." ".$d['last_name']."</p>
        <p>Agreement No: ".$d['agreement_no']."</p>     
        <p>Cert No: ".$d['cert_no']."</p>     
        <p>Email Add: ".$to."</p>     
        <p>Customer Feedback:</p>
        <br>
        <p>".$d['feedback']."</p>
        <hr>
       
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
    
    function view_feedback(){
        $session_data = $this->session->userdata('logged_in');
        $certno = $session_data['MemberCertNo'];
        
        $data['feedbacks'] = $this->model_portal_admin->feedback_history($certno);
        $this->maintemp('view_feedback',$data);
    }
    
    function view(){
        $id = $this->uri->segment(3);     
        $session_data = $this->session->userdata('logged_in');
        $certno = $session_data['MemberCertNo'];
        $data['feedbacks'] = $this->model_portal_admin->feedback_view($id);
        $this->maintemp('feedback_view',$data);
    }
    
    function getSubcategory(){
        if(isset($_POST['category'])){
            $random = rand(1, 115);
        ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Sub Category</label>
            <div class="col-sm-9">
                <select class="form-control" id="subcategory" name="subcategory" >
                    
                    <?php 
                    $cat = $_POST['category'];
                    if($cat=='Find A Provider'){
                        echo '<option value="Find a clinic/hostpial">Find a Clinic/Hospital</option>';
                        echo '<option value="Find a Doctor/Dentist">Find a Doctor/Dentist</option>';
                    }else if($cat=='ACU/ECU'){
                        echo '<option value="Online Appoinment">Online Appointment</option>';
                        echo '<option value="Viewing of Result">Viewinig of Result</option>';
                    }else if($cat=='Member Information'){
                        echo '<option value="Coverage">Coverage</option>';
                        echo '<option value="Basic">Basic</option>';
                        echo '<option value="Utilization">Utilization</option>';
                    }
                    ?>
                </select>
            </div>
            <script>
             $(document).ready(function(){
                var $selects = $('#subcategory<?php echo $random;?>');
                $selects.easyDropDown({
                cutOff: 10
                });	 
             });
             </script>
        </div>
        <?php
        }
    }
}