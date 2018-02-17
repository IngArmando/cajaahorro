<?php
    session_start();

    if(!isset($_SESSION["userActivo"])) {
        header("location: ../pub/inise.php");
    }

  
    include_once("../../modelo/MBeneficios.php");
    $OBenef = new Beneficio();

    include_once("../../modelo/MSocio.php");
    $OSocio = new Socio();

    if (isset($_SESSION["userActivo"]))
    {
      $OSocio -> setCedula($_SESSION["userActivo"]);
      $registro=$OSocio -> busCedula();
      while ( $fila = $OSocio->setArreglo( $registro ))
          $datos[] = $fila;
        foreach ($datos as $Soc) { $Soc; }

        $OSocio -> setIdPersona($Soc["id_persona"]);
        $registro=$OSocio -> busAntig();
        while ( $fila = $OSocio->setArreglo( $registro )) $datos[] = $fila;
        foreach ($datos as $Ant) { $Ant; }

        $registro=$OSocio -> busHaber();
        while ( $fila = $OSocio->setArreglo( $registro )) $datos[] = $fila;
        foreach ($datos as $Hab) { $Hab; }

        isset($Hab['saldo_bloq_prestamo']) ? :$Hab['saldo_bloq_prestamo']=0;
        isset($Hab['saldo_bloq_fianza']) ? :$Hab['saldo_bloq_fianza']=0;

    }
    $OBenef->solicitante = $_SESSION["userActivo"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Retiros</title>

    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->   

    <!--  Propiedades -->

    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->

    <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
    <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
    <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->

    <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
    <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
    <script src="../../js/main.js"></script> <!--Configura Interfaz -->
    <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
    <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
    <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
</head>
<body>  
  <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->

  <div class="ui container">
    <h2 class="ui center aligned small block icon inverted header">
      <i class="external share icon"></i>
      Retiros                
    </h2>    

    <a class="ui labeled icon button" onclick="window.location='Inicio.php' ">
      <i class="left arrow icon"></i>
      Volver
    </a> 
    <div class="ui block dividing header"></div>
    <div style="width:75%;margin:auto;margin-top:30px;margin-bottom:30px" align="justify">
      <div class="ui divided items">
        <?php 
            $cantidad = $OBenef->getCantidadActual();
            if($cantidad>=1){
        ?>
            <div class="item">
                <div class="content">
                    <div class="header">Prestamo en Proceso</div>
                    <div class="description">
                        Usted actualmente tiene un prestamo en proceso, para solicitar un retirto debe esperar la liquidación o rechazo de la solicitud actual
                    </div>
                </div>
            </div>
        <?php
            }else {
        
            echo $OBenef->genItem(4,$Ant['antiguedad'],$Soc['tipo_docente'],'RetiroParcialSolicitud.php'); // (ID del beneficio, antiguedad, tipo de docente, URL de form de solicitud) 
            if($Hab["saldo_bloq_prestamo"]>0 || $Hab["saldo_bloq_fianza"]>0){
                echo '
                    <div class="ui  info message">
                        <i class="circle info icon"></i>
                        No puede hacer un retiro total si tiene saldo bloqueado
                    </div>';
            }else{
                echo $OBenef->genItem(7,$Ant['antiguedad'],$Soc['tipo_docente'],'RetiroTotalSolicitud.php'); // (ID del beneficio, antiguedad, tipo de docente, URL de form de solicitud)     
            }
            
          }
        ?>
      </div> 
    </div>
  </div>

</body>
</html>