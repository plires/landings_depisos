<?php
	if(isset($_POST['g-recaptcha-response'])){$captcha=$_POST['g-recaptcha-response'];}
	$secretKey = $_ENV['RECAPTCHA_SECRET_KEY'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
	$responseKeys = json_decode($response,true);
?>