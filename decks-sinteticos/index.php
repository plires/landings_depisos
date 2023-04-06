<?php
	include_once( __DIR__ . '/includes/config.inc.php' );
	include_once( __DIR__ . '/../vendor/autoload.php' );
	include_once( __DIR__ . '/../includes/funciones_validar.php' );
	include_once( __DIR__ . '/../clases/repositorioSQL.php' );
	include_once( __DIR__ . '/../clases/app.php' );

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
		<meta name="description" content="Decks sintéticos. Fabricado con materiales reciblables. No se pudre ni se astilla. Sin Matenimiento.">
		<meta name="author" content="Librecomunicacion">

	  <!-- Favicons -->
	  <?php include('./../includes/favicon.inc.php'); ?>
	  
		<title>Decks Plásticos sin mantenimiento.</title>
		<link rel="stylesheet" href="./css/app.css">

		<?php include('./../includes/tag_manager_head.php') ?>
	</head>

	<body>
		<?php include('./../includes/tag_manager_body.php') ?>

		<!-- WhatsApp -->
	  <?php

	  	echo "
			<script>
				window.rubro = '". RUBRO ."';
			</script>
			";

	  	$whatsapp = $db->getRepositorioSalesWhastsapp()->getCurrentWhatsappNumberByRubro(RUBRO, EMAIL_VENTAS_DECKS);
		 	include_once("./../includes/wapp.php") 
		?>

		<!-- Header -->
		<?php include_once( __DIR__ . '/../includes/header.php' );  ?>
		
		<!-- Imagen Destacada -->
		<section class="container-fluid imagen_destacada">

			<!-- Mejores Marcas -->
			<div class="mejores_marcas wow fadeInRight">
				<img class="img-fluid" src="img/ecologico.png" alt="deck trex y otras marcas en decks sintéticos">
				<div>
					<p><span>95% <br></span>materiales <br>reciclados.</p>
				</div>
			</div>
			<!-- Mejores Marcas end -->

			<!-- Informacion -->
			<div class="container">
				<div class="row">

					<div class="col-md-12">
						<h1 class="wow fadeInDown">DECKS <span>SINTÉTICOS</span></h1>

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

		<!-- Líneas -->
		<section class="container lineas">
			
			<div class="row">
				<div class="col-md-12 wow fadeInUp">
					<h2>DECKS SINTÉTICOS: <span>LÍNEAS</span></h2>
				</div>
			</div>

			<div class="row wow fadeInUp">
				<div class="col-md-6">
					<img class="img-fluid" src="img/trascend.jpg" alt="deck ecologico y sintetico trascend">
					<h3>TRASCEND</h3>
				</div>
				<div class="col-md-6">
					<img class="img-fluid" src="img/contour.jpg" alt="deck ecologico y sintetico contour">
					<h3>CONTOUR</h3>
				</div>
				<div class="col-md-6">
					<img class="img-fluid" src="img/enhance.jpg" alt="deck ecologico y sintetico enhance">
					<h3>ENHANCE</h3>
				</div>
				<div class="col-md-6">
					<img class="img-fluid" src="img/co-extruded.jpg" alt="deck ecologico y sintetico co-extruded">
					<h3>CO-EXTRUDED</h3>
				</div>
			</div>

		</section>
		<!-- Líneas end -->

		<!-- Faja Naranja -->
		<section class="container-fluid faja_naranja">
			<div class="container">
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<p class="wow fadeInUp"><span>Depisos.com</span> te ofrece la variedad más amplia del mercado y las mejores marcas para crear los espacios 	al aire libre <span>QUE SIEMPRE SOÑASTE.</span>
						</p>
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
						incluye clips de fijación <span>GRATIS</span>
						<img class="img-fluid" src="img/sistema-click.jpg" alt="sistema de fijacion oculta para decks sintéticos">
					</h4>
				</div>
			</div>
		</section>
		<!-- Tipologia end -->

		<!-- Galeria -->
		<?php include_once( __DIR__ . '/../includes/galeria-decks.inc.php' );  ?>

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
							<img class="img-fluid" src="img/tilde.png" alt="deck sintéticos tilde 1">
							<p>Libre de Mantenimiento</p>
						</li>
						<li>
							<img class="img-fluid" src="img/tilde.png" alt="deck sintéticos tilde 2">
							<p>Resistente a la decoloración y las manchas </p>
						</li>
					</ul>
				</div>

				<div class="col-md-6">
					<ul>
						<li>
							<img class="img-fluid" src="img/tilde.png" alt="deck sintéticos tilde 3">
							<p>Superior a la Madera y al deck de PVC</p>
						</li>
						<li>
							<img class="img-fluid" src="img/tilde.png" alt="deck sintéticos tilde 4">
							<p>No se pudre, no se deforma, ni se astilla</p>
						</li>
					</ul>
				</div>

			</div>

			<div class="row beneficios">

				<div class="col-4 wow fadeInLeft">
					<img class="img-fluid" src="img/presupuesto-sin-cargo.png" alt="deck sintéticos presupuestos sin cargo">
					<p>Presupuestos Sin cargo</p>
				</div>

				<div data-wow-delay="0.3s" class="col-4 wow fadeInLeft">
					<img class="img-fluid" src="img/cuotas-fijas.png" alt="deck sintéticos Cuotas fijas en pesos">
					<p>Ahora 12 Cuotas fijas en pesos</p>
				</div>

				<div data-wow-delay="0.6s" class="col-4 wow fadeInLeft">
					<img class="img-fluid" src="img/importadores-directos.png" alt="deck sintéticos Importadores Directos">
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
						<h2>DECKS SINTÉTICOS: APLICACIONES RECOMENDADAS</h2>
						<p>
							Nuestros <span>Decks Ecológicos</span>, vulgarmente conocidos como decks de PVC o decks plásticos, son altamente recomendados para piletas, piscinas, balcones, espacios exteriores, terrazas, revestimiento de fachadas, entre muchos otros usos.
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