<?php

require_once("repositorioSellers.php");

class RepositorioSellersSQL extends repositorioSellers
{
  protected $conexion;

  public function __construct($conexion)
  {
    $this->conexion = $conexion;
  }

  public function getAllSellersEnabled()
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
      $message = $th->getMessage();

      $db = new RepositorioSQL();
      $db->getRepositorioApp()->notificationsToEmail("<h1>Error al obtener todos los vendedores activos.</h1><h2>Tabla: 'sellers'</h2><h2>Descripción: $message </h2>", __FUNCTION__, __FILE__, __LINE__);

      return null;
    }
  }

  public function getAllSellers()
  {

    try {
      $sql = "SELECT * FROM sellers";
      $stmt = $this->conexion->prepare($sql);
      $stmt->execute();
      $sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (!$sellers) {
        return null;
      }

      return $sellers;
    } catch (\Throwable $th) {
      $message = $th->getMessage();

      $db = new RepositorioSQL();
      $db->getRepositorioApp()->notificationsToEmail("<h1>Error al obtener todos los vendedores.</h1><h2>Tabla: 'sellers'</h2><h2>Descripción: $message </h2>", __FUNCTION__, __FILE__, __LINE__);

      return null;
    }
  }

  public function searchForId($id, $array)
  {
    foreach ($array as $key => $val) {
      if ($val['id'] === $id && $val['status'] === 1) {
        return $val;
      }
    }
    return null;
  }

  public function getStoreById($store_id)
  {

    try {
      $sql = "SELECT * FROM stores WHERE id='$store_id' ";
      $stmt = $this->conexion->prepare($sql);
      $stmt->execute();
      $store = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$store) {
        return null;
      }

      return $store;
    } catch (\Throwable $th) {
      $message = $th->getMessage();

      $db = new RepositorioSQL();
      $db->getRepositorioApp()->notificationsToEmail("<h1>Error al obtener un store según su ID.</h1><h2>Tabla: 'stores'</h2><h2>Store ID: $store_id</h2><h2>Descripción: $message </h2>", __FUNCTION__, __FILE__, __LINE__);

      return null;
    }
  }

  public function getSellersById($ids)
  {

    $team = [];
    $id_array = explode(', ', $ids);
    $sellers = $this->getAllSellersEnabled();
    
    foreach ($id_array as $seller_id) {
      $seller = $this->searchForId((int)$seller_id, $sellers);
      unset($seller['id']);
      if ($seller) array_push($team, $seller);      
    }

    return $team;
  }

  public function getTeamByRubroAndStore($rubro_id, $store_id)
  {

    try {
      $sql = "SELECT * FROM sales_team WHERE rubro_id='$rubro_id' AND store_id='$store_id' ";
      $stmt = $this->conexion->prepare($sql);
      $stmt->execute();
      $team = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$team) {
        return null;
      }

      return $team;
    } catch (\Throwable $th) {
      $message = $th->getMessage();

      $db = new RepositorioSQL();
      $db->getRepositorioApp()->notificationsToEmail("<h1>Error al obtener todos equipos de ventas según rubro y store.</h1><h2>Rubro ID: $rubro_id</h2><h2>Store ID: $store_id</h2><h2>Tabla: 'sales_team'</h2><h2>Store ID: $store_id</h2><h2>Descripción: $message </h2>", __FUNCTION__, __FILE__, __LINE__);

      return null;
    }
  }

  public function getRubroByName($rubro_name)
  {

    try {
      $sql = "SELECT * FROM rubros WHERE name='$rubro_name' ";
      $stmt = $this->conexion->prepare($sql);
      $stmt->execute();
      $rubro = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$rubro) {
        return null;
      }

      return $rubro;
    } catch (\Throwable $th) {
      $message = $th->getMessage();

      $db = new RepositorioSQL();
      $db->getRepositorioApp()->notificationsToEmail("<h1>Error al obtener el rubro según el nombre del rubro.</h1><h2>Rubro: $rubro_name</h2><h2>Tabla: 'rubros'</h2><h2>Descripción: $message </h2>", __FUNCTION__, __FILE__, __LINE__);

      return null;
    }
  }

  public function getAllStores()
  {

    try {
      $sql = "SELECT * FROM stores";
      $stmt = $this->conexion->prepare($sql);
      $stmt->execute();
      $stores = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (!$stores) {
        return null;
      }

      return $stores;
    } catch (\Throwable $th) {
      $message = $th->getMessage();

      $db = new RepositorioSQL();
      $db->getRepositorioApp()->notificationsToEmail("<h1>Error al obtener todos los stores.</h1><h2>Tabla: 'stores'</h2><h2>Descripción: $message </h2>", __FUNCTION__, __FILE__, __LINE__);

      return null;
    }
  }
}