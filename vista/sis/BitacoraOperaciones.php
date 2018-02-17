<?php
    session_start();
    include_once("../../modelo/MBitacoraOperacion.php");
    $lista = new BitOpe();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bitácora de Operaciones</title>

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
    <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
    <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
    <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
    <script src="../../js/DataTables/media/js/jquery.dataTables.js"></script><!-- Filtro de tabla -->
    <script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js"></script><!--Bootstrap -->
</head>
<body>  
  <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->

  <div class="ui container">
    <h2 class="ui center aligned small block icon inverted header">
      <i class="unhide icon"></i>
      Bitácora de Operación                
    </h2>

    <div class="ui stackable grid">
      <div class="two wide column">
        <a class="ui labeled icon button" href="Inicio.php">
          <i class="left arrow icon"></i>
          Volver
        </a>        
      </div>
      <div class="fourteen wide center aligned column">

      </div> 
    </div>



<h4 class="ui centered block dividing header">Operaciones del sistema</h4>
        <?php
            $listado=$lista->listar();
            foreach ($listado as $tagtp){echo $tagtp;}
        ?>
</div>
</body>
</html>