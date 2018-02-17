<?php
session_start();
  if (isset($_SESSION['userTemp'])) {
    header('location: Recuperar2.php');
  }

  if (isset($_SESSION['Preguntas'])) {
    session_destroy();
    header('location: Recuperar3.php');
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Recuperar Contraseña</title>
  
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->   
    
  <!--  Propiedades -->

  <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->

  <link rel="stylesheet" type="text/css" href="../../css/Bootstrap/css/bootstrap.css"><!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
  <link rel="stylesheet" type="text/css" href="../../js/sweetalert2/dist/sweetalert2.css">
  <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
  <link rel="stylesheet" type="text/css" href="../../js/DataTables/media/css/dataTables.bootstrap.css"><!-- Bootstrap Tablas -->
  <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->

  <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->

  <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
  <script src="../../js/main.js"></script> <!--Configura Interfaz -->
  <script src="../../js/DataTablesConfig.js"></script> <!--Configura Interfaz -->
  <script src="../../js/"></script> <!--Validaciones -->
  <script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/DataTables/media/js/jquery.dataTables.js"></script><!-- Filtro de tabla -->
  <script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js"></script><!-- Bootstrap -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
</head>
<body>  
<div class="ui container"> 
    <form class="ui large form" method="POST" action="../../controlador/CRecuperar.php" name="formulario">
      <div class="ui center aligned small block icon inverted header">
        <i class='ui help icon'></i>
        Recuperar Contraseña
      </div>

      <div class="ui three steps">
        <div class="active step">
          <i class="user icon"></i>
          <div class="content">
            <div class="title">Usuario</div>
          </div>
        </div>
        <div class=" step">
          <i class="help icon"></i>
          <div class="content">
            <div class="title">Preguntas Secretas</div>
          </div>
        </div>
        <div class="step">
          <i class="lock icon"></i>
          <div class="content">
            <div class="title">Nueva Contraseña</div>
          </div>
        </div>
      </div>                 
      <div class="ui basic center aligned segment">
        <p>Por favor ingrese su usuario:</p>
        <div class="three fields">
          <div class="field"></div>
          <div class="five wide field">
            <label>Usuario</label>
            <div class="ui left icon input">
              <input type="text" name="User" id="User" placeholder="Usuario" onkeypress="return soloNumeros(event)">
              <i class="user icon"></i>
            </div>
          </div>
          <div class="field"></div>
        </div>
      </div>

      <div class="ui center aligned block inverted header">
        <input type="hidden" name="opera" id="opera" value="Rec1">
        <input class="ui primary button" type="submit" value="Continuar">
        <input class="ui red button" type="button" value="Cancelar" onclick="cerrarSesion()"> 
      </div>
    </form>
  </div>  
</body>
</html>