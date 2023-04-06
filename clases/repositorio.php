<?php

abstract class Repositorio {
  protected $repositorioContacts;
  protected $repositorioSalesWhastsapp;

  public function getRepositorioContacts() {
    return $this->repositorioContacts;
  }

  public function getRepositorioSalesWhastsapp() {
    return $this->repositorioSalesWhastsapp;
  }
}

?>