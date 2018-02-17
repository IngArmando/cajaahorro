<?php 
      include('../../modelo/MOrganizacion.php');
      $OOrg = new Organizacion;
      //$OOrg -> setIdListaValor($_GET['id']);
      $registro=$OOrg -> consultar();
      while ( $fila = $OOrg->setArreglo( $registro ))
          $datos[] = $fila;
        foreach ($datos as $Org) { $Org; }

    require_once("../../modelo/MConfiguracion.php");
    $OConf = new Configuracion();

    $registro = $OConf->consultar();    
    while ( $fila = $OConf->setArreglo( $registro ))
      $datos[] = $fila;
    foreach ($datos as $Conf) { $Conf; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>CAPPIUTEP - afiliación</title>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="CAJA DE AHORROS">
    <meta name="author" content="UPTP">
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->
    <!--  Propiedades -->
    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
    <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
    <link rel="stylesheet" type="text/css" href="../../css/pub_style.css"><!-- Interface de usuario -->
    <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
    <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
    <script src="../../js/main.js"></script> <!--Configura Interfaz -->
    <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
    <d
</head>

<body>

    <div class="center aligned cabecera">
        <div class="ui grid container" style="background: none">
            <div class="four wide column">
                <img class="ui small centered image" src="../../image/logop.png">
            </div>
            <div class="twelve wide middle aligned column">
                <h3 class="font-style ui center aligned mobile-small"><?php echo $Org['razon_social'];  ?></h3>
            </div>  
        </div>          
    </div>

   <?php require_once('NavBar.php');  ?>

    <div class="ui container" style="margin-top: 30px; padding: 10px">

        
        <h2 class="ui center aligned small block icon inverted header">
          <i class="add user icon"></i>
           Afiliarse a CAPPIUTEP
        </h2>
        <div style="padding:25px">        
             <p>
                Bienvenido a la Caja de Ahorro y Préstamo de los Profesores del Instituto Universitario de Tecnología
                del Estado Portuguesa (C.A.P.P.I.U.T.E.P.), al completar su afiliación podrá acceder al sistema en línea
                desde donde podrá consultar sus haberes, generar solicitudes de beneficios y hacer el seguimiento de
                las mismas. Para poder afiliarse debe cumplir las siguientes condiciones:
             </p>     

             <ul class="ui list">
                <li>Debe ser docente de la Universidad Politecnica Territorial del Estado Portuguesa (U.P.T.P).</li>
                <li>Debe ser un docente fijo, o en caso de ser contratado debe tener una continuidad de al menos dos lapsos academicos ininterrumpidos en la institucion.</li>
             </ul>

             <p>Si cumple con las condiciones antes mencionadas, debe consignar en la oficina principal de CAPPIUTEP
             entre 8:00am-12:00 y 2:00pm-6:00pm, de Lunes a Viernes, la siguiente documentación:</p>

             <ul class="ui list">
                <li>Fotocopia y original laminada de la cédula de identidad.</li>
                <li>Últimos dos recibos de pago emitidos por la UPTP.</li>
                <li>Planilla de solicitud de afiliación, impresa y llena (Descargar <a href="PlanillaAfiliacion.pdf " target="_blank">aquí <i class="fitted external icon"></i></a>).</li>
             </ul>

            <div class="ui message">
              <p style="font-size:0.9em">Para ver la planilla de solicitud de afiliación correctamente, se requiere tener instalado en tu 
                computadora o dispositivo el programa Acrobat o Adobe Reader versión 8.0 o superior.</p>
            </div>  
        </div>
        <div class="ui center aligned block inverted header">        
        <div class="ui negative button" onclick="window.location='acceso.php'">
          Volver
        </div>
      </div>
    </div>  
</body>


</html>
