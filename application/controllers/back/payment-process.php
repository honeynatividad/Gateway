<?php

session_start();
ob_start();

	if (isset($_POST['status'])) {
		$status = $_POST['status'];
		$orderid= $_POST['orderid'];
					
		$merchant_order = $_POST['merchant_order'];
		
		$_SESSION['status'] = $status;
		$_SESSION['orderid'] = $orderid;
		$_SESSION['merchant_order'] = $merchant_order;
		
		if ($status=="approved"){
			$stat = "wc-completed";
		}else{
			$stat = "wc-processing";
		}
		
	}
	
	$url = 'http://philcare.com.ph/api/api.php/wp_posts';
	$fields = array(    
    
		'post_author' => $_SESSION['post_author'],
		'post_date' => $_SESSION['post_date'],
		'post_date_gmt' => $_SESSION['post_date_gmt'],
		'post_title' => $_SESSION['post_title'],
		'post_status' => $stat,
		'comment_status' => $_SESSION['comment_status'],
		'ping_status' => $_SESSION['ping_status'],
		'post_modified' => $_SESSION['post_modified'],
		'post_modified_gmt' => $_SESSION['post_modified_gmt'],
		'post_name' => $_SESSION['post_name'],
		'post_type' => $_SESSION['post_type'],
		'guid' => $_SESSION['guid']
	);
	$fields_string = "";

	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');


	$ch = curl_init();


	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
	curl_setopt($ch,CURLOPT_TIMEOUT, 20);


	$results = curl_exec($ch);
	curl_close($ch);


	$url2 = 'http://philcare.com.ph/api/api.php/wp_postmeta';
	$data[0] = "_order_key";
	$data[1] = "_order_currency";
	$data[2] = "_prices_include_tax";
	$data[3] = "_customer_user";
	$data[4] = "_order_shipping";
	$data[5] = "_billing_first_name";
	$data[6] = "_billing_last_name";
	$data[7] = "_billing_address_1";
	$data[8] = "_billing_city";
	$data[9] = "_billing_state";
	$data[10] = "_billing_country";
	$data[11] = "_shipping_country";
	$data[12] = "_shipping_first_name";
	$data[13] = "_shipping_last_name";
	$data[14] = "_shipping_address_1";
	$data[15] = "_shipping_city";
	$data[16] = "_shipping_state";
	$data[17] = "_payment_method";
	$data[18] = "_payment_method_title";
	$data[19] = "_cart_discount";
	$data[20] = "_cart_discount_tax";
	$data[21] = "_order_tax";
	$data[22] = "_order_shipping_tax";
	$data[23] = "_order_total";
	$data[24] = "_shipping_address_2";

	if($_SESSION['discount']){
		$discount = 100 * $_SESSION['quantity'];
	}else{
		$discount = 0;
	}

	$val[0] = "wc_order_".$results;
	$val[1] = "PHP";
	$val[2] = "no";
	$val[3] = 0;
	$val[4] = $_SESSION['order_shipping'];
	$val[5] = $_SESSION['firstName'];
	$val[6] = $_SESSION['lastName'];
	$val[7] = $_SESSION['address'];
	$val[8] = $_SESSION['city'];
	$val[9] = $_SESSION['state'] ;
	$val[10] = "PH";
	$val[11] = "PH";
	$val[12] = $_SESSION['firstName'];
	$val[13] = $_SESSION['lastName'];
	$val[14] = $_SESSION['address'];
	$val[15] = $_SESSION['city'];
	$val[16] = $_SESSION['state'];
	$val[17] = "Arumpay";
	$val[18] = "Credit Card";
	$val[19] = $discount;
	$val[20] = 0;
	$val[21] = 0;
	$val[22] = 0;
	$val[23] = $_SESSION['amount'];
	$val[24] = "";


	for($x = 0; $x < 24;$x++){
		$fields = array(        
			'post_id' => $results,
			'meta_key' => $data[$x],
			'meta_value' => $val[$x]
		);
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');

		
		$ch = curl_init();
		
		curl_setopt($ch,CURLOPT_URL, $url2);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		
		$result = curl_exec($ch);
		
		curl_close($ch);
	}


	$url = 'http://philcare.com.ph/api/api.php/wp_woocommerce_order_items';

	$val[0][0] = $_SESSION['order_desc'];
	$val[0][1] = "line_item";
	$val[0][2] = $results;

	$val[1][0] = $_SESSION['location_code'];
	$val[1][1] = "line_item";
	$val[1][2] = $results;

		$fields = array(        
			'order_item_name' => $_SESSION['order_desc'],
			'order_item_type' => "line_item",
			'order_id' => $results
		);


	$fields_string = "";
	
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');
	
	$ch = curl_init();
	
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
	curl_setopt($ch,CURLOPT_TIMEOUT, 20);
	
	$resultOrder = curl_exec($ch);
	curl_close($ch);


	$url = 'http://philcare.com.ph/api/api.php/wp_woocommerce_order_items';


		$fields = array(        
			'order_item_name' => "Manila Rate",
			'order_item_type' => "shipping",
			'order_id' => $results
		);


	$fields_string = "";
	
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');

	
	$ch = curl_init();
	
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
	curl_setopt($ch,CURLOPT_TIMEOUT, 20);
	
	$result = curl_exec($ch);
	curl_close($ch);

	$url = 'http://philcare.com.ph/api/api.php/wp_woocommerce_order_itemmeta';

	$data[0] = "_qty";
	$data[1] = "_tax_class";
	$data[2] = "_product_id";
	$data[3] = "_variation_id";
	$data[4] = "_line_subtotal";
	$data[5] = "_line_total";
	$data[6] = "_line_subtotal_tax";
	$data[7] = "_line_tax";

	$val[0] = $_SESSION['quantity'];
	$val[1] = "";
	$val[2] = $_SESSION['product_id'];
	$val[3] = 0;
	$val[4] = $_SESSION['amount'];
	$val[5] = $_SESSION['amount'];
	$val[6] = 0;
	$val[7] = 0;


	for($i = 0;$i<8;$i++){
		$fields = array(    
			'order_item_id' => $resultOrder,
			'meta_key' => $data[$i],
			'meta_value' => $val[$i]
		);


		$fields_string = "";		
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		
		$ch = curl_init();
		
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
		curl_setopt($ch,CURLOPT_TIMEOUT, 20);
		
		$result = curl_exec($ch);

		curl_close($ch);
	}
	
	$url = 'http://philcare.com.ph/api/api.php/wp_woocommerce_order_itemmeta';
	$data[0] = "method_id";
	$data[1] = "cost";
	$data[2] = "taxes";
	
	$method_id = '';
	if($_SESSION['order_shipping']==65){
		$method_id = 'table_rate-1';
	}else if($_SESSION['order_shipping'] == 75){
		$method_id = 'table_rate-2';
	}else if($_SESSION['order_shipping'] == 85){
		$method_id = 'table_rate-3';
	}else if($_SESSION['order_shipping'] == 95){
		$method_id = 'table_rate-4';
	}
	$val[0] = $method_id ;
	$val[1] = $_SESSION['order_shipping'];
	$val[2] = 'a:0:{}';
	
	for($i = 0;$i<8;$i++){
		$fields = array(    
			$data[$i] => $val[$i]
		);


		$fields_string = "";		
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		
		$ch = curl_init();
		
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
		curl_setopt($ch,CURLOPT_TIMEOUT, 20);
		
		$result = curl_exec($ch);

		curl_close($ch);
	}

