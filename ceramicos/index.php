<?php
	include_once( __DIR__ . '/includes/config.inc.php' );
	include_once( __DIR__ . '/../vendor/autoload.php' );
	include_once( __DIR__ . '/../includes/funciones_validar.php' );
	include_once( __DIR__ . '/../clases/repositorioSQL.php' );
	include_once( __DIR__ . '/../clases/app.php' );

	$app = new App;

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../" );
  $dotenv->load(); 

  include_once( __DIR__ . '/../includes/handle-variables-config.php' );

	include_once( __DIR__ . '/../includes/handle-form-submit.php' );
?>

<!DOCTYPE html>
<html lang="es">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Linea de cerámicos para pisos. Primeras y segundas marcas.">
		<meta name="author" content="Librecomunicacion">

	  <!-- Favicons -->
	  <?php include('./../includes/favicon.inc.php'); ?>
	  
		<title>Cerámicos de primera y segunda | Depisos.com</title>
		<link rel="stylesheet" href="./css/app.css">

		<?php include('./../includes/tag_manager_head.php') ?>
	</head>

	<body>
		<?php include('./../includes/tag_manager_body.php') ?>

		<!-- WhatsApp -->
	  <?php

	  	$whatsapp_enabled = $app->whatsappEnabled();
			
			if ( $whatsapp_enabled ) {
				
		  	echo "
				<script>
					window.rubro = '". RUBRO ."';
				</script>
				";

		  	$whatsapp = $db->getRepositorioSalesWhastsapp()->getCurrentWhatsappNumberByRubro(RUBRO, EMAIL_VENTAS_CERAMICOS);
			 	include_once("./../includes/wapp.php");

			}

		?>

		<!-- Header -->
		<?php include_once( __DIR__ . '/../includes/header.php' );  ?>
		
		<!-- Imagen Destacada -->
		<section class="container-fluid imagen_destacada">

			<!-- Mejores Marcas -->
			<div class="mejores_marcas wow fadeInRight">
				<img class="img-fluid" src="img/marcas.png" alt="mejores marcas porcelanatos">
				<div>
					<p>las <span>mejores</span> <br> marcas del <br> mercado</p>
				</div>
			</div>
			<!-- Mejores Marcas end -->

			<!-- Informacion -->
			<div class="container">
				<div class="row">

					<div class="col-md-12">
						<h1 class="wow fadeInDown">CERÁMICOS</h1>

						<p class="wow fadeInLeft promocion">¡Pagá en cuotas!</p>
						<p class="wow fadeInLeft cuotas">
							Comprá tus pisos en hasta 18 cuotas <br>
							<span>Comunicate con nosotros y conocé más detalles</span>
						</p>

						<!-- Formulario -->
						<form id="formulario" method="post" class="needs-validation wow fadeInUp" novalidate>

							<?php include_once( __DIR__ . '/../includes/hidden-inputs.php' ); ?>

							<?php include_once( __DIR__ . '/../includes/errors.php' ); ?>

							<p class="leyenda_presupuesta">Presupuestá Ahora!</p>

							<?php include_once( __DIR__ . '/../includes/input-name.php' ); ?>
							<?php include_once( __DIR__ . '/../includes/input-email.php' ); ?>
							<?php include_once( __DIR__ . '/../includes/input-phone.php' ); ?>
							<?php include_once( __DIR__ . '/../includes/input-comments.php' ); ?>
							<?php include_once( __DIR__ . '/../includes/input-recaptcha.php' ); ?>
							<?php include_once( __DIR__ . '/../includes/input-newsletter.php' ); ?>
							<?php include_once( __DIR__ . '/../includes/input-submit.php' ); ?>

						</form>
						<!-- Formulario end -->

					</div>

				</div>
			</div>
			<!-- Informacion end -->

		</section>
		<!-- Imagen Destacada -->

		<!-- Galeria -->
		<?php include_once( __DIR__ . '/../includes/galeria-ceramicos.inc.php' );  ?>

		<!-- Faja Naranja -->
		<section class="container-fluid faja_naranja">
			<div class="container">
				<div class="row">
					<div class="col-md-10 m-auto col-lg-12">
						<p class="wow fadeInUp">
							<strong>Depisos.com</strong> en cerámicos te ofrecemos la variedad más amplia de texturas y colores del mercado y las mejores marcas para crear los ambientes <strong>MÁS AGRADABLES.</strong><br>
							Trabajamos con Cerámicos de primera y segunda calidad.
						</p>
					</div>
				</div>
			</div>
		</section>
		<!-- Faja Naranja end -->

		<!-- Líneas -->
		<section class="container lineas">
			
			<div class="row">
				<div class="col-md-12 wow fadeInUp">
					<h2>LÍNEA COMPLETA <span>CERRO NEGRO</span></h2>
				</div>
			</div>

			<div class="row wow fadeInUp">

				<div class="col-md-6">
					<img class="img-fluid" src="img/ceramicos-cerro-negro-a.jpg" alt="ceramicos de primera y segunda calidad. las mejores marcas importadas -a">
				</div>
				<div class="col-md-6">
					<img class="img-fluid" src="img/ceramicos-cerro-negro-b.jpg" alt="ceramicos de primera y segunda calidad. las mejores marcas importadas -b">
				</div>
				<div class="col-md-6">
					<img class="img-fluid" src="img/ceramicos-cerro-negro-c.jpg" alt="ceramicos de primera y segunda calidad. las mejores marcas importadas -c">
				</div>
				<div class="col-md-6">
					<img class="img-fluid" src="img/ceramicos-cerro-negro-d.jpg" alt="ceramicos de primera y segunda calidad. las mejores marcas importadas -d">
				</div>
				
			</div>

		</section>
		<!-- Líneas end -->

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
							<img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 1">
							<p>Rápida instalación</p>
						</li>
						<li>
							<img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 2">
							<p>Fácil limpieza</p>
						</li>
					</ul>
				</div>

				<div class="col-md-6">
					<ul>
						<li>
							<img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 3">
							<p>Alta durabilidad</p>
						</li>
						<li>
							<img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 4">
							<p>Variedad de colores</p>
						</li>
					</ul>
				</div>

			</div>

			<div class="row beneficios">

				<div class="col-4 wow fadeInLeft">
					<img class="img-fluid" src="img/presupuesto-sin-cargo.png" alt="pisos porcelanatos presupuestos sin cargo">
					<p>Presupuestos Sin cargo</p>
				</div>

				<div data-wow-delay="0.3s" class="col-4 wow fadeInLeft">
					<img class="img-fluid" src="img/cuotas-fijas.png" alt="pisos porcelanatos Cuotas fijas en pesos">
					<p>Ahora 12 Cuotas fijas en pesos</p>
				</div>

				<div data-wow-delay="0.6s" class="col-4 wow fadeInLeft">
					<img class="img-fluid" src="img/importadores-directos.png" alt="pisos porcelanatos Importadores Directos">
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
						<h2><span>CERÁMICOS:</span> APLICACIONES RECOMENDADAS</h2>
						<p>
							Colocado en baños, cocinas, salas, tiendas y muchos otros sitios los cerámicos son la opción ideal por su relación costo-beneficio. Crean ambientes de alta calidad y gran resistencia. <br> <strong>Aptos para alto tránsito.</strong>
						</p>
						<p class="dudas">¿TENÉS DUDAS O CONSULTAS?</p>
						<a href="#formulario" class="btn btn-primary transition btn_to_form">CONTACTANOS</a>
					</div>
				</div>
			</div>
		</section>
		<!-- Aplicaciones end -->

		<!-- Footer -->
		<?php include_once( __DIR__ . '/../includes/footer.php' );  ?>

		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<script src="./../dist/main.js"></script>

	</body>
</html>