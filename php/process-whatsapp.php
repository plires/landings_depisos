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
  require_once( __DIR__ . '/../clases/app.php' );
  include_once( __DIR__ . '/../clases/repositorioSQL.php' );
    
  $response_array = [
    'success' => false,
    'data' => [],
    'errors' => []
  ];
  
  $require = json_decode(file_get_contents('php://input'));
  
  $dotenv = Dotenv\Dotenv::createImmutable( __DIR__ . '/../' );
  $dotenv->safeLoad();
  
  $db = new RepositorioSQL();
  $app = new App();

  $whatsapp_enabled = $app->whatsappEnabled();
    
  if ( $whatsapp_enabled ) {
    
    try {
      $emails = $db->getRepositorioContacts()->getSalesEmails($require->rubro);
      $whatsapp = $db->getRepositorioSalesWhastsapp()->getCurrentWhatsappNumberByRubro($require->rubro, $emails);
  
      $response_array['success'] = true;
      $response_array['data'] = $whatsapp;
    } catch (\Throwable $th) {
      $response_array['errors'] = $th;
    }

  }

  echo json_encode($response_array);exit;

?>