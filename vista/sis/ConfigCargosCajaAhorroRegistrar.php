<?php
session_start();

  include_once("../../modelo/MCombo.php");
  $combo = new Combo();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Configuraciones | Cargos de la Caja de Ahorro</title> 
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
  <script src="../../js/JsCargosCajaAhorro.js"></script> <!--Validaciones --> 
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
      <i class="users  icon"></i>
      Cargos de la Caja de Ahorro
    </h2>
    <h3 class="ui center aligned dividing header">Registrar Cargos de Caja de Ahorro</h3>

    <form class="ui large form" method="POST" action="../../controlador/CCargosCajaAhorro.php" id="formulario" name="formulario">
      <p>Los campos marcados con <i class="fitted asterisk icon"></i> son opcionales.</p>
      <div class="three fields">
        <div class="field">
          <label>Nombre</label>
          <input type="text" id="Nombre" name="Nombre" placeholder="Nombre" onkeypress="return soloLetras(event)">
        </div>
        <div class="field">
        </div>
        <div class="field">
          <label>Fecha Comienzo</label>
          <input type="text" id="FechaIni" name="FechaIni" placeholder="dd/mm/aaaa" class="Fecha" readonly>
        </div>        
      </div>

      <div class="field">
          <label>Descripción<i class="fitted mini asterisk icon"></i></label>
        <textarea name="Desc" id="Desc" rows="3" class="ui textarea"></textarea>
      </div>

      <div class="three fields">

        <div class="field">
          <label>Tipo de Cargo</label>
          <div class="field">
            <?php
            $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=22", "id_lista_valor","nombre_largo", isset($_GET[''])?$_GET['']:'','TipoCargo',' class="ui dropdown"');
            foreach ($tagcbotp as $tagtp){echo $tagtp;}
            ?>
          </div>
        </div>

        <div class="field">
          <label>Mín. Número de Personas <i class="fitted circle help icon" data-content="Número minimo de personas que pueden tener éste cargo, si no existe dejar en 0"></i></label>
          <input type="number" id="MinPers" name="MinPers" onkeypress="return soloNumeros(event)" min="0" max="15" maxlength="2">
        </div>

        <div class="field">
          <label>Máx. Número de Personas <i class="fitted circle help icon" data-content="Número máximo de personas que pueden tener éste cargo, si no existe introducir 9999"></i></label>
          <input type="number" id="MaxPers" name="MaxPers" onkeypress="return soloNumeros(event)" min="0" max="9999" maxlength="4">
        </div>
 
      </div>      
      <div class="ui center aligned block inverted header">
        <input type="hidden" name="opera" id="opera">
        <input type="button" class="ui primary button" value="Registrar" onclick="enviar(this.value)">
        <div class="ui negative button" onclick="history.go(-1)">
          Cancelar
        </div>
      </div>
    </form>
  </div>
</body>
</html>