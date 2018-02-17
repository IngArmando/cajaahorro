<?php session_start(); 
  
  require_once("../../funciones.php");

  include('../../modelo/MOrganizacion.php');
  $OOrg = new Organizacion;
  //$OOrg -> setIdListaValor($_GET['id']);
  $registro=$OOrg -> consultar();
  while ( $fila = $OOrg->setArreglo( $registro ))
      $datos[] = $fila;
    foreach ($datos as $Org) { $Org; }


    if(isset($_SESSION['userActivo']) && !empty($_SESSION['userActivo'])){
        header("location: ../sis/Inicio.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>ASOCIACIÓN DE EMPLEADOS MUNICIPALES DE PASTAZA - Iniciar Sesión</title>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="CAJA DE AHORROS">
    <meta name="generator" content="Bootply" />
    <meta name="author" content="UPTP">
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->
    <!--  Propiedades -->
   <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
    <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
    <link rel="stylesheet" type="text/css" href="../../js/sweetalert2/dist/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="../../css/pub_style.css" /><!-- CSS Base -->
    <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->
  <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
  <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
  <script src="../../js/main.js"></script> <!--Configura Interfaz -->
  <script src="../../js/JsInicioSesion.js"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
</head>
<body>

  <div class="center aligned cabecera">
    <div class="ui grid container" style="background: none">
      <div class="four wide column">
        <img class="ui small centered image" src="../../image/logop.png?nochache">
      </div>
      <div class="twelve wide middle aligned column">
        <h3 class="font-style ui center aligned mobile-small"><?php echo $Org['razon_social'];  ?></h3>
      </div>  
    </div>          
  </div>

  <?php require_once('NavBar.php');  ?>

  <div class="ui container" style="width:700px"> 

    <div class="ui middle aligned center aligned grid">
      <div class="column">
        <h4 class="ui inverted block header">
          <div class="content">
            Inicio de Sesión
          </div>
        </h4>
        <form class="ui large form" method="POST" action="../../controlador/CSesion.php" name="formulario" id="formulario">
          <p align="center" >Si usted ya es Socio de la Caja de Ahorros y está afiliado a este servicio, ingrese su Usuario y Contraseña; seguidamente presione "Ingresar" para acceder al sistema.</p>
          <div class="ui stacked segment">
            <div class="field">
              <div class="ui left icon input">
                <i class="user icon"></i>
                <input type="text" placeholder="Usuario" id="user" name="user">
              </div>
            </div>
            <div class="field">
              <div class="ui left icon input">
                <i class="lock icon"></i>
                <input type="password" placeholder="Contraseña" id="pass" name="pass">
              </div>
            </div>
            <div class="center aligned five wide field">
              <label>Código de Verificacion</label>
              	<img  class='ui medium image' id="captcha" src="../../securimage/securimage_show.php" alt="CAPTCHA Image" />
				<a href="#" onclick="document.getElementById('captcha').src = '../../securimage/securimage_show.php?' + Math.random(); return false">Cambiar Imagen</a>
              	<input type="text" name="captcha_code" size="10" maxlength="6" />
            </div>
            <input type="hidden" name="evento" id="evento" value="iniciar">
            <input type="submit" class="ui blue fluid submit button" value="Ingresar">
          </div>

          <div class="ui error message"></div>

        </form>

        <div class="ui message">
          <div class="ui two buttons">
            
            <a class="ui animated fade green button" onclick="window.location.href='inscripcion.php'" >
              <div class="visible content">Inscribirse</div>
              <div class="hidden content">Haga click aquí.</div>
            </a> 

            <a class="ui animated fade button" onclick="window.location.href='Recuperar.php'" >
              <div class="visible content">¿Olvidó su contraseña?</div>
              <div class="hidden content">Haga click aquí.</div>
            </a>  
          </div>
        </div>
      </div>
    </div> 
  </div>
</body>
  
</html>