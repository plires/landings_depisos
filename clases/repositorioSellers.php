<?php

abstract class repositorioSellers
{
  public abstract function getAllStores();
  public abstract function getStoreById($store_id);  
  public abstract function getRubroByName($rubro_name);
  public abstract function getTeamByRubroAndStore($rubro_id, $store_id);
  public abstract function getAllSellers();  
  public abstract function getAllSellersEnabled();  
  public abstract function getSellersById($sellers_id);  
  public abstract function searchForId($id, $array) ;
}