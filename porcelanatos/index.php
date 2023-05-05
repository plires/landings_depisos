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
		<meta name="description" content="Pisos porcelanatos. Colores naturales. Las mejores marcas y el mejor precio del mercado">
		<meta name="author" content="Librecomunicacion">

	  <!-- Favicons -->
	  <?php include('./../includes/favicon.inc.php'); ?>
	  
		<title>Porcelanatos. Las mejores marcas. Nacionales e importados</title>
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

		  	$whatsapp = $db->getRepositorioSalesWhastsapp()->getCurrentWhatsappNumberByRubro(RUBRO, EMAIL_VENTAS_PORCELANATOS);
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
						<h1 class="wow fadeInDown">PORCELANATOS</h1>

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

		<!-- Promo Mayo -->
		<section class="promo_mayo container">
			<div class="row">
				<div class="col-sm-6 col-lg-4 content">
					<img class="img-fluid" src="./img/promo-mayo/porcelanicos-1.jpg" alt="porcelanicos 1">
					<a href="#formulario" class="btn btn-primary transition btn_to_form">COMPRAR</a>
				</div>
				<div class="col-sm-6 col-lg-4 content">
					<img class="img-fluid" src="./img/promo-mayo/porcelanicos-2.jpg" alt="porcelanicos 2">
					<a href="#formulario" class="btn btn-primary transition btn_to_form">COMPRAR</a>
				</div>
				<div class="col-sm-6 col-lg-4 content">
					<img class="img-fluid" src="./img/promo-mayo/porcelanicos-3.jpg" alt="porcelanicos 3">
					<a href="#formulario" class="btn btn-primary transition btn_to_form">COMPRAR</a>
				</div>
				<div class="col-sm-6 col-lg-4 content">
					<img class="img-fluid" src="./img/promo-mayo/porcelanicos-4.jpg" alt="porcelanicos 4">
					<a href="#formulario" class="btn btn-primary transition btn_to_form">COMPRAR</a>
				</div>
				<div class="col-sm-6 col-lg-4 content">
					<img class="img-fluid" src="./img/promo-mayo/porcelanicos-5.jpg" alt="porcelanicos 5">
					<a href="#formulario" class="btn btn-primary transition btn_to_form">COMPRAR</a>
				</div>
				<div class="col-sm-6 col-lg-4 content">
					<img class="img-fluid" src="./img/promo-mayo/porcelanicos-6.jpg" alt="porcelanicos 6">
					<a href="#formulario" class="btn btn-primary transition btn_to_form">COMPRAR</a>
				</div>
			</div>
		</section>
		<!-- Promo Mayo end -->

		<!-- Líneas -->
		<section class="container lineas">
			
			<div class="row">
				<div class="col-md-12 wow fadeInUp">
					<h2>NUESTRAS <span>LÍNEAS</span></h2>
				</div>
			</div>

			<div class="row wow fadeInUp">
				<div class="col-md-6">
					<img class="img-fluid" src="img/linea-cerro-negro.jpg" alt="linea porcelanatos cerro negro">
					<h3>CERRO NEGRO</h3>
				</div>
				<div class="col-md-6">
					<img class="img-fluid" src="img/linea-importados.jpg" alt="linea porcelanatos importados">
					<h3>IMPORTADOS</h3>
				</div>
			</div>

		</section>
		<!-- Líneas end -->

		<!-- Faja Naranja -->
		<section class="container-fluid faja_naranja">
			<div class="container">
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<p class="wow fadeInUp">
							<span>Depisos.com</span> te ofrece la variedad más amplia de texturas y colores del mercado y las mejores marcas para crear los ambientes <span>MÁS AGRADABLES.</span>
						</p>
					</div>
				</div>
			</div>
		</section>
		<!-- Faja Naranja end -->

		<!-- Anti Manchas -->
		<section class="container-fluid anti_manchas">
			<div class="container">
				<div class="row">
					<div class="col-md-6 m-auto">
						<img class="wow fadeInLeft img-fluid" src="img/icono-sin-manchas.png" alt="porcelanatos anti manchas">
						<p class="wow fadeInUp">¡ÚNICOS <span>ANTIMANCHAS</span> DEL MERCADO!</p>
					</div>
				</div>
			</div>
		</section>
		<!-- Anti Manchas end -->

		<!-- Galeria -->
		<?php include_once( __DIR__ . '/../includes/galeria-porcelanatos.inc.php' );  ?>

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
							<p>Resistentes a golpes y arañazos</p>
						</li>
					</ul>
				</div>

				<div class="col-md-6">
					<ul>
						<li>
							<img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 3">
							<p>Unicos antimanchas</p>
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
						<h2><span>PORCELANATOS:</span> APLICACIONES RECOMENDADAS</h2>
						<p>
							Colocado en baños, cocinas, salas, tiendas y muchos otros sitios el porcelanato se ha convertido en un material muy buscado y utilizado por decoradores, y constructoras para crear un sinfín de ambientes con acabados de lujo, óptima calidad y gran resistencia. <span>Aptos para alto tránsito.</span>
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