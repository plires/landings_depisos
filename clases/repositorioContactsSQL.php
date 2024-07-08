<?php

require_once("repositorioContacts.php");
require_once("repositorioSellers.php");

class RepositorioContactsSQL extends repositorioContacts
{
  protected $conexion;

  public function __construct($conexion)
  {
    $this->conexion = $conexion;
  }

  public function userFound($email, $store)
  {

    try {
      $stmt = $this->conexion->prepare("SELECT * FROM landings WHERE email = :email AND store = :store ORDER BY id DESC LIMIT 1");
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':store', $store);
      $stmt->execute();

      // Obtener el resultado como un arreglo asociativo
      $registro = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($registro) {
        // El registro fue encontrado, por lo tanto se devuelve
        return $registro['to_email'];
      } else {
        // No se encontró ningún registro con el email especificado
        return null;
      }
    } catch (PDOException $e) {
      $message = $e->getMessage();

      $db = new RepositorioSQL();
      $db->getRepositorioApp()->notificationsToEmail("<h1>Error al verificar si el usuario ya consultó anteriormente.</h1><h2>Email Usuario: $email</h2><h2>Store: $store</h2><h2>Tabla: 'landings'</h2><h2>Descripción: $message </h2>", __FUNCTION__, __FILE__, __LINE__);
      return null;
    }
  }

  public function saveInBDD($post)
  {

    if (is_object($post)) {
      $post = (array) $post;
    }

    if (isset($post['newsletter'])) {
      $newsletter = 'Si';
    } else {
      $newsletter = 'No';
    }

    // verificar si el usuario ya consulto anteriormente.
    $userFound = $this->userFound($post['email'], $post['store']);
    
    // Obtener el vendedor a asignar a este usuario
    $emailTo = $this->getSellerForThisUser($post['rubro'], $userFound, $post['store']);
    
    $sql = "INSERT INTO landings values(default, :name, :email, :phone, :comments, :newsletter, :origin, :rubro, :to_email, :store, :utm_source, :utm_medium, :utm_campaign, :utm_content, :date)";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(":name", $post['name'], PDO::PARAM_STR);
    $stmt->bindValue(":email", $post['email'], PDO::PARAM_STR);
    $stmt->bindValue(":phone", $post['phone'], PDO::PARAM_STR);
    $stmt->bindValue(":comments", $post['comments'], PDO::PARAM_STR);
    $stmt->bindValue(":newsletter", $newsletter, PDO::PARAM_STR);
    $stmt->bindValue(":origin", $post['origin'], PDO::PARAM_STR);
    $stmt->bindValue(":rubro", $post['rubro'], PDO::PARAM_STR);
    $stmt->bindValue(":to_email", $emailTo['email'], PDO::PARAM_STR);
    $stmt->bindValue(":store", (int)$post['store'], PDO::PARAM_INT);
    $stmt->bindValue(":utm_source", $post['utm_source'], PDO::PARAM_STR);
    $stmt->bindValue(":utm_medium", $post['utm_medium'], PDO::PARAM_STR);
    $stmt->bindValue(":utm_campaign", $post['utm_campaign'], PDO::PARAM_STR);
    $stmt->bindValue(":utm_content", $post['utm_content'], PDO::PARAM_STR);
    $stmt->bindValue(":date", date("F j, Y, g:i a"), PDO::PARAM_STR);

    $stmt->execute();

    return $emailTo;
  }

  public function getSalesEmails($rubro, $store_id)
  {

    $db = new RepositorioSQL();
    $rubro = $db->getRepositorioSellers()->getRubroByName($rubro);
    $team = $db->getRepositorioSellers()->getTeamByRubroAndStore($rubro['id'], $store_id);
    $sellers = $db->getRepositorioSellers()->getSellersById($team['sellers']);
    
    return $sellers;
  }

  public function setNextSellerByRubroAndStore($rubro, $store, $next_position)
  {

    try {
      // Iniciar una transacción
      $this->conexion->beginTransaction();

      // Obtener la posición actual del array desde la base de datos
      $sql = 'UPDATE landing_form SET current_position=:current_position WHERE rubro_id= '. $rubro['id'] .' AND store_id='. (int)$store .' ';
      $stm = $this->conexion->prepare($sql);
      $stm->execute(array(':current_position' => $next_position));
      $row = $stm->fetch(PDO::FETCH_ASSOC);

      // Confirmar la transacción
      $this->conexion->commit();
      return true;

    } catch (\Throwable $th) {
      $name_rubro = $rubro['name'];
      $message = $th->getMessage();

      $db = new RepositorioSQL();
      $db->getRepositorioApp()->notificationsToEmail("<h1>Error en el intentar setear el proximo vendedor pra recibir consultas via formulario.</h1><h2>Rubro: $name_rubro</h2><h2>Store: $store</h2><h2>Tabla: 'landing_form'</h2><h2>Descripción: $message </h2>",  __FUNCTION__, __FILE__, __LINE__);
    }
    
  }

  public function getNextSellerByRubroAndStore($salesEmails, $rubro, $store)
  {

    $sql = "select * from landing_form WHERE rubro_id='" . $rubro['id'] . "' AND store_id= '" . (int)$store . "' "; // Obtenemos el ultimo registro del rubro
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute();
    $seller = $stmt->fetch(PDO::FETCH_ASSOC);

    $last_seller = array_slice($salesEmails, $seller['current_position'], 1);
    
    if ( empty($last_seller) ) {
      $seller_to_return = $salesEmails[0]; // devolver el primero del array de ventas
      $set_next_position = $this->setNextSellerByRubroAndStore($rubro, $store, 1); // setear la proxima posicion en tabla landing_form
    } else {
      $seller_to_return = $last_seller[0]; // devolver posicion actual del array de ventas
      $set_next_position = $this->setNextSellerByRubroAndStore($rubro, $store, $seller['current_position'] + 1); // setear la proxima posicion en tabla landing_form
    }

    return $seller_to_return;
    
  }

  public function getSellerForThisUser($rubro, $sellerEmailAssignedForThisUser, $store)
  {

    // se asigna un array vacio inicial
    $emailTo = [];

    $salesEmails = $this->getSalesEmails($rubro, $store);

    $db = new RepositorioSQL();
    $rubro = $db->getRepositorioSellers()->getRubroByName($rubro);
    
    // si el usuario ya esta en la base de datos y tenia asignado un vendedor, se intentara asignar nuevamente a este vendedor (si esta disponible en el actual array de ventas al momento de la consulta)
    if ($sellerEmailAssignedForThisUser !== NULL) {

      // recorremos el array de emails de vendedores para ver si el mail del vendedor asignado en su momento,
      // se encurentra presente hoy en el array actual de vendedores (pudo haber pasado que haya sido asignado a un vendedor que ya no trabaje mas)
      foreach ($salesEmails as $seller) {

        if ($seller['email'] === $sellerEmailAssignedForThisUser) {
          $emailTo = $seller; //se vuelve a asignar
          return $emailTo;
        }

      }
      
    }

    // usuario nuevo o ya consulto y el vendedor no existe mas en la lista
    $emailTo = $this->getNextSellerByRubroAndStore($salesEmails, $rubro, $store);
  
    return $emailTo;

  }
}