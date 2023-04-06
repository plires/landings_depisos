<?php

abstract class repositorioSalesWhastsapp {
	public abstract function setNextWhatsappNumberByRubro($rubro, $salesEmailsForRubro);
	public abstract function getCurrentWhatsappNumberByRubro($rubro, $salesEmailsForRubro);
	public abstract function getArrayEmailsSales($rubro);
}

?>