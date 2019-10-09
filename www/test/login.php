<?php

$curl = curl_init();
$auth_data = array(
	'email' 	=> 'admin@onlineorder.com',
	'password' 	=> '123456'
);

curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $auth_data);
curl_setopt($curl, CURLOPT_URL, 'http://mukith.site/ooapi/adminlogin');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

$result = curl_exec($curl);
if(!$result){die("Connection Failure");}
curl_close($curl);
echo $result;

 ?>