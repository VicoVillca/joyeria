
<?php
  session_start();
   
  // Controlo si el usuario ya está logueado en el sistema.
  if(isset($_SESSION['idAdmin'])){
    // Le doy la bienvenida al usuario.
    header("HTTP/1.1 302 Moved Temporarily");
    header("Location: admin/index.php");
  }
?>
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html class="ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
  <head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="googlebot" content="index,follow">

    <!-- Title -->
    <title>Iniciar</title>

    <!-- Templates core CSS -->
    <link href="templeate/css/application.css" rel="stylesheet">

    <!-- Favicons -->
    <link href="images/favicon/favicon.png" rel="shortcut icon">
    <link href="images/favicon/apple-touch-icon-57-precomposed.png" rel="apple-touch-icon">
    <link href="images/favicon/apple-touch-icon-72-precomposed.png" rel="apple-touch-icon" sizes="72x72">
    <link href="images/favicon/apple-touch-icon-144-precomposed.png" rel="apple-touch-icon" sizes="114x114">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Modernizr Scripts -->
    
  </head>
  <body class="sign-in-up" id="to-top">

    <!-- Sign In/Sign Up section -->
    <section class="sign-in-up-section">

      <div class="container">

        <div class="row">

          <div class="col-md-12">

            <!-- Logo -->
            <figure class="text-center">
              <a href="./index.html">
                <img class="img-logo" src="img/logo.png" alt="">
              </a>
            </figure> <!-- /.text-center -->
            
          </div> <!-- /.col-md-12 -->

        </div> <!-- /.row -->




        <section class="sign-in-up-content">

          <div class="row">

            <div class="col-md-12">

              <h4 class="text-center">Iniciar sesión en su cuenta</h4>

              <form class="sign-in-up-form" action="./Login/iniciar-sesion.php"  method="post">
                
                <!-- Input 1 -->
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Usuario"  name="name" required>
                </div> <!-- /.form-group -->

                <!-- Input 2 -->
                <div class="form-group">
                  <input class="form-control" type="password" placeholder="Contraseña" name="password" required>
                </div> <!-- /.form-group -->

                <!-- Button -->
                <button class="btn btn-success btn-block" type="submit">Sign In</button>
                  
          
              </form> <!-- /.sign-in-up-form -->
              
            </div> <!-- /.col-md-12 -->

          </div> <!-- /.row -->
          <div class="row">
            <div class="col-md-12">
              <?php
                          
                          if(isset($_SESSION['mensage'])){
                              // Le doy la bienvenida al usuario.
                              echo'<div class="alert alert-danger">';
                              echo '<strong>' . $_SESSION['mensage'] . '</strong>';
                              echo '</div>';
                              unset($_SESSION['mensage']);
                          }

                      ?>
            </div>
          </div>
          
        </section> <!-- /.sign-in-up-content -->
        
      </div> <!-- /.container -->

    </section> <!-- /.sign-in-up-section -->
    
    <!-- Placed at the end of the document so the pages load faster -->
   
    
  </body>
</html>
