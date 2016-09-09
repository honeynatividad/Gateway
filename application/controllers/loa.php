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
        $this->user=$session_data['user_id'];
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
            $x = "";
            $data['provinces'] = $this->wslibrary->getProvince($x);
            $data['userid'] = $this->user;
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
    
    function getServiceType(){
        if(isset($_POST['service'])){
            if($_POST['service'] == "consultation"){
        ?>
                <ul class="list-group row">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-6 col-lg-5">
                                <div class="form-group" id="content-hospital">
                                    <div class="metro">
                                        <label class='form-white' >Chief Complaint</label>
                                        <input type="text" class="form-control" id="complaint" name="complaint" placeholder="Chief Complaint"  >                                        
                                        
                                    </div>  
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->

                            <div class="col-sm-5 col-lg-1">
                                
                            </div>
                            <input type="hidden" name="loa-type" id="loa-type" value="consultation">
                            <div class="col-sm-2 col-lg-2">
                                <label>&nbsp;</label>
                                <span class="input-group-btn">
                                    <button class="btn btn-default-orange" type="button" id="startfinding">
                                        GENERATE LOA
                                    </button>
                                </span>
                            </div>

                        </div><!-- /.row -->						
                    </li>
                </ul>
        <?php
            }else{
                $diagnosis = $this->wslibrary->getDiagnosis();
                $c = count($diagnosis['DiagListResult']);
        ?>
                <ul class="list-group row">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-5 col-lg-5">
                                <div class="form-group" id="content-diagnosis">
                                    <div class="metro">
                                        <label class='form-white' >Diagnosis</label>
                                        <select class="dval form-control" id="diagnosis" name="diagnosis">
                                            <option value="0">--</option>
                                            <?php for($x = 0;$x < $c; $x++): ?>
                                            
                                            <option value="<?php echo $diagnosis['DiagListResult'][$x]['ICDCOde'] ?>"><?php echo $diagnosis['DiagListResult'][$x]['ICDDisease'] ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>   
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            
                            <div class="col-sm-5 col-lg-5">
                                <div class="form-group" id="content-procedure">
                                    <div class="metro">
                                        <label class='form-white' >Procedure</label>
                                        <select class="dval form-control" id="procedure" name="procedure">
                                            <option value="0">--</option>
                                        </select>
                                    </div>  
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-sm-2 col-lg-1">
                                <input type="hidden" name="loa-type" id="loa-type" value="procedure">
                                <span class="input-group-btn">
                                    <button class="btn btn-default-orange" type="button" id="startfinding">
                                        GENERATE<br>LOA
                                    </button>
                                </span>
                            </div>

                        </div><!-- /.row -->						
                    </li>
                </ul>

        <?php
            }
        ?>
<script>
   
        $("#diagnosis").change(function(){
        
            $(".lloading2").text("Loading....");
            $(".loaderphil2").show();    
            $.post("<?php echo base_url("loa/getProcedure");?>",
                
		{diagnosis:$(this).val()},function(data){
			
                    $("#content-procedure").html(data);	
                        
                    $(".lloading2").text('');
                    $(".loaderphil2").hide();
		});	
        });
    $("#startfinding").click(function(){
       var certno = $("#certno").val();
       var providerCode = $("#hospital").val();
       var doctorCode = $("#doctor").val();
       var chiefComplaint = $("#complaint").val();
       var serviceType = "CONSULTATION";
       alert("doctor "+doctorCode);
       if(certno != "" && providerCode != "" && doctorCode != "" && chiefComplaint != "" && serviceType != ""){
           alert("CERT NO is "+certno+":: PROVIDER CODE is "+providerCode+":: DoctorCode is "+doctorCode+":: ChiefCompalint is "+chiefComplaint+":: SERVICE TYPE is "+serviceType);
           $.post("<?php echo base_url("loa/createConsultation");?>",
                {
                    certno:certno,
                    providerCode:providerCode,
                    doctorCode:doctorCode,
                    chiefComplaint:chiefComplaint,
                    serviceType:serviceType
                },function(data){
                    alert(data);
                    $("#result").html(data); 
                    $(".lloading").text('done loading');
                });	
            
       }else{
        alert("else");
           if(provideCode == ""){
               alert("Please choose Provider/Hospital.");
           }
           if(doctorCode == ""){
               alert("Please choose doctor.");
           } 
           if(chiefComplaint == ""){
               alert("Please type chief complaint to proceed creating letter of authorization.");
           }
       }
      
    });
            
  
</script>
    <?php
        }
    }
    
    function createConsultation(){
        if(isset($_POST['chiefComplaint'])){
            $certno = $_POST['certno'];
            $providerCode = $_POST['providerCode'];
            $doctorCode = $_POST['doctorCode'];
            $chiefComplaint = $_POST['chiefComplaint'];
            $serviceType = $_POST['serviceType'];
            list($hCode,$hospital) = explode(":", $providerCode);
            list($dCode,$doctor) = explode(":", $doctorCode);
            
            $consultation = $this->wslibrary->getLoaConsultation($certno,$hCode,$dCode,$chiefComplaint,$serviceType);
            if($consultation){
                $count = count($consultation['GenerateLOAResult']);
                $loaCode = $consultation['GenerateLOAResult']['LOANo'];
                $message = $consultation['GenerateLOAResult']['Message'];
                
                $img = base_url('resources').'/img/loa.jpg';
        
                $this->load->library('Pdf');

                $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('LOA Consultation');
                $pdf->SetTitle('LOA Consultation');
                $pdf->SetSubject('LOA Consultation');
                $pdf->SetKeywords('LOA Consultation');
                $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                $pdf->SetFont('times', '', 7, '', 'false');
                if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                    require_once(dirname(__FILE__).'/lang/eng.php');
                    $pdf->setLanguageArray($l);
                }
                $pdf->AddPage();
                $pdf->setJPEGQuality(100);
                
                    $pdf->Image($img, 15, 20, 750, 1000, 'JPG', '', '', false, 720, '', false, false, 0, false, false, true);
                
                $dateNow = date("d/m/Y");
                
                $membersInfo = $this->wslibrary->getMembersInfo($certno);
                
                $pdf->Text(150, 46, $loaCode);
                $pdf->Text(40, 52, $hospital);
                $pdf->Text(150, 52, $dateNow);
                $pdf->Text(40, 59, $membersInfo->AgreementName);
                $pdf->Text(150, 59, $membersInfo->EffectiveDate);
                $pdf->Text(40, 63, $membersInfo->FirstName." ".$membersInfo->MiddleName.". ".$membersInfo->LastName);
                $pdf->Text(102, 63, $membersInfo->Age);
                $pdf->Text(118, 63, $membersInfo->Sex);
                $pdf->Text(150, 63, $membersInfo->ExpiryDate);
                $pdf->Text(40, 67, $membersInfo->AgreementNo);
                $pdf->Text(79, 67, $membersInfo->CertNo);
                $pdf->Text(130, 67, $doctor);
                $pdf->Text(45, 70, $doctor);
                $pdf->Text(130, 70, $doctor);
                $pdf->Text(30, 90, $chiefComplaint);
                $pdf->Text(110, 140, $loaCode);
                $pdf->Text(110, 146, $doctor);
                $pdf->Text(110, 150, $hospital);
                $pdf->Text(30, 238, $membersInfo->FirstName." ".$membersInfo->MiddleName.". ".$membersInfo->LastName."/".$dateNow);
               // $pdf->writeHTMLCell($w=0, $h=0, $x=20, $y=190, $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
        //$pdf->lastPage();
                $p = $pdf->Output('gateway/resources/loa/'.$loaCode.'.pdf', 'F');
                
                $data = array(
                    "email_add" => $membersInfo->Email,
                    "loa" => $loaCode,
                    "doctor" => $doctor,
                    "hospital" => $hospital,
                    "chiefComplaint" => $chiefComplaint,
                    "dateNow" => $dateNow,
                    "name" => $membersInfo->FirstName." ".$membersInfo->MiddleName.". ".$membersInfo->LastName,
                    "agreementName" => $membersInfo->AgreementName,
                    "agreementNo" => $membersInfo->AgreementNo,
                    "effectiveDate" => $membersInfo->EffectiveDate,
                    "expiryDate" => $membersInfo->ExpiryDate,
                    "certno" => $membersInfo->CertNo,
                    "age" => $membersInfo->Age,
                    "sex" => $membersInfo->Sex
                );
                $this->emailConsultation($data);
        
            ?>    
            <div class="row">
                <div class="col-sm-10">
                    <p><?php echo $message ?></p>
                    <p>LOA No: <?php echo $loaCode; ?></p>                    
                </div>
                <div class="col-sm-10">
                    <a class="btn-green" href="<?php echo base_url('resources/loa/'.$loaCode.'.pdf'); ?>">DOWNLOAD PDF</a>
                </div>
            </div>
            <?php
            }
        }
    }
    
    function consultation(){
        $this->load->library('My_PHPMailer');
        
        $mail = new PHPMailer();  
        $mail->SMTPAuth   = false; 
        $mail->SMTPSecure = "ssl"; 
        $mail->Host       = '172.16.108.58'; 
        //$mail->Host       = 'http://owa.pfpc.com.ph';         
        $mail->Port       = 25; 
        $mail->Username   = 'advisory@philcare.com.ph'; 
        $mail->Password   = 'P@ssw0rd'; 
        $mail->SetFrom('advisory@philcare.com.ph','PhilCare Advisory'); 
        
        $mail->IsHTML(true);
    
        
        $destino = "honeynatividad@gmail.com";
        //$mail->addAddress('Rosemarie.Sangalang@PhilCare.com.ph');        
        $mail->addAddress('hanna.natividad@philcare.com.ph');        
        $mail->AddBCC($destino);        


        $mail->Subject    = "LOA";

       
    
        $message = "Thank you for sending your request through PCare EASy. Your request is approved. YOur approval code is ";
       
        $mail->Body = $message;
        //$mail->AltBody    = "Plain text message";
        if(!$mail->Send()) {
            $d["message"] = "Error: " . $mail->ErrorInfo;
      //echo "Mailer Error: " . $mail->ErrorInfo;
      //print_r(error_get_last());
      
        } else {
            $d["message"] = "Message sent correctly!";
        }
       print_r($d); 
        return json_encode($d);
        
    }
    
    function emailConsultation($data){        
        
        $this->load->library('My_PHPMailer');
        $mail = new PHPMailer();  
        $mail->SMTPAuth   = false; 
        $mail->SMTPSecure = "ssl"; 
        $mail->Host       = '172.16.108.58'; 
        //$mail->Host       = 'http://owa.pfpc.com.ph';         
        $mail->Port       = 25; 
        $mail->Username   = 'advisory@philcare.com.ph'; 
        $mail->Password   = 'P@ssw0rd'; 
        $mail->SetFrom('advisory@philcare.com.ph','PhilCare Advisory'); 
        
        $mail->IsHTML(true);
    
        $card = $this->session->userdata('card');
        $destino = $data['email_add'];         
        //$mail->addAddress('Rosemarie.Sangalang@PhilCare.com.ph');        
        $mail->addAddress('hanna.natividad@philcare.com.ph');        
        $mail->AddBCC($destino);        


        $mail->Subject    = "LOA";

        $session_data = $this->session->userdata('logged_in');
    //$mail->AddAttachment($s);
     
        $mail->AddAttachment('http://localhost/gateway/resources/loa/'.$data['loa'].'.pdf',$name = 'test',  $encoding = 'base64', $type = 'application/pdf');
        
       
    
        $message = "Thank you for sending your request through PCare EASy. Your request is approved. YOur approval code is ".$data['loa'];
       
        $mail->Body = $message;
        //$mail->AltBody    = "Plain text message";
        if(!$mail->Send()) {
            $d["message"] = "Error: " . $mail->ErrorInfo;
      //echo "Mailer Error: " . $mail->ErrorInfo;
      //print_r(error_get_last());
      
        } else {
            $d["message"] = "Message sent correctly!";
        }
    
        return json_encode($d);
    
    }
    
    function getProcedure(){
        if(isset($_POST['diagnosis'])){
            $data = array(
                "code" => $_POST['diagnosis']
            );
            $diagnosis = $this->wslibrary->getProcedure($data);
            $c = count($diagnosis['DiagProcListResult']);
        
    ?>
        <div class="metro">
            <label class='form-white' >Procedure</label>
            <select class="dval form-control" id="procedure" name="procedure">
                <option value="0">--</option>
                <?php for($x = 0;$x < $c; $x++): ?>                                            
                <option value="<?php echo $diagnosis['DiagProcListResult'][$x]['SvcCode'] ?>"><?php echo $diagnosis['DiagProcListResult'][$x]['SvcDesc'] ?></option>
                <?php endfor; ?>
            </select>
        </div>
    <?php
        }
    }
    function getDistrict(){
        if(isset($_POST['city'])){
            $state = $_POST['city'];
            
            $districts = $this->wslibrary->getNewDistrict($state);
            $count = count($districts['DistrictResult']);
        ?>
            
            <select class="dval form-control" onchange="sp(this.value);" id="districts">
                <option value="0">-CITY-</option>
                <?php for($x = 0;$x<$count;$x++): ?>
                <option value="<?php echo $districts['DistrictResult'][$x]['DistrictDesc'] ?>"><?php echo $districts['DistrictResult'][$x]['DistrictDesc'] ?></option>
                <?php endfor; ?>
            </select>
            
        <?php
        }
    }
    
    function getHospital(){
        //getSearchHospitals        
        if(isset($_POST['city'])){
            $session_data = $this->session->userdata('logged_in');
            $cert = $session_data['user_id'];
            $state = $_POST['city'];
            $hospital = "";
            $hospitals = $this->wslibrary->getSearchHospitals($cert,$state,$hospital);
            
            $count = count($hospitals['SearchHospitalsResult']);
            
        ?>
           <label class='form-white' >Affiliated Hospital</label>
            <select class="dval form-control" onchange="attending(this.value);" id="hospital" name="hospital">
                <option value="0">-PROVIDES/HOSPITALS--</option>
                <?php for($x = 0;$x<$count;$x++): ?>
                <option value="<?php echo $hospitals['SearchHospitalsResult'][$x]['ProviderCode'] ?>:<?php echo $hospitals['SearchHospitalsResult'][$x]['ProviderName'] ?>"><?php echo $hospitals['SearchHospitalsResult'][$x]['ProviderName'] ?></option>
                <?php endfor; ?>
            </select>
            
        <?php
        }
    }
    
    function getSearchAttending(){
        //getSearchHospitals        
        if(isset($_POST['prov'])){
            $session_data = $this->session->userdata('logged_in');
            
            $prov = $_POST['prov'];
            list($dCode,$doctor) = explode(":", $prov);
            $hospital = "";
            $doctors = $this->wslibrary->getSearchAttending($dCode);
            
            $count = count($doctors['SearchDoctorsResult']);
            
        ?>
           <label class='form-white' >Attending MD</label>
            <select class="dval form-control" id="doctor" name="doctor">
                <option value="0">-ATTENDING/DOCTOR-</option>
                <?php for($x = 0;$x<$count;$x++): ?>
                <option value="<?php echo $doctors['SearchDoctorsResult'][$x]['DoctorCode'] ?>:<?php echo $doctors['SearchDoctorsResult'][$x]['DoctorName'] ?>"><?php echo $doctors['SearchDoctorsResult'][$x]['DoctorName'] ?></option>
                <?php endfor; ?>
            </select>
            
        <?php
        }
    }
}