<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tester extends CI_Controller {

	function index(){
		$this->config->load('recaptcha');
		$this->load->helper('recaptchalib'); 
		$publickey  = $this->config->item('public_key');
		$privatekey = $this->config->item('private_key');
		
		if(isset($_POST['submit'])){
			$resp = recaptcha_check_answer($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);			
			if($resp->is_valid) {
				echo "you got it";
			}else{
				echo "invalid";
			}
		}
		
		echo '<form action="" method="post">';
		echo recaptcha_get_html($publickey);
		echo '<input type="submit" name="submit">';
		echo '</form>';		
		
		
	}

	
	
}

?>