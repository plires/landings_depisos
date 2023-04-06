<?php

require_once("repositorio.php");
require_once("repositorioContactsSQL.php");
require_once("repositorioSalesWhastsappSQL.php");

class RepositorioSQL extends Repositorio {

  protected $conexion;

  /**
   * [__construct Establece la conexion con la base]
   */
  public function __construct() {

    try {
      $this->conexion = new PDO($_ENV['DSN'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
    } catch (Exception $e) {
      echo 'No se pudo conectar a la base de datos. Intente en un momento por favor...';
    }

    $this->repositorioContacts = new RepositorioContactsSQL($this->conexion);
    $this->repositorioSalesWhastsapp = new RepositorioSalesWhastsappSQL($this->conexion);

  }
}

?>
