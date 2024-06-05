<?php

	// Verificamos si hay errores en el formulario
	if (campoVacio($_POST['name'])){
	  $errors['name']='Ingresá tu nombre';
	} else {
	  $name = $_POST['name'];
	}

	if (!comprobar_email($_POST['email'])){
	  $errors['email']='Ingresá el mail :(';
	} else {
	  $email = $_POST['email'];
	}

	if (campoVacio($_POST['phone'])){
	  $errors['phone']='Ingresá un Teléfono de contacto';
	} else {
	  $phone = $_POST['phone'];
	}

	if (!isset($_POST['store'])){
	  $errors['store']='Seleccioná un showroom de preferencia';
	} 

	if (campoVacio($_POST['comments'])){
	  $errors['comments']='Ingresá tus comentarios';
	} else {
	  $comments = $_POST['comments'];
	}
?>