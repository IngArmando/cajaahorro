<?php
session_start();

  include_once("../../modelo/MCombo.php");
  $combo = new Combo();

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title> Casas Comerciales </title> 
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->
  <!--  Propiedades -->
  <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
  <link rel="stylesheet" type="text/css" href="../../css/Bootstrap/css/bootstrap.css"> <!--Bootstrap -->
  <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
  <link rel="stylesheet" type="text/css" href="../../js/sweetalert2/dist/sweetalert2.css">
  <link rel="stylesheet" type="text/css" href="../../js/DataTables/media/css/dataTables.bootstrap.css"><!-- Bootstrap Tablas -->
  <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
  <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->

  <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
  <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
  <script src="../../js/main.js"></script> <!--Configura Interfaz -->
  <script src="../../js/DataTablesConfig.js"></script> <!--Configura Interfaz -->
  <script src="../../js/JsCasa_Comercial.js"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="../../js/DataTables/media/js/jquery.dataTables.js"></script><!-- Filtro de tabla -->
  <script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js"></script><!-- Bootstrap -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->


</head>
<body>  
  <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->         

  <div class="ui container"> 

    <h2 class="ui center aligned small block icon inverted header">
      <i class="cube  icon"></i>
      Casas Comerciales
    </h2>
    <h3 class="ui center aligned dividing header"> Registrar Casa Comercial </h3>

    <form class="ui large form" method="POST" action="../../controlador/CCasa_Comercial.php" id="formulario" name="formulario">
      <p>Los campos marcados con * son obligatorios: </p>

      <div class="two fields">
        <div class="required field">
          <label> Nombre </label>
          <input type="text" id="descripcion" name="descripcion" placeholder="Ingrese el nombre de la Casa Comercial" >
        </div>

        <div class="required field">
          <label> Tipo de Comisión </label>
          <select name="tipo_comision" id="tipo_comision" class="ui dropdown selection" onchange="">
            <option value="" selected> SELECCIONE </option>
            <option value="1"> PAGO FIJO </option>
            <option value="2"> PORCENTAJE </option>
          </select>
        </div>
      </div>

      <div class="two fields">
        <div class="field">
        </div>
        
        <div class="field">
          <div class="required field">
            <label> Comisión </label>
            <input type="text" id="comision" name="comision" onkeypress="return soloNumeros(event)" >
          </div>
        </div>        
      </div>

      <div class="ui center aligned block inverted header">
        <input type="hidden" name="opera" id="opera">
        <input type="button" class="ui primary button" value="Registrar" onclick="enviar(this.value)">
        <div class="ui negative button" onclick="window.location='casa_comercial.php'">
          Cancelar
        </div>
      </div>
    </form>
  </div>
</body>
</html>