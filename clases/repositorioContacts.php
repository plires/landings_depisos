<?php
	abstract class repositorioContacts {
		public abstract function saveInBDD($post);
		public abstract function getSalesEmails($rubro, $store_id);
		public abstract function getSellerForThisUser($rubro, $userFound, $store);
		public abstract function userFound($email_user, $store);
		
	}
?>