<?php
session_start();

  include('../../modelo/MBeneficios.php');
  $OBenef = new Beneficio;
  $OBenef -> setIdBeneficio($_GET['id']);
  $registro=$OBenef -> consultar();
  while ( $fila = $OBenef->setArreglo( $registro ))
      $datos[] = $fila;
    foreach ($datos as $Benef) { $Benef; }

  include_once("../../modelo/MCombo.php");
  $combo = new Combo();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Configuraciones | Beneficios | Requisitos</title> 
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
  <script src="../../js/JsBeneficioRequisito.js"></script> <!--Validaciones --> 
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
      <i class="unordered list  icon"></i>
      Valores de Lista
    </h2>
    <h3 class="ui center aligned dividing header">Registrar Requisitos de  <?php echo $Benef['nombre'] ?></h3>

    <form class="ui large form" method="POST" action="../../controlador/CBeneficioRequisito.php" id="formulario" name="formulario">
      <div class="two fields">
        <div class="field">
          <label>Requisito</label>
          <?php
            $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=6  ORDER BY posicion", "id_lista_valor","nombre_largo", isset($_GET[''])?$_GET['']:'','Req',' class="ui search dropdown"');
            foreach ($tagcbotp as $tagtp){echo $tagtp;}
          ?>
        </div>
        <div class="field">
          <div class="ui clearing center aligned basic segment">          
            <div class="ui toggle checkbox">
              <input type="checkbox" name="Oblig" id="Oblig">
              <label for="Oblig"><b>Obligatorio</b></label>
            </div>
          </div>
        </div>
      </div>

          
      <div class="ui center aligned block inverted header">
        <input type="hidden" name="IdBene" id="IdBene" value="<?php echo $_GET['id'] ?>">
        <input type="button" class="ui primary button" value="Registrar" onclick="enviar(this.value)">
        <div class="ui negative button" onclick="history.go(-1)">
          Cancelar
        </div>
      </div>
    </form>
  </div>
</body>
</html>