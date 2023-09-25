<?php

require_once("repositorioSalesWhatsapp.php");
require_once("../ventas.inc.php");

class RepositorioSalesWhastsappSQL extends repositorioSalesWhastsapp
{
  protected $conexion;

  public function __construct($conexion) 
  {
    $this->conexion = $conexion;
  }

  public function getArrayEmailsSales($rubro)
  {

    switch ($rubro) {
      case 'Ceramicos':
        return EMAIL_VENTAS_CERAMICOS;
        break;

      case 'Piso Vinilico':
        return EMAIL_VENTAS_PISOS;
        break;

      case 'Porcelanatos':
        return EMAIL_VENTAS_PORCELANATOS;
        break;

      case 'Deck Ecologico':
        return EMAIL_VENTAS_DECKS;
        break;

      case 'Revestimientos de Paredes':
        return EMAIL_VENTAS_REVESTIMIENTOS;
        break;
      
      case 'Griferias':
        return EMAIL_VENTAS_GRIFERIAS;
        break;
      
      default:
        return EMAIL_VENTAS_PISOS;
        break;
    }

  }

  public function setNextWhatsappNumberByRubro($rubro, $salesEmailsForRubro)
  {

    // Iniciar una transacción
    $this->conexion->beginTransaction();

    // Obtener la posición actual del array desde la base de datos
    $sql = 'SELECT * FROM landing_whatsapp WHERE rubro=:rubro FOR UPDATE';
    $stm = $this->conexion->prepare($sql);
    $stm->execute(array(':rubro' => $rubro));
    $row = $stm->fetch(PDO::FETCH_ASSOC);

    if ($row === false) {
      $current_position_in_database = 0;
    } else {
      $current_position_in_database = intval($row['current_position']);
    }

    // Actualizar la posición actual en la base de datos
    $current_position_in_database++;
    if ($current_position_in_database >= count($salesEmailsForRubro)) {
      $current_position_in_database = 0;
    }
    $sql = 'UPDATE landing_whatsapp SET current_position=:current_position WHERE rubro=:rubro';
    $stm = $this->conexion->prepare($sql);
    $stm->execute(array(':current_position' => $current_position_in_database, ':rubro' => $rubro));

    // Confirmar la transacción
    $this->conexion->commit();

    return $salesEmailsForRubro[$current_position_in_database];

  }

  public function getCurrentWhatsappNumberByRubro($rubro, $salesEmailsForRubro)
  {

    // Obtener la posición actual del array desde la base de datos
    $sql = 'SELECT * FROM landing_whatsapp WHERE rubro=:rubro';
    $stm = $this->conexion->prepare($sql);
    $stm->execute(array(':rubro' => $rubro));
    $row = $stm->fetch(PDO::FETCH_ASSOC);

    if ( intval($row['current_position']) > count($salesEmailsForRubro) ) {
      $row['current_position'] = 0;
    }

    return $salesEmailsForRubro[$row['current_position']];

  }

}

?>