<?php
  session_start();
  require '../admin/DataBase/DB/DB_Admin.php';
   
  // Elimina la variable email en sesión.
  //Pero primero solicitamso un nuevo token para cuando vuelva a iniciar cession
  $val = DB_Admin::updateNewToken($_SESSION['idAdmin'],$_SESSION['token']);
  //Fin de Pedir  nuevo token
  unset($_SESSION['idAdmin']);
  unset($_SESSION['nombre']);
  unset($_SESSION['token']);
 
  // Elimina la sesion.
  session_destroy();
   
  header("HTTP/1.1 302 Moved Temporarily");
  header("Location: ../");
?>