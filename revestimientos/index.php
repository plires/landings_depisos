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
		<meta name="description" content="Linea de revestimientos para paredes. Exteriores e interiores">
		<meta name="author" content="Librecomunicacion">

	  <!-- Favicons -->
	  <?php include('./../includes/favicon.inc.php'); ?>
	  
		<title>Revestimientos para Paredes Exteriores e Interiores | Depisos.com</title>
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

	  	$whatsapp = $db->getRepositorioSalesWhastsapp()->getCurrentWhatsappNumberByRubro(RUBRO, EMAIL_VENTAS_REVESTIMIENTOS);
		 	include_once("./../includes/wapp.php") 
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
						<h1 class="wow fadeInDown">REVESTIMIENTOS<br><span>INTERIOR/EXTERIOR</span></h1>

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
					<h2>NUESTRAS <span>LÍNEAS</span></h2>
				</div>
			</div>

			<div class="row wow fadeInUp">
				<div class="col-md-4">
					<img class="img-fluid" src="img/linea-siding.jpg" alt="revestimiento de pared siding">
					<h3>SIDING</h3>
				</div>
				<div class="col-md-4">
					<img class="img-fluid" src="img/linea-wall-panel.jpg" alt="revestimiento de pared wall panel">
					<h3>WALL PANEL</h3>
				</div>
				<div class="col-md-4">
					<img class="img-fluid" src="img/linea-perfiles.jpg" alt="revestimiento de pared perfiles">
					<h3>PERFILES</h3>
				</div>
			</div>

			<div class="row wow fadeInUp">
				<div class="col-lg-8 mx-auto">
					<p class="parrafo">
						Además contamos con una completa línea de accesorios: Ángulos, Fijaciones, Tornillos.
					</p>
				</div>
			</div>

		</section>
		<!-- Líneas end -->

		<!-- Faja Naranja -->
		<section class="container-fluid faja_naranja">
			<div class="container">
				<div class="row">
					<div class="col-md-10 m-auto col-lg-12">
						<p class="wow fadeInUp">
							Los revestimientos están desarrollados en WPC, lo que los convierte en productos de <span>LIBRE MANTENIMIENTO,</span> ideales para soluciones definitivas en paredes de exterior e interior.
						</p>
					</div>
				</div>
			</div>
		</section>
		<!-- Faja Naranja end -->

		<!-- Faja Revestimientos -->
		<section class="container-fluid faja_revestimientos p-0">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<a href="#formulario" class="btn_to_form">
							<img id="img_revestimientos" class="wow fadeInUp img-fluid" src="#" alt="revestimientos de paredes resistentes al sol ejemplos">
						</a>
					</div>
				</div>
			</div>
		</section>
		<!-- Faja Revestimientos end -->

		<!-- Resistentes al Sol -->
		<section class="container-fluid anti_sol">
			<div class="container">
				<div class="row">
					<div class="col-md-10 m-auto">
						<img class="wow fadeInLeft img-fluid" src="img/icono-resistente-sol.png" alt="revestimientos de paredes resistentes al sol">
						<p class="wow fadeInUp">Se trata de un <span>material inalterable,</span> resistente al sol, al calor y humedad extrema, que <span>no se deforma.</span></p>
					</div>
				</div>
			</div>
		</section>
		<!-- Resistentes al Sol end -->

		<!-- Galeria -->
		<?php include_once( __DIR__ . '/../includes/galeria-revestimiento.inc.php' );  ?>

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
							<p>Resistentes 100% al agua</p>
						</li>
						<li>
							<img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 2">
							<p>Terminación perfecta</p>
						</li>
					</ul>
				</div>

				<div class="col-md-6">
					<ul>
						<li>
							<img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 3">
							<p>Resistentes 100% al calor</p>
						</li>
						<li>
							<img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 4">
							<p>Colores naturales</p>
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
						<h2><span>REVESTIMIENTOS:</span> APLICACIONES RECOMENDADAS</h2>
						<p>
							Ideal para renovar o resaltar fachadas, muros y grandes superficies. <br>Tambien utilizados en interiores otorgando un efecto único y dependiendo del diseño seleccionado, pueden cambiar por completo un ambiente <span>Solución rápida y ecológica.</span>
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