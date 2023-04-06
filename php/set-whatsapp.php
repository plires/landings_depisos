<?php
	
	include_once( __DIR__ . '/../ventas.inc.php' );
	include_once( __DIR__ . '/../vendor/autoload.php' );
	include_once( __DIR__ . '/../clases/repositorioSQL.php' );

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../" );
  $dotenv->load(); 

  $data = json_decode(file_get_contents('php://input'), true);
	$rubro = $data['rubro'];

	$db = new RepositorioSQL();

	$array_email_sales = $db->getRepositorioSalesWhastsapp()->getArrayEmailsSales($rubro);

	$db->getRepositorioSalesWhastsapp()->setNextWhatsappNumberByRubro($rubro, $array_email_sales);

?>