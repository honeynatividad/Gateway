<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct(){
        parent::__construct();
	$this->load->database();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->model("model_order_users");
        $this->load->library('form_validation');
        $this->load->library('My_PHPMailer');
        $this->load->library('wslibrary');
          //load the login model
        //$this->load->model('login_model');
    }

    public function index(){
        $data['title'] = "Validate";
	$this->load->view('templates/header2',$data);
	$this->load->view('register/login');
	$this->load->view('templates/footer');
    }

    public function view($page = 'home'){
        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php')){
                // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function register(){
        $data['title'] = "PhilCare Registration";
	$this->load->view('templates/header2',$data);
	$this->load->view('register/register');
	$this->load->view('templates/footer');

    //when user clicked the submit button
        if(isset($_REQUEST['submit'])){
        
            $serial = $_POST['serial_number'];
            $pin = $_POST['pin_code'];
            $validation = $this->wslibrary->serialValidation($serial,$pin);
            foreach ($validation as $key => $value) {
                if($value['SuccessFlag']=="True"){
                    $newdata = array(
                        'CardDesc'        => $value['CardDesc'],
                        'CardType'        => $value['CardType'],
                        'SerialNumber'    => $serial,
                        'PinCode'         => $pin,
                        'CardVariant'     => $value['CardVariant']   
                    );
                    $this->session->set_userdata('card', $newdata);          
                    redirect('/register/register_next');
                }else{
                    //print_r($value);
                    $this->session->set_flashdata('reg_error',$value['MessageReturn']);
                    redirect('/register/register');
                }          
            }
        }    

    }

    public function register_choose(){
        $data['title'] = "PhilCare Registration";
	$this->load->view('templates/header2',$data);
	$this->load->view('register/register_choose',array());
	$this->load->view('templates/footer');

	if(isset($_POST['submit'])){
            $order_no = $_POST['order_number'];			
            $order_id = substr($order_no,10);
            $sess_array = array(
                'order_id' => $order_id
            );
            $this->session->set_userdata('orders', $sess_array);
			
            redirect("register/register_philcare");
        }
    }

    public function register_next(){
        $data['title'] = "PhilCare Registration";		
	$var['provinces'] = $this->wslibrary->getProvinces();
        $var['card'] = $this->session->userdata('card');
        //print_r($this->session->userdata('card'));
        $clinics= $this->wslibrary->ClinicCode();
        foreach($clinics as $clinic){
            $c = $clinic;
        }
        $var['clinics'] = $c;
    //print_r($var);

        $this->load->view('templates/header2',$data);
	$this->load->view('register/register_next',$var);
	$this->load->view('templates/footer');
    
        if(isset($_REQUEST['submit'])){
      
            $card = $_POST['prepaid_card_type'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $middle_initial = $_POST['middle_initial'];
            $birthdate = $_POST['mm']."/".$_POST['dd']."/".$_POST['yyyy'];
            $gender = $_POST['gender'];
            $clinic_code = $_POST['clinic_code'];
            $street_number = $_POST['street_number'];
            $street_name = $_POST['street_name'];
            $barangay_name = $_POST['barangay_name'];
            $province = $_POST['province'];
            $city = $_POST['city'];
            $mobile_number = $_POST['mobile_number'];
            $email_add = $_POST['email_add'];

           // print_r($birthdate);
            $card = $this->session->userdata('card');

            $data = array(
                "serial_number"         => $card['SerialNumber'],
                "card_type"             => $card['CardType'],
                "pin_code"              => $card['PinCode'],
                "last_name"             => $last_name,
                "first_name"            => $first_name,
                "middle_initial"        => $middle_initial,
                "birthdate"             => $birthdate,
                "gender"                => $gender,
                "clinic_code"           => $clinic_code,
                "street_number"         => $street_number,
                "street_name"           => $street_name,
                "barangay"              => $barangay_name,
                "province"              => $province,
                "city"                  => $city,
                "mobile_number"         => $mobile_number,
                "email_add"             => $email_add
                );
            $this->session->set_userdata('member', $data);
            $register = $this->wslibrary->prepaidRegister($data);
      //print_r($register);      
      
            foreach ($register as $key => $value) {
        //print_r($value);
                if($value['SuccessFlag']=="True"){

                    $this->session->set_flashdata('register_successful', $value['MessageReturn']);
                    $sess_array = array(
                        "CertNo"        => $value['CertNo'],
                        "EffDate"       => $value['EffDate'],
                        "ExpDate"       => $value['ExpDate']
                    );
                    $this->session->set_userdata('register', $sess_array);
                    $this->send_mail($data);
                    redirect('/register/successful');
                }else{
                    $this->session->set_flashdata('register_error', $value['MessageReturn']);

                    redirect('/register/register_next');
                }
            }

        }
    }

    public function download(){
    //$this->load->view('download');
        $card = $this->session->userdata('card');
        $member = $this->session->userdata('member');
        $getData = $this->session->userdata('register');
  
        if($card['CardVariant'] == "ERV40"){      
            $isPDF = true;
            $img = base_url('assets').'/img/erv-40-per.jpg';
          //$img2 = base_url('assets').'/img/erv-40-back.jpg';
            $img2 = "";
            //$title = "PERSONALIZED MEMBERSHIP ER VANTAGE 40 CARD";
        }elseif($card['CardVariant'] == "ERV60"){
            $isPDF = true;
            $img = base_url('assets').'/img/erv-60-per.jpg';
          //$img2 = base_url('assets').'/img/erv-60-back.jpg';
            $img2 = "";
            //$title = "PERSONALIZED MEMBERSHIP ER VANTAGE 60 CARD";
        }elseif($card['CardVariant'] == "ERV80"){
            $isPDF = true;
            $img = base_url('assets').'/img/erv-80-per.jpg';
          //$img2 = base_url('assets').'/img/erv-80-back.jpg';
            $img2 = "";
            //$title = "PERSONALIZED MEMBERSHIP ER VANTAGE 80 CARD";
        }elseif($card['CardType'] == "MDC65"){
            $isPDF = true;
            $img = base_url('assets').'/img/mc_65.jpg';
            //$title = "PERSONALIZED MEMBERSHIP ER VANTAGE 80 CARD";
        }elseif($card['CardType'] == "MDCA"){
            $isPDF = true;
            $img = base_url('assets').'/img/mdca.jpg';
            //$title = "";
        }elseif($card['CardType'] == "MDCK"){
            $isPDF = true;
            $img = base_url('assets').'/img/mdck.jpg';
            //$title = "";
        }

        if($card['CardType'] == "SCB"){
            $isPDF = true;
            $img = base_url('assets').'/img/scu-per.jpg';
            //$img2 = base_url('assets').'/img/scu.jpg';
            $img2 = "";
            //$title = "PERSONALIZED MEMBERSHIP SMART CHECK-UP CARD";
        }
        if($card['CardType'] == "ERS"){
            $isPDF = true;
            $img = base_url('assets').'/img/ers_per.jpg';
            $img2 = "";
          //$img2 = base_url('assets').'/img/ers-back.jpg';
            //$title = "PERSONALIZED MEMBERSHIP ER SHIELD CARD";
        }
    //print_r($isPDF);
        if($isPDF == 1){
            $this->load->library('Pdf');

            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('PhilCare Prepaid Card');
            $pdf->SetTitle('PhilCare Prepaid Card');
            $pdf->SetSubject('PhilCare Prepaid Card');
            $pdf->SetKeywords('PhilCare Prepaid Card');
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }
            $pdf->AddPage();
            $pdf->setJPEGQuality(100);
            if($isPDF == 1){
                $pdf->Image($img, 15, 20, 750, 1000, 'JPG', '', '', false, 720, '', false, false, 0, false, false, true);
            }
            //$pdf->Text(50, 50,$title );
                if($card['CardType'] == "ERS"){
                    $pdf->Text(45, 152, $member['first_name']." ".$member['last_name']);
                    $pdf->Text(64, 158, $getData['CertNo']);
                    $pdf->Text(60, 164, $getData['EffDate']." - ".$getData['ExpDate']); 
                }else if($card['CardType'] == "ERV"){ 
                    $pdf->Text(40, 155, $member['first_name']." ".$member['last_name']);
                    $pdf->Text(56, 160, $getData['CertNo']);
                    $pdf->Text(54, 165, $getData['EffDate']." - ".$getData['ExpDate']); 
                }else if($card['CardType'] == "SCB"){ 
                    $pdf->Text(45, 163, $member['first_name']." ".$member['last_name']);
                    $pdf->Text(60, 168, $getData['CertNo']);
                    $pdf->Text(58, 174, $getData['EffDate']." - ".$getData['ExpDate']); 
                }else{
                    $pdf->Text(40, 151, $member['first_name']." ".$member['last_name']);
                    $pdf->Text(50, 159, $getData['CertNo']);
                    $pdf->Text(56, 166, $getData['EffDate']." - ".$getData['ExpDate']);  
                }
                if($card['CardVariant'] == "ERV40"){
            $subject = "Successful registration of PhilCare ER Vantage 40";
            $ward = "Ward room";
            $price = "P40,000";
            $cards = "ER Vantage 40";
            $img = "";
            $isImg = true;
            $img = base_url('assets').'/img/erv-40.jpg';
            $img2 = base_url('assets').'/img/erv-40-back.jpg';
        }elseif($card['CardVariant'] == "ERV60"){
            $subject = "Successful registration of PhilCare ER Vantage 60";
            $ward = "Semi-Private room";
            $price = "P60,000";
            $cards = "ER Vantage 60";
            $img = "";
            $isImg = true;
            $img = base_url('assets').'/img/erv-60.jpg';
            $img2 = base_url('assets').'/img/erv-60-back.jpg';
        }elseif($card['CardVariant'] == "ERV80"){
            $subject = "Successful registration of PhilCare ER Vantage 80";
            $ward = "Reular Private room";
            $price = "P80,000";
            $cards = "ER Vantage 80";
            $img = "";
            $isImg = true;
            $img = base_url('assets').'/img/erv-80.jpg';
            $img2 = base_url('assets').'/img/erv-80-back.jpg';
        }elseif($card['CardType'] == "MDC65"){
            $subject = "Successful registration of PhilCare Medical and Dental Consultation Cards 65+";
            $ward = "Private room";
            $price = "P80,000";
            $cards = "Medical And Dental Consultation Cards 65+";
            $img = base_url('assets').'/img/mc_65.jpg';
            $isImg = true;
        }elseif($card['CardType'] == "MDCA"){
            $subject = "Successful registration of PhilCare Medical and Dental Consultation Cards for Adult";
            $ward = "Private room";
            $price = "P80,000";
            $cards = "Medical And Dental Consultation Cards for Adults";
            $img = base_url('assets').'/img/mdca.jpg';
            $isImg = true;
        }elseif($card['CardType'] == "MDCK"){
            $subject = "Successful registration of PhilCare Medical and Dental Consultation Cards for Kids";
            $ward = "Private room";
            $price = "P80,000";
            $cards = "Medical And Dental Consultation Cards for Kids";
            $img = base_url('assets').'/img/mdck.jpg';
            $isImg = true;        
        }

        if($card['CardType'] == "ERS"){
            $subject = "Successful registration of PhilCare ER Shield";
            $ward = "Private room";
            $price = "P80,000";
            $cards = "ER Shield";
            $img = "";
            $isImg = true;
            $img = base_url('assets').'/img/ers_per.jpg';
            //$img2 = base_url('assets').'/img/ers-back.jpg';
            $img2 = "";
        }

        if($card['CardType'] == "SCB"){
            $subject = "Successful registration of PhilCare Smart Check-up";
            $ward = "Private room";
            $price = "P80,000";
            $cards = "ER Shield";
            $img = "";
            $isImg = true;
            $img = base_url('assets').'/img/scu-per.jpg';
            //$img2 = base_url('assets').'/img/scu-back.jpg';
            $img2 = "";
        }
        $d = array(
            "FirstName" => $member['first_name'],
            "LastName"  => $member['last_name'],
            "ward"      => $ward,
            "price"     => $price,
            "Card"      => $cards,
            "EffDate"   =>  $getData['EffDate'],
            "ExpDate"   => $getData['ExpDate'],
            "CertificateNumber" => $getData['CertNo']
        );
           $html = "";
        if($card['CardVariant'] == "ERV40" || $card['CardVariant'] == "ERV60" || $card['CardVariant'] == "ERV80"){
            $msg = $this->messageERV($d);
            $html = $this->stringERVantage($d);
        }elseif($card['CardType'] == "MDCA"){
            $msg = $this->messageMDCA($d);
            $html = $this->stringMDCA($d);
        }elseif($card['CardType'] == "MDC65"){
            $msg = $this->messageMDC($d);
            $html = $this->stringMDC($d);
        }elseif($card['CardType'] == "MDCK" ){
            $msg = $this->messageKids($d);
            $html = $this->stringMDCK($d);
        }elseif($card['CardType'] == "ERS"){
            $msg = $this->messageERShield($d);
            $html = $this->stringERShield($d);
        }elseif($card['CardType'] == "SCB"){
            $msg = $this->messageSCU($d);
            $html = $this->stringSCU($d);
        }
        $pdf->writeHTMLCell($w=0, $h=0, $x=20, $y=190, $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

        //$pdf->writeHTML($html, true, false, true, false, '');

            $pdf->Output('prepaid/assets/pdfs/'.$card['SerialNumber'].'.pdf', 'I');
        }    
   
    }

    public function getAllDistrict(){
        if(isset($_POST['Province'])){

            $distct = $this->wslibrary->getDistrict($_POST['Province']);
                
            if($distct){
                $random = rand(1, 115);
    ?>

                <div class="metro open">
                    <select class="form-control" data-settings='{"cutOff":10}' id="dsctval<?php echo $random;?>" name="city">
                	<option value="0" class="label">DISTRICT/CITY</option>
                    <?php
                    foreach($distct as $p){
                        $namespaces = $distct->getNameSpaces(true);
							
			$list = $p->children($namespaces['a']);
			foreach($list as $li){
                            $prov = $li->children($namespaces['a']);
                    ?>
                        <option value="<?php echo urlencode($prov->District);?>"><?php echo $prov->District;?></option>
                    <?php }}?>
                    </select>
                    <label class="control-label">Region</label>
                </div>
            <script>
		$(document).ready(function(){
                    $(".loaderphil").hide();                                                         
                                                        
		});
            </script>
	<?php	}else{
		echo "error";
            }
	}
    }

    public function successful(){
        $data['title'] = "PhilCare Registration Successful";
        $getData = $this->session->userdata('register');
        $getCard = $this->session->userdata('card');
        $getMember = $this->session->userdata('member');

        $data['CertNo'] = $getData['CertNo'];
        $data['EffDate'] = $getData['EffDate'];
        $data['ExpDate'] = $getData['ExpDate'];

        $data['CardType'] = $getCard['CardType'];
        $data['CardDesc'] = $getCard['CardDesc'];
        $data['FirstName'] = $getMember['first_name'];
        $data['LastName'] = $getMember['last_name'];
	$this->load->view('templates/header2',$data);
	$this->load->view('register/successful',$data);
	$this->load->view('templates/footer');

    }

    public function send_mail($data) {
        $card = $this->session->userdata('card');
        $member = $this->session->userdata('member');
        $getData = $this->session->userdata('register');
        if($card['CardVariant'] == "ERV40"){
            $subject = "Successful registration of PhilCare ER Vantage 40";
            $ward = "Ward room";
            $price = "P40,000";
            $cards = "ER Vantage 40";
            $img = "";
            $isImg = true;
            $img = base_url('assets').'/img/erv-40-per.jpg';
            $img2 = base_url('assets').'/img/erv-40-back.jpg';
        }elseif($card['CardVariant'] == "ERV60"){
            $subject = "Successful registration of PhilCare ER Vantage 60";
            $ward = "Semi-Private room";
            $price = "P60,000";
            $cards = "ER Vantage 60";
            $img = "";
            $isImg = true;
            $img = base_url('assets').'/img/erv-60-per.jpg';
            $img2 = base_url('assets').'/img/erv-60-back.jpg';
        }elseif($card['CardVariant'] == "ERV80"){
            $subject = "Successful registration of PhilCare ER Vantage 80";
            $ward = "Private room";
            $price = "P80,000";
            $cards = "ER Vantage 80";
            $img = "";
            $isImg = true;
            $img = base_url('assets').'/img/erv-80-per.jpg';
            $img2 = base_url('assets').'/img/erv-80-back.jpg';
        }elseif($card['CardType'] == "MDC65"){
            $subject = "Successful registration of PhilCare Medical and Dental Consultation Cards 65+";
            $ward = "Private room";
            $price = "P80,000";
            $cards = "Medical And Dental Consultation Cards 65+";
            $img = base_url('assets').'/img/mc_65.jpg';
            $isImg = true;
        }elseif($card['CardType'] == "MDCA"){
            $subject = "Successful registration of PhilCare Medical and Dental Consultation Cards for Adult";
            $ward = "Private room";
            $price = "P80,000";
            $cards = "Medical And Dental Consultation Cards for Adults";
            $img = base_url('assets').'/img/mdca.jpg';
            $isImg = true;
        }elseif($card['CardType'] == "MDCK"){
            $subject = "Successful registration of PhilCare Medical and Dental Consultation Cards for Kids";
            $ward = "Private room";
            $price = "P80,000";
            $cards = "Medical And Dental Consultation Cards for Kids";
            $img = base_url('assets').'/img/mdck.jpg';
            $isImg = true;
        }

        if($card['CardType'] == "ERS"){
            $subject = "Successful registration of PhilCare ER Shield";
            $ward = "Private room";
            $price = "P80,000";
            $cards = "ER Shield";
            $img = "";
            $isImg = true;
            $img = base_url('assets').'/img/ers_per.jpg';
            //$img2 = base_url('assets').'/img/ers-back.jpg';
            $img2 = "";
        }

        if($card['CardType'] == "SCB"){
            $subject = "Successful registration of PhilCare Smart Check-up";
            $ward = "Private room";
            $price = "P80,000";
            $cards = "ER Shield";
            $img = "";
            $isImg = true;
            $img = base_url('assets').'/img/scu-per.jpg';
            //$img2 = base_url('assets').'/img/scu-back.jpg';
            $img2 = "";
        }

    
        $this->load->library('Pdf');
    
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('PhilCare Prepaid Card');
        $pdf->SetTitle('PhilCare Prepaid Card');
        $pdf->SetSubject('PhilCare Prepaid Card');
        $pdf->SetKeywords('PhilCare Prepaid Card');
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->AddPage();
        $pdf->setJPEGQuality(100);
        if($isImg == true){
            $pdf->Image($img, 15, 20, 750, 1000, 'JPG', '', '', false, 720, '', false, false, 0, false, false, true);
        }
    
        
            if($card['CardType'] == "ERS"){
                    $pdf->Text(45, 152, $member['first_name']." ".$member['last_name']);
                    $pdf->Text(64, 158, $getData['CertNo']);
                    $pdf->Text(60, 164, $getData['EffDate']." - ".$getData['ExpDate']); 
                }else if($card['CardType'] == "ERV"){ 
                    $pdf->Text(40, 155, $member['first_name']." ".$member['last_name']);
                    $pdf->Text(56, 160, $getData['CertNo']);
                    $pdf->Text(54, 165, $getData['EffDate']." - ".$getData['ExpDate']); 
                }else if($card['CardType'] == "SCB"){ 
                    $pdf->Text(45, 163, $member['first_name']." ".$member['last_name']);
                    $pdf->Text(60, 168, $getData['CertNo']);
                    $pdf->Text(58, 171, $getData['EffDate']." - ".$getData['ExpDate']); 
                }else{
                    $pdf->Text(45, 152, $member['first_name']." ".$member['last_name']);
                    $pdf->Text(50, 160, $getData['CertNo']);
                    $pdf->Text(56, 168, $getData['EffDate']." - ".$getData['ExpDate']);  
                }
            
      
        //$pdf->AddPage();
        $d = array(
            "FirstName" => $member['first_name'],
            "LastName"  => $member['last_name'],
            "ward"      => $ward,
            "price"     => $price,
            "Card"      => $cards,
            "EffDate"   =>  $getData['EffDate'],
            "ExpDate"   => $getData['ExpDate'],
            "CertificateNumber" => $getData['CertNo']
        );
    
        $html = "";
        if($card['CardVariant'] == "ERV40" || $card['CardVariant'] == "ERV60" || $card['CardVariant'] == "ERV80"){
            $msg = $this->messageERV($d);
            $html = $this->stringERVantage($d);
        }elseif($card['CardType'] == "MDCA"){
            $msg = $this->messageMDCA($d);
            $html = $this->stringMDCA($d);
        }elseif($card['CardType'] == "MDC65"){
            $msg = $this->messageMDC($d);
            $html = $this->stringMDC($d);
        }elseif($card['CardType'] == "MDCK" ){
            $msg = $this->messageKids($d);
            $html = $this->stringMDCK($d);
        }elseif($card['CardType'] == "ERS"){
            $msg = $this->messageERShield($d);
            $html = $this->stringERShield($d);
        }elseif($card['CardType'] == "SCB"){
            $msg = $this->messageSCU($d);
            $html = $this->stringSCU($d);
        }
        //$pdf->writeHTML($html, true, false, true, false, '');
        $pdf->writeHTMLCell($w=0, $h=0, $x=20, $y=190, $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
        //$pdf->lastPage();
        $p = $pdf->Output('prepaid-card/assets/pdfs/'.$card['SerialNumber'].'.pdf', 'S');
        
    
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
    /*
    $mail->IsSMTP(); // enable SMTP

$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "tls://smtp.gmail.com";
$mail->Port = 587; // or 587
$mail->IsHTML(true);
$mail->Username = "heyphilcare@gmail.com";
$mail->Password = "qwepoi123456";
$mail->SetFrom("heyphilcare@gmail.com");
*/

        $card = $this->session->userdata('card');
        $destino = $data['email_add'];         
        //$mail->addAddress('Rosemarie.Sangalang@PhilCare.com.ph');        
        //$mail->addAddress('hanna.natividad@philcare.com.ph');        
        $mail->AddBCC($destino);        


        $mail->Subject    = $subject;

        $session_data = $this->session->userdata('logged_in');
    //$mail->AddAttachment($s);
        if($isImg == true){
            $mail->AddAttachment('http://www.philcare.com.ph/prepaid-card/assets/pdfs/'.$card['SerialNumber'].'.pdf',$name = 'test',  $encoding = 'base64', $type = 'application/pdf');
            $mail->addStringAttachment($p, $card['SerialNumber'].'.pdf');
        }
    
        $message = $msg;
        $msg2 = "Hello";
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

    public function register_philcare(){
        $data = $this->session->userdata('orders');
	$order_id = $data['order_id'];		
	$data['orders'] = $this->model_order_users->getOrderMeta($order_id);		
	//print_r($this->model_order_users->getOrderMeta($order_id));


	$data['title'] = "PhilCare Registration";
	$this->load->view('templates/header2',$data);
	$this->load->view('register/register_philcare',$data);
	$this->load->view('templates/footer');
    }

    public function getError(){
        if(isset($_POST['error_msg'])){
            $error = $_POST['error_msg'];
    ?>
            <div id="error">
                <div class="alert alert-danger"> 
                    <p><?php echo $error; ?></p>
                </div>
            </div>
        <?php  
        }
    }
    
    public function getOrderInfo(){
        if(isset($_POST['order_id'])){
            $card = $this->session->userdata('card');
            $order_no = $_POST['order_id'];
            $order_id = substr($order_no,10);
			//$order_id = '4204';
            $orders = $this->model_order_users->getOrderMeta($order_id);
			//print_r($orders);
            $getFirstName = $this->model_order_users->getFirstName($order_id);
            $getLastName = $this->model_order_users->getLastName($order_id);
            $getBillingAddress = $this->model_order_users->getBillingAddress($order_id);
            $getBillingCity = $this->model_order_users->getBillingCity($order_id);
            $getBillingPhone = $this->model_order_users->getBillingPhone($order_id);
            $getBillingEmail = $this->model_order_users->getBillingEmail($order_id);
      
            $provinces = $this->wslibrary->getProvinces();
            $clinics= $this->wslibrary->ClinicCode();
            foreach($clinics as $clinic){
                $c = $clinic;
            }
			
    ?>
            <div class="form-group">
            	<label for="" class="col-sm-4 panel-label">Name</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $getLastName->meta_value ?>" placeholder="Last Name" required>
                </div>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $getFirstName->meta_value ?>" placeholder="First Name" required>
                </div>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="middle_initial" name="middle_initial" value="" placeholder="M.I" >
                </div>                
              </div>
              <div class="form-group">
                <label for="" class="col-sm-4 panel-label">Birth date</label>
                <div class="col-sm-1 col-md-2">
                  <select class="form-control" name="mm" required>
                  <?php for($i=01;$i<=12;$i++){?>
                    <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT);?>"><?php echo date('M',strtotime('2014-'.$i.'-01'));?></option>
                  <?php }?>
                  </select>
                  <label class="ulabel">Month</label>
                </div>
                <div class="col-sm-1 col-md-2">
                  <select class="form-control" name="dd" required>
                    <?php for($i=01;$i<=31;$i++){?>
                    <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT);;?></option>
                    <?php }?>

                  </select>                          
                  <label class="ulabel">Day</label>
                </div>
                <div class="col-sm-1 col-md-2">
                  <select class="form-control" name="yyyy" required>
                  <?php 
                    $thisyear = date('Y');
                    $currty = $thisyear;
                    for($i=1940;$i<=$currty;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                  <?php }?>                          
                  </select>                          
                  <label class="ulabel">Year</label>
                </div>                                                
              </div>
                        
              <div class="form-group">
                <div class="col-sm-12">
                <?php //echo $recaptcha_html; ?> 
                                          
                  <?php if(isset($error_registration)){ 
                    echo '<div class="alert alert-danger">'.$error_registration.'</div>';
                  }?>
                  <?php if ($this->session->flashdata('error') != FALSE) { 
                    echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>'; 
                  } ?>
                </div>  
              </div>
              <div class="form-group">
                <label for="" class="col-sm-4 panel-label">Gender:</label>
                <div class="col-sm-1 col-md-2">
                  <select class="form-control" name="gender" required>
                    <option value="0"></option>
                    <option value="F">Female</option>
                    <option value="M">Male</option>
                  </select>
                  
                </div>
                <?php if($card['CardType'] == "SCB"){ ?>
                <label for="" class="col-sm-2 panel-label">Clinic Code:</label>
                <div class="col-sm-1 col-md-4">

                  <select class="form-control" name="clinic_code" required>
                    <?php foreach ($clinics as $key => $value): ?>
                    <option value="<?php echo $value['ProviderCode']; ?>"><?php echo $value['ProviderName'] ?></option>
                    <?php endforeach; ?>      
                  </select>                                          
                </div>
                <?php }else{ ?>
                  <input type="hidden" name="clinic_code" value="">
                <?php } ?>
                
              </div>
              <div class="form-group">
                <label for="" class="col-sm-4 panel-label">Home Address:</label>
                <div class="col-sm-1 col-md-4">
                  <input type="text" class="form-control" name="street_number" id="street_number" value="<?php echo $getBillingAddress->meta_value ?>" placeholder="" required>
                  <label class="ulabel">Street Number</label>
                </div>
                <div class="col-sm-1 col-md-4">
                  <input type="text" class="form-control" name="street_name" id="street_name" value="" placeholder="" required>
                  <label class="ulabel">Street Name</label>
                </div>              
              </div>

              <div class="form-group">
                <label for="" class="col-sm-4 panel-label"></label>
                <div class="col-sm-1 col-md-2">
                  <input type="text" class="form-control" name="barangay_name" id="barangay_name" value="" placeholder="" >
                  <label class="ulabel">Barangay</label>
                </div>
                <div class="col-sm-1 col-md-2">
                  <select class="form-control" name="province" id="provinces" required>
                    <option value="0">Select City/Provinces</option>
                    <?php 

                      foreach($provinces as $p){
                        $namespaces = $provinces->getNameSpaces(true);
                        $list = $p->children($namespaces['a']);
                        foreach($list as $li){
                          $prov = $li->children($namespaces['a']);
                        ?>
                        <option value="<?php echo urlencode($prov->City);?>"><?php echo $prov->City;?></option>
                      <?php }
                    }?>
                                               
                  </select>
                  <label class="ulabel">Province</label>
                </div>
                <div class="col-sm-1 col-md-2" id="city">
                  <select class="form-control" name="city" id="city" required>
                  </select>
                  <label class="ulabel">City/District</label>
                </div>
              </div>

              <div class="form-group">
                <label for="" class="col-sm-4 panel-label">Mobile Number:</label>
                <div class="col-sm-1 col-md-4">
                  <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="<?php echo $getBillingPhone->meta_value ?>" placeholder="" required>
                  
                </div>              
                <div class="col-lg-2">
                  <div class="lloading"></div>
                </div>              

                <div class="loaderphil" id="thisanchor">
                  <div class="row"><img src="<?php echo base_url("assets/img/ajax-loader.gif");?>"></div>
                </div>   
              </div>
              <div class="form-group">
                <label for="" class="col-sm-4 panel-label">Email:</label>
                <div class="col-sm-1 col-md-4">
                  <input type="text" class="form-control" name="email_add" id="email_add" value="<?php echo $getBillingEmail->meta_value ?>" placeholder="" required>                
                </div>              
              </div>

              <script>
  $(document).ready(function(){
        
    $("#provinces").change(function(){      
      var prov = $("#provinces").val();
      if(prov!='0'){
        $(".lloading").text("Loading....");
        $(".loaderphil").show();

        $.post("<?php echo base_url("register/getAllDistrict");?>",
        {
          Province:$(this).val()},function(data){
          $("#city").html(data); 
          $(".lloading").text('');
          $(".loaderphil").hide();
        });  
      }else{
        $(".lloading").text("Please choose province for you to continue.");  
      }
       
    });
   
  });
</script>

	<?php						
			
        }
    }

    public function messageERV($data){
        $string = "<p>Dear ".$data['FirstName'].",    
        </p>
        <p>Make Health Happen! You have succesfully registered to PhilCare's <b>ER VANTAGE</b>. By registering this card, you agree and acknowledge the <a href='http://www.philcare.com.ph/product-terms-and-conditions/'>terms and conditions</a> governing the use of this card.</p>
        <p>Keep this email in a safe place for future reference, as it includes important information. For further assistance, please get in touch with PhilCare through the following channels.</p>
        <ul>
            <li>Call Center: (02) 462-1800</li>
            <li>Email: customercare@philcare.com.ph</li>
            <li>Social media:
                <ul>
                    <li><a href='www.facebook.com/philcareph'>www.facebook.com/philcareph</a></li>
                    <li><a href='www.instagram.com/philcareph'>www.instagram.com/philcareph</a></li>
                    <li><a href='www.twitter.com/philcareph'>www.twitter.com/philcareph</a></li>
                </ul>
            </li>
        </ul>
        
        <p><b>Member Information</b></p>
        <p>Card type:  ".$data['Card']."</p>
        <p>Certificate Number: ".$data['CertificateNumber']."</p>
        <p>Member Name: ".$data['FirstName']." ".$data['LastName']."</p>
        <p>Coverage Date: ".$data['EffDate']." - ".$data['ExpDate']."</p>
        <p><u>See attached pdf for your membership card.</u></p>
        <hr>
        <p><b>BENEFIT COVERAGE</b></p>
        <p>The ".$data['Card']." prepaid health card provides coverage for emergency care leading to admission for treatment of medical emergency cases due to accident or illness at around 400+ PhilCare accredited hospitals nationwide.</p>
        <p>Emergency cases covered are sudden, unexpected onset of illness or injury which at the time of availment reasonably appeared as having the potential of causing immediate disability or death or requiring immediate alleviation of severe pain or discomfort. Examples of these are Dengue, Typhoid fever, Leptospirosis, Pneumonia, Acute gastroenteritis.</p>
        
        <p><b>INCLUDES</b></p>
        <ul>
            <li>".$data['price']." coverage for emergency room care and hospitalization inclusive of doctor's fees, laboratory and diagnostic procedures, room and board, and medicines (except vaccines) as medically necessary during confinement except for cases declared as non-coverable</li>
            <ul>
                <li>Covers special modalities of treatment as medically necessary during ER and confinement and subject to Php 5,000 inner lmit</li>
                <li>Inclusive of diagnostic and therapeutic procedures as medically necessary during ER and confinement</li>
                <li>Covers hospital emergency care for animal bites except vaccines</li>
            </ul>
            <li>Room abd board: ". $data['ward']."</li>
            <li>No hospital deposit required</li>
            <li>Access to 400+ accredited hospitals nationwide ( <a href='www.philcare.com.ph/erhospitals'>www.philcare.com.ph/erhospitals</a> )</li>
            <li>No medical examination required to apply</li>
        </ul>
                
        <p><b>AVAILMENT PROCEDURE</b></p>
        <ul>
            <li>Go to the Emergency Room (ER) of the nearest accredited hospital. List is found at <a href='www.philcare.com.ph/erhospitals'>www.philcare.com.ph/erhospitals</a></li>
            <li>Present your PhilCare member card together with a valid ID to ER Personnel for membership verification. The hospital staff will be the one to contact PhilCare to verify your membership and the applicability of coverage based on your initial or if available, your final medical diagnosis and treatment.</li>
           
            <li><i>If confinement is required</i>
                <ul>
                    <li>The ER staff will endorse your case to the Admitting Section.</li>
                    <li>Though the Admitting Section would have received your details from the ER staff, they may revalidate your ER Vantage card and it's applicability based on the available medical diagnosis.</li>
                    <li>Please note that the coverage of the ER Vantage is based on the final medical diagnosis. The initial presentation of your symptoms may indicate a covered accident or illness for which a PhilCare  In-Patient Letter of Authorization (LoA) may be issued. However, this may be invalidated and revoked if it is shown in the course of medical treatment that the case is excluded or pre-existing. PhilCare will decide on coverage based ohe final medical diagnosis.</li>
                    <li>The In-Patient LoA will be secured by the hospital from PhilCare.</li>
                    <li>For Philhealth members, file your Philhealth with the hospital prior to discharge, to avoid paying the Philhealth portion of the hospital bill.</li>
                    <li>Prior to discharge, sign the hospital Statement of Account and pay the ineligible charges and items not covered by PhilCare, if any.</li>
                </ul>
            </li>
            <li><i>If no confinement is required</i>
                <ul>
                    <li>Receive necessary emergency care.</li>
                    <li>Sign the Emergency Treatment Form and Hospital Statement of Account / Charge Slip prior to discharge.</li>
                </ul>
            </li>
        </ul>
        <p><b>IMPORTANT REMINDERS</b></p>
        <ul>
            <li>For individuals aged 6 months to 64 years old at the time of activation of ER Vantage.</li>
            <li>Register prior to service availment and before card expiry date. Service could be availed 7 days after successful SMS registration.</li>
            <li>Present the card with a valid identification to the emergency room staff at any PhilCare accredited hospitals.</li>
            <li>ER Vantage is active for one year from day of effectivity and can only be used once within the effectivity period.</li>
            <li>ER Vantage is not transferable once registered.</li>
            <li>The following are some of the diseases and conditions considered as non-coverable such as Diabetes Mellitus, Hypertension, Cardiovascular diseases, Asthma, Tuberculosis, Epilepsy, Gastric or Duodenal Ulcer, pre-existing and congenital conditions, treatment of any injury which is proven to be attributable to the member's own misconduct. For a complete and updated list of non-covered diseases, please refer to <a href='www.philcare.com.ph/non-covered-illnesses-diseases/'>www.philcare.com.ph/non-covered-illnesses-diseases/</a></li>
            <li>Philhealth is required for the availment of this card during hospital confinement.</li>
            <li>Your final medical diagnosis is the basis for PhilCare's approval of coverage.</li>
            <li>The purchase price of ER Vantage is at a promotional discount and not eligible for combination with any other discount.</li>
            <li>ER Vantage is subject to the policies, guidelines and procedure of PhilCare. Please refer to <a href='www.philcare.com.ph'>www.philcare.com.ph</a></li>
            <li>By registering your card you certify that you have read, understood, and agree to the Terms and Conditions governing the use of card.</li>
        </ul>
        <hr>
        <p><b>IMPORTANT LINKS:</b></p>
        <ul>
          <li>Product Benefits: <a href='www.philcare.com.ph/products'>www.philcare.com.ph/products</a></li>
          <li>Product Terms and Conditions: <a href='www.philcare.com.ph/product-terms-and-conditions'>www.philcare.com.ph/product-terms-and-conditions</a></li>
          <li>Frequently Asked Questions: <a href='www.philcare.com.ph/faqs'>www.philcare.com.ph/faqs</a></li>
          <li>List of non-covered illnesses and diseases: <a href='www.philcare.com.ph/non-covered-illnesses-diseases/'>www.philcare.com.ph/non-covered-illnesses-diseases/</a></li>
          <li>List of hospitals by geographic area: <a href='www.philcare.com.ph/find'>www.philcare.com.ph/find</a> or visit <a href='www.philcare.com.ph/erhospitals'>www.philcare.com.ph/erhospitals</a></li>
        </ul>
        <p></p>
        <p></p>
        <p></p>
        <p>Sincerely yours,</p>
        <p>PhilCare</p>
        <p>&copy; PhilhealthCare, Inc. 4th and 5th floor, STI Holdings Center, 6764 Ayala Avenue, Makati City, Philippines</p>

        ";
        return $string;
    }

    public function messageERShield($data){
        $string = "
          <p>Dear ".$data['FirstName'].",</p>
          <p>Make Health Happen! You have succesfully registered to PhilCare's <b>ER SHIELD</b>. By registering this card, you agree and acknowledge the <a href='http://www.philcare.com.ph/product-terms-and-conditions/'>terms and conditions</a> governing the use of this card.</p>
        <p>Keep this email in a safe place for future reference, as it includes important information. For further assistance, please get in touch with PhilCare through the following channels.</p>
        <ul>
            <li>Call Center: (02) 462-1800</li>
            <li>Email: customercare@philcare.com.ph</li>
            <li>Social media:
                <ul>
                    <li><a href='www.facebook.com/philcareph'>www.facebook.com/philcareph</a></li>
                    <li><a href='www.instagram.com/philcareph'>www.instagram.com/philcareph</a></li>
                    <li><a href='www.twitter.com/philcareph'>www.twitter.com/philcareph</a></li>
                </ul>
            </li>
        </ul>
        <p><b>Member Information</b></p>
        <p>Card type:  ".$data['Card']."</p>
        <p>Certificate Number: ".$data['CertificateNumber']."</p>
        <p>Member Name: ".$data['FirstName']." ".$data['LastName']."</p>
        <p>Coverage Date: ".$data['EffDate']." - ".$data['ExpDate']."</p>
        <p><u>See attached pdf for your membership card.</u></p>
        <hr>
        <p><b>BENEFIT COVERAGE</b></p>
        <p>The <b>ER Shield</b> prepaid health card provides coverage for outpatient emergency care for treatment of medical emergency cases due to accident or illness at around 400+ PhilCare accredited hospitals nationwide.</p>
        <p><i>Emergency cases covered are sudden, unexpected onset of illness or injury which at the time of availment reasonably appeared as having the potential of causing immediate disability or death or requiring immediate alleviation of severe pain or discomfort.</i></p>
        <p><b>INCLUDES:</b></p>
        <ul>
          <li>P50,000 coverage for emergency room care inclusive of doctor's fees, laboratory and diagnostic procedures, and medicines (except vaccines) as medically necessary except for cases declared as non-coverable.</li>
          <ul>
            <li>Covers special modalities of treatment as medically necessary during ER and subject to Php 5,000 inner limit.</li>
            <li>Inclusive of diagnostic and therapeutic procedures as medically necessary for emergency room care.</li>
            <li>Covers hospital emergency care for animal bites except vaccines.</li>
          </ul>
          <li>Room and board: None. This card is for OUTPATIENT USE only</li>
          <li>No hospital deposit required</li>
          <li>Access to 400+ accredited hospitals nationwide (<a href='www.philcare.com.ph/erhospitals'>www.philcare.com.ph/erhospitals</a>)</li>
          <li>No medical examination required to apply</li>
          <li>Hassle-free SMS registration</li>
        </ul>
        <p><b>AVAILMENT PROCEDURE</b></p>
        <ul>
            <li>Go to the Emergency Room (ER) of the nearest accredited hospital. List is found at <a href='www.philcare.com.ph/erhospitals/'>www.philcare.com.ph/erhospitals</a></li>
            <li>Present your PhilCare member card together with a valid ID to ER Personnel for membership verification. The hospital staff will be the one to contact PhilCare to verify your memberhsip and the applicability of coverage based on your initial or if available, your final medical diagnosis and treatment. </li>
            <li>If no confinement is required</li>
            <ul>
                <li>Receive necessary emergency care</li>
                <li>Sign the Emergency Treatment Form and Hospital Statement of Account/Charge Slip prior to discharge.</li>
            </ul>
        </ul>
        <p><b>IMPORTANT REMINDERS</b></p>
        <ul>
            <li>For individuals aged 6 months to 64 years old at the time of activation of ER Shield</li>
            <li>Register prior to service availment and before card expiry date. Service could be availed 7 days after successful SMS registration.</li>
            <li>Present the card with a valid identification to the emergency room staff at any PhilCare accredited hospitals.</li>
            <li>ER Shield is active for one year from day of effectivity and can only be used once within the effectivity period.</li>
            <li>ER Shield is not transferable once registered.</li>
            <li>The following are some of the diseases and conditions considered as non-coverable such as Diabetes Mellitus, Hypertension, Cardiovascular diseases, Asthma, Tuberculosis, Epilepsy, Gastric or Duodenal Ulcer, pre-existing and congenital conditions, treatment of any injury
            which is proven to be attributable to the member's own misconduct. For a complete and updated list of non-covered diseases, please refer to <a href='www.philcare.com.ph/non-covered-illnesses-diseases/'>www.philcare.com.ph/non-covered-illnesses-diseases</a></li>
            <li>Philhealth is required for the availment of this card during hospital confinement.</li>
            <li>Your final medical diagnosis is the basis for PhilCare's approval of coverage.</li>
            <li>The purchase price of ER Shield is at a promotional discount and not eligible for combination with any other discount.</li>
            <li>ER Shield is subject to the policies, guidelines and procedure of PhilCare. Please refer to <a href='www.philcare.com.ph'>www.philcare.com.ph</a></li>
            <li>By registering your card you certify that you have read, understood, and agree to the Terms and Conditions governing the use of card.</li>
        </ul>
        <hr>
        <p><b>IMPORTANT LINKS:</b></p>
        <ul>
          <li>Product Benefits: <a href='www.philcare.com.ph/products'>www.philcare.com.ph/products</a></li>
          <li>Product Terms and Conditions: <a href='www.philcare.com.ph/product-terms-and-conditions'>www.philcare.com.ph/product-terms-and-conditions</a></li>
          <li>Frequently Asked Questions: <a href='www.philcare.com.ph/faqs'>www.philcare.com.ph/faqs</a></li>
          <li>List of non-covered illnesses and diseases: <a href='www.philcare.com.ph/non-covered-illnesses-diseases/'>www.philcare.com.ph/non-covered-illnesses-diseases/</a></li>
          <li>List of hospitals by geographic area: <a href='www.philcare.com.ph/find'>www.philcare.com.ph/find</a> or visit <a href='www.philcare.com.ph/erhospitals'>www.philcare.com.ph/erhospitals</a></li>
        </ul>
        <p></p>
        <p></p>
        <p></p>
        <p>Sincerely yours,</p>
        <p>PhilCare</p>
        <p>&copy; PhilhealthCare, Inc. 4th and 5th floor, STI Holdings Center, 6764 Ayala Avenue, Makati City, Philippines</p>

        ";
        return $string;
    }

    public function messageSCU($data){
        $string = "
        <p>Dear ".$data['FirstName'].",</p>
          <p>Make Health Happen! You have succesfully registered to PhilCare's <b>Smart Check-up</b>. By registering this card, you agree and acknowledge the terms and conditions governing the use of this card.</p>
        <p>Keep this email in a safe place for future reference, as it includes important information. For further assistance, please get in touch with PhilCare through the following channels.</p>
        <ul>
            <li>Call Center: (02) 462-1800</li>
            <li>Email: customercare@philcare.com.ph</li>
            <li>Social media:
                <ul>
                    <li><a href='www.facebook.com/philcareph'>www.facebook.com/philcareph</a></li>
                    <li><a href='www.instagram.com/philcareph'>www.instagram.com/philcareph</a></li>
                    <li><a href='www.twitter.com/philcareph'>www.twitter.com/philcareph</a></li>
                </ul>
            </li>
        </ul>
        <p><b>Member Information</b></p>
        <p>Card type:  ".$data['Card']."</p>
        <p>Certificate Number: ".$data['CertificateNumber']."</p>
        <p>Member Name: ".$data['FirstName']." ".$data['LastName']."</p>
        <p>Coverage Date: ".$data['EffDate']." - ".$data['ExpDate']."</p>
        <p><u>See attached pdf for your membership card.</u></p>
        <hr>
        <p><b>BENEFIT COVERAGE</b></p>
        <p>The <b>Smart Check-up</b> gives you access to a complete set of physical exams from the best doctors and health providers in PHilCare Clinics and affiliated providers.</p>
        <ul>
            <li>Service package includes following out-patient services:
                <ul>
                    <li>Medical History Taking</li>
                    <li>Physical Examination</li>
                    <li>Chest X-Ray</li>
                    <li>Complete Blood Count (CBC)</li>
                    <li>Urinalysis</li>
                    <li>Fecalysis</li>
                </ul>
            </li>
            <li>Additional Benefits
                <ul>
                    <li>Preferential Rates 10% off on ultrasound procedures and 5% discount on laboratory and X-ray procedures arising from the use of the cards at the PhilCare Manila and Makati Clinics. One time availment only.</li>
                    <li>Access to PhilCare Go!Mobile Smart Check-Up lets you download your exam results via the PhilCare Go!Mobile App on your Android device.</li>
                    <li>You can also use your Smart Check-Up to become a myPhilCare member so you can enjoy exclusive deals and invites on wellness.</li>
                    <li>Hassle Free membership.</li>
                    <li>No age restriction and no need for enrolment requirements.</li>
                    <li>Service can be availed only at the following accredited clinics within Metro Manila. (<a href='www.philcare.com.ph/smart-check-list-clinics-metro-manila-variant'>www.philcare.com.ph/smart-check-list-clinics-metro-manila-variant</a>)</li>
                </ul>
            </li>
        </ul>
        <p><b>AVAILMENT PROCEDURE</b></p>
        <ul>
            <li>Please arrange an appointment with the chosen clinic prior to availment. Service maybe availed immediately after activation.</li>
            <li>All services mentioned must be availed on the same day and in the same clinic.</li>
            <li>Valid identification card must be presented for verification.</li>
            <li>The Smart Check-up card must be surrendered to the clinic information section upon availment of the service.</li>
        </ul>
        <p><b>IMPORTANT REMINDERS</b></p>
        <ul>
            <li>Card should be activated prior to service availment.</li>
            <li>Smart Check-up is active for one year from day or registration.</li>
            <li>Non-transferable after activation.</li>
            <li>Please arrange an appointment with the chosen clinic prior to availment.</li>
            <li>Card must be surrendered to clinic information Section after availment of services.</li>
            <li>This product provides services at a discount, and is not eligible for combination with the Senior Citizen's discount or any other promotional discounts.</li>
        </ul>
       
        <p><b>IMPORTANT LINKS:</b></p>
        <ul>
          <li>Product Benefits: <a href='www.philcare.com.ph/products'>www.philcare.com.ph/products</a></li>
          <li>Product Terms and Conditions: <a href='www.philcare.com.ph/product-terms-and-conditions'>www.philcare.com.ph/product-terms-and-conditions</a></li>
          <li>Frequently Asked Questions: <a href='www.philcare.com.ph/faqs'>www.philcare.com.ph/faqs</a></li>
          <li>List of non-covered illnesses and diseases: <a href='www.philcare.com.ph/non-covered-illnesses-diseases/'>www.philcare.com.ph/non-covered-illnesses-diseases/</a></li>
          <li>List of hospitals by geographic area: <a href='www.philcare.com.ph/find'>www.philcare.com.ph/find</a> or visit <a href='www.philcare.com.ph/erhospitals'>www.philcare.com.ph/erhospitals</a></li>
        </ul>
        <p></p>
        <p></p>
        <p></p>
        <p>Sincerely yours,</p>
        <p>PhilCare</p>
        <p>&copy; PhilhealthCare, Inc. 4th and 5th floor, STI Holdings Center, 6764 Ayala Avenue, Makati City, Philippines</p>

        ";
        return $string;
    }

    public function messageMDC($data){
        $string = "
        <p>Dear ".$data['FirstName'].",</p>
          <p>Make Health Happen! You have succesfully registered to PhilCare's <b>".$data['Card']."</b>. By registering this card, you agree and acknowledge the terms and conditions governing the use of this card.</p>
        <p>Keep this email in a safe place for future reference, as it includes important information. For further assistance, please get in touch with PhilCare through the following channels.</p>
        <ul>
            <li>Call Center: (02) 462-1800</li>
            <li>Email: customercare@philcare.com.ph</li>
            <li>Social media:
                <ul>
                    <li><a href='www.facebook.com/philcareph'>www.facebook.com/philcareph</a></li>
                    <li><a href='www.instagram.com/philcareph'>www.instagram.com/philcareph</a></li>
                    <li><a href='www.twitter.com/philcareph'>www.twitter.com/philcareph</a></li>
                </ul>
            </li>
        </ul>
        <p><b>Member Information</b></p>
        <p>Card type:  ".$data['Card']."</p>
        <p>Certificate Number: ".$data['CertificateNumber']."</p>
        <p>Member Name: ".$data['FirstName']." ".$data['LastName']."</p>
        <p>Coverage Date: ".$data['EffDate']." - ".$data['ExpDate']."</p>
        <p><u>See attached pdf for your membership card.</u></p>
        <hr>
        <p><b>BENEFIT COVERAGE</b></p>
        <p>The <b>".$data['Card']."</b> prepaid health card allows you to avail of consultation services from its national network of medical specialists, and dentists in any of PhilCare’s accredited hospital or clinics for one year.</p>
        <p><b>INCLUDES:</b></p>
        <ul>
          <li>One year unlimited medical consultations with 9,600+ PhilCare affiliated Family Medicine Specialists, Internal Medicine Specialist, Cardiologists, Endocrinologists, Nephrologists, Pulmonologists, Gastroenterologists nationwide.</li>
          <li>One year unlimited dental consultations with <u><b>Dental Network dentists</b></u> with the following:
            <ul>
              <li>Annual Dental Examination/Annual Oral Examination</li>
              <li>Unlimited Orthodontic or Aesthetic Consultation</li>
              <li>Gum Treatment for Lesions, Wounds and Burns Only except Alveolectomy and Gingivectomy</li>
              <li>Relief and/or Prescription for Acute Dental Pain</li>
              <li>Diagnosis of Oral Disease, Restorative and Prosthodonctic Treatment Planning</li>
              <li>Dental Nutrition and Dietary Counseling</li>
              <li>Dental Health Education through Chairside Instruction</li>
              <li>First Aid Treatment;Emergency Treatment</li>
              <li>Unlimited temporary Fillings</li>
              <li>Re-cementation of Loose Crowns, Inlays, Onlays and Fixed Bridges</li>
              <li>Simple Repair and Adjustment of Denture</li>
              <li>Simple Tooth Extraction/Unlimited Simple Extraction of an Unsavable Tooth</li>
              <li>Desensitization of Hypersensitivity Teeth</li>
              <li>Annual prophylaxis ( light cases only)</li>
            </ul>
          </li>      

        </ul>
        <p><b>AVAILMENT PROCEDURE</b></p>
        <ul>
            <li><b>Medical Consultation</b>
                <ul>
                    <li>Go to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationscards</a> and click <b>REQUEST FOR LOA</b>. Input your certificate number provided to you upon SMS registration. Include also your birthdate and birthplace.</li>
                    <li>Select your choices of area, hospital/clinic, specialization and doctor.</li>
                    <li>Download and print the Letter of Authorization (LoA) and your personalized membership card.</li>
                    <li>Present these documents with one valid ID to the Doctor on the day of availment. Note that consultation must be availed within 3 calendar days starting from day of issuance of the LoA. Always set an appointment to make sure the Doctor is available.</li>
                </ul>
            </li>
            <li><b>Dental Consultation</b>
                <ul>
                    <li>Choose a dentist. Go to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a> and click PDF file for the listing of dental clinics.</li>
                    <li>Set an appointment with the dentist.</li>
                    <li>Download and print the personalized membership card and present it with one valid ID to the dental clinic on the day of availment.</li>
                </ul>
            </li>
        </ul>
        
        <p><b>IMPORTANT REMINDERS</b></p>
        <ul>
            <li>For individuals aged 65 years old and above at the time of activation. Card is activated 3 days after successful SMS registration. Card may be used within one year from day of activation. Service may be availed after card is activated.</li>
            <li>Card should be registered before card expiry date. Card is not transferable after SMS registration.</li>
            <li>This card entitles the card owner to one year of unlimited medical consultation except for maternity-related cases and cases related to all forms of behavioural disorders, developmental or psychiatric disorder and psychosomatic illness, whether congenital or acquired.</li>
            <li>Consultation services may be availed from PhilCare affiliated Family Medicine Specialists, Internal Medicine Specialists, Cardiologists, Endocrinologists, Nephrologists, Pulmonologists, and Gastroenterologists.</li>
            <li>To avail of medical consultation, create a self-issued Letter of Authorization (LoA) and personalized consultation card at <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards.</a> Present LoA, personalized card and 1 valid ID with picture to chosen medical specialist.</li>
            <li>This card also entitles the card owner to one year of dental services. To avail dental consultations: Download and print the personalized membership card at <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a> and present this with one (1) valid ID of the cardholder on the day of availment.</li>
            <li>The purchase price of the card is at a promotional discount and not eligible for combination with any other discount.</li>
            <li>Card is subject to the policies, guidelines, and procedure of PhilCare. Please refer to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a></li>
            <li>By registering your card you certify that you have read, understood, and agree to the Terms and Conditions governing the use of card.</li>
        </ul>
        <hr>
        <p><b>IMPORTANT LINKS:</b></p>
        <ul>
          <li>Product Benefits: <a href='http://www.philcare.com.ph/product/smart-check/'>http://www.philcare.com.ph/product/smart-check/ </a></li>
            <li>Product Terms and Conditions: <a href='www.philcare.com.ph/product-terms-and-conditions'> www.philcare.com.ph/product-terms-and-conditions</a></li>
            <li>List of accredited clinics: <a href='www.philcare.com.ph/product-terms-and-conditions'>http://www.philcare.com.ph/smart-check-list-clinics-metro-manila-variant/</a></li>
        </ul>
        <p></p>
        <p></p>
        <p></p>
        <p>Sincerely yours,</p>
        <p>PhilCare</p>
        <p>&copy; PhilhealthCare, Inc. 4th and 5th floor, STI Holdings Center, 6764 Ayala Avenue, Makati City, Philippines</p>

        ";
        return $string;
    }
    
    public function messageMDCA($data){
        $string = "
        <p>Dear ".$data['FirstName'].",</p>
          <p>Make Health Happen! You have succesfully registered to PhilCare's <b>".$data['Card']."</b>. By registering this card, you agree and acknowledge the terms and conditions governing the use of this card.</p>
        <p>Keep this email in a safe place for future reference, as it includes important information. For further assistance, please get in touch with PhilCare through the following channels.</p>
        <ul>
            <li>Call Center: (02) 462-1800</li>
            <li>Email: customercare@philcare.com.ph</li>
            <li>Social media:
                <ul>
                    <li><a href='www.facebook.com/philcareph'>www.facebook.com/philcareph</a></li>
                    <li><a href='www.instagram.com/philcareph'>www.instagram.com/philcareph</a></li>
                    <li><a href='www.twitter.com/philcareph'>www.twitter.com/philcareph</a></li>
                </ul>
            </li>
        </ul>
        <p><b>Member Information</b></p>
        <p>Card type:  ".$data['Card']."</p>
        <p>Certificate Number: ".$data['CertificateNumber']."</p>
        <p>Member Name: ".$data['FirstName']." ".$data['LastName']."</p>
        <p>Coverage Date: ".$data['EffDate']." - ".$data['ExpDate']."</p>
        <p><u>See attached pdf for your membership card.</u></p>
        <hr>
        <p><b>BENEFIT COVERAGE</b></p>
        <p>The <b>".$data['Card']."</b> + prepaid health card allows you to avail of consultation services from its national network of medical specialists, and dentists in any of PhilCare’s accredited hospital or clinics for one year.</p>
        <p><b>INCLUDES:</b></p>
        <ul>
          <li>One year unlimited medical consultations with 9,600+ PhilCare affiliated Family Medicine Specialists, Internal Medicine Specialist, Cardiologists, Endocrinologists, Nephrologists, Pulmonologists, Gastroenterologists nationwide.</li>
          <li>One year unlimited dental consultations with <u><b>Dental Network dentists</b></u> with the following:
            <ul>
              <li>Annual Dental Examination/Annual Oral Examination</li>
              <li>Unlimited Orthodontic or Aesthetic Consultation</li>
              <li>Gum Treatment for Lesions, Wounds and Burns Only except Alveolectomy and Gingivectomy</li>
              <li>Relief and/or Prescription for Acute Dental Pain</li>
              <li>Diagnosis of Oral Disease, Restorative and Prosthodonctic Treatment Planning</li>
              <li>Dental Nutrition and Dietary Counseling</li>
              <li>Dental Health Education through Chairside Instruction</li>
              <li>First Aid Treatment;Emergency Treatment</li>
              <li>Unlimited temporary Fillings</li>
              <li>Re-cementation of Loose Crowns, Inlays, Onlays and Fixed Bridges</li>
              <li>Simple Repair and Adjustment of Denture</li>
              <li>Simple Tooth Extraction/Unlimited Simple Extraction of an Unsavable Tooth</li>
              <li>Desensitization of Hypersensitivity Teeth</li>
              <li>Annual prophylaxis ( light cases only)</li>
            </ul>
          </li>      

        </ul>
        <p><b>AVAILMENT PROCEDURE</b></p>
        <ul>
            <li><b>Medical Consultation</b>
                <ul>
                    <li>Go to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationscards</a> and click <b>REQUEST FOR LOA</b>. Input your certificate number provided to you upon SMS registration. Include also your birthdate and birthplace.</li>
                    <li>Select your choices of area, hospital/clinic, specialization and doctor.</li>
                    <li>Download and print the Letter of Authorization (LoA) and your personalized membership card.</li>
                    <li>Present these documents with one valid ID to the Doctor on the day of availment. Note that consultation must be availed within 3 calendar days starting from day of issuance of the LoA. Always set an appointment to make sure the Doctor is available.</li>
                </ul>
            </li>
            <li><b>Dental Consultation</b>
                <ul>
                    <li>Choose a dentist. Go to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a> and click PDF file for the listing of dental clinics.</li>
                    <li>Set an appointment with the dentist.</li>
                    <li>Download and print the personalized membership card and present it with one valid ID to the dental clinic on the day of availment.</li>
                </ul>
            </li>
        </ul>
        
        <p><b>IMPORTANT REMINDERS</b></p>
        <ul>
            <li>For individuals aged 18 to 64 years old at the time of activation. Card is activated 3 days after successful SMS registration. Card may be used within one year from day of activation. Service may be availed after card is activated.</li>
            <li>Card should be registered before card expiry date. Card is not transferable after SMS registration.</li>
            <li>This card entitles the card owner to one year of unlimited medical consultation except for maternity-related cases and cases related to all forms of behavioural disorders, developmental or psychiatric disorder and psychosomatic illness, whether congenital or acquired.</li>
            <li>Consultation services may be availed from PhilCare affiliated Family Medicine Specialists, Internal Medicine Specialists, Cardiologists, Endocrinologists, Nephrologists, Pulmonologists, and Gastroenterologists.</li>
            <li>To avail of medical consultation, create a self-issued Letter of Authorization (LoA) and personalized consultation card at <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards.</a> Present LoA, personalized card and 1 valid ID with picture to chosen medical specialist.</li>
            <li>This card also entitles the card owner to one year of dental services. To avail dental consultations: Download and print the personalized membership card at <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a> and present this with one (1) valid ID of the cardholder on the day of availment.</li>
            <li>The purchase price of the card is at a promotional discount and not eligible for combination with any other discount.</li>
            <li>Card is subject to the policies, guidelines, and procedure of PhilCare. Please refer to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a></li>
            <li>By registering your card you certify that you have read, understood, and agree to the Terms and Conditions governing the use of card.</li>
        </ul>
        <hr>
        <p><b>IMPORTANT LINKS:</b></p>
        <ul>
          <li>Product Benefits: <a href='http://www.philcare.com.ph/product/smart-check/'>http://www.philcare.com.ph/product/smart-check/ </a></li>
            <li>Product Terms and Conditions: <a href='www.philcare.com.ph/product-terms-and-conditions'> www.philcare.com.ph/product-terms-and-conditions</a></li>
            <li>List of accredited clinics: <a href='www.philcare.com.ph/product-terms-and-conditions'>http://www.philcare.com.ph/smart-check-list-clinics-metro-manila-variant/</a></li>
        </ul>
        <p></p>
        <p></p>
        <p></p>
        <p>Sincerely yours,</p>
        <p>PhilCare</p>
        <p>&copy; PhilhealthCare, Inc. 4th and 5th floor, STI Holdings Center, 6764 Ayala Avenue, Makati City, Philippines</p>

        ";
        return $string;
    }
    
    public function messageKids($data){
        $string = "
        <p>Dear ".$data['FirstName'].",</p>
          <p>Make Health Happen! You have succesfully registered to PhilCare's <b>".$data['Card']."</b>. By registering this card, you agree and acknowledge the <a href='http://www.philcare.com.ph/product-terms-and-conditions/'>terms and conditions</a> governing the use of this card.</p>
        <p>Keep this email in a safe place for future reference, as it includes important information. For further assistance, please get in touch with PhilCare through the following channels.</p>
        <ul>
            <li>Call Center: (02) 462-1800</li>
            <li>Email: customercare@philcare.com.ph</li>
            <li>Social media:
                <ul>
                    <li><a href='www.facebook.com/philcareph'>www.facebook.com/philcareph</a></li>
                    <li><a href='www.instagram.com/philcareph'>www.instagram.com/philcareph</a></li>
                    <li><a href='www.twitter.com/philcareph'>www.twitter.com/philcareph</a></li>
                </ul>
            </li>
        </ul>
        <p><b>Member Information</b></p>
        <p>Card type:  ".$data['Card']."</p>
        <p>Certificate Number: ".$data['CertificateNumber']."</p>
        <p>Member Name: ".$data['FirstName']." ".$data['LastName']."</p>
        <p>Coverage Date: ".$data['EffDate']." - ".$data['ExpDate']."</p>
        <p><u>See attached pdf for your membership card.</u></p>
        <hr>
        <p><b>BENEFIT COVERAGE</b></p>
        <p>The <b>".$data['Card']."</b> prepaid health card allows you to avail of consultation services from its national network of medical specialists, and dentists in any of PhilCare's accredited hospital or clinics for one year.</p>
        <p><b>INCLUDES:</b></p>
        <ul>
          <li>One year unlimited medical consultations with <u><b>5,500+ PhilCare affilated Peditricians</b></u> nationwide.</li>
          <li>One year unlimited dental consultations with <u><b>Dental Network dentists</b></u> with the following:
            <ul>
              <li>Annual Dental Examination/Annual Oral Examination</li>
              <li>Unlimited Orthodontic or Aesthetic Consultation</li>
              <li>Gum Treatment for Lesions, Wounds and Burns Only except Alveolectomy and Gingivectomy</li>
              <li>Relief and/or Prescription for Acute Dental Pain</li>
              <li>Diagnosis of Oral Disease, Restorative and Prosthodonctic Treatment Planning</li>
              <li>Dental Nutrition and Dietary Counseling</li>
              <li>Dental Health Education through Chairside Instruction</li>
              <li>First Aid Treatment;Emergency Treatment</li>
              <li>Unlimited temporary Fillings</li>
              <li>Re-cementation of Loose Crowns, Inlays, Onlays and Fixed Bridges</li>
              <li>Simple Repair and Adjustment of Denture</li>
              <li>Simple Tooth Extraction/Unlimited Simple Extraction of an Unsavable Tooth</li>
              <li>Desensitization of Hypersensitivity Teeth</li>
              <li>Annual prophylaxis ( light cases only)</li>
            </ul>
          </li>      

        </ul>
        <p><b>AVAILMENT PROCEDURE</b></p>
        <ul>
            <li><b>Medical Consultation</b>
                <ul>
                    <li>Go to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationscards</a> and click <b>REQUEST FOR LOA</b>. Input your certificate number provided to you upon SMS registration. Include also your birthdate and birthplace.</li>
                    <li>Select your choices of area, hospital/clinic, specialization and doctor.</li>
                    <li>Download and print the Letter of Authorization (LoA) and your personalized membership card.</li>
                    <li>Present these documents with one vliad ID to the Doctor on the day of availment. Note that consultation must be availed within 3 calendar days starting from day of issuance of the LoA. Always set an appointment to make sure the Doctor is available.</li>
                </ul>
            </li>
            <li><b>Dental Consultation</b>
                <ul>
                    <li>Choose a dentist. Go to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a> and click PDF file for the listing of dental clinics.</li>
                    <li>Set an appointment with the dentist.</li>
                    <li>Download and print the personalized membership card and present it with one valid ID to the dental clinic on the day of availment.</li>
                </ul>
            </li>
        </ul>
        <p><b>IMPORTANT REMINDERS</b></p>
        <ul>
            <li>For individuals aged 1 to 17 years old at the time of activation. Card is activated 3 days after successful SMS registration. Card may be used within one year from day of activation. Service may be availed after card is activated.</li>
            <li>Card should be registered before card expiry date. Card is not transferable after SMS registration.</li>
            <li>This card entitles the card owner to one year of unlimited medical consultation except for maternity-related cases and cases related to all forms of behavioural disorders, developmental or psychiatric disorder and psychosomatic illness, whether congenital or acquired.</li>
            <li>Consultation services may be availed from PhilCare affiliated Pediatricians nationwide.</li>
            <li>To avail of medical consultation, create a self-issued Letter of Authorization (LoA) and personalized consultation card at <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards.</a> Present LoA, personalized card and 1 valid ID with picture to chosen medical specialist.</li>
            <li>This card also entitles the card owner to one year of dental services. To avail dental consultations: Download and print the personalized membership card at <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a> and present this with one (1) valid ID of the cardholder on the day of availment.</li>
            <li>The purchase price of the card is at a promotional discount and not eligible for combination with any other discount.</li>
            <li>Card is subject to the policies, guidelines, and procedure of PhilCare. Please refer to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a></li>
            <li>By registering your card you certify that you have read, understood, and agree to the Terms and Conditions governing the use of card.</li>
        </ul>
        <hr>
        <p><b>IMPORTANT LINKS:</b></p>
        <ul>
            <li>Product Benefits: <a href='http://www.philcare.com.ph/product/smart-check/'>http://www.philcare.com.ph/product/smart-check/ </a></li>
            <li>Product Terms and Conditions: <a href='www.philcare.com.ph/product-terms-and-conditions'> www.philcare.com.ph/product-terms-and-conditions</a></li>
            <li>List of accredited clinics: <a href='www.philcare.com.ph/product-terms-and-conditions'>http://www.philcare.com.ph/smart-check-list-clinics-metro-manila-variant/</a></li>
        </ul>
        <p></p>
        <p></p>
        <p></p>
        <p>Sincerely yours,</p>
        <p>PhilCare</p>
        <p>&copy; PhilhealthCare, Inc. 4th and 5th floor, STI Holdings Center, 6764 Ayala Avenue, Makati City, Philippines</p>

        ";
        return $string;
    }
    
    public function stringERShield($data){
        $string = "<p><b>BENEFIT COVERAGE</b></p>           
        <p>The <b>ER Shield</b> prepaid health card provides coverage for outpatient emergency care for treatment of medical emergency cases due to accident or illness at around 400+ PhilCare accredited hospitals nationwide.</p>
        <p><i>Emergency cases covered are sudden, unexpected onset of illness or injury which at the time of availment reasonably appeared as having the potential of causing immediate disability or death or requiring immediate alleviation of severe pain or discomfort.</i></p>
        <p><b>INCLUDES:</b></p>
        <ul>
          <li>P50,000 coverage for emergency room care inclusive of doctors’ fees, laboratory and diagnostic procedures, and medicines (except vaccines) as medically necessary except for cases declared as non-coverable.</li>
          <ul>
            <li>Covers special modalities of treatment as medically necessary during emergency and subject to Php 5,000 inner limit.</li>
            <li>Inclusive of diagnostic and therapeutic procedures as medically necessary for emergency room care.</li>
            <li>Covers hospital emergency care for animal bites except vaccines.</li>
          </ul>
          <li>Room and board: <b>None. This card is for OUTPATIENT USE only</b></li>
          <li>No hospital deposit required</li>
          <li>Access to 400+ accredited hospitals nationwide (<a href='www.philcare.com.ph/erhospitals'>www.philcare.com.ph/erhospitals</a>)</li>
          <li>No medical examination required to apply</li>
          <li>Hassle-free SMS registration</li>
        </ul>
        <p><b>AVAILMENT PROCEDURE</b></p>
        <ul>
            <li>Go to the Emergency Room (ER) of the nearest accredited hospital. List is found at <a href='www.philcare.com.ph/erhospitals/'>www.philcare.com.ph/erhospitals</a></li>
            <li>Present your PhilCare member card together with a valid ID to ER Personnel for membership verification. The hospital staff will be the one to contact PhilCare to verify your memberhsip and the applicability of coverage based on your initial or if available, your final medical diagnosis and treatment. </li>
            <li>If no confinement is required</li>
            <ul>
                <li>Receive necessary emergency care</li>
                <li>Sign the Emergency Treatment Form and Hospital Statement of Account/Charge Slip prior to discharge.</li>
            </ul>
        </ul>
        <p><b>IMPORTANT REMINDERS</b></p>
        <ul>
            <li>For individuals aged 6 months to 64 years old at the time of activation of ER Shield.</li>
            <li>Register prior to service availment and before card expiry date. Service could be availed 7 days after successful SMS registration.</li>
            <li>Present the card with a valid identification to the emergency room staff at any PhilCare accredited hospitals.</li>
            <li>ER Shield is active for one year from day of effectivity and can only be used once within the effectivity period.</li>
            <li>The following are some of the diseases and conditions considered as non-coverable such as Diabetes Mellitus, Hypertension, Cardiovascular diseases, Asthma, Tuberculosis, Epilepsy, Gastric or Duodenal Ulcer, pre-existing and congenital conditions, treatment of any injury
            which is proven to be attributable to the member's own misconduct. For a complete and updated list of non-covered diseases, please refer to <a href='www.philcare.com.ph/non-covered-illnesses-diseases/'>www.philcare.com.ph/non-covered-illnesses-diseases</a></li>
            <li>Philhealth is required for the availment of this card during hospital confinement.</li>
            <li>Your final medical diagnosis is the basis for PhilCare's approval of coverage.</li>
            <li>The purchase price of ER Shield is at a promotional discount and not eligible for combination with any other discount.</li>
            <li>ER Shield is subject to the policies, guidelines and procedure of PhilCare. Please refer to <a href='www.philcare.com.ph'>www.philcare.com.ph</a></li>
            <li>By registering your card you certify that you have read, understood, and agree to the Terms and Conditions governing the use of card.</li>
        </ul>";
        return $string;
    }
    
    public function stringERVantage($data){
        $string = "<p><b>BENEFIT COVERAGE</b></p>
        <p>The ".$data['Card']." prepaid health card provides coverage for emergency care leading to admission for treatment of medical emergency cases due to accident or illness at around 400+ PhilCare accredited hospitals nationwide.</p>
        <p><i>Emergency cases covered are sudden, unexpected onset of illness or injury which at the time of availment reasonably appeared as having the potential of causing immediate disability or death or requiring immediate alleviation of severe pain or discomfort. Examples of these are Dengue, Typhoid fever, Leptospirosis, Pneumonia, Acute gastroenteritis.</i></p>
        <p><b>INCLUDES</b></p>
        <ul>
            <li>".$data['price']." coverage for emergency room care and hospitalization inclusive of doctor's fees, laboratory and diagnostic procedures, room and bnoard, and medicines (except vaccines) as medically necessary during confinement except for cases declared as non-coverable</li>
            <ul>
                <li>Covers special modalities of treatment as medically necessary during ER and confinement and subject to Php 5,000 inner lmit</li>
                <li>Inclusive of diagnostic and therapeutic procedures as medically necessary during ER and confinement</li>
                <li>Covers hospital emergency care for animal bites except vaccines</li>
            </ul>
            <li>Room abd board: ". $data['ward']."</li>
            <li>No hospital deposit required</li>
            <li>Access to 400+ accredited hospitals nationwide ( <a href='www.philcare.com.ph/erhospitals'>www.philcare.com.ph/erhospitals </a> )</li>
            <li>No medical examination required to apply</li>
        </ul>
                
        <p><b>AVAILMENT PROCEDURE</b></p>
        <ul>
            <li>Go to the Emergency Room (ER) of the nearest accredited hospital. List is found at <a href='www.philcare.com.ph/erhospitals'>www.philcare.com.ph/erhospitals</a></li>
            <li>Present your PhilCare member card together with a valid ID to ER Personnel for memberhsip verification. The hospital staff will be the one to contact PhilCare to verify your membership and the applicability of coverage based on your initial or if available, your final medical diagnosis and treatment.</li>
            <li><i>If confinement is required</i>
                <ul>
                    <li>The ER staff will endorse your case to the Admitting Section.</li>
                    <li>Though the Admitting Section would have received your details from the ER staff, they may revalidate your ER Vantage card and it's applicability based on the available medical diagnosis.</li>
                    <li>Please note that the coverage of the ER Vantage is based on the final medical diagnosis. The initial presentation of your symptoms may indicate a covered accident or illness for which a PhilCare In-Patient Letter of Authorization (LoA) may be issued. However, this may be invalidated and revoked if it is shown in the course of medical treatment that the case is excluded or pre-existing. PhilCare will decide on coverage base on final medical diagnosis.</li>
                    <li>The In-Patient LoA will be secured by the hospital from PhilCare.</li>
                    <li>For Philhealth members, file your Philhealth within the hospital prior to discharge, to avoid paying the Philhealth portion of the hospital bill.</li>
                    <li>Prior to discharge, sign the hospital Statement of Account and pay the ineligible charges and items not covered by PhilCare, if any.</li>
                </ul>
            </li>
                
            <li><i>If no confinement is required</i>
                <ul>
                    <li>Receive necessary emergency care</li>
                    <li>Sign the Emergency Treatment Form and Hospital Statement of Account/Charge Slip prior to discharge.</li>
                </ul>
            </li>
        </ul>
        <p><b>IMPORTANT REMINDERS</b></p>
        <ul>
            <li>For individuals aged 6 months to 64 years old at the time of activation of ER Vantage.</li>
            <li>Register prior to service availment and before card expiry date. Service could be availed 7 days after successful SMS registration.</li>
            <li>Present the card with a valid identification to the emergency room staff at any PhilCare accredited hospitals.</li>
            <li>ER Vantage is active for one year from day of effectivity and can only be used once within the effectivity period.</li>
            <li>ER Vantage is not transferable once registered.</li>
            <li>The following are some of the diseases and conditions considered as non-coverable such as Diabetes Mellitus, Hypertension, Cardiovascular diseases, Asthma, Tuberculosis, Epilepsy, Gastric or Duodenal Ulcer, pre-existing and congenital conditions, treatment of any injury
            which is proven to be attributable to the member's own misconduct. For a complete and updated list of non-covered diseases, please refer to <a href='www.philcare.com.ph/non-covered-illnesses-diseases/'>www.philcare.com.ph/non-covered-illnesses-diseases</a></li>
            <li>Philhealth is required for the availment of this card during hospital confinement.</li>
            <li>Your final medical diagnosis is the basis for PhilCare's approval of coverage.</li>
            <li>The purchase price of ER Vantage is at a promotional discount and not eligible for combination with any other discount.</li>
            <li>ER Vantage is subject to the policies, guidelines and procedure of PhilCare. Please refer to <a href='www.philcare.com.ph'>www.philcare.com.ph</a></li>
            <li>By registering your card you certify that you have read, understood, and agree to the Terms and Conditions governing the use of card.</li>
        </ul>";
        return $string;
    }
    
    public function stringSCU($data){
        $string = "<p><b>BENEFIT COVERAGE</b></p>
        <p>The <b>Smart Check-up</b> gives you access to a complete set of physical exams from the best doctors and health providers in PhilCare Clinics and accredited providers.</p>
        <ul>
            <li>Service package includes following out-patient services:
                <ul>
                    <li>Medical History Taking</li>
                    <li>Physical Examination</li>
                    <li>Chest X-Ray</li>
                    <li>Complete Blood Count (CBC)</li>
                    <li>Urinalysis</li>
                    <li>Fecalysis</li>
                </ul>
            </li>
            <li>Additional Benefits
                <ul>
                    <li>Preferential Rates 10% off on ultrasound procedures and 5% discount on laboratory and X-ray procedures arising from the use of the cards at the PhilCare Manila and Makati Clinics. One time availment only.</li>
                    <li>Access to PhilCare Go!Mobile. Smart Check-Up lets you download your exam results via the PhilCare Go!Mobile App on your Android device.</li>                    
                    <li>Hassle Free membership.</li>
                    <li>No age restriction and no need for enrolment requirements.</li>
                    <li>Service can be availed only at the following accredited clinics within Metro Manila. (<a href='www.philcare.com.ph/smart-check-list-clinics-metro-manila-variant'>www.philcare.com.ph/smart-check-list-clinics-metro-manila-variant</a>)</li>
                </ul>
            </li>
        </ul>
        <p><b>AVAILMENT PROCEDURE</b></p>
        <ul>
            <li>Please arrange an appointment with the chosen clinic prior to availment. Service maybe availed immediately after activation.</li>
            <li>All services mentioned must be availed on the same day and in the same clinic.</li>
            <li>Valid identification card must be presented for verification.</li>
            <li>The Smart Check-up card must be surrendered to the clinic information section upon availment of the service.</li>
        </ul>
        <p><b>IMPORTANT REMINDERS:</b></p>
        <ul>
            <li>Card should be activated prior to service availment.</ul> 
            <li>Smart Check-up is active for one year from day or registration.</ul>
            <li>Non-transferable after activation.</ul>
            <li>Please arrange an appointment with the chosen clinic prior to availment.</ul>
            <li>Card must be surrendered to clinic Information Section after availment of services.</ul>
            <li>This product provides services at a discount, and is not eligible for combination with the Senior Citizen’s discount or any other promotional discounts.</ul>

        </ul>
    ";
        
        return $string;
    }
    
    public function stringMDCA($data){
        $string = "<p><b>BENEFIT COVERAGE</b></p>
        <p>The <b>Medical and Dental Consultation Cards for Adults</b> prepaid health card allows you to avail of consultation services from its national network of medical specialists, and dentists in any of PhilCare’s accredited hospital or clinics for one year.</p>
        <p><b>INCLUDES:</b></p>
        <ul>
          <li>One year unlimited medical consultations with 9,600+ PhilCare affiliated Family Medicine Specialists, Internal Medicine Specialists, Cardiologists, Endocrinologists, Nephrologists, Pulmonologists, Gastroenterologists nationwide.</li>
          <li>One year unlimited dental consultations with <u><b>Dental Network dentists</b></u> with the following:
            <ul>
              <li>Annual Dental Examination/Annual Oral Examination</li>
              <li>Unlimited Orthodontic or Aesthetic Consultation</li>
              <li>Gum Treatment for Lesions, Wounds and Burns Only except Alveolectomy and Gingivectomy</li>
              <li>Relief and/or Prescription for Acute Dental Pain</li>
              <li>Diagnosis of Oral Disease, Restorative and Prosthodonctic Treatment Planning</li>
              <li>Dental Nutrition and Dietary Counseling</li>
              <li>Dental Health Education through Chairside Instruction</li>
              <li>First Aid Treatment;Emergency Treatment</li>
              <li>Unlimited temporary Fillings</li>
              <li>Re-cementation of Loose Crowns, Inlays, Onlays and Fixed Bridges</li>
              <li>Simple Repair and Adjustment of Denture</li>
              <li>Simple Tooth Extraction/Unlimited Simple Extraction of an Unsavable Tooth</li>
              <li>Desensitization of Hypersensitivity Teeth</li>
              <li>Annual prophylaxis ( light cases only)</li>
            </ul>
          </li>      

        </ul>
        <p><b>AVAILMENT PROCEDURE</b></p>
        <ul>
            <li><b>Medical Consultation</b>
                <ul>
                    <li>Go to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationscards</a> and click <b>REQUEST FOR LOA</b>. Input your certificate number provided to you upon SMS registration. Include also your birthdate and birthplace.</li>
                    <li>Select your choices of area, hospital/clinic, specialization and doctor.</li>
                    <li>Download and print the Letter of Authorization (LoA) and your personalized membership card.</li>
                    <li>Present these documents with one valid ID to the Doctor on the day of availment. Note that consultation must be availed within 3 calendar days starting from day of issuance of the LoA. Always set an appointment to make sure the Doctor is available.</li>
                </ul>
            </li>
            <li><b>Dental Consultation</b>
                <ul>
                    <li>Choose a dentist. Go to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a> and click PDF file for the listing of dental clinics.</li>
                    <li>Set an appointment with the dentist.</li>
                    <li>Download and print the personalized membership card and present it with one valid ID to the dental clinic on the day of availment.</li>
                </ul>
            </li>
        </ul>
        
        <p><b>IMPORTANT REMINDERS</b></p>
        <ul>
            <li>For individuals aged 18 to 64 years old at the time of activation. Card is activated 3 days after successful SMS registration. Card may be used within one year from day of activation. Service may be availed after card is activated.</li>
            <li>Card should be registered before card expiry date. Card is not transferable after SMS registration.</li>
            <li>This card entitles the card owner to one year of unlimited medical consultation except for maternity-related cases and cases related to all forms of behavioural disorders, developmental or psychiatric disorder and psychosomatic illness, whether congenital or acquired.</li>
            <li>Consultation services may be availed from PhilCare affiliated Family Medicine Specialists, Internal Medicine Specialists, Cardiologists, Endocrinologists, Nephrologists, Pulmonologists, and Gastroenterologists.</li>
            <li>To avail of medical consultation, create a self-issued Letter of Authorization (LoA) and personalized consultation card at <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards.</a> Present LoA, personalized card and 1 valid ID with picture to chosen medical specialist.</li>
            <li>This card also entitles the card owner to one year of dental services. To avail dental consultations: Download and print the personalized membership card at <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a> and present this with one (1) valid ID of the cardholder on the day of availment.</li>
            <li>The purchase price of the card is at a promotional discount and not eligible for combination with any other discount.</li>
            <li>Card is subject to the policies, guidelines, and procedure of PhilCare. Please refer to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a></li>
            <li>By registering your card you certify that you have read, understood, and agree to the Terms and Conditions governing the use of card.</li>
        </ul>";
        return $string;
    }
    
    public function stringMDC($data){
        $string = "<p><b>BENEFIT COVERAGE</b></p>
        <p>The <b>Medical and Dental Consultation Cards for 65 years old</b> + prepaid health card allows you to avail of consultation services from its national network of medical specialists, and dentists in any of PhilCare’s accredited hospital or clinics for one year.</p>
        <p><b>INCLUDES:</b></p>
        <ul>
          <li>One year unlimited medical consultations with 9,600+ PhilCare affiliated Family Medicine Specialists, Internal Medicine Specialist, Cardiologists, Endocrinologists, Nephrologists, Pulmonologists, Gastroenterologists nationwide.</li>
          <li>One year unlimited dental consultations with <u><b>Dental Network dentists</b></u> with the following:
            <ul>
              <li>Annual Dental Examination/Annual Oral Examination</li>
              <li>Unlimited Orthodontic or Aesthetic Consultation</li>
              <li>Gum Treatment for Lesions, Wounds and Burns Only except Alveolectomy and Gingivectomy</li>
              <li>Relief and/or Prescription for Acute Dental Pain</li>
              <li>Diagnosis of Oral Disease, Restorative and Prosthodonctic Treatment Planning</li>
              <li>Dental Nutrition and Dietary Counseling</li>
              <li>Dental Health Education through Chairside Instruction</li>
              <li>First Aid Treatment;Emergency Treatment</li>
              <li>Unlimited temporary Fillings</li>
              <li>Re-cementation of Loose Crowns, Inlays, Onlays and Fixed Bridges</li>
              <li>Simple Repair and Adjustment of Denture</li>
              <li>Simple Tooth Extraction/Unlimited Simple Extraction of an Unsavable Tooth</li>
              <li>Desensitization of Hypersensitivity Teeth</li>
              <li>Annual prophylaxis ( light cases only)</li>
            </ul>
          </li>      

        </ul>
        <p><b>AVAILMENT PROCEDURE</b></p>
        <ul>
            <li><b>Medical Consultation</b>
                <ul>
                    <li>Go to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationscards</a> and click <b>REQUEST FOR LOA</b>. Input your certificate number provided to you upon SMS registration. Include also your birthdate and birthplace.</li>
                    <li>Select your choices of area, hospital/clinic, specialization and doctor.</li>
                    <li>Download and print the Letter of Authorization (LoA) and your personalized membership card.</li>
                    <li>Present these documents with one valid ID to the Doctor on the day of availment. Note that consultation must be availed within 3 calendar days starting from day of issuance of the LoA. Always set an appointment to make sure the Doctor is available.</li>
                </ul>
            </li>
            <li><b>Dental Consultation</b>
                <ul>
                    <li>Choose a dentist. Go to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a> and click PDF file for the listing of dental clinics.</li>
                    <li>Set an appointment with the dentist.</li>
                    <li>Download and print the personalized membership card and present it with one valid ID to the dental clinic on the day of availment.</li>
                </ul>
            </li>
        </ul>
        
        <p><b>IMPORTANT REMINDERS</b></p>
        <ul>
            <li>For individuals aged 65 years old and above at the time of activation. Card is activated 3 days after successful SMS registration. Card may be used within one year from day of activation. Service may be availed after card is activated.</li>
            <li>Card should be registered before card expiry date. Card is not transferable after SMS registration.</li>
            <li>This card entitles the card owner to one year of unlimited medical consultation except for maternity-related cases and cases related to all forms of behavioural disorders, developmental or psychiatric disorder and psychosomatic illness, whether congenital or acquired.</li>
            <li>Consultation services may be availed from PhilCare affiliated Family Medicine Specialists, Internal Medicine Specialists, Cardiologists, Endocrinologists, Nephrologists, Pulmonologists, and Gastroenterologists.</li>
            <li>To avail of medical consultation, create a self-issued Letter of Authorization (LoA) and personalized consultation card at <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards.</a> Present LoA, personalized card and 1 valid ID with picture to chosen medical specialist.</li>
            <li>This card also entitles the card owner to one year of dental services. To avail dental consultations: Download and print the personalized membership card at <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a> and present this with one (1) valid ID of the cardholder on the day of availment.</li>
            <li>The purchase price of the card is at a promotional discount and not eligible for combination with any other discount.</li>
            <li>Card is subject to the policies, guidelines, and procedure of PhilCare. Please refer to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a></li>
            <li>By registering your card you certify that you have read, understood, and agree to the Terms and Conditions governing the use of card.</li>
        </ul>";
        return $string;
    }
    
    public function stringMDCK($data){
        $string = "<p><b>BENEFIT COVERAGE</b></p>            
        <p>The <b>".$data['Card']."</b> prepaid health card allows you to avail of consultation services from its national network of medical specialists, and dentists in any of PhilCare’s accredited hospital or clinics for one year.</p>
        <p><b>INCLUDES:</b></p>
        <ul>
          <li>One year unlimited medical consultations with 5,500+ PhilCare affiliated Pediatricians nationwide.</li>
          <li>One year unlimited dental consultations with Dental Network dentists with the following:
            <ul>
                <li>Annual Dental Examination/Annual Oral Examination</li>
                <li>Unlimited Orthodontic or Aesthetic Consultation</li>
                <li>Gum Treatment for Lesions, Wounds and Burns Only except Alveolectomy and Gingivectomy</li>
                <li>Relief and/or Prescription for Acute Dental Pain</li>
                <li>Diagnosis of Oral Disease, Restorative and Prosthodonctic Treatment Planning</li>
                <li>Dental Nutrition and Dietary Counseling</li>
                <li>Dental Health Education through Chairside Instruction</li>
                <li>First Aid Treatment/Emergency Treatment</li>
                <li>Unlimited temporary Fillings</li>
                <li>Re-cementation of Loose Crowns, Inlays, Onlays and Fixed Bridges</li>
                <li>Simple Repair and Adjustment of Denture</li>
                <li>Simple Tooth Extraction/Unlimited Simple Extraction of an Unsavable Tooth</li>
                <li>Desensitization of Hypersensitivity Teeth</li>
                <li>Annual prophylaxis (light cases only)</li>
            </ul>
          </li>      

        </ul>
        <p><b>AVAILMENT PROCEDURE</b></p>
        <ul>
        
            <li><b>Medical Consultation</b>
                <ul>
                    <li>Go to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationscards</a> and click <b>REQUEST FOR LOA</b>. Input your certificate number provided to you upon SMS registration. Include also your birthdate and birthplace.</li>
                    <li>Select your choices of area, hospital/clinic, specialization and doctor.</li>
                    <li>Download and print the Letter of Authorization (LoA) and your personalized membership card.</li>
                    <li>Present these documents with one valid ID to the Doctor on the day of availment. Note that consultation must be availed within 3 calendar days starting from day of issuance of the LoA. Always set an appointment to make sure the Doctor is available.</li>
                </ul>
            </li>
            <li><b>Dental Consultation</b>
                <ul>            
                    <li>Choose a dentist. Go to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a> and click PDF file for the listing of dental clinics.</li>
                    <li>Set an appointment with the dentist.</li>
                    <li>Download and print the personalized membership card and present it with one valid ID to the dental clinic on the day of availment.</li>
                </ul>
            </li>
        </ul>
        <p><b>IMPORTANT REMINDERS</b></p>
        <ul>
            <li>For individuals aged 1 to 17 years old at the time of activation. Card is activated 3 days after successful SMS registration. Card may be used within one year from day of activation. Service may be availed after card is activated.</li>
            <li>Card should be registered before card expiry date. Card is not transferable after SMS registration.</li>
            <li>This card entitles the card owner to one year of unlimited medical consultation except for maternity-related cases and cases related to all forms of behavioural disorders, developmental or psychiatric disorder and psychosomatic illness, whether congenital or acquired.</li>
            <li>Consultation services may be availed from PhilCare affiliated Pediatricians nationwide .</li>
            <li>To avail of medical consultation, create a self-issued Letter of Authorization (LoA) and personalized consultation card at <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards.</a> Present LoA, personalized card and 1 valid ID with picture to chosen medical specialist.</li>
            <li>This card also entitles the card owner to one year of dental services. To avail dental consultations: Download and print the personalized membership card at <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a> and present this with one (1) valid ID of the cardholder on the day of availment.</li>
            <li>The purchase price of the card is at a promotional discount and not eligible for combination with any other discount.</li>
            <li>Card is subject to the policies, guidelines, and procedure of PhilCare. Please refer to <a href='www.philcare.com.ph/consultationcards'>www.philcare.com.ph/consultationcards</a></li>
            <li>By registering your card you certify that you have read, understood, and agree to the Terms and Conditions governing the use of card.</li>
        </ul>";
        return $string;
    }

}