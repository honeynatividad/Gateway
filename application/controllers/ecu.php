<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ecu extends CI_Controller {
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
        $this->agreement = $session_data['agreement_no'];
    }
    function maintemp($temp,$data){
        $this->load->view('header',$data);
        $this->load->view($temp,$data);
        $this->load->view('footer');
    }
    
    function index(){        
        if(isset($_REQUEST['submitevent'])){
            $data = array(
            "type" => $_POST['type'],
            "req_date"=>$_POST['ev_date'],            
            "date_created"=>date('m/d/Y',strtotime($_POST['ev_date'])),
            "code"  => $_POST['district']
            );
            
            //call webservice for online sched appointment
            $session_data = $this->session->userdata('logged_in');
            $cert = $session_data['certid'];
            
            $req = $this->wslibrary->getOnlineAppointment($cert,$_POST['type'],date('m/d/Y',strtotime($_POST['ev_date'])),$_POST['district']);
            $insert = array(
                'cert_no'               => $cert,
                'type_of_appointment'   => $_POST['type'],
                'preferred_schedule'    => $_POST['ev_date'],
                'provider'              => $_POST['district'],                
            );
            
            //print_r($insert);
            $add = $this->model_portal_admin->addECU($insert);
            $this->session->set_userdata('msg_return', (string)$req->MessageReturn);
            $this->session->set_flashdata('msg', (string)$req->MessageReturn);
                       
            //redirect("ecu/calendar");
            $this->load->library('archive');
            $this->archive->addAudit($cert,'ecu','submit schedule','0',$this->agreement);
            $this->load->helper('test');
            $events = $this->wslibrary->getListAppointment($this->certid);
            if($events){                
                $data['events'] = $this->wslibrary->getListAppointment($this->certid);
                $this->maintemp('ecu_calendar',$data);
            }else{
                $data['events'] = array();
                $this->maintemp('ecu_calendar',$data);
            }            
        }
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');    
            if($session_data['APEECU']=="APE" || $session_data['APEECU']=="ECU" || $session_data['APEECU']=="APE/ECU"){
                //$data['providers'] = $this->wslibrary->getProvidersOP($this->certid);
                $data['provinces'] = $this->wslibrary->getCities();
                //print_r($this->wslibrary->getProvidersOP($cert));
                
                //setting the ECU and APE
                //because webservice is not ready yet
                $classification =$session_data['MemberClassification'];
                $member_type = $session_data['MemberType'];
                                
                 /*
                  * 
                SR MANAGERS W/ MAT

                SR MANAGERS W/O MAT
                DIRECTORS W/ MAT
                DIRECTORS W/O MAT

                        */
                /*$ecu = 0;                  
                if($classifcation=="DEPS OF DIRECTORS & SR MANAGERS W/ MAT"){
                    
                }else if($classification == "DEPS OF DIRECTORS & SR MANAGERS W/O MAT"){
                    
                }else {
                    
                }*/
                $apeecu="";
                if($member_type=="PRINCIPAL"){
                    if($classification=="SR MANAGERS W/ MAT"){
                        $apeecu = "ECU";
                    }elseif($classification=="SR MANAGERS W/O MAT"){
                        $apeecu = "ECU";
                    }elseif($classification=="DIRECTORS W/ MAT"){
                        $apeecu = "ECU";
                    }elseif($classification=="DIRECTORS W/O MAT"){
                        $apeecu = "ECU";
                    }elseif($classification == "TENURED SR MANAGERS W/ MAT"){
                        $apeecu = "ECU";                        
                    }elseif($classification == "TENURED SR MANAGERS W/O MAT"){
                        $apeecu = "ECU"; 
                    }elseif($classification == "TENURED DIRECTORS W/ MAT"){
                        $apeecu = "ECU"; 
                    }elseif($classification == "TENURED DIRECTORS W/O MAT"){

                    }else{
                        $apeecu = "";
                    }

                    if($session_data['certid']=="7346920"){
                        //$classification = "TENURED SR MANAGERS W/ MAT";
                        $apeecu = "ECU";
                    }

                }elseif($member_type=="DEPENDENT"){
                   //10917
                    if($session_data['agreement_no']=="10917"){
                        if($classification=="DEPS OF DIRECTORS & SR MANAGERS W/MAT"){
                            $apeecu = "APE";
                        }elseif($classification=="DEPS OF DIRECTORS & SR MANAGERS W/O MAT"){
                            $apeecu = "APE";
                        }elseif($classification=="DEPS OF MANAGERS W/MAT"){                        
                            $apeecu = "APE";
                        }elseif($classification=="DEPS OF MANAGERS W/O MAT"){
                            $apeecu = "APE";
                        }
                    //if($classification=="DEPS OF DIRECTORS & SR MANAGERS W/MAT"){
                    //    $apeecu = "ECU";
                    //}elseif($classification=="DEPS OF DIRECTORS & SR MANAGERS W/O MAT"){
                    //    $apeecu = "ECU";
                    //}elseif($classification=="DEPS OF MANAGERS W/MAT"){
                    
                    }else{
                        $apeecu = "";
                    }

                }

                if($session_data['certid']==5443460){
                    $apeecu = "ECU";
                }
                $data['classfication'] = $classification;
                $data['member_type'] = $member_type;
                $data['apeecu'] = $apeecu;
                $data['agreement'] = $session_data['agreement_no'];
                $this->maintemp('ecu',$data);
            }else{
                
                $this->session->set_flashdata('error_access', 'Please verify the Onsite APE schedule at the onsite clinic.');
                redirect('home','refresh');
            }            
            
        }else{
            redirect('ecu/','refresh');
        }
        
    }
    
    
    function getallDistrict(){
        if(isset($_POST['city'])){
            
        $distct = $this->wslibrary->getProvidersOP($_POST['city'],$this->certid,trim($_POST['availment']));
        //print_r(trim($_POST['availment']));
        if($distct){
                $random = rand(1, 115);
        ?>
            <div class="metro">
                <select class="form-control" data-settings='{"cutOff":10}' id="dsctval<?php echo $random;?>" name="district">
                    
                <?php
                                                
                    foreach($distct as $prov){
                                                                
                                                ?>
                    <option value="<?php echo urlencode($prov->ProviderCode);?>"><?php echo $prov->ProviderName;?></option>
                    <?php }?>
                </select>
             </div>  		
             <script>
                                 $(document).ready(function(){
                                                var $selects = $('#dsctval<?php echo $random;?>');
                                                $selects.easyDropDown({
                                                cutOff: 10
                                                });	 
                                 });
                                 </script>
        <?php	}else{
                                echo "error";
                        }
        }
    }
    
    function getAllProvider(){
        if(isset($_POST['provider'])){
        $distct = $this->wslibrary->getProvidersOP($city,$this->certid);
        if($distct){
                $random = rand(1, 115);
        ?>
            <div class="metro">
                <select class="provider ndropdown" data-settings='{"cutOff":10}' id="provider<?php echo $random;?>" name="prov">
                <option value="0" class="label">Provider</option>
                <?php
                                               
                                                                foreach($distct as $prov){
                                                                
                                                ?>
                                                <option value="<?php echo urlencode($prov->ProviderCode);?>"><?php echo $prov->ProviderName;?></option>
                    <?php }?>
                </select>
             </div>  		
             <script>
                                 $(document).ready(function(){
                                                var $selects = $('#provider<?php echo $random;?>');
                                                $selects.easyDropDown({
                                                cutOff: 10
                                                });	 
                                 });
                                 </script>
        <?php	}else{
                                echo "error";
                        }
        }
    }
    
    function list_appointment(){
        $this->maintemp('calendar',array());
    }
    
    function add(){
        
    }
    
    function test(){
        $this->maintemp('calendar',array());
    }
    
    function result(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            
            $data['ape'] = $this->wslibrary->getAPEResult($this->certid,'APE');
            $data['ecu'] = $this->wslibrary->getAPEResult($this->certid,'ECU');
            $data['pe'] = $this->wslibrary->getAPEResult($this->certid,'PE');
            $data['medinfo'] = $this->wslibrary->getMedInfo($this->certid);
            $this->load->library('archive');
            $this->archive->addAudit($this->certid,'ecu','view result','0',$this->agreement);
            $this->maintemp('ecu_result',$data);
            
        }else{
            redirect('ecu/','refresh');
        }
        
    }
    
    function ecu_list(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            if($session_data['level']==1){
                $data['ecus'] = $this->model_portal_admin->getECU();
                $this->maintemp('cms/ecu_list',$data);
            }else{
                $this->session->set_flashdata('ecu_error', "Sorry, you are not allowed to aaccess certain pages.");
                redirect('ecu/','refresh');
            }
        }else{
            redirect('ecu/','refresh');
        }
        $this->load->library('archive');
        $this->archive->addAudit($this->certid,'ecu','list of schedule','0',$this->agreement);
        
    }
    
    function calendar(){
       
                /* date settings */
        $this->load->helper('test');
        $events = $this->wslibrary->getListAppointment($this->certid);
        if($events){
            $data['events'] = $this->wslibrary->getListAppointment($this->certid);
            $this->maintemp('ecu_calendar',$data);
        }else{
            $data['events'] = array();
            $this->maintemp('ecu_calendar',$data);
        }
        
    }
    
    function draw_calendar($month,$year,$events = array()){

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day"><div style="position:relative;height:100px;">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';
			
			$event_day = $year.'-'.$month.'-'.$list_day;
                        if($list_day<10){
                            $list_day='0'.$list_day;
                        }
                        $event_day ='0'.$month.'/'.$list_day.'/'.$year;
                        //echo $event_day;
                        foreach($events as $event){
                         
                            if(trim((string)$event->Requestdate) == trim((string)$event_day)){
                                
                                $calendar.= '<div class="event_green">'.$event->RequestStatus.'</div>';
                            }else {
				$calendar.= str_repeat('<p>&nbsp;</p>',2);
                            }
                            
                        }
                        
		$calendar.= '</div></td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';
	

	/* end the table */
	$calendar.= '</table>';

	/** DEBUG **/
	$calendar = str_replace('</td>','</td>'."\n",$calendar);
	$calendar = str_replace('</tr>','</tr>'."\n",$calendar);
	
	/* all done, return result */
	return $calendar;
}

    function random_number() {
	srand(time());
	return (rand() % 7);
    }
    
}