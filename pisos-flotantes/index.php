<?php
include_once(__DIR__ . '/includes/config.inc.php');
include_once(__DIR__ . '/../vendor/autoload.php');
include_once(__DIR__ . '/../includes/funciones_validar.php');
include_once(__DIR__ . '/../clases/repositorioSQL.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

include_once(__DIR__ . '/../includes/handle-variables-config.php');
include_once(__DIR__ . '/../includes/handle-form-submit.php');

$stores = $db->getRepositorioSellers()->getAllStores();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description"
    content="Pisos flotantes a prueba de agua. Colores simil madera. Las mejores marcas en pisos y el mejor precio del mercado">
  <meta name="author" content="Librecomunicacion">

  <!-- Favicons -->
  <?php include('./../includes/favicon.inc.php'); ?>

  <title>Pisos flotantes. Pisos a prueba de agua</title>
  <link rel="stylesheet" href="./css/app.css">

  <?php include('./../includes/tag_manager_head.php') ?>
</head>

<body>
  <?php include('./../includes/tag_manager_body.php') ?>

  <!-- WhatsApp -->
  <?php

  $whatsapp_enabled = $db->getRepositorioApp()->whatsappEnabled();

  if ($whatsapp_enabled) {

    echo "
				<script>
					window.rubro = '" . RUBRO . "';
				</script>
				";

    $whatsapp = $db->getRepositorioSalesWhastsapp()->getCurrentWhatsappNumberByRubro($db, RUBRO);
    include_once("./../includes/wapp.php");
  }

  ?>

  <!-- Header -->
  <?php include_once(__DIR__ . '/../includes/header.php');  ?>

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

          <!-- <p class="wow fadeInLeft promocion">¡Pagá en cuotas!</p> -->

          <p class="wow fadeInLeft cuotas">
            Comprá tus pisos con los mejores precios <br>
            <span>Comunicate con nosotros y conocé más detalles</span>
          </p>

          <!-- Formulario -->
          <form id="formulario" method="post" class="needs-validation wow fadeInUp" novalidate>

            <?php include_once(__DIR__ . '/../includes/hidden-inputs.php'); ?>

            <?php include_once(__DIR__ . '/../includes/errors.php'); ?>

            <p class="leyenda_presupuesta">Presupuestá Ahora!</p>

            <?php include_once(__DIR__ . '/../includes/input-name.php'); ?>
            <?php include_once(__DIR__ . '/../includes/input-email.php'); ?>
            <?php include_once(__DIR__ . '/../includes/input-phone.php'); ?>
            <?php include_once(__DIR__ . '/../includes/input-comments.php'); ?>
            <?php include_once(__DIR__ . '/../includes/input-store.php'); ?>
            <?php include_once(__DIR__ . '/../includes/input-recaptcha.php'); ?>
            <?php include_once(__DIR__ . '/../includes/input-newsletter.php'); ?>
            <?php include_once(__DIR__ . '/../includes/input-submit.php'); ?>

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
        <h2>PISOS A PRUEBA DE AGUA: <span>LÍNEAS</span></h2>
      </div>
    </div>

    <div class="row wow fadeInUp">
      <div class="col-md-4">
        <img class="img-fluid" src="img/piso-vinilico-para-pegar.jpg" alt="pisos a prueba de agua sistema para pegar">
        <h3>SISTEMA PARA PEGAR</h3>
      </div>
      <div class="col-md-4">
        <img class="img-fluid" src="img/piso-vinilico-sistema-click.jpg" alt="pisos flotantes de agua sistema click">
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
          <p class="wow fadeInUp"><span>Depisos.com</span> te ofrece la variedad más amplia del mercado y las mejores
            marcas para crear los ambientes <span>MÁS AGRADABLES</span>.</p>
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
          <img class="img-fluid" src="img/sistema-click.png" alt="sistema click en pisos a prueba de agua">
        </h4>
        <p>DISPONIBLES EN DOS FORMATOS:</p>
        <img class="img-fluid liston_baldosa" src="img/liston-baldosa.jpg" alt="pisos flotantes en listones y baldosas">
      </div>
    </div>
  </section>
  <!-- Tipologia end -->

  <!-- Galeria -->
  <?php include_once(__DIR__ . '/../includes/galeria-pisos.inc.php');  ?>

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
            <img class="img-fluid" src="img/tilde.png" alt="pisos flotantes tilde 1">
            <p>Resistentes 100% al agua</p>
          </li>
          <li>
            <img class="img-fluid" src="img/tilde.png" alt="pisos flotantes tilde 2">
            <p>Resistentes a golpes y arañazos</p>
          </li>
        </ul>
      </div>

      <div class="col-md-6">
        <ul>
          <li>
            <img class="img-fluid" src="img/tilde.png" alt="pisos flotantes tilde 3">
            <p>Rápida y fácil instalación</p>
          </li>
          <li>
            <img class="img-fluid" src="img/tilde.png" alt="pisos flotantes tilde 4">
            <p>Aislamiento acústico y térmico</p>
          </li>
        </ul>
      </div>

    </div>

    <div class="row beneficios">

      <div class="col-6 wow fadeInLeft">
        <img class="img-fluid" src="img/presupuesto-sin-cargo.png" alt="pisos a prueba de agua presupuestos sin cargo">
        <p>Presupuestos Sin cargo</p>
      </div>

      <!-- <div data-wow-delay="0.3s" class="col-4 wow fadeInLeft">
        <img class="img-fluid" src="img/cuotas-fijas.png" alt="pisos a prueba de agua Cuotas fijas en pesos">
        <p>Ahora 12 Cuotas fijas en pesos</p>
      </div> -->

      <div data-wow-delay="0.6s" class="col-6 wow fadeInLeft">
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
            Los pisos vinílicos son ideales para entornos comerciales y domésticos. Desarrollados con materiales de
            primera calidad. <br> <span>Aptos para alto tránsito.</span>
          </p>
          <p class="dudas">¿TENÉS DUDAS O CONSULTAS?</p>
          <a href="#formulario" class="btn btn-primary transition btn_to_form">CONTACTANOS</a>
        </div>
      </div>
    </div>
  </section>
  <!-- Aplicaciones end -->

  <!-- Footer -->
  <?php include_once(__DIR__ . '/../includes/footer.php');  ?>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="./../dist/main.js"></script>

</body>

</html>