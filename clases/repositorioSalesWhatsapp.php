<?php

abstract class repositorioSalesWhastsapp
{
	public abstract function setNextWhatsappNumberByRubro($rubro, $salesEmailsForRubro);
	public abstract function getCurrentWhatsappNumberByRubro($db, $rubro);
	public abstract function getArrayEmailsSales();
}
