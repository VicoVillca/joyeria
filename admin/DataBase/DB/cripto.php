<?php
/**
 * Usuamos para encriptar  y desencriptar valores
 * para mayor seguridad.
 */
function encriptar($cadena){
    $key='rctcBnee_L??|tAwzC??pr@sxB';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
    return $encrypted; //Devuelve el string encriptado
 
}
 
function desencriptar($cadena){
     $key='rctcBnee_L??|tAwzC??pr@sxB';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
     $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    return $decrypted;  //Devuelve el string desencriptado
}
function verifica_solonumeros($idLinea){
	$permitidos = "1234567890";
	for ($i=0; $i<strlen($idLinea)-1; $i++){
	    if (strpos($permitidos, $idLinea[$i])===false){
	        return false;
	    }
   	}
   	return true;
}
?>