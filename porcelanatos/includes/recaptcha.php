<?php
  
  //capturamos el POST del reCAPTCHA
  $response_recaptcha = $_POST['g-recaptcha-response'];

  // Verificamos si el usuario no tildo el reCAPOTCHA y si no lo hizo
  // cargamos el error al array de errores de validacion del form
  if (!$response_recaptcha) {
    $errors['recaptcha']='Error al validar el reCAPTCHA';
  }

  if (isset($response_recaptcha)) {
    
    // Cargamos los datos que nos da la API de Google.
    $secret = "6LfQHm8UAAAAANpVyKXWyIs98nb8D53ODZpUGXMH";

    // Cargamos la IP del usuario
    $ip = $_SERVER["REMOTE_ADDR"];

    // Validamos en la URL que nos da Goolge.
    $validation_server = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response_recaptcha&remoteip=$ip");

    //Decodificamos el JSON y lo convertimos en array asosiativo
    $arr = json_decode($validation_server, TRUE);

    // Comprobamos si el reCaptcha es valido y si no lo es cargamos el error al
    // array de errores de validacion del form
    if (!$arr['success']) {
      $errors['recaptcha']='Error al validar el reCAPTCHA';
      $errors_modal['recaptcha']='Error al validar el reCAPTCHA';
    }

  }
?>