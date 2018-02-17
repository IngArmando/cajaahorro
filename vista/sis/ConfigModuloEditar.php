<?php
session_start();

  include_once("../../modelo/MCombo.php");
  $combo = new Combo();

  include_once("../../modelo/MModulo.php");
  $OMod = new Modulo();
  $OMod -> setIdModulo($_GET['id']);
  $registro=$OMod -> consultar();
  while ( $fila = $OMod->setArreglo( $registro ))
      $datos[] = $fila;
    foreach ($datos as $Mod) { $Mod; }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Configuraciones | Módulos</title> 
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
  <script src="../../js/JsModulo.js"></script> <!--Validaciones --> 
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
      Módulos
    </h2>
    <h3 class="ui center aligned dividing header">Registrar Módulo</h3>

    <form class="ui large form" method="POST" action="../../controlador/CModulo.php" id="formulario" name="formulario">
      <p>Los campos marcados con * son obligatorios: </p>

      <div class="two fields">
        <div class="required field">
          <label>Descripción</label>
          <input type="text" id="Des" name="Des" placeholder="Descripción" value="<?php if(isset($Mod['descripcion'])) echo $Mod['descripcion'];  ?>" onkeypress="return soloLetras(event)" >
        </div>
        
        <div class="required field">
          <label>Icono</label>
            <?php
              $tagcbotp=$combo->gen_combo_icon("SELECT * FROM cappiutep.t_icono WHERE estatus='1'", "id_icono","icono", isset($Mod['id_icono'])?$Mod['id_icono']:'','Icon',' class="ui search dropdown"');
              foreach ($tagcbotp as $tagtp){echo $tagtp;}
            ?>
        </div>        
      </div>

      <div class="two fields">
        <div class="field">
          <label>Módulo Padre <i class='fitted help circle icon link' data-title="Ayuda" data-content='Sólo en caso de que sea un sub-módulo, indique a que módulo pertenece.' data-variation='basic'></i></label>
          <?php
             $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_modulo WHERE estatus='1'", "id_modulo","descripcion", isset($Mod['id_padre'])?$Mod['id_padre']:'','Padre',' class="ui search dropdown"');
             foreach ($tagcbotp as $tagtp){echo $tagtp;}
          ?>
        </div>
        
        <div class="field">
          <label>Posición <i class='fitted help circle icon link' data-title="Ayuda" data-content='Posición en el menú lateral.' data-variation='basic'></i></label>
          <input type="number" id="Pos" name="Pos" min="1" max="10" onkeypress="return soloNumeros(event)" value="<?php if(isset($Mod['posicion'])) echo $Mod['posicion'];  ?>">
        </div>        
      </div>

      <div class="ui center aligned block inverted header">
        <input type="hidden" name="opera" id="opera" >
        <input type="hidden" name="IdMod" id="IdMod" value="<?php if(isset($_GET['id'])) echo $_GET['id']; ?>">
        <input type="button" class="ui primary button" value="Guardar Cambios" onclick="enviar(this.value)">
        <div class="ui negative button" onclick="window.location='ConfigModulo.php'">
          Cancelar
        </div>
      </div>
    </form>
  </div>
</body>
</html>