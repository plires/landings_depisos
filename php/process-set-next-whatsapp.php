<?php
  header('Access-Control-Allow-Origin: *');
  header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
  header("Allow: GET, POST, OPTIONS, PUT, DELETE");
  $method = $_SERVER['REQUEST_METHOD'];

  if($method == "OPTIONS") {
    die();
  }
  
  require_once( __DIR__ . '/../vendor/autoload.php' );
  include_once( __DIR__ . '/../clases/repositorioSQL.php' );
    
  $require = json_decode(file_get_contents('php://input'));

  $dotenv = Dotenv\Dotenv::createImmutable( __DIR__ . '/../' );
  $dotenv->safeLoad();
  
  $db = new RepositorioSQL();

  $rubro = $db->getRepositorioSellers()->getRubroByName($require->rubro);
  
  $array_email_sales = $db->getRepositorioSalesWhastsapp()->getArrayEmailsSales($rubro['id']);
  
  $db->getRepositorioSalesWhastsapp()->setNextWhatsappNumberByRubro($rubro['id'], $array_email_sales);
  
?>