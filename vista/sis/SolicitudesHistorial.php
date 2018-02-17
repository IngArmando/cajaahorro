<?php
    session_start();
    if(!isset($_SESSION["userActivo"])){
        header("location: ../pub/inise.php");
    }

    include_once("../../modelo/MCombo.php");
    $combo = new Combo();

    include_once("../../modelo/MBeneficios.php");
    $OBenef = new Beneficio();
    $tasaInteres = $OBenef->get_tasa_interes(1);

    include_once("../../modelo/MSocio.php");
    $OSocio = new Socio();

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        //obtenemos los datos del prestamo
        $datosSolicitud = $OBenef->buscarSolicitud($id);
        $haberesSocio = $OSocio->getHaberes($datosSolicitud["id_persona"]);
    }

    if (isset($_SESSION["userActivo"])){
        $OSocio -> setCedula($_SESSION["userActivo"]);
        $registro=$OSocio -> busCedula();
        while ( $fila = $OSocio->setArreglo( $registro )) $datos[] = $fila;
        foreach ($datos as $Soc) { $Soc; }
    }

    $tipoDocente = $Soc["tipo_docente"];
    $condiciones = $OBenef->getCondiciones(1,$tipoDocente);
  
?>
<!DOCTYPE html>
<html>
<head>
  <title>Historial de Solicitudes</title> 
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->
  <!--  Propiedades -->
    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
    <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
  <link rel="stylesheet" type="text/css" href="../../js/sweetalert2/dist/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
    <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->
  <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
  <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
  <script src="../../js/main.js"></script> <!--Configura Interfaz -->
  <script src="../../js/JsHistorial.js"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
  
</head>
<body>  
  <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->
  <div class="ui container">
    <h2 class="ui center aligned small block icon inverted header">
      <i class="history icon"></i>
      Historial de Solicitudes               
    </h2>

        <a class="ui labeled icon button" href="Inicio.php">
          <i class="left arrow icon"></i>
          Volver
        </a> 
        <div class="ui dividing header"></div>
        <form class="ui large form" method="POST" action="../../fpdf/PDFHistorial.php" name="formulario" id="formulario" target="_BLANK">
          <div class="ui center aligned three column grid divided form">
            <div class="column">
              <div class="ui sub header">Buscar por fecha</div>
                <br>
                <div class="inline field">
                  <label>Desde: </label>
                    <div class="ui left labeled input">
                      <input type="text" name="Desde" id="Desde" placeholder='dd/mm/aaaa' readonly class="Fecha">
                    </div>
                </div> 
                <br>
                <div class="inline field">
                  <label>Hasta: </label>
                    <div class="ui left labeled input">
                      <input type="text" name="Hasta" id="Hasta" placeholder='dd/mm/aaaa' readonly class="Fecha">
                    </div>
                </div> 

            </div>
            <div class="column">
              <div class="ui sub header">Filtrar por Beneficio</div>
              <br>
              <div class="field">
                <label>Beneficio</label>
                  <?php
                    $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_beneficio WHERE estatus='1'", "id_beneficio","nombre", '','Beneficio',' class="ui search dropdown"');
                    foreach ($tagcbotp as $tagtp){echo $tagtp;}
                  ?>
              </div> 
            </div>
            <div class="column">
              <div class="ui sub header">Filtrar por Estatus</div>
              <br>
              <div class="field">
                <label>Estatus</label>
                 <select class="ui dropdown" name="Estatus">
                   <option></option>
                   <option value="1">En análisis</option>
                   <option value="2">Esperando aprobación</option>
                   <option value="3">Aprobado</option>
                   <option value="4">Liquidado</option>
                   <option value="5">Rechazado (Análisis)</option>
                   <option value="5">Rechazado (Junta Directiva)</option>
                 </select>
              </div> 

            </div>
          </div>
          <br>
          <div class="error message"></div>
          <div class="ui center aligned segment">
            <div class="ui blue submit button"><i class='ui search icon'></i>Buscar</div>
            <div class="ui reset button">Reestablecer</div>
          </div>
        </form>
          
  </div>

</body>
</html>
