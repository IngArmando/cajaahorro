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
    <title>CAPPIUTEP - Nosotros</title>
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

    <div class="ui container" style="margin-top: 30px;">


                <div class="ui blue inverted fluid pointing tabular four item menu">
                  <a class="active item" data-tab="1">Misión</a>
                  <a class="item"        data-tab="2">Visión</a>
                  <a class="item"        data-tab="3">Reseña Histórica</a>
                  <a class="item"        data-tab="4">Organigrama Estructural</a>
                </div>


                <div class="ui active tab clearing segment" data-tab="1">
                    <h3 class="ui dividing header">Misión</h3>
                    <img class="ui left floated medium rounded image" src="../../image/mision.jpg">
                    <?php echo $Conf["mision"] ?>
                </div>

                <div class="ui tab clearing segment" data-tab="2">
                    <h3 class="ui dividing header">Visión</h3>
                    <img class="ui left floated medium rounded image" src="../../image/vision.jpg">
                    <?php echo $Conf["vision"] ?>
                </div>


                <div class="ui tab clearing segment" data-tab="3">
                    <h3 class="ui dividing header">Reseña Histórica</h3>
                    <img class="ui left floated medium rounded image" src="../../image/rese.jpg">
                    <?php echo $Conf["historia"] ?>
                </div>

                <div class="ui tab clearing segment" data-tab="4">
                    <h3 class="ui dividing header">Organigrama Estructural</h3>
                    <img class="ui runded image" src="../../image/nigra.jpg">
                </div>

    </div>  
</body>


</html>
