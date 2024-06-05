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

$response_array = [
  'success' => false,
  'data' => [],
  'errors' => []
];
  
$require = json_decode(file_get_contents('php://input'));

$dotenv = Dotenv\Dotenv::createImmutable( __DIR__ . '/../' );
$dotenv->safeLoad();

$db = new RepositorioSQL();

try {
  $stores = $db->getRepositorioSellers()->getAllStores();

  $response_array['success'] = true;
  $response_array['data'] = $stores;
} catch (\Throwable $th) {
  $response_array['errors'] = $th;
}

echo json_encode($response_array);exit;

?>