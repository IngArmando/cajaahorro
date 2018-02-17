<?php
session_start();

/*  if(!isset($_SESSION["user_name"])){
        header("location: ../pub/inise.php");
    }*/

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Anuncios</title>

  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->   

  <!--  Propiedades -->

  <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->

  <link rel="stylesheet" type="text/css" href="../../css/Bootstrap/css/bootstrap.css"> <!--Bootstrap -->
  <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
  <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
  <link rel="stylesheet" type="text/css" href="../../js/DataTables/media/css/dataTables.bootstrap.css"><!-- Bootstrap Tablas -->
  <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->

  <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->

  <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
  <script src="../../js/main.js"></script> <!--Configura Interfaz -->
  <script src="../../js/DataTablesConfig.js"></script> <!--Configura Interfaz -->
  <script src="../../js/"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/DataTables/media/js/jquery.dataTables.js"></script><!-- Filtro de tabla -->
  <script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js"></script><!-- Bootstrap -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
</head>
<body>  
  <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->         

  <div class="ui container"> 
    <h2 class="ui center aligned small block icon inverted header">
      <i class="announcement  icon"></i>
      Anuncios
    </h2>
    <p>Este módulo gestiona los anuncios y noticias que se muestran en la página web principal, además de contar con la capacidad de difundir el anuncio mediante correo electrónico a todos los socios registrados.</p>

    <div class="ui dividing header"></div>

    <a class="ui labeled icon button" href="Inicio.php">
      <i class="left arrow icon"></i>
      Volver
    </a>

    <a class="ui icon button" href="AnunciosRegistrar.php">
      <i class="add icon"></i>
      Nuevo Anuncio
    </a>


    <h4 class="ui centered block dividing header">Anuncios Registrados</h4>

    <table class='ui celled compact table' id='Tabla'>
      <thead>
        <tr>
          <th class="two wide">Fecha</th>
          <th class="nine wide">Titulo</th>
          <th class="two wide">Estado</th>
          <th class="three wide">Opciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>20/02/2016</td>
          <td>Título de Anuncio 1</td>
          <td>Activo</td>
          <td>
            <div class="ui icon buttons">
              <a class='ui icon button' data-content='Ver detalle' data-variation='basic' href='AnunciosVer.php'>
                <i class='search icon'></i>
              </a>
              <a class='ui icon button' data-content='Modificar' data-variation='basic' href='AnunciosModificar.php'>
                <i class='edit icon'></i>
              </a>
              <a class='ui icon button' data-content='Desactivar' data-variation='basic' >
                <i class='remove icon'></i>
              </a>
              <a class='ui red icon button' data-content='Eliminar' data-variation='basic' >
                <i class='trash icon'></i>
              </a>
            </div>
          </td>
        </tr>
      </tbody>
    </table>  
  </div>


</body>
</html>