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

  public function saveInBDD($post)
  {

    if (isset($_POST['newsletter'])) {
      $newsletter = 'Si';
    } else {
      $newsletter = 'No';
    }

    // Obtener el ultimo registro para asignar el proximo destinatario de email
    $emailTo = $this->getNextEmailTo(RUBRO);

    $sql = "INSERT INTO landings values(default, :name, :email, :phone, :comments, :newsletter, :medium, :origin, :rubro, :to_email, :date)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(":name", $post['name'], PDO::PARAM_STR);
        $stmt->bindValue(":email", $post['email'], PDO::PARAM_STR);
        $stmt->bindValue(":phone", $post['phone'], PDO::PARAM_STR);
        $stmt->bindValue(":comments", $post['comments'], PDO::PARAM_STR);
        $stmt->bindValue(":newsletter", $newsletter, PDO::PARAM_STR);
        $stmt->bindValue(":medium", $post['utm_medium'], PDO::PARAM_STR);
        $stmt->bindValue(":origin", $post['origin'], PDO::PARAM_STR);
        $stmt->bindValue(":rubro", $post['rubro'], PDO::PARAM_STR);
        $stmt->bindValue(":to_email", $emailTo[0], PDO::PARAM_STR);
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

      default:
        $emails = EMAIL_DEFAULT;
        break;

    }

    return $emails;

  }

  public function getNextEmailTo($rubro)
  {

    $sql = "select to_email from landings WHERE rubro='". $rubro ."' ORDER BY id DESC LIMIT 1"; // Obtenemos el ultimo registro
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute();
    $lastEmail = $stmt->fetch(PDO::FETCH_ASSOC);

    $salesEmails = $this->getSalesEmails($rubro);

    if ( !$lastEmail ) {
      return $salesEmails[0];
    }

    foreach ($salesEmails as $key => $email) { // Recorremos el array de emails de destino

      if ($email[0] == $lastEmail['to_email']) { // cuando lo encuentra

        if ( isset($salesEmails[$key + 1] ) ) { // si existe la key (si no se paso) 
          $emailTo = $salesEmails[$key + 1]; // Le suma 1 a la clave del array y lo asigna a la variable $emailTo
        } else {
          $emailTo = $salesEmails[0]; // si el key no existe comienza nuevamente desde la primera posicion y se la variable $emailTo
        }

      } 

    }

    if (!isset($emailTo)) { // si el ultimo registro no contiene un mail que figure dentro del array $salesEmails
      $emailTo = $salesEmails[0]; // Asigno el primero de todos
    }

    return $emailTo;

  }

}

?>
