<?php
  session_start();
 
  // Obtengo los datos cargados en el formulario de login.
  require '../admin/DataBase/DB/DB_Admin.php';

  // Esto se puede remplazar por un usuario real guardado en la base de datos.
  $respuesta = DB_Admin::getByPasword($_POST['name'], $_POST['password']);
  if($respuesta){
    // Guardo en la sesión el email del usuario.
    $_SESSION['idAdmin'] = $respuesta['idAdmin'];
    $_SESSION['nombre'] = $_POST['name'];
    $_SESSION['token'] = $respuesta['token'];
     
    // Redirecciono al usuario a la página principal del sitio.
    header("HTTP/1.1 302 Moved Temporarily");
    header("Location: ../admin/index.php");
  }else{
  	$_SESSION['mensage'] = "nombre o pasword incorrecto ";
  	header("Location: ../index.php");
  
  }
 
?>