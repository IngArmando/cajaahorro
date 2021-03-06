<?php
    session_start();

    if(!isset($_SESSION["userActivo"])){
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

    include_once("../../modelo/MConfiguracion.php");
    $OConfiguracion = new Configuracion();
    $Datos = $OConfiguracion->consultarConfi();
    $dia_max_prestamo = $Datos['dia_max_prestamo'];
    
?>

<!DOCTYPE html>
<html>
<head>
  <title>Préstamos</title>

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
          <i class="money icon"></i>
          Préstamos              
        </h2>    

        <a class="ui labeled icon button" onclick="window.location='Inicio.php' ">
          <i class="left arrow icon"></i>
          Volver
        </a> 
        <div class="ui block dividing header"></div>
        <div style="width:75%;margin:auto;margin-top:30px;margin-bottom:30px" align="justify">
            <div class="ui divided items">
            <?php
                if ( $Soc['id_tipo_persona'] == '2' )
                {
                  if ( $dia_max_prestamo < date(d) )
                  {
                  	echo "<div class='ui info message'> <i class='fitted info circle icon'></i> <b>NOTA:</b> Solamente puedes visualizar en los préstamos las tablas de amortización como referencia para solicitar un préstamo, pero debido a que las fechas de los prestamos es hasta los días $dia_max_prestamo de cada mes, no puedes generar ningún prestamo. ".date('d')."<br><br></div>";
                  }
                   // echo $OBenef->genItem(1,$Ant['antiguedad'],$Soc['tipo_docente'],'PresEspecialSolicitud.php'); // (ID del beneficio, antiguedad, tipo de docente, URL de form de solicitud)
                    /*if($Hab["saldo_bloq_prestamo"]>0 || $Hab["saldo_bloq_fianza"]>0){
                        echo '
                            <div class="ui  info message">
                                <i class="circle info icon"></i>
                                No puede hacer un prestamo personal si tiene saldo bloqueado
                            </div>';
                    }else{*/
                    if ( $Soc['fcomun'] == '1' )
                    {
                    echo $OBenef->genItem(2,$Ant['antiguedad'],$Soc['tipo_docente'],'PresPersonalSolicitud.php'); // (ID del beneficio, antiguedad, tipo de docente, URL de form de solicitud)
                      //}                
                      //echo $OBenef->genItem(3,$Ant['antiguedad'],$Soc['tipo_docente'],'PresReparacionVehiSolicitud.php'); // (ID del beneficio, antiguedad, tipo de docente, URL de form de solicitud)
                      //echo $OBenef->genItem(6,$Ant['antiguedad'],$Soc['tipo_docente'],'PresHipotecSolicitud.php'); // (ID del beneficio, antiguedad, tipo de docente, URL de form de solicitud)    
                    }

                    if ( $Soc['fcesantia'] == '1' )
                    {
                    echo $OBenef->genItem(1,$Ant['antiguedad'],$Soc['tipo_docente'],'PresEspecialSolicitud.php');// (ID del beneficio, antiguedad, tipo de docente, URL de form de solicitud)
                      //}                
                      //echo $OBenef->genItem(3,$Ant['antiguedad'],$Soc['tipo_docente'],'PresReparacionVehiSolicitud.php'); // (ID del beneficio, antiguedad, tipo de docente, URL de form de solicitud)
                      //echo $OBenef->genItem(6,$Ant['antiguedad'],$Soc['tipo_docente'],'PresHipotecSolicitud.php'); // (ID del beneficio, antiguedad, tipo de docente, URL de form de solicitud)    
                    }
                }
                else
                {
                  echo 'Personal de nómina, no tiene acceso a prestamos.';
                }
            ?>
            </div> <!---->
        </div>
    </div>
</body>
</html>