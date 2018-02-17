<?php session_start(); 
  
  require_once("../../funciones.php");

  include('../../modelo/MOrganizacion.php');
  $OOrg = new Organizacion;
  //$OOrg -> setIdListaValor($_GET['id']);
  $registro=$OOrg -> consultar();
  while ( $fila = $OOrg->setArreglo( $registro ))
      $datos[] = $fila;
    foreach ($datos as $Org) { $Org; }


    if(isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])){
        header("location: ../sis/Inicio.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>CAPPIUTEP - Error</title>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="CAJA DE AHORROS">
    <meta name="generator" content="Bootply" />
    <meta name="author" content="UPTP">
    <meta http-equiv="refresh" content="2;URL=Acceso.php">
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->
    <!--  Propiedades -->
   <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
    <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
    <link rel="stylesheet" type="text/css" href="../../css/pub_style.css" /><!-- CSS Base -->
    <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->
  <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
  <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
  <script src="../../js/main.js"></script> <!--Configura Interfaz -->
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
</head>
<body>

  <div class="center aligned cabecera">
    <div class="ui grid container" style="background: none">
      <div class="four wide column">
        <img class="ui small centered image" src="../../image/logop.png">
      </div>
      <div class="twelve wide middle aligned column">
        <h3 class="font-style ui center aligned mobile-small"><?php echo $Org['razon_social'];  ?></h3>
      </div>  
    </div>          
  </div>

  <div class="ui bottom attached blue inverted six item large fluid menu ">
    
  </div>

  <div class="ui badlogin">
    <h2 class="ui center aligned icon header">
      <i class='ui blue massive warning circle icon'></i>
      ERROR<br>
    </h2>
    <div class="ui header">Su usuario ha sido bloqueado.</div>
  </div>

</body>
  
</html>