require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->SMTPAuth   = false; 
$mail->SMTPSecure = 'ssl'; 
$mail->Host       = '172.16.108.58'; 
$mail->Port       = 25; 
$mail->Username   = 'advisory@philcare.com.ph'; 
$mail->Password   = 'P@ssw0rd';                                   // TCP port to connect to

$mail->setFrom('order@philcare.com.ph', 'PhilCare');
//$mail->addAddress('hanna.natividad@philcare.com.ph', 'Hanna Natividad');     // Add a recipient
//$mail->addAddress('honeynatividad@gmail.com', 'Hanna Natividad');     // Add a recipient
$add = $_SESSION['email'];
$name = $_SESSION['firstName']." ".$_SESSION['lastName'];
$mail->addAddress(''.$add.'', ''.$name.'');
//$mail->AddBCC('hanna.natividad@philcare.com.ph', 'Hanna Natividad');

//$mail->addReplyTo('order@philcare.com.ph', 'Order');

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'PhilCare Prepaid Card Order '.$_SESSION['orderid'] ;
$msg = "Thank you for purchasing from www.philcare.com.ph. Please expect another email from our team on the details of your product order's tracking number. Your order details are shown below for your reference:";
$msg .="<table>
							<tr>
								<td>Merchant Order ID:</td>
								<td>" . $_SESSION['merchant_order'] ."</td>
							</tr>
							<tr>
								<td>Transaction ID:</td>
								<td>" . $_SESSION['orderid'] . "</td>
							</tr>
							<tr>
								<td>Name:</td>
								<td>" . $_SESSION['firstName'] . " ".$_SESSION['lastName']."</td>
							</tr>
							<tr>
								<td>Amount Paid:</td>
								<td>" . $_SESSION['amount'] . "</td>
							</tr>
							<tr>
								<td>Product:</td>
								<td>" . $_SESSION['order_desc'] . "</td>
							</tr>							
						</table>";

$mail->Body    = $msg;


if(!$mail->send()) {
    //echo 'Message could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
	header("Location: http://philcare.com.ph/repurchase/status.php");
	exit();
} else {
    //echo 'Message has been sent';
	header("Location: http://philcare.com.ph/repurchase/status.php");
	exit();
}