<?php
/*
Author : Zoilo Calipara Rabang
*/
class wslibrary {

    private $config = array();
    private $buffer = NULL;
    private $lines = 0;
    private $baseurl = 'http://philcare.com.ph/gateway/';    
    private $data = NULL;
	//public $_SERVER['webservice'] = "https://apps.philcare.com.ph/PCareWebServicesTest";
	
    public function __construct() {
        
    }
    
    public function feedback_send($data){
        //print_r($data);
        $url = $_SERVER['webservice']."/Members.svc/SendMembersFeedBack/?CertNo=".$data['cert_no']."&Category=".$data['category']."&SubCategory=".$data['sub_category']."&FeedBack=".$data['feedback'];
       // https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/SendMembersFeedBack/?CertNo=5443460&Category=Category&SubCategory=SubCategory&FeedBack=sdfsdfsdfsdfsdf
        $getxml = @file_get_contents($url);
       
	$xml = simplexml_load_file($url);
        //$xml = simplexml_load_file($url);
        //print_r($xml);
            $data = $xml->SendMembersFeedBackResult;
            $namespaces = $data->getNameSpaces(true);
        if(property_exists($data->children('a:SuccessFlag'), 'SuccessFlag')){
            $info = $data->children($namespaces['a']);		
            return $info;
        }else{
            return false;
        }	
       
    }
    
    public function feedback_view($data){
        
        $url = $_SERVER['webservice']."/Members.svc/MemberFeedBackList/?CertNo=".$data;
       // https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/SendMembersFeedBack/?CertNo=5443460&Category=Category&SubCategory=SubCategory&FeedBack=sdfsdfsdfsdfsdf
        $getxml = @file_get_contents($url);
       
	$xml = simplexml_load_file($url);
        //$xml = simplexml_load_file($url);
        //print_r($xml);
        $data = $xml->MemberFeedBackListResult;
        $namespaces = $data->getNameSpaces(true);
        if(property_exists($data->children('a:MemberFeedBackList'), 'MemberFeedBackList')){
            $info = $data->children($namespaces['a']);		
            return $info;
        }else{
            return false;
        }
        
    }
    function phillogin($user,$pass){
        
        //$url = 'https://apps.philcare.com.ph/PCareWebServices/Login.svc/Login/?UserName=philcaregomobile&Pwd=p@ssw0rd';
	$url = $_SERVER['webservice'].'/Login.svc/Login/?UserName='.$user.'&Pwd='.$pass;
	$getxml = @file_get_contents($url);
        if($getxml === FALSE)
            return false;
        //$xml = simplexml_load_file($url);
	$xml = simplexml_load_string($getxml);
	$data = $xml->LoginMemberResult;
	$namespaces = $data->getNameSpaces(true);
        if(property_exists($data->children('a:SuccessFlag'), 'SuccessFlag')){
            $info = $data->children($namespaces['a']);		
            return $info;
        }else{
            return false;
        }	
    }
    
    function getMembersInfo($cert,$other = NULL){
        if($cert=='0'){
               
            $info = array(
                'name' => 'test'
            );                    
            return $info;
        }else{
            //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/MembersInfo/?Certno='.$cert;
            $url = $_SERVER['webservice'].'/Members.svc/MembersInfo/?Certno='.$cert;
            $getxml = @file_get_contents($url);
                
            if(!$getxml){
                $info = "";
                return $info;
            }else{
                $xml = simplexml_load_string($getxml);
                $data = $xml->MembersInfoResult;
                $namespaces = $data->getNameSpaces(true);
                $info = $data->children($namespaces['a']);	

                return $info;
            }
		
        }
    }
	
    function getMedInfo($cert){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/MedicalInfo/?Certno='.$cert;
        $url = $_SERVER['webservice'].'/Members.svc/MedicalInfo/?Certno='.$cert;
        
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);        
        
        $data = $xml->GetMedicalInfoResult;
        $namespaces = $data->getNameSpaces(true);
        if(property_exists($data->children('a:APEResult'), 'APEResult')){
            $info = $data->children($namespaces['a']);
            return $info;
        }else{
            return false;
        }
    }	


