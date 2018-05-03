<?php
session_start();

  include_once("../../modelo/MSocio.php");
  $lista = new socio();

  /*if(!isset($_SESSION["user_name"])){
        header("location: ../pub/inise.php");
    }*/


?>

<!DOCTYPE html>
<html>
<head>
  <title>Socios</title>

  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->   

  <!--  Propiedades -->

    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->

  <link rel="stylesheet" type="text/css" href="../../css/Bootstrap/css/bootstrap.css"> <!--Bootstrap -->
  <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
  <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
  <link rel="stylesheet" type="text/css" href="../../js/DataTables/media/css/dataTables.bootstrap.css"><!-- Bootstrap Tablas -->
  <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->

  <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->

  <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
  <script src="../../js/main.js"></script> <!--Configura Interfaz -->
  <script src="../../js/DataTablesConfig.js"></script> <!--Configura Interfaz -->
  <script src="../../js/"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/DataTables/media/js/jquery.dataTables.js"></script><!-- Filtro de tabla -->
  <script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js"></script><!-- Bootstrap -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
</head>
<body>  
  <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->

  <div class="ui container">
    <h2 class="ui center aligned small block icon inverted header">
      <i class="users icon"></i>
      Socios                
    </h2>
    <p>Desde éste modulo se gestionan los socios y el personal administrativo de la Caja de Ahorros.</p>
    
    <div class="ui dividing header"></div>
      
      <a class="ui labeled icon large button" onclick="window.location='Inicio.php'">
        <i class="left arrow icon"></i>
        Volver
      </a>

      <a class="ui labeled blue icon large button" onclick="window.location='AdminSociosRegistrar.php'">
        <i class="plus icon"></i>
        Registrar
      </a>

      <a class="ui labeled icon large button" onclick="window.location='AdminSociosReporte.php'">
        <i class="file pdf outline icon"></i>
        Imprimir
      </a>
      

   
<h4 class="ui centered block dividing header">Listado de Socios Inscritos</h4>
        <?php
            $listado=$lista->listar2();
            foreach ($listado as $tagtp){echo $tagtp;}
        ?>



</div>

</body>
</html>