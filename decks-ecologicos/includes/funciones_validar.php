<?php

/**
 * @author Pablo Lires
 * @copyright 2010
 */


function comprobar_email($email){ 
   	$mail_correcto = 0; 
   	//compruebo unas cosas primeras 
   	if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
      	 if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
         	 //miro si tiene caracter . 
         	 if (substr_count($email,".")>= 1){ 
            	 //obtengo la terminacion del dominio 
            	 $term_dom = substr(strrchr ($email, '.'),1); 
            	 //compruebo que la terminaci&oacute;n del dominio sea correcta 
            	 if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
               	 //compruebo que lo de antes del dominio sea correcto 
               	 $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
               	 $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
               	 if ($caracter_ult != "@" && $caracter_ult != "."){ 
                  	 $mail_correcto = 1; 
               	 } 
            	 } 
         	 } 
      	 } 
   	} 
   	if ($mail_correcto) 
      	 return 1; 
   	else 
      	 return 0; 
}

function campoVacio($dato){
	if ($dato==''){
		return true;
	}else{
		return false;
	}
}

/*
function validoClave($pass1, $pass2){
	if($pass1 == $pass2){
		$cc= strlen($pass1);
		if($cc >= 5 && $cc <= 10){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}
*/
/*
function validar_mail ($mail){
	if (count (explode('@', $mail)) !=2){
		return true;
	}else{
		return false;
	}
}
*/

/*function validar_mail ($mail){
	if (strlen($mail)==0){
		return false;
	}
	$dom= strstr($mail, '@');
		if (!$dom){
			return false;
		}
	if (strpos($dom, '@', 1)){
		return false;
	}else{
		return true;	
	}
	
}
*/

// return is_int($edad);


?>