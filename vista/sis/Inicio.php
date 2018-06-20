<?php
    session_start();
    include_once("../../modelo/MSocio.php");
    include_once("../../modelo/MBeneficios.php");
    include_once("../../modelo/MConfiguracion.php");
    $OConf = new Configuracion;
    $OSocio = new Socio;
    $OBeneficio = new Beneficio;
    $moneda = $OConf->consultarConf("moneda");
    $moneda = $moneda[0];
    if (isset($_SESSION["userActivo"])){
        $OSocio -> setCedula($_SESSION["userActivo"]);
        $registro=$OSocio -> busCedula();
        while ( $fila = $OSocio->setArreglo( $registro ))
            $datos[] = $fila;
        foreach ($datos as $Soc) { $Soc; }

        $OSocio -> setIdPersona($Soc["id_persona"]);
        $registro=$OSocio -> busHaber();
        while ( $fila = $OSocio->setArreglo( $registro ))
          $datos[] = $fila;
        foreach ($datos as $Hab) { $Hab; }

        $registro=$OSocio -> getIdPerCaja();
        while ( $fila = $OSocio->setArreglo( $registro ))
          $datos[] = $fila;
        foreach ($datos as $Caja) { $Caja; }

        isset($Hab['saldo']) ? :$Hab['saldo']=0;
        isset($Hab['saldo_bloq_prestamo']) ? :$Hab['saldo_bloq_prestamo']=0;
        //isset($Hab['saldo_bloq_fianza']) ? :$Hab['saldo_bloq_fianza']=0;
        isset($Hab['fecha_cierre']) ? :$Hab['fecha_cierre']=NULL;

        $solicitudes = $OBeneficio->ListarSolicitudesSocio($Caja['id_persona']);
    }

    $_SESSION["personaje"]= $Soc["id_persona"];

    @include_once('funciones_generales.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>ASOCIACIÓN DE EMPLEADOS MUNICIPALES DE PASTAZA | Inicio</title>
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

  <?php include_once('Menu.php'); ?>

  <div class='ui container'>
    <div class='ui center aligned stackable grid'>
      <div class='one column row'>
        <div class='center aligned column'>
          <h2 class='ui center aligned tiny block icon inverted header'>
            <i class='home icon'></i>
            Inicio                
          </h2>
        </div>
      </div>
      <div class="two column row">
          <div class="eight wide column">
            <h3 class="ui center aligned header">
              <div class="content">
              <i class="blue archive icon"></i>
                Saldo Actual 
                <div class="sub header">Fecha Actualización: <?php if($Hab['fecha_cierre'] == NULL) echo''; else echo date('d/m/Y',strtotime( $Hab['fecha_cierre'] ));  ?></div>
              </div>
            </h3>
            <table class="ui blue table">
              <thead>
                <tr>
                  <th class="left aligned collapsing">Aportes</th>
                  <th class="left aligned collapsing">Saldo</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th style="width: 60%;">Fondo Comun</th>
                  <th>
                      <?php
                          @include_once('../../modelo/MPgsql.php');
                          $dbt=new CModeloDatos;
                          $dbf=new CModeloDatos;
                          $dbca=new CModeloDatos;

                         $sqlh="select sum(aportado,aportado_fondo) as aportes from cappiutep.aporte where id_persona='".$Soc["id_persona"]."' AND tipo='2' ";
                          $df=$dbf->ejecutar($sqlh); $rowf=$dbf->getArreglo($df);
                           $sqlha="select sum(aportado_fondo) as aportesf from cappiutep.aporte where id_persona='".$Soc["id_persona"]."' AND tipo='2' ";
                          $dfa=$dbf->ejecutar($sqlha); $rowf=$dbf->getArreglo($dfa);
                          $ap=$rowf['aportes'] + $rowf['aportesf'] + $Soc["aporte_comun"];

                          $sqlca="select sum(monto) as resta_aporte from cappiutep.contra_aporte where tipo='2' AND id_persona='".$Soc["id_persona"]."' ";
                          $ca=$dbt->ejecutar($sqlca); $rowca=$dbf->getArreglo($ca);

                         $ap=$ap-$rowca['resta_aporte'];
                    
                      echo '$ '.$ap; ?>
                      
                  </th>
                </tr>

                <tr>
                  <th>Fondo Cesantia</th>
                  <th><?php
                         

                          $sqly="select sum(aportado) as aportes from cappiutep.aporte where id_persona='".$Soc["id_persona"]."' AND tipo='1' ";
                          $dft=$dbt->ejecutar($sqly); $rowft=$dbt->getArreglo($dft);

                           $sqlya="select sum(aportado_fondo) as aportesf from cappiutep.aporte where id_persona='".$Soc["id_persona"]."' AND tipo='1' ";
                          $dfta=$dbt->ejecutar($sqlya); $rowft=$dbt->getArreglo($dfta);

                          $apa=$rowft['aportes'] + $rowft['aportesf'] + $Soc['aporte_cesantia'];

                          $sqlca="select sum(monto) as resta_aporte from cappiutep.contra_aporte where tipo='1' AND id_persona='".$Soc["id_persona"]."' ";
                          $ca=$dbt->ejecutar($sqlca); $rowca=$dbf->getArreglo($ca);

                         $apa=$apa-$rowca['resta_aporte'];

                    
                      echo '$ '.$apa; ?>
                   </th>

                </tr>

                <!--tr>
                  <td>Saldo </td>
                  <td>$ <?php echo number_format($Hab['saldo']);  ?></td>
                </tr>
                <tr>
                  <td>Bloqueado(Préstamos) <i class="ui fitted circle help icon" data-title="Ayuda" data-content="El saldo bloqueado por préstamos, representa el monto de sus haberes que se encuentra comprometido como respaldo de sus préstamos."></i></td>
                  <td>$ <?php echo number_format($Hab['saldo_bloq_prestamo']);  ?></td>
                </tr>
              </tbody>
              <tfoot >
                <tr>
                  <th>Total Disponible <i class="ui fitted circle help icon" data-title="Ayuda" data-content="El saldo disponible representa el monto de sus haberes que puede usar como respaldo para solicitudes de préstamos y financiamientos."></i></th>
                  <th>$ <?php echo number_format( ($Hab['saldo']-$Hab['saldo_bloq_prestamo']));  ?></th>
                </tr>
              </tfoot!-->
            </table>

          </div>
          <div class="column">
            <h3 class="ui center aligned header">
              <div class="content">
              <i class="blue history icon"></i>
                Actividad Reciente
                <div class="sub header">&nbsp;</div>
              </div>
            </h3>
            <div class="ui blue segment large celled feed">
              <?php 
                $actividad=$OSocio -> listarActvidad($_SESSION['userActivo']);
                foreach ($actividad as $act){echo $act;}
              ?>
            </div>
          </div>
      </div> 
      <div class="one column row">
        <div class="column">
          <h3 class="ui center aligned header"><i class="blue open folder  icon"></i>Solicitudes en Trámite</h3>
          <table class="ui center aligned blue table">
            <thead>
              <th>N°</th>
              <th>Fecha</th>
              <th>Tipo de Solicitud</th>
              <th>Monto Solicitado</th>
              <th>Estatus</th>
              <th>Acciones</th>
            </thead>
            <tbody>
                <?php if($solicitudes): ?>
                    <?php foreach($solicitudes as $index => $solicitud): ?>
                        <tr>
                            <td><?php echo ($index+1) ?></td>
                            <td><?php echo $OBeneficio->set_fecha($solicitud["fecha"]); ?></td>
                            <td><?php echo $OBeneficio->set_fecha($solicitud["tipo"]); ?></td>
                            <td><?php echo $moneda.number_format($solicitud["monto"] + $solicitud["monto_pago_especial"], 2, ',', '.'); ?></td>
                            <td><?php
                                      switch ($solicitud['estatus']) {
                                        case '1':
                                          $estado='En análisis';
                                          break;
                                        case '2':
                                          $estado='Esperando aprobación';
                                          break;
                                        case '3':
                                          $estado='Aprobado / Liquidando';
                                          break;
                                        case '4':
                                          $estado='Liquidado';
                                          break;
                                        case '5':
                                          $estado='Rechazado (Análisis)';
                                          break;
                                        case '6':
                                          $estado='Rechazado (Junta Dir.)';
                                          break;
                                      }
                                      echo $estado?></td>
                            <td>
                              <div class='ui icon button' data-content='Ver Solicitud' data-variation='basic' onclick="javascript:location.href='SolicitudVer.php?id=<?php echo $solicitud["id_beneficio_solicitud"] ?>'">
                                <i class='small search icon'></i>
                              </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php if(!$solicitudes): ?>
                <tr>
                    <td colspan="6">No está tramitando ninguna solicitud en éste momento.</td>
                </tr>
            <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div> 
    </div>
  </div>
</div>
</body>
</html>
