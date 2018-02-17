<?php
session_start();

  if(!isset($_SESSION['userActivo']))
    header('location: ../pub/Acceso.php');

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
  <script src="../../js/JsBeneficios.js"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->


</head>
<body>  
  <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->         

  <div class="ui container"> 

    <h2 class="ui center aligned small block icon inverted header">
      <i class="square plus icon"></i>
      Beneficios
    </h2>
    <h3 class="ui center aligned dividing header">Registrar Beneficios</h3>

    <form class="ui large form" method="POST" action="../../controlador/CBeneficios.php" id="formulario" name="formulario">
      <p>Todos los campos son obligatorios.</p>
      <div class="three fields">
        <div class="field">
          <label>Fecha Comienzo<i class="help circle small icon" data-content="Fecha desde la que se ofrece éste beneficio."></i></label>
          <input type="text" class="Fecha" id="FechaIni" name="FechaIni" placeholder="Fecha Comienzo" readonly>
        </div>
        <div class="field">
          <label>Icono</label>
            <?php
              $tagcbotp=$combo->gen_combo_icon("SELECT * FROM cappiutep.t_icono WHERE estatus='1'", "icono","icono", isset($Benef['icono'])?$Benef['icono']:'','Icon',' class="ui dropdown"');
              foreach ($tagcbotp as $tagtp){echo $tagtp;}
            ?>
        </div>
      </div>

      <div class="field">
        <label>Nombre</label>
        <input type="text" id="Nombre" name="Nombre" placeholder="Nombre" onkeypress="return soloLetras(event)">
      </div>

      <div class="field">
        <label>Descripción</label>
        <textarea id="Desc" name="Desc"></textarea>
      </div>

      <div class="three fields">
        
        <div class="field">
          <label>Días mínimos para aprobación<i class="help circle small icon" data-content="Número aproximado de días necesarios para aprobar una solicitud del beneficio."></i></label>
          <input type="number" id="MinDiasAprob" name="MinDiasAprob" onkeypress="return soloNumeros(event)" min='0'>
        </div>

        <div class="field">
          <label>Días máximos para aprobación<i class="help circle small icon" data-content="Número aproximado de días que tardará en ser aprobada una solicitud del beneficio, a partir de éste número de días se considerará que está retrasada."></i></label>
          <input type="number" id="MaxDiasAprob" name="MaxDiasAprob" onkeypress="return soloNumeros(event)" min='0'>
        </div>

        <div class="field">
          <label>Días de antigëdad necesaria<i class="help circle small icon" data-content="Número de días de antigüedad necesarios para que el socio pueda disfrutar del beneficio."></i></label>
          <input type="number" id="MinDiasAnt" name="MinDiasAnt" onkeypress="return soloNumeros(event)" min='0'>
        </div>
      </div>

                    
 
      <div class="ui center aligned block inverted header">
        <input type="hidden" name="opera" id="opera" value="Registrar">
        <input type="button" class="ui primary button" value="Registrar" onclick="enviar(this.value)">
        <div class="ui negative button" onclick="history.go(-1)">
          Cancelar
        </div>
      </div>
    </form>
  </div>
</body>
</html>