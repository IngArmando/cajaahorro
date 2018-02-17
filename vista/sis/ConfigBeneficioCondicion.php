<?php
session_start();

  include_once("../../modelo/MCombo.php");
  $combo = new Combo();

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Configuraciones | Beneficios</title> 
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
  <script src="../../js/JsBeneficiosCondicion.js"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->


</head>
<body>  
  <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->         

  <div class="ui container"> 

    <h2 class="ui center aligned small block icon inverted header">
      <i class="book icon"></i>
      Condiciondes de Beneficio
    </h2>
    <h3 class="ui center aligned dividing header">Condiciondes de [Beneficio]</h3>

    <form class="ui large form" method="POST" action="../../ctrl/CBeneficiosCondicion.php" id="formulario" name="formulario">
      <p>Todos los campos son obligatorios.</p>

      <div class="ui required five wide field">
        <label>Condiciones del beneficio para el cargo:</label>
        <?php
          $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=14", "id_lista_valor","nombre_largo", isset($_GET[''])?$_GET['']:'','TipoDocente',' class="ui compact dropdown"');
          foreach ($tagcbotp as $tagtp){echo $tagtp;}
        ?>
      </div>
      <div class="ui dividing header"></div>
      <div class="ui three fields">
        
        <div class="field">
          <label>Máximo de Solicitudes Simultaneas</label>
          <input type="number" id="MaxSol" name="MaxSol"  onkeypress="return soloNumeros(event)" min='0'>
        </div>

        <div class="field">
          <label>Mínimo de Fiadores</label>
          <input type="number" id="MinFia" name="MinFia"  onkeypress="return soloNumeros(event)" min='0'>
        </div>

        <div class="field">
          <label>Máximo de Fiadores </label>
          <input type="number" id="MaxFia" name="MaxFia"  onkeypress="return soloNumeros(event)" min='0'>
        </div>
        
      </div>

      <div  class="ui small icon info message">
        <i class="info circle icon"></i><p>Si el beneficio no permite fiadores dejar los valores de máx. y mín. en 0 (Cero).</p>
      </div>

      <div class="three fields">
        
        <div class="field">
          <label>Monto Mín. por Solicitud<i class="help circle small icon" data-content="Monto mín. a solicitar, aún si no existe se recomienda dejar un valor moderado."></i></label>
          <div class="ui left icon labeled input">
            <div class="ui label">Bs.</div>
            <input type="number" id="MinMon" name="MinMon" onkeypress="return soloNumeros(event)" min='0'>
          </div>
        </div>

        <div class="field">
          <label>Monto Máx. por Solicitud<i class="help circle small icon" data-content="Monto máximo a solicitar, si no aplica dejar en 0 (Cero)."></i></label>
          <div class="ui left icon labeled input">
            <div class="ui label">Bs.</div>
            <input type="number" id="MaxMon" name="MaxMon" onkeypress="return soloNumeros(event)" min='0'>
          </div>
        </div>
            

        <div class="field">
          <label>Haberes Requeridos<i class="help circle small icon" data-content="Este campo indica si el beneficio debe ser respaldado por un porcentaje de haberes, si no aplica dejar en 0 (Cero)."></i></label>
          <div class="ui left icon labeled input">
            <div class="ui label">%</div>
            <input type="number" id="HabReq" name="HabReq" onkeypress="return soloNumeros(event)" min='0'>
          </div>
        </div>
      </div>                    
 
      <div class="ui center aligned block inverted header">
        <input type="hidden" name="opera" id="opera">
        <input type="button" class="ui primary button" value="Guardar Cambios" onclick="enviar(this.value)">
        <div class="ui negative button" onclick="window.location='ConfigBeneficio.php'">
          Cancelar
        </div>
      </div>
    </form>
  </div>
</body>
</html>