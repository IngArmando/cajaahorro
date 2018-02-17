<?php session_start(); ?>
<?php require_once("../../controlador/CCargaHaberes.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Configuraciones | Sistema</title> 
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
  <script src="../../js/JsConfiguracion.js"></script> <!--Validaciones --> 
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
      <i class="upload  icon"></i>
      Carga de Datos Masiva
    </h2>

    <form  class="ui large form" method="POST"  enctype="multipart/form-data">
      <div class="ui segment">
        
        <div class="field">
            <label for="archivoCSV" class="ui icon button">
                <i class="file icon"></i>
                Seleccionar Archivo .CSV</label>
            <input type="file" id="archivoCSV" name="archivoCSV" accept=".csv" style="display:none">
        </div>  

        <div class="field">
          <label>Separador (delimitador): </label> 
          <select name="separador" id="separador" class="ui dropdown compact">
            <option value=",">, (Coma)</option>
            <option value=";">; (Punto y Coma)</option>
          </select>
        </div>

      </div>

      <input type="submit" class="ui blue submit button" name="btnAceptar" value="Aceptar" >
    
    
    <div class="ui block center aligned sub header">Datos a insertar</div>
    <table width="100%" class="ui celled striped table" >
        <?php echo $tablaMostrar; ?>
    </table>
    <?php if($siExiste){ ?>
      <input type="submit" class="ui blue submit button" name="btnImportar" value="Importar Datos"><br />
    <?php } ?>
    </form>
  </div>

</body>
<script type="text/javascript">
  $(document).ready(function(){
    <?php if($resultado==1): ?>
    swal(
      'Exitoso',
      'se ha realizado la carga correctamente',
      'success'
    )
    <?php endif; ?>
  });
</script>
</html>