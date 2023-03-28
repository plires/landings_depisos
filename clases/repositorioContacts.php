<?php

abstract class repositorioContacts {
	public abstract function saveInBDD($post);
	public abstract function getSalesEmails($rubro);
	public abstract function getNextEmailTo($rubro);
}

?>