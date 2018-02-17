<?php
session_start();
  include('../../modelo/MConfiguracion.php');
  $OConf = new Configuracion;
  $registro=$OConf -> consultar();
  while ( $fila = $OConf->setArreglo( $registro ))
      $datos[] = $fila;
    foreach ($datos as $Conf) { $Conf; }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Configuraciones | Reglas de la Caja de Ahorro</title> 
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
  <script src="../../js/JsOrganizacionReglas.js"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="../../js/DataTables/media/js/jquery.dataTables.js"></script><!-- Filtro de tabla -->
  <script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js"></script><!-- Bootstrap -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha. -->


</head>
<body>  
  <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->         

  <div class="ui container"> 

    <h2 class="ui center aligned small block icon inverted header">
      <i class="book  icon"></i>
      Configuración Reglas de la Caja de Ahorro
    </h2>

    <form class="ui large form" method="POST" action="../../controlador/COrganizacionReglas.php" id="formulario" name="formulario">
          
    <h3 class="ui dividing header">Aportes y Descuentos</h3>
      <div class="ui small info message"><i class="large info circle icon"></i> Los siguientes porcentajes trabajan en base al Salario Mesual del Socio.</div>
        
      <div class="ui two column left aligned grid container">
        <div class="row">

          <div class="column">
            <div class="inline field">
              <label>Porcentaje del Aporte (Socio)&nbsp&nbsp&nbsp &nbsp&nbsp</label>
              <div class="ui left labeled input">
                <div class="ui label">%</div>
                <input type="number" id="ApoSoc" name="ApoSoc" min="1" max="100" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['porcentaje_socio'] ?>">
              </div>
            </div> 
          </div>

          <div class="column">
            <div class="inline field">
              <label>Porcentaje Máximo de Descuentos</label>
              <div class="ui left labeled input">
                <div class="ui label">%</div>
                <input type="number" id="DesMax" name="DesMax" min="0" max="100" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['porcentaje_descuento_max'] ?>">
              </div>
            </div>
          </div>            
        </div>

        <div class="row">

          <div class="column">
            <div class="inline field">
              <label>Porcentaje del Aporte (Patrono)</label>
              <div class="ui left labeled input">
                <div class="ui label">%</div>
                <input type="number" id="ApoPat" name="ApoPat" min="1" max="100" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['porcentaje_patrono'] ?>">
              </div>
            </div>
          </div>

          <div class="column">
            <div class="inline field">
              <label>Porcentaje Mínimo de Descuentos</label>
              <div class="ui left labeled input">
                <div class="ui label">%</div>
                <input type="number" id="DesMin" name="DesMin" min="0" max="100" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['porcentaje_descuento_min'] ?>">
              </div>
            </div>

          </div>            
        </div>
      </div>     

    <h3 class="ui dividing header">Beneficiarios</h3>

        <div class="inline field">
          <label>Mínimo de Beneficiarios</label>
          <input type="number" id="BenMin" name="BenMin"  min="0" max="99" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['num_min_beneficiarios'] ?>">
        </div>
        <div class="inline field">
          <label>Máximo de Beneficiarios</label>
          <input type="number" id="BenMax" name="BenMax"  min="1" max="99" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['num_max_beneficiarios'] ?>">
        </div>        

     

    <h3 class="ui dividing header">Aquiler de Apartamentos en ARENAL</h3>

    <div class="ui two column left aligned grid container">
        <div class="row">

          <div class="column">
            <div class="inline field">
              <label>Mínimo de Noches</label>
              <input type="number" id="NocMin" name="NocMin"  min="1" max="999" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['num_min_noches'] ?>">
            </div> 
          </div>

          <div class="column">
            <div class="inline field">
              <label>Mínimo de Acompañantes</label>
              <input type="number" id="AcoMin" name="AcoMin"  min="1" max="999" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['num_min_acompañantes'] ?>">
            </div>
          </div>            
        </div>

        <div class="row">

          <div class="column">
            <div class="inline field">
              <label>Máximo de Noches</label>
              <input type="number" id="NocMax" name="NocMax"  min="1" max="50" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['num_max_noches'] ?>">
            </div>
          </div>

          <div class="column">
            <div class="inline field">
              <label>Máximo de Acompañantes</label>
              <input type="number" id="AcoMax" name="AcoMax"  min="1" max="50" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['num_max_acompañantes'] ?>">
            </div>  

          </div>            
        </div>
      </div> 

      <h3 class="ui dividing header">Préstamos</h3>

        <div class="inline field">
          <label>Día Límite para Préstamos</label>
          <input type="number" id="DiaMaxPrestamo" name="DiaMaxPrestamo"  min="0" max="99" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['dia_max_prestamo'] ?>">
        </div>

        <div class="inline field">
          <label>Monto Máximo para Préstamos</label>
          <input type="number" id="MontoMaxPrestamo" name="MontoMaxPrestamo"  min="0" max="99" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['monto_max_prestamo'] ?>">
        </div>

        <div class="inline field">
          <label>Moneda</label>
          <input type="text" id="Moneda" name="Moneda"  min="0" max="3" onkeypress="" value="<?php echo $Conf['moneda'] ?>">
        </div>

      <div class="ui center aligned block inverted header">
        <input type="hidden" name="opera" id="opera">
        <input type="button" class="ui primary button" value="Guardar Cambios" onclick="enviar(this.value)">
        <div class="ui negative button" onclick="window.location='Inicio.php'">
          Cancelar
        </div>
      </div>
    </form>
  </div>
</body>
</html>