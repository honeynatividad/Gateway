<?php
$to = "jayrabang4@gmail.com";
$subject = "HTML email";


$signature = "
<table>
<tbody>
<tr>
	<td><img src='http://hayabusafight.net.ph/portal/assets/ovr/img/logo.jpg' width='280px'></td>
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
<title>HTML email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
</table>
$signature
</body>
</html>
";



// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";
$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);
?>