<?php
  error_reporting(E_ALL);
  ini_set('display_errors', true);
  session_start();
  require 'DataBase/DB/DB_Admin.php';
  // Controlo si el usuario ya está logueado en el sistema.

  $respuesta = DB_Admin::getByIdAndToken($_SESSION['idAdmin'], $_SESSION['token']);
 

  if(!$respuesta){
    echo "no logueado";
	// Si no está logueado lo redireccion a la página de login.
    header("HTTP/1.1 302 Moved Temporarily");
    header("Location: ../Login/cerrar-sesion.php");
  }
?>