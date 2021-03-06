<?php
session_start();

  include_once("../../modelo/MCombo.php");
  $combo = new Combo();

  include_once("../../modelo/MCompra.php");

  $OCompra = new Compra();
  $OCompra -> setid_compra($_GET['id']);
  $registro=$OCompra -> consultar();
  while ( $fila = $OCompra->setArreglo( $registro ))
      $datos[] = $fila;
    foreach ($datos as $Compra) { $Compra; }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title> Casa Comercial </title> 
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
  <script src="../../js/JsCompra.js"></script> <!--Validaciones --> 
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
      Compras
    </h2>
    <h3 class="ui center aligned dividing header"> Modificar Compra </h3>

    <form class="ui large form" method="POST" action="../../controlador/CCompra.php" id="formulario" name="formulario">
      <p>Los campos marcados con * son obligatorios: </p>

      <div class="two fields">
        
        <div class="required field">
          <label> Solicitante </label>
          <?php
            $tagcbotp=$combo->gen_combo("SELECT id_persona,CONCAT(nacionalidad,'-',cedula,' / ',nombre1,' ',apellido1) AS datos FROM cappiutep.t_persona WHERE estatus='1'", "id_persona","datos", isset($Compra['id_persona'])?$Compra['id_persona']:'','id_persona',' class="ui search dropdown" ');
            foreach ($tagcbotp as $tagtp){echo $tagtp;}
          ?>
        </div>

        <div class="required field">
          <label> Casas Comerciales </label>
          <?php
            $tagcbotp=$combo->gen_combo("SELECT id_casa_comercial,descripcion FROM cappiutep.t_casa_comercial WHERE estatus='1'", "id_casa_comercial","descripcion", isset($Compra['id_casa_comercial'])?$Compra['id_casa_comercial']:'','id_casa_comercial',' class="ui search dropdown" ');
            foreach ($tagcbotp as $tagtp){echo $tagtp;}
          ?>
        </div>

      </div>

      <div class="two fields">
        
        
        <div class="field">
          <div class="required field">
            <label> Monto </label>
            <input type="text" id="monto" name="monto" onkeypress="return soloNumeros(event)" value="<?php if(isset($Compra['monto'])) echo $Compra['monto']; ?>" >
          </div>
        </div>        

        <div class="required field">
          <label> Descripción </label>
          <textarea id="descripcion" name="descripcion" placeholder="Ingrese aquí la descripción de la compra" > <?php if(isset($Compra['descripcion'])) echo $Compra['descripcion']; ?> </textarea>
        </div>

      </div>

      <div class="two fields">
        
        <div class="required field">
          <label> Año </label>
          <select class="ui dropdown selection" name="ano" id="ano">
            <?php
              for ($d=2017; $d<=date(Y); $d++) { 
                $selected = ( $Compra['ano'] == $g ) ? "selected" : "";
                echo '<option value="'.$d.'" $selected>'.$d.'</option>';
              }
            ?>
          </select>
        </div>

        <div class="required field">
          <label> Mes </label>
          <select class="ui dropdown selection" name="mes" id="mes">
            <?php
              for ($g=1; $g<=12; $g++) { 
                $selected = ( $Compra['mes'] == $g ) ? "selected" : "";
                echo '<option value="'.$g.'" '.$selected.'>'.meses($g).'</option>';
              }
            ?>
          </select>
        </div>

        <?php

          function meses($me)
          {
            # code...
            if($me == 1){ $mess="Enero" ;}
            if($me == 2){ $mess="Febrero" ;}
            if($me == 3){ $mess="Marzo" ;}
            if($me == 4){ $mess="Abril" ;}
            if($me == 5){ $mess="Mayo" ;}
            if($me == 6){ $mess="Junio" ;}
            if($me == 7){ $mess="Julio" ;}
            if($me == 8){ $mess="Agosto" ;}
            if($me == 9){ $mess="Septiembre" ;}
            if($me == 10){ $mess="Octubre" ;}
            if($me == 11){ $mess="Noviembre" ;}
            if($me == 12){ $mess="Diciembre" ;}

            return $mess;
          }
         
        ?>

      </div>

      <div class="ui center aligned block inverted header">
        <input type="hidden" name="opera" id="opera" >
        <input type="hidden" name="id_compra" id="id_compra" value="<?php if(isset($_GET['id'])) echo $_GET['id']; ?>">
        <input type="button" class="ui primary button" value="Guardar Cambios" onclick="enviar(this.value)">
        <div class="ui negative button" onclick="window.location='Compra.php'">
          Cancelar
        </div>
      </div>
    </form>
  </div>
</body>
</html>