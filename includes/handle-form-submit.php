<?php 
	// Envio del formulario de contacto
	if (isset($_POST["send"])) {
			  
	  include_once( __DIR__ . '/../php/recaptcha.php' );
	  
		if ($responseKeys['success']) {

	  	include_once( __DIR__ . '/../includes/handle-form-validation.php' );
	  
	  } else {
	    $errors['recaptcha'] = 'Error al validar el recaptcha';
	  }

	  if (!$errors) {

	  	//grabamos en la base de datos y obtenemos el email destino de la consulta
	    $emailTo = $db->getRepositorioContacts()->saveInBDD($_POST);

	    // Registramos en Perfit el contacto
	    $db->getRepositorioApp()->registerEmailContactsInPerfit($_ENV['PERFIT_APY_KEY'], $_ENV['PERFIT_LIST'], PERFIT_INTEREST, $_POST, $emailTo);

	    $sendClient = $db->getRepositorioApp()->sendEmail('Cliente', 'Contacto Cliente', $_POST, $emailTo);
	    $sendUser = $db->getRepositorioApp()->sendEmail('Usuario', 'Contacto Usuario', $_POST, $emailTo);

	    if ($sendClient) {
	      // Redirigimos a la pagina de gracias
	      ?>
<script type="text/javascript">
window.location = 'gracias.php';
</script>
<?php
	    } else {
	      exit('Error al enviar la consulta, por favor intente nuevamente');
	    }
	    
	  }

	}

?>