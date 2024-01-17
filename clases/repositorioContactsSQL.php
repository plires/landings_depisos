<?php

require_once("repositorioContacts.php");
require_once("../ventas.inc.php");

class RepositorioContactsSQL extends repositorioContacts
{
  protected $conexion;

  public function __construct($conexion) 
  {
    $this->conexion = $conexion;
  }

  public function userFound($email)
  {

    try {
        $stmt = $this->conexion->prepare("SELECT * FROM landings WHERE email = :email ORDER BY id DESC LIMIT 1");
        $stmt->bindParam(':email', $email);
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
    } catch(PDOException $e) {
        // Manejo de errores en caso de fallo en la consulta
        return null;
    }

  }

  public function saveInBDD($post)
  {

    if(is_object($post)) {
      $post = (array) $post;
    }

    if (isset($post['newsletter'])) {
      $newsletter = 'Si';
    } else {
      $newsletter = 'No';
    }

    // verificar si el usuario ya consulto anteriormente.
    $userFound = $this->userFound($post['email']);
    
    // Obtener el vendedor a asignar a este usuario
    $emailTo = $this->getSellerForThisUser($post['rubro'], $userFound);
    
    $sql = "INSERT INTO landings values(default, :name, :email, :phone, :comments, :newsletter, :origin, :rubro, :to_email, :utm_source, :utm_medium, :utm_campaign, :utm_content, :date)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(":name", $post['name'], PDO::PARAM_STR);
        $stmt->bindValue(":email", $post['email'], PDO::PARAM_STR);
        $stmt->bindValue(":phone", $post['phone'], PDO::PARAM_STR);
        $stmt->bindValue(":comments", $post['comments'], PDO::PARAM_STR);
        $stmt->bindValue(":newsletter", $newsletter, PDO::PARAM_STR);
        $stmt->bindValue(":origin", $post['origin'], PDO::PARAM_STR);
        $stmt->bindValue(":rubro", $post['rubro'], PDO::PARAM_STR);
        $stmt->bindValue(":to_email", $emailTo[0], PDO::PARAM_STR);
        $stmt->bindValue(":utm_source", $post['utm_source'], PDO::PARAM_STR);
        $stmt->bindValue(":utm_medium", $post['utm_medium'], PDO::PARAM_STR);
        $stmt->bindValue(":utm_campaign", $post['utm_campaign'], PDO::PARAM_STR);
        $stmt->bindValue(":utm_content", $post['utm_content'], PDO::PARAM_STR);
        $stmt->bindValue(":date", date("F j, Y, g:i a"), PDO::PARAM_STR);
        
    $stmt->execute();

    return $emailTo;

  }

  public function getSalesEmails($rubro)
  {

    switch ($rubro) {

      case 'Ceramicos':
        $emails = EMAIL_VENTAS_CERAMICOS;
        break;
      case 'Piso Vinilico':
        $emails = EMAIL_VENTAS_PISOS;
        break;
      case 'Deck Ecologico':
        $emails = EMAIL_VENTAS_DECKS;
        break;
      case 'Porcelanatos':
        $emails = EMAIL_VENTAS_PORCELANATOS;
        break;
      case 'Revestimientos':
        $emails = EMAIL_VENTAS_REVESTIMIENTOS;
        break;
      case 'Griferias':
        $emails = EMAIL_VENTAS_GRIFERIAS;
        break;
      case 'Cielorrasos Tetovinilico':
        $emails = EMAIL_VENTAS_TETO;
        break;
      default:
        $emails = EMAIL_DEFAULT;
        break;

    }

    return $emails;

  }

  public function getSellerForThisUser($rubro, $userFound)
  {

    // se asigna un array vacio inicial
    $emailTo = [];

    $salesEmails = $this->getSalesEmails($rubro);
    
    // si el usuario ya esta en la base de datos y tenia asignado un vendedor, se intentara asignar nuevamente a este vendedor (si esta dipsponible en el actual array de ventas al momento de la consulta)
    if ($userFound !== null) { 
      
      // recorremos el array de emails de vendedores para ver si el mail del vendedor asignado en su momento,
      // se encurentra presente hoy en el array actual de vendedores (pudo haber pasado que haya sido asignado a un vendedor que ya no trabaje mas)
      foreach ($salesEmails as $seller) { 

        // Si el mail del vendedor asignado al usuario se encuentra en este momento en el array de vendedores actual 
        if ($seller[0] === $userFound ) { 
          $emailTo = $seller; //se vuelve a asignar
        }
      }

      // si el array sigue vacio quiere decir que el vendedor asignado a este usuario ya no se encuentra en el array actual de ventas para este rubro
      if ( empty($emailTo)) { 
        $emailTo = $salesEmails[0]; // con lo cual, simplemente asignamos el primer vendedor disponible del array actual
      }

      return $emailTo; // devolvemos el vendedor para este usuario

    }

    // Si el usuario no hizo consultas y no esta en base de datos guardado (es una consulta con mail nuevo)
    $sql = "select to_email from landings WHERE rubro='". $rubro ."' ORDER BY id DESC LIMIT 1"; // Obtenemos el ultimo registro del rubro
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute();
    $lastEmail = $stmt->fetch(PDO::FETCH_ASSOC);

    if ( !$lastEmail ) { //si no hay consultas grabadas en la base de datos para ese rubro
      return $salesEmails[0]; // simplemente devolvemos el primer vendedor de la lista
    }

    foreach ($salesEmails as $key => $email) { // Recorremos el array de emails de destino

      if ($email[0] == $lastEmail['to_email']) { // cuando lo encuentra

        if ( isset($salesEmails[$key + 1] ) ) { // si existe la key (si no se paso) 
          $emailTo = $salesEmails[$key + 1]; // Le suma 1 a la clave del array y lo asigna a la variable $emailTo
        } else {
          $emailTo = $salesEmails[0]; // si el key no existe comienza nuevamente desde la primera posicion y se la asigna a la variable $emailTo
        }

      } 

    }

    if (!isset($emailTo)) { // si el ultimo registro no contiene un mail que figure dentro del array $salesEmails
      $emailTo = $salesEmails[0]; // Asigno el primero de todos
    }

    return $emailTo; // devolvemos el vendedor a asignar para este usuario

  }

}

?>