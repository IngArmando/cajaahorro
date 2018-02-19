<?php
session_start();

  if(!isset($_SESSION["userActivo"])){
        header("location: ../pub/inise.php");
    }

  include_once("../../modelo/MSocio.php");
  $OSocio = new Socio;

  if (isset($_SESSION["userActivo"])){
      $OSocio -> setCedula($_SESSION["userActivo"]);
      $sqll="select * from cappiutep.t_persona where cedula='".$_SESSION["userActivo"]."'";
      $registro=$OSocio -> ejecutar($sqll);
      while ( $fila = $OSocio->setArreglo( $registro ))
          $datos[] = $fila;
      foreach ($datos as $Soc) { $Soc; }
    }


?>

<!DOCTYPE html>
<html>
<head>
  <title>CAPPIUTEP | Aportes</title>

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
      <i class="archive icon"></i>
      Aportes              
    </h2>

        <a class="ui labeled icon button" href="Inicio.php">
          <i class="left arrow icon"></i>
          Volver
        </a> 

        <a class="ui right floated labeled icon button" onclick="verReporte()">
          <i class="print icon"></i>
          Imprimir
        </a>        

        <form action="../../fpdf/PDFHaberes.php" method="POST" target="_BLANK">
          
          <input type="hidden" name="id"            value="<?php echo $Soc['id_persona']; ?>">
          <input type="hidden" name="nombre"        value="<?php echo $Soc['nombre1']." ".$Soc['apellido1']; ?>">
          <input type="hidden" name="ci"            value="<?php echo $_SESSION['userActivo'] ?>">
          <input type="hidden" name="fecha_ingreso" value="<?php echo $Soc['fechaafi'] ?>">
        </form>

      <div class="fourteen wide center aligned column">

      </div> 
    <div class="ui block dividing header"></div>
    <?php

      $listado=$OSocio->listarHaber($Soc["id_persona"]);
      foreach ($listado as $tagtp){echo $tagtp;}
    ?>

</div>

</body>
</html>
<script type="text/javascript">
    function verReporte(){
      window.open("../../fpdf/PDFHaberes.php");
    } 
</script>