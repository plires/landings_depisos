<?php
	// Verificamos si hay errores en el formulario
	if (campoVacio($_POST['name'])){
	  $errors['name']='Ingresa tu nombre';
	} else {
	  $name = $_POST['name'];
	}

	if (!comprobar_email($_POST['email'])){
	  $errors['email']='Ingresa el mail :(';
	} else {
	  $email = $_POST['email'];
	}

	if (campoVacio($_POST['phone'])){
	  $errors['phone']='Ingresa un Telefono de contacto';
	} else {
	  $phone = $_POST['phone'];
	}

	if (campoVacio($_POST['comments'])){
	  $errors['comments']='Ingresa tus comentarios';
	} else {
	  $comments = $_POST['comments'];
	}
?>