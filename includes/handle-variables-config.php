<?php
	
	$db = new RepositorioSQL();
	$errors = [];
	$name = '';
	$email = '';
	$phone = '';
	$comments = '';
	$origin = ORIGIN;
	$rubro = RUBRO;

	if ( isset($_GET['utm_medium']) ) {
		$utm_medium = $_GET['utm_medium'];
	} else {
		$utm_medium = "No Set";
	}
	
?>