<?php
    session_start();  
    include_once("../../modelo/MSocio.php");
    $OSocio = new Socio;
    if (isset($_SESSION["userActivo"])) {

        $OSocio -> setIdPersona($_GET["id"]);
        $registro=$OSocio -> busHaber();
        while ( $fila = $OSocio->setArreglo( $registro ))
          $datos[] = $fila;
        foreach ($datos as $Hab) { $Hab; }

        isset($Hab['saldo']) ? :$Hab['saldo']=0;
        isset($Hab['saldo_bloq_prestamo']) ? :$Hab['saldo_bloq_prestamo']=0;
        isset($Hab['saldo_bloq_fianza']) ? :$Hab['saldo_bloq_fianza']=0;
        isset($Hab['fecha_cierre']) ? :$Hab['fecha_cierre']=NULL;

        $datosSocios = $OSocio->getById($_GET["id"]);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>CAPPIUTEP | Haberes <?= mb_strtoupper($datosSocios["nombre1"]." ".$datosSocios["apellido1"],"UTF-8"); ?></title>
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
    <script src="../../js/JsLista.js"></script> <!--Validaciones --> 
    <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
    <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
    <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
    <script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="../../js/DataTables/media/js/jquery.dataTables.js"></script><!-- Filtro de tabla -->
    <script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js"></script><!-- Bootstrap -->
    <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
</head>

<body>

  <?php //include_once('Menu.php'); ?>

  <div class='ui container'>
    <div class='ui center aligned stackable grid'>
      <div class='one column row'>
        <div class='center aligned column'>
          <h2 class='ui center aligned tiny block icon inverted header'>
            <i class='home icon'></i>
            HABERES DE <?= mb_strtoupper($datosSocios["nombre1"]." ".$datosSocios["apellido1"],"UTF-8"); ?>
          </h2>
        </div>
      </div>
      <div class="two column row">
          <div class="eight wide column">
            <h3 class="ui center aligned header">
              <div class="content">
              <i class="blue archive icon"></i>
                Haberes 
                <div class="sub header">Fecha Actualización: <?php if($Hab['fecha_cierre'] == NULL) echo''; else echo date('d/m/Y',strtotime( $Hab['fecha_cierre'] ));  ?></div>
              </div>
            </h3>
            <table class="ui blue table">
              <thead>
                <tr>
                  <th class="left aligned collapsing">Haberes</th>
                  <th class="left aligned collapsing">Monto</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Saldo Disponible <i class="ui fitted circle help icon" data-title="Ayuda" data-content="El saldo disponible representa el monto de sus haberes que puede usar como respaldo para solicitudes de préstamos y financiamientos."></i></td>
                  <td>Bs. <?php echo number_format($Hab['saldo'], 2, ',', '.');  ?></td>
                </tr>
                <tr>
                  <td>Bloqueado(Préstamos) <i class="ui fitted circle help icon" data-title="Ayuda" data-content="El saldo bloqueado por préstamos, representa el monto de sus haberes que se encuentra comprometido como respaldo de sus préstamos."></i></td>
                  <td>Bs. <?php echo number_format($Hab['saldo_bloq_prestamo'], 2, ',', '.');  ?></td>
                </tr>
                <tr>
                  <td>Bloqueado(Fianzas) <i class="ui fitted circle help icon" data-title="Ayuda" data-content="El saldo bloqueado por fianzas, representa el monto de sus haberes que se encuentra comprometido como respaldo de fianzas a los préstamos de otros socios."></i></td>
                  <td>Bs. <?php echo number_format($Hab['saldo_bloq_fianza'], 2, ',', '.');  ?></td>
                </tr>
              </tbody>
              <tfoot >
                <tr>
                  <th>Total</th>
                  <th>Bs. <?php echo number_format($Hab['saldo']-$Hab['saldo_bloq_prestamo']-$Hab['saldo_bloq_fianza'], 2, ',', '.');  ?></th>
                </tr>
              </tfoot>
            </table>
          </div>
      </div> 
            <a href="GestionSolicitudes.php"><< Volver</a>
      </div> 
    </div>
  </div>
</div>
</body>
</html>