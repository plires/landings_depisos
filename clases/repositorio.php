<?php

abstract class Repositorio {
  protected $repositorioContacts;
  protected $repositorioSalesWhastsapp;
  protected $repositorioSellers;
  protected $repositorioApp;

  public function getRepositorioContacts() {
    return $this->repositorioContacts;
  }

  public function getRepositorioSalesWhastsapp() {
    return $this->repositorioSalesWhastsapp;
  }

  public function getRepositorioSellers() {
    return $this->repositorioSellers;
  }

  public function getRepositorioApp() {
    return $this->repositorioApp;
  }
}

?>