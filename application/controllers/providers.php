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
                            <option value="" class="label">DISTRICT/CITY</option>
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
    
    function find_dentist(){
        $data['provinces'] = $this->wslibrary->getCities();
        $data['userid'] = $this->user;
        $this->load->model("model_portal_admin");
        $this->load->library('archive');
        $this->archive->addAudit($this->certid,'providers','find a dentist','0',$this->agreement);
        $this->maintemp('find_dentist',$data);        
    }
    
    function getRegion(){
        if(isset($_POST['state'])){
            $state = $_POST['state'];
            
            $regions = $this->wslibrary->getRegion($state);
            $count = count($regions['RegionResult']);
        ?>
            <input type="hidden" name="region_code" value="<?php ?>">
            <select class="dval form-control" id="dregion" name="region">
                <option value="0">-REGION-</option>
                <?php for($x = 0;$x<$count;$x++): ?>
                <option value="<?php echo $regions['RegionResult'][$x]['RegionCode'] ?>|<?php echo $regions['RegionResult'][$x]['RegionDesc'] ?>"><?php echo $regions['RegionResult'][$x]['RegionDesc'] ?></option>
                <?php endfor; ?>
            </select>
        <?php
        }
    }
    function getProvince(){
        if(isset($_POST['region'])){
            $region = $_POST['region'];
            
            $result_explode = explode('|', $region);
            $code = $result_explode[0];            
            
            $provinces = $this->wslibrary->getProvince($code);
            $count = count($provinces['ProvinceResult']);
        ?>
            <select class="dval form-control" id="area_name" name="area_name">
                <option value="0">-PROVINCE-</option>
                <?php for($x = 0;$x<$count;$x++): ?>
                <option value="<?php echo $provinces['ProvinceResult'][$x]['ProvinceCode'] ?>|<?php echo $provinces['ProvinceResult'][$x]['ProvinceDesc'] ?>"><?php echo $provinces['ProvinceResult'][$x]['ProvinceDesc'] ?></option>
                <?php endfor; ?>
            </select>
        <?php
        }
    }
    
    function getDistrict(){
        if(isset($_POST['province'])){
            $province = $_POST['province'];
            $result_explode = explode('|', $province);
            $code = $result_explode[0];           
            $districts = $this->wslibrary->getNewDistrict($code);
            $count = count($districts['DistrictResult']);
        ?>
            <select class="dval form-control" id="district" name="district">
                <?php for($x = 0;$x<$count;$x++): ?>
                <option value="<?php echo $districts['DistrictResult'][$x]['DistrictCode'] ?>|<?php echo $districts['DistrictResult'][$x]['DistrictDesc'] ?>"><?php echo $districts['DistrictResult'][$x]['DistrictDesc'] ?></option>
                <?php endfor; ?>
            </select>
        <?php
        }
    }
    function getProvider_dentist(){
        if(isset($_REQUEST['district'])){  
            $this->load->library('pagination');
            $state = $_POST['state'];
            $region = $_POST['region'];
            $province = $_POST['province'];
            $district = $_POST['district'];
            //print_r("state is ".$state.": region is ".$region.": province is ".$province.": district is ".$district);
            $providers = $this->wslibrary->getProviderDentist($state,$region,$province,$district);
            $c = count($providers['DentalProviderClinicsResult']);
            //print_r("total s ".$c);
            ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Clinic Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>District/City</th>
                        <th>Province</th>
                        <th>Region</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Clinic Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>District/City</th>
                        <th>Province</th>
                        <th>Region</th>
                        <th>State</th>
                    </tr>
                </tfoot>
                <tbody>
            <?php
           
                $count = $c;
               
                if($count == "0"){
                    
                }else{
                    $config['base_url'] = base_url('providers/find_dentist_paginate/'.$state.'/'.$region.'/'.$province.'/'.$district.'');
                    $config["total_rows"] = $count;
                    $config['per_page'] = "20";
                    $config["uri_segment"] = 7;
                    $choice = $config["total_rows"] / $config["per_page"];
                    $config["num_links"] = floor($choice);

                    //config for bootstrap pagination class integration
                    $config['full_tag_open'] = '<ul class="pagination">';
                    $config['full_tag_close'] = '</ul>';
                    $config['first_link'] = false;
                    $config['last_link'] = false;
                    $config['first_tag_open'] = '<li>';
                    $config['first_tag_close'] = '</li>';
                    $config['prev_link'] = '&laquo';
                    $config['prev_tag_open'] = '<li class="prev">';
                    $config['prev_tag_close'] = '</li>';
                    $config['next_link'] = '&raquo';
                    $config['next_tag_open'] = '<li>';
                    $config['next_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li>';
                    $config['last_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active"><a href="#">';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['num_tag_open'] = '<li>';
                    $config['num_tag_close'] = '</li>';

                    $this->pagination->initialize($config);
                    if($this->uri->segment(7)){
                        $page = ($this->uri->segment(7)) ;
                        $start = ($this->uri->segment(7)) ;
                    }
                    else{
                        $page = 20;
                        $start = 0;
                    }
                    
                    $str_links = $this->pagination->create_links();
                    $data["links"] = explode('&nbsp;',$str_links );
                    
                                   
                    $s = 0 + $start;
                    //print_r($providers['DentalProviderClinicsResult']);                
                    $total = $count;
                    if($count <= 1){
                        $total = 1;
                        
                    }else{
                        if($total<=20){
                            $total = $c;
                        }else{
                            $total = $start + 20;
                        }
                        
                    }                   
                    for($x=$s; $x<$total; $x++){
                      
                ?>
                        <tr>
                            <td><a href="#" id="<?php echo $providers['DentalProviderClinicsResult'][$x]['ClinicCode'] ?>" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><?php echo $providers['DentalProviderClinicsResult'][$x]['ProviderName'] ?></a></td>
                            <td><?php echo $providers['DentalProviderClinicsResult'][$x]['ContactNumber'] ?></td>
                            <td><?php echo $providers['DentalProviderClinicsResult'][$x]['Address'] ?></td>
                            <td><?php echo $providers['DentalProviderClinicsResult'][$x]['DistCity'] ?></td>
                            <td></td>
                            <td><?php echo $providers['DentalProviderClinicsResult'][$x]['Region'] ?></td>
                            <td><?php echo $providers['DentalProviderClinicsResult'][$x]['State'] ?></td>
                        </tr>
                <?php
                    }
                }
            
            ?>
                </tbody>
            </table>
            <?php 
                echo $this->pagination->create_links();
                
            ?>
            <!-- Modal -->
            <script>
                $(document).ready(function(){
                   $("a[data-toggle=modal]").click(function() {
                        var clinic_id = $(this).attr('id');
                    //alert(clinic_id);

                $.post("<?php echo base_url("providers/getDentistSchedule");?>",

                    {clinic:clinic_id},function(data){

                        $('#myModal').show();
                        $('#modalContent').show().html(data);

                        $(".lloading").text('done');
                });		


            });
        });
                </script>
                
        <?php
        }
    }
 
    function getDentistSchedule(){
        if(isset($_POST['clinic'])){
            $clinic = $_POST['clinic'];
        
        $schedules = $this->wslibrary->getDentistSchedule($clinic);
        $count  = count($schedules['DentalProviderDoctorsScheduleResult']);
       
            
        
        ?>   
           
            <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Dentist Schedule</h4>
                        </div>
                        <div class="modal-body">
                            <?php
                             for($x=0; $x<$count; $x++){
                            ?>
                            <p>Dentist Name: <?php echo $schedules['DentalProviderDoctorsScheduleResult'][$x]['FirstName']." ".$schedules['DentalProviderDoctorsScheduleResult'][$x]['LastName'] ?></p>
                            <p>Schedule: <?php echo $schedules['DentalProviderDoctorsScheduleResult'][$x]['Schedule'] ?></p>
                        </div>
                            <?php
                            }?>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
        <?php
        }
    }
    function find_dentist_paginate(){
        
        $state = $this->uri->segment(3);
        $region = urldecode($this->uri->segment(4));
        $province = urldecode($this->uri->segment(5));
        $district = urldecode($this->uri->segment(6));
        $start = urldecode($this->uri->segment(7));
        
        $providers = $this->wslibrary->getProviderDentist($state,$region,$province,$district);
        $c = count($providers['DentalProviderClinicsResult']);
        //print_r("test============".$province);
        //print_r("State is ".$state.": Region is".$region.": Province:".$province.":District is ".$district);
        //print_r($providers);
        $this->load->library('pagination');
        
        //foreach ($providers as $key => $value) {
                $count = $c;
                $config['base_url'] = base_url('providers/find_dentist_paginate/'.$state.'/'.$region.'/'.$province.'/'.$district.'');
                $config["total_rows"] = $count;
                $config['per_page'] = 20;
                $config["uri_segment"] = 7;
                $choice = $config["total_rows"] / $config["per_page"];
                $config["num_links"] = floor($choice);

                //config for bootstrap pagination class integration
                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';
                $config['first_link'] = false;
                $config['last_link'] = false;
                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';
                $config['prev_link'] = '&laquo';
                $config['prev_tag_open'] = '<li class="prev">';
                $config['prev_tag_close'] = '</li>';
                $config['next_link'] = '&raquo';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';
                $config['last_tag_open'] = '<li>';
                $config['last_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li class="active"><a href="#">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                
                $data['page'] = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
                
                $this->pagination->initialize($config);
                if($this->uri->segment(7)){
                $page = ($this->uri->segment(7)) ;
                $start = ($this->uri->segment(7)) ;
                
                }
                else{
                $page = 20 ;
                $start = 0;
                }
                $getPaginate[$start] = array();
                $str_links = $this->pagination->create_links();
                $data["links"] = explode('&nbsp;',$str_links );
                $data['start'] = $start;
                //$data['page'] = $page;
                $data['paginate'] = $this->pagination->create_links();
               
                /*for($x=$start;$x<=$page+20;$x++){
                    $getPaginate[$x] = array(
                        "ProviderName"      => $providers['DentalProviderClinicsResult'][$x]['ProviderName'],
                        "Address"           => $providers['DentalProviderClinicsResult'][$x]['Address'],
                        "ContactNumber"     => $providers['DentalProviderClinicsResult'][$x]['ContactNumber'],
                        "DistCity"          => $providers['DentalProviderClinicsResult'][$x]['DistCity'],
                        "Region"            => $providers['DentalProviderClinicsResult'][$x]['Region'],
                        "State"             => $providers['DentalProviderClinicsResult'][$x]['State']
                    );
                }*/
                
        //}
               // var_dump($providers['DentalProviderClinicsResult']);
        $data['link_page'] = $this->pagination->create_links();
        $data['getPaginate'] = $providers['DentalProviderClinicsResult'];
        $data['provinces'] = $this->wslibrary->getCities();
        $data['total'] = $c;
        $data['userid'] = $this->user;
        $this->load->model("model_portal_admin");
        $this->load->library('archive');
        $this->archive->addAudit($this->certid,'providers','find a dentist','0',$this->agreement);
        $this->maintemp('find_dentist_paginate',$data);           
        
    }
     
    function copay(){
        $data['provinces'] = $this->wslibrary->getCities();        
        $data['userid'] = $this->user;
        
        $provinces = $this->wslibrary->getProvince();
        
        $this->load->model("model_portal_admin");
        $this->load->library('archive');
        $this->archive->addAudit($this->certid,'providers','copay','0',$this->agreement);
        $this->maintemp('copay',$data);    
    }
    
}

?>