<?php
    session_start();
    if(!isset($_SESSION["userActivo"])){
        header("location: ../pub/inise.php");
    }
    include_once("../../modelo/MCombo.php");
    $combo = new Combo();
    include_once("../../modelo/MBeneficios.php");
    $OBenef = new Beneficio();
    include_once("../../modelo/MConfiguracion.php");
    $OConf = new Configuracion;
    $moneda = $OConf->ConsultarConf("moneda");
    $moneda = $moneda[0];
    $tasaInteres = $OBenef->get_tasa_interes(1);
    include_once("../../modelo/MSocio.php");
    $OSocio = new Socio();
    if(isset($_GET["id"])){
        $id =  filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
        //obtenemos los datos del prestamo
        $datosSolicitud = $OBenef->buscarSolicitud($id);
        //if($datosSolicitud["id_beneficio"]==2)
        //    $datosFiadores = $OBenef->buscarFiadores($id);
        //$haberesSocio = $OSocio->getHaberes($datosSolicitud["id_persona"]);
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Solicitud</title>

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
  <style type="text/css">
    @media print{
      .noprint{
        display: none;
        visibility: hidden;
      }
    }
  </style>
</head>
<body>  
  <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->
  <div class="ui container"> 
        <a class="noprint ui right floated labeled icon button" onclick="verReporte(<?= $id ?>)">
            <i class="file pdf icon"></i>
            Ver Pdf
        </a>
        <a class="noprint ui right floated labeled icon button" href="javascript:void(0)" onclick="javascript:window.print()">
            <i class="print icon"></i>
            Imprimir
        </a>
  <?php
    switch ($datosSolicitud['id_beneficio']) {
      case '1':

  ?>
  <h2 class="ui center aligned small block icon inverted header">
      <i class="money icon"></i>
      Préstamos                
    </h2>
    <form class="ui large form" method="POST" action="../../ctrl/c_prestamo_especial.php" name="formulario" id="formulario">
        
    <h3 class="ui center aligned header">Préstamo de Fondo Común</h3> 
                  
    <h4 class="ui dividing header">Datos del solicitante</h4>
      <div class="three fields">
          <div class="field">
            <label>Cédula</label>
            <div class="ui transparent input"><!-- Nro Cedula -->
              <input type="text" name="Cedu" id="Cedu" value="<?php if(isset($datosSolicitud['cedula'])) echo $datosSolicitud['nacionalidad'].'-'.$datosSolicitud['cedula']; ?>" readonly>
            </div>
          </div>

          <div class="field"><!-- Nombre -->
            <label>Nombre y Apellido</label>
            <div class="ui transparent input">
              <input type="text" name="Nombre" id="Nombre"  value="<?php if(isset($datosSolicitud['nombre1'])) echo $datosSolicitud['nombre1'].' '.$datosSolicitud['apellido1']; ?>" readonly>
            </div>
          </div>
      </div>
    <h4 class="ui dividing header">Datos de la solicitud</h4>
      <div class="three fields">
        <div class="field">
           <label>Monto Solicitado </label>
           <div class="ui input">
		<?php echo ($moneda.$datosSolicitud['monto']) ?>
           </div>
          </div>
        <div class="field">
           <label>Tasa de Interés (%):</label>
           <div class="ui  input">
              <?php echo $datosSolicitud['interes_cuotas'] ?>
           </div>
          </div>
        <!--<div class="field">
           <label>Total a cancelar:</label>
           <div class="ui transparent input">
              <input type="text" name="total_cancelar" id="total_cancelar" readonly value="<?php printf('%.2f',($datosSolicitud['monto'] * $datosSolicitud['interes_cuotas'] / 100) + $datosSolicitud['monto']) ?>">
           </div>
          </div>-->
      </div>
      <!--
      <div class="ui two blue cards">

              <div class="ui card">
                <div class="content">
                  <div class="ui small header">Analizado por:</div>
                  <div class="description">
                    <div class="field">
                      <label>Nombre y Apellido</label>
                      <div class="ui transparent input">
                        <input type="text" name="Nombre" id="Nombre"  value="Analista" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="extra content">
                  <div class="right floated date">
                    <div class="inline field">
                      <label>Fecha de respuesta: </label>
                      <div class="ui transparent input">
                        <input type="text" name="Nombre" id="Nombre"  value="dd/mm/aaaa" readonly>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 

              <div class="ui disabled card">
                <div class="content">
                  <div class="ui small header">Aprobado por:</div>
                  <div class="description">
                    <div class="field">
                      <label>Nombre y Apellido</label>
                      <div class="ui transparent input">
                        <input type="text" name="Nombre" id="Nombre"  value="Directivo" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="extra content">
                  <div class="right floated date">
                    <div class="inline field">
                      <label>Fecha de respuesta: </label>
                      <div class="ui transparent input">
                        <input type="text" name="Nombre" id="Nombre"  value="dd/mm/aaaa" readonly>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  

            </div>
            -->
    <?php 
        break; //fin del case 1

        case 2:
    ?>
    <h2 class="ui center aligned small block icon inverted header">
        <i class="money icon"></i>
        Préstamos                
    </h2>
    <form class="ui large form" method="POST" action="../../ctrl/c_prestamo_personal.php" name="formulario" id="formulario">
    
        <h3 class="ui center aligned header"> Analísis del Préstamo de Fondo Común</h3> 
              
        <h4 class="ui dividing header">Datos del solicitante</h4>
        <div class="three fields">
            <div class="field">
                <label>Cédula</label>
                <div class="ui transparent input"><!-- Nro Cedula -->
                    <input type="text" name="Cedu" id="Cedu" value="<?php if(isset($datosSolicitud['cedula'])) echo $datosSolicitud['nacionalidad'].'-'.$datosSolicitud['cedula']; ?>" readonly>
                </div>
            </div>

            <div class="field"><!-- Nombre -->
                <label>Nombre y Apellido</label>
                <div class="ui transparent input">
                <input type="text" name="Nombre" id="Nombre"  value="<?php if(isset($datosSolicitud['nombre1'])) echo $datosSolicitud['nombre1'].' '.$datosSolicitud['apellido1']; ?>" readonly>
                </div>
            </div>
        </div>
        <h4 class="ui dividing header">Datos de la solicitud</h4>
        <div class="three fields">
            <div class="field">
                <label>Monto Solicitado: </label>
                <div class="ui input">
                    <?php echo $moneda.(number_format($datosSolicitud['monto'],2,",",".")) ?>
                </div>
            </div>
            <div class="field">
                <label>Plazos:</label>
                <div class="ui transparent input">
                    <?php echo $datosSolicitud['cuotas'] ?>
                </div>
            </div>
            <div class="field">
                <label>Tasa de Interés (%):</label>
                <div class="ui  input">
                    <?php echo $datosSolicitud['interes_cuotas'] ?>
                </div>
            </div>
            
        </div>
        <h4 class="ui dividing header">Tabla de Amortización</h4>
       <div>
          <table class="ui table">
              <thead>
                  <tr>
                      <th height="10">Nro</th>
                      <th height="20">Mes</th>
                      <th height="40">Año</th>
                      <th height="40">Capital</th>
                      <th height="40">Interés</th>
                      <th height="40">Cuota</th>
                      <th height="40">Saldo</th>
                  </tr>
              </thead>
              <tbody id="tablaAmortizacion">

              </tbody>
          </table>

      </div>
<!--
        <div>
                <h4 class="ui dividing header">Fiadores</h4>
                <table class="ui table">
                    <thead>
                        <tr>
                            <th>Fiador</th>
                            <th>Cantidad a Prestar</th>
                            <th>Haberes Disponibles</th>
                            <th>Cantidad Máxima a Prestar (80%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($datosFiadores as $idx => $fiadores): ?>
                            <tr>
                                <td><?= $fiadores["nombre1"]." ".$fiadores["apellido1"] ?></td>
                                <td><?php echo number_format($fiadores["prestamo"])  ?> </td>
                                <?php 
                                    $OSocio -> setIdPersona($fiadores["idpersona"]);
                                    $registro=$OSocio -> busHaber();
                                    $Hab = $OSocio->getArreglo($registro);
                                ?>
                                <td>
                                    <?php echo number_format($Hab['saldo']-$Hab['saldo_bloq_prestamo']-$Hab['saldo_bloq_fianza'], 0, ',', '.');  ?>
                                </td>
                                <td>
                                    <?php 
                                        $maxima = ($Hab['saldo']-$Hab['saldo_bloq_prestamo']-$Hab['saldo_bloq_fianza']) * 0.8;
                                        echo number_format($maxima, 0, ',', '.');
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <div class="ui two blue cards">

              <div class="ui card">
                <div class="content">
                  <div class="ui small header">Analizado por:</div>
                  <div class="description">
                    <div class="field">
                      <label>Nombre y Apellido</label>
                      <div class="ui transparent input">
                        <input type="text" name="Nombre" id="Nombre"  value="Analista" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="extra content">
                  <div class="right floated date">
                    <div class="inline field">
                      <label>Fecha de respuesta: </label>
                      <div class="ui transparent input">
                        <input type="text" name="Nombre" id="Nombre"  value="dd/mm/aaaa" readonly>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 

              <div class="ui disabled card">
                <div class="content">
                  <div class="ui small header">Aprobado por:</div>
                  <div class="description">
                    <div class="field">
                      <label>Nombre y Apellido</label>
                      <div class="ui transparent input">
                        <input type="text" name="Nombre" id="Nombre"  value="Directivo" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="extra content">
                  <div class="right floated date">
                    <div class="inline field">
                      <label>Fecha de respuesta: </label>
                      <div class="ui transparent input">
                        <input type="text" name="Nombre" id="Nombre"  value="dd/mm/aaaa" readonly>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  

        </div>-->
    <?php
        break;//Fin case 2

      case '3':
      case '4':
      case '7':
      case '5':
    ?>
  <h2 class="ui center aligned small block icon inverted header">
            <i class="add cart icon"></i>
            Financiamientos                
        </h2>
        <form class="ui large form" method="POST" name="formulario" id="formulario" autocomplete="off" action="../../controlador/CSolicitudEspecial.php">
        
            <h3 class="ui center aligned header"> Solicitud</h3> 
             <h4 class="ui dividing header">Datos del solicitante</h4>
            <div class="three fields">
                <div class="field">
                  <label>Cédula</label>
                  <div class="ui transparent input"><!-- Nro Cedula -->
                    <input type="text" name="Cedu" id="Cedu" value="<?php if(isset($datosSolicitud['cedula'])) echo $datosSolicitud['nacionalidad'].'-'.$datosSolicitud['cedula']; ?>" readonly>
                  </div>
                </div>

                <div class="field"><!-- Nombre -->
                  <label>Nombre y Apellido</label>
                  <div class="ui transparent input">
                    <input type="text" name="Nombre" id="Nombre"  value="<?php if(isset($datosSolicitud['nombre1'])) echo $datosSolicitud['nombre1'].' '.$datosSolicitud['apellido1']; ?>" readonly>
                  </div>
                </div>
            </div>

            <h4 class="ui dividing header">Datos de la solicitud</h4>
            
            <div class="three fields">
                
                <div class="field"><!-- Nombre -->
                  <label>Fecha</label>
                  <div class="ui transparent input">
                    <input type="text" name="Fecha" id="Fecha"  value="<?php if(isset($datosSolicitud['fecha'])) echo $datosSolicitud['fecha']; ?>" readonly>
                  </div>
                </div>
                
                <div class="field"><!-- Nombre -->
                  <label>Programa</label>
                  <div class="ui transparent input">
                    <input type="text" name="Programa" id="Programa"  value="<?php if(isset($datosSolicitud['programa'])) echo $datosSolicitud['programa']; ?>" readonly>
                  </div>
                </div>

                <div class="field">
                   <label>Monto solicitado</label>
                   <div class="ui transparent input">
                        <input type="text" name="MontoVer" id="MontoVer" value="<?php if(isset($datosSolicitud['monto'])) echo 'Bs. '.number_format($datosSolicitud['monto'], 2, ',', '.') ?>" readonly>
                   </div>
                </div>       

            </div>
            
            <div class="three fields">     

                <div class="field">
                   <label>Plazo de pago <i class='fitted help circle icon link' data-title="Ayuda" data-content='Las cuotas serán descontadas por nómina mensualmente.' data-variation='basic'></i></label>
                   <div class="ui transparent input">
                      <input type="text" name="Cuotas" id="Cuotas" value="<?php if(isset($datosSolicitud['cuotas'])) echo $datosSolicitud['cuotas'].' cuotas'; ?>" readonly>
                   </div>
                </div>

                <div class="field">
                    <label>Tasa de Interés</label>
                    <div class="ui transparent left labeled input">
                      <input type="text" name="Interes" id="Interes" value="<?php if (isset($datosSolicitud['interes_cuotas'])) echo number_format($datosSolicitud['interes_cuotas'], 2, ',', '.').' %'?>" readonly>
                    </div>
                </div>   

                <div class="field">
                    <label>Monto de la cuota</label>
                    <div class="ui transparent input">
                      <input type="text" name="MontoCuota" id="MontoCuota" value="<?php echo 'Bs. '.$OBenef->calcularCuota($datosSolicitud['monto'],$datosSolicitud['interes_cuotas'],$datosSolicitud['cuotas']); ?>" readonly>
                    </div>
                </div>                
            </div>

            
                        

            <!--<div class="ui two blue cards">

              <div class="ui card">
                <div class="content">
                  <div class="ui small header">Analizado por:</div>
                  <div class="description">
                    <div class="field">
                      <label>Nombre y Apellido</label>
                      <div class="ui transparent input">
                        <input type="text" name="Nombre" id="Nombre"  value="Analista" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="extra content">
                  <div class="right floated date">
                    <div class="inline field">
                      <label>Fecha de respuesta: </label>
                      <div class="ui transparent input">
                        <input type="text" name="Nombre" id="Nombre"  value="dd/mm/aaaa" readonly>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 

              <div class="ui disabled card">
                <div class="content">
                  <div class="ui small header">Aprobado por:</div>
                  <div class="description">
                    <div class="field">
                      <label>Nombre y Apellido</label>
                      <div class="ui transparent input">
                        <input type="text" name="Nombre" id="Nombre"  value="Directivo" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="extra content">
                  <div class="right floated date">
                    <div class="inline field">
                      <label>Fecha de respuesta: </label>
                      <div class="ui transparent input">
                        <input type="text" name="Nombre" id="Nombre"  value="dd/mm/aaaa" readonly>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  

            </div>-->
  <?php
        break;//Fin case 5
      
     
    }//Fin switch
  ?>
    

        <div class="ui center aligned block inverted header">
            <input type="button" class="ui button noprint" value="Volver" onclick="window.location='Inicio.php'">
        </div>
    </form>
  </div>
    <script type="text/javascript">
        function verReporte(id) {
            window.open("../../fpdf/PDFPrestamoEspecial.php?id="+id);
        }
        window.onload=function(){
          let prestamo = <?= $datosSolicitud["monto"] ?>;
          let plazo = <?= $datosSolicitud["cuotas"] ?>;
          let interes = <?= $datosSolicitud["interes_cuotas"] ?>;
          let tbody = "tablaAmortizacion";
          amortizacionNueva(prestamo,plazo,interes,tbody);
        }
    </script>
</body>
</html>
