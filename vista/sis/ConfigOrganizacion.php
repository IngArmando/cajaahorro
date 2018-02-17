<?php
session_start();
  include('../../modelo/MOrganizacion.php');
  $OOrg = new Organizacion;
  //$OOrg -> setIdListaValor($_GET['id']);
  $registro=$OOrg -> consultar();
  while ( $fila = $OOrg->setArreglo( $registro ))
      $datos[] = $fila;
    foreach ($datos as $Org) { $Org; }

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
  <title>Configuraciones | Organización</title> 
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
  <script src="../../js/JsOrganizacion.js"></script> <!--Validaciones --> 
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
      <i class="building outline icon"></i>
      Organización
    </h2>

    <form class="ui large form" method="POST" action="../../controlador/COrganizacion.php" id="formulario" name="formulario">
      <p>Los campos marcados con <i class="fitted asterisk icon"></i> son obligatorios.</p>
      <div class="three fields">
        <div class="required field">
          <label>R.I.F.</label>
          <input type="text" id="Rif" name="Rif" placeholder="R.I.F." value="<?php echo $Org['rif'] ?>" maxlength="10">
        </div>
        <div class="field">
          <label>N.I.T.</label>
          <input type="text" id="Nit" name="Nit" placeholder="N.I.T." value="<?php echo $Org['nit'] ?>" maxlength="10" >
        </div>
        <div class="field">
          <label>Siglas</label>
          <input type="text" id="Siglas" name="Siglas" placeholder="Siglas" value="<?php echo $Org['siglas'] ?>"  maxlength="20">
        </div>
      </div>

      <div class="required field">
        <label>Razon Social</label>
        <textarea class="ui textarea" name="Razon" id="Razon" rows="2"  maxlength="200"><?php echo $Org['razon_social'] ?></textarea>
      </div>

      <div class="two fields">
        <div class="required field">
          <label>Teléfono </label>
          <input type="text" id="Telf" name="Telf" placeholder="Teléfono" value="<?php echo $Org['telefono'] ?>" maxlenght="11" onkeypress="return soloNumeros(event)">
        </div>
        <div class="required field">
          <label>Correo Electrónico</label>
          <input type="text" id="Email" name="Email" placeholder="Correo Electrónico" value="<?php echo $Org['email'] ?>" maxlength="120">
        </div>
      </div>

        <div class="required field">
          <label>Dirección Fiscal </label>
          <div class="field">
            <textarea class="ui textarea" name="DirFiscal" id="DirFiscal" rows="2"  maxlength="500"><?php echo $Org['dir_fiscal'] ?></textarea>
          </div>
        </div>

        <div class="required field">
          <label>Misión </label>
          <textarea id="Mision" name="Mision" rows="3" class="ui textarea" maxlength="800"><?php echo $Conf['mision'] ?></textarea>
        </div>

        <div class="required field">
          <label>Visión </label>
          <textarea id="Vision" name="Vision" rows="3" class="ui textarea" maxlength="800"><?php echo $Conf['vision'] ?></textarea>
        </div>

        <div class="required field">
          <label>Reseña Histórica </label>
          <textarea id="Histor" name="Histor" rows="3" class="ui textarea" maxlength="800"><?php echo $Conf['historia'] ?></textarea>
        </div>
        
      <div class="ui center aligned block inverted header">
        <input type="hidden" name="opera" id="opera">
        <input type="button" class="ui primary button" value="Guardar Cambios" onclick="enviar(this.value)">
        <div class="ui negative button" onclick="window.location='inicio.php'">
          Cancelar
        </div>
      </div>
    </form>
  </div>
</body>
</html>