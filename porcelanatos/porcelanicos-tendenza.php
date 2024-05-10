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

  $origin = 'Landing Porcelanicos Tendenza';

	include_once( __DIR__ . '/../includes/handle-form-submit.php' );
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description"
    content="Pisos de porcelanatos. Colores naturales. Las mejores marcas y el mejor precio del mercado">
  <meta name="author" content="Librecomunicacion">

  <!-- Favicons -->
  <?php include('./../includes/favicon.inc.php'); ?>

  <title>Pisos de Porcelanicos Tendenza. Las mejores marcas. Nacionales e importados</title>
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
  <section class="container-fluid imagen_destacada imagen_tendenza">

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
          <h1 class="wow fadeInDown">PORCELANATOS Y PORCELÁNICOS</h1>

          <img class="img-fluid" src="./../img/super-hot.png" alt="promo">

          <p class="wow fadeInLeft promocion">¡Pagá en cuotas!</p>


          <p class="wow fadeInLeft cuotas">
            Comprá tus pisos en hasta 12 cuotas <br>
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

  <!-- Faja Tendenza -->
  <section class="container-fluid faja_vite faja_tendenza">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="wow fadeInUp">CONOCÉ LOS NUEVOS <br> <span>PORCELÁNICOS TENDENZA</span></h2>

          <p class="intro_tendenza">
            Los porcelánicos de Tendenza tienen una excelente relación precio - calidad, un
            producto con similares características que el porcelanato pero más económico.
            Pulidos y rectificados, aptos para uso doméstico interior se ajustan perfectamente
            a las exigencias del usuario, siendo ideales para baños, cocinas, comedores y livings.
          </p>
        </div>
      </div>
    </div>

    <div class="container-fluid imgs">
      <div class="row">
        <div class="col-6 col-md-3 content_img">
          <img class="img-fluid" src="./img/tendenza/porcelanico-tendenza-a.jpg" alt="porcelanicos tendenza a">
        </div>
        <div class="col-6 col-md-3 content_img">
          <img class="img-fluid" src="./img/tendenza/porcelanico-tendenza-b.jpg" alt="porcelanicos tendenza b">
        </div>
        <div class="col-6 col-md-3 content_img">
          <img class="img-fluid" src="./img/tendenza/porcelanico-tendenza-c.jpg" alt="porcelanicos tendenza c">
        </div>
        <div class="col-6 col-md-3 content_img">
          <img class="img-fluid" src="./img/tendenza/porcelanico-tendenza-d.jpg" alt="porcelanicos tendenza d">
        </div>
      </div>

    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="extras">
            <div class="content">
              <img class="img-fluid" src="./img/tendenza/simbolo-peso.png" alt="simbolo pesos">
              <p class="precio">Contamos con el mejor precio <br> de porcelánicos del mercado</p>
            </div>
            <p class="parrafo_final">Porcelánicos Tendenza | 20 x 120 x 1 cm | Pulidos/Rectificados </p>
          </div>
          <div class="content_vite">
            <p>
              <span>Contamos con diseños modernos y actuales:</span>
              Texturas y colores que son tendencia, sorprendente imitacón madera
              en sus modelos Forest; Ebony; Larch; Dreamed; Cinnamon; Brushed white
              y muchos más.
            </p>
          </div>
        </div>
      </div>
    </div>


  </section>
  <!-- Faja Tendenza end -->

  <!-- Líneas -->
  <?php include('./includes/lineas-porcelanatos.php'); ?>

  <!-- Faja Naranja -->
  <section class="container-fluid faja_naranja">
    <div class="container">
      <div class="row">
        <div class="col-md-10 offset-md-1">
          <p class="wow fadeInUp">
            <span>Depisos.com</span> te ofrece la variedad más amplia de texturas y colores del mercado y las mejores
            marcas para crear los ambientes <span>MÁS AGRADABLES.</span> <br>
            <span>Consultá Ofertas Semanales de Porcelanatos</span>
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
          <li>
            <img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 4">
            <p>Porcelanatos Simil Madera</p>
          </li>
          <li>
            <img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 5">
            <p>Porcelanatos Simil Cemento</p>
          </li>
          <li>
            <img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 6">
            <p>Porcelanatos Simil Piedra</p>
          </li>
          <li>
            <img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 3">
            <p>El Porcelanato más Economico del Mercado</p>
          </li>
        </ul>
      </div>

      <div class="col-md-6">
        <ul>
          <li>
            <img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 7">
            <p>Unicos antimanchas</p>
          </li>
          <li>
            <img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 8">
            <p>Colores naturales</p>
          </li>
          <li>
            <img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 9">
            <p>Porcelanato pulido y Rectificado</p>
          </li>
          <li>
            <img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 10">
            <p>Porcelanatos Simil Marmol</p>
          </li>
          <li>
            <img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 11">
            <p>Porcelanatos Simil Calcareos</p>
          </li>
          <li>
            <img class="img-fluid" src="img/tilde.png" alt="porcelanatos tilde 12">
            <p>Porcelanatos de Primera y Segunda Calidad</p>
          </li>
        </ul>
      </div>

    </div>

    <div class="row beneficios">

      <div class="col-4 wow fadeInLeft">
        <img class="img-fluid" src="img/presupuesto-sin-cargo.png" alt="pisos de porcelanatos presupuestos sin cargo">
        <p>Presupuestos Sin cargo</p>
      </div>

      <div data-wow-delay="0.3s" class="col-4 wow fadeInLeft">
        <img class="img-fluid" src="img/cuotas-fijas.png" alt="pisos de porcelanatos Cuotas fijas en pesos">
        <p>Ahora 12 Cuotas fijas en pesos</p>
      </div>

      <div data-wow-delay="0.6s" class="col-4 wow fadeInLeft">
        <img class="img-fluid" src="img/importadores-directos.png" alt="pisos de porcelanatos Importadores Directos">
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
          <h2><span>PISOS PORCELANATOS:</span> APLICACIONES RECOMENDADAS</h2>
          <p>
            Porcelanatos para baños, para cocinas cocinas, salas, tiendas y muchos otros sitios.
            El porcelanato se ha convertido en un material muy buscado y utilizado por decoradores, y constructoras para
            crear un sinfín de ambientes con acabados de lujo, óptima calidad y gran resistencia. <span>Aptos para alto
              tránsito.</span>
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