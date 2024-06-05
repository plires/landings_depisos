<?php

$db = new RepositorioSQL();
$errors = [];
$name = '';
$email = '';
$phone = '';
$comments = '';
$origin = ORIGIN;
$rubro = RUBRO;

if (isset($_GET['utm_source'])) {
	$utm_source = $_GET['utm_source'];
} else {
	$utm_source = "No Set";
}

if (isset($_GET['utm_medium'])) {
	$utm_medium = $_GET['utm_medium'];
} else {
	$utm_medium = "No Set";
}

if (isset($_GET['utm_campaign'])) {
	$utm_campaign = $_GET['utm_campaign'];
} else {
	$utm_campaign = "No Set";
}

if (isset($_GET['utm_content'])) {
	$utm_content = $_GET['utm_content'];
} else {
	$utm_content = "No Set";
}
