<?php
	include_once( __DIR__ . '/includes/config.inc.php' );
	include_once( __DIR__ . '/includes/funciones_validar.php' );
	include_once( __DIR__ . '/../clases/repositorioSQL.php' );
	include_once( __DIR__ . '/../clases/app.php' );

	$db = new RepositorioSQL();
	$errors = [];
	$name = '';
	$email = '';
	$phone = '';
	$comments = '';
	$origin = ORIGIN;

	if ( isset($_GET['utm_medium']) ) {
		$utm_medium = $_GET['utm_medium'];
	} else {
		$utm_medium = "google";
	}

	$rubro = RUBRO;

	// Envio del formulario de contacto
	if (isset($_POST["send"])) {
			  
	  if(isset($_POST['g-recaptcha-response'])){$captcha=$_POST['g-recaptcha-response'];}
	  $secretKey = RECAPTCHA_SECRET_KEY;
	  $ip = $_SERVER['REMOTE_ADDR'];
	  $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
	  $responseKeys = json_decode($response,true);

	  if ($responseKeys['success']) {
	  
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

	  } else {
	    $errors['recaptcha'] = 'Error al validar el recaptcha';
	  }

	  if (!$errors) {

	  	//grabamos en la base de datos y obtenemos el email destino de la consulta
	    $emailTo = $db->getRepositorioContacts()->saveInBDD($_POST);

	    //Enviamos los mails al cliente y usuario
	    $app = new App;

	    // Registramos en Perfit el contacto
	    $app->registerEmailContactsInPerfit(PERFIT_APY_KEY, PERFIT_LIST, $_POST, $emailTo);

	    $sendClient = $app->sendEmail('Cliente', 'Contacto Cliente', $_POST, $emailTo);
	    $sendUser = $app->sendEmail('Usuario', 'Contacto Usuario', $_POST, $emailTo);

	    if ($sendClient) {
	      // Redirigimos a la pagina de gracias
	      ?>
	      <script type="text/javascript">
	      window.location= 'gracias.php';
	      </script>
	      <?php
	    } else {
	      exit('Error al enviar la consulta, por favor intente nuevamente');
	    }
	    
	  }

	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Pisos flotantes a prueba de agua. Colores simil madera. Las mejores marcas en pisos y el mejor precio del mercado">
	<meta name="author" content="Librecomunicacion">
    <!-- Favicons -->
    <?php include('includes/favicon.inc.php'); ?>

	<title>Pisos flotantes. Pisos flotantes a prueba de agua</title>
	<link rel="stylesheet" href="./../node_modules/normalize.css/normalize.css">
	<link rel="stylesheet" href="./../node_modules/animate.css/animate.min.css">
	<link rel="stylesheet" href="./../node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./../node_modules/slick-carousel/slick/slick.css">
	<link rel="stylesheet" href="./../node_modules/slick-carousel/slick/slick-theme.css">
	<link rel="stylesheet" href="./css/app.css">

	<?php include('./includes/tag_manager_head.php') ?>
</head>
<body>
	<?php include('./includes/tag_manager_body.php') ?>

	<!-- Header -->
	<header>
		<div>
			<img class="img-fluid" src="img/logo-depisos.png" alt="logo depisos">
		</div>
	</header>
	<!-- Header end -->

	<!-- Imagen Destacada -->
	<section class="container-fluid imagen_destacada">

		<!-- Mejores Marcas -->
		<div class="mejores_marcas wow fadeInRight">
			<img class="img-fluid" src="img/marcas.png" alt="mejores marcas pisos a prueba de agua">
			<div>
				<p>las <span>mejores</span> <br> marcas del <br> mercado</p>
			</div>
		</div>
		<!-- Mejores Marcas end -->

		<!-- Informacion -->
		<div class="container">
			<div class="row">

				<div class="col-md-12">
					<h1 class="wow fadeInDown">PISOS <span>FLOTANTES</span></h1>
					
					<p class="wow fadeInLeft promocion">¡Pagá en cuotas!</p>

					<p class="wow fadeInLeft cuotas">
						Comprá tus pisos en hasta 18 cuotas <br>
						<span>Comunicate con nosotros y conocé más detalles</span>
					</p>

					<!-- Formulario -->
					<form id="formulario" method="post" class="needs-validation wow fadeInUp" novalidate>
						<input type="hidden" name="origin" value="<?= $origin ?>">
						<input type="hidden" name="utm_medium" value="<?= $utm_medium ?>">
						<input type="hidden" name="rubro" value="<?= $rubro ?>">

						<!-- Errores Formulario -->
						<?php if ($errors): ?>
							<div id="error" class="alert alert-danger alert-dismissible fade show fadeInLeft" role="alert">
							  <strong>¡Por favor verificá los datos!</strong>
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							  <ul style="padding: 0;">
							    <?php foreach ($errors as $error) { ?>
							      <li>- <?php echo $error; ?></li>
							    <?php } ?>
							  </ul>
							</div>
						<?php endif ?>
						<!-- Errores Formulario end -->

						<p class="leyenda_presupuesta">Presupuestá Ahora!</p>
						<!-- Name -->
						<div class="form-group">
							<input required type="text" class="form-control" name="name" placeholder="Nombre" value="<?= $name ?>">
							<div class="invalid-feedback">
			        	Por favor ingresá tu nombre
			      	</div>
						</div>
						
						<!-- Email -->
						<div class="form-group">
							<input required type="email" class="form-control" name="email" placeholder="Email" value="<?= $email ?>">
							<div class="invalid-feedback">
			        	Por favor ingresá tu email
			      	</div>
						</div>
						
						<!-- Phone -->
						<div class="form-group">
							<input required type="text" class="form-control" name="phone" placeholder="Teléfono" value="<?= $phone ?>">
							<div class="invalid-feedback">
			        	Por favor ingresá un teléfono de contacto
			      	</div>
						</div>

						<!-- Comments -->
						<div class="form-group">
							<textarea required class="form-control" name="comments" rows="3" placeholder="Consulta"><?= $comments ?></textarea>
							<div class="invalid-feedback">
			        	Tu comentario es importante
			      	</div>
						</div>

						<!-- reCAPTCHA  -->
						<div id="recaptcha" class="g-recaptcha" data-sitekey="<?= RECAPTCHA_PUBLIC_KEY ?>"></div>

						<!-- Newsletter -->
						<div class="form-group form-check">
							<input type="checkbox" checked class="form-check-input" name="newsletter">
							<label class="form-check-label" for="newsletter">suscribe newsletter</label>
						</div>

					  <button type="submit" id="send" name="send" class="btn btn-primary transition">ENVIAR</button>

					</form>
					<!-- Formulario end -->

				</div>

			</div>
		</div>
		<!-- Informacion end -->

	</section>
	<!-- Imagen Destacada -->

	<!-- Líneas -->
	<section class="container lineas">
		
		<div class="row">
			<div class="col-md-12 wow fadeInUp">
				<h2>PISOS FLOTANTES PRUEBA DE AGUA: <span>LÍNEAS</span></h2>
			</div>
		</div>

		<div class="row wow fadeInUp">
			<div class="col-md-4">
				<img class="img-fluid" src="img/piso-vinilico-para-pegar.jpg" alt="pisos a prueba de agua sistema para pegar">
				<h3>SISTEMA PARA PEGAR</h3>
			</div>
			<div class="col-md-4">
				<img class="img-fluid" src="img/piso-vinilico-sistema-click.jpg" alt="pisos flotantes vinilicos de agua sistema click">
				<h3>SPC SISTEMA CLICK</h3>
			</div>
			<div class="col-md-4">
				<img class="img-fluid" src="img/piso-vinilico-click.jpg" alt="pisos a prueba de agua click">
				<h3>VINÍLICO CLICK</h3>
			</div>
		</div>

	</section>
	<!-- Líneas end -->

	<!-- Faja Naranja -->
	<section class="container-fluid faja_naranja">
		<div class="container">
			<div class="row">
				<div class="col-md-10 offset-md-1">
					<p class="wow fadeInUp"><span>Depisos.com</span> te ofrece la variedad más amplia del mercado y las mejores marcas para crear los ambientes <span>MÁS AGRADABLES</span>.</p>
				</div>
			</div>
		</div>
	</section>
	<!-- Faja Naranja end -->

	<!-- Tipologia -->
	<section class="container tipologia">
		<div class="row">
			<div class="col-md-12 wow fadeInUp">
				<h4>
					exclusivo sistema de encastre <span>CLICK</span>
					<img class="img-fluid" src="img/sistema-click.png" alt="sistema click en pisos flotantes a prueba de agua">
				</h4>
				<p>DISPONIBLES EN DOS FORMATOS:</p>
				<img class="img-fluid liston_baldosa" src="img/liston-baldosa.jpg" alt="pisos flotantes vinilicos en listones y baldosas">
			</div>
		</div>
	</section>
	<!-- Tipologia end -->

	<!-- Galeria -->
	<?php include('includes/galeria.inc.php') ?>
	<!-- Galeria end -->

	<!-- Varios -->
	<section class="container varios">

		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="visita wow fadeInUp">
					<p>
						visitá nuestro <span>SHOWROOM</span>
						<a href="#formulario" class="btn btn-primary transition btn_to_form">SOLICITÁ UNA VISITA</a>
					</p>
				</div>
			</div>
		</div>

		<div class="row caracteristicas wow fadeInUp">

			<div class="col-md-6">
				<ul>
					<li>
						<img class="img-fluid" src="img/tilde.png" alt="pisos flotantes vinilicos tilde 1">
						<p>Resistentes 100% al agua</p>
					</li>
					<li>
						<img class="img-fluid" src="img/tilde.png" alt="pisos flotantes vinilicos tilde 2">
						<p>Resistentes a golpes y arañazos</p>
					</li>
				</ul>
			</div>

			<div class="col-md-6">
				<ul>
					<li>
						<img class="img-fluid" src="img/tilde.png" alt="pisos vinilicos tilde 3">
						<p>Rápida y fácil instalación</p>
					</li>
					<li>
						<img class="img-fluid" src="img/tilde.png" alt="pisos vinilicos tilde 4">
						<p>Aislamiento acústico y térmico</p>
					</li>
				</ul>
			</div>

		</div>

		<div class="row beneficios">

			<div class="col-4 wow fadeInLeft">
				<img class="img-fluid" src="img/presupuesto-sin-cargo.png" alt="pisos a prueba de agua presupuestos sin cargo">
				<p>Presupuestos Sin cargo</p>
			</div>

			<div data-wow-delay="0.3s" class="col-4 wow fadeInLeft">
				<img class="img-fluid" src="img/cuotas-fijas.png" alt="pisos a prueba de agua Cuotas fijas en pesos">
				<p>Ahora 12 Cuotas fijas en pesos</p>
			</div>

			<div data-wow-delay="0.6s" class="col-4 wow fadeInLeft">
				<img class="img-fluid" src="img/importadores-directos.png" alt="pisos a prueba de agua Importadores Directos">
				<p>Importadores Directos</p>
			</div>

		</div>

	</section>
	<!-- Varios end -->

	<!-- Aplicaciones -->
	<section class="container-fluid aplicaciones">
		<div class="container">
			<div class="row">
				<div class="col-md-10 offset-md-1 wow fadeInUp">
					<h2>PISOS FLOTANTES: APLICACIONES RECOMENDADAS</h2>
					<p>
						Los pisos flotantes a prueba de agua son ideales para entornos comerciales y domésticos. Desarrollados con materiales de primera calidad. <br> <span>Aptos para alto tránsito.</span>
					</p>
					<p class="dudas">¿TENÉS DUDAS O CONSULTAS?</p>
					<a href="#formulario" class="btn btn-primary transition btn_to_form">CONTACTANOS</a>
				</div>
			</div>
		</div>
	</section>
	<!-- Aplicaciones end -->

	<!-- Footer -->
	<footer>
		<div class="container">

			<div class="row">
				<div class="col-md-12">
					<p>
						Calle: 56 4575 - San Martin <br>
						Teléfono: 11 6379 0009 <br>
						<a class="btn_to_form transition" href="#formulario">
							info@depisos.com
						</a> <br>
						Horarios: Lu - Vie / 9:00 - 18:00 Hs.
						Sábados 9:30 - 13:30 Hs.
					</p>	
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<p class="copy">Copyright &copy; <?= date('Y'); ?>, All Rights Reserved.</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 text-right">
					<hr>
					<a href="https://librecomunicacion.net/" target="_blank" rel="noopener" class="libre transition">by Libre</a>
				</div>
			</div>

		</div>
	</footer>
	<!-- Footer end -->

	<script src="./../node_modules/jquery/dist/jquery.min.js"></script>
	<script src="./../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="./../node_modules/wow.js/dist/wow.min.js"></script>
	<script src="./../node_modules/jquery.easing/jquery.easing.min.js"></script>
	<script src="./../node_modules/slick-carousel/slick/slick.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src="./js/app.js" ></script>

</body>
</html>