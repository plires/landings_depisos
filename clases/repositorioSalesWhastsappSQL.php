<?php

require_once("repositorioSalesWhatsapp.php");
require_once("repositorioSellers.php");
// require_once("../ventas.inc.php");

class RepositorioSalesWhastsappSQL extends repositorioSalesWhastsapp
{
  protected $conexion;

  public function __construct($conexion)
  {
    $this->conexion = $conexion;
  }

  public function getArrayEmailsSales()
  {

    try {
      $sql = "SELECT * FROM sellers WHERE status=1";
      $stmt = $this->conexion->prepare($sql);
      $stmt->execute();
      $sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (!$sellers) {
        return null;
      }

      return $sellers;
    } catch (\Throwable $th) {
      // var_dump($th->getMessage());
      return null;
    }
  }

  public function setNextWhatsappNumberByRubro($rubro_id, $salesEmailsForRubro)
  {

    // Iniciar una transacción
    $this->conexion->beginTransaction();

    // Obtener la posición actual del array desde la base de datos
    $sql = 'SELECT * FROM landing_whatsapp WHERE rubro_id=:rubro_id FOR UPDATE';
    $stm = $this->conexion->prepare($sql);
    $stm->execute(array(':rubro_id' => $rubro_id));
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
    $sql = 'UPDATE landing_whatsapp SET current_position=:current_position WHERE rubro_id=:rubro_id';
    $stm = $this->conexion->prepare($sql);
    $stm->execute(array(':current_position' => $current_position_in_database, ':rubro_id' => $rubro_id));

    // Confirmar la transacción
    $this->conexion->commit();

    return $salesEmailsForRubro[$current_position_in_database];
  }

  public function getCurrentWhatsappNumberByRubro($db, $rubro)
  {

    $salesEmails = $this->getArrayEmailsSales();
    $rubro = $db->getRepositorioSellers()->getRubroByName($rubro);

    // Obtener la posición actual del array desde la base de datos
    $sql = 'SELECT * FROM landing_whatsapp WHERE rubro_id=:rubro_id';
    $stm = $this->conexion->prepare($sql);
    $stm->execute(array(':rubro_id' => $rubro['id']));
    $row = $stm->fetch(PDO::FETCH_ASSOC);

    $salesEmails[$row['current_position']]['rubro'] = $rubro['id'];

    if ($row['current_position'] >= count($salesEmails)) {
      $row['current_position'] = 0;
    }

    return $salesEmails[$row['current_position']];
  }
}