<?php
session_start();

  include('../../modelo/MBeneficios.php');
  $OBenef = new Beneficio;
  $OBenef -> setIdBeneficio($_GET['id']);
  $registro=$OBenef -> consultar();
  while ( $fila = $OBenef->setArreglo( $registro ))
      $datos[] = $fila;
    foreach ($datos as $Benef) { $Benef; }


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Configuraciones </title> 
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
  <script src="../../js/JsBenef.js"></script> <!--Validaciones --> 
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
      <i class="open folder outline icon"></i>
      Configuracion de Fondos
    </h2>
    <h3 class="ui center aligned dividing header">Configuaracion <?php echo $Benef['nombre'] ?></h3>

    <a class="ui labeled icon button" href="ConfigBeneficio.php">
      <i class="left arrow icon"></i>
      Volver
    </a>

    
   
    <div class="ui dividing header"></div>
      
      <table class="table table-bordered" style="width: 50%; margin:0 auto;">
        <tr>
          <th style="background: #EEE; width: 30%;">Presidente</th>
          <td><input type="text" class="form-control" name=""></td>
        </tr>

        <tr>
          <th style="background: #EEE; width: 30%;">Encargado</th>
          <td><input type="text" class="form-control" name=""></td>
        </tr>

        <tr>
          <th style="background: #EEE; width: 30%;">Monto Maximo</th>
          <td><input type="text" class="form-control" style="width: 20%;" name=""></td>
        </tr>

        <tr>
          <th style="background: #EEE; width: 30%;">Interes Anual</th>
          <td><input type="text" class="form-control" style="width: 20%;" name=""></td>
        </tr> 

        <tr>
          <th style="background: #EEE; width: 30%;"> Plazo Maximo</th>
          <td><input type="text" class="form-control" style="width: 20%;" name=""></td>
        </tr> 

        <tr>
          <th style="background: #EEE; width: 30%;">Aporte Mensual</th>
          <td><input type="text" class="form-control" style="width: 20%;" name=""></td>
        </tr> 

        <tr>
          <th style="background: #EEE; width: 30%;">Dia de Corte</th>
          <td><input type="text" class="form-control" style="width: 20%;" name=""></td>
        </tr> 

        <tr>
          <th style="background: #EEE; width: 30%;">Sueldo Basico</th>
          <td><input type="text" class="form-control" style="width: 20%;" name=""></td>
        </tr> 

        <tr>
          <td colspan="2" align="center">
            <input type="button" class="ui primary button" value="Guardar" onclick="enviar(this.value)">
          </td>
        </tr>

         
      </table>


  </div>


</body>  

</html>