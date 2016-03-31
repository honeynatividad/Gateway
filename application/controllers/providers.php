<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Providers extends CI_Controller {
	private $user;
	private $certid;
        private $agreement;
	function __construct(){
		parent::__construct();	
		$this->load->model("model_portal_users");
		$this->load->model("model_portal_admin","admin");
		 $session_data = $this->session->userdata('logged_in');
		 $this->user=$session_data['user_id'];
		 $this->certid=$session_data['certid'];
		 if(!$session_data){
			 redirect("login");
		 }
                 if($session_data['hra']==1){
                    redirect("hra");
                }
		 $data['username'] = $session_data['username'];	
                 $data['userid'] = $session_data['user_id'];
                 //print_r($session_data['user_id']);
		//page renew
		$renew = array("page_id"=>5);
		$this->session->set_userdata('pages',$renew);	
                $this->agreeement = $session_data['agreement_no'];
		
	}
	function maintemp($temp,$data){
		$this->load->view('header',$data);
		$this->load->view($temp,$data);
		$this->load->view('footer');
	}
	
	function index(){
		$data['plist'] = $this->admin->getAllFavByUser($this->user);
		$this->maintemp('providers_fav',$data);
	}
	
	function findp(){
		$data['provinces'] = $this->wslibrary->getCities();
                $data['userid'] = $this->user;
		$this->maintemp('providers',$data);
                $this->load->model("model_portal_admin");
                $this->load->library('archive');
                $this->archive->addAudit($this->certid,'providers','find a providers','0',$this->agreement);
	}
	
        function test(){
            print_r($this->user);
            $providers = $this->wslibrary->getNewSearchProviders("test","test","test","test",$this->user);
            //$providers = $this->wslibrary->getCities();
            $url ='https://apps.philcare.com.ph/iPhilCare_Mobile/Providers.svc/FindProviders/?Type=Dialysis&City=&District=&Hospital=&Top=100&CertNo=A033IZ0';
            $getxml = file_get_contents($url);
            $xml = simplexml_load_string($getxml);
            $ns = $xml->getNamespaces(true);

            $xml = new SimpleXMLElement($getxml);
            $xml->registerXPathNamespace('a', 'http://schemas.datacontract.org/2004/07/wcfGoMobileServices');
            $show = 0;
            foreach($xml->xpath('//a:ProviderFinder') as $event) {
                $event->registerXPathNamespace('a', 'http://schemas.datacontract.org/2004/07/wcfGoMobileServices');

                $billingAddress = $event->xpath('//a:BillingAddress');
                $city = $event->xpath('//a:city');
               $providerCode = $event->xpath('//a:ProviderCode');


            }
            if(!empty($providerCode)){
                for($i = 0; $i<=count($providerCode);$i++){
                    echo '<pre>';
                    echo $providerCode[$i];
                    echo '</pre>';
                }
            }
                                
            $this->load->view('test');
        }
	function getprovider(){
            if(isset($_REQUEST['loc_name'])){
            /*$providers = $this->wslibrary->getSearchProviders($_POST['loc_name'],$_POST['area_name']);*/

            $providers = $this->wslibrary->getNewSearchProviders($_POST['area_name'],$_POST['district'],$_POST['loc_name'],$_POST['dtype'],$_POST['certno']);
            $disclaimer = "";
                foreach($providers as $p){
                    $namespaces = $providers->getNameSpaces(true);
                    $info = $p->children($namespaces['a']);
                    foreach($info as $if){
                        $details = $if->children($namespaces['a']); 

                        if(!empty($details->ProviderCode)){
                            $disclaimer = $details->Disclamer;
                        }
                    }
                }
	?>
        
            <div class="row">  
                <div class="alert alert-danger" role="alert">
                <p >Disclaimer: <?php echo $disclaimer ?></p>
                </div>
            </div>
        <?php
       
		foreach($providers as $p){
			$namespaces = $providers->getNameSpaces(true);
			$info = $p->children($namespaces['a']);
			foreach($info as $if){
				$details = $if->children($namespaces['a']); 

				if(!empty($details->ProviderCode)){
				?>

              <div class="row">  
              <div class="col-md-12 mfinder" id="main<?php echo $details->ProviderCode;?>">
                  <div class="col-md-8 getmap" id="<?php echo $details->ProviderCode;?>">
                    <h4 class="media-heading"><?php echo $details->ProviderName;?></h4>
                    <div>Coordinator: <?php echo $details->Coordinator;?></div>
                    <div>Address: <?php echo $details->BillingAddress;?></div>
                    <div>Contact No: <?php echo $details->Telephone;?></div>
                    <?php $disclaimer = $details->Disclamer ?>
                  </div>
                  <?php
				  $check = $this->admin->checkFavByUser($this->user,$details->ProviderCode);
				  ?>
                  <div class="col-xs-12 col-md-4">
                  <?php if($check){?>
                  <a href="#" class="pull-right delfromfav" id="btbutton<?php echo $details->ProviderCode;?>" val-id="<?php echo $details->ProviderCode;?>">
                    <label class="btn btn-remove-fav">REMOVE TO MY FAVORITES <i class="glyphicon glyphicon-trash"></i></label>
                  </a>
                  <?php }else{?>
                   <a href="#" class="pull-right addtofav" id="btbutton<?php echo $details->ProviderCode;?>" val-id="<?php echo $details->ProviderCode;?>">
                    <label class="btn btn-fav">ADD TO MY FAVORITES <i class="glyphicon glyphicon-star"></i></label>
                  </a>                 
                  <?php }?>
                  <?php $code=$details->ProviderCode;?>
                  <input type="hidden" id="Address<?php echo $code;?>" value="<?php echo $details->BillingAddress;?>">
                  <input type="hidden" id="Coordinator<?php echo $code;?>" value="<?php echo $details->Coordinator;?>">
                  <input type="hidden" id="Latitude<?php echo $code;?>" value="<?php echo $details->Latitude;?>">
                  <input type="hidden" id="Longitude<?php echo $code;?>" value="<?php echo $details->Longitude;?>">
                  <input type="hidden" id="ProviderCode<?php echo $code;?>" value="<?php echo $details->ProviderCode;?>">
                  <input type="hidden" id="ProviderName<?php echo $code;?>" value="<?php echo $details->ProviderName;?>">
                  <input type="hidden" id="Region<?php echo $code;?>" value="<?php echo $details->District;?>">
                  <input type="hidden" id="Telephone<?php echo $code;?>" value="<?php echo $details->Telephone;?>">              
                  
                  </div>
                </div>           
                </div>				
				<?php
				}else{?>
				<div class=""> 	
					<div class="col--md-12">	
              			<p style="color:#ff0000;">No results found. Please contact our 24/7 Customer Service Hotline at (02) 462-1800 or our toll free number 1 800 1888 3230 from outside Metro Manila (Smart or PLDT users) for concerns on searching for a provider or for clarifications on your benefit package</p> 
               		</div>
                </div>
				<?php }
				}
			}
		?>
                
                <?php
		$this->load->model("model_portal_admin");
                $this->load->library('archive');
                $this->archive->addAudit($this->certid,'providers','search result','0',$this->agreement);
		  }
	}


        function getprovider_doctor(){
            if(isset($_REQUEST['doctor_name'])){
            /*$providers = $this->wslibrary->getSearchProviders($_POST['loc_name'],$_POST['area_name']);*/
            //print_r("area is ".$_POST['area_name'].": district is ".$_POST['district'].": doctor is ".$_POST['doctor_name']." : specialization is ".$_POST['specialization']);        
            $providers = $this->wslibrary->getNewSearchProvidersDoctors($_POST['area_name'],$_POST['district'],$_POST['doctor_name'],$_POST['specialization'],$_POST['certno']);
            $disclaimer = "";
            if(!$providers){
                ?>
<div class=""> 	
					<div class="col--md-12">	
              			<p style="color:#ff0000;">No results found. Please contact our 24/7 Customer Service Hotline at (02) 462-1800 or our toll free number 1 800 1888 3230 from outside Metro Manila (Smart or PLDT users) for concerns on searching for a provider or for clarifications on your benefit package</p> 
               		</div>
                </div>
<?php
            }else{
		foreach($providers as $p){
			$namespaces = $providers->getNameSpaces(true);
			$info = $p->children($namespaces['a']);
			foreach($info as $if){
				$details = $if->children($namespaces['a']); 

				if(!empty($details->ProviderCode)){
				?>

              <div class="row">  
              <div class="col-md-12 mfinder" id="main<?php echo $details->ProviderCode;?>">
                  <div class="col-md-8 getmap" id="<?php echo $details->ProviderCode;?>">
                    <h4 class="media-heading"><?php echo $details->ProviderName;?></h4>
                    <div>Doctor's Name: <?php echo $details->DoctorName;?></div>
                    <div>Specialization: <?php echo $details->Specialization ?></div>
                    <div>Address: <?php echo $details->BillingAddress;?></div>
                    <div>Contact No: <?php echo $details->Telephone;?></div>
                    <div>Mobile No: <?php echo $details->Mobile ?></div>
                    <div>Email Add: <?php echo $details->Email ?></div>
                    <div>Schedule:<?php echo $details->Schedule ?></div>
                    <?php $disclaimer = $details->Disclamer ?>
                  </div>
                  <?php
				  $check = $this->admin->checkFavByUser($this->user,$details->ProviderCode);
				  ?>
                  <div class="col-xs-12 col-md-4">
                  <?php if($check){?>
                  <a href="#" class="pull-right delfromfav" id="btbutton<?php echo $details->ProviderCode;?>" val-id="<?php echo $details->ProviderCode;?>">
                    <label class="btn btn-remove-fav">REMOVE TO MY FAVORITES <i class="glyphicon glyphicon-trash"></i></label>
                  </a>
                  <?php }else{?>
                   <a href="#" class="pull-right addtofav" id="btbutton<?php echo $details->ProviderCode;?>" val-id="<?php echo $details->ProviderCode;?>">
                    <label class="btn btn-fav">ADD TO MY FAVORITES <i class="glyphicon glyphicon-star"></i></label>
                  </a>                 
                  <?php }?>
                  <?php $code=$details->ProviderCode;?>
                  <input type="hidden" id="Address<?php echo $code;?>" value="<?php echo $details->BillingAddress;?>">
                  <input type="hidden" id="Coordinator<?php echo $code;?>" value="<?php echo $details->Coordinator;?>">
                  <input type="hidden" id="Latitude<?php echo $code;?>" value="<?php echo $details->Latitude;?>">
                  <input type="hidden" id="Longitude<?php echo $code;?>" value="<?php echo $details->Longitude;?>">
                  <input type="hidden" id="ProviderCode<?php echo $code;?>" value="<?php echo $details->ProviderCode;?>">
                  <input type="hidden" id="ProviderName<?php echo $code;?>" value="<?php echo $details->ProviderName;?>">
                  <input type="hidden" id="Region<?php echo $code;?>" value="<?php echo $details->District;?>">
                  <input type="hidden" id="Telephone<?php echo $code;?>" value="<?php echo $details->Telephone;?>">              
                  
                  </div>
                </div>           
                </div>				
				<?php
				}else{?>
				<div class=""> 	
					<div class="col--md-12">	
              			<p style="color:#ff0000;">No results found. Please contact our 24/7 Customer Service Hotline at (02) 462-1800 or our toll free number 1 800 1888 3230 from outside Metro Manila (Smart or PLDT users) for concerns on searching for a provider or for clarifications on your benefit package</p> 
               		</div>
                </div>
				<?php }
				}
			}
            }
		?>
                
                <?php
		$this->load->model("model_portal_admin");
                $this->load->library('archive');
                $this->archive->addAudit($this->certid,'providers','search result','0',$this->agreement);
		  }
	}

	function getMap(){
		if(isset($_REQUEST['longs'])){
			$data['lat']=$_REQUEST['lats'];
			$data['long']=$_REQUEST['longs'];	
			$this->load->view("gmap",$data);
		}
		
	}
	
	function savefav(){
		if(isset($_REQUEST['latitude'])){
			$_REQUEST['user_id']=$this->user;
			$this->admin->insertPFav($_REQUEST);
			
		}
	}

	function delpfav(){
		if(isset($_REQUEST['code'])){
			$this->admin->deletepfav($_REQUEST['code']);
			
		}		
	}

	function getallDistrict(){
		if(isset($_POST['city'])){
                    
		$distct = $this->wslibrary->getDistrict($_POST['city']);
		if($distct){
			$random = rand(1, 115);
		?>

                    <div class="metro">
                        <select class="districtvalue form-control" id="districtvalue" name="district">
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
                     </div>  		
                    
		<?php	}else{
                        echo "error";
                        }
		}
	}
	
        
        function getallDistrictDoctors(){
            if(isset($_POST['city'])){
              
            $distct = $this->wslibrary->getDistrict($_POST['city']);
            if($distct){
                    $random = rand(1, 115);
            ?>
                                         <input type='hidden' id='city' name='city' value='<?php echo $_POST['city'] ?>'>
                                         
                <div class="metro">
                    <select class="district form-control" onchange="sp(this.value);" id="district" name="district">
                    <option value="0" class="label">DISTRICT/CITY</option>
                    <?php
                    foreach($distct as $p){
                        $namespaces = $distct->getNameSpaces(true);
                        $list = $p->children($namespaces['a']);
                        foreach($list as $li){
                            $prov = $li->children($namespaces['a']);
                    ?>
                    <option value="<?php echo urlencode($prov->District);?>" ><?php echo $prov->District;?></option>
                        <?php }}?>
                    </select>
                 </div>  		
                 <script>
                     $(document).ready(function(){
                       var $selects = $('#district');
                            $selects.easyDropDown({
                            cutOff: 10
                            });	 
                            
                     });
                     function sp(val)
{
    $(".lloading").text("Loading....");
    //alert(document.getElementById('city').value);
   $.ajax({
     type: 'post',
     url: '<?php echo base_url("providers/getallSpecialization");?>',
     data: {
       area_name:document.getElementById('city').value,
       district:val
     },
     success: function (response) {
         //alert(response);
       //document.getElementById("distrct_rep").innerHTML=response; 
       $("#specs").html(response);
       $(".lloading").text('done');
     }
   });
   }
                 </script>
            <?php	}else{
                    echo "error";
            }
        }
	}
        
        function getallSpecialization(){
            if(isset($_POST['district'])){
                //print_r(trim($_POST['district']));
                $distct = $this->wslibrary->getSpecialization($_POST['area_name'],$_POST['district']);
                if($distct){
                        $random = rand(1, 115);
                ?>

                    <div class="metro">
                        <select class="sp form-control" data-settings='{"cutOff":10}' id="specialization<?php echo $random;?>" name="specialization">
                        <option value="0" class="label">SPECIALIZATION</option>
                        <?php
                        foreach($distct as $p){
                           
                        ?>
                        <option value="<?php echo urlencode($p->Specialization);?>"><?php echo $p->Specialization;?></option>
                            <?php }?>
                        </select>
                     </div>  		
                     <script>
                         $(document).ready(function(){
                       var $selects = $('#specialization<?php echo $random;?>');
                            $selects.easyDropDown({
                            cutOff: 10
                            });	 
                         });
                     </script>
                <?php	}else{
                        //echo "errorSSS";
                        ?>
                    <div class="metro">
                        <select class="sp form-control" id="specialization" name='specialization'>
                            <option value="0" class="label">SPECIALIZATION</option>
                        </select>
                    </div>    	
                     
                     <script>
                         $(document).ready(function(){
                       var $selects = $('#specialization');
                            $selects.easyDropDown({
                            cutOff: 10
                            });	 
                         });
                     </script>
                     
                     <?php
                }
            }
        }
        
	function getOnlineAppointment(){
		$appointments = $this->wslibrary->getSchedAppointment($this->certid);
		
		?>
                	<table class="table tb">
                    	<tr>
                        	<td><strong>Date</strong></td>
                            <td><?php echo $appointments->ValidityDate;?></td>
                        </tr>
                    	<tr>
                        	<td><strong>Provider Name</strong></td>
                            <td><?php echo $appointments->ProviderName;?></td>
                        </tr>
                        <tr>
                        	<td><strong>Provider Address</strong></td>
                            <td><?php echo $appointments->ProviderAddress;?></td>
                        </tr>
                        <tr>
                        	<td><strong>Provider Contact</strong></td>
                            <td><?php echo $appointments->ProviderContact;?></td>
                        </tr> 
                        <tr>
                        	<td><strong>Package</strong></td>
                            <td><?php echo $appointments->APEType;?></td>
                        </tr> 
                        <tr>
                        	<td><strong>Reminders</strong></td>
                            <td><?php echo $appointments->Remarks;?></td>
                        </tr>                         
                	</table>		
        
        <?php
	}
    
    function find_doctor(){
        $data['provinces'] = $this->wslibrary->getCities();
        $data['userid'] = $this->user;
        $this->load->model("model_portal_admin");
        $this->load->library('archive');
        $this->archive->addAudit($this->certid,'providers','find a doctor','0',$this->agreement);
        $this->maintemp('find_doctor',$data);
    }
	
}


?>