//med info start
    function getAPEAvailments($cert){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/APE/?Certno='.$cert;
        $url = $_SERVER['webservice'].'/Members.svc/APE/?Certno='.$cert;
        
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);
        $data = $xml->GetAPEAvailmentResult;
        $namespaces = $data->getNameSpaces(true);
        $info = $data->children($namespaces['a']);	

        return $info;
    }
	
    function getDentalAvailments($cert){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/Dental/?Certno='.$cert;
        $url = $_SERVER['webservice'].'/Members.svc/Dental/?Certno='.$cert;
        
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);
        $data = $xml->GetDentalResult;
        $namespaces = $data->getNameSpaces(true);
        $info = $data->children($namespaces['a']);	

        return $info;
    }	


    function getInpatient($cert){
        //$url ='https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/Claim/?CertNo='.$cert.'&ClaimType=IP';
        $url =$_SERVER['webservice'].'/Members.svc/Claim/?CertNo='.$cert.'&ClaimType=IP';
        
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);
        $data = $xml->GetClaimResult;
        $namespaces = $data->getNameSpaces(true);
        $info = $data->children($namespaces['a']);	

        return $info;
    }

    function getOutpatient($cert){
        //$url ='https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/Claim/?CertNo='.$cert.'&ClaimType=OP';
        $url =$_SERVER['webservice'].'/Members.svc/Claim/?CertNo='.$cert.'&ClaimType=OP';
        
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);
        $data = $xml->GetClaimResult;
        $namespaces = $data->getNameSpaces(true);
        $info = $data->children($namespaces['a']);	

        return $info;
    }
	
    function getMaternity($cert){
        //$url ='https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/Maternity/?Certno='.$cert;
        $url =$_SERVER['webservice'].'/Members.svc/Maternity/?Certno='.$cert;
        
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);
        $data = $xml->GetMaternityResult;
        $namespaces = $data->getNameSpaces(true);
        $info = $data->children($namespaces['a']);	

        return $info;
    }
		
    function getSchedAppointment($cert){
        //$url ='https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/APESchedule/?Certno='.$cert;
        $url =$_SERVER['webservice'].'/Members.svc/APESchedule/?Certno='.$cert;
        
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);
        $data = $xml->GetAPEScheduleResult;
        $namespaces = $data->getNameSpaces(true);
        $info = $data->children($namespaces['a']);	

        return $info;
    }

    function philRegister($reg){
        //$url = 'https://apps.philcare.com.ph/PCareWebServices/Registration.svc/?Certno=9876543&UName=honeynatividad@gmail.com&BDate=&HouseNo=2493&Street=Belarmino&Barangay=Bangkal&City=Makati%20Metro%20Manila&Province=NCR&HomeNo=+639171234567Mobile=+639171234567&Email=honeynatividad@gmail.com&Pwd=123456';                
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Registration.svc/?Certno='.$reg['CertNo'].'&Uname='.$reg['Email'].'&BDate='.$reg['BirthDate'].'&HouseNo='.$reg['HouseNo'].'&Street='.$reg['Street'].'&Barangay='.$reg['Barangay'].'&City='.$reg['City'].'&Province='.$reg['Province'].'&HomeNo='.$reg['HomeNo'].'&Mobile='.$reg['ContactNumber'].'&Email='.$reg['Email'].'&Pwd='.$reg['Password'].'&Source=Teletech';
        $city = $reg['City'];
        $prov = $reg['Province'];
        $city = str_replace('+',' ',$city);
        $prov = str_replace('+',' ',$prov);
        $url = $_SERVER['webservice'].'/Registration.svc/?Certno='.$reg['CertNo'].'&Uname='.$reg['Email'].'&BDate='.$reg['BirthDate'].'&HouseNo='.$reg['HouseNo'].'&Street='.$reg['Street'].'&Barangay='.$reg['Barangay'].'&City='.$city.'&Province='.$prov.'&HomeNo='.$reg['HomeNo'].'&Mobile='.$reg['ContactNumber'].'&Email='.$reg['Email'].'&Pwd='.$reg['Password'].'&Source='.$reg['AgreementNo'];
        
        /*
         * add source parameter and added AgreemetNo
         * $url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Registration.svc/?Certno='.$reg['CertNo'].'&Uname='.$reg['Email'].'&BDate='.$reg['BirthDate'].'&HouseNo='.$reg['HouseNo'].'&Street='.$reg['Street'].'&Barangay='.$reg['Barangay'].'&City='.$reg['City'].'&Province='.$reg['Province'].'&HomeNo='.$reg['HomeNo'].'&Mobile='.$reg['ContactNumber'].'&Email='.$reg['Email'].'&Pwd='.$reg['Password'].'&Source='.$reg['AgreementNo'];
         */
        
        
        //$getxml = file_get_contents($url);
        //print_r($reg);
        //$getxml = file_get_contents($url);
	$xml = simplexml_load_file($url);
        //$xml = simplexml_load_file($url);
        if(!$xml){
            $info = array('MessageReturn'=>'Something happened. Please contact web master');
            return $info;
        }else{
            $data = $xml->RegisterResult;
            $namespaces = $data->getNameSpaces(true);
            $info = $data->children($namespaces['a']);
            return $info;
        }
        
    }
    /*
     * Newly addded function
     * 12/18/2015
     * This should be validation of certificate and birthdate
     */
    
    function getReimbursement($cert){
        
    }
    
    function setReimbursement($cert,$date,$desc,$file){
        //https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/SendReimbursement/?CertNo=5443460&Date=1/12/2015&Description=test&File=
        $url = $_SERVER['webservice'].'/Members.svc/SendReimbursement/?CertNo='.$cert.'&Date='.$date.'&Description='.$desc.'&File='.$file;
        
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);        
        
        $data = $xml->SendReimbursementResult;
        $namespaces = $data->getNameSpaces(true);
        if(property_exists($data->children('a:MessageReturn'), 'MessageReturn')){
            $info = $data->children($namespaces['a']);
            return $info;
        }else{
            return false;
        }
    }
    
    
    function getProvidersOP($city,$cert,$avail){
        $url = $_SERVER['webservicemobile'].'/Providers.svc/FindProviders/?Type='.$avail.'&City='.$city.'&District=&Hospital=&Top=100&CertNo='.$cert;
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);        
        
        $data = $xml->FindProvidersResult;
        $namespaces = $data->getNameSpaces(true);
        if(property_exists($data->children('a:ProviderFinder'), 'ProviderFinder')){
            $info = $data->children($namespaces['a']);
            return $info;
        }else{
            return false;
        }
    }
    
    function getAPEResult($cert,$type){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/APE/?Certno='.$cert;
        $url = $_SERVER['webservice'].'/Members.svc/APE/?Certno='.$cert.'&Type='.$type;
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);        
        
        $data = $xml->GetAPEAvailmentResult;
        $namespaces = $data->getNameSpaces(true);
        if(property_exists($data->children('a:AttendingPhysician'), 'AttendingPhysician')){
            $info = $data->children($namespaces['a']);
            return $info;
        }else{
            return false;
        }
    }
    
    function getListAppointment($cert){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/OnlineScheduleAppointmentList/?PolicyNo=&CertNo=5443460';
        $url = $_SERVER['webservice'].'/Members.svc/OnlineScheduleAppointmentList/?PolicyNo=&CertNo='.$cert;
        //$xml = simplexml_load_file($url);
        //$xml = simplexml_load_file($url);
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);        
        
        $data = $xml->OnlineScheduleAppointmentListResult;
        $namespaces = $data->getNameSpaces(true);
        if(property_exists($data->children('a:APEECURequestSchedule'), 'APEECURequestSchedule')){
            $info = $data->children($namespaces['a']);
            return $info;
        }else{
            return false;
        }
        //        
    }
    
    function getOnlineAppointment($cert,$type,$req_date,$code){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/OnlineScheduleAppointment/?CertNo=5443460&Type=APE&RequestDate=1/2/2016';
        $url = $_SERVER['webservice'].'/Members.svc/OnlineScheduleAppointment/?CertNo='.$cert.'&Type='.$type.'&RequestDate='.$req_date.'&ProviderCode='.$code;
        //print_r($url);
        $xml = @simplexml_load_file($url);
        //$xml = simplexml_load_file($url);
        if(!$xml){
            $info = array('MessageReturn'=>'Something happened. Please contact web master');
            return $info;
        }else{
            $data = $xml->OnlineScheduleAppointmentResult;
            $namespaces = $data->getNameSpaces(true);
            $info = $data->children($namespaces['a']);
            return $info;
        }
    }
    
    function resendVerification($email){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Registration.svc/ResendVerification/?Email='.$email;
        $url = $_SERVER['webservice'].'/Registration.svc/ResendVerification/?Email='.$email;
        
        $xml = simplexml_load_file($url);
        //$xml = simplexml_load_file($url);
        if(!$xml){
            $info = array('MessageReturn'=>'Something happened. Please contact web master');
            return $info;
        }else{
            $data = $xml->ResendVerificationResult;
            $namespaces = $data->getNameSpaces(true);
            $info = $data->children($namespaces['a']);
            return $info;
        }
    }
    
    function forgotPassword($email){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/ForgotPassword/?Email='.$email;
        $url = $_SERVER['webservice'].'/Members.svc/ForgotPassword/?Email='.$email;
        
        $xml = simplexml_load_file($url);
        //$xml = simplexml_load_file($url);
        if(!$xml){
            $info = array('MessageReturn'=>'Something happened. Please contact web master');
            return $info;
        }else{
            $data = $xml->ForgotPasswordResult;
            $namespaces = $data->getNameSpaces(true);
            $info = $data->children($namespaces['a']);
            return $info;
        }
    }
    
    function getUtilSummary($certNo){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/UtilSummary/?CertNo='.$certNo;
        $url = $_SERVER['webservice'].'/Members.svc/UtilSummary/?CertNo='.$certNo;
        
        $xml = simplexml_load_file($url);
        $data = $xml->GetUtilMaxSummaryResult;
        $namespaces = $data->getNameSpaces(true);
        $info = $data->children($namespaces['a']);
        return $info;
    }
    
    function getUtilMainList($certNo){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/UtilMainList/?CertNo='.$certNo;
        $url = $_SERVER['webservice'].'/Members.svc/UtilMainList/?CertNo='.$certNo;
        
        $xml = simplexml_load_file($url);
        $data = $xml->GetUtilMainListResult;
        
        $namespaces = $data->getNameSpaces(true);
        if(property_exists($data->children('a:UtilMainList'), 'UtilMainList')){
            $info = $data->children($namespaces['a']);     
            
            return $info;
        }else{
            $newsXML = new SimpleXMLElement("<news></news>");
            $newsXML->addAttribute('newsPagePrefix', 'value goes here');
            $newsIntro = $newsXML->addChild('content');
            $newsIntro->addAttribute('Provider', '');
            $newsIntro->addAttribute('DateAvailed', '');
            $newsIntro->addAttribute('IllnessNature', '');
            $newsIntro->addAttribute('CaseNo', '');
            $newsIntro->addAttribute('Status', '');            
            $info = array('Description'=>'','EffDate'=>'','InMaxLimit'=>'','OutMaxLimit'=>'','TypeDelivery'=>'','Remarks'=>'');
            return $newsIntro;
        }
        //$info = $data->children($namespaces['a']);
        //return $info;
    }
    
    function verifyUser($cert,$username,$reg,$source){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Registration.svc/Verify/?Certno='.$cert.'&UserName='.$username.'&RegistrationCode='.$reg.'&Source=Teletech';
        $url = $_SERVER['webservice'].'/Registration.svc/Verify/?Certno='.$cert.'&UserName='.$username.'&RegistrationCode='.$reg.'&Source=Test';
        
        $getxml = file_get_contents($url);
	   $xml = simplexml_load_string($getxml);
        if(!$xml){
            $xml = '';
            return $xml;
        }else{
            return $xml;
        }
    }
    
    function validateRegister($cert,$bdate){        
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Registration.svc/ValidateRegistration/?CertNo='.$cert.'&birthdate='.$bdate.'&username=&email=&validatetype=D';
        $url = $_SERVER['webservice'].'/Registration.svc/ValidateRegistration/?CertNo='.$cert.'&birthdate='.$bdate.'&username=&email=&validatetype=D';
        
        //$getxml = file_get_contents($url);
        $xml = simplexml_load_file($url);
        $data = $xml->ValidateRegistrationResult;
        $namespaces = $data->getNameSpaces(true);
        $info = $data->children($namespaces['a']);
        
        return $info;
    }
    
    function ridersDental($reg){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/RiderBenefits/?PolicyNo=&CertNo='.$reg.'&Type=D';
        $url = $_SERVER['webservice'].'/Members.svc/RiderBenefits/?PolicyNo=&CertNo='.$reg.'&Type=D';
        
        //$getxml = file_get_contents($url);
        $xml = simplexml_load_file($url);
        $data = $xml->GetRiderBenefitsResult;
        $namespaces = $data->getNameSpaces(true);
        if(property_exists($data->children('a:Rider'), 'Rider')){
            $info = $data->children($namespaces['a']);     
            
            return $info;
        }else{
            $newsXML = new SimpleXMLElement("<news></news>");
            $newsXML->addAttribute('newsPagePrefix', 'value goes here');
            $newsIntro = $newsXML->addChild('content');
            $newsIntro->addAttribute('Description', '');
            $newsIntro->addAttribute('EffDate', '');
            $newsIntro->addAttribute('InMaxLimit', '');
            $newsIntro->addAttribute('OutMaxLimit', '');
            $newsIntro->addAttribute('TypeDelivery', '');
            $newsIntro->addAttribute('Remarks', '');
            $info = array('Description'=>'','EffDate'=>'','InMaxLimit'=>'','OutMaxLimit'=>'','TypeDelivery'=>'','Remarks'=>'');
            return $newsIntro;
        }
        //$info = $data->children($namespaces['a']);
        
        //return $info;
    }
    
    function ridersMaternity($reg){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/RiderBenefits/?PolicyNo=&CertNo='.$reg.'&Type=M';
        $url = $_SERVER['webservice'].'/Members.svc/RiderBenefits/?PolicyNo=&CertNo='.$reg.'&Type=M';
        
        //$getxml = file_get_contents($url);
        $xml = simplexml_load_file($url);
        $data = $xml->GetRiderBenefitsResult;
        
        $namespaces = $data->getNameSpaces(true);
        
        
        if(property_exists($data->children('a:Rider'), 'Rider')){
            $info = $data->children($namespaces['a']);     
            
            return $info;
        }else{
            $newsXML = new SimpleXMLElement("<news></news>");
            $newsXML->addAttribute('newsPagePrefix', 'value goes here');
            $newsIntro = $newsXML->addChild('content');
            $newsIntro->addAttribute('Description', '');
            $newsIntro->addAttribute('EffDate', '');
            $newsIntro->addAttribute('InMaxLimit', '');
            $newsIntro->addAttribute('OutMaxLimit', '');
            $newsIntro->addAttribute('TypeDelivery', '');
            $newsIntro->addAttribute('Remarks', '');
            $info = array('Description'=>'','EffDate'=>'','InMaxLimit'=>'','OutMaxLimit'=>'','TypeDelivery'=>'','Remarks'=>'');
            return $newsIntro;
        }
    }
    
    function ridersLife($reg){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/RiderBenefits/?PolicyNo=&CertNo='.$reg.'&Type=L';
        $url = $_SERVER['webservice'].'/Members.svc/RiderBenefits/?PolicyNo=&CertNo='.$reg.'&Type=L';
        
        //$getxml = file_get_contents($url);
        $xml = simplexml_load_file($url);
        
        $data = $xml->GetRiderBenefitsResult;
        $namespaces = $data->getNameSpaces(true);
        if(property_exists($data->children('a:Rider'), 'Rider')){
            $info = $data->children($namespaces['a']);     
            
            return $info;
        }else{
            $newsXML = new SimpleXMLElement("<news></news>");
            $newsXML->addAttribute('newsPagePrefix', 'value goes here');
            $newsIntro = $newsXML->addChild('content');
            $newsIntro->addAttribute('Description', '');
            $newsIntro->addAttribute('EffDate', '');
            $newsIntro->addAttribute('InMaxLimit', '');
            $newsIntro->addAttribute('OutMaxLimit', '');
            $newsIntro->addAttribute('TypeDelivery', '');
            $newsIntro->addAttribute('Remarks', '');
            $info = array('Description'=>'','EffDate'=>'','InMaxLimit'=>'','OutMaxLimit'=>'','TypeDelivery'=>'','Remarks'=>'');
            return $newsIntro;
        }
    }
    
    function philUpdate($reg){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/UpdateInfo/?Certno='.$reg['CertNo'].'&HouseNo='.trim($reg['HouseNo']).'&Street='.trim($reg['Street']).'&Barangay='.trim($reg['Barangay']).'&City='.trim($reg['City']).'&Province='.trim($reg['Province']).'&HomeNo='.trim($reg['HomeNo']).'&Mobile='.trim($reg['MobileNo']);
        $url = $_SERVER['webservice'].'/Members.svc/UpdateInfo/?Certno='.$reg['CertNo'].'&HouseNo='.trim($reg['HouseNo']).'&Street='.trim($reg['Street']).'&Barangay='.trim($reg['Barangay']).'&City='.trim($reg['City']).'&Province='.trim($reg['Province']).'&HomeNo='.trim($reg['HomeNo']).'&Mobile='.trim($reg['MobileNo']);
        
        //$getxml = file_get_contents($url);
        $xml = simplexml_load_file($url);
        $data = $xml->UpdateInfoResult;
        $namespaces = $data->getNameSpaces(true);
        $info = $data->children($namespaces['a']);
        return $info;
    }
    
    function checkRegister($certNo,$bdate){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Registration.svc/?Certno='.$certNo.'&BDate='.$bdate;
        //echo $certNo,'->'.$bdate;
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Registration.svc/?Certno=5443460&BDate=02/16/1970';
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/MembersInfo/?Certno=5443460';
        /*$getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);
        $data = $xml->RegisterResult;
        $namespaces = $data->getNameSpaces(true);
        $info = $data->children($namespaces['a']);
        return $info;*/
        return true;
    }

    function changePassWebservice($info){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Login.svc/ChangePassword/?Certno='.$info['certid'].'&oldpwd='.$info['old_pass'].'&newpwd='.$info['new_pass'];
        $url = $_SERVER['webservice'].'/Login.svc/ChangePassword/?Certno='.$info['certid'].'&oldpwd='.$info['old_pass'].'&newpwd='.$info['new_pass'];
        
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);
        $data = $xml->ChangePasswordResult;
        $namespaces = $data->getNameSpaces(true);
        $info = $data->children($namespaces['a']);
        return $info;
    }
	
    function getSearchProviders($loc,$area){
        //$url ='https://apps.philcare.com.ph/PCareWebServicesTest/Providers.svc/Hospitals/?Location='.$loc.'&area='.$area;
        $url =$_SERVER['webservice'].'/Providers.svc/Hospitals/?Location='.$loc.'&area='.$area;
        
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);
        $data = $xml->SearchHospitalsResult;
        $namespaces = $data->getNameSpaces(true);
        $info = $data->children($namespaces['a'])->Hospital;	
        return $data;
    }
    
    function getSpecialization($province, $area){
        $url = $_SERVER['webservice'].'/Providers.svc/DoctorsPecialization/?Province='.$province.'&Area='.$area;
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Providers.svc/SearchDoctors/?CertNo=5443460&Province=Cebu&Area=&DoctorName=&Specialization=';
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);        
        
        $data = $xml->GetDoctorsPecializationResult;
        
        $namespaces = $data->getNameSpaces(true);
        
        if(property_exists($data->children('a:DoctorSpecialization'), 'DoctorSpecialization')){
            $info = $data->children($namespaces['a']);
            
            return $info;
        }else{
            return false;
        }
    }

    function getNewSearchProvidersDoctors($city,$distct,$hospital,$type,$certno){
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Providers.svc/Doctors/?CertNo=&Province=&Area=&LastName=&FirstName=&Specialization=';
        /*
         * if($city==0)
            $city="";
        if($distct==0)
            $distct="";
        print_r("area is ".$city.": district is ".$distct.": doctor is ".$hospital." : specialization is ".$type);
         * 
         */
        $url = $_SERVER['webservice'].'/Providers.svc/SearchDoctors/?CertNo='.$certno.'&Province='.$city.'&Area='.$distct.'&DoctorName='.$hospital.'&Specialization='.$type;
        //$url = 'https://apps.philcare.com.ph/PCareWebServicesTest/Providers.svc/SearchDoctors/?CertNo=5443460&Province=METRO+MANILA&Area=TAGUIG+CITY&DoctorName=&Specialization=INTERNAL+MEDICINE';
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);        
        
        $data = $xml->SearchDoctorsPerMemberResult;
        
        $namespaces = $data->getNameSpaces(true);
        
        if(property_exists($data->children('a:Doctors'), 'Doctors')){
            //$info = $data->children($namespaces['a'])->Doctors;
            
            return $data;
        }else{
            return false;
        }
    }

    function getNewSearchProviders($city,$distct,$hospital,$type,$certno){
        
        //$url = 'https://apps.philcare.com.ph/iPhilCare_Mobile/Providers.svc/FindProviders/?Type=ER&City=0&District=0&Hospital=&Top=100&CertNo=A)3WOL0;
        //print_r("this is my date == > ".$city." :: ".$distct."  :: ".$hospital." :: ".$type." :: ".$certno);
        
        
        $url = $_SERVER['webservicemobile'].'/Providers.svc/FindProviders/?Type='.$type.'&City='.$city.'&District='.$distct.'&Hospital='.$hospital.'&Top=100&CertNo='.$certno;
        //print_r($url);
        //$url = 'https://apps.philcare.com.ph/iPhilCare_Mobile/Providers.svc/FindProviders/?Type=Dialysis&City=&District=&Hospital=&Top=100&CertNo=5443460';
       // try {
            $xml = @simplexml_load_file($url,'SimpleXMLElement', LIBXML_NOWARNING);
            //file_get_contents('www.google.com');
        //}
        //catch (Exception $e) {
        //    echo $e->getMessage();
       // }
            if($xml){
                $data = $xml->FindProvidersResult;
                $namespaces = $data->getNameSpaces(true);
                $info = $data->children($namespaces['a'])->ProviderFinder;

            }else{
                $data = array();
          }
        return $data;

    /*	$getxml = file_get_contents($url);
            $xml = simplexml_load_string($getxml);
            $data = $xml->FindProvidersResult;
            $namespaces = $data->getNameSpaces(true);
            $info = $data->children($namespaces['a'])->ProviderFinder;	

    */	

    }

    function getCities(){
        //$url ='https://apps.philcare.com.ph/iPhilCare_Mobile/Providers.svc/GetProvidersCity/?';
        $url =$_SERVER['webservicemobile'].'/Providers.svc/GetProvidersCity/?';
        
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);
        $data = $xml->GetProvidersCityResult;
        $namespaces = $data->getNameSpaces(true);
        $info = $data->children($namespaces['a'])->ProvidersCity;	


        return $data;
    }

    function getDistrict($city){
        //$url ='https://apps.philcare.com.ph/iPhilCare_Mobile/Providers.svc/GetProvidersDistrict/?City='.$city;
        $url =$_SERVER['webservicemobile'].'/Providers.svc/GetProvidersDistrict/?City='.$city;
        
        $getxml = file_get_contents($url);
        $xml = simplexml_load_string($getxml);
        $data = $xml->GetProvidersDistrictResult;
        $namespaces = $data->getNameSpaces(true);
        $info = $data->children($namespaces['a'])->ProviderDistrict;	

        return $data;
    }

    function getDependents($certid){
        
        //$url ='https://apps.philcare.com.ph/PCareWebServicesTest/Members.svc/GetFamily/?CertNo='.$certid;
        $url = $_SERVER['webservice'].'/Members.svc/GetFamily/?CertNo='.$certid;
        
        //$getxml = file_get_contents($url);
        //$xml = simplexml_load_string($getxml);
        
        $xml = @simplexml_load_file($url);
        //print_r($xml->event->attributes()->source);
        
        if ($xml===false)
            die('Bad XML!');
        else
            $data = $xml->GetFamilyResult;
        
        
        //print_r($data);
        //$namespaces = $data->getNameSpaces(true);
        //$info = $data->children($namespaces['a'])->FamilyMember;
        return $data;

    }

    function get_fcontent( $url,  $javascript_loop = 0, $timeout = 5 ) {
        $url = str_replace( "&amp;", "&", urldecode(trim($url)) );

        $cookie = tempnam ("/tmp", "CURLCOOKIE");
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt( $ch, CURLOPT_ENCODING, "" );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
        curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
        curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
        $content = curl_exec( $ch );
        $response = curl_getinfo( $ch );
        curl_close ( $ch );

        if ($response['http_code'] == 301 || $response['http_code'] == 302) {
            ini_set("user_agent", "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");

            if ( $headers = get_headers($response['url']) ) {
                foreach( $headers as $value ) {
                    if ( substr( strtolower($value), 0, 9 ) == "location:" )
                        return get_url( trim( substr( $value, 9, strlen($value) ) ) );
                }
            }
        }

        if (    ( preg_match("/>[[:space:]]+window\.location\.replace\('(.*)'\)/i", $content, $value) || preg_match("/>[[:space:]]+window\.location\=\"(.*)\"/i", $content, $value) ) && $javascript_loop < 5) {
            return get_url( $value[1], $javascript_loop+1 );
        } else {
            return array( $content, $response );
        }
    }

    function mail_register($info){ 

        /*
        $signature = "
        <table>
        <tbody>
        <tr>
                <td><img src='http://www.philcare.com.ph/wp-content/uploads/2014/07/PhilCare-Logo.png' width='184px'></td>
        </tr>
        <tr>
        <td>
        Warning: This email and any attachment are confidential and are intended solely for the use of the individual to whom they have been addressed.  If you are not the intended recipient of this email, you must neither take any action based upon its content, nor copy nor show it to anyone. Please contact Company at (+632) 802-7333 if you believe you have received this email in error.  Any view or opinion expressed is solely that of the author and does not necessarily represent that of Company.
        </td>
        </tr>
        </tbody>
        </table>";


        $message = "
        <html>
        <head>
        <title></title>
        </head>
        <body>
        <h4>Dear ".$info['name']."</h4>
        <p>This is to confirm that we have received your sign up request you sent through <a href='http://www.philcare.com.ph'>www.philcare.com.ph</a></p>
        <div>Below is you login information:</div>
        <table>
        <tr>
        <td>UserName: </td>
        <td>".$info['username']."</td>
        </tr>
        <tr>
        <td>Password: </td>
        <td>".$info['password']."</td>
        </tr>
        <tr><td><br></td></tr>
        <tr><td>Please click <a href='".$this->baseurl."verify?hash=".$info['hash']."'>this verification link</a> for email validation.</td></tr>
        </table>
        $signature
        </body>
        </html>
        ";	
        */


        $signature = "
        <table>
        <tbody>
        <tr>
        <td>
        &copy; PhilhealthCare, Inc.m 4th and 5th floor, STI Holdings Center, 6764 Ayala Avenue, Makati City, Philippines
        </td>
        </tr>
        </tbody>
        </table>";


        $message = "
        <html>
        <head>
        <title></title>
        </head>
        <body>
        <h4>Dear ".$info['name']."</h4>
        <p>Welcome to myPhilCare portal!</p>
        <div>To get started, you need to verify your email address.</div>
        <table>
        <tr><td><br></td></tr>
        <tr><td><h2><a href='".$this->baseurl."verify?hash=".$info['hash']."'>VERIFY EMAIL</a> </h2></td></tr>

        <tr>
        <td><p>Sincerely,</p></td>
        </tr>
        <tr>
        <td>PhilCare</td>
        </tr>
        </table>
        $signature
        </body>
        </html>
        ";	

        return $message; 
    }

    function mail_register_confirmation($info){ 
        $signature = "
        <table>
        <tbody>
        <tr>
        <td>
        © PhilhealthCare, Inc.m 4th and 5th floor, STI Holdings Center, 6764 Ayala Avenue, Makati City, Philippines
        </td>
        </tr>
        </tbody>
        </table>";

        $message = "
        <html>
        <head>
        <title></title>
        </head>
        <body>
        <h4>Dear ".$info['name'].",</h4>
        <p>Welcome to myPhilCare Portal! This is your online access to your member benefits, a self-help customer support deck, search for an affiliated provider, wellness partners, and health tips and programs to manage your own health.</p><br>
        <p>Keep this email in a safe place for future reference, as it includes important information. </p>
        <p>Here's all you need to get started:</p>
        <span style='font-size:14pt;color:rgb(51,51,51);background:none repeat scroll 0% 0% white'>Log In</span>
        <br>
        <p>Your username is: ".$info['email']."</p>
        <p>Forgot your password? <a href='".$this->baseurl."forgot"."'>Find it here</a>  this is a password reset</p><br>
<div dir='ltr'><div class='adM'>

</div><p style='margin-bottom:0.0001pt;line-height:normal' class='MsoNormal'><b><span  style='font-size:14pt;color:rgb(51,51,51);background:none repeat scroll 0% 0% white'>Member Benefits</span></b><span  style='font-size:10pt;color:rgb(51,51,51);background:none repeat scroll 0% 0% white'></span></p>

<p style='margin-bottom:0.0001pt;line-height:normal' class='MsoNormal'><span  style='font-size:10pt'>&nbsp;</span></p>

<p style='margin:0in 0in 0.0001pt 0.5in;line-height:normal' class='MsoNormal'><span  style='font-size:10pt'><span style='font:7pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><b><span  style='font-size:10pt'>My Account</span></b><span  style='font-size:10pt'> &ndash; details out your personal information, medical
information, availment record and benefits</span></p>

<p style='margin:0in 0in 0.0001pt 0.5in;line-height:normal' class='MsoNormal'><span  style='font-size:10pt'><span style='font:7pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><b><span  style='font-size:10pt'>Messages</span></b><span  style='font-size:10pt'> &ndash; important information sent by PhilCare</span></p>

<p style='margin:0in 0in 0.0001pt 0.5in;line-height:normal' class='MsoNormal'><span  style='font-size:10pt'>
<span style='font:7pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><b><span  style='font-size:10pt'>Providers</span></b><span  style='font-size:10pt'> &ndash; search for an affiliated clinic or hospital
and save your favorite providers in your account</span></p>

<p style='margin:0in 0in 0.0001pt 0.5in;line-height:normal' class='MsoNormal'><span  style='font-size:10pt'><span style='font:7pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><b><span  style='font-size:10pt'>Calender </span></b><span  style='font-size:10pt'>&ndash; check your scheduled APE, PhilCare clinic
schedules and announcements, and PhilCare-recommended health and wellness
events in the metro</span></p>

<p style='margin:0in 0in 0.0001pt 0.5in;line-height:normal' class='MsoNormal'><span  style='font-size:10pt'><span style='font:7pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><b><span  style='font-size:10pt'>Wellness Buddies</span></b><span  style='font-size:10pt'> &ndash; merchant partners offering perks and
discounts</span></p>

<p style='margin-bottom:0.0001pt;line-height:normal' class='MsoNormal'><span  style='font-size:10pt'>&nbsp;</span></p>

<p style='margin-bottom:0.0001pt;line-height:normal' class='MsoNormal'><span  style='font-size:10pt'><span>&nbsp;</span></span><b><span  style='font-size:14pt;color:rgb(51,51,51);background:none repeat scroll 0% 0% white'>Self-help
customer support</span></b><span  style='font-size:10pt;color:rgb(34,34,34)'>
</span><span  style='font-size:10pt;color:rgb(51,51,51);background:none repeat scroll 0% 0% white'></span></p>

<p style='margin:0in 0in 0.0001pt 0.5in;line-height:normal' class='MsoNormal'><span  style='font-size:10pt'><span style='font:7pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><b><span  style='font-size:10pt'>Forms</span></b><span  style='font-size:10pt'> &ndash; forms needed for reimbursement, membership
update etc.</span></p>

<p style='margin:0in 0in 0.0001pt 0.5in;line-height:normal' class='MsoNormal'><span  style='font-size:10pt'><span style='font:7pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><b><span  style='font-size:10pt'>Feedback form</span></b><span  style='font-size:10pt'> &ndash; send inquiries and feedback directly to
PhilCare</span></p>

<p style='margin:0in 0in 0.0001pt 0.5in;line-height:normal' class='MsoNormal'><span  style='font-size:10pt'><span style='font:7pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><b><span  style='font-size:10pt'>Member guide</span></b><span  style='font-size:10pt'> &ndash; reminders and procedures on how to avail for
PhilCare services</span></p><div class='yj6qo'></div><div class='adL'>

</div></div>
        <br>

        <div>Sincerely,<br>PhilCare</div><br>
        $signature
        </body>
        </html>
        ";	


        return $message; 
    }

    function forgot_mailer($info){ 
        $signature = "
        <table>
        <tbody>
        <tr>
        <td>
        &copy; PhilhealthCare, Inc.m 4th and 5th floor, STI Holdings Center, 6764 Ayala Avenue, Makati City, Philippines
        </td>
        </tr>
        </tbody>
        </table>";

        $message = "
        <html>
        <head>
        <title></title>
        </head>
        <body>
        <h4>Dear ".$info['name']."</h4><br>
        <p>You have requested for a password reset for your MyPhilCare account. Please refer to your new password below:</p><br>
        <p>Username : ".$info['username']."</p>
        <p>Password : ".$info['password']."</p><br>
        <p>Upon logging in, kindly change this system-generated password into a password that is easy for you to remember.</p><br>
        <br>
        <p>To change your password, please go to MY ACCOUNT > MY PROFILE > EDIT.</p>
        <br>
        <div>Sincerely,<br>PhilCare</div><br>
        $signature
        </body>
        </html>
        ";	

        return $message; 
    }	

    function account_unlocker($info){ 
        $signature = "
        <table>
        <tbody>
        <tr>
        <td>
        &copy; PhilhealthCare, Inc.m 4th and 5th floor, STI Holdings Center, 6764 Ayala Avenue, Makati City, Philippines
        </td>
        </tr>
        </tbody>
        </table>";

        $message = "
        <html>
        <head>
        <title></title>
        </head>
        <body>
        <h4>Dear ".$info['fname']."</h4><br>
        <p>You received this notification because you forgot your password details and requested for a password reset for your myPhilCare account. If you did not appeal for a password reset, please contact our support team immediately by sending us an email at customercare@philcare.com.ph</p><br>
        <p>Please refer to your new password below:</p><br>
        <p>Username : ".$info['username']."</p>
        <p>Password : ".$info['password']."</p><br>
        <p>unlock your account by clicking this link: <a href='".$this->baseurl."verify?unlock=".$info['hash']."'>Unlock</a></p><br>


        <p>Upon logging in, kindly change this system-generated password into a password that is easy for you to remember.</p><br>
        <br>
        <p>To change your password, please go to MY ACCOUNT > MY PROFILE > EDIT.</p>
        <br><br>
        <div>Sincerely,<br>PhilCare</div><br>
        $signature
        </body>
        </html>
        ";	

        return $message; 
    }

    function internal_email($info){ 
        $signature = "
        <table>
        <tbody>
        <tr>
        <td>
        &copy; PhilhealthCare, Inc.m 4th and 5th floor, STI Holdings Center, 6764 Ayala Avenue, Makati City, Philippines
        </td>
        </tr>
        </tbody>
        </table>";

        $message = "
        <html>
        <head>
        <title></title>
        </head>
        <body>
        <p>We have received a message regarding ".$info['subject']." through the MyPhilCare member portal from</p>
        <p>MEMBER'S NAME: ".$info['name']."</p><br>
        <p>COMPANY: ".$info['company']."</p><br>
        <p>CONTACT NUMBER: ".$info['contact']."</p><br>
        <p>EMAIL ADDRESS: ".$info['email']."</p><br>
        <br>
        <p>Please see details of member's concern below:</p>
        <br>
        <br>
        <p>[ ".date('M d, Y H:i:s')." ]</p><br>
        <p>[ ".$info['message']." ]</p><br><br>
        <p>(This email is auto-generated. Please do not reply.)</p>
        <div></div><br>
        $signature
        </body>
        </html>
        ";	
        return $message; 
    }

    function auto_email($info){ 
        $signature = "
        <table>
        <tbody>
        <tr>
        <td>
        &copy; PhilhealthCare, Inc.m 4th and 5th floor, STI Holdings Center, 6764 Ayala Avenue, Makati City, Philippines
        </td>
        </tr>
        </tbody>
        </table>";

        $message = "
        <html>
        <head>
        <title></title>
        </head>
        <body>
        <br><br>
        <h4>Dear ".$info['name'].",</h4>
        <p>We have received your message regarding [auto-insert depending on subject]. Rest assured that we will look into this and get back to you through email or the contact number you have provided as soon as possible. Thank you for the time you have spent to send us this letter.</p>

        <div>Sincerely,<br>PhilCare</div><br>
        <br>
        <p>Please see details below of your concern:</p>
        <br>

        <p>[ ".date('M d, Y H:i:s')." ]</p><br>
        <p>[ ".$info['message']." ]</p><br><br>
        <p>(This email is auto-generated. Please do not reply.)</p>

        $signature
        </body>
        </html>
        ";	
        return $message; 
    }
}
?>