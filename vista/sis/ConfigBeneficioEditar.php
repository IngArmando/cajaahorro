<?php
session_start();

  include_once("../../modelo/MCombo.php");
  $combo = new Combo();

  include_once("../../modelo/MBeneficios.php");
  $OBenef = new Beneficio();
   if (isset($_GET['id']))
    {
      $OBenef -> setIdBeneficio($_GET['id']);
      $registro=$OBenef -> consultar();
      while ( $fila = $OBenef->setArreglo( $registro ))
          $datos[] = $fila;
        foreach ($datos as $Benef) { $Benef; }
    }
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
    <h3 class="ui center aligned dividing header">Editar Beneficio</h3>

    <form class="ui large form" method="POST" action="../../controlador/CBeneficios.php" id="formulario" name="formulario">
      <input type="text" name="cod_beneficio" value="<?php if(isset($Benef['id_beneficio'])) echo $Benef['id_beneficio'] ?>">
      <p>Todos los campos son obligatorios.</p>
      <div class="three fields">
        <div class="field">
          <label>Fecha Comienzo<i class="help circle small icon" data-content="Fecha desde la que se ofrece éste beneficio."></i></label>
          <div class="ui transparent input">
            <input type="text" id="FechaIni" name="FechaIni" placeholder="Fecha Comienzo" readonly value="<?php if(isset($Benef['fecha_ini'])) echo date('d/m/Y',strtotime( $Benef['fecha_ini'])) ?>">
          </div>
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
        <input type="text" id="Nombre" name="Nombre" placeholder="Nombre" onkeypress="return soloLetras(event)" value="<?php if(isset($Benef['nombre'])) echo $Benef['nombre'] ?>">
      </div>

      <div class="field">
        <label>Presidente</label>
        <input type="text" id="presidente" name="presidente" placeholder="Presidente" onkeypress="return soloLetras(event)" value="<?php if(isset($Benef['presidente'])) echo $Benef['presidente'] ?>">
      </div>

      <div class="field">
        <label>Encargado</label>
        <input type="text" id="encargado" name="encargado" placeholder="Encargado" onkeypress="return soloLetras(event)" value="<?php if(isset($Benef['encargado'])) echo $Benef['encargado'] ?>">
      </div>

      <div class="field">
        <label>Descripción</label>
        <textarea id="Desc" name="Desc" rows="4" maxlength="600" ><?php if(isset($Benef['descripcion'])) echo $Benef['descripcion'] ?></textarea>
      </div>

      <div class="four fields">
        
       

        <div class="field">
          <label>Valor<i class="help circle small icon" data-content="% a descontar "></i></label>
          <div class="ui left labeled icon input">
            <div class="ui label">%</div>
          <input type="number" id="valores" name="valorp" onkeypress="return soloNumeros(event)" min='0' value="<?php if(isset($Benef['dia_corte'])) echo $Benef['valorp'] ?>">
          </div>
        </div> 

        <div class="field">
          <label>Día de Corte <i class="help circle small icon" data-content="Dia que en el cual el socio debera pagar"></i></label>
          <input type="number" id="corte" name="diacorte" onkeypress="return soloNumeros(event)" min='0' value="<?php if(isset($Benef['dia_corte'])) echo $Benef['dia_corte'] ?>">
        </div> 

        <div class="field">
          <label>Sueldo Base<i class="help circle small icon" data-content="Salario Basico"></i></label>
          <input type="number" id="sueldobase" name="sueldobase" onkeypress="return soloNumeros(event)" min='0' value="<?php if(isset($Benef['sueldo_base'])) echo $Benef['sueldo_base'] ?>">
        </div>

        <div class="field">
          <label>Tasa de Interes</label>
          <div class="ui left labeled icon input">
            <div class="ui label">%</div>
            <input type="number" id="MinDiasAnt" name="Interes" onkeypress="return soloNumeros(event)" min='0' max='100' step="0.01" value="<?php if(isset($Benef['tasa_interes'])) echo number_format($Benef['tasa_interes']) ?>">
          </div>
        </div>
      </div>

                    
 
      <div class="ui center aligned block inverted header">
        <input type="hidden" name="opera" id="opera" value="Guardar Cambios">
        <input type="button" class="ui primary button" value="Guardar Cambios" onclick="enviar(this.value)">
        <div class="ui negative button" onclick="window.location='ConfigBeneficio.php'">
          Cancelar
        </div>
      </div>
    </form>
  </div>
</body>
</